
<?php

class Facebook_Error_View extends Vtiger_Index_View {

    public function process(Vtiger_Request $request) {
        return '<pre>' . var_export($request) . '</pre>';
        $viewer->view('Error.tpl', 'Facebook');
    }

}