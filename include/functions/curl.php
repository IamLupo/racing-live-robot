<?php
function curl_GoToPage( $v_rla, $v_url )
{
	curl_setopt($v_rla->web_session, CURLOPT_URL, $v_url);
	
	return curl_exec($v_rla->web_session);
}

function curl_GoToPages( $v_rla, $v_urls )
{
	$return = "";

	for($i = 0; $i < count( $v_urls ); $i++)
		$return = curl_GoToPage( $v_rla, $v_urls[$i] );

	return $return;
}

function curl_Post( $v_rla, $v_url, $v_data )
{
	curl_setopt($v_rla->web_session, CURLOPT_POST, true);
	curl_setopt($v_rla->web_session, CURLOPT_URL, $v_url);
	curl_setopt($v_rla->web_session, CURLOPT_POSTFIELDS, $v_data);

	return curl_exec($v_rla->web_session);
}

function getcookie( $v_html )
{
	$cookie = "";
	
	$carr = explode("\n",str_replace("\r\n","\n",$v_html));
	for($z=0;$z<count($carr);$z++)
	{
		if(preg_match("/set-cookie: (.*)/i",$carr[$z],$cookarr))
		{
			$cookie[] = preg_replace("/expires=(.*)(GMT||UTC)(\S*)$/i","",preg_replace("/path=(.*)/i","",$cookarr[1]));
		}
	}

	for( $i=0; $i<count($cookie); $i++ )
	{
		preg_match("/(\S*)=(\S*)(|;)/", $cookie[$i], $matches);
		$cookie = $matches[1] . "=" . $matches[2] . ";";
	}
	
	return $cookie;
}