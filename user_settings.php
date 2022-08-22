<?php

class UserSettings{
    
    private $mailchimp_apikey="";
    private $mailchimp_server_prefix="";
    private $dropbox_token="";
    private $check_settings;
    
    function __construct($user_id, $dblink) {
        
        $dbquery = "SELECT * FROM settings WHERE user=".$user_id;
		$qresult = mysqli_query($dblink, $dbquery);
		 while($tbrow = mysqli_fetch_assoc($qresult)){
			 $mailchimp_apikey[]= $tbrow["mailchimp_apikey"];
			 $mailchimp_server_prefix[]= $tbrow["mailchimp_server_prefix"];
			 $dropbox_token[]= $tbrow["dropbox_token"]; 
         }
        if(!empty($mailchimp_apikey)){
        $this->mailchimp_apikey = $mailchimp_apikey[0];
        $this->mailchimp_server_prefix = $mailchimp_server_prefix[0];
        $this->dropbox_token = $dropbox_token[0];
        $this->check_settings = 1;
        }else{
            $this->check_settings = 0;
        }
    }
    
    function getMailchimp_apikey(){
        return $this->mailchimp_apikey;
    }
    
    function getMailchimp_server_prefix(){
        return $this->mailchimp_server_prefix;
    }
    
    function getDropbox_token(){
        return $this->dropbox_token;
    }
    
    function check_settings(){
        return $this->check_settings;
    }
    
}
?>