<?php
  include('database/connection.php');
  include('adminconfig.php');
  include('function.php');
  $total=$in=$out=$tot=$profit=$expenditure=$carry=$tota=$inn=$cout=$co=$cal=$too=$expe=$plus=0;
  if(isset($_POST['submit'])){
    $from = $_POST['from'];
    $to= $_POST['to'];
    $sel = $conn->query("SELECT * FROM income WHERE created_date Between '$from' AND '$to'");
      foreach ($sel as $keyy => $value) {
      $in = $value['income'];
      $total +=$in;
      $co = $sel->num_rows; 
   } 
   $se = $conn->query("SELECT * FROM pos_income WHERE poss_status='1' AND pos_created_date Between '$from' AND '$to'");
   foreach ($se as $ke => $valu) {
      $inn = $valu['poss_total'];
      $tota +=$inn;
      $cal = $se->num_rows; 
   } 

   $tr = $conn->query("SELECT * FROM expenditure WHERE created_date Between '$from' AND '$to'");
   foreach ($tr as $key => $va) {
    $out = $va['trainer_expend'];
    $tot += $out; 
    $cout = $tr->num_rows;
    }
    $exp = $conn->query("SELECT * FROM o_expend WHERE created_date Between '$from' AND '$to'");
    foreach ($exp as $key => $ex) {
      $expe = $ex['oexpend_tprice'];
      $too +=$expe;
      $plus = $exp->num_rows;
    }
    $carry = ($total + $tota) - ($tot+$too);
   }else{
      $sel = $conn->query("SELECT * FROM income");
      foreach ($sel as $keyy => $value) {
      $in = $value['income'];
      $total +=$in;
      $co = $sel->num_rows;
      }
      $se = $conn->query("SELECT * FROM pos_income WHERE poss_status='1'");
       foreach ($se as $ke => $valu) {
      $inn = $valu['poss_total'];
      $tota +=$inn;
      $cal = $se->num_rows; 
   } 
      $tr = $conn->query("SELECT * FROM expenditure");
      foreach ($tr as $key => $va) {
      $out = $va['trainer_expend'];
      $tot += $out; 
      $cout = $tr->num_rows;
    }
    $exp = $conn->query("SELECT * FROM o_expend");
    foreach ($exp as $key => $ex) {
      $expe = $ex['oexpend_price'];
      $too += $expe;
      $plus = $exp->num_rows;
    }
    $carry = ($total + $tota) - ($tot+$too);
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
  <link rel="stylesheet" href="../user/jquery-ui-1.12.1/jquery-ui.min.css">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
                    <h1 class="h3 mb-0 text-gray-800">Money</h1>
                  </div> 
                          <div class="text-center">
                  <form action="profit.php" method="POST">
                    <label for="from">From:</label>
                     <input type="text" class="cla" id="bookdate" name="from" placeholder="Select Date">
                     <label for="to">To:</label>
                     <input type="text" class="cla" id="to" name="to" placeholder="Select Date">&nbsp;&nbsp;&nbsp;
                     <input type="submit" class="btn btn-outline-success btn-md" name="submit" value="Send">
                  </form>
                       </div>
                    <div class="row">
               
            <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
              <thead>

                <tr>
                 <th>Role</th>
                 <th>Position</th>
                 <th>ID</th>
                 <th>quantity</th>
                 <th>Total</th>
                 </tr> 
               </thead>
               <tbody>
                <?php if($co > 0) : ?>
                 <tr>
                    <td>Income</td>
                    <td>Member</td>
                    <td><?php foreach ($sel as $key => $value) { ?>
                    <a href="gym-members.php?id=<?php echo $value['book_id']?>"><?php echo $value['book_id']?>/</a>
                    <?php } ?></td>
                    <td><?php echo $co?></td>
                    <td><?php echo $total?>MMK</td>
                 </tr>
                <?php endif; ?>
                <?php if($cal > 0) : ?>
                 <tr>
                    <td>Income</td>
                    <td>POS</td>
                    <td><?php foreach ($se as $ke => $valu) {?>
                      <a href="pos_income.php?id=<?php echo $valu['posi_id']?>"><?php echo $valu['posi_id']?>/</a>
                    <?php } ?></td>
                    <td><?php echo $cal?></td>
                    <td><?php echo $tota?>MMK</td>
                 </tr>
               <?php endif; ?>
               <?php if($cout > 0): ?>
                  <tr>
                    <td>Expenditure</td>
                    <td>Trainer</td>
                    <td><?php foreach($tr as $key => $va) { ?>
                      <a href="trainer.php?id=<?php echo $va['trainer_id']?>"><?php echo $va['trainer_id']?>/</a>
                    <?php } ?></td>
                    <td><?php echo $cout?></td>
                    <td><?php echo $tot?>MMK</td>
                 </tr>
                <?php endif; ?>
                <?php if($plus > 0): ?>
                  <tr>
                     <td>Expenditure</td>
                     <td>Other Expenditures</td>
                     <td><?php  foreach($exp as $key => $ex) { ?>
                       <a href="otherexpenditures.php?id=<?php echo $ex['oexpend_id']?>"><?php echo $ex['oexpend_id']?>/</a>
                     <?php } ?></td>
                     <td><?php echo $plus?></td>
                     <td><?php echo $too?>MMK</td>
                  </tr>
                <?php endif; ?>
                <tr>
                  <?php if($total + $tota > $tot+$too) { ?>
                  <td colspan="3" style="text-align: right;">Profit :</td>
                  <td><?php echo $carry; ?> MMK</td>
                <?php } else { ?>
                  <td colspan="4" style="text-align: right;">Loss :</td>
                  <td><?php echo $carry?> MMK</td>
                 <?php  } ?>
                </tr>
               </tbody>
             </table>
             <div class="text-left">
                   <a href="index.php"><i class="fas fa-backward fa-lg"></i></a>
                </div>
              </div> 
        </div>

  </div>
<?php include('includes/footer.php'); ?> 
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
   <script src="../user/jquery-ui-1.12.1/jquery.js"></script>
  <script src="../user/jquery-ui-1.12.1/jquery-ui.min.js"></script>
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


</body>

</html>
