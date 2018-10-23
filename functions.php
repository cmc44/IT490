<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//$db = parse_ini_file("dbcredentials.ini");

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set( 'display_errors' , 1 );

function authenticate ( $u, $v )
{
	( $db = mysqli_connect ( 'localhost', 'christian', 'password', 'IT490' ) );
if ( mysqli_connect_errno() )
{
	echo"Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
      	exit();
}
echo "Successfully connected to MySQL<br><br>";
mysqli_select_db( $db, 'IT490' );
$s = "select * from account where user = '$u' and pass = '$v'";
    ( $t = mysqli_query ( $db,$s ) ) or die( mysqli_error( $db ) );
    $num = mysqli_num_rows($t);
    if ($num == 0)
    {
      return false;
    }
    
    else
    {
      return true;
    }
}

function registration ( $fname, $lname, $user, $pass, $email, $zipcode )
{
	( $db = mysqli_connect ( 'localhost', 'christian', 'password', 'IT490' ) );
    if ( mysqli_connect_errno () )
    {
      echo "Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
      exit();
    }
    echo "Successfully connected to MySQL";
    mysqli_select_db ( $db, 'IT490' );
    $s = "SELECT * FROM account WHERE email = '$email'";
    $t = mysqli_query( $db, $s ) or die ( mysqli_error( $db ) );
    $r = mysqli_fetch_array( $t, MYSQLI_ASSOC );
    $e = $r["email"];

    if ( $email == $e)
    {
        return false; 
    }
  
    else
    {
	mysqli_query($db, "INSERT INTO account (fname, lname, user, pass, email, zipcode) VALUES ('$fname', '$lname', '$user', '$pass', '$email', '$zipcode')");
print "Thank you, you are registered.";
 	return true;
    }	
}
function getdata ($user){
	global $db;
	
	
	$temp =$_GET [$user];
	$temp = mysqli_real_escape_string($db, $temp);
	return $temp;
}
	
function requestProcessor($request)
{
	echo "received request".PHP_EOL;
	var_dump($request);
	if( ! isset( $request[ 'type' ] ) )
	{
        	return "ERROR: unsupported msg type";
	}
	switch ($request['type'])
	{
	case "login":
		return authenticate($request['user'],$request['pass']);
	case "registration":
        	return registration($request['fname'],$request['lname'],$request['user'],$request['pass'],$request['email'],$request['zipcode']);
      }
      return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
    $server = new rabbitMQServer("testRabbitMQ.ini","testServer");
    $server->process_requests('requestProcessor');
    exit();
?>
