<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
function QAtoProd(){
    $client = new rabbitMQClient("testRabbitMQ.ini","orcServer");
    $request = array();
    $request['type'] = "QA"; 
    $client->send_request($request);
}
QAtoProd();
?>
