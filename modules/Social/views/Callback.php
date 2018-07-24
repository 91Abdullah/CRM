<?php

class Social_Callback_View extends Vtiger_Index_View {
    public function process(Vtiger_Request $request) {
        // var_dump($_SESSION);

        $moduleModel = Vtiger_Module_Model::getInstance('Social');
        if(!$request->has('denied')) {
            $moduleModel->saveAccessToken($_REQUEST);
        }
        header('Location: index.php?module=Social&View=Index');
    }
}