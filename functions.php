<?php

function encryptPassword($password){
	//this function utilises bcrypt to hash the password for security
	$hashedPass = password_hash($password, PASSWORD_DEFAULT);
	return $hashedPass;
}

function filterPost($post_data){
	//filter post content
	include("connect.php");
	$post_data = strip_tags(htmlspecialchars(trim($post_data)));
	$post_data = mysqli_real_escape_string($dblink,$post_data);
	return $post_data;
}

//login function for users
function user_login($email, $password){
	include "connect.php";
    
	$email = filterPost($email);
	$password = filterPost($password);
	if($email=='' || $password==''){
		 exit();
	}
		
		$dbquery = "SELECT * FROM users WHERE email='$email'";
		$qresult = mysqli_query($dblink, $dbquery);
		 while($tbrow = mysqli_fetch_assoc($qresult)){
		$hashed_pass[] = $tbrow['password'];
			 $user_id[]= $tbrow["id"];
			 
         }
if(password_verify($password, @$hashed_pass[0])){ 
    
		setcookie("user_id", $user_id[0], time() + 86400, "/");
        setcookie("user_hash", $hashed_pass[0], time() + 86400, "/");
   
      header("location:myaccount.php"); 
    }else{
			
return "Email or Password not correct";
		}
}

function logout(){
    setcookie("user_id", "", time() - 86400, "/");
        setcookie("user_hash", "", time() - 86400, "/");
}

//Function to check if user already exists
function check_user($email){
    include "connect.php";
    $dbquery = "SELECT * FROM users WHERE email='$email'";
		$qresult = mysqli_query($dblink, $dbquery);
		 while($tbrow = mysqli_fetch_assoc($qresult)){
		$hashed_pass[] = $tbrow['password'];
			 $user_id[]= $tbrow["id"]; 
         }
    if(!empty($user_id)){
        return $user_id[0];
    }else{
        return "";
    }
}


// function to add new member
function user_registration($name, $email, $phone, $password)
    	{
			include "connect.php";
            
			$public_key = randomCode(30);
    $sqlgn = "INSERT INTO users (name, email, phone, password, public_key) VALUES('$name', '$email','$phone','$password','$public_key')";
    $querygn = mysqli_query($dblink,$sqlgn);
			
    	}

// function to create token
function create_token($token_limit, $user_id)
    	{
			include "connect.php";
                	
			$token = randomCode(30);
    $sqlgn = "INSERT INTO tokens (user_id, token, token_limit) VALUES('$user_id', '$token','$token_limit')";
    $querygn = mysqli_query($dblink,$sqlgn);
			
    	}

// function to log requests
function log_request($token, $user_id)
    	{
			include "connect.php";
                	
			$time = time();
    $sqlgn = "INSERT INTO token_requests (user_id, token, time) VALUES('$user_id', '$token','$time')";
    $querygn = mysqli_query($dblink,$sqlgn);
			
    	}

// function to get user from token
function get_user_from_token($token)
    	{
			include "connect.php";
           
    $sqlgn = "SELECT user_id FROM tokens WHERE token='$token'";
    $querygn = mysqli_query($dblink,$sqlgn);
			while($tbrow = mysqli_fetch_assoc($querygn)){
			 $user_id[]= $tbrow["user_id"];
         }
            return $user_id[0];
    	}

// function to save user settings
function save_settings($user_id, $mailchimp_apikey, $mailchimp_server_prefix, $dropbox_token)
    	{
			include "connect.php";
            
    $sqlgn = "INSERT INTO settings (user, mailchimp_apikey, mailchimp_server_prefix, dropbox_token) VALUES('$user_id', '$mailchimp_apikey', '$mailchimp_server_prefix', '$dropbox_token')";
    $querygn = mysqli_query($dblink,$sqlgn);
			
    	}

// function to update user settings
function update_settings($user_id, $mailchimp_apikey, $mailchimp_server_prefix, $dropbox_token)
    	{
			include "connect.php";
            
    $sqlgn = "UPDATE settings SET mailchimp_apikey='".$mailchimp_apikey."', mailchimp_server_prefix='".$mailchimp_server_prefix."', dropbox_token='".$dropbox_token."' WHERE user=".$user_id;
    $querygn = mysqli_query($dblink,$sqlgn);
			
    	}

function randomCode($length) {
	//we hope to use this function generate referral codes in referrals.inc.php
    $pool = array_merge(range(0,9), range('a', 'z'));

$key='';
    for($i=0; $i < $length; $i++) {
        $key .= $pool[mt_rand(0, count($pool) - 1)];
    }
    return $key;
}


?>