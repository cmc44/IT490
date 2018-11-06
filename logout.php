<?php
	session_destroy();
	setcookie ( session_name(), '', time() - 7000, '/');
	function redirect ( $msg, $url )
	{
		echo $msg;
		header ("Refresh:2; url=$url" );
	}

	redirect("Logged out, goodbye!", "login.html");
?>
