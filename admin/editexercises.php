<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  $errMes = "";
  $sucMes = "";
    if(isset($_GET['exer_id'])) {
      $e_id = clean($_GET['exer_id']);
      $ee = $conn->query("SELECT * FROM exercises WHERE exer_id = '$e_id'");
      $eee = $ee->fetch_assoc();
    }
  if(isset($_POST['edit_exer'])) {
      $exer_id = clean($_POST['hidexerid']);
     if(empty($_POST['exer_name'])) {
       $errMes = "<li>Exercises name is required</li>";
     }elseif(checknamers($_POST['exer_name'],$exer_id)==false)
     {
      $errMes .= "<li>Exercise name is already exist";
     }
     else
     {
      $exer_name = mysqli_real_escape_string($conn,$_POST['exer_name']);
     }
     if(empty($_POST['exer_story'])) {
      $errMes .= "<li>Exercises description is required</li>";
     }else{
      $exer_story = mysqli_real_escape_string($conn,$_POST['exer_story']);
     }
     if(empty($_POST['exer_times'])) {
      $errMes .= "<li>Exercises' time is required</li>";
     }else{
      $exer_times = mysqli_real_escape_string($conn,$_POST['exer_times']);
     }
     if(!empty($_FILES['exer_img']['name'])){
      $exer_img = $_FILES['exer_img']['name'];
      $file_name = uniqid().'_'.$exer_img;
      $tmp = $_FILES['exer_img']['tmp_name'];     
      $size = $_FILES['exer_img']['size'];   
      if(!empty($exer_img))
      {
        $info = getimagesize($_FILES['exer_img']['tmp_name']);
        if($info['mime']=='image/gif' || $info['mime']="image/jpeg" || $info['mime']="image/jpg" || $info['mime']=='image/png') {
           if($size<'3000000'){
        move_uploaded_file($tmp,"images/$file_name");
            }else{
              $errMes.="<li>Image size is too big</li>";
            }
        }else{
          $errMes.="<li>Just Gif, Jpg, Png are allowed</li>";
        }
      }
     }
     if(empty($_POST['exer_category'])){
      $errMes.= "<li>Exercises Category is required</li>";
     }else{
      $exer_category_id = mysqli_real_escape_string($conn,$_POST['exer_category']);
     }
     if(empty($_POST['exer_plan'])){
      $errMes.= "<li>Exercises plan is required</li>";
     }else{
      $exer_plan = mysqli_real_escape_string($conn,$_POST['exer_plan']);
     }
     if(empty($_POST['exer_gender'])){
      $errMes.= "<li>Gender is required</li>";
     }else{
      $exer_gender = mysqli_real_escape_string($conn,$_POST['exer_gender']);
     }


     if(empty($errMes)) {
         if(!empty($_FILES['exer_img']['name'])) {
          $insert = $conn->query("UPDATE exercises SET exer_name='$exer_name',exer_category_id='$exer_category_id',exer_story='$exer_story',exer_times='$exer_times',exer_img='$file_name',exer_plan='$exer_plan',gender='$exer_gender',modified_date=now() WHERE exer_id = '$exer_id'");
            }else{
               $insert = $conn->query("UPDATE exercises SET exer_name='$exer_name',exer_category_id='$exer_category_id',exer_story='$exer_story',exer_times='$exer_times',exer_plan='$exer_plan',gender='$exer_gender',modified_date=now() WHERE
            exer_id = '$exer_id'");
            }
           if($insert){
              header("location:editexercises.php?exer_id=$exer_id&&sucMes");
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
                    <h1 class="h3 mb-0 text-gray-800">Add Exercises</h1>                   
                  </div> 

                    <div class="row">
                       <div class="col-md-12">
                          <form class="user" method="POST" enctype="multipart/form-data" action="editexercises.php"> 
                          <?php if($errMes)
                            echo "<div class='alert alert-danger alert-dismissible fade show err'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              <strong>Danger!</strong>$errMes
                          </div>";
                          ?>
                          <?php if(isset($_GET['sucMes']))
                            echo "<div class='alert alert-success alert-dismissible fade show'>
                          <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          <strong>Success!</strong> Updated
                        </div>";
                          ?>  
                          <input type="hidden" name="hidexerid" value="<?php echo $eee['exer_id']?>">                
                            <div class="form-group">                            
                              <input type="text" class="form-control form-control-user" id="exer_name" name="exer_name" placeholder="Enter exercises name" value="<?php echo $eee['exer_name']?>">
                            </div>
                            
                              <div class="col-md-11 col-lg-10 form-group">
                                <img src="images/<?php echo $eee['exer_img']?>" style="height: 100px">
                                <input type="file" name="exer_img">                        
                              </div>
                           
                            <div class="form-group">                            
                              <textarea name="exer_story" class="form-control form-control-user" placeholder="Enter description"><?php echo $eee['exer_story']?></textarea>
                            </div>
                            <div class="form-group">                            
                              <input type="text" class="form-control form-control-user" id="exer_times" name="exer_times" placeholder="Enter times" value="<?php echo $eee['exer_times']?>">
                            </div>

                            <div class="form-group">                            
                               <select name="exer_category" class="form-control">
                                   <?php
                                    $cate = $conn->query("SELECT * FROM exercises_category WHERE cat_id != '1'ORDER BY cat_id ASC");
                                    while($ca = $cate->fetch_assoc()): ?>                                       
                                   <option value="<?php echo $ca['cat_id']?>"
                                    <?php if($ca['cat_id'] == $eee['exer_category_id']) echo "selected"?>>
                                    <?php echo $ca['exercises_name']?>                                    
                                   </option>
                                 <?php endwhile; ?>
                               </select>
                            </div>

                              <div class="form-group">                            
                               <select name="exer_plan" class="form-control">
                                   <?php
                                    $pup = $conn->query("SELECT * FROM plans ORDER BY plan_id ASC");
                                    while($puppy = $pup->fetch_assoc()): ?>                                       
                                   <option value="<?php echo $puppy['plan_id']?>"
                                    <?php if($puppy['plan_id'] == $eee['exer_plan']) echo "selected";?>><?php echo $puppy['plan_name']?>                                    
                                   </option>
                                 <?php endwhile; ?>
                               </select>
                            </div>

                            <div class="form-group">                            
                               <select name="exer_gender" class="form-control">
                                        <option value="1" <?php if($eee['gender'] == "1"){?> selected="selected" <?php }?>>male</option>
                                          <option value="2" <?php if($eee['gender'] == "2"){?> selected="selected" <?php }?>>female</option>
                                   </option>                          
                               </select>
                            </div>
                           
                            <input type="submit" name="edit_exer" class="btn btn-primary btn-user btn-block" value="Update">                                                   
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
