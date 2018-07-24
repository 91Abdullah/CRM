<?php

class Settings_Tweet_Index_View extends Settings_Vtiger_Index_View {
    
    public function process(Vtiger_Request $request) {
        $this->gatewayInfo($request);
    }
    
    public function gatewayInfo(Vtiger_Request $request){
        $recordModel = Settings_Tweet_Record_Model::getInstance();
        $moduleModel = Settings_Tweet_Module_Model::getCleanInstance();
        $viewer = $this->getViewer($request);  
        
        $viewer->assign('RECORD_ID', $recordModel->get('id'));
        $viewer->assign('MODULE_MODEL', $moduleModel);
        $viewer->assign('MODULE', $request->getModule(false));
        $viewer->assign('QUALIFIED_MODULE', $request->getModule(false));
        $viewer->assign('RECORD_MODEL', $recordModel);
        $viewer->view('index.tpl', $request->getModule(false));
    }
}