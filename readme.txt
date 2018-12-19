This is the ReadMe for the WeatherSpot application.

There are two main files which connect the project to RabbitMQ which are the functions.php file (the Server file), and the client.php (the Client file). 

The login.php is where the login function is handled from the Server file and the registration.php is where the registration function is handled. The Spotify login is handled by the spotifylogin.php file and the search.php function is where the playlist search is performed along with the playlist.php file.

The version control is handled along RabbitMQ and passed along by the rsync function using ssh. The versions.php file is the Server and the versioncontrol.php is the Client. The Client is run by the "orchestrator" and acts as a listener for the version sent by the Server file run on a separate server called the "orchestrator."
