<?php

require 'modules/Facebook/Facebook/autoload.php';

use Facebook;

class Facebook_Module_Model extends Vtiger_Module_Model {

    public function getDefaultUrl() {
		return 'index.php?module='.$this->get('name').'&view='.$this->getDefaultViewName();
    }
    
    public function getDefaultViewName() {
        return 'Index';
    }

    protected function getCredentials() {
        return [
            'app_id' => '1545203182265733',
            'app_secret' => '9fe7c6ecf3047eee0e44b63229fbdd11',
            'default_graph_version' => 'v2.2'
        ];
    }

    public function getDashboardUrl() {
        return 'index.php?module='.$this->get('name').'&view=Dashboard';
    }

    public function getErrorUrl() {
        return 'index.php?module='.$this->get('name').'&view=Error';
    }

    public function getLogoutUrl() {
        // $fb = new \Facebook\Facebook($this->getCredentials());

        // $helper = $fb->getRedirectLoginHelper();

        // return $loginUrl = $helper->getLogoutUrl(Vtiger_Session::get('fb_access_token'), 'http://localhost/crm/index.php?module=Facebook&action=RevokeAccess');
        return 'index.php?module='.$this->get('name').'&action=RevokeAccess';
    }

    public function getLoginUrl() {
        $fb = new \Facebook\Facebook($this->getCredentials());

        $helper = $fb->getRedirectLoginHelper();

        return $loginUrl = $helper->getLoginUrl('http://localhost/crm/index.php?module=Facebook&action=AuthorizeFacebook', ['scope' => 'manage_pages']);
    }

    public function getPageData() {
        $fb = new Facebook\Facebook($this->getCredentials());
        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->get('/me/accounts', Vtiger_Session::get('fb_access_token'));
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        return $this->getPageRatings($response->getDecodedBody()['data']);
        // return count($this->getPageRatings(
        //     $response->getDecodedBody()['data'][0]['id'],
        //     $response->getDecodedBody()['data'][0]['access_token']
        // ));
    }

    public function getPageRatings($data) {
        $temp = [];
        foreach($data as $key => $single) {
            $fb = new Facebook\Facebook($this->getCredentials());
            try {
                // Get the \Facebook\GrapxhNodes\GraphUser object for the current user.
                // If you provided a 'default_access_token', the '{access-token}' is optional.
                $response = $fb->get('/'. $single['id'] .'/ratings', $single['access_token']);
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
            $temp[$key]['page_name'] = $single['name'];
            $temp[$key]['category'] = $single['category'];
            $temp[$key]['id'] = $single['id'];
            $temp[$key]['reviews'] = $response->getDecodedBody()['data'];
        }
        return $temp;
    }

    public function mapPagesResponse($data) {
        $new_data = [];
        foreach($data as $key => $single) {
            $new_data[$single['id']] = $single['name'];
        }
        return $new_data;
    }

    public function getToken() {
        $fb = new Facebook\Facebook($this->getCredentials());
        
        $helper = $fb->getRedirectLoginHelper();
        
        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        
        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        
        // Logged in
        // echo '<h3>Access Token</h3>';
        // var_dump($accessToken->getValue());
        
        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        // echo '<h3>Metadata</h3>';
        // var_dump($tokenMetadata);
        
        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId($this->getCredentials()['app_id']); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();
        
        if (!$accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }
        
            // echo '<h3>Long-lived</h3>';
            // var_dump($accessToken->getValue());
        }
        
        if($accessToken !== null) {
            Vtiger_Session::set('fb_access_token', (string) $accessToken);
            return $this->getDashboardUrl();
        } else {
            return $this->getErrorUrl();
        }
    }

    public function revokeAccess() {
        $fb = new Facebook\Facebook($this->getCredentials());
        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->delete('/me/permissions', [], Vtiger_Session::get('fb_access_token'));
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        unset($_SESSION['fb_access_token']);
        return $this->getDefaultUrl();
    }

}