<?php

class Facebook_RevokeAccess_Action extends Vtiger_Action_Controller {

    public function checkPermission(Vtiger_Request $request) {
        return;
    }

    public function process(Vtiger_Request $request) {
        $module = Vtiger_Module_Model::getInstance('Facebook');
        $url = $module->revokeAccess();
        header('Location: ' . $url);
    }

}