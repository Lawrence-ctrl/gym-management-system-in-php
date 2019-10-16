<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   date_default_timezone_set('Asia/Rangoon');
   $owl = $conn->query("SELECT booking.*,plans.*,current.* FROM booking LEFT JOIN plans ON booking.bookuserplan = plans.plan_id LEFT JOIN current ON booking.bookduration = current.current_id WHERE booking.bookuser_email = '".$_SESSION['useremail']."' AND booking.bookuser_id='".$_SESSION['userid']."' AND booking.booked='0'");
   $gra = $owl->fetch_assoc();
   if(isset($_GET['del'])){
     $delete = $conn->query("DELETE FROM booking WHERE book_id = '".$gra['book_id']."'");
     if($delete){
       header("location:booking.php?succMsg");
     }
   }
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
        @media (min-width: 575.98px){
        .yawn {
          font-weight: 5px;
          font-size: 30px;
          position: absolute;
          top: 35%;
          right: 24%;
          text-align: center;
        }
        .yawn>p {
          font-weight: 3px;
          font-size: 20px;
          text-align: center;
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
              <h4 class="page-title">Cancel Booking</h4>
           
             </div>
              <hr>
                 <?php if(isset($GET['succMsg'])){
                 echo "<div class='alert alert-success alert-dismissible fade show err'> <button type='button' class='close' data-dismiss='alert'>&times;</button>Your booking is sent to admin successfully! 
                              </div>";
                  }?>
                        <div class="yawn">
                          <i>You booked <strong><?php echo $gra['plan_name']?>KS</strong> for <strong><?php echo $gra['current_name']?></strong>!</i>
                          <p>If you want to cancel your booking, click this button
                           <a onclick="return confirm('Are you sure you want to cancel your booking?')" href="cancelbooking.php?del" name="bocan" class="btn btn-danger btn-md">Cancel Booking</a>
                         </p>
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
