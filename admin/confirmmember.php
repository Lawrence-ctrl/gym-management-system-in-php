<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  require '../PHPMailer-5.2-stable/PHPMailerAutoload.php';
  date_default_timezone_set('Asia/Rangoon');
  $x = "";
  $income = 0;
  $wayy = $conn->query("SELECT * FROM plans");
  $select = $conn->query("SELECT * FROM booking WHERE booked='0'");
  if(isset($_GET['confirm_id'])){
    $confirm_id = clean($_GET['confirm_id']);
    $email = clean($_GET['email']);
    $wee = $conn->query("SELECT * FROM booking WHERE book_id = '$confirm_id'");
    $rw = $wee->fetch_assoc();
    $bo_id = clean($confirm_id);
    $member_email = clean($rw['bookuser_email']);
    $bookduration = clean($rw['bookduration']);
      if($bookduration == '1') {
           $x = 1;           
        }elseif($bookduration == '2')
        {
          $x= 3;
        }elseif($bookduration == '3')
        {
          $x= 6;
        }else{
          $x = 12;
        }
    $bookuserplan = clean($rw['bookuserplan']);
    foreach ($wayy as $key => $way) {
     if($bookuserplan == $way['plan_id']) {
             $price = $way['plan_price'];
           }
         }
          $income = $x * $price;
    $hello = $conn->query("UPDATE booking SET booked='1' WHERE book_id = '$confirm_id' && bookuser_email = '$email'");
    if($hello){
      $in = $conn->query("INSERT INTO income(book_id,member_email,income,created_date,updated_date) VALUES ('$bo_id','$member_email','$income',now(),now())");
         $mail = new PHPMailer;
          $mail->isSMTP();                                     
          $mail->Host = "smtp.gmail.com";  
          $mail->SMTPAuth = true;                             
          $mail->Username = 'mgmg@gmail.com';               
          $mail->Password = '*******';               
          $mail->SMTPSecure = 'ssl';                          
          $mail->Port = 465;                                   
          $mail->setFrom('mgmg@gmail.com','App');
          $mail->addAddress($email);   
          $mail->addReplyTo('mgmg@gmail.com');
          $mail->isHTML(true);
          $mail->Subject = 'GMS';
                  $mail->Body    = '<b>Dear </b><br>
                  <b>Booking Confirmed</b>';
                  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                  if(!$mail->send()) {
                      echo 'Message could not be sent.';
                      echo 'Mailer Error: ' . $mail->ErrorInfo;
                  }else{
                      echo '<script>window.alert("We will send messge to your gmail after admin had confirmed your booking!")</script>';
                  }
      header("location:?succMsg");
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

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
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
                        <h1 class="h3 mb-0 text-gray-800">Comfirm Booking</h1>   
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
                           <th>Member ID</th>
                           <th>Member Name</th>
                           <th>Member Email</th>
                           <th>Action</th>
                           <th>Confirm</th>   
                        </tr>                   
                       </thead>
                       <tbody>
                        <?php while($sele = $select->fetch_assoc()): ?>
                        <tr>
                           <td><?php echo $sele['book_id']?></td>
                           <td><?php echo $sele['bookuser_name']?></td>
                           <td><?php echo $sele['bookuser_email']?></td>
                           <td>
                             <a style="text-decoration: none;" href="view-members.php?member_id=<?php echo $sele['book_id']?>">
                              <button class="btn btn-primary btn-circle"><i class="fas fa-eye"></i></button></a>
                             <button class="btn btn-danger btn-circle"><i class="fas fa-trash trasher" id="<?php echo $sele['book_id']?>"></i></button>
                          </td>
                           <td><a onclick="return confirm('Are you sure you want to comfirm this member?')" class="btn btn-primary btn-md" name="hello" href="?confirm_id=<?php echo $sele['book_id']?>&&email=<?php echo $sele['bookuser_email']?>">Confirm</a></td>
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
  <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
      $('.trasher').on('click', function() {
        var trash_id = $(this).attr('id');
            const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
              },
              buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
        $.ajax({
           url: "deleteconfirm.php",
           method: "POST",
           data: {trash_id:trash_id},
           success: function() {
            $('.trasher').parent().parent().parent().css({'background': 'tomato'});
            $('.trasher').parent().parent().parent().fadeTo('slow',0.7,function(){
              $(this).remove();
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              });
            }
        });
         }else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons.fire(
                  'Cancelled',
                  'Your imaginary file is safe :)',
                  'error'
                )
              }
            });
      });
    });
</script>
