<?php
if(!class_exists('Racing_Live_Account'))
{
	class Racing_Live_Account
	{
		var $udid = "";
		var $pf = "";
		
		var $puid = 0;
		var $profilecode = "";
		var $profilename = "";
		
		var $crewcode = "";
		var $crewcount = 0;
		
		var $money = 0;
		var $bank_money = 0;
		var $experince = 1;
		var $experince_next_level = 1;
		var $level = 1;
		
		var $fuel = 0;
		var $fuel_max = 0;
		var $health = 0;
		var $health_max = 0;
		var $focus = 0;
		var $focus_max = 0;
		
		var $income = 0;
		var $upkeep = 0;
		var $neto_income = 0;
		
		var $equipment;
		var $city;
			
		var $cookie_code = "";
		var $web_session;
		
		function __construct()
		{
			$this->equipment = new Equipment();
			$this->city = new City();
		}
		
		function Login( $v_udid, $v_pf )
		{
			$this->udid = $v_udid;
			$this->pf = $v_pf;
			
			$url = "http://rl.storm8.com/aindex.php?udid=". $v_udid ."&pf=" . $v_pf;
			
			$this->web_session = curl_init();
	
			curl_setopt($this->web_session, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
			curl_setopt($this->web_session, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->web_session, CURLOPT_URL, $url);
			curl_setopt($this->web_session, CURLOPT_HEADER, 1);
			
			$output = curl_exec($this->web_session);

			$this->cookie_code = getcookie($output);
			curl_setopt($this->web_session, CURLOPT_COOKIE, $this->cookie_code);
			
			return $output;
		}
		
		function ScanTopInformation( $v_html )
		{
			$html = str_get_html($v_html);
			
			//Money
			$element = $html->find("#cashCurrent", 0);
			$this->money = MoneyStrToInt($element->plaintext);
			
			//Neto Income
			$element = $html->find("#cashTimerDiv", 0);
			preg_match("/\+(.*?) in/", $element->plaintext, $match);
			$this->neto_income = MoneyStrToInt($match[1]);
			
			$element = $html->find("div.levelBarBottomArea", 0);
			//Experince
			preg_match("/.*?([0-9]+).*?[0-9]+/", $element->plaintext, $match);
			$this->experince = $match[1];
			//Experince next Level
			preg_match("/.*?[0-9]+.*?([0-9]+)/", $element->plaintext, $match);
			$this->experince_next_level = $match[1];
			
			//Level
			$element = $html->find("div.levelFrontTopArea", 0);
			$this->level = intval($element->plaintext);
			
			//Fuel
			$element = $html->find("#energyCurrent", 0);
			$this->fuel = intval($element->plaintext);
			$element = $html->find("#energyMax", 0);
			$this->fuel_max = intval($element->plaintext);
			
			//Health
			$element = $html->find("#healthCurrent", 0);
			$this->health = intval($element->plaintext);
			$element = $html->find("#healthMax", 0);
			$this->health_max = intval($element->plaintext);
			
			//Focus
			$element = $html->find("#staminaCurrent", 0);
			$this->focus = intval($element->plaintext);
			$element = $html->find("#staminaMax", 0);
			$this->focus_max = intval($element->plaintext);
		}
		
		function ScanHome( $v_html )
		{
			$html = str_get_html($v_html);
			
			//Profilename
			$element = $html->find("div.profileName", 0);
			$this->profilename = $element->plaintext;
			
			//Crew Code
			$element = $html->find("span.codeCode", 0);
			$this->crewcode = $element->plaintext;
			
			//Crew Count
			$element = $html->find("span.crewCount", 0);
			$this->crewcount = intval($element->plaintext);
		}
		
		function GetMoneyInfo()
		{
			$output = curl_GoToPage( $this, "http://rl.storm8.com/bank.php" );
			$html = str_get_html( $output );
			
			$this->ScanTopInformation( $output );
			
			$element = $html->find("span.cash", 0);
			$this->bank_money = MoneyStrToInt($element->plaintext);
			
			return $output;
		}
		
		function GetUrlSession( $v_html )
		{
			$html = str_get_html( $v_html );
			$return = array("", "");
						
			$element = $html->find("a[href]", 0);
			
			preg_match("/.*?formNonce=(\w{40})/", $element->getAttribute("href"), $match);
			$return[0] = $match[1];
			
			preg_match("/.*?h=(\w{40})/", $element->getAttribute("href"), $match);
			$return[1] = $match[1];
			
			return $return;
		}
		
		function WithdrawFromBank( $v_money )
		{
			$url = "http://rl.storm8.com/bank.php";
			$data = "withdrawAmount=". $v_money ."&action=Withdraw&sk=1";
			
			$output = curl_Post( $this, $url, $data );
			
			return $output;
		}
		
		function DepositToBank( $v_money )
		{
			$url = "http://rl.storm8.com/bank.php";
			$data = "depositAmount=". $v_money ."&action=Deposit&sk=1";
			
			$output = curl_Post( $this, $url, $data );
			
			return $output;
		}
		
		function DepositAllToBank()
		{
			$output = curl_GoToPage( $this, "http://rl.storm8.com/home.php" );
			$this->ScanTopInformation( $output );
			
			if($this->money > 0)
			{
				$url = "http://rl.storm8.com/bank.php";
				$data = "depositAmount=". $this->money ."&action=Deposit&sk=1";
				$output = curl_Post( $this, $url, $data );
			}
			
			return $output;
		}

		function BuyCheapestInvestment()
		{
			$id = $this->city->CalcCheapestInvestment();
			$array_id = $this->city->GetArrayID($id);
			
			$output = $this->GetMoneyInfo();
						
			$total_money = $this->money + $this->bank_money;
			
			if($total_money >= $this->city->investment[$array_id][4])
			{
				if($this->money < $this->city->investment[$array_id][4])
				{
					$output = $this->WithdrawFromBank( $this->city->investment[$array_id][4] - $this->money);
					$output = $this->Login( $this->udid, $this->pf ); // Bug fix. Else give error buying city
				}
				
				$url = "http://rl.storm8.com/investment.php?action=buy&inv_id=" . $id;
				
				$output = curl_GoToPage( $this, $url );
				echo $output;
			}
			
			echo "<img src=\"http://static.storm8.com/rl/images/investments/med/" . $id . ".jpg?v=1030\" />";
			
			return $output;
		}
		
		function CalcIncome()
		{
			$this->income = 0;
			
			for($i = 0; $i < count($this->city->investment); $i++)
				$this->income += $this->city->investment[$i][2] * $this->city->investment[$i][3];
		}
	}
}
?>