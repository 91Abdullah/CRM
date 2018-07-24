<?php

class Social_AuthorizeTwitter_View extends Vtiger_Index_View {
    public function process(Vtiger_Request $request) {
        $moduleModel = Vtiger_Module_Model::getInstance('Social');
        $url = $moduleModel->getRequestToken();
        header('Location: ' . $url);
    }
} 