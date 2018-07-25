<?php

/*
$url = "http://www.dneonline.com/calculator.asmx?wsdl";

$client = new SoapClient($url);

    var_dump(  $client->__getFunctions());


var_dump($client->Multiply(['intA'=>2,'intB'=>6]));
die;
$client = new SoapClient(NULL,  
    array(  
        "location" => $url,  
        "uri"      => "urn:xmethods-delayed-quotes",  
        "style"    => SOAP_RPC,  
        "use"      => SOAP_ENCODED  
    )); 


var_dump($client->getFunctions());

die;
 */
include ('libs/Request.php');
include('libs/XMLParser.php');
include('libs/index.php');
include('template/index.php');

