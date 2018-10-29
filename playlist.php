<?php

ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
error_log("Hello, errors!");

include ('client.php');

$above70 = $_POST['above70'];
$above40 = $_POST['above40'];
$below40 = $_POST['below40'];
$playlength = $_POST['playlength'];
$response = spotify_store( $above70, $above40, $below40, $playlength );

if ( $response != true )
{
	echo "Artists not found or playlist length unspecified, please search again!"
	header("Refresh:3; url=search.php");
}

else
{
	echo "Generating playlist . . . "
	header("Refresh:3; url=display.html");
}

?>
