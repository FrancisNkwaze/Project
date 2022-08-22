<?php
require 'functions.php';

// handle member registration
if(isset($_POST['email'])){
    $name = filterPost($_POST['name']);
    $email = filterPost($_POST['email']);
    $phone = filterPost($_POST['phone']);
    $password = encryptPassword($_POST['password']);
    
    //check if member already exists
    if(check_user($email)==""){
    user_registration($name, $email, $phone, $password);
        header("location: login.php");
    }else{
        $response = "Email already exists! Login or use a different email";
    }
}
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>API-SaaS - Register</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto:400,700"
    />
    <!-- https://fonts.google.com/specimen/Open+Sans -->
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

  <body>
    <div>
      <nav class="navbar navbar-expand-xl">
        <div class="container h-100">
          <a class="navbar-brand" href="index.html">
            <h1 class="tm-site-title mb-0 text-center">API-SaaS</h1>
          </a>
         
        </div>
      </nav>
    </div>

    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-12 mx-auto tm-login-col">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12 text-center">
                   <?php
                if(isset($response)){ ?>
                <div class="alert alert-danger">
                <?php echo $response; ?> </div>
                <?php  } ?>
                <h2 class="tm-block-title mb-4">Create an account</h2>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form  method="post" class="tm-login-form">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control validate" id="name" value="" required />
                  </div>
                    <div class="form-group">
                    <label for="phone">Phone</label>
                    <input name="phone" type="text" class="form-control validate" id="phone" value="" required />
                  </div>
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control validate" id="email" value="" required />
                  </div>
                  <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input  name="password" type="password" class="form-control validate" id="password" value="" required />
                  </div>
                  <div class="form-group mt-4">
                    <button  type="submit" class="btn btn-primary btn-block text-uppercase"
                    > Register </button>
                  </div>
                 <a href="login.php" class="text-white">Already have an account? Login</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="tm-footer row tm-mt-small">
      <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
          Copyright &copy; <b>2022</b> All rights reserved. 
         
        </p>
      </div>
    </footer>
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
  </body>
</html>
