<?php

class Request {

    private $url = 'http://www.dataaccess.com/webservicesserver/numberconversion.wso?WSDL';

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
    
    

}
