<?php
/*
$curl = new Request();


$curl->getDataBySoapSecond('Multiply',3,8);

 $curl->getDataByCurlSecond('Multiply',3,5);

die;*/
$value = '';
$calcValue = '';
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



if(isset($_POST['typeCalc']) && !empty($_POST['typeCalc']) &&
   !empty($_POST['intA'] && !empty($_POST['intB']))
){


    $curl = new Request();
    switch ($_POST['methodCalc']) {
        case 'soap':
            $calcValue = $curl->getDataBySoapSecond($_POST['typeCalc'],$_POST['intA'], $_POST['intB']);
            break;
        case 'curl':
            $calcValue = $curl->getDataByCurlSecond($_POST['typeCalc'],$_POST['intA'], $_POST['intB']);
            break;
    }

}
