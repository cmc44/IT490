<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//$db = parse_ini_file("dbcredentials.ini");
  
ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/events.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);

function authenticate ( $u, $p )
{
	( $db = mysqli_connect ( '192.168.1.81', 'connect', '12345', 'IT490'     ));

     if ( mysqli_connect_errno () )
     {
	     ( $db = mysqli_connect ( '192.168.1.10', 'connect', '12345', 'IT490' ) );
	     if (mysqli_connect_errno () )
	     {
       echo "Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
       exit();
	     }
     }

echo "Successfully connected to MySQL<br><br>";
mysqli_select_db( $db, 'IT490' );
$s = "SELECT * FROM account WHERE user = '$u' AND pass = '$p'";
    ( $t = mysqli_query ( $db,$s ) ) or die( mysqli_error( $db ) );
    $num = mysqli_num_rows($t);
    if ($num == 0)
    {
	file_put_contents('/tmp/events.log', date('d.M.Y')." Login failed for user: ".$u."--- ", FILE_APPEND);
	return false;
    }
    
    else
    {
	file_put_contents('/tmp/events.log', date('d.M.Y')." Login success for user: ".$u."--- ", FILE_APPEND);
	return true;
    }
}

function registration ( $fname, $lname, $user, $pass, $email, $zipcode )
{
	( $db = mysqli_connect ( '192.168.1.81', 'connect', '12345', 'IT490'     ));
     if ( mysqli_connect_errno () )
     {
             ( $db = mysqli_connect ( '192.168.1.10', 'connect', '12345', 'IT490' ) );
             if (mysqli_connect_errno () )
             {
       echo "Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
       exit();
             }
     }
    echo "Successfully connected to MySQL";
    mysqli_select_db ( $db, 'IT490' );
    $s = "SELECT * FROM account WHERE email = '$email'";
    $t = mysqli_query( $db, $s ) or die ( mysqli_error( $db ) );
    $r = mysqli_fetch_array( $t, MYSQLI_ASSOC );
    $e = $r["email"];

    if ( $email == $e)
    {
	file_put_contents('/tmp/events.log', date('d.M.Y')." Registration failedfor user: ".$user."--- ", FILE_APPEND);
        return false; 
    }
  
    else
    {
	mysqli_query($db, "INSERT INTO account (fname, lname, user, pass, email, zipcode) VALUES ('$fname', '$lname', '$user', '$pass', '$email', '$zipcode')");
	print "Thank you, you are registered.";
	file_put_contents('/tmp/events.log', date('d.M.Y')." Registration success for user: ".$user."--- ", FILE_APPEND);
 	return true;
    }	
}

function spotify_store ( $above70, $above40, $below40, $playlength )
{
	return true;
}

function get_data ( $user )
{
	 ( $db = mysqli_connect ( '192.168.1.10', 'christian', 'password', 'IT490' ) );
 	 if ( mysqli_connect_errno () )
 	 {
 	  echo "Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
 	  exit();
 	 }
 	 echo "Successfully connected to MySQL";
	 mysqli_select_db ( $db, 'IT490' );

		$zipcode = "SELECT zipcode FROM account WHERE user = '$user'";

		return $zipcode;
}
	
function requestProcessor( $request )
{
	echo "received request".PHP_EOL;
	var_dump( $request );
	if( ! isset( $request[ 'type' ] ) )
	{
        	return "ERROR: unsupported msg type";
	}
	switch ( $request['type'] )
	{
	case "login":
		return authenticate ( $request['user'], $request['pass'] );
	case "registration":
        	return registration ( $request['fname'], $request['lname'], $request['user'], $request['pass'], $request['email'], $request['zipcode'] );
	case "weatherapi":
		return weather_store ( $request['temp'] );
	case "spotify_store":
		return spotify_store ( $request['above70'], $request['above40'], $request['below40'], $request['playlength'] );
	case "getdata":
		return get_data ( $request['user'] );
	}

      return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
    $server = new rabbitMQServer("testRabbitMQ.ini","testServer");
    $server->process_requests('requestProcessor');
    exit();
?>
