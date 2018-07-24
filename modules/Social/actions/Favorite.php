<?php 

class Social_Favorite_Action extends Vtiger_Action_Controller {

    public function checkPermission(Vtiger_Request $request) {
        return;
    }

    public function process(Vtiger_Request $request) {
        $mode = $request->get('mode');
        switch($mode) {
            case "favorite":
                $module = Vtiger_Module_Model::getInstance('Social');
                $result = $module->setFavorite($request->get('id'));
                $response = new Vtiger_Response();
                $response->setResult($result);
                $response->emit();
            break;
            case "reply":
            break;
        }
    }
}