<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
echo "what version is this?"; 
$verno=trim(fgets(STDIN));
function ziptoQA($verno){
    $client = new rabbitMQClient("testRabbitMQ.ini","orcServer");
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    $request = array();
    $request['type'] = "package"; 
    $request['versionno'] ="$verno";
    $client->send_request($request);
}
ziptoQA($verno)
?>
