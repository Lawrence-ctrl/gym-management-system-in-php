<?php
  include('database/connection.php');
  include('adminconfig.php');
   if(isset($_GET['pos_cat_id']))
  {
    if($_GET['pos_cat_id'] == '1') {
       $exe = $conn->query("SELECT * FROM pos ORDER BY pos_id ASC");
    }elseif($_GET['pos_cat_id']) {
       $pos_cat_id = mysqli_real_escape_string($conn,$_GET['pos_cat_id']);
       $exe = $conn->query("SELECT * FROM pos WHERE pos_category='$pos_cat_id'"); 
    } 
  }else{
      $exe = $conn->query("SELECT * FROM pos ORDER BY pos_id ASC");
  }  
  $result = $conn->query("SELECT * FROM pos_category");
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
                       if(isset($_GET['pos_cat_id'])) {
                          $pos_cat_id = $_GET['pos_cat_id'];
                          $res = $conn->query("SELECT * FROM pos_category WHERE pos_cat_id='$pos_cat_id'");
                          $hi = $res->fetch_assoc();         
                    ?>
                       <h1 class="h3 mb-0 text-gray-800"><?php echo $hi['pos_cat_name']?></h1>
                     <?php }else{ ?>
                        <h1 class="h3 mb-0 text-gray-800">POS</h1>
                     <?php } ?>  
                     <a href="addpos.php" class="d-none d-sm-inline-block btn btn-md btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Product</a>                       
                  </div> 

                    <div class="row">
                       <?php $result = $conn->query("SELECT * FROM pos_category");
                        while($row = $result->fetch_assoc()): ?>
                          <div class="col-md-2 col-sm-6 col-xs-6">
                             <a href="?pos_cat_id=<?php echo $row['pos_cat_id']?>" class="btn btn-outline-secondary btn-lg btn-block he"><?php echo $row['pos_cat_name']?>                               
                             </a>
                          </div>
                       <?php endwhile; ?>
                    </div>

                    <hr>

                    <div class="row">
                       <?php 
                        while($erow = $exe->fetch_assoc()): ?>
                        
                          <div class="col-md-3 col-sm-6 car">
                            <a style="text-decoration: none;" href="posdetails.php?posid=<?php echo $erow['pos_id']?>&&pos_cat_id=<?php echo $erow['pos_category']?>">
                              <img class="card-img-top" src="images/<?php echo $erow['pos_image']?>" alt="Card image cap">
                                <div class="card-body">
                                  <h5 class="card-title"><?php echo $erow['pos_name']?></h5> 
                                  <div class="text-info text-center">
                                  <?php echo $erow['pos_quantity']?>  
                                  </div>                 
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
