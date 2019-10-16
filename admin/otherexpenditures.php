<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  $total = 0;
  if(isset($_POST['submit'])) {
    $from = $_POST['from'];
    $to= $_POST['to'];
    $expend = $conn->query("SELECT * FROM o_expend WHERE created_date BETWEEN '$from' AND '$to'");
  }elseif(isset($_GET['id'])){
    $id = clean($_GET['id']);
    $expend = $conn->query("SELECT * FROM o_expend WHERE oexpend_id = '$id'");
  }else{
   $expend = $conn->query("SELECT * FROM o_expend");
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
  <link rel="stylesheet" href="../user/jquery-ui-1.12.1/jquery-ui.min.css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">

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
                        <h1 class="h3 mb-0 text-gray-800">Others Expenditure</h1>   
                        <?php if(isset($_GET['succMsg'])) {
                      echo "<div class='alert alert-success alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              Confirm Successfully</div>";
                   }?> 
                   <a href="addexpenditures.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i>Add</a>                                    
                  </div> 
                <div class="text-center">
                  <form action="otherexpenditures.php" method="POST">
                    <label for="from">From:</label>
                     <input type="text" class="cla" id="bookdate" name="from" placeholder="Select Date">
                     <label for="to">To:</label>
                     <input type="text" class="cla" id="to" name="to" placeholder="Select Date">&nbsp;&nbsp;&nbsp;
                     <input type="submit" class="btn btn-outline-success btn-md" name="submit" value="Send">
                  </form>
                </div>
                <div class="row">
                   <div class="table-responsive" style="border: 2px solid lightgray; border-radius: 5px;padding: 10px; margin: 10px">
                      <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Price</th>
                           <th>Created Date</th>  
                        </tr>                   
                       </thead>
                       <tbody>
                        <?php while($sele = $expend->fetch_assoc()): 
                            $total += $sele['oexpend_price'];
                          ?>
                        <tr>
                           <td><?php echo $sele['oexpend_id']?></td>
                           <td><?php echo $sele['oexpend_name']?></td>
                           <td><?php echo $sele['oexpend_price']?></td>
                           <td><?php echo $sele['created_date']?></td>
                       </tr>
                       <?php endwhile; ?>
                       </tbody>
                    </table>
                   </div>
                   
                </div>
                <div class="text-right">
                        <p class="large">Total: <?php echo $total; ?>MMK </p> 
                </div>
                <div class="text-left">
                   <a href="index.php"><i class="fas fa-backward fa-lg"></i></a>
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
  <script src="../user/jquery-ui-1.12.1/jquery.js"></script>
  <script src="../user/jquery-ui-1.12.1/jquery-ui.min.js"></script>
</body>

</html>
<script type="text/javascript">
  $(document).ready(function(){
      $('#bookdate').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:"2019:2020",
        closeText: "Close",
        dateFormat: "yy-mm-dd"
      });
       $('#to').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:"2019:2020",
        closeText: "Close",
        dateFormat: "yy-mm-dd"
      });
  });
</script>