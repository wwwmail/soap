<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

include ('models/Client.php');
$action = array('action'=>'getCars');

$obj = new Client();

$obj->setData($_POST);


//var_dump($_POST);

$obj->doAction();







die;



try {
    
    
    var_dump($_POST);
    if (isset($_GET['action'])) {

        switch ($_GET['action']) {
            case 'getCars':
                echo "i равно 0";
                break;
            case 'getCarById':
                echo "i равно 1";
                break;
            case 'getSearchCars':
                echo "i равно 2";
                break;
            case 'createOrder':
                echo "i равно 2";
                break;
        }
    }
    $client = new SoapClient('http://soap.test/task2/server/wsdl', array('trace' => true));
 $dwarves = $client->getCars();
 
 echo $dwarves;
 //$xml = new SimpleXMLElement($dwarves);
 echo '<pre>';
 //var_dump($xml);
} catch (SoapFault $e) {
    echo '<pre>';
 var_dump($e);
 $functions = $client->__getFunctions ();
var_dump ($functions);
 echo($client->__getLastResponse());
    echo PHP_EOL;
    echo($client->__getLastRequest());
}