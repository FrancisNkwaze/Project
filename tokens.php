<?php

class Token{
    private $token;
    private $token_limit;
  
    
    function __construct($user_id, $dblink) {
        
        $dbquery = "SELECT * FROM tokens WHERE user_id=".$user_id;
		$qresult = mysqli_query($dblink, $dbquery);
		 while($tbrow = mysqli_fetch_assoc($qresult)){
			 $token[]= $tbrow["token"];
			 $token_limit[]= $tbrow["token_limit"];			 
         }
        
        $this->token = $token;
        $this->token_limit = $token_limit;
        
    }
    
    
    function getTokenLimit($index){
        return $this->token_limit[$index];
    }
    
    function getToken($index){
        return $this->token[$index];
    }
    
    function countToken(){
        return count($this->token);
    }
    
}
?>