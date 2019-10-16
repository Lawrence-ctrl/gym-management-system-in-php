<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   $errMsg="";
   $succMsg = "";
   $check = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail = '".$_SESSION['useremail']."'");
   $law = $check->fetch_assoc();

   $hello = $conn->query("SELECT * FROM booking WHERE bookuser_email= '".$_SESSION['useremail']."'");
   $ha = $hello->fetch_assoc();
   $book_id = clean($ha['book_id']);
    if(isset($_POST['echange']))
    {
       $member_id = clean($_POST['hidmemberid']);
       $memberinfo->set_member_id(clean($member_id));
       if(empty($_POST['member_email'])){
           $errMsg .= "Email is required<br>";
           }elseif(!filter_var($_POST['member_email'],FILTER_VALIDATE_EMAIL))
           {
            $errMsg.= "Invalid Email Format!<br>";
           }elseif($memberbol->checkingemailid($_POST['member_email'],$member_id)==false) {
            $errMsg.= "Email already exists<br>";
           }else{
           $memberinfo->set_member_email(clean($_POST['member_email']));
           }
           if(empty($errMsg)) {
           $editmember = $memberbol->changeemail($memberinfo);
           if($editmember) {
              header("location: userprofile.php?sucemail");
            }
           }
    }

    if(isset($_POST['uprofile']))
    {   
           $userid = clean($_POST['hiduserid']);

          if(!empty($_FILES['userimg']['name']))
          {
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
            elseif(checker($_POST['username'],$userid)==false) {
            $errMsg .="Username is already exist<br>";
            }else{
            $username = clean($_POST['username']);
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
              if(!empty($_FILES['userimg']['name'])) {
            $add = $conn->query("UPDATE users SET username='$username',user_img ='$filename',userphone='$userphone',useraddress='$useraddress',userfb ='$userfb',updated_date = now() WHERE userid = $userid"); 
                   if($ha['booked'] == '1'){
                    $halo = $conn->query("UPDATE booking SET bookuser_name='$username',bookuser_img ='$filename',bookuser_phone='$userphone',bookuser_address='$useraddress',bookuser_fb ='$userfb',updated_date = now() WHERE book_id = $book_id"); 
                   }
             }else{
              $add = $conn->query("UPDATE users SET username='$username',userphone='$userphone',useraddress='$useraddress',userfb = '$userfb',updated_date=now() WHERE userid='$userid'");
              if($ha['booked'] == '1'){
                    $halo = $conn->query("UPDATE booking SET bookuser_name='$username',bookuser_phone='$userphone',bookuser_address='$useraddress',bookuser_fb ='$userfb',updated_date = now() WHERE book_id = $book_id"); 
                   } 
             }  
           if($add){
              $succMsg = 'Updated Successfully';
          }
         }    
    }
  
   
     if(isset($_GET['sucemail'])){
      header("Refresh:3");
      session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<title>G M S</title>
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>
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
        .car {
      border: 1px solid lightgray;
      border-radius: 5px;
      padding-top: 10px;
    }
     .card-title {
      font-weight: bold;
      font-size: 15px;
      text-align: center;
      border: 1px solid lightgray;
      border-radius: 5px;
      color: gray;
     }
     .he {
      margin-bottom: 5px;
     }
     .ta {
      height: 200px;
     }
     @media (max-width: 575.98px) {
      .card-body{
        display: none;
      }
     }
     .scroll-to-top {
      position: fixed;
      right: 1rem;
      bottom: 1rem;
      display: none;
      width: 2.75rem;
      height: 2.75rem;
      text-align: center;
      color: #fff;
      background: rgba(90,92,105,.5);
      line-height: 46px;
    </style>
	<!-- Fonts and icons -->
	<link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
					<!-- Card -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="page-title">Profile</h4>
                    </div> 
                    <hr>
					<div class="row">
						 <div class="col-md-12">
                        <div class="card">
                            
                            <div class="content" >
                                <form method="POST" action="userprofile.php" enctype="multipart/form-data">
                                    <?php if($errMsg) { 
                                              echo"<div class='alert alert-danger alert-dismissible fade show'>$errMsg
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                         </div>";
                                    } ?>
                                    <?php if($succMsg) { 
                                              echo"<div class='alert alert-success alert-dismissible fade show'>$succMsg
                                                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                         </div>";
                                    } ?>
                                   <input type="hidden" name="hiduserid" id="hiduserid" value="<?php echo $law['userid']?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="username" placeholder="Enter Username" value="<?php echo $law['username']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Facebook Name</label>
                                                <input type="text" class="form-control" name="userfb" placeholder="Last Name" value="<?php echo $law['userfb']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                            <div class="form-group">
                                    <img src="../admin/images/<?php echo $law['user_img']?>" alt="" height="150">
                                    <label for="user_img">Change Photo:</label>
                                    <input type="file" name="userimg" id="user_img">
                                    </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="useraddress" placeholder="Home Address" value="<?php echo $law['useraddress']?>">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" name="userphone" placeholder="Phone Number" value="<?php echo $law['userphone']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                     <?php if($ha['booked'] =='1') : ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Member ID</label>
                                                <input type="text" class="form-control" disabled="" placeholder="password" value="<?php echo $ha['book_id']?>">
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>My ID</label>
                                                <input type="text-white-50" disabled class="form-control" value="<?php echo $law['userid']?>">
                                            </div>
                                        </div>
                                   <?php endif; ?>
                                    </div>
                                  

                                    <button type="submit" name="uprofile" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
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
</body>
</html>
