<?php
require_once('vendor/autoload.php'); 

require_once 'models/cars.php';
$class = "Cars";
$serviceURI = "http://soap.test/task2/server/server.php";
$wsdlGenerator = new PHP2WSDL\PHPClass2WSDL($class, $serviceURI);
// Generate the WSDL from the class adding only the public methods that have @soap annotation.
$wsdlGenerator->generateWSDL(true);
// Dump as string
$wsdlXML = $wsdlGenerator->dump();
// Or save as file
$wsdlXML = $wsdlGenerator->save('wsdl');