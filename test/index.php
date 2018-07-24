<?php
include('libs/XMLParser.php');
include('libs/index.php');
include('template/index.php');
die;

/*
$client = new SoapClient(
    'https://demo.myalm.ru/api/dataservice?wsdl',
    array(
        'soap_version'=>SOAP_1_1,
        'cache_wsdl' => WSDL_CACHE_NONE,
        'trace'=>true
    )
);

var_dump($client->__getFunctions());
*/
$url = "http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL";
    $client = new SoapClient($url);

var_dump($client->__getFunctions());

var_dump( $client->NumberToDollars(29312931));
    //print client.service.NumberToWords(2931)
