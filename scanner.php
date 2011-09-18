<?php
include( "settings.php" );

//Scan Home Page
$output = curl_GoToPage( $rl_account, "http://rl.storm8.com/home.php" );
$rl_account->ScanTopInformation( $output );
$rl_account->ScanHome( $output );

//Go to City and Scan
$output = curl_GoToPage( $rl_account, "http://rl.storm8.com/investment.php" );
$rl_account->city->ScanInvestments( $output );

$rl_account->CalcIncome();

//Buy
$rl_account->BuyCheapestInvestment();

//Money
$rl_account->DepositAllToBank();

curl_close( $rl_account->web_session );
?>