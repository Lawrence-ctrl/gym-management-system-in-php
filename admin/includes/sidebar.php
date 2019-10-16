<?php
  $heroes = $conn->query("SELECT * FROM booking WHERE booked='0'");
  $count = $heroes->num_rows;
  $pota = $conn->query("SELECT * FROM pos_income WHERE poss_status='0'");
  $potato = $pota->num_rows;
  $toy = $conn->query("SELECT * FROM pos WHERE pos_quantity = 0");
  $toy_count = $toy->num_rows;
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">G M S</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
    <!--   <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>GMS Calculation</span></a>
      </li>
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-dumbbell"></i>
          <span>Exercises</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Exercises:</h6>
            <a class="collapse-item" href="m-exercises.php">Male</a>
            <a class="collapse-item" href="f-exercises.php">Female</a>
            <a class="collapse-item" href="addexercises.php">Add</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-plus"></i>
          <span>Weight Gain</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Weight Gain:</h6>
            <a class="collapse-item" href="weight-gain-m.php">Male</a>
            <a class="collapse-item" href="weight-gain-f.php">Female</a>
            <a class="collapse-item" href="addexercises.php">Add</a>
          </div>
        </div>
      </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
          <i class="fas fa-minus"></i>
          <span>Weight Loss</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Weight Loss:</h6>
            <a class="collapse-item" href="weight-loss-m.php">Male</a>
            <a class="collapse-item" href="weight-loss-f.php">Female</a>
            <a class="collapse-item" href="addexercises.php">Add</a>
          </div>
        </div>
      </li>
      
      

      

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        List
      </div>
      <li class="nav-item">
        <a class="nav-link" href="gym-user.php">
          <i class="fas fa-users"></i>
          <span>Users</span></a>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="confirmmember.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Confirm Bookings </span><?php if($count >0) : ?><span class="badge badge-info"><?php echo $count?></span><?php endif; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="adminbooking.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Booking</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addtrainer.php">
          <i class="fas fa-fw fa-book"></i>
          <span>Add Trainer</span></a>
      </li>
      <hr class="sidebar-divider">
      
      <li class="nav-item">
        <a class="nav-link" href="pos.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>POS</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="empty_pos.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Empty POS</span><?php if($toy_count > 0) { ?><span class="badge badge-info"><?php echo $toy_count?></span><?php } ?></a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="confirmpos.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Confirm POS </span><?php if($potato >0) { ?><span class="badge badge-info"> <?php echo $potato?></span><?php } ?></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <!-- Nav Item - Charts -->
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="viewfeedback.php">
          <i class="fas fa-fw fa-tint"></i>
          <span>Feedback</span></a>
      </li>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
  