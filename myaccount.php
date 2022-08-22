<?php
include 'connect.php';
include 'token_limits.php';
include 'tokens.php';
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

             $dbquery2 = "SELECT * FROM token_requests WHERE user_id=".$_COOKIE["user_id"];
		$qresult2 = mysqli_query($dblink, $dbquery2);
		 while($tbrow2 = mysqli_fetch_assoc($qresult2)){
			 $request_time[]= $tbrow2["time"];			 
         }
        

$user_tokens= new Token($user->getUserId(), $dblink);
$tokenslimits = new TokenLimits($dblink);

$usage_6monthsago=0;
$usage_5monthsago=0;
$usage_4monthsago=0;
$usage_3monthsago=0;
$usage_2monthsago=0;
$usage_1monthsago=0;
$usage_thismonth=0;
$usage_nextmonth=0;

if(isset($request_time)){
for($i=0; $i<count($request_time); $i++){
            $month = date("M-Y", $request_time[$i]);
            
            switch($month){
                    
                 case date("M-Y", strtotime("6 months ago")):
                    $usage_6monthsago +=1;
                    break;
                    
                 case date("M-Y", strtotime("5 months ago")):
                    $usage_5monthsago +=1;
                    break;
                    
                 case date("M-Y", strtotime("4 months ago")):
                    $usage_4monthsago +=1;
                    break;
                    
                 case date("M-Y", strtotime("3 months ago")):
                    $usage_3monthsago +=1;
                    break;
                    
                 case date("M-Y", strtotime("2 months ago")):
                    $usage_2monthsago +=1;
                    break;
                     
                 case date("M-Y", strtotime("1 month ago")):
                    $usage_1monthsago +=1;
                    break;
                    
                 case date("M-Y", strtotime("this month")):
                    $usage_thismonth +=1;
                    break;
            }
            }
              
        }
        
$month6 = date("M-Y", strtotime("6 months ago"));
$month5 = date("M-Y", strtotime("5 months ago"));
$month4 = date("M-Y", strtotime("4 months ago"));
$month3 = date("M-Y", strtotime("3 months ago"));
$month2 = date("M-Y", strtotime("2 months ago"));
$month1 = date("M-Y", strtotime("2 months ago"));
$thismonth = date("M-Y", strtotime("this month"));
$nextmonth = date("M-Y", strtotime("+1 month"));
		
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API-SaaS - Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b><?php echo $user->getName(); ?></b></p>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
                        <h2 class="tm-block-title">Token Usage</h2>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
               
                <div class="col-sm-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Tokens</h2>
                       
                            <a href="newtoken.php" class="btn btn-success btn-sm">Create new token</a>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">TOKEN</th>
                                    <th scope="col">LIMIT TYPE</th>
                                    <th scope="col">ACTION</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for($i=0; $i<$user_tokens->countToken(); $i++){
                                    $token_limit = $user_tokens->getTokenLimit($i);
                                ?>
                                <tr>
                                   
                                   
                                    <td><?php echo $user_tokens->getToken($i); ?></td>
                                    <td><?php echo $tokenslimits->getTokenLimitName($token_limit); ?></td>
                                    <td><form action="check_usage.php" method="post">
                                        <input type="hidden" name="token" value="<?php echo $user_tokens->getToken($i); ?>">
                                        <button class="btn btn-warning btn-sm">Check Usage</button>
                                        </form>
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
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <script src="js/tooplate-scripts.js"></script>
    <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
       
        // DOM is ready
         if ($("#lineChart").length) {
    ctxLine = document.getElementById("lineChart").getContext("2d");
    optionsLine = {
      scales: {
        yAxes: [
          {
            scaleLabel: {
              display: true,
              labelString: "Hits"
            }
          }
        ]
      }
    };

    // Set aspect ratio based on window width
    optionsLine.maintainAspectRatio =
      $(window).width() < width_threshold ? false : true;

    configLine = {
      type: "line",
      data: {
        labels: [
          "<?php echo $month5; ?>",
          "<?php echo $month4; ?>",
          "<?php echo $month3; ?>",
          "<?php echo $month2; ?>",
          "<?php echo $month1; ?>",
          "<?php echo $thismonth; ?>",
          "<?php echo $nextmonth; ?>"
        ],
        datasets: [
          {
            label: "Requests",
            data: [<?php echo $usage_5monthsago; ?>, <?php echo $usage_4monthsago; ?>, <?php echo $usage_3monthsago; ?>, <?php echo $usage_2monthsago; ?>, <?php echo $usage_1monthsago; ?>, <?php echo $usage_thismonth; ?>, <?php echo $usage_nextmonth; ?>],
            fill: false,
            borderColor: "rgb(75, 192, 192)",
            cubicInterpolationMode: "monotone",
            pointRadius: 0
          }
        ]
      },
      options: optionsLine
    };

    lineChart = new Chart(ctxLine, configLine);
  }
    </script>
</body>

</html>