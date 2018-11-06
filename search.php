<?php

session_start();

include ('client.php');

ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);

if( ! isset( $_SESSION["user"] ) )
{
	header("Refresh:0; url=login.html");
}

?>

<!DOCTYPE html>

<html>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->

<style>

body {font-family: Arial, Helvetica, sans-serif;}
 {box-sizing: border-box}

input[type=text], input[type=pass]
{
        width: 30%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: center;
        border: none;
        background: #f1f1f1;
        border-radius: 10px;
}

input[type=text]:focus, input[type=pass]:focus
{
        background-color: #C8C8C8;
        padding: 15px;
        display: center;
        border: 2px solid #4D4D4D;
        border-radius: 10px;
}

button
{
   background-color: #00ff08;
   color: white;
   padding: 15px 15px;
   margin: 8px 0;
   border: none;
   cursor: pointer;
   width: 1%;
   opacity: 0.9;
   border-radius: 10px;
}

hr
{
        border: 1px solid #f1f1f1;
        margin-bottom: auto;
}

.searchbutton
{
	background-color: #00ff08;
   	color: white;
   	padding: 15px 15px;
   	margin: 8px 0;
   	border: none;
   	cursor: pointer;
   	width: 1%;
   	opacity: 0.9;
  	border-radius: 10px;
	float: left;
        width: 15%;
}

.logoutbutton
{
	float: left;
	width: 15%;
}

</style>

<script>

$(document).ready(function(){

let API_KEY = 'ec3d6ee1a10bac2c3ba8edde6eb961d6';

var str_num = "<?php echo $zipcode ?>";

function weatherapi(str_num)

{
	$.ajax
	({
        url: 'http://api.openweathermap.org/data/2.5/weather',
	data: 
	{
        zip: str_num,
        units: 'imperial',
        APPID: API_KEY
        },
		success: data => 
		{	
                        zipis=(data["main"]["temp"]);
                }
        });
}

});

function alerting () {
	alert("hello!");
}


</script>
<html>
        <body>
                <fieldset>
		<form action= "playlist.php" method="POST">
		<h1>Hello!</h1>
                <p>Generate Your Playlist Here!</p>

                <hr>
		
                <input type="text" placeholder="Enter an Artist if Temperature is Above 70°" name="above70" required><br>
                <input type="text" placeholder="Enter an Artist if Temperature is Between 40-70°" name="above40" required><br>
                <input type="text" placeholder="Enter an Artist if Temperature is Below 40°" name="below40" required><br>
                <input type="text" placeholder="Enter a Number for # of Songs for Playlist" name="playlength" required><br>
		<button type="submit" class="searchbutton">Create Your Playlist</button>
		</form>
		<form action="logout.php">
                <button type="submit" class="logoutbutton">Logout</button>
		</form>
		</fieldset>
        </body>
</html>
