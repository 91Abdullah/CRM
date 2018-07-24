<?php

class Facebook_AuthorizeFacebook_Callbacks {

    public function process($request) {
        $module = Vtiger_Module_Model::getInstance('Facebook');
        $url = $module->getToken();
        header('Location: ' . $url, true, 301);
    }

}

if($_SERVER['HTTP_REFERER'] === 'https://www.facebook.com/') {
    // possible hack for illegal request exception
    global $site_URL;
    $_SERVER['HTTP_REFERER'] = $site_URL;
    // echo "<pre>". print_r($_SERVER) ."</pre>";
}

$obj = new Facebook_AuthorizeFacebook_Callbacks();
$obj->process(new Vtiger_Request($_REQUEST));

// echo "<pre>". print_r($_SERVER) ."</pre>"

?>