<?php

class TokenLimits{
    private $limit_id;
    private $limit_name;
    private $request_per_second;
    private $request_per_minute;
    private $request_per_hour;
    private $request_per_day;
    private $request_per_month;
    
  
    
    function __construct($dblink) {
        
        $dbquery = "SELECT * FROM token_limits";
		$qresult = mysqli_query($dblink, $dbquery);
		 while($tbrow = mysqli_fetch_assoc($qresult)){
			 $limit_id[]= $tbrow["id"];
			 $limit_name[]= $tbrow["limit_name"];
			 $request_per_second[]= $tbrow["requests_per_second"];
			 $request_per_minute[]= $tbrow["requests_per_minute"];
			 $request_per_hour[]= $tbrow["requests_per_hour"];
			 $request_per_day[]= $tbrow["requests_per_day"];
			 $request_per_month[]= $tbrow["requests_per_month"];
			 		 
         }
        
        if(!empty($limit_id)){
        $this->limit_id = $limit_id;
        $this->limit_name = $limit_name;
        $this->request_per_second = $request_per_second;
        $this->request_per_minute = $request_per_minute;
        $this->request_per_hour = $request_per_hour;
        $this->request_per_day = $request_per_day;
        $this->request_per_month = $request_per_month;
        }
        
    }
    
    function getTokenLimitName($limit_id){
        $index = array_search($limit_id, $this->limit_id);
        return $this->limit_name[$index];
    }
    
    function getRequestPerSecond($limit_id){
        $index = array_search($limit_id, $this->limit_id);
        return $this->request_per_second[$index];
    }
    
    function getRequestPerMinute($limit_id){
        $index = array_search($limit_id, $this->limit_id);
        return $this->request_per_minute[$index];
    }
    
    function getRequestPerHour($limit_id){
        $index = array_search($limit_id, $this->limit_id);
        return $this->request_per_hour[$index];
    }
    
    function getRequestPerDay($limit_id){
        $index = array_search($limit_id, $this->limit_id);
        return $this->request_per_day[$index];
    }
    
    function getRequestPerMonth($limit_id){
        $index = array_search($limit_id, $this->limit_id);
        return $this->request_per_month[$index];
    }
    
    function getLimitId($index){
        return $this->limit_id[$index];
    }
    
    function countAllLimits(){
        return count($this->request_per_month);
    }
    
    function listTokenLimits(){
        $options="";
        for($i=0; $i<$this->countAllLimits(); $i++){
            $options .="<option value='".$this->limit_id[$i]."'>".$this->limit_name[$i]."</option>";
        }
        return $options;
    }
    
    
}
?>