<?php

require 'modules/Tweet/twitteroauth/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', "Qjwzz8XAvnd8xFktYKvTCJCFn");
define('CONSUMER_SECRET', "HhU1xvhZvxztU9Ay3oiUCXwSoRAw910T793V7R9tBZ40ArMZ9q");
define('OAUTH_CALLBACK', "http://localhost/crm/index.php?module=Social&view=Callback");

class Social_Module_Model extends Vtiger_Module_Model {

    private $request_token = [];

    public function getRequestToken() {
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret']; 
        return $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
    }

    public function saveAccessToken($request) {
        $request_token['oauth_token'] = $_SESSION['oauth_token'];
        $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

        if (isset($request['oauth_token']) && $request_token['oauth_token'] !== $request['oauth_token']) {
            return false;
        } else {
            $_SESSION['oauth_user_verified'] = true;
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
            $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $request['oauth_verifier']]);
            $request_token['access_token'] = $access_token;
            $_SESSION['access_token'] = $access_token;
            return true;
        }
    }

    public function revokeAccess($request) {
        // clear sessions
        $_SESSION['access_token'] = "";
        $_SESSION['oauth_user_verified'] = false;
        $_SESSION['oauth_token'] = "";
        $_SESSION['oauth_token_secret'] = "";
        return $this->getDefaultUrl();
    }

    public function setFavorite($id) {
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
        $response = $connection->post('favorites/create', ['id' => $id]);
        if(property_exists($response, "errors")) {
            $newResponse = $connection->post('favorites/destroy', ['id' => $id]);
            return $newResponse;
        } else {
            return $response;
        }
    }

    public function getTweets($count) {
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
        $tweets = $connection->get('statuses/user_timeline', ["count" => $count]);
        return $this->mapTweets($tweets);
    }
    
    public function getDefaultUrl() {
		return 'index.php?module='.$this->get('name').'&view='.$this->getDefaultViewName();
    }
    
    public function getDefaultViewName() {
        return 'Index';
    }

    public function mapTweets($tweets) {
        $tmp = [];
        foreach($tweets as $key => $tweet) {
            $tmp[$key]['id'] = $tweet->id;
            $tmp[$key]['created_at'] = (new DateTime($tweet->created_at))->format('d-m-Y H:i:s');
            $tmp[$key]['favorited'] = $tweet->favorited == false ? "-" : $tweet->favorite_count;
            $tmp[$key]['retweeted'] = $tweet->retweeted == false ? "-" : $tweet->retweet_count;
            $tmp[$key]['text'] = $tweet->text;
            $tmp[$key]['url'] = "https://twitter.com/" . $tweet->user->screen_name . "/status/" . $tweet->id;
        }
        return $tmp;
    }
}