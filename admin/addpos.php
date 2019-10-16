<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  $errMes = "";
  $sucMes = "";
  if(isset($_POST['add_pos'])) {
     if(empty($_POST['pos_name'])) {
       $errMes = "<li>Product name is required</li>";
     }elseif(checkposname($_POST['pos_name'])==false)
     {
      $errMes .= "<li>Product name is already exist";
     }
     else
     {
      $pos_name = mysqli_real_escape_string($conn,$_POST['pos_name']);
     }
     if(empty($_POST['pos_price'])) {
      $errMes .= "<li>Product price is required</li>";
     }else{
      $pos_price = mysqli_real_escape_string($conn,$_POST['pos_price']);
     }
     if(empty($_POST['pos_desc'])) {
      $errMes .= "<li>Product description is required</li>";
     }else{
      $pos_desc = mysqli_real_escape_string($conn,$_POST['pos_desc']);
     }
     if(empty($_FILES['pos_image']['name'])){
      $errMes.= "<li>Product image is required</li>";
     }else{
      $pos_image = $_FILES['pos_image']['name'];
      $file_name = uniqid().'_'.$pos_image;
      $tmp = $_FILES['pos_image']['tmp_name'];     
      $size = $_FILES['pos_image']['size'];   
      if(!empty($pos_image))
      {
        $info = getimagesize($_FILES['pos_image']['tmp_name']);
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

     if(empty($_POST['pos_quantity'])){
      $errMes.= "<li>Product quantity is required</li>";
     }else{
      $pos_quantity = mysqli_real_escape_string($conn,$_POST['pos_quantity']);
     }

     if(empty($_POST['pos_category'])){
      $errMes.= "<li>Product Category is required</li>";
     }else{
      $pos_category = mysqli_real_escape_string($conn,$_POST['pos_category']);
     }

     if(empty($errMes)) {
          $insert = $conn->query("INSERT into pos(pos_name,pos_price,pos_category,pos_image,pos_quantity,pos_desc,created_date,updated_date) VALUES ('$pos_name','$pos_price','$pos_category','$file_name','$pos_quantity','$pos_desc',now(),now())");
           if($insert){
             $sucMes = "1 product is added successfully";
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
                    <h1 class="h3 mb-0 text-gray-800">Add Product</h1>                   
                  </div> 

                    <div class="row">
                       <div class="col-md-12">
                          <form class="user" method="POST" enctype="multipart/form-data" action="addpos.php"> 
                          <?php if($errMes)
                            echo "<div class='alert alert-danger err'>$errMes</div>";
                          ?>
                          <?php if($sucMes)
                            echo "<div class='alert alert-success err'>$sucMes</div>";
                          ?>                  
                            <div class="form-group">                            
                          <input type="text" class="form-control form-control-user" id="pos_name" name="pos_name" placeholder="Enter product name">
                            </div>
                            <div class="form-group">                            
                          <input type="text" class="form-control form-control-user" id="pos_price" name="pos_price" placeholder="Enter price">
                            </div>
                              <div class="col-md-11 col-lg-10 form-group">
                                <input type="file" name="pos_image">                        
                              </div>
                           
                            <div class="form-group">                            
                              <textarea name="pos_desc" class="form-control form-control-user" placeholder="Enter description"></textarea>
                            </div>

                            <div class="form-group">                            
                               <input type="text" name="pos_quantity" class="form-control form-control-user" placeholder="Enter Quantity">
                            </div>

                            <div class="form-group">                            
                               <select name="pos_category" class="form-control">
                                   <option value="0" selected="">--Select Category--</option>
                                   <?php
                                    $cate = $conn->query("SELECT * FROM pos_category WHERE pos_cat_id != '1' ORDER BY pos_cat_id ASC");
                                    while($ca = $cate->fetch_assoc()): ?>                                       
                                   <option value="<?php echo $ca['pos_cat_id']?>"><?php echo $ca['pos_cat_name']?>                                    
                                   </option>
                                 <?php endwhile; ?>
                               </select>
                            </div>
     
                            <input type="submit" name="add_pos" class="btn btn-primary btn-user btn-block" value="Add">                                                   
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
