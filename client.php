<?php

error_reporting(-1);
ini_set('display_errors', false);

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
/*
function apicall ( $date, $zipcode )
{
    $client = new rabbitMQClient ( "testRabbitMQ.ini", "testServer" );
    if ( isset($argv[1] ) )
    {
      $msg = $argv[1];
    }
    $request = array();
    $request['type'] = "apicall";
    $request['today'] = $date;
    $request['zipcode'] = $zipcode;
    $response = $client->send_request( $request );
    return $response;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}

function getData ( $date, $user, $zipcode )
{
    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    $request = array();
    $request['type'] = "getData";
    $request['today'] = $date;
    $request['user'] = $user;
    $request['zipcode'] = $zipcode;
    $response1 = $client->send_request($request);
    return $response1;
    echo "\n\n";
    echo $argv[0]." END".PHP_EOL;
}
 */
?>
