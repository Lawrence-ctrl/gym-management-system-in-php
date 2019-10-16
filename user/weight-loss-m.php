<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
     if(isset($_GET['cat_id']))
  {
    if($_GET['cat_id'] == '1') {
       $exe = $conn->query("SELECT * FROM exercises WHERE gender='1' AND exer_plan='3'");
    }elseif($_GET['cat_id']) {
       $cat_id = mysqli_real_escape_string($conn,$_GET['cat_id']);
       $exe = $conn->query("SELECT * FROM exercises WHERE exer_category_id='$cat_id' and gender='1' AND exer_plan='3'"); 
    } 
  }else{
      $exe = $conn->query("SELECT * FROM exercises WHERE gender='1' AND exer_plan='3'");
  }  
  $result = $conn->query("SELECT * FROM exercises_category");
    if(isset($_POST['action']))  {
        $favoexer_id = clean($_POST['exer_id']);
        $favouser_id = $_SESSION['userid'];
        $action = $_POST['action'];
        switch ($action) {
            case 'fav':
                 mysqli_query($conn, "INSERT INTO favourites(favoexer_id, favouser_id,action,created_date,updated_date) VALUES ('$favoexer_id','$favouser_id','$action',now(),now())");
                break;
            case 'unfav':
            mysqli_query($conn, "DELETE FROM favourites WHERE favoexer_id=$favoexer_id AND favouser_id=$favouser_id");
            break;
            
            default:
                # code...
                break;
        }
       }
    $users = $conn->query("SELECT * FROM booking WHERE bookuser_email='".$_SESSION['useremail']."'");
    $us = $users->fetch_assoc();
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
   
    </style>
	<!-- Fonts and icons -->
	<link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/azzara.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
  <link rel="stylesheet" href="assets/css/my.css">
</head>
<body>
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
                    <?php 
                       if(isset($_GET['cat_id'])) {
                          $cat_id = $_GET['cat_id'];
                          $res = $conn->query("SELECT * FROM exercises_category WHERE cat_id='$cat_id'");
                          $hi = $res->fetch_assoc();         
                       ?>
                       <h4 class="page-title"><?php echo $hi['exercises_name']?></h4>
                     <?php }else{ ?>
                        <h4 class="page-title">Weight Loss (Male)</h4>
                     <?php } ?>                         
                    </div> 
                    <div class="row">
                       <?php $result = $conn->query("SELECT * FROM exercises_category");
                        while($row = $result->fetch_assoc()): ?>
                          <div class="col-md-2 col-sm-6 col-xs-6">
                             <a href="?cat_id=<?php echo $row['cat_id']?>" class="btn btn-primary btn-lg btn-block he"><?php echo $row['exercises_name']?>                               
                             </a>
                          </div>
                       <?php endwhile; ?>
                    </div>
                    <hr>
            <?php if($us['booked'] == '1' || $law['userstatus'] == '2') : ?>
					<div class="row">
						<?php 
                        while($erow = $exe->fetch_assoc()): ?>
                        
                          <div class="col-md-3 col-6 car">
                            <a style="text-decoration: none;" href="udetails-exercises.php?exer_id=<?php echo $erow['exer_id']?>&&cat_id=<?php echo $erow['exer_category_id']?>&&sex=<?php echo $erow['gender']?>">
                              <img class="card-img-top ta" src="../admin/images/<?php echo $erow['exer_img']?>" alt="Card image cap">
                         
                                <div class="card-body">
                                  <h5 class="card-title"><?php echo $erow['exer_name']?></h5>                     
                                </div>
                            </a>
                                <?php $fav = $conn->query("SELECT * FROM favourites WHERE favoexer_id=".$erow['exer_id']." AND favouser_id ='".$_SESSION['userid']."'");
                                 if($fav->num_rows == '1') { ?>
                            <i class="fas fa-heart text-secondary heart" id="<?php echo $erow['exer_id']?>"></i>
                            <?php  } else { ?>
                             <i class="far fa-heart text-secondary heart" id="<?php echo $erow['exer_id']?>"></i>
                                <?php } ?>
                          </div>                    
                        <?php endwhile; ?>
                        
                        <a class="btn btn-secondary scroll-to-top" href="#scroll">
                        <i class="fas fa-angle-up"></i>
                        </a> 
                       					
					</div>
          <?php else: ?>
            <div class="row">
            <?php 
                        while($erow = $exe->fetch_assoc()): ?>
                        
                          <div class="col-md-3 col-6 car">
                            <a style="text-decoration: none;" href="udetails-exercises.php?exer_id=<?php echo $erow['exer_id']?>&&cat_id=<?php echo $erow['exer_category_id']?>&&sex=<?php echo $erow['gender']?>">
                              <img class="card-img-top ta" src="../admin/images/<?php echo $erow['exer_img']?>" alt="Card image cap">
                         
                                <div class="card-body">
                                  <h5 class="card-title"><?php echo $erow['exer_name']?></h5>                     
                                </div>
                            </a>
                                
                          </div>                    
                        <?php endwhile; ?>
                        
                        <a class="btn btn-secondary scroll-to-top" href="#scroll">
                        <i class="fas fa-angle-up"></i>
                        </a> 
                                
          </div>
        <?php endif; ?>
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
<script>
        $(document).ready(function(){
            $('.heart').on('click', function(){
                var exer_id = $(this).attr('id');
                //alert(exer_id);
                $click_fav = $(this);

                if ($click_fav.hasClass('far fa-heart')) {
                    action = 'fav';
                    
                }else if($click_fav.hasClass('fas fa-heart')) {
                    action = 'unfav';
                }
              
                $.ajax({
                    url: "m-exercises.php",
                    method : "POST",
                    data : {
                        'exer_id' : exer_id,
                        'action' : action
                    },
                    success : function(data) {
                        if(action == 'fav') {
                            $click_fav.removeClass('far fa-heart');
                            $click_fav.addClass('fas fa-heart');
                        }else if(action == 'unfav') {
                            $click_fav.removeClass('fas fa-heart');
                            $click_fav.addClass('far fa-heart');
                        }
                    }
                });
            });
        });
    </script>