<?php

session_start();

ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
error_log("Hello, errors!");

include ('client.php');

$user = $_POST['user'];
$pass = $_POST['pass'];
$response = connection( $user, $pass );

if ( $response == false )
{
    	header("Refresh: 0; url=loginfail.html"); 
}

else
{	
	$_SESSION["user"] = $user;
	echo "Hello, " . $_SESSION["user"] . "!";
  	header("Refresh: 2; url=search.php");
}
  
?>
