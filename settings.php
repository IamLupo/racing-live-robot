<?php
$global_version = "1.0";
$global_description = "";
$global_keywords = "";
$global_publisher = "";
$global_author = "Ludo Ruisch";
$global_copyright = "2011";
$global_title = "Racing Live";
$global_madeby = "Ludo Ruisch";

include("include/functions.php");

$rl_account = new Racing_Live_Account();
$output = $rl_account->Login(	"",			// udid
								"" );		// pf

?>