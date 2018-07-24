<?php

class Facebook_Dashboard_View extends Vtiger_Index_View {
    
    public function process(Vtiger_Request $request) {
        $module = Vtiger_Module_Model::getInstance('Facebook');
        // return '<pre>' . var_export($module->getPageData()) . '</pre>'; 
        $viewer = $this->getViewer($request);
        $viewer->assign('LOGOUT_URL', $module->getLogoutUrl());
        $viewer->assign('RATINGS_DATA', $module->getPageData());
        $viewer->view('Dashboard.tpl', 'Facebook');
    }

    public function validateRequest(Vtiger_Request $request) { 
        if($_SERVER['HTTP_REFERER'] === 'https://www.facebook.com/') {
            // change the referer as a hack
            global $site_URL;
            $_SERVER['HTTP_REFERER'] = $site_URL;
            $request->validateReadAccess();
        } 
    } 
}