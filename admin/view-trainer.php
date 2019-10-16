<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  if(isset($_GET['trainer_id'])) {
  $trainer_id = clean($_GET['trainer_id']);
  $hello = $conn->query("SELECT t.*,c.*,p.* FROM trainers as t LEFT JOIN t_current as c ON t.t_duration = c.t_id LEFT JOIN plans as p ON t.trainer_exer_id = p.plan_id WHERE t.trainer_id='$trainer_id'");
  $hee = $hello->fetch_assoc();
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
   
  </style>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sweetalert.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">
  <style type="text/css">
    img {
      width :100px;
      height: 100px;
    }
    .hee{
      text-decoration: none;
    }
    @media(min-width: 578px) {
    table {
      width: 100%;
     
     }
     td {
        width: 50%;
      }
   }
    @media(max-width: 578px) {
      td {
        width: 50%;
      }
   }
   .har {
    border:1px solid #fff;
   }
  </style>
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
                        <h1 class="h3 mb-0 text-gray-800">View Member</h1>   
                        <?php if(isset($_GET['succMsg'])) {
                      echo "<div class='alert alert-success alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              Confirm Successfully</div>";
                   }?>                                     
                  </div> 

                <div class="row">
                  <div class="table-responsive">
                   <table class="table table-striped table-dark">
                    <tr>
                        <td colspan="2"><center><img src="images/<?php echo $hee['trainer_photo']?>" class="rounded"></center></td>                      
                      </tr>
                      <tr>
                         <td>Trainer ID:</td>
                         <td><?php echo $hee['trainer_id']?></td>
                      </tr>
                      <tr>
                         <td>Name:</td>
                         <td><?php echo $hee['trainer_name']?></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><?php echo $hee['trainer_email']?></td>
                      </tr>
                      <tr>
                        <td>Address:</td>
                        <td><?php echo $hee['trainer_address']?></td>
                      </tr>
                      <tr>
                        <td>Fees:</td>
                        <td><?php echo $hee['trainer_fees']?></td>
                      </tr>
                      <tr>
                        <td>Gender:</td>                     
                          <?php if($hee['trainer_gender']=='1'){ ?>
                                <td>Male</td>
                          <?php }else{ ?>
                                <td>Female</td>
                          <?php } ?>
                      </tr>
                      <tr>
                        <td>Plan:</td>
                        <td><?php echo $hee['plan_name']?></td>
                      </tr>
                      <tr>
                        <td>Duration:</td>
                        <td><?php echo $hee['tc_name']?></td>
                      </tr>
                      <tr>
                        <td>Start Date:</td>
                        <td><?php echo $hee['tstart_date']?></td>
                      </tr>
                      <tr>
                        <td>End Date:</td>
                        <td><?php echo $hee['tend_date']?></td>
                      </tr>
                      <tr>
                         <td>
                            <a class="btn btn-block btn-social btn-facebook ha" href="<?php echo $hee['trainer_fb']?>">
                               <span class="fab fa-facebook"></span>
                            </a>
                         </td>                        
                          <td>   
                              <a class="btn btn-block btn-social btn-success har">
                                  <span class="fas fa-phone"></span>
                              </a>
                          </td>
                      </tr>
                   </table>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/sweetalert.js"></script>
</body>
</html>
