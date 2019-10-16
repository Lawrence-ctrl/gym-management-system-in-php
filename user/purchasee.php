<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
    $che = $conn->query("SELECT trainers.*,plans.*,t_current.* FROM trainers LEFT JOIN plans ON trainers.trainer_exer_id = plans.plan_id LEFT JOIN t_current ON trainers.t_duration = t_current.t_id WHERE trainer_email = '".$_SESSION['useremail']."' AND user_id='".$_SESSION['userid']."'");
    $cher = $che->fetch_assoc();
   $x = 0;
   date_default_timezone_set('Asia/Rangoon');
   $current = strtotime(date('Y-m-d H:i:s'));
   $time = strtotime(date($cher['tend_date']));
   $lol = $time - $current;
   $x = abs(floor($lol/(60*60*24)));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <title>G M S</title>
  <link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>
  <!-- <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en"> 
  <style>
        .zawgyi{
            font-family:Zawgyi-One;
        }
        .unicode{
            font-family:Myanmar3,Yunghkio,'Masterpiece Uni Sans';
        }
        @media(min-width: 575.98px) {
        .hello {
             position: absolute;
             top: 20%;
             right: 45%;
             font-weight: 10px;
             font-size: 30px;
             padding-top: 50px;
             padding-bottom: 50px; 
        }
        .cru{
          position: absolute;
          padding-top: 10rem;
          left: 22%;
          box-shadow: 2px 2px 18px -2px #337AB7;

        }
      }
      @media(max-width: 575.98px) {
       
        .hello{
          padding-left: 8rem;
        }
       
      }
  </style>
  <!-- Fonts and icons -->
  <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/azzara.css">
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css">
  <link rel="stylesheet" href="assets/css/my.css">
</head>
<body>
  <div class="wrapper">
    <!--
        Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
    -->
  
      <!-- End Logo Header -->

      <!-- Navbar Header -->
    <?php include('includes/usernavbar.php');?>
      <!-- End Navbar -->
    
    <!-- Sidebar -->
    <?php include('includes/usersidebar.php');?>
     <!-- End sidebar -->

    <div class="main-panel">
      <div class="content">
        <div class="page-inner">
          <!-- Card -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h4 class="page-title">Work Time</h4>
          </div>
              <hr>
           
                    <div class="row">
                      <p class="hello"><i class="text-info" style="font-size: 60px;"><?php echo $x;?></i>  Days left</p>
                    </div>   
                <div class="col-md-6 cru">
                  <div class="table-responsive">
                   <table class="table table-striped table-info">
                      <tr>
                         <td width="30%" style="text-align: center;">ID:</td>
                         <td style="text-align: center;"><?php echo $cher['trainer_id']?></td>
                      </tr>
                      <tr>
                        <td width="30%" style="text-align: center;">Plan:</td>
                        <td style="text-align: center;"><?php echo $cher['plan_name']?></td>
                      </tr>
                      <tr>
                        <td width="30%" style="text-align: center;">Duration:</td>
                        <td style="text-align: center;"><?php echo $cher['tc_name']?></td>
                      </tr>
                      <tr>
                        <td width="30%" style="text-align: center;">Fees</td>
                        <td style="text-align: center;"><?php echo $cher['trainer_fees'];?> Per Month</td>
                      </tr>
                      <tr>
                        <td width="30%" style="text-align: center;">Start Date:</td>
                        <td style="text-align: center;"><?php echo $cher['tstart_date']?></td>
                      </tr>
                      <tr>
                        <td width="30%" style="text-align: center;">End Date:</td>
                        <td style="text-align: center;"><?php echo $cher['tend_date']?></td>
                      </tr>

                   </table>
                </div>
                  </div>       
   
        </div>
      </div>
      
    </div>
  
    <!-- Custom template | don't include it in your project! -->
    <?php include('includes/usersettings.php');?>
    
    <!-- End Custom template -->
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.3.2.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <!-- jQuery UI -->
  <script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
  <!-- Bootstrap Toggle -->
  <script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- Azzara JS -->
  <script src="assets/js/ready.min.js"></script>
  <!-- Azzara DEMO methods, don't include it in your project! -->
  <script src="assets/js/setting-demo.js"></script>
</body>
</html>
