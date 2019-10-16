<?php
  include('../admin/database/connection.php');
  include('../admin/function.php');
  session_start();
  $errMsg="";
   if(!empty($_POST))    
   {  
     if(empty($_POST['useremail'])) {
        $errMsg = "Pleas Fill email address<br>";
      }else{
      $useremail = clean($_POST['useremail']);
      }

      if(empty($_POST['userpass'])) {
        $errMsg .= "Please Fill Password";
      }else{
        $userpass = clean(md5($_POST['userpass']));
      }
      
      if(empty($errMsg)) {
        $result = $conn->query("SELECT * FROM users WHERE useremail='$useremail' AND userpass = '$userpass'");
        if($result->num_rows == 1)
       {
        $row = $result->fetch_array();
        if($row['userstatus'] == '1' || $row['userstatus'] == '2') 
        {
        	 if($row['u_status'] == '1') {
          $_SESSION['userid']= $row['userid'];
          $_SESSION['useremail'] = $row['useremail'];       
       
          $yuu = $conn->query("INSERT INTO login (uid) VALUES ('".$row['userid']."')");
	          if($yuu) {
	          $_SESSION['lid'] = $conn->insert_id;
	      	  }
             header("location:index.php");
         }else{
         	$errMsg .= "You got banned by ADMIN";
         }
        }
      }else{
          $errMsg.= "Email and password do not match";
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="forlogin/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="forlogin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="forlogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="forlogin/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="forlogin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="forlogin/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="forlogin/css/util.css">
	<link rel="stylesheet" type="text/css" href="forlogin/css/main.css">
	<style type="text/css">
		.err{
			text-align: right;
			/*background: transparent;*/
			/*color: #fff;*/
		}
	</style>
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				
					<?php if($errMsg){
						echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $errMsg</div>";
					}?>
				<form class="login100-form validate-form" action="userlogin.php" method="POST">

					<span class="login100-form-title">
						
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="useremail" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate ="Password is required">
						<input class="input100" type="password" name="userpass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
					<div class="text-center p-t-136">
						<a class="txt2" href="userregister.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="forlogin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="forlogin/vendor/bootstrap/js/popper.js"></script>
	<script src="forlogin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="forlogin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="forlogin/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="forlogin/js/main.js"></script>

</body>
</html>