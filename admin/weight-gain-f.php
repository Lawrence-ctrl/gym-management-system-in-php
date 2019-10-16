<?php
  include('database/connection.php');
  include('adminconfig.php');
  if(isset($_GET['cat_id']))
  {
    if($_GET['cat_id'] == '1') {
       $exe = $conn->query("SELECT * FROM exercises WHERE gender='2' AND exer_plan='2'");
    }elseif($_GET['cat_id']) {
       $cat_id = mysqli_real_escape_string($conn,$_GET['cat_id']);
       $exe = $conn->query("SELECT * FROM exercises WHERE exer_category_id='$cat_id' and gender='2' AND exer_plan='2'"); 
    } 
  }else{
      $exe = $conn->query("SELECT * FROM exercises WHERE gender='2' AND exer_plan='2'");
  }  
  $result = $conn->query("SELECT * FROM exercises_category");
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
      border: 1px solid lightblue;
      border-radius: 5px;
      padding-top: 10px;
    }
     .card-title {
      font-weight: bold;
      font-size: 15px;
      text-align: center;
      border: 1px solid lightblue;
      border-radius: 5px;
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
                      <?php 
                       if(isset($_GET['cat_id'])) {
                          $cat_id = $_GET['cat_id'];
                          $res = $conn->query("SELECT * FROM exercises_category WHERE cat_id='$cat_id'");
                          $hi = $res->fetch_assoc();         
                       ?>
                       <h1 class="h3 mb-0 text-gray-800"><?php echo $hi['exercises_name']?></h1>
                     <?php }else{ ?>
                        <h1 class="h3 mb-0 text-gray-800">Weight Gain Exercises (Female)</h1>
                     <?php } ?>             
                    
                  </div> 

                    <div class="row">
                       <?php 
                        while($row = $result->fetch_assoc()): ?>
                          <div class="col-md-2 col-sm-6 col-xs-6">
                             <a href="?cat_id=<?php echo $row['cat_id']?>" class="btn btn-outline-info btn-lg btn-block he"><?php echo $row['exercises_name']?>                               
                             </a>
                          </div>
                       <?php endwhile; ?>
                    </div>

                    <hr>

                    <div class="row">
                       <?php 
                        while($erow = $exe->fetch_assoc()): ?>
                        
                          <div class="col-md-3 col-sm-6 car">
                            <a style="text-decoration: none;" href="detail-exercises.php?exer_id=<?php echo $erow['exer_id']?>&&cat_id=<?php echo $erow['exer_category_id']?>&&sex=<?php echo $erow['gender']?>">
                              <img class="card-img-top" src="images/<?php echo $erow['exer_img']?>" alt="Card image cap">
                                <div class="card-body">
                                  <h5 class="card-title"><?php echo $erow['exer_name']?></h5>                     
                                </div>
                            </a>
                          </div>
                       
                        <?php endwhile; ?>
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
