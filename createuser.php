<?php

session_start();

include ("account.php");
include ("salt.php");

( $dbh = mysqli_connect( $hostname, $username, $password ,$dbname ) )
        or die ("Unable to connect to MYSQL database" );
mysqli_select_db( $dbh, $dbname );
print "Successfully connected to MySql. <br><br><br>";

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set( 'display_errors' , 1 );

$fname = $_GET["fname"];
$lname = $_GET["lname"];
$user = $_GET["user"];
$pass = $_GET["pass"];
$email = $_GET["email"];
//$zipcode = $_GET["zipcode"];

$s = "INSERT INTO account values ('$fname' ,'$lname', '$user','$pass' ,'$email', '$burnthashbrown')" ;
	
	( $t = mysqli_query($dbh, $s) ) or die ( mysqli_error( $dbh ) );

	echo "<br> Thank you, " . $_SESSION["$user"] .".<br>";
	
	echo "Your information was added to the database.<br>";

	redirect("Redirecting", "login.html");

?>
