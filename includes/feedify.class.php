<?php

Class FeedifyAPI {


private $api_url = 'https://app.feedify.net/rest/v1/';


    private $domain;

    private $api_key;

    private $api_validation; //For quick 1-step registration


    function __construct($domain, $api_key, $api_validation = "Y") {

        $this->api_key = $api_key;

        $this->domain = $domain;

        $this->api_validation = $api_validation;

    }



    function FeedifyGetURL() {
        return $this->api_url;
    }



    function FeedifyGetPush($page = 1, $limit = 10) {

        try {

            $request_data = array(

                'page'=>$page,

                'limit'=>$limit

            );

            $data = $this->_call('push', 'POST', $request_data);

            return $data;

        } catch(Exception $e) {

            return false;

        }

    }



    function FeedifyGetReport($page = 1, $limit = 10) {

        try {

            $request_data = array(

                'page'=>$page,

                'limit'=>$limit

            );

            $data = $this->_call('reports', 'GET', $request_data);

            return $data;

        } catch(Exception $e) {

            return false;

        }

    }



    function FeedifySendPush($data) {

        try {

            $data = $this->_call('push', 'POST', $data);

            return true;

        } catch(Exception $e) {

            return false;

        }

    }



    function FeedifyStatus() {

        try {

            $data = $this->_call('status');

            return true;

        } catch(Exception $e) {

            return false;

        }

    }
    
   function FeedifyGetPkey($data) {

        try {
            $data = $this->_call('get_p_key', 'POST', $data);
            return $data;
        } catch(Exception $e) {

            return false;

        }

    }


    // start 
     function FeedifyCheckSubscribers() {

        try {

            $data = $this->_call('check_subscribers');
            return $data;
          
        } catch(Exception $e) {

            return false;

        }

    }


    // start - 08-04-2021-  -025-
       function FeedifyUpdateUserSubscription() {

        try {

            $data = $this->_call('update_user_subscription');
           
            return $data;
          
        } catch(Exception $e) {

            return false;

        }

    }
    //end  - 08-04-2021-  -025-

    // Added on 09-07-2024 by eid 044 START
    function FeedifyRegister($reqData) {

        try {
            $data = $this->_call('register', 'POST', $reqData);
            return $data;
        } catch(Exception $e) {
            return false;

        }

    }
    // Added on 09-07-2024 by eid 044 END


    private function _call( $endpoint, $method = 'GET', $data = false ) {
        $final_url = $this->api_url.$endpoint;
 
        if($method == 'POST') {

            $response = wp_remote_post($final_url, array(
                'method' => 'POST',
                'headers' => array( 
                    'X-domain-key' => $this->domain, 
                    'X-api-key' => $this->api_key,
                    'X-Api-Validate' => $this->api_validation
                ), 
                'body' => $data
                 )
            );
        }else{
            if(!empty($data)){
                $final_url .= '?'.http_build_query($data);
            }
            $args = array( 
                'headers' => array( 
                   'X-domain-key' => $this->domain, 
                   'X-api-key' => $this->api_key,
                   'X-Api-Validate' => $this->api_validation
                ) 
               ); 
            
            $response = wp_remote_get($final_url,  $args); 
        }

        $result = wp_remote_retrieve_body( $response );

        $data = json_decode($result);
        if($data->status == 'error') {
            throw ( new Exception($data->data) );
        }

        return $data->data;
    }

}
