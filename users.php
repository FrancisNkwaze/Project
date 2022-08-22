<?php

class User{
    private $user_id;
    private $name;
    private $email;
    private $password;
    private $phone;
    private $public_key;
    
    function __construct($user_id, $dblink) {
        
        $dbquery = "SELECT * FROM users WHERE id=".$user_id;
		$qresult = mysqli_query($dblink, $dbquery);
		 while($tbrow = mysqli_fetch_assoc($qresult)){
			 $u_id[]= $tbrow["id"];
			 $u_name[]= $tbrow["name"];
			 $u_email[]= $tbrow["email"];
			 $u_phone[]= $tbrow["phone"];
			 $u_password[]= $tbrow["password"];
			 $u_public_key[]= $tbrow["public_key"];		 
         }
        
        $this->user_id = $u_id[0];
        $this->name = $u_name[0];
        $this->email = $u_email[0];
        $this->password = $u_password[0];
        $this->phone = $u_phone[0];
        $this->public_key = $u_public_key[0];
    }
    
    function getName(){
        return $this->name;
    }
    
    function getEmail(){
        return $this->email;
    }
    
    function getPhone(){
        return $this->phone;
    }
    
    function getUserId(){
        return $this->user_id;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function getHash(){
        return $this->password;
    }
    
    function getPublicKey(){
        return $this->public_key;
    }
    
}
?>