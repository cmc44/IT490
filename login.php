<?php

session_start();

error_reporting(-1);
ini_set('display_errors', true);

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
  header("Refresh: 0; url=search.html");
}
  
?>
