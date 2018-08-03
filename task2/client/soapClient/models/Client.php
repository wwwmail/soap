<?php

class Client{
    
	private $serverSoapUrl = 'http://192.168.0.15/~user4/php7/soap/task2/server/wsdl?wsdl';
	
	private $data = array();
	
	public function setData(array $data){
		$this->data = $this->filter($data);
	}
	
	private function getData(){
		return $this->data;
	}
	
	public function filter($data) { //Filters data against security risks.
		if (is_array($data)) {
			foreach ($data as $key => $element) {
				$data[$key] = $this->filter($element);
			}
		} else {
			$data = trim(htmlentities(strip_tags($data)));
			if(get_magic_quotes_gpc()) $data = stripslashes($data);
			
		}
		return $data;
	}
	
	
	
	public function doAction(){
		if(isset($this->data['action']) && !empty($this->data['action'])){
			  $client = new SoapClient($this->serverSoapUrl);
			  
			switch ($this->data['action']) {
            case 'getCars':
 
					return $client->getCars();
					break;
				case 'getCarById':
                   
                    return $client->getCarById($this->data['id']);
					break;
				case 'getSearchCars':

					return  $client->getSearchCars($this->data['year'],$this->data['brand']);;
					break;
				case 'createOrder':
                   
                    return $client->createOrder( $this->data['auto_id'], $this->data['first_name'], $this->data['last_name'], $this->data['payment']);
					break;
			}
			  

		}else{
			return json_encode(array('action'=>'not exist'));
		}
	}
	
	
	
}
