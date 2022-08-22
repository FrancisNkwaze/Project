<?php
include '../connect.php';
include '../functions.php';
include '../user_settings.php';
include '../token_usage.php';
include 'dropbox_api.php';
header("Content-Type:application/json");


$token=filterPost($_GET['token']);
$user_id = get_user_from_token($token);
$settings = new UserSettings($user_id, $dblink);
log_request($token, $user_id);
$usage = new TokenUsage($token, $dblink);

$dropbox = new DropBox($settings->getDropbox_token());
 
$endpoint= filterPost($_GET["arg1"]);

switch($endpoint){
    case "GetCurrentAccount":
        $resp = json_encode($dropbox->get_current_account());
        break;
        
    case "GetSpaceUsage":
        $resp = json_encode($dropbox->get_space_usage());
        break;
        
    case "GetAccount":
        $account_id = filterPost($_GET["arg2"]);
        $resp = json_encode($dropbox->get_account($account_id));
        break;
        
    case "MountFolder":
        $shared_folder_id = filterPost($_GET["arg2"]);
        $resp = json_encode($dropbox->mount_folder($shared_folder_id));
        break;
        
    case "Search":
        $path = filterPost($_GET["arg2"]);
        $query = filterPost($_GET["arg3"]);
        $resp = json_encode($dropbox->search($path, $query));
        break;
        
    case "CreateFolder":
        $path = filterPost($_GET["arg2"]);
        $resp = json_encode($dropbox->create_folder($path));
        break;
        
    case "ListFolder":
        $path = filterPost($_GET["arg2"]);
        $resp = json_encode($dropbox->list_folder($path));
        break;
        
    case "OverwriteProperties":
        $file_path = filterPost($_GET["arg2"]);
        $fields = filterPost($_GET["arg3"]);
        $template_id = filterPost($_GET["arg4"]);
        $resp = json_encode($dropbox->overwrite_properties($file_path, $fields, $template_id));
        break;
        
    case "AddProperties":
        $file_path = filterPost($_GET["arg2"]);
        $fields = filterPost($_GET["arg3"]);
        $template_id = filterPost($_GET["arg4"]);
        $resp = json_encode($dropbox->add_properties($file_path, $fields, $template_id));
        break;
       
        
    default:
        $resp = json_encode(array('status'=>"error", 'message'=>"invalid parameters passed"));
        
        
}

echo $resp;
?>