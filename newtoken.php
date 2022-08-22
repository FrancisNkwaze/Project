<?php
include 'connect.php';
include 'token_limits.php';
include 'functions.php';
include 'users.php';

if(isset($_COOKIE["user_id"])){
$user = new User($_COOKIE["user_id"], $dblink);
$user_hash = $_COOKIE["user_hash"];
    if($user_hash != $user->getHash()){
        header("location:login.php");
    }
}else{
	header("location:login.php");
}

$tokenslimits = new TokenLimits($dblink);

if(isset($_POST['token_limit'])){
    $token_limit= filterPost($_POST['token_limit']);
    $user_id = $user->getUserId();
    create_token($token_limit, $user_id);
    header("location:myaccount.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>API-SaaS - New Token</title>
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
        <div class="row tm-content-row">
          <div class="col-12 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
              <h2 class="tm-block-title">Create New Token</h2>
                <form method="post" >
              <p class="text-white">Select Limit</p>
              <select class="custom-select" required name="token_limit">
                <option value="0">Select Token Limit</option>
                <?php echo $tokenslimits->listTokenLimits(); ?>
              </select>
                    <br><br>
                    <button class="btn btn-success">Submit</button>
                </form>
            </div>
          </div>
        </div>
        <!-- row -->
        <div class="row tm-content-row">
            
        <div class="col-sm-12">
          <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Tokens Limits Details</h2>
                       
                         
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">LIMIT NAME</th>
                                    <th scope="col">REQUESTS PER SECOND</th>
                                    <th scope="col">REQUESTS PER MINUTE</th>
                                    <th scope="col">REQUESTS PER HOUR</th>
                                    <th scope="col">REQUESTS PER DAY</th>
                                    <th scope="col">REQUESTS PER MONTH</th>
                                    
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for($i=0; $i<$tokenslimits->countAllLimits(); $i++){
                                    $limit_id = $tokenslimits->getLimitId($i);
                                ?>
                                <tr>
                                    <td>
                                       <?php echo $tokenslimits->getTokenLimitName($limit_id); ?>
                                    </td>
                                    <td>
                                       <?php echo $tokenslimits->getRequestPerSecond($limit_id); ?>
                                    </td>
                                   
                                    <td>
                                       <?php echo $tokenslimits->getRequestPerMinute($limit_id); ?>
                                    </td>
                                   
                                    <td>
                                       <?php echo $tokenslimits->getRequestPerHour($limit_id); ?>
                                    </td>
                                   
                                    <td>
                                       <?php echo $tokenslimits->getRequestPerDay($limit_id); ?>
                                    </td>
                                   
                                    <td>
                                       <?php echo $tokenslimits->getRequestPerMonth($limit_id); ?>
                                    </td>
                                   
                                    
                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
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
