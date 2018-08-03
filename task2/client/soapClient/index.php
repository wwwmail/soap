<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

include ('models/Client.php');
$action = array('action'=>'getCars');

$obj = new Client();

$obj->setData($_POST);

echo $obj->doAction();



