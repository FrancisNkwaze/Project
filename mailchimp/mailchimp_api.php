<?php

class MailChimp{
    
    private $client;
    
    function __construct($apiKey, $serverPrefix) {
        
       require_once '../lib/mailchimp/vendor/autoload.php';
        $client = new MailchimpMarketing\ApiClient();
        $client->setConfig([
        'apiKey' => $apiKey,
        'server' => $serverPrefix,
        ]);
        
        $this->client = $client;
    }
    
    function ListApiRoot(){
        return $this->client->root->getRoot();
    }
    
    function ListAccountExports(){
        return $this->client->accountExports->listAccountExports();
    }
    
    function AddExport($audiences, $gallery_files){
        return $this->client->accountExports->createAccountExport([
    "include_stages" => "[\"".$audiences."\", \"".$gallery_files."\"]",
        ]);
    }
    
    function GetAccountExportInfo($export_id){
        return $this->client->accountExport->getAccountExports($export_id);
    }
    
    function ListAuthorizedApps(){
        return $this->client->authorizedApps->list();
    }
    
    function GetAuthorizedAppInfo($app_id){
        return $this->client->authorizedApps->get($app_id);
    }
    
    function ListAutomations(){
        return $this->client->automations->list();
    }
    
    function AddAutomation($list_id, $workflow_type){
        return $this->client->automations->create([
    "recipients" => [$list_id],
    "trigger_settings" => ["workflow_type" => $workflow_type],
]);
    }
    
    function GetAutomationInfo($workflow_id){
        return $this->client->automations->get($workflow_id);
    }
    
    function StartAutomationEmails($workflow_id){
        return $this->client->automations->startAllEmails($workflow_id);
    }
    
    function PauseAutomationEmails($workflow_id){
        return $this->client->automations->pauseAllEmails($workflow_id);
    }
    
    function ListAutomatedEmails($workflow_id){
        return $this->client->automations->listAllWorkflowEmails($workflow_id);
    }
    
    function GetWorkflowEmailInfo($workflow_id, $workflow_email_id){
        return $this->client->automations->getWorkflowEmail($workflow_id,
    $workflow_email_id);
    }
    
    function DeleteWorkflowEmail($workflow_id, $workflow_email_id){
        return $this->client->automations->deleteWorkflowEmail($workflow_id, $workflow_email_id);
    }
    
    function UpdateWorkflowEmail($workflow_id, $workflow_email_id, $delay){
        return $this->client->automations->updateWorkflowEmail($workflow_id, $workflow_email_id, $delay);
    }
    
    function PauseAutomatedEmail($workflow_id, $workflow_email_id){
        return $this->client->automations->pauseWorkflowEmail($workflow_id, $workflow_email_id);
    }
    
    function StartAutomatedEmail($workflow_id, $workflow_email_id){
        return $this->client->automations->startWorkflowEmail($workflow_id, $workflow_email_id);
    }
    
    function ListAutomatedEmailSubscribers($workflow_id, $workflow_email_id){
        return $this->client->automations->getWorkflowEmailSubscriberQueue($workflow_id, $workflow_email_id);
    }
    
    function AddSubscriberToWorkflowEmail($workflow_id, $workflow_email_id, $email){
        return $this->client->automations->addWorkflowEmailSubscriber($workflow_id, $workflow_email_id, $email);
    }
    
    function GetAutomatedEmailSubscriber($workflow_id, $workflow_email_id, $subscriber_hash){
        return $this->client->automations->getWorkflowEmailSubscriber($workflow_id, $workflow_email_id, $subscriber_hash);
    }
    
    
    
    
}
?>