<?php

ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/event.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);

include ('client.php');

$above70 = $_POST['above70'];
$above40 = $_POST['above40'];
$below40 = $_POST['below40'];
$playlength = $_POST['playlength'];
$response = spotify_store( $above70, $above40, $below40, $playlength );

if ( $response != true )
{
	file_put_contents('/tmp/events.log', date('d.M.Y')." Playlist creation failed--- ", FILE_APPEND);
	echo "Artists not found or playlist length unspecified, please search again!"
	header("Refresh:3; url=search.php");
}

else
{
	file_put_contents('/tmp/events.log', date('d.M.Y')." Playlist creation success--- ", FILE_APPEND);
	echo "Generating playlist . . . "
	header("Refresh:3; url=display.html");
}

?>
