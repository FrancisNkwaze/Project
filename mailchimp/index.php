<?php
include '../connect.php';
include '../functions.php';
include '../user_settings.php';
include '../token_usage.php';
include 'mailchimp_api.php';
header("Content-Type:application/json");


$token=filterPost($_GET['token']);
$user_id = get_user_from_token($token);
$settings = new UserSettings($user_id, $dblink);
log_request($token, $user_id);
$usage = new TokenUsage($token, $dblink);

$mailchimp = new MailChimp($settings->getMailchimp_apikey(), $settings->getMailchimp_server_prefix());


$endpoint= filterPost($_GET["arg1"]);

switch($endpoint){
    case "ListApiRoot":
        $resp = json_encode($mailchimp->ListApiRoot());
        break;
        
    case "ListAccountExports":
        $resp = json_encode($mailchimp->ListAccountExports());
        break;
        
    case "AddExport":
        $audiences = filterPost($_GET["arg2"]);
        $gallery_files = filterPost($_GET["arg3"]);
        $resp = json_encode(AddExport($audiences, $gallery_files));
        break;
        
    case "GetAccountExportInfo":
        $export_id = filterPost($_GET["arg2"]);
        $resp = json_encode(GetAccountExportInfo($export_id));
        break;
        
    case "ListAutomations":
        $resp = json_encode($mailchimp->ListAuthorizedApps());
        break;
        
    case "GetAuthorizedAppInfo":
        $app_id  = filterPost($_GET["arg2"]);
        $resp = json_encode($mailchimp->GetAuthorizedAppInfo($app_id));
        break;
        
    case "ListAuthorizedApps":
        $resp = json_encode($mailchimp->ListAuthorizedApps());
        break;
        
    case "AddAutomation":
        $list_id  = filterPost($_GET["arg2"]);
        $workflow_type  = filterPost($_GET["arg3"]);
        $resp = json_encode($mailchimp->AddAutomation($list_id, $workflow_type));
        break;
        
    case "GetAutomationInfo":
        $workflow_id  = filterPost($_GET["arg2"]);
        $resp = json_encode($mailchimp->GetAutomationInfo($workflow_id));
        break;
        
    case "StartAutomationEmails":
        $workflow_id  = filterPost($_GET["arg2"]);
        $resp = json_encode($mailchimp->StartAutomationEmails($workflow_id));
        break;
        
    case "PauseAutomationEmails":
        $workflow_id  = filterPost($_GET["arg2"]);
        $resp = json_encode($mailchimp->PauseAutomationEmails($workflow_id));
        break;
        
    case "ListAutomatedEmails":
        $workflow_id  = filterPost($_GET["arg2"]);
        $resp = json_encode($mailchimp->ListAutomatedEmails($workflow_id));
        break;
        
    case "GetWorkflowEmailInfo":
        $workflow_id  = filterPost($_GET["arg2"]); 
        $workflow_email_id  = filterPost($_GET["arg3"]);
        $resp = json_encode($mailchimp->GetWorkflowEmailInfo($workflow_id, $workflow_email_id));
        break;
        
    case "DeleteWorkflowEmail":
        $workflow_id  = filterPost($_GET["arg2"]);
        $workflow_email_id  = filterPost($_GET["arg3"]);
        $resp = json_encode($mailchimp->DeleteWorkflowEmail($workflow_id, $workflow_email_id));
        break;
        
    case "UpdateWorkflowEmail":
        $workflow_id  = filterPost($_GET["arg2"]);
        $workflow_email_id  = filterPost($_GET["arg3"]); 
        $delay  = filterPost($_GET["arg4"]);
        $resp = json_encode($mailchimp->UpdateWorkflowEmail($workflow_id, $workflow_email_id, $delay));
        break;
        
    case "PauseAutomatedEmail":
        $workflow_id  = filterPost($_GET["arg2"]);
        $workflow_email_id  = filterPost($_GET["arg3"]);
        $resp = json_encode($mailchimp->PauseAutomatedEmail($workflow_id, $workflow_email_id));
        break;
        
    case "StartAutomatedEmail":
        $workflow_id  = filterPost($_GET["arg2"]); 
        $workflow_email_id  = filterPost($_GET["arg3"]);
        $resp = json_encode($mailchimp->StartAutomatedEmail($workflow_id, $workflow_email_id));
        break;
        
    case "ListAutomatedEmailSubscribers":
        $workflow_id  = filterPost($_GET["arg2"]); 
        $workflow_email_id  = filterPost($_GET["arg3"]);
        $resp = json_encode($mailchimp->ListAutomatedEmailSubscribers($workflow_id, $workflow_email_id));
        break;
        
    case "AddSubscriberToWorkflowEmail":
        $workflow_id = filterPost($_GET["arg2"]);
        $workflow_email_id = filterPost($_GET["arg3"]); 
        $email = filterPost($_GET["arg4"]);
        $resp = json_encode($mailchimp->AddSubscriberToWorkflowEmail($workflow_id, $workflow_email_id, $email));
        break;
        
    case "GetAutomatedEmailSubscriber":
        $workflow_id  = filterPost($_GET["arg2"]); 
        $workflow_email_id  = filterPost($_GET["arg3"]); 
        $subscriber_hash  = filterPost($_GET["arg4"]);
        $resp = json_encode($mailchimp->GetAutomatedEmailSubscriber($workflow_id, $workflow_email_id, $subscriber_hash));
        break;
        
    default:
        $resp = json_encode(array('status'=>"error", 'message'=>"invalid parameters passed"));
        
        
}

echo $resp;
?>