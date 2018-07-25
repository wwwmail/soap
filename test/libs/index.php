<?php

$curl = new Request();

 $curl->getDataByCurl(345);


$value = '';

  $url = "http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL";

if(isset($_POST['number']) && !empty($_POST['number'])){

    $curl = new Request();
    switch ($_POST['method']) {
        case 'soap':
            $value = $curl->getDataBySoap($_POST['number']);
            break;
        case 'curl':
            $value = $curl->getDataByCurl($_POST['number']);
            break;
    }


    }