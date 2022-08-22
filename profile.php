<?php
include 'connect.php';
include 'users.php';
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

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>API-SaaS | Profile</title>
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
          <div class="tm-block-col tm-col-account-settings col-sm-12">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Account Details</h2>
              <form action="" class="tm-signup-form row">
                <div class="form-group col-lg-6">
                  <label for="name">Name</label>
                  <input id="name" name="name" type="text" value="<?php echo $user->getName(); ?>" disabled  class="form-control validate text-dark"   />
                </div>
                <div class="form-group col-lg-6">
                  <label for="email">Email</label>
                  <input  id="email"  name="email" type="email" class="form-control validate text-dark"
                  disabled value="<?php echo $user->getEmail(); ?>"/>
                </div>
                <div class="form-group col-lg-6">
                  <label for="phone">Phone</label>
                  <input   id="phone"  name="text"   type="phone"
                    class="form-control validate text-dark" disabled value="<?php echo $user->getPhone(); ?>"/>
                </div>
                <div class="form-group col-lg-6">
                  <label for="publicKey">Public Key</label>
                  <input id="publicKey"  name="public_key"   type="text" value="<?php echo $user->getPublicKey(); ?>" class="form-control validate text-dark" disabled />
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
