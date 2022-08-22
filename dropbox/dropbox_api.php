<?php

class DropBox{
    
    private $apiKey;
    
    function __construct($apiKey) {
        
        $this->apiKey = $apiKey;
    }
    
    function set_profile_photo($base64_data){
       $url = "https://api.dropboxapi.com/2/account/set_profile_photo";

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array('photo'=>array(".tag"=>"base64_data", "base64_data"=>$base64_data))));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$this->apiKey
		
	));
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

return $response;
    
    }
    
    function add_properties($file_path, $fields, $template_id){
       $url = "https://api.dropboxapi.com/2/file_properties/properties/add";

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array('path'=>$file_path, 'property_groups'=>array("fields"=>$fields, "template_id"=>$template_id))));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$this->apiKey
		
	));
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

return $response;
    
    }
     
    function overwrite_properties($file_path, $fields, $template_id){
       $url = "https://api.dropboxapi.com/2/file_properties/properties/overwrite";

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array('path'=>$file_path, 'property_groups'=>array("fields"=>$fields, "template_id"=>$template_id))));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$this->apiKey
		
	));
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

return $response;
    
    }
    
    function list_folder($path){
       $url = "https://api.dropboxapi.com/2/files/list_folder";

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array('include_deleted'=>'false', 'include_has_explicit_shared_members'=>'false', 'include_media_info'=>'false', 'include_mounted_folders'=>'true', 'include_non_downloadable_files'=>'true', 'path'=>$path, 'recursive'=>'false')));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$this->apiKey
		
	));
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

return $response;
    
    }
     
    function create_folder($path){
       $url = "https://api.dropboxapi.com/2/files/create_folder_v2";

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array('autorename'=>'false', 'path'=>$path)));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$this->apiKey
		
	));
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

return $response;
    
    }
     
    function search($path, $query){
       $url = "https://api.dropboxapi.com/2/files/search_v2";

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array('match_field_options'=>array('include_highlights'=>'false'),'options'=>array('file_status'=>'active', 'filename_only'=>'false', 'max_results'=>'20', 'path'=>$path), 'query'=>$query)));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$this->apiKey
		
	));
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

return $response;
    
    }
     
    function get_account($account_id){
       $url = "https://api.dropboxapi.com/2/users/get_account";

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array('account_id'=>$account_id)));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$this->apiKey
		
	));
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

return $response;
    
    }
     
    function get_space_usage(){
       $url = "https://api.dropboxapi.com/2/users/get_space_usage";

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array('account_id'=>'')));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$this->apiKey
		
	));
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

return $response;
    
    } 
    
    function get_current_account(){
       $url = "https://api.dropboxapi.com/2/users/get_current_account";

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array('account_id'=>'')));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$this->apiKey
		
	));
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

return $response;
    
    }
     
    
    
    function mount_folder($shared_folder_id){
       $url = "https://api.dropboxapi.com/2/sharing/mount_folder";

	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array('shared_folder_id'=>$shared_folder_id)));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer '.$this->apiKey
		
	));
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

return $response;
    
    }
     
    
    
}
?>