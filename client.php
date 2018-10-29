<?php

ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
error_log("Hello, errors!");

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function connection ( $user, $pass )
{
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
    	if (isset($argv[1]))
    	{
      		$msg = $argv[1];
    	}
    	else
    	{
      		$msg = "test message";
	}
	$request = array();
   	$request['type'] = "login";
    	$request['user'] = $user;
   	$request['pass'] = $pass;
   	$request['message'] = $msg;
	$response = $client->send_request($request);

	return $response;
	echo "/n/n";

	echo $argv[0]." END".PHP_EOL;
}

function registration( $fname, $lname, $user, $pass, $email, $zipcode )
{
    $client = new rabbitMQClient( "testRabbitMQ.ini", "testServer" );
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    else
    {
      $msg = "test message";
    }
    $request = array();
    $request['type'] = "registration";
    $request['email'] = $email;
    $request['fname'] = $fname;
    $request['lname'] = $lname;
    $request['pass'] = $pass;
    $request['user'] = $user;
    $request['zipcode'] = $zipcode;
    $request['message'] = $msg;
    $response = $client->send_request($request);
    return $response;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}

function weather_store ( $zipcode )
{
    $client = new rabbitMQClient ( "testRabbitMQ.ini", "testServer" );
    if ( isset($argv[1] ) )
    {
      $msg = $argv[1];
    }
    $request = array();
    $request['type'] = "weatherapi";
    $request['zipcode'] = $zipcode;
    $response = $client->send_request( $request );
    return $response;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}

function spotify_store ( $above70, $above40, $below40, $playlength )
{
    $client = new rabbitMQClient ( "testRabbitMQ.ini", "testServer" );
    if ( isset($argv[1] ) )
    {
      $msg = $argv[1];
    }
    else
    {
      $msg = "test message";
    }
    $request = array();
    $request['type'] = "spotify_store";
    $request['above70'] = $above70;
    $request['above40'] = $above40;
    $request['below40'] = $below40;
    $request['playlength'] = $playlength;
    $response1 = $client->send_request( $request );
    return $response1;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}

function get_data ( $user )
{
    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    $request = array();
    $request['type'] = "getdata";
    $request['user'] = $user;
    $response = $client->send_request($request);
    return $response;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}

?>
