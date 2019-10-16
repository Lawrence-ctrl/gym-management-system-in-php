<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  $select = $conn->query("SELECT pos_income.*,pos.* FROM pos_income JOIN pos ON pos_income.poss_id = pos.pos_id WHERE poss_status = '0' order by pos_income.poss_member_id ASC");
  if(isset($_GET['id'])){
    $id = clean($_GET['id']);
    $bb = $conn->query("UPDATE pos_income SET poss_status='1' WHERE posi_id = $id");
    if($bb){
    header("location:confirmpos.php?succMsg");
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
                        <h1 class="h3 mb-0 text-gray-800">Comfirm POS</h1>   
                        <?php if(isset($_GET['succMsg'])) {
                      echo "<div class='alert alert-success alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              Confirm Successfully</div>";
                   }?>                                     
                  </div> 

                <div class="row">
                   <div class="table-responsive">
                      <table class="table table-bordered table-striped table-dark" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                        <tr>
                           <th>Product ID</th>
                           <th>Member ID</th>
                           <th>Product Name</th>
                           <th>Product Price</th>
                           <th>Quantity</th>
                           <th>Total Price</th>
                           <th>Action</th>
                           <th>Confirm</th>   
                        </tr>                   
                       </thead>
                       <tbody>
                        <?php while($sele = $select->fetch_assoc()): ?>
                        <tr id="todo<?php echo $sele['posi_id']?>">
                           <td><?php echo $sele['pos_id']?></td>
                           <td><?php echo $sele['poss_member_id']?></td>
                           <td><?php echo $sele['pos_name']?></td>
                           <td><?php echo $sele['poss_price']?></td>
                           <td><?php echo $sele['poss_quantity']?></td>
                           <td><?php echo $sele['poss_total']?></td>
                           <td>

                             <button class="btn btn-danger btn-circle"><i class="fas fa-trash trasher" id="<?php echo $sele['posi_id']?>" data-id="<?php echo $sele['pos_id']?>" data-index="<?php echo $sele['poss_quantity']?>"></i></button>
                           </td>
                           <td><a onclick="return confirm('Are you sure you want to comfirm this member?')" class="btn btn-primary btn-md" name="hello" href="?id=<?php echo $sele['posi_id']?>">Confirm</a></td>
                        <?php endwhile; ?>
                      </tr>
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
           var hidid = $(this).data('id');
           var hidden = $(this).data('index');
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
                  'dora' : 1,
                  'trashid' : trashid,
                  'hidden' : hidden,
                  'hidid' : hidid
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