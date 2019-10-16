<?php
  session_start();
  include('database/connection.php');
  include('function.php');
    $erMes = "";
    if(!empty($_POST))
    {
    if(is_numeric($_POST['phone'])) {
      $phone = clean($_POST['phone']); 
    }else{
      $erMes = "Phone number must be numbers<br>";
    }
    if(empty($erMes)) {
    $password = clean(md5($_POST['password']));
      if(checkadmin($phone,$password)=='true')
      {
        $_SESSION['adminphone'] = $phone;
        header("location: index.php");
        exit;
      }else{  
        $erMes .= "Phone and Password do not match";
      }
     }
    }
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Lib Admin Login</title>
  <!-- Meta-Tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="keywords" content="Clear login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
  <script>
    addEventListener("load", function () {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!-- //Meta-Tags -->
  <!-- Stylesheets -->

  <!--// Stylesheets -->
  <!--fonts-->
  <!-- title -->
  <style type="text/css">
    .lol {
      color: #ff9999;
    }
  </style>
  <link href="../user/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- body -->
  <link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">
  <!--//fonts-->
</head>

<body>
  <h1>Admin</h1>
  <div class="w3ls-login box box--big" id="box">
    <!-- form starts here -->
   <form class="login-container" method="post" action="admin-login.php">
      <div class="agile-field-txt">
            <?php if($erMes) { ?>
      <div class="alert alert-danger text-center" style="background: transparent;"><p class="lol"><?php echo $erMes;?></p></div>
      <?php } ?>
        <label>
          <i class="fas fa-phone" aria-hidden="true"></i>Phone</label>
        <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required="" />
      </div>
      <div class="agile-field-txt">
        <label>
          <i class="fas fa-key" aria-hidden="true"></i>Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required="" id="myInput" />
        <div class="agile_label">
          <input id="check3" name="check3" type="checkbox" value="show password" onclick="myFunction()">
          <label class="check" for="check3">Show password</label>
        </div>
      </div>
      <!-- script for show phone -->
 
      <!-- //script ends here -->
      <div class="w3ls-bot">
       
        <div class="form-end">
          <input type="submit" value="LOGIN" name="login" id="login">
        </div>
        <div class="clearfix"></div>
      </div>
    </form>

  </div>
  <!-- //form ends here -->
  <!--copyright-->
  <div class="copy-wthree">
    <marquee><p>© 2018 Clear Login Form. All Rights Reserved | Design by
      <a href="http://w3layouts.com/" target="_blank">Lawrence</a>
    </p></marquee>
  </div>
 
  <!--//copyright-->
</body>

</html>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
        function myFunction() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
      </script>
