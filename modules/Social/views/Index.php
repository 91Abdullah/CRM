<?php

class Social_Index_View extends Vtiger_Index_View {
    public $initialTweets = 5;
    public function process(Vtiger_Request $request) {
        // var_dump($_SESSION);
        $viewer = $this->getViewer($request);
        if($_SESSION['oauth_user_verified'] == true) {
            // echo '<pre>' . var_export($request->get('initialTweets') !== '', true) . '</pre>';
            $model = Vtiger_Module_Model::getInstance('Social');

            if($request->get('initialTweets') !== '' && $request->get('moreTweets') !== '') {
                $newTweets = (int)$request->get('initialTweets') + 5;
                $tweets = $model->getTweets($newTweets);
                // echo '<pre>' . var_export($tweets, true) . '</pre>';
                $viewer->assign('TWEETS', $tweets);
                $viewer->assign('TOTAL_TWEETS', $newTweets);
            } else {
                $tweets = $model->getTweets($this->initialTweets);
                // echo '<pre>' . var_export($this->initialTweets, true) . '</pre>';
                $viewer->assign('TWEETS', $tweets);
                $viewer->assign('TOTAL_TWEETS', $this->initialTweets);
            }
            $viewer->view('Dashboard.tpl', 'Social');
        } else {
            $viewer->view('Index.tpl', 'Social');
            // $viewer->view('Dashboard.tpl', 'Social');            
        }
    } 

    public function getHeaderScripts(Vtiger_Request $request) {
        $headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();

		$jsFileNames = array(
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.6.0/src/loadingoverlay.min.js',
            'modules.Social.resources.script'
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
    }
}