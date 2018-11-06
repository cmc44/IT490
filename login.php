<?php

session_start();

ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);

include ('client.php');

$user = $_POST['user'];
$pass = $_POST['pass'];
$response = connection( $user, $pass );

if ( $response == false )
{
	//file_put_contents('/tmp/error.log', date('d.M.Y')."Login failed for user: ".$user, FILE_APPEND);
    	header("Refresh: 0; url=loginfail.html"); 
}

else
{	
	$_SESSION["user"] = $user;
	//file_put_contents('/tmp/error.log', date('d.M.Y')."Login success for user: ".$user, FILE_APPEND);
	echo "Hello, " . $_SESSION["user"] . "!";
  	header("Refresh: 2; url=search.php");
}
  
?>
