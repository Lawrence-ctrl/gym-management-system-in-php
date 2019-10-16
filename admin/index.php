<?php
  include('database/connection.php');
  include('adminconfig.php');
  include('function.php');
  $total = $in = $out =$tot =$profit = $too =$inn=$tota= 0;
  $sel = $conn->query("SELECT * FROM income");
  foreach ($sel as $key => $value) {
      $in = $value['income'];
      $total +=$in;
   } 
   $se = $conn->query("SELECT * FROM pos_income WHERE poss_status='1'");
   foreach ($se as $ke => $valu) {
      $inn = $valu['poss_total'];
      $tota +=$inn; 
   } 
  $tr = $conn->query("SELECT * FROM expenditure");
  foreach ($tr as $key => $va) {
    $out = $va['trainer_expend'];
    $tot += $out; 
  }
  $exp = $conn->query("SELECT * FROM o_expend");
    foreach ($exp as $key => $ex) {
      $expe = $ex['oexpend_price'];
      $too +=$expe;
    }
  $profit = ($total+$tota) - ($tot+$too);
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
    .img-fluid {
      width: 100%;
    }a
    .fi{
      font-weight: bold;
    }
    .zoom { 
    transition: transform .2s;   
    margin: 0 auto;
    }
    .gl {
      font-size: 30px;
      text-align: center;
    }
    .hf{
      font-size: 40px;
      text-align: center;
    }
    .zoom:hover {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Safari 3-8 */
    transform: scale(1.5); 
     }
    @media(max-width: 576px) {
      .hola {
        width: 0;
      }
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
                    <h1 class="h3 mb-0 text-gray-800">Calculation of GMS</h1>
                  </div> 
                    <div class="row">
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">Income from members</h6>
                </div>
              <a href="gym-members.php" style="text-decoration: none;">
                <div class="card-body">
                   <div class="row">
                <div class="col-lg-12 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body gl">
                            Total
                      <div class="text-white small hf">
                         <?php echo $total; ?>
                      </div>
                      <div class="text-white small hf">
                           MMK
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </a>
              </div>

            </div> 
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">Income from POS</h6>
                </div>
              <a href="pos_income.php" style="text-decoration: none;">
                <div class="card-body">
                   <div class="row">
                <div class="col-lg-12 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body gl">
                            Total
                      <div class="text-white small hf">
                         <?php echo $tota; ?>
                      </div>
                      <div class="text-white small hf">
                           MMK
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </a>
              </div>
            </div>
       
            <div class="col-lg-6 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-danger">Expenditure of GMS (Trainers)</h6>
                </div>
              <a href="trainer.php" style="text-decoration: none;">
                <div class="card-body">
                   <div class="row">
                <div class="col-lg-12 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body gl">
                            Total
                      <div class="text-white small hf">
                         <?php echo $tot; ?>
                      </div>
                      <div class="text-white small hf">
                           MMK
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
             </a>
              </div> 
            </div>
            <div class="col-lg-6 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-danger">Other Expenditures</h6>
                </div>
              <a href="otherexpenditures.php" style="text-decoration: none;">
                <div class="card-body">
                   <div class="row">
                <div class="col-lg-12 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body gl">
                            Total
                      <div class="text-white small hf">
                         <?php echo $too; ?>
                      </div>
                      <div class="text-white small hf">
                           MMK
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </a>
              </div> 
            </div>
            <?php if($total > $tot) : ?>
            <div class="col-lg-12 mb-4 zoom">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-black">Profit</h6>
                </div>
                <a href="profit.php" style="text-decoration: none">
                <div class="card-body">
                   <div class="row">
                <div class="col-lg-12 mb-4">
                  <div class="card bg-white text-black shadow">
                    <div class="card-body gl">
                            Total
                      <div class="text-black small hf">
                         <?php echo $profit; ?>
                      </div>
                      <div class="text-black small hf">
                           MMK
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </a>
              </div> 
            </div>                 
             <?php else: ?>   
            <div class="col-lg-12 mb-4 zoom">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-black">Loss</h6>
                </div>
              <a href="profit.php" style="text-decoration: none;">
                <div class="card-body">
                   <div class="row">
                <div class="col-lg-12 mb-4">
                  <div class="card bg-white text-black shadow">
                    <div class="card-body gl">
                            Total
                      <div class="text-black small hf">
                         <?php echo $profit; ?>
                      </div>
                      <div class="text-black small hf">
                           MMK
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </a>
              </div>
           </div> 
          <?php endif; ?>         
        </div>  
        <?php include('includes/footer.php'); ?>
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

