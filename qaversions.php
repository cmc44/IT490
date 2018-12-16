<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
function QA(){
	exec('sshpass -p "test" rsync -zaPvh /home/christian/versions/ christian@192.168.1.10:/home/christian/versions/ --delete');
echo "Sucessfully shipped versions archieve to production and stored in MYSQL";
}
