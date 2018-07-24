<?php

class Facebook_Index_View extends Vtiger_Index_View {

    public function process(Vtiger_Request $request) {
        if(Vtiger_Session::get('fb_access_token') !== '') {
            header('Location: index.php?module=Facebook&view=Dashboard');
        } else {
            $module = Vtiger_Module_Model::getInstance('Facebook');
            $loginUrl = $module->getLoginUrl();
            $viewer = $this->getViewer($request);
            $viewer->assign('LOGIN_URL', $loginUrl);
            $viewer->view('Index.tpl', 'Facebook');
        }
        // return '<pre>' . var_export(Vtiger_Session::get('fb_access_token') !== '') . '</pre>'; 
    }

}