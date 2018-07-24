<?php

class Settings_Tweet_Record_Model extends Settings_Vtiger_Record_Model {
    const tableName = 'vtiger_tweet_settings';

    private static $SETTINGS_REQUIRED_PARAMETERS = array('consumer_key' => 'text','consumer_secret' => 'text', 'access_token' => 'text' , 'access_token_secret' => 'text');

    public function getId() {
        return $this->get('id');
    }

    public function getName() {
        return $this->get('name');
    }

    public function getModule() {
        return new Settings_Tweet_Module_Model;
    }

    public function getCleanInstance() {
        return new self;
    }

    public function getSettingsParameters() {
        return self::$SETTINGS_REQUIRED_PARAMETERS;
    }

    public static function getInstance(){
        $serverModel = new self();
        $db = PearDatabase::getInstance();
        $query = 'SELECT * FROM '.self::tableName;
        $gatewatResult = $db->pquery($query, array());
        $gatewatResultCount = $db->num_rows($gatewatResult);
        
        if($gatewatResultCount > 0) {
            $rowData = $db->query_result_rowdata($gatewatResult, 0);
            $serverModel->set('gateway',$rowData['gateway']);
            $serverModel->set('id',$rowData['id']);
            $parameters = Zend_Json::decode(decode_html($rowData['parameters']));
            foreach ($parameters as $fieldName => $fieldValue) {
                    $serverModel->set($fieldName,$fieldValue);
            }
            return $serverModel;
        }
        return $serverModel;
    }
    
    public static function getInstanceById($recordId, $qualifiedModuleName) {
		$db = PearDatabase::getInstance();
		$result = $db->pquery('SELECT * FROM '.self::tableName.' WHERE id = ?', array($recordId));

		if ($db->num_rows($result)) {
			$moduleModel = Settings_Vtiger_Module_Model::getInstance($qualifiedModuleName);
			$rowData = $db->query_result_rowdata($result, 0);

			$recordModel = new self();
			$recordModel->setData($rowData);

			$parameters = Zend_Json::decode(decode_html($recordModel->get('parameters')));
			foreach ($parameters as $fieldName => $fieldValue) {
				$recordModel->set($fieldName, $fieldValue);
			}
			return $recordModel;
		}
		return false;
	}
    
    public function save() {
		$db = PearDatabase::getInstance();
		$parameters = '';
		$selectedGateway = $this->get('gateway');
                // $connector = new PBXManager_PBXManager_Connector;
                
                foreach ($this->getSettingsParameters() as $field => $type) {
                        $parameters[$field] = $this->get($field);
                }
                $this->set('parameters', Zend_Json::encode($parameters));
		$params = array($selectedGateway,$this->get('parameters'));
		$id = $this->getId();
                
		if ($id) {
			$query = 'UPDATE '.self::tableName.' SET gateway=?, parameters = ? WHERE id = ?';
			array_push($params, $id);
		} else {
			$query = 'INSERT INTO '.self::tableName.'(gateway, parameters) VALUES(?, ?)';
		}
		$db->pquery($query, $params);
	}
}