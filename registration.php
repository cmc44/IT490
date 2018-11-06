<?php

ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);

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
	//file_put_contents('/tmp/error.log', date('d.M.Y')."Registration failed for user: ".$user, FILE_APPEND);
	header( "Refresh:0; url=registerfail.html");
}

else
{
	//file_put_contents('/tmp/error.log', date('d.M.Y')."Registration success for user: ".$user, FILE_APPEND);
	echo "Thanks for registering, " . $fname . "!";
    	header( "Refresh:2; url=login.html");
}
?>
