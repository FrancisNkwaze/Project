<?php

class TokenUsage{
    private $token;
    private $token_limit;
    private $request_per_second;
    private $request_per_minute;
    private $request_per_hour;
    private $request_per_day;
    private $request_per_month;
    private $request_time;
  
    
    function __construct($token, $dblink) {
        include 'token_limits.php';
        $dbquery = "SELECT * FROM tokens WHERE token='".$token."'";
		$qresult = mysqli_query($dblink, $dbquery);
		 while($tbrow = mysqli_fetch_assoc($qresult)){
			 $token_limit[]= $tbrow["token_limit"];			 
         }
        
        $this->token = $token;
        $this->token_limit = $token_limit[0];
        
        $limits = new TokenLimits($dblink);
        $this->request_per_second =  $limits->getRequestPerSecond($this->token_limit);
        $this->request_per_minute =  $limits->getRequestPerMinute($this->token_limit);
        $this->request_per_hour =  $limits->getRequestPerHour($this->token_limit);
        $this->request_per_day =   $limits->getRequestPerDay($this->token_limit);
        $this->request_per_month =  $limits->getRequestPerMonth($this->token_limit);
        
        $dbquery2 = "SELECT * FROM token_requests WHERE token='".$token."'";
		$qresult2 = mysqli_query($dblink, $dbquery2);
		 while($tbrow2 = mysqli_fetch_assoc($qresult2)){
			 $request_time[]= $tbrow2["time"];			 
         }
        
        $this->request_time = $request_time;
        
    }
    
    
    function usagePerSecond(){
        $request_count=0;
        
        for($i=count($this->request_time)-1; $i>=0; $i--){
            if($this->request_time[$i]==time()){
                $request_count +=1;
            }
        }
        
        return $request_count;
    }
    
    function usagePerMinute(){
        $request_count=0;
        $last_minute = strtotime("last Minute");
        $this_minute = strtotime("this Minute");
        
        for($i=count($this->request_time)-1; $i>=0; $i--){
            if($this->request_time[$i]>=$last_minute && $this->request_time[$i]<=$this_minute){
                $request_count +=1;
            }
        }
        
        return $request_count;
    }
    
    function usagePerHour(){
        $request_count=0;
        $last_hour = strtotime("last Hour");
        $this_hour = strtotime("this Hour");
        
        for($i=count($this->request_time)-1; $i>=0; $i--){
            if($this->request_time[$i]>=$last_hour && $this->request_time[$i]<=$this_hour){
                $request_count +=1;
            }
        }
        
        return $request_count;
    }
    
    function usagePerDay(){
        $request_count=0;
        $last_day = strtotime("last Day");
        $this_day = strtotime("this Day");
        
        for($i=count($this->request_time)-1; $i>=0; $i--){
            if($this->request_time[$i]>=$last_day && $this->request_time[$i]<=$this_day){
                $request_count +=1;
            }
        }
        
        return $request_count;
    }
    
    function usagePerMonth(){
        $request_count=0;
        $last_month = strtotime("last Month");
        $this_month = strtotime("this Month");
        
        for($i=count($this->request_time)-1; $i>=0; $i--){
            if($this->request_time[$i]>=$last_month && $this->request_time[$i]<=$this_month){
                $request_count +=1;
            }
        }
        
        return $request_count;
    }
    
    function checkUsagePerSecond(){
        $status="";
        if($this->usagePerSecond()>=$this->$request_per_second){
            $status="Limit exceeded";
        }
        return $status;
    }
    
    function checkUsagePerMinute(){
        $status="";
        if($this->usagePerMinute()>=$this->$request_per_minute){
            $status="Limit exceeded";
        }
        return $status;
    }
    
    function checkUsagePerHour(){
        $status="";
        if($this->usagePerHour()>=$this->$request_per_hour){
            $status="Limit exceeded";
        }
        return $status;
    }
    
    function checkUsagePerDay(){
        $status="";
        if($this->usagePerDay()>=$this->$request_per_day){
            $status="Limit exceeded";
        }
        return $status;
    }
    
    function checkUsagePerMonth(){
        $status="";
        if($this->usagePerMonth()>=$this->$request_per_month){
            $status="Limit exceeded";
        }
        return $status;
    }
    
    
    
   
    
}
?>