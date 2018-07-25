<?php

class Request {

    private $url = 'http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL';
    private $urlSecond = 'http://www.dneonline.com/calculator.asmx?wsdl';

    public function xmlMarkup($data) {

        return '<?xml version="1.0" encoding="UTF-8"?>
            <x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://www.dataaccess.com/webservicesserver/">
                   <x:Header/>
                   <x:Body>
                       <web:NumberToDollars>
                           <web:dNum>' . $data . '</web:dNum>
                       </web:NumberToDollars>
                   </x:Body>
            </x:Envelope> ';

    }
    
    
    public function curlMethod($url, $xmlString) 
    {
        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: NumberToDollars",
            "Content-length: " . strlen($xmlString),
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
    
    public function getDataByCurl($num)
    {
        $data = $this->curlMethod($this->url, $this->xmlMarkup($num));
        
        $obj = new XMLParser($data);
        $array = $obj->getOutput();

        return $array['soap:Envelope']['soap:Body']['m:NumberToDollarsResponse']['m:NumberToDollarsResult'];
    }
    
    public function getDataBySoap($num)
    {
        $client = new SoapClient($this->url);

        return $client->NumberToDollars(['dNum'=> $num])->NumberToDollarsResult;
    }
    
    public function xmlMarkupSecond( $function, $intA, $intB)
    {
          

        return '<?xml version="1.0" encoding="utf-8"?>
            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
             <soap:Body>
                <'.$function.' xmlns="http://tempuri.org/">
                     <intA>'.$intA.'</intA>
                     <intB>'.$intB.'</intB>
                </'.$function.'>
             </soap:Body>
            </soap:Envelope> ';

    
    }   
    public function curlMethodSecond($url, $xmlString, $function) 
    {
        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: http://tempuri.org/$function",
            "Content-length: " . strlen($xmlString),
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->urlSecond);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

    // var_dump($response); die;   
        return $response;
    }



    public function getDataByCurlSecond($function, $intA, $intB)
    {
        $data = $this->curlMethodSecond( $this->urlSecond, $this->xmlMarkupSecond($function, $intA, $intB), $function );

        $obj = new XMLParser($data);
        $array = $obj->getOutput();
           
        return $array['soap:Envelope']['soap:Body'][$function.'Response'][$function.'Result'];
    }

    public function getDataBySoapSecond($function, $intA, $intB)
    {
        $url = "http://www.dneonline.com/calculator.asmx?wsdl";

        $client = new SoapClient($this->urlSecond);

        $result = $function.'Result'; 

        return $client->$function(['intA'=>$intA,'intB'=>$intB])->$result;

    }
}
