<?php
ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache

require('models/cars.php');

$server = new SoapServer("wsdl");
$server->setClass('Cars');
$server->handle();
