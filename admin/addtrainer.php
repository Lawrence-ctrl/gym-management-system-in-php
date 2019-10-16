<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  date_default_timezone_set('Asia/Rangoon');
    $errMsg = "";
    $succMsg = "";
    $x = "";
    $expend = 0;
    $traniner_fees = 0;
    if(isset($_POST['add_t'])) 
    { 
           if(empty($_POST['trainer_name'])){
            $errMsg = "Username is required<br>";
            }elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['trainer_name'])){
            $errMsg .= "Only letters and white space allowed in username<br>";
            }elseif(strlen($_POST['trainer_name'])<4)
            {
              $errMsg.= "Type at least 4 letters<br>";
            }
            elseif(strlen($_POST['trainer_name'])>=15)
            {
            $errMsg.= "Only 15 letters are allowed<br>";
            }
            elseif(checkusername($_POST['trainer_name'])==false) {
            $errMsg .="Username is already exist<br>";
            }else{
            $trainer_name = clean($_POST['trainer_name']);
            }

           if(empty($_POST['trainer_email'])){
           $errMsg .= "Email is required<br>";
           }elseif(!filter_var($_POST['trainer_email'],FILTER_VALIDATE_EMAIL))
           {
            $errMsg.= "Invalid Email Format!<br>";
           }elseif(checkemail($_POST['trainer_email'])==false) {
            $errMsg.= "Email already exists<br>";
           }else{
            $trainer_email = clean($_POST['trainer_email']);
           }

          if(empty($_POST['trainer_pass'])){
           $errMsg .= "Password is required<br>";
           }elseif($_POST['trainer_pass']!=$_POST['trainerpass_repeat']){
            $errMsg .= "Passwords must be equal<br>";
           }else{
            $trainer_pass = clean(md5($_POST['trainer_pass']));
           }

           if(empty($_POST['trainerpass_repeat'])){
           $errMsg .= "Repeatpassword is required<br>";
           }

           if(empty($_FILES['trainer_photo']['name'])){
              $errMsg .= "ပုံထည့်ပါ။<br>";
             }else{
              $cover = $_FILES['trainer_photo']['name'];
              $filename = uniqid().'_'.$cover;
              $tmp = $_FILES['trainer_photo']['tmp_name'];
              $type = $_FILES['trainer_photo']['type'];
              $size = $_FILES['trainer_photo']['size'];
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

           if(empty($_POST['trainer_phone'])){
           $errMsg .= "Phone is required<br>";
           }else{
           $trainer_phone =clean($_POST['trainer_phone']);
           }

            if(empty($_POST['trainer_address'])){
            $errMsg .= "Address is required<br>";
           }else{
           $trainer_address =clean($_POST['trainer_address']);
           }

           $trainer_fb = clean($_POST['trainer_fb']);


        if(empty($_POST['traindate'])){
        $errMsg .= "Start Date is required<br>";
        }else{
        $traindate = clean($_POST['traindate']);
        }
        if(empty($_POST['tduration'])){
          $errMsg .= "Duration is required<br>";
        }else{
          $tduration = clean($_POST['tduration']);
        }

      if(!empty($_POST['tduration'])) {        
        if($tduration == '1') {
           $startdate = date($traindate);
           $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +6 month");
           $enddate = date('Y-m-d',$date);
           $x = 6;           
        }elseif($tduration == '2')
        {
          $startdate = date($traindate);
          $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +1 year");
          $enddate = date('Y-m-d',$date);
          $x= 12;
        }elseif($tduration == '3')
        {
          $startdate = date($traindate);
          $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +18 month");
          $enddate = date('Y-m-d',$date);
          $x= 18;
        }else{
          $startdate = date($traindate);
          $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +2 year");
          $enddate = date('Y-m-d',$date);
          $x = 24;
        }
      }
        
        if(empty($_POST['bookuserplan'])){
           $errMsg .= "Plan is required<br>";
        }else{
        $bookuserplan = clean($_POST['bookuserplan']);   
        }

        if(empty($_POST['trainer_fees'])){
          $errMsg .= "Trainer Fees is required<br>";
        }else{
          $trainer_fees = clean($_POST['trainer_fees']);
        }
        if($_POST['trainer_fees']) {
        $expend = $x*$trainer_fees;
        }
        if(empty($_POST['bookgender'])){
           $errMsg .= "Gender is required<br>";
        }else{
        $bookgender = clean($_POST['bookgender']);
        }

        if(empty($errMsg)) {
        $insert =  $conn->query("INSERT INTO users(username,useremail,userpass,user_img,userphone,useraddress,userfb,userstatus,created_date,updated_date) VALUES ('$trainer_name','$trainer_email','$trainer_pass','$filename','$trainer_phone','$trainer_address','$trainer_fb','2',now(),now())"); 
        $inser = $conn->insert_id;
        if($insert){
          $book = $conn->query("INSERT INTO trainers(user_id,trainer_name,trainer_email,trainer_photo,trainer_fees,trainer_pass,tstart_date,tend_date,t_duration,trainer_exer_id,trainer_phone,trainer_address,trainer_fb,trainer_gender,created_date,modified_date) VALUES ('$inser','$trainer_name','$trainer_email','$filename','$trainer_fees','$trainer_pass','$traindate','$enddate','$tduration','$bookuserplan','$trainer_phone','$trainer_address','$trainer_fb','$bookgender',now(),now())"); 
          $boid = $conn->insert_id;
          if($book) {
          $in = $conn->query("INSERT INTO expenditure 
            (trainer_id,trainer_email,trainer_expend,created_date,updated_date) VALUES ('$boid','$trainer_email','$expend',now(),now())");
           $succMsg = "Added trainer successfully";
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
            <h1 class="h3 mb-0 text-gray-800">Add Trainer</h1>
          </div>

          <!-- Content Row -->
          <div class="row">         
            <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Add</h1>
              </div>
              <form class="user" action="addtrainer.php" method="POST" enctype="multipart/form-data">
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
                  <input type="name" class="form-control form-control-user" name="trainer_name" placeholder="Enter Username" >
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="trainer_email" placeholder="Email Address" >
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="trainer_pass" placeholder="Password" >
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="trainerpass_repeat" placeholder="Repeat Password" >
                  </div> 
                </div>
                <div class="form-group">
                  <input type="text"  name="trainer_fees" class="form-control form-control-user" placeholder="Fees">
                </div>
                <div class="form-group">
                  <input type="file" name="trainer_photo">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="trainer_phone" placeholder="Enter phone number" >
                </div>
                <div class="form-group">
                  <textarea name="trainer_address" class="form-control form-control-user" placeholder="Address" ></textarea>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="trainer_fb" placeholder="Enter facebook link">
                </div>
                <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="traindate" name="traindate" placeholder="Select Date" >
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <?php $hi = $conn->query("SELECT * FROM t_current ORDER BY t_id ASC"); ?>
                       <select name="tduration" id="tduration" class="form-control" >
                         <option value="0">--SELECT DURATION--</option>
                       <?php  while($hii = $hi->fetch_assoc()): ?>
                        <option value="<?php echo $hii['t_id']?>"><?php echo $hii['tc_name']?></option>
                            <?php endwhile; ?>
                        </select>   
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
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
              <input type="submit" class="btn btn-primary btn-user btn-block" name="add_t" value="ADD">
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
      $('#traindate').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:"2019:2022",
        closeText: "Close",
        dateFormat: "yy-mm-dd"
      });
  });
</script>
