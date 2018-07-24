<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

class SMSNotifier_Telecard_Provider implements SMSNotifier_ISMSProvider_Model {

	private $userName;
	private $password;
	private $parameters = array();

	const SERVICE_URI = 'http://b2bsms.telecard.com.pk/SMSPortal/Customer';
	private static $REQUIRED_PARAMETERS = array();

	/**
	 * Function to get provider name
	 * @return <String> provider name
	 */
	public function getName() {
		return 'Telecard';
	}

	/**
	 * Function to get required parameters other than (userName, password)
	 * @return <array> required parameters list
	 */
	public function getRequiredParams() {
		return self::$REQUIRED_PARAMETERS;
	}

	/**
	 * Function to get service URL to use for a given type
	 * @param <String> $type like SEND, PING, QUERY
	 */
	public function getServiceURL($type = false) {
		if($type) {
			switch(strtoupper($type)) {
				case self::SERVICE_AUTH: return  self::SERVICE_URI . '/http/auth';
				case self::SERVICE_SEND: return  self::SERVICE_URI . '/ProcessSMS.aspx';
				case self::SERVICE_QUERY: return self::SERVICE_URI . '/http/querymsg';
			}
		}
		return false;
	}

	/**
	 * Function to set authentication parameters
	 * @param <String> $userName
	 * @param <String> $password
	 */
	public function setAuthParameters($userName, $password) {
		$this->userName = $userName;
		$this->password = $password;
	}

	/**
	 * Function to set non-auth parameter.
	 * @param <String> $key
	 * @param <String> $value
	 */
	public function setParameter($key, $value) {
		$this->parameters[$key] = $value;
	}

	/**
	 * Function to get parameter value
	 * @param <String> $key
	 * @param <String> $defaultValue
	 * @return <String> value/$default value
	 */
	public function getParameter($key, $defaultValue = false) {
		if(isset($this->parameters[$key])) {
			return $this->parameters[$key];
		}
		return $defaultValue;
	}

	/**
	 * Function to prepare parameters
	 * @return <Array> parameters
	 */
	protected function prepareParameters() {
		$params = array('userid' => $this->userName, 'pwd' => $this->password);
		foreach (self::$REQUIRED_PARAMETERS as $key) {
			$params[$key] = $this->getParameter($key);
		}
		return $params;
	}

	/**
	 * Function to handle SMS Send operation
	 * @param <String> $message
	 * @param <Mixed> $toNumbers One or Array of numbers
	 */
	public function send($message, $toNumbers) {
        //return $result = array('id' => str_random(10), 'status' => self::MSG_STATUS_PROCESSING, 'to' => "0");
		if(is_array($toNumbers)) {
            $reponse = array();
            foreach($toNumbers as $key => $toNumber) {
                $number = (substr($toNumber, 0, 2)) == "03" ? "92" . (substr($toNumber, 1, 11)) : "92" . $toNumber; 
                $serviceURL = $this->getServiceURL(self::SERVICE_SEND);
                // $params['userid'] = "sharjeelwasi";
                // $params['pwd'] = "sharjeel@wasi123";
                $params = $this->prepareParameters();
                $params['msg'] = urlencode($message);
                $params['mobileno'] = $number;
                $httpClient = new Vtiger_Net_Client($serviceURL);
                $response[$key] = $httpClient->doGet($params);
            }
        } else {
            $number = (substr($toNumbers, 0, 2)) == "03" ? "92" . (substr($toNumbers, 1, 11)) : "92" . $toNumbers; 
            $serviceURL = $this->getServiceURL(self::SERVICE_SEND);
            $params['userid'] = "sharjeelwasi";
            $params['pwd'] = "sharjeel@wasi123";
            $params['msg'] = urlencode($message);
            $params['mobileno'] = $number;
            $httpClient = new Vtiger_Net_Client($serviceURL);
            $response[$key] = $httpClient->doGet($params);
        }

        //handle response
        return handleResponse($response);
    }
    
    private function handleResponse($response) {
        $result = array('error' => false, 'statusmessage' => '');
        if(is_array($response)) {
            foreach($response as $key => $res) {
                if($res !== "OK") {
                    //that means error
                    $result['error'] = true;
                    $result['to'] = "0";
                    $result['statusmessage'] = $res;
                } else {
                    $result['id'] = str_random(5);
                    $result['to'] = "0";
                    $result['status'] = self::MSG_STATUS_PROCESSING;
                }
            }
        } else {
            if($res !== "OK") {
                //that means error
                $result['error'] = true;
                $result['to'] = "0";
                $result['statusmessage'] = $res;
            } else {
                $result['id'] = str_random(5);
                $result['to'] = "0";
                $result['status'] = self::MSG_STATUS_PROCESSING;
            }
        }
        return $results[] = $result;
    }

	/**
	 * Function to get query for status using messgae id
	 * @param <Number> $messageId
	 */
	public function query($messageId) {
		$params = $this->prepareParameters();
		$params['apimsgid'] = $messageId;

		$serviceURL = $this->getServiceURL(self::SERVICE_QUERY);
		$httpClient = new Vtiger_Net_Client($serviceURL);
		$response = $httpClient->doPost($params);
		$response = trim($response);

		$result = array( 'error' => false, 'needlookup' => 1 );

		if(preg_match("/ERR: (.*)/", $response, $matches)) {
			$result['error'] = true;
			$result['needlookup'] = 0;
			$result['statusmessage'] = $matches[0];
		} else if(preg_match("/ID: ([^ ]+) Status: ([^ ]+)/", $response, $matches)) {
			$result['id'] = trim($matches[1]);
			$status = trim($matches[2]);

			// Capture the status code as message by default.
			$result['statusmessage'] = "CODE: $status";
			if($status === '1') {
				$result['status'] = self::MSG_STATUS_PROCESSING;
			} else if($status === '2') {
				$result['status'] = self::MSG_STATUS_DISPATCHED;
				$result['needlookup'] = 0;
			}
		}
		return $result;
	}
}
?>
