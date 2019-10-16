<?php
   include('../admin/database/connection.php');
   include('../admin/function.php');
   include('userconfig.php');
   $errMsg = "";
   $hello = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
   $hay = $hello->fetch_assoc();
   $userid = clean($hay['userid']);
   $useremail = clean($hay['useremail']);
   if(isset($_POST['chan_pass'])) {
          if(empty($_POST['oldpass'])){
           $errMsg = "Current password is required<br>";
           }elseif(passcheck(md5($_POST['oldpass']),$userid,$useremail)==false){
            $errMsg .= "Current password is wrong!<br>";
           }else{
            $currentpass = clean(md5($_POST['oldpass']));
           }
          if(empty($_POST['userpass'])){
           $errMsg .= "Password is required<br>";
           }elseif($_POST['userpass']!=$_POST['repeatpass']){
            $errMsg .= "New passwords must be equal!<br>";
           }else{
            $userpass = clean(md5($_POST['userpass']));
           }
           if(empty($_POST['repeatpass'])){
           $errMsg .= "Repeatpassword is required<br>";
           }

           if(empty($errMsg)) {
          $add = $conn->query("UPDATE users SET userpass='$userpass' WHERE useremail='$useremail' AND userid='$userid'");
          $add = $conn->query("UPDATE booking SET bookuser_pass='$userpass' WHERE bookuser_email='$useremail' AND book_id='$userid'");
           if($add){
            header("location:chanpass.php?success");
            exit();
          }
         }
 }

         if(isset($_GET['success'])){
          header("Refresh:3");
          session_destroy();
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

  <title>Register</title>
  <style type="text/css">
    span {
      color:red;
    }
    .hee{
      font-size: 20px;
    }
    .p{
      padding: 1rem;
    }
   @media (max-width: 575.98px) {
      .err {
        font-size:12px;
      }
     }

  </style>
  <!-- Custom fonts for this template-->
  <link href="../admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          
          <div class="col-lg-12">
            <div class="p">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Change Password!</h1>
                 <div class="alert alert-danger alert-dismissible fade show"><button type='button' class='close' data-dismiss='alert'>&times;</button>(<span class="hee">*</span>)Fields must be filled.</div>
                 </div>
              <form class="user" action="chanpass.php" method="POST" enctype="multipart/form-data">
                   <?php if($errMsg) {
                      echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $errMsg</div>";
                   }?>
                  <?php if(isset($_GET['success'])) {
                      echo "<div class='alert alert-success alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              Password Change successfully. You have to login again!</div>";
                   }?>

                <div class="form-group row">
                        <label for="oldpass" class="col-sm-2 col-form-label"><b>Old Password:<span>*</span></b></label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control form-control-user" name="oldpass" placeholder="Enter current password">
                   </div>
                </div>  
                            
                <div class="form-group row">
                  <label for="userpass" class="col-sm-2 col-form-label"><b>Password:<span>*</span></b></label>
                  <div class="col-sm-5 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="userpass" placeholder="Enter new password">
                  </div>
                  <div class="col-sm-5">
                    <input type="password" class="form-control form-control-user" name="repeatpass" placeholder="Repeat Password">
                  </div>
                </div>

                <button class="btn btn-primary btn-user btn-block" name="chan_pass">
                  Change Password
                </button>
                <hr>     
              </form>  
                <a href="index.php" style="text-decoration: none;"><i class="fas fa-backward"></i> Back</a>  
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../admin/vendor/jquery/jquery.min.js"></script>
  <script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../admin/js/sb-admin-2.min.js"></script>

</body>

</html>

