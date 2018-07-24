<?php

require 'modules/Tweet/twitteroauth/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

class Tweet_Save_Action extends Vtiger_Save_Action {
    
    public function process(Vtiger_Request $request) 
    {
        $connection = new TwitterOAuth('Qjwzz8XAvnd8xFktYKvTCJCFn', 'HhU1xvhZvxztU9Ay3oiUCXwSoRAw910T793V7R9tBZ40ArMZ9q', '1411207512-IH6nB0jTEvSCKnLS5aOi1zt5iQr8GfekppH0hQD', 'n562AO2fsaieK9JqHxRy2K8Lwrfh26YyQ7IqgkfHwrIum');
        $status = $connection->get("statuses/show/968029819912024064"); 
        // var_dump($status);
        // var_dump($request);
        $request->set('tweeturl', "http://www.twitter.com/" . $status->user->screen_name . "/status/" . $status->id_str);
        parent::process($request);
    }
}