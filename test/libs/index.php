<?php

$value = '';

  $url = "http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL";

if(isset($_POST['number']) && !empty($_POST['number'])){

//    $url = "http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL";
    $client = new SoapClient($url);

    $value = $client->NumberToDollars(['dNum'=> (int)$_POST['number']])->NumberToDollarsResult;
}


//use curl
//
//

$xml_post_string = '<?xml version="1.0" encoding="UTF-8"?>
 <x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://www.dataaccess.com/webservicesserver/">
        <x:Header/>
        <x:Body>
            <web:NumberToDollars>
                <web:dNum>'.$_POST["number"].'</web:dNum>
            </web:NumberToDollars>
        </x:Body>
    </x:Envelope> ';

$headers = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction: NumberToDollars", 
    "Content-length: ".strlen($xml_post_string),
);


$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);



$response = curl_exec($ch); 
curl_close($ch);


$test = $response;



$test2 = $response;
echo '111';
$p = new XMLParser($test2);
$array = $p->getOutput();

var_dump($array['soap:Envelope']['soap:Body']['m:NumberToDollarsResponse']['m:NumberToDollarsResult']);
echo '222';

$obj = new SimpleXMLElement($test);

var_dump($obj);
print_r($obj);

var_dump($response);

// converting
$response1 = str_replace("<soap:Body>","",$response);
$response2 = str_replace("</soap:Body>","",$response1);

// convertingc to XML
$parser = simplexml_load_string($response2);

var_dump($response2);
