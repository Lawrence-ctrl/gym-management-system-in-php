<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  $hello = $conn->query("SELECT * FROM users ORDER BY userid ASC");
  if(isset($_GET['status']))
  {
    $userid = clean($_GET['conid']);
    $status = clean($_GET['status']);
    $hh = $conn->query("UPDATE users SET u_status = '$status' WHERE userid='$userid'");
    if($hh)
    {
      header("location: gym-user.php?succMsg");
    }
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
      width :50px;
      height: 50px;
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
                        <h1 class="h3 mb-0 text-gray-800">Users</h1>   
                        <?php if(isset($_GET['succMsg'])) {
                      echo "<div class='alert alert-success alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              Changed Successfully</div>";
                   }?>    
                                                   
                  </div> 

                <div class="row">
                   <div class="table-responsive">
                      <table class="table table-bordered table-striped table-dark" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                        <tr>
                           <th>User ID</th>
                           <th>Username</th>
                           <th>User Email</th>
                           <th>User Profile</th>
                           <th>Role</th>
                           <th>Created Date</th>
                           <th>User Condition</th>
                           <th>Action</th>  
                        </tr>                  
                       </thead>
                       <tbody>
                           <?php while($hi = $hello->fetch_assoc()):?>
                            <tr id="todo<?php echo $hi['userid']?>">
                             <td><?php echo $hi['userid'];?></td>
                             <td><?php echo $hi['username']?></td>
                             <td><?php echo $hi['useremail']?></td>
                             <td><img src="images/<?php echo $hi['user_img']?>"></td>
                             <td><?php if($hi['userstatus'] == '1') {
                              echo "Member";
                             }elseif($hi['userstatus'] == '2') {
                              echo "Trainer";
                             }else{
                              echo "Non-member";
                             } ?>
                             <td><?php echo $hi['created_date'];?></td>
                             <td style="text-align: center;"><?php if($hi['u_status'] == '1'): ?>
                              <a onclick="return confirm('Do you want to change the condition of this user to inactive?')" href="gym-user.php?conid=<?php echo $hi['userid']?>&status=0"><i class="fas fa-check-circle fa-lg text-success"></i></a>
                              <?php else: ?>
                              <a onclick="return confirm('Do you want to change the condition of this user to active?')" href="gym-user.php?conid=<?php echo $hi['userid']?>&status=1"><i class="fas fa-times-circle fa-lg text-danger"></i>
                              </a>
                              <?php endif; ?>
                              </td>
                              <td>
                             <button class="btn btn-danger btn-circle"><i class="fas fa-trash text-danger trasher" id="<?php echo $hi['userid']?>"></i></button>
                             </td>
                           </tr>
                           <?php endwhile; ?>
                       </tbody>
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