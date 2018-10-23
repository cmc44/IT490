<?php

session_start();

include ( "functions.php" );
include ( "account.php" );

( $dbh = mysqli_connect( $hostname, $username, $password ,$dbname ) )
        or die ("Unable to connect to MYSQL database" );
mysqli_select_db( $dbh, $dbname );
print "Successfully connected to MySql. <br><br><br>";

$link = mysqli_init();
$success = mysqli_real_connect(
	$link,
	$hostname,
	$username,
	$password,
	$dbname
);

$stmt = "select * from account";
($t = mysqli_query($dbh, $stmt) ) or die ( mysqli_error($dbh) );
while ($r = mysqli_fetch_array($t) ) {
	$user = $r["user"];
	$pass = $r["pass"];
	//echo "User is $user <br> pass is $password <br>";
	$hashbrown = hash('sha256', $pass);
	//echo "Hashed pass is $hashbrown<br>";
	$salt = $r["salt"];
	$saltypass = $pass . $salt;
	//echo "Salted pass is $saltypass <br>";
	$burnthashbrown = hash('sha256', $saltypass);
	//echo "Final pass is $burnthashbrown <br><br>";
}

?>
