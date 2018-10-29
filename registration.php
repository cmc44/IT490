<?php

ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
error_log("Hello, errors!");

include ('client.php');

$email = $_POST['email'];
$fname = $_POST['fname'];
$lname  = $_POST['lname'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$zipcode = $_POST['zipcode'];
$response = registration( $fname, $lname, $user, $pass, $email, $zipcode );
	
if ( $response != true )
{
	header( "Refresh:0; url=registerfail.html");
}

else
{
	echo "Thanks for registering, " . $fname . "!";
    	header( "Refresh:2; url=login.html");
}
?>
