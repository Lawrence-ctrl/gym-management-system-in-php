<?php
    $cha = $conn->query("SELECT * FROM booking WHERE bookuser_email = '".$_SESSION['useremail']."' AND bookuser_id='".$_SESSION['userid']."'");
    $char = $cha->fetch_assoc();
    $check = $conn->query("SELECT * FROM users WHERE userid='".$_SESSION['userid']."' AND useremail = '".$_SESSION['useremail']."'");
   $law = $check->fetch_assoc();
   $stud = $conn->query("SELECT * FROM pos_category");
   $gago = $conn->query("SELECT * FROM booking WHERE bookuser_email = '".$_SESSION['useremail']."' AND bookuser_id='".$_SESSION['userid']."' AND booked='0'");

?>
<div class="sidebar">
			
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../admin/images/<?php echo $law['user_img']?>" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo $law['username']?>
									<?php if($char['booked']=='1') { ?>
									<span class="user-level">Member</span>
								<?php }elseif($law['userstatus']=='2'){ ?>
									<span class="user-level">Trainer</span>
								<?php }else{ ?>
									<span class="user-level">Non-Member</span>
								<?php } ?>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="userprofile.php">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="chanpass.php">
											<span class="link-collapse">Change Password</span>
										</a>
									</li>
									<li>
										<a onclick="return confirm('Are you sure you want to logout')" href="userlogout.php">
											<span class="link-collapse">Logout</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<?php if($char['booked'] == '1') { ?>
						<li class="nav-item">
							<a data-toggle="collapse" href="#calculate">
								<i class="fas fa-calculator"></i>
								<p>Calculate</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="calculate">
								<ul class="nav nav-collapse">
									<li>
										<a href="index.php">
											<span class="sub-item"><i class="fas fa-check-circle fe"></i>Daily Calorie</span>
										</a>
									</li>
									<li>
										<a href="bmi.php">
											<span class="sub-item"><i class="fas fa-check-circle ma"></i>BMI Calculator</span>
										</a>
									</li>
									<li>
										<a href="calorie.php">
											<span class="sub-item"><i class="fas fa-check-circle fe"></i>Calorie Calculator</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Exercises</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#exercises">
								<i class="fas fa-dumbbell"></i>
								<p>Regular</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="exercises">
								<ul class="nav nav-collapse">
									<li>
										<a href="m-exercises.php">
											<span class="sub-item"><i class="fa fa-male ma"></i>Male</span>
										</a>
									</li>
									<li>
										<a href="w-exercises.php">
											<span class="sub-item"><i class="fa fa-female fe"></i>Female</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#exercises1">
								<i class="fas fa-plus"></i>
								<p>Weight Gain</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="exercises1">
								<ul class="nav nav-collapse">
									<li>
										<a href="weight-gain-m.php">
											<span class="sub-item"><i class="fa fa-male ma"></i>Male</span>
										</a>
									</li>
									<li>
										<a href="weight-gain-f.php">
											<span class="sub-item"><i class="fa fa-female fe"></i>Female</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#exercises2">
								<i class="fas fa-minus"></i>
								<p>Weight Loss</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="exercises2">
								<ul class="nav nav-collapse">
									<li>
										<a href="weight-loss-m.php">
											<span class="sub-item"><i class="fa fa-male ma"></i>Male</span>
										</a>
									</li>
									<li>
										<a href="weight-loss-f.php">
											<span class="sub-item"><i class="fa fa-female fe"></i>Female</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Buy</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#pos">
								<i class="fas fa-dumbbell"></i>
								<p>POS</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="pos">
								<ul class="nav nav-collapse">
								 <?php foreach ($stud as $stu) { ?>
								 	<li>
										<a href="poss.php?pos_id=<?php echo $stu['pos_cat_id']?>"><?php echo $stu['pos_cat_name']?></a>
									</li>
								<?php } ?>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a href="shoppingcart.php">
								<i class="fas fa-shopping-cart"></i>
								<p>
									Bought Products
								</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Others</h4>
						</li>
						<li class="nav-item">
							<a href="purchase.php">
								<i class="fas fa-book"></i>
								<p>
									Purchase
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="favourites.php">
								<i class="fas fa-heart"></i>
								<p>
									Favourites
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="seeusers.php">
								<i class="fas fa-comment"></i>
								<p>Chat</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="feedback.php">
								<i class="fas fa-map-marker-alt"></i>
								<p>Give Feedback</p>
							</a>
						</li>
						<!-- <li class="nav-item active">
							<a href="widgets.html">
								<i class="fas fa-desktop"></i>
								<p>Widgets</p>
								<span class="badge badge-count badge-success">4</span>
							</a>
						</li> -->
					<?php }elseif($law['userstatus'] == '2') { ?>
								<li class="nav-item">
							<a data-toggle="collapse" href="#calculate">
								<i class="fas fa-calculator"></i>
								<p>Calculate</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="calculate">
								<ul class="nav nav-collapse">
									<li>
										<a href="index.php">
											<span class="sub-item"><i class="fas fa-check-circle fe"></i>Daily Calorie</span>
										</a>
									</li>
									<li>
										<a href="bmi.php">
											<span class="sub-item"><i class="fas fa-check-circle ma"></i>BMI Calculator</span>
										</a>
									</li>
									<li>
										<a href="calorie.php">
											<span class="sub-item"><i class="fas fa-check-circle fe"></i>Calorie Calculator</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Exercises</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#exercises">
								<i class="fas fa-dumbbell"></i>
								<p>Regular</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="exercises">
								<ul class="nav nav-collapse">
									<li>
										<a href="m-exercises.php">
											<span class="sub-item"><i class="fa fa-male ma"></i>Male</span>
										</a>
									</li>
									<li>
										<a href="w-exercises.php">
											<span class="sub-item"><i class="fa fa-female fe"></i>Female</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#exercises1">
								<i class="fas fa-plus"></i>
								<p>Weight Gain</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="exercises1">
								<ul class="nav nav-collapse">
									<li>
										<a href="weight-gain-m.php">
											<span class="sub-item"><i class="fa fa-male ma"></i>Male</span>
										</a>
									</li>
									<li>
										<a href="weight-gain-f.php">
											<span class="sub-item"><i class="fa fa-female fe"></i>Female</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#exercises2">
								<i class="fas fa-minus"></i>
								<p>Weight Loss</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="exercises2">
								<ul class="nav nav-collapse">
									<li>
										<a href="weight-loss-m.php">
											<span class="sub-item"><i class="fa fa-male ma"></i>Male</span>
										</a>
									</li>
									<li>
										<a href="weight-loss-f.php">
											<span class="sub-item"><i class="fa fa-female fe"></i>Female</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Buy</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#pos">
								<i class="fas fa-dumbbell"></i>
								<p>POS</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="pos">
								<ul class="nav nav-collapse">
								 <?php foreach ($stud as $stu) { ?>
								 	<li>
										<a href="poss.php?pos_id=<?php echo $stu['pos_cat_id']?>"><?php echo $stu['pos_cat_name']?></a>
									</li>
								<?php } ?>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a href="shoppingcart.php">
								<i class="fas fa-shopping-cart"></i>
								<p>
									Bought Products
								</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Others</h4>
						</li>
						<li class="nav-item">
							<a href="purchasee.php">
								<i class="fas fa-book"></i>
								<p>
									Duration
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="favourites.php">
								<i class="fas fa-heart"></i>
								<p>
									Favourites
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="seeusers.php">
								<i class="fas fa-comment"></i>
								<p>Chat</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="feedback.php">
								<i class="fas fa-map-marker-alt"></i>
								<p>Give Feedback</p>
							</a>
						</li>

					<?php }else{ ?>
							<li class="nav-item">
							<a data-toggle="collapse" href="#calculate">
								<i class="fas fa-calculator"></i>
								<p>Calculate</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="calculate">
								<ul class="nav nav-collapse">
									<li>
										<a href="index.php">
											<span class="sub-item"><i class="fas fa-check-circle fe"></i>Daily Calorie</span>
										</a>
									</li>
									<li>
										<a href="bmi.php">
											<span class="sub-item"><i class="fas fa-check-circle ma"></i>BMI Calculator</span>
										</a>
									</li>
									<li>
										<a href="calorie.php">
											<span class="sub-item"><i class="fas fa-check-circle fe"></i>Calorie Calculator</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Exercises</h4>
						</li>
						
						<li class="nav-item">
							<a data-toggle="collapse" href="#exercises">
								<i class="fas fa-dumbbell"></i>
								<p>Regular</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="exercises">
								<ul class="nav nav-collapse">
									<li>
										<a href="m-exercises.php">
											<span class="sub-item"><i class="fa fa-male ma"></i>Male</span>
										</a>
									</li>
									<li>
										<a href="w-exercises.php">
											<span class="sub-item"><i class="fa fa-female fe"></i>Female</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					   	<li class="nav-item">
							<a data-toggle="collapse" href="#exercises1">
								<i class="fas fa-plus"></i>
								<p>Weight Gain</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="exercises1">
								<ul class="nav nav-collapse">
									<li>
										<a href="weight-gain-m.php">
											<span class="sub-item"><i class="fa fa-male ma"></i>Male</span>
										</a>
									</li>
									<li>
										<a href="weight-gain-f.php">
											<span class="sub-item"><i class="fa fa-female fe"></i>Female</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#exercises2">
								<i class="fas fa-minus"></i>
								<p>Weight Loss</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="exercises2">
								<ul class="nav nav-collapse">
									<li>
										<a href="weight-loss-m.php">
											<span class="sub-item"><i class="fa fa-male ma"></i>Male</span>
										</a>
									</li>
									<li>
										<a href="weight-loss-f.php">
											<span class="sub-item"><i class="fa fa-female fe"></i>Female</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Buy</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#pos">
								<i class="fas fa-dumbbell"></i>
								<p>POS</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="pos">
								<ul class="nav nav-collapse">
								 <?php foreach ($stud as $stu) { ?>
								 	<li>
										<a href="poss.php?pos_id=<?php echo $stu['pos_cat_id']?>"><?php echo $stu['pos_cat_name']?></a>
									</li>
								<?php } ?>
								</ul>
							</div>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Others</h4>
						</li>
						<?php if($gago->num_rows == 1) { ?>
						<li class="nav-item">
							<a href="cancelbooking.php">
								<i class="fas fa-window-close"></i>
								<p>
									Cancel Booking
								</p>
							</a>
						</li>
					   <?php }else{ ?>
					   	<li class="nav-item">
							<a href="booking.php">
								<i class="fas fa-book"></i>
								<p>
									Booking
								</p>
							</a>
						</li>
						  <?php } ?>
						<li class="nav-item">
							<a href="feedback.php">
								<i class="fas fa-map-marker-alt"></i>
								<p>Give Feedback</p>
							</a>
						</li>
					 
						
						<!-- <li class="nav-item active">
							<a href="widgets.html">
								<i class="fas fa-desktop"></i>
								<p>Widgets</p>
								<span class="badge badge-count badge-success">4</span>
							</a>
						</li> -->
					
					<?php } ?>
					</ul>
				</div>
			</div>
		</div>