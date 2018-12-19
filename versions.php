<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
function package($in){
exec("sudo zip -r /var/www/versions/version$in.zip /var/www/html/weatherspot.com/public_html ");
exec('sshpass -p "test" rsync -zaPvh /var/www/versions christian@192.168.1.10:~/ --delete');
echo "Sucessfully packaged and shipped to QA";  
}
function requestProcessor($request)
  {
      echo "received request".PHP_EOL;
      var_dump($request);
      if(!isset($request['type']))
      {
        return "ERROR: unsupported message type";
      }
      switch ($request['type'])
      {
        case "package":
          return package($request['versionno']);
      }
      return array("returnCode" => '0', 'message'=>"Server received request and processed");
    }
    $server = new rabbitMQServer("testRabbitMQ.ini","orcServer");
    $server->process_requests('requestProcessor');
    exit();
?>
