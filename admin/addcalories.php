<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  $errMes = "";
  $sucMes = "";
  if(isset($_POST['add_calorie'])) {
     if(empty($_POST['food_name'])) {
       $errMes = "<li>Food name is required</li>";
     }else{
      $food_name = mysqli_real_escape_string($conn,$_POST['food_name']);
     }
     if(empty($_POST['calorie_number'])) {
      $errMes .= "<li>Calorie is required</li>";
     }else{
      $calorie_number = mysqli_real_escape_string($conn,$_POST['calorie_number']);
     }

     if(empty($errMes)) {
          $insert = $conn->query("INSERT INTO calories(calorie_food_name,calorie_number,created_date,updated_date) VALUES ('$food_name','$calorie_number',now(),now())");
           if($insert){
             $sucMes = "1 Food Name is added successfully";
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
  <link rel="icon" href="img/icons8-hongkong-dollar-64.png" type="image/x-icon"/>
  <style type="text/css">
     .err {
      text-align: center;
      list-style-type: none;
     }
  </style>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">   
    <?php include('includes/sidebar.php');?>    
      <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">       
          <?php include('includes/navbar.php'); ?>       
              <div class="container-fluid">         
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Add Calories</h1>                   
                  </div> 

                    <div class="row">
                       <div class="col-md-12">
                          <form class="user" method="POST" enctype="multipart/form-data" action="addcalories.php"> 
                          <?php if($errMes)
                            echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              <strong>Danger!</strong>$errMes
                          </div>";
                          ?>
                          <?php if($sucMes)
                            echo "<div class='alert alert-success alert-dismissible fade show'>
                          <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          <strong>Success!</strong>$sucMes
                        </div>";
                          ?>                  
                            <div class="form-group">                            
                              <input type="text" class="form-control form-control-user unicode" id="food_name" name="food_name" placeholder="မုန့်အမည်">
                            </div>
                           
                            <div class="form-group">                            
                              <input type="text" class="form-control form-control-user unicode" id="calorie_number" name="calorie_number" placeholder="ကလိုရီ">
                            </div>
                           
                      <input type="submit" name="add_calorie" class="btn btn-primary btn-user btn-block" value="Add">                                                   
                            <hr>      
                          </form>
                      </div>
                    </div>        
              </div>       
        </div>     
         <?php include('includes/footer.php'); ?>    
      </div>   
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

</body>

</html>
