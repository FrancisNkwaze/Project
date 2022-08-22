<?php
include 'connect.php';
include 'token_limits.php';
include 'tokens.php';
include 'users.php';
include 'user_settings.php';
include 'functions.php';


if(isset($_COOKIE["user_id"])){
$user = new User($_COOKIE["user_id"], $dblink);
$user_hash = $_COOKIE["user_hash"];
    if($user_hash != $user->getHash()){
        header("location:login.php");
    }
}else{
	header("location:login.php");
}

$user_settings= new UserSettings($user->getUserId(), $dblink);

if(isset($_POST['mailchimp_apikey'])){
    $mailchimp_apikey = filterPost($_POST['mailchimp_apikey']);
    $mailchimp_server_prefix = filterPost($_POST['mailchimp_server_prefix']);
    $dropbox_token = filterPost($_POST['dropbox_token']);
    $user_id = $user->getUserId();
    
    if($user_settings->check_settings()==0){
    save_settings($user_id, $mailchimp_apikey, $mailchimp_server_prefix, $dropbox_token);
    }else{
        update_settings($user_id, $mailchimp_apikey, $mailchimp_server_prefix, $dropbox_token);
    }
    
    $response = "Settings Saved!";
    $user_settings= new UserSettings($user->getUserId(), $dblink);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>API-SaaS - Settings</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
	Product Admin CSS Template
	https://templatemo.com/tm-524-product-admin
	-->
  </head>

  <body id="reportsPage">
    <div class="" id="home">
      <?php include 'header.php'; ?>
      <div class="container mt-5">
       
        <!-- row -->
        <div class="row tm-content-row">
         
          <div class="tm-block-col  col-sm-12">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Settings</h2>
                <?php
                if(isset($response)){ ?>
                <div class="alert alert-success text-center">
                <?php echo $response; ?> </div>
                <?php  } ?>
              <form  method="post" class="tm-signup-form row">
                <div class="form-group col-lg-6">
                  <label for="mailchimp_apikey">Mailchimp API Key <a href="https://us1.admin.mailchimp.com/account/api/" class="text-warning" style="font-size:8pt;" target="_blank">Get key here</a></label>
                  <input id="mailchimp_apikey" name="mailchimp_apikey" type="text"  class="form-control validate" placeholder="Mailchimp API Key" value="<?php echo $user_settings->getMailchimp_apikey(); ?>" />
                </div>
                
                <div class="form-group col-lg-6">
                  <label for="mailchimp_server_prefix">Mailchimp Server Prefix <i class="fa fa-info-circle" title="To find the value for the server parameter used in mailchimp.setConfig, log into your Mailchimp account and look at the URL in your browser. You’ll see something like https://us19.admin.mailchimp.com/; the us19 part is the server prefix. Note that your specific value may be different."></i></label>
                  <input id="mailchimp_server_prefix" name="mailchimp_server_prefix" type="text"  class="form-control validate" placeholder="Mailchimp Server Prefix" value="<?php echo $user_settings->getMailchimp_server_prefix(); ?>" />
                </div>
                
                <div class="form-group col-lg-6">
                  <label for="dropbox_token">Dropbox Token</label>
                  <input id="dropbox_token" name="dropbox_token" type="text"  class="form-control validate" placeholder="Dropbox Token" value="<?php echo $user_settings->getDropbox_token(); ?>" />
                </div>
                
                <div class="form-group col-lg-6">
                  <label class="tm-hide-sm">&nbsp;</label>
                  <button
                    type="submit"
                    class="btn btn-primary btn-block text-uppercase"
                  >
                    Save Settings
                  </button>
                </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>
     <?php include 'footer.php'; ?>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
