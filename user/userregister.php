<?php
   include('../admin/database/connection.php');
   include('../admin/function.php');
   $errMsg = "";
   if(isset($_POST['user_regist'])) {

          if(empty($_FILES['userimg']['name'])){
              $errMsg .= "ပုံထည့်ပါ။<br>";
             }else{
              $cover = $_FILES['userimg']['name'];
              $filename = uniqid().'_'.$cover;
              $tmp = $_FILES['userimg']['tmp_name'];
              $type = $_FILES['userimg']['type'];
              $size = $_FILES['userimg']['size'];
              if($type=="image/jpg" || $type == "image/png" || $type=="image/jpeg" || $type=="image/gif")
              {
                if($size < '1000000') {
                move_uploaded_file($tmp, "../admin/images/$filename");
                }else{
                  $errMsg.= "Image size is too big<br>";
                }
              }else{
                $errMsg .= "jpg,png,gif နှင့် jpeg type များသာလက်ခံသည်။<br>";
              }            
            }

           if(empty($_POST['username'])){
            $errMsg = "Username is required<br>";
            }elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['username'])){
            $errMsg .= "Only letters and white space allowed in username<br>";
            }elseif(strlen($_POST['username'])<4)
            {
              $errMsg.= "Type at least 4 letters<br>";
            }
            elseif(strlen($_POST['username'])>=15)
            {
              $errMsg.= "Only 15 letters are allowed<br>";
            }
            elseif(checkusername($_POST['username'])==false) {
            $errMsg .="Username is already exist<br>";
            }else{
            $username = clean($_POST['username']);
            }

           if(empty($_POST['useremail'])){
           $errMsg .= "Email is required<br>";
           }elseif(!filter_var($_POST['useremail'],FILTER_VALIDATE_EMAIL))
           {
            $errMsg.= "Invalid Email Format!<br>";
           }elseif(checkemail($_POST['useremail'])==false) {
            $errMsg.= "Email already exists<br>";
           }else{
            $useremail = clean($_POST['useremail']);
           }

          if(empty($_POST['userpass'])){
           $errMsg .= "Password is required<br>";
           }elseif($_POST['userpass']!=$_POST['repeatpass']){
            $errMsg .= "Passwords must be equal<br>";
           }else{
            $userpass = clean(md5($_POST['userpass']));
           }

           if(empty($_POST['repeatpass'])){
           $errMsg .= "Repeatpassword is required<br>";
           }

           if(empty($_POST['useraddress'])){
            $errMsg .= "Address is required<br>";
           }else{
           $useraddress =clean($_POST['useraddress']);
           }

           if(empty($_POST['userphone'])){
           $errMsg .= "Phone is required<br>";
           }else{
           $userphone =clean($_POST['userphone']);
           }

           $userfb = clean($_POST['userfb']);

           if(empty($errMsg)) {
            $add = $conn->query("INSERT INTO users(username,useremail,userpass,user_img,userphone,useraddress,userfb,userstatus,u_status,created_date,updated_date) VALUES ('$username','$useremail','$userpass','$filename','$userphone','$useraddress','$userfb','1','1',now(),now())"); 

             
           if($add){
            header("location:userlogin.php?success");
            exit();
          }
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
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                 <div class="alert alert-danger alert-dismissible fade show"><button type='button' class='close' data-dismiss='alert'>&times;</button>(<span class="hee">*</span>)Fields must be filled.</div>
                 </div>
              <form class="user" action="userregister.php" method="POST" enctype="multipart/form-data">
                   <?php if($errMsg) {
                      echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $errMsg</div>";
                   }?>
                <div class="form-group row">
                  <label for="userimg" class="col-sm-2 col-form-label">Photo:<span>*</span></label>
                  <div class="col-sm-10">
                    <input type="file" name="userimg">
                  </div>
                </div>
            
                <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label"><b>Username:<span>*</span></b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-user" name="username" placeholder="Username is required">
                   </div>
                </div>

                <div class="form-group row">
                        <label for="useremail" class="col-sm-2 col-form-label"><b>Email:<span>*</span></b></label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control-user" name="useremail" placeholder="Email Address">
                   </div>
                </div>  
                            
                <div class="form-group row">
                  <label for="useremail" class="col-sm-2 col-form-label"><b>Password:<span>*</span></b></label>
                  <div class="col-sm-5 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="userpass" placeholder="Password">
                  </div>
                  <div class="col-sm-5">
                    <input type="password" class="form-control form-control-user" name="repeatpass" placeholder="Repeat Password">
                  </div>
                </div>

                <div class="form-group row">
                    <label for="useraddress" class="col-sm-2 col-form-label"><b>Address:<span>*</span></b></label>
                    <div class="col-sm-10">
                        <textarea name="useraddress" placeholder="Enter Address" class="form-control form-control-user"></textarea>
                   </div>
                </div>

                <div class="form-group row">
                        <label for="userphone" class="col-sm-2 col-form-label"><b>Phone Number:<span>*</span></b></label>
                    <div class="col-sm-10">
                        <input type="varchar" class="form-control form-control-user" name="userphone" placeholder="09972089188">
                   </div>
                </div>

                <div class="form-group row">
                        <label for="userfb" class="col-sm-2 col-form-label"><b>Facebook Link</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-user" name="userfb" placeholder="enter fb link">
                   </div>
                </div>   
                <button class="btn btn-primary btn-user btn-block" name="user_regist">
                  Register Account
                </button>
                <hr>     
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="userlogin.php">Already have an account? Login!</a>
              </div>
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

