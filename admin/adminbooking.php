<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  date_default_timezone_set('Asia/Rangoon');
  $errMsg = "";
  $succMsg = "";
  $wayy = $conn->query("SELECT * FROM plans");
    if(isset($_POST['book'])) 
    { 
           if(empty($_POST['bookuser_name'])){
            $errMsg = "Username is required<br>";
            }elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['bookuser_name'])){
            $errMsg .= "Only letters and white space allowed in username<br>";
            }elseif(strlen($_POST['bookuser_name'])<4)
            {
              $errMsg.= "Type at least 4 letters<br>";
            }
            elseif(strlen($_POST['bookuser_name'])>=15)
            {
            $errMsg.= "Only 15 letters are allowed<br>";
            }
            elseif(checkusername($_POST['bookuser_name'])==false) {
            $errMsg .="Username is already exist<br>";
            }else{
            $bookuser_name = clean($_POST['bookuser_name']);
            }

           if(empty($_POST['bookuser_email'])){
           $errMsg .= "Email is required<br>";
           }elseif(!filter_var($_POST['bookuser_email'],FILTER_VALIDATE_EMAIL))
           {
            $errMsg.= "Invalid Email Format!<br>";
           }elseif(checkemail($_POST['bookuser_email'])==false) {
            $errMsg.= "Email already exists<br>";
           }else{
            $bookuser_email = clean($_POST['bookuser_email']);
           }

          if(empty($_POST['bookuser_pass'])){
           $errMsg .= "Password is required<br>";
           }elseif($_POST['bookuser_pass']!=$_POST['bookpass_repeat']){
            $errMsg .= "Passwords must be equal<br>";
           }else{
            $bookuser_pass = clean(md5($_POST['bookuser_pass']));
           }

           if(empty($_POST['bookpass_repeat'])){
           $errMsg .= "Repeatpassword is required<br>";
           }

           if(empty($_FILES['bookuser_img']['name'])){
              $errMsg .= "ပုံထည့်ပါ။<br>";
             }else{
              $cover = $_FILES['bookuser_img']['name'];
              $filename = uniqid().'_'.$cover;
              $tmp = $_FILES['bookuser_img']['tmp_name'];
              $type = $_FILES['bookuser_img']['type'];
              $size = $_FILES['bookuser_img']['size'];
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

           if(empty($_POST['bookuser_phone'])){
           $errMsg .= "Phone is required<br>";
           }else{
           $bookuser_phone =clean($_POST['bookuser_phone']);
           }

            if(empty($_POST['bookuser_address'])){
            $errMsg .= "Address is required<br>";
           }else{
           $bookuser_address =clean($_POST['bookuser_address']);
           }

           $bookuser_fb = clean($_POST['bookuser_fb']);

        if(empty($_POST['bookage'])){
           $errMsg .= "Age is required<br>";
        }else{
        $bookage = clean($_POST['bookage']);
        }

        if(empty($_POST['bookweight'])){
           $errMsg .= "Weight is required<br>";
        }else{
        $bookweight = clean($_POST['bookweight']);
        }

         if(empty($_POST['bookdate'])){
        $errMsg .= "Booking Date is required<br>";
        }else{
        $bookdate = clean($_POST['bookdate']);
        }
        if(empty($_POST['bookduration'])){
          $errMsg .= "Duration is required<br>";
        }else{
          $bookduration = clean($_POST['bookduration']);
        }

      if(!empty($_POST['bookduration'])) {        
        if($bookduration == '1') {
           $startdate = date($bookdate);
           $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +1 month");
           $enddate = date('Y-m-d',$date);
           $x = 1;           
        }elseif($bookduration == '2')
        {
          $startdate = date($bookdate);
          $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +3 month");
          $enddate = date('Y-m-d',$date);
          $x= 3;
        }elseif($bookduration == '3')
        {
          $startdate = date($bookdate);
          $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +6 month");
          $enddate = date('Y-m-d',$date);
          $x= 6;
        }else{
          $startdate = date($bookdate);
          $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +12 month");
          $enddate = date('Y-m-d',$date);
          $x = 12;
        }
      }
        
        if(empty($_POST['bookuserplan'])){
           $errMsg .= "Plan is required<br>";
        }else{
        $bookuserplan = clean($_POST['bookuserplan']);
        foreach ($wayy as $key => $way) {
         if($bookuserplan == $way['plan_id']) {
             $price = $way['plan_price'];
           }
        }
             $income = $x*$price;
           }
        if(empty($_POST['bookgender'])){
           $errMsg .= "Gender is required<br>";
        }else{
        $bookgender = clean($_POST['bookgender']);
        }

        if(empty($errMsg)) {
        $insert =  $conn->query("INSERT INTO users(username,useremail,userpass,user_img,userphone,useraddress,userfb,userstatus,u_status,created_date,updated_date) VALUES ('$bookuser_name','$bookuser_email','$bookuser_pass','$filename','$bookuser_phone','$bookuser_address','$bookuser_fb','1','1',now(),now())"); 
        $inser = $conn->insert_id;
        if($insert){
          $book = $conn->query("INSERT INTO booking(bookuser_id,bookuser_name,bookuser_email,bookuser_pass,bookuser_img,bookuser_phone,bookuser_address,bookuser_fb,bookuser_status,bookdate,enddate,bookduration,bookuserplan,bookage,bookweight,bookgender,booked,created_date,updated_date) VALUES ('$inser','$bookuser_name','$bookuser_email','$bookuser_pass','$filename','$bookuser_phone','$bookuser_address','$bookuser_fb','1','$bookdate','$enddate','$bookduration','$bookuserplan','$bookage','$bookweight','$bookgender','1',now(),now())"); 
          $succMsg = "Booked successfully";
          $boid = $conn->insert_id;
          if($book) {
          $in = $conn->query("INSERT INTO income(book_id,member_email,income,created_date,updated_date) VALUES ('$boid','$bookuser_email','$income',now(),now())");
          }   
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

  <title>G M S</title>
  <style>  
    .gend {
      word-spacing: 30px;
    }
    .hola {
      word-spacing: 20px;
    }
  </style>
  <link rel="icon" href="img/icons8-hongkong-dollar-64.png" type="image/x-icon"/>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../user/jquery-ui-1.12.1/jquery-ui.min.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('includes/sidebar.php');?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include('includes/navbar.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Booking</h1>
          </div>

          <!-- Content Row -->
          <div class="row">         
            <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Booking!</h1>
              </div>
              <form class="user" action="adminbooking.php" method="POST" enctype="multipart/form-data">
                <?php if($errMsg) {
                      echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $errMsg</div>";
                   }?>
                   <?php if($succMsg) {
                      echo "<div class='alert alert-success alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $succMsg</div>";
                   }?>  
                <div class="form-group">
                  <input type="name" class="form-control form-control-user" name="bookuser_name" placeholder="Enter Username" >
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="bookuser_email" placeholder="Email Address" >
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="bookuser_pass" placeholder="Password" >
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="bookpass_repeat" placeholder="Repeat Password" >
                  </div> 
                </div>
                <div class="form-group">
                  <input type="file" name="bookuser_img">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="bookuser_phone" placeholder="Enter phone number" >
                </div>
                <div class="form-group">
                  <textarea name="bookuser_address" class="form-control form-control-user" placeholder="Address" ></textarea>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="bookuser_fb" placeholder="Enter facebook link">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" class="form-control form-control-user" name="bookage" placeholder="Age" >
                  </div>
                  <div class="col-sm-6">
                    <input type="number" class="form-control form-control-user" name="bookweight" placeholder="LB" >
                  </div> 
                </div>
                <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="bookdate" name="bookdate" placeholder="Select Date" >
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <?php $hi = $conn->query("SELECT * FROM current ORDER BY current_id ASC"); ?>
                       <select name="bookduration" id="bookduration" class="form-control" >
                         <option value="0">--SELECT DURATION--</option>
                       <?php  while($hii = $hi->fetch_assoc()): ?>
                        <option value="<?php echo $hii['current_id']?>"><?php echo $hii['current_name']?></option>
                            <?php endwhile; ?>
                        </select>   
                  </div>
                  <div class="col-sm-6">
                      <?php $he = $conn->query("SELECT * FROM plans ORDER BY plan_id ASC"); ?>
                       <select name="bookuserplan" id="bookuserplan" class="form-control" >
                         <option value="0">--SELECT PLAN--</option>
                       <?php  while($hee = $he->fetch_assoc()): ?>
                        <option value="<?php echo $hee['plan_id']?>"><?php echo $hee['plan_name']?></option>
                            <?php endwhile; ?>
                        </select>
                  </div> 
              </div>
              <div class="form-group row">                   
                      <div class="col-lg-12" class="form-control form-control-user">
                      <span class="hola"> </span><input type="radio" name="bookgender" value="1" checked="">Male<span class="gend"> </span>
                      <input type="radio" name="bookgender" value="2">Female                                          
                    </div>                                       
                </div>
              <input type="submit" class="btn btn-primary btn-user btn-block" name="book" value="BOOK">
              </form>
              <hr>
            </div>     
             </div>
          </div>  
          </div>
        </div>

      </div>
        <!-- /.container-fluid -->

    </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include('includes/footer.php'); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

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
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
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
  });
</script>
