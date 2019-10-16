<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   date_default_timezone_set('Asia/Rangoon');
  $ratedIndex = 0;
      $c = $ca=$car = $cc= $five=$four=$three=$two=$one=0;
    if(isset($_POST['saved'])) {
      $ratedIndex = $_POST['ratedIndex']+'1';
       $userid = $_SESSION['userid'];
       $crazz = $conn->query("SELECT * FROM rating WHERE user_id = '$userid'");
       if($crazz->num_rows > 0){
        $yell = $conn->query("UPDATE rating SET rating_number='$ratedIndex' WHERE user_id = '$userid'");
       }else{
       $yell = $conn->query("INSERT INTO rating (user_id,rating_number,created_date,updated_date) VALUES ('$userid','$ratedIndex',now(),now())");
     }
     exit(json_encode(array('code' => 100,'id' => $userid)));
    }

    $real = $conn->query("SELECT * FROM rating");
    $ca = $real->num_rows;
    while($row = mysqli_fetch_assoc($real)) {
      $c+=$row['rating_number'];
      $ca = $real->num_rows;
      if($ca > '0') {
      $cc = round($c/$ca,1);
    }
  }
  if($ca > 0){
  $rest = $conn->query("SELECT * FROM rating WHERE rating_number = '5'");
  $raw = $rest->num_rows;
  $five = number_format(($raw/$ca)*100,0);

  $fo = $conn->query("SELECT * FROM rating WHERE rating_number = '4'");
  $fou = $fo->num_rows;
  $four = number_format(($fou/$ca)*100,0);

  $th = $conn->query("SELECT * FROM rating WHERE rating_number = '3'");
  $thr = $th->num_rows;
  $three = number_format(($thr/$ca)*100,0);

  $t = $conn->query("SELECT * FROM rating WHERE rating_number = '2'");
  $tw = $t->num_rows;
  $two = number_format(($tw/$ca)*100,0);

  $o = $conn->query("SELECT * FROM rating WHERE rating_number = '1'");
  $on = $o->num_rows;
  $one = number_format(($on/$ca)*100,0);
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
        .y {
          color: gold;
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
  <link rel="stylesheet" href="assets/css/feedback.css">
  <link rel="stylesheet" href="assets/css/sweetalert.css">
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
              <h4 class="page-title">Feedback</h4>
          </div>
              <hr>
               <div class="rating-card">
    <div class="name"><h1>Rating</h1></div>
    <div class="rating">
      <h2 class="hh"><?php echo $cc;?></h2>
      <i aria-hidden="true" class="fa fa-star z fa-lg" data-index='0'></i>
      <i aria-hidden="true" class="fa fa-star z fa-lg" data-index='1'></i>
      <i aria-hidden="true" class="fa fa-star z fa-lg" data-index='2'></i>
      <i aria-hidden="true" class="fa fa-star z fa-lg" data-index='3'></i>
      <i aria-hidden="true" class="fa fa-star z fa-lg" data-index='4'></i>
      <p><i class="fa fa-user" aria-hidden="true"></i> <?php echo $ca;?></p>
    </div>
    <div class="rating-process">
      <div class="rating-right-part">
        <p><i aria-hidden="true" class="fa fa-star y fa-lg"></i><i aria-hidden="true" class="fa fa-star y fa-lg"></i><i aria-hidden="true" class="fa fa-star y fa-lg"></i><i aria-hidden="true" class="fa fa-star y fa-lg"></i><i aria-hidden="true" class="fa fa-star y fa-lg"></i> <?php echo $five;?>%</p>
      </div>
      <div class="rating-right-part">
        <p><i aria-hidden="true" class="fa fa-star y fa-lg"></i><i aria-hidden="true" class="fa fa-star y fa-lg"></i><i aria-hidden="true" class="fa fa-star y fa-lg"></i><i aria-hidden="true" class="fa fa-star y fa-lg"></i> <?php echo $four;?>%</p>
      </div>
      <div class="rating-right-part">
        <p><i aria-hidden="true" class="fa fa-star y fa-lg"></i><i aria-hidden="true" class="fa fa-star y fa-lg"></i><i aria-hidden="true" class="fa fa-star y fa-lg"></i> <?php echo $three;?>%</p>
      </div>
      <div class="rating-right-part">
        <p><i aria-hidden="true" class="fa fa-star y fa-lg"></i><i aria-hidden="true" class="fa fa-star y fa-lg"></i> <?php echo $two;?>%</p>
      </div>
      <div class="rating-right-part">
        <p><i aria-hidden="true" class="fa fa-star y fa-lg"></i> <?php echo $one;?>%</p>
      </div>
    </div>
    <div style="clear:both;"></div>
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
  <script src="assets/js/sweetalert.js"></script>
</body>
</html>
<script type="text/javascript">
   var ratedIndex = -1;
  $(document).ready(function(){
    resetColors();
  
    $('.z').on('click',function(){
       ratedIndex = $(this).data('index');
       savetotheDB();
    })
    $('.z').mouseover(function(){
      resetColors();
       var currentIndex = $(this).data('index');
        setStars(currentIndex);
    });
    $('.z').mouseleave(function(){
      resetColors();
      if(ratedIndex != -1){
         setStars(ratedIndex);
      }
      
    });

    function setStars(max) {
        for(var i=0; i<=max; i++){
          $('.z:eq('+i+')').css({'color':'orange'});
        }
    }
    function resetColors(){
      $('.z').css({'color':'gray'});
    }
    function savetotheDB() {
      $.ajax({
        url:'feedback.php',
        method :'POST',
        dataType : 'json',
        data : {
          saved: 1,
          ratedIndex: ratedIndex
        },
        success: function(r) {
          if(r.code == '100'){
             swal("Goodjob", "Thank You For Your Feedback!", "success");
              setTimeout(function(){
               window.location.reload(1);
            }, 2000);
          }
        }
      });
    }
  });
</script>
