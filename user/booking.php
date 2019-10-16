<?php
   include('../admin/database/connection.php');
   include('../admin/function.php');
   include('userconfig.php');
   date_default_timezone_set('Asia/Rangoon');
  $errMsg = "";
  $succMsg = "";
   if(isset($_POST['user_booking'])) {
        if(checkbooker($_POST['hidden_username'])==false) {
             $errMsg = 'You are already booked<br>';
        }else{
        $bookuser_name = clean($_POST['hidden_username']);
        }
        $bookuser_id = clean($_POST['hidden_userid']);
        $bookuser_email = clean($_POST['hidden_useremail']);
        $bookuser_pass = clean($_POST['hidden_password']);
        $bookuser_img = clean($_POST['hidden_img']);
        $bookuser_phone = clean($_POST['hidden_phone']);
        $bookuser_address = clean($_POST['hidden_address']);
        $bookuser_fb = clean($_POST['hidden_fb']);
        $bookuser_status = clean($_POST['hidden_status']);

        if(empty($_POST['bookdate'])){
          $errMsg = "Booking Date is required<br>";
        }else{
        $bookdate = clean($_POST['bookdate']);
        }
        if(empty($_POST['current'])){
          $errMsg .= "Duration is required<br>";
        }else{
          $bookduration = clean($_POST['current']);
        }
        
        if(empty($_POST['plans'])){
           $errMsg .= "Plan is required<br>";
        }else{
        $bookuserplan = clean($_POST['plans']);
        }

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

        if(empty($_POST['gend'])){
           $errMsg .= "Gender is required<br>";
        }else{
        $bookgender = clean($_POST['gend']);
        }

        if(empty($_POST['current'])){
          $errMsg .= "Duration is required<br>";
        }else{
          $bookduration = clean($_POST['current']);
        }

        if(!empty($_POST['current'])) {        
        if($bookduration == '1') {
           $startdate = date($bookdate);
           $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +1 month");
           $enddate = date('Y-m-d',$date);           
        }elseif($bookduration == '2')
        {
          $startdate = date($bookdate);
          $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +3 month");
          $enddate = date('Y-m-d',$date);
        }elseif($bookduration == '3')
        {
          $startdate = date($bookdate);
          $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +6 month");
          $enddate = date('Y-m-d',$date);
        }else{
          $startdate = date($bookdate);
          $date = strtotime(date("Y-m-d", strtotime($startdate)) . " +12 month");
          $enddate = date('Y-m-d',$date);
        }
      }
        if(empty($errMsg)) {
        $book = $conn->query("INSERT INTO booking(bookuser_id,bookuser_name,bookuser_email,bookuser_pass,bookuser_img,bookuser_phone,bookuser_address,bookuser_fb,bookuser_status,bookdate,enddate,bookduration,bookuserplan,bookage,bookweight,bookgender,booked,created_date,updated_date) VALUES ('$bookuser_id','$bookuser_name','$bookuser_email','$bookuser_pass','$bookuser_img','$bookuser_phone','$bookuser_address','$bookuser_fb','$bookuser_status','$bookdate','$enddate','$bookduration','$bookuserplan','$bookage','$bookweight','$bookgender','0',now(),now())");   
        if($book){
           header("location:cancelbooking.php?succMsg");
          }   
        }
   }
   $hello = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail='".$_SESSION['useremail']."'");
   $hay = $hello->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<title>G M S</title>
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' />  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en"> 
	<style>
        .zawgyi{
            font-family:Zawgyi-One;
        }
        .unicode{
            font-family:Myanmar3,Yunghkio,'Masterpiece Uni Sans';
        }
        .form-control-user {
        	border-radius: 20px;
        }
        .hee {
        	color: red;
        }
        .p{
        	border: 5px solid lightgray;
        	padding: 35px;
        	border-radius: 20px;
        }
     @media (max-width: 575.98px) {
      .err {
        font-size:12px;
      }
      .col-md-12, .col-sm-12 {
      	margin: 0;
      }
      .p{
      	padding: 15px;
      }
     }
     .gend{
        word-spacing: 30px;
     }
     .hola{
      word-spacing: 30px;
     }

  </style>
	<!-- Fonts and icons -->
	<link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- CSS Files -->
	<link rel="stylesheet" href="jquery-ui-1.12.1/jquery-ui.min.css">
	<link rel="stylesheet" href="assets/css/azzara.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
</head>
<body id="scroll">
	<div class="wrapper">
		<!--
				Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
	
			<!-- End Logo Header -->

			<!-- Navbar Header -->
		<?php include('includes/usernavbar.php');?>
			<!-- End Navbar -->
		
		<!-- Sidebar -->
		<?php include('includes/usersidebar.php');?>
		 <!-- End sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="col-md-12 col-sm-12">
            <div class="p">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Booking!</h1>
                 <div class="alert alert-danger alert-dismissible fade show"><button type='button' class='close' data-dismiss='alert'>&times;</button>(<span class="hee">*</span>)Fields must be filled.</div>
                 </div>
              <form class="user" action="booking.php" method="POST" enctype="multipart/form-data">
                   <?php if($errMsg) {
                      echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              $errMsg</div>";
                   }?>
                   <?php if(isset($_GET['succMsg'])) {
                      echo "<div class='alert alert-success alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                               Your booking is cancelled successfully!</div>";
                   }?>  
                <input type="hidden" name="hidden_userid" value="<?php echo $hay['userid']?>">
                <input type="hidden" name="hidden_username" value="<?php echo $hay['username']?>">
                <input type="hidden" name="hidden_useremail" value="<?php echo $hay['useremail']?>">
                <input type="hidden" name="hidden_password" value="<?php echo $hay['userpass']?>">
                <input type="hidden" name="hidden_img" value="<?php echo $hay['user_img']?>">
                <input type="hidden" name="hidden_phone" value="<?php echo $hay['userphone']?>">
                <input type="hidden" name="hidden_address" value="<?php echo $hay['useraddress']?>">
                <input type="hidden" name="hidden_fb" value="<?php echo $hay['userfb']?>">
                <input type="hidden" name="hidden_status" value="<?php echo $hay['userstatus']?>">
                <div class="form-group row">
                        <label for="bookdate" class="col-sm-2 col-form-label"><b>Book Date:<span class="hee">*</span></b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-user" id="bookdate" name="bookdate" placeholder="Select Date">
                   </div>
                </div>

                <div class="form-group row">
                        <label for="current" class="col-sm-2 col-form-label"><b>Duration:<span class="hee">*</span></b></label>
                    <div class="col-sm-10">
                      <?php $hi = $conn->query("SELECT * FROM current ORDER BY current_id ASC"); ?>
                       <select name="current" id="current" class="form-control form-control-user" required="">
                         <option value="0">--SELECT--</option>
                       <?php  while($hii = $hi->fetch_assoc()): ?>
                        <option value="<?php echo $hii['current_id']?>"><?php echo $hii['current_name']?></option>
                            <?php endwhile; ?>
                        </select>                      
                   </div>
                </div> 

                <div class="form-group row">
                        <label for="plans" class="col-sm-2 col-form-label"><b>Plan:<span class="hee">*</span></b></label>
                    <div class="col-sm-10">
                      <?php $he = $conn->query("SELECT * FROM plans ORDER BY plan_id ASC"); ?>
                       <select name="plans" id="plans" class="form-control form-control-user" required="">
                         <option value="0">--SELECT--</option>
                       <?php  while($hee = $he->fetch_assoc()): ?>
                        <option value="<?php echo $hee['plan_id']?>"><?php echo $hee['plan_name']?></option>
                            <?php endwhile; ?>
                        </select>                     
                   </div>
                </div> 

                <div class="form-group row">
                        <label for="bookage" class="col-sm-2 col-form-label"><b>Age:<span class="hee">*</span></b></label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control form-control-user" id="bookage" name="bookage" placeholder="Age">
                   </div>
                </div>

                <div class="form-group row">
                        <label for="bookweight" class="col-sm-2 col-form-label"><b>Weight<span class="hee">*</span></b></label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control form-control-user" id="bookweight" name="bookweight" placeholder="lb">
                   </div>
                </div>                              

                <div class="form-group row">
                        <label for="gend" class="col-sm-2 col-form-label"><b>Gender:<span class="hee">*</span></b></label>
                    <div class="col-sm-10" class="form-control form-control-user">
                      <span class="hola"> </span><input type="radio" name="gend" value="1" checked="">Male<span class="gend"> </span>
                      <input type="radio" name="gend" value="2">Female                                          
                    </div>
                </div>                            
                
                <button class="btn btn-primary btn-user btn-block" name="user_booking">
                  Booking
                </button>
                <hr>     
              </form>
              <hr>
          
            </div>
          </div>					              					
					</div>

				</div>
			</div>
			
		</div>

	
		<!-- Custom template | don't include it in your project! -->
		<?php include('includes/usersettings.php');?>
    
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<!-- Bootstrap Toggle -->
	<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	<!-- jQuery Scrollbar -->
	<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Azzara JS -->
	<script src="assets/js/ready.min.js"></script>
	<!-- Azzara DEMO methods, don't include it in your project! -->
	<script src="assets/js/setting-demo.js"></script>
  <script src="jquery-ui-1.12.1/jquery.js"></script>
  <script src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
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
