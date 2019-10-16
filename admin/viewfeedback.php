<?php
  include('database/connection.php');
  include('adminconfig.php');
  date_default_timezone_set('Asia/Rangoon');
  $ratedIndex = 0;
      $c = $ca=$car = $cc= $five=$four=$three=$two=$one=0;

    $real = $conn->query("SELECT * FROM rating");
    $ca = $real->num_rows;
    while($row = mysqli_fetch_assoc($real)) {
      $c+=$row['rating_number'];
      $ca = $real->num_rows;
      if($ca > '0') {
      $cc = number_format($c/$ca,1);
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>G M S</title>
  <link rel="icon" href="img/icons8-hongkong-dollar-64.png" type="image/x-icon"/>
  <style type="text/css">
     .car {
      border: 1px solid lightgray;
      border-radius: 5px;
      padding-top: 10px;
    }
     .card-title {
      font-weight: bold;
      font-size: 15px;
      text-align: center;
      border: 1px solid lightgray;
      border-radius: 5px;
      color: gray;
     }
     .he {
      margin-bottom: 5px;
     }
     img {
      height: 200px;
     }
  </style>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../user/assets/css/feedback.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">   
    <?php include('includes/sidebar.php');?>    
      <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">       
          <?php include('includes/navbar.php'); ?>       
              <div class="container-fluid">         
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                       <h1 class="h3 mb-0 text-gray-800">View Feedback</h1>
                  </div> 

                    <div class="row">
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
         <?php include('includes/footer.php'); ?>    
      </div>   
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php include('includes/modal.php');?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

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
        url:'viewfeedback.php',
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