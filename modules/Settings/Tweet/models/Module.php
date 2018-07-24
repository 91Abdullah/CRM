<?php

class Settings_Tweet_Module_Model extends Settings_Vtiger_Module_Model {

    public function getCleanInstance() {
        return new self;
    }

    /**
	 * Function to get the ListView Component Name
	 * @return string
	 */
    public function getDefaultViewName() {
		return 'Index';
	}
    
	/**
	 * Function to get the EditView Component Name
	 * @return string
	 */
	public function getEditViewName(){
		return 'Edit';
	}
    
    /**
	 * Function to get the Module Name
	 * @return string
	 */
    public function getModuleName(){
        return "Tweet";
    }
    
     public function getParentName() {
        return parent::getParentName();
    }
    
    public function getModule($raw=true) {
		$moduleName = Settings_PBXManager_Module_Model::getModuleName();
		if(!$raw) {
			$parentModule = Settings_PBXManager_Module_Model::getParentName();
			if(!empty($parentModule)) {
				$moduleName = $parentModule.':'.$moduleName;
			}
		}
		return $moduleName;
	}
    
    public function getMenuItem() {
        $menuItem = Settings_Vtiger_MenuItem_Model::getInstance('LBL_TWEET_SETTINGS');
        return $menuItem;
    }
    
    /**
    * Function to get the url for default view of the module
    * @return <string> - url
    */
    public function getDefaultUrl() {
            return 'index.php?module='.$this->getModuleName().'&parent=Settings&view='.$this->getDefaultViewName();
    }

    public function getDetailViewUrl() {
        $menuItem = $this->getMenuItem();
        return 'index.php?module='.$this->getModuleName().'&parent=Settings&view='.$this->getDefaultViewName().'&block='.$menuItem->get('blockid').'&fieldid='.$menuItem->get('fieldid');
    }


   /**
    * Function to get the url for Edit view of the module
    * @return <string> - url
    */
    public function getEditViewUrl() {
            $menuItem = $this->getMenuItem();
            return 'index.php?module='.$this->getModuleName().'&parent=Settings&view='.$this->getEditViewName().'&block='.$menuItem->get('blockid').'&fieldid='.$menuItem->get('fieldid');
    }

}