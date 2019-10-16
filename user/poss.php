<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   if(isset($_GET['pos_id']))
   {
    $pos_cat_id = clean($_GET['pos_id']);
    if($pos_cat_id == '1'){
      $tran = $conn->query("SELECT * FROM pos");
    }else{
    $tran = $conn->query("SELECT * FROM pos WHERE pos_category=$pos_cat_id");
  }
}else{
    $tran = $conn->query("SELECT * FROM pos");
    }
    $users = $conn->query("SELECT * FROM booking WHERE bookuser_email='".$_SESSION['useremail']."'");
    $us = $users->fetch_assoc();
    if(isset($_GET['atc_id']))
    {
      if(isset($_SESSION['cart'])){
        $array_co = array_column($_SESSION['cart'],'pos_id');
        if(!in_array($_GET['atc_id'], $array_co))
        {

              $count = count($_SESSION['cart']);  
           $_SESSION['cart'][$count] = array
          (
          'pos_id' => $_GET['atc_id'],
          'member_id' => $_POST['hidmemberid'],
          'pos_name'  => $_POST['hidposname'],
          'pos_price' => $_POST['hidposprice'],
          'pos_quantity' => $_POST['pos_quantity']
          );
        }
        else{
          for($i = 0; $i<count($array_co); $i++)
           
          {
            if($_GET['atc_id'] == $array_co[$i])
            {
              $_SESSION['cart'][$i]['pos_quantity'] = $_POST['pos_quantity'];
            }

            }
          }

      }else{
        $_SESSION['cart'][0] = array(
          'pos_id' => $_GET['atc_id'],
          'member_id' => $_POST['hidmemberid'],
          'pos_name'  => $_POST['hidposname'],
          'pos_price' => $_POST['hidposprice'],
          'pos_quantity' => $_POST['pos_quantity']
        );
      }
    }
if(isset($_SESSION['cart'])) {
   $cou = count($_SESSION['cart']);
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
        @media(min-width: 575.98px) {
        .badge{
          position: absolute;
          top: 10%;
          font-size: 7px;
          
        }
      }
   
    </style>
	<!-- Fonts and icons -->
	<link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/azzara.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
  <link rel="stylesheet" href="assets/css/mine.css">
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
                        <!-- <?php if($_GET['pos_id'] == '2') { ?>
                        <h4 class="page-title">Drinks</h4>
                        <?php }elseif($_GET['pos_id'] == '3') { ?>
                        <h4 class="page-title">Medicines</h4>
                        <?php }else{ ?> -->
                        <h4 class="page-title">All</h4>
                      <?php } ?>
                      <?php if(isset($_SESSION['cart'])) : ?>
                         <div class="text-right">
                              <a href="addcart.php"><i class="fas fa-shopping-cart fa-lg text-success"><span class="badge badge-info badge"><?php echo $cou?></span></i></a>
                         </div> 
                      <?php endif; ?>                  
                    </div> 
                    
                    <hr>
                  <div class="row">
                <?php if($char['booked'] == '1' || $law['userstatus'] == '2') { ?>
                 <?php while($tra = $tran->fetch_assoc()):
                   if($tra['pos_quantity'] > '0') { ?>
                  <div class="col-md-3 col-12">
                     <form action="poss.php?atc_id=<?php echo $tra['pos_id']?>" method="POST">
                    <div class="card">
                      <img class="card-img-top" style="height: 200px" src="../admin/images/<?php echo $tra['pos_image']?>" alt="Bologna">
                      <div class="card-body">
                        <h4 class="card-title"><?php echo $tra['pos_name']?></h4>
                         <h5 class="card-title text-primary"><?php echo $tra['pos_price']?> Ks</h5>
                        <div class="form-row align-items-center">
                            <div class="col-auto my-1">
                              <select class="form-control mr-sm-2" name="pos_quantity">
                                 <?php for($i=1; $i<=$tra['pos_quantity']; $i++) { ?>
                              <option value="<?php echo $i?>"><?php echo $i?></option>
                               <?php } ?>
                              </select>
                            </div>
                        </div>
                        <input type="hidden" name="hidmemberid" value="<?php echo $us['book_id']?>">
                        <input type="hidden" name="hidposname" value="<?php echo $tra['pos_name']?>">
                        <input type="hidden" name="hidposprice" value="<?php echo $tra['pos_price']?>">
                        <div class="card-footer text-center">
                        <a href="userposdetails.php?possid=<?php echo $tra['pos_id']?>&&pos_cat_id=<?php echo $tra['pos_category']?>" class="card-link btn btn-danger btn-rounded btn-sm">Read More</a>
                        <input type="submit" class="card-link btn btn-info btn-rounded btn-sm" name="ATC" value="Add To Cart">
                      </div>
                      </div>
                    </div> 
                      </form>
                   </div>
                      <?php }else{ ?>
                        <div class="col-md-3 col-12" style="opacity: 0.4">
                     
                    <div class="card">
                      <img class="card-img-top" style="height: 200px" src="../admin/images/<?php echo $tra['pos_image']?>" alt="Bologna">
                      <div class="card-body">
                        <h4 class="card-title"><?php echo $tra['pos_name']?></h4>
                         <h5 class="card-title text-primary"><?php echo $tra['pos_price']?> Ks</h5>
                        <div class="form-row align-items-center">
                            <p>No more left</p>
                        </div>
                        <input type="hidden" name="hidmemberid" value="<?php echo $us['book_id']?>">
                        <input type="hidden" name="hidposname" value="<?php echo $tra['pos_name']?>">
                        <input type="hidden" name="hidposprice" value="<?php echo $tra['pos_price']?>">
                        <div class="card-footer text-center">
                        <a href="userposdetails.php?possid=<?php echo $tra['pos_id']?>&&pos_cat_id=<?php echo $tra['pos_category']?>" class="card-link btn btn-danger btn-rounded btn-sm">Read More</a>
                      </div>
                      </div>
                    </div> 
                   </div>

                      <?php } ?>
                    <?php endwhile; ?>
                  <?php }else{
                      while($tra = $tran->fetch_assoc()) : ?>
                  
                       <div class="col-md-3 col-12">
                     
                    <div class="card">
                      <img class="card-img-top" style="height: 200px" src="../admin/images/<?php echo $tra['pos_image']?>" alt="Bologna">
                      <div class="card-body">
                        <h4 class="card-title"><?php echo $tra['pos_name']?></h4>
                         <h5 class="card-title text-primary"><?php echo $tra['pos_price']?> Ks</h5>
                        <div class="form-row align-items-center">
                           
                        </div>
                        <input type="hidden" name="hidmemberid" value="<?php echo $us['book_id']?>">
                        <input type="hidden" name="hidposname" value="<?php echo $tra['pos_name']?>">
                        <input type="hidden" name="hidposprice" value="<?php echo $tra['pos_price']?>">
                        <div class="card-footer text-center">
                        <a href="userposdetails.php?possid=<?php echo $tra['pos_id']?>&&pos_cat_id=<?php echo $tra['pos_category']?>" class="card-link btn btn-danger btn-rounded btn-sm">Read More</a>
                      </div>
                      </div>
                    </div> 
                   </div>
                 <?php endwhile; 
                } ?>
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
          