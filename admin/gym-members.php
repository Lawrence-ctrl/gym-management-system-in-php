<?php
  include('database/connection.php');
  include('adminconfig.php');
  include('function.php');
  $x = $total = 0;
  if(isset($_POST['submit'])) {
    $from = $_POST['from'];
    $to= $_POST['to'];
    $hello = $conn->query("SELECT b.*,c.*,p.* FROM booking as b LEFT JOIN current as c ON b.bookduration = c.current_id LEFT JOIN plans as p ON b.bookuserplan = p.plan_id WHERE booked='1' AND b.created_date BETWEEN '$from' AND '$to'");
  }elseif(isset($_GET['id'])){
    $bookid = clean($_GET['id']);
    $hello = $conn->query("SELECT b.*,c.*,p.* FROM booking as b LEFT JOIN current as c ON b.bookduration = c.current_id LEFT JOIN plans as p ON b.bookuserplan = p.plan_id WHERE booked='1' AND book_id = '$bookid'");
  }else{
    $hello = $conn->query("SELECT b.*,c.*,p.* FROM booking as b LEFT JOIN current as c ON b.bookduration = c.current_id LEFT JOIN plans as p ON b.bookuserplan = p.plan_id WHERE booked='1'");
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
  <link rel="stylesheet" href="../user/jquery-ui-1.12.1/jquery-ui.min.css">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">
  <style type="text/css">
    img {
      width :50px;
      height: 50px;
    }
    .hee{
      text-decoration: none;
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
                        <h1 class="h3 mb-0 text-gray-800">Members</h1>   
                        <?php if(isset($_GET['succMsg'])) {
                      echo "<div class='alert alert-success alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              Confirm Successfully</div>";
                   }?>                                     
                  </div> 
                       <div class="text-center">
                  <form action="gym-members.php" method="POST">
                    <label for="from">From:</label>
                     <input type="text" class="cla" id="bookdate" name="from" placeholder="Select Date">
                     <label for="to">To:</label>
                     <input type="text" class="cla" id="to" name="to" placeholder="Select Date">&nbsp;&nbsp;&nbsp;
                     <input type="submit" class="btn btn-outline-success btn-md" name="submit" value="Send">
                  </form>
                       </div>
                <div class="row">
                   <div class="table-responsive">
                      <table class="table table-bordered table-striped table-dark" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                        <tr>
                           <th>Member ID</th>
                           <th>Membername</th>
                           <th>Member Email</th>
                           <th>Member Profile</th> 
                           <th>Member Fees</th>
                           <th>Duration</th>                        
                           <th>Action</th>  
                        </tr>                  
                       </thead>
                       <tbody>
                           <?php while($hi = $hello->fetch_assoc()):
                               if($hi['current_id'] == 1){
                                $x = 1;
                               }elseif($hi['current_id'] == 2){
                                $x = 3;
                               }elseif($hi['current_id'] == 3){
                                $x=6;
                               }else{
                                $x = 12;
                               }
                               $total += $hi['plan_price']*$x;
                            ?>
                            <tr>
                             <td><?php echo $hi['book_id'];?></td>
                             <td><?php echo $hi['bookuser_name']?></td>
                             <td><?php echo $hi['bookuser_email']?></td>
                             <td><img src="images/<?php echo $hi['bookuser_img']?>"></td>
                             <td><?php echo $hi['plan_price']?></td>
                             <td><?php echo $hi['current_name']?></td>
                             <td>
                             <a style="text-decoration: none;" href="view-members.php?member_id=<?php echo $hi['book_id']?>">
                              <button class="btn btn-primary btn-circle"><i class="fas fa-eye"></i></button></a>
                             <a href="#"><button class="btn btn-danger btn-circle"><i class="fas fa-trash trasher" id="<?php echo $hi['userid']?>"></i></button></a>
                             </td>
                           </tr>
                           <?php endwhile; ?>
                       </tbody>
                    </table>
                    <div class="text-right">
                        <p class="large">Total: <?php echo $total; ?>MMK </p> 
                    </div>
                    <div class="text-left">
                   <a href="index.php"><i class="fas fa-backward fa-lg"></i></a>
                </div>
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
  <script src="../user/jquery-ui-1.12.1/jquery.js"></script>
  <script src="../user/jquery-ui-1.12.1/jquery-ui.min.js"></script>
</body>

</html>
 <script>
     $(document).ready(function(){
        $('.trasher').on('click',function(){
           var trashid = $(this).attr('id');
           // alert(trashid);
          swal({
              title: "သေချာပါသလား",
              text: "ပြန်ယူလို့ရမည်မဟုတ်ပါ။",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "ဖျက်မည်",
              cancelButtonText: "မဖျက်ပါ",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm) {
              if(isConfirm) {
            $.ajax({
                 url: "deletecat.php",
                 method : "POST",
                 dataType : 'json',
                 data : {
                  'deleted' : 1,
                  'trashid' : trashid
                 },
                 success: function(data) {
                   if(data.code == 101) 
                   {
                    $('#todo'+ trashid).css({'background': 'tomato'});
                     $('#todo'+ trashid).fadeTo('slow',0.7,function() 
                     {
                      $(this).remove();
                      swal("Deleted!", "ဖျက်ပြီးပါပြီ။", "success");
                     });
                   }else{
                    swal("Error","Can't delete that row","error");
                   }
                 }
            });
          }else {
    swal("Cancelled", "မဖျက်ဖြစ်ပါ။", "error");
  }
});
        });
     });
   </script>
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
