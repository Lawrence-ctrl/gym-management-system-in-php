<?php
  include('database/connection.php');
  include('adminconfig.php');
  if(isset($_GET['exer_id']))
  {
    $exer_id = $_GET['exer_id'];
    $insert = $conn->query("SELECT * FROM exercises WHERE exer_id = '$exer_id'");
    $ins = $insert->fetch_assoc();

    $find =$conn->query("SELECT e.*,c.* FROM exercises as e JOIN exercises_category as c ON e.exer_category_id=c.cat_id WHERE e.exer_id = '$exer_id'");
    $plus = $find->fetch_assoc();
    
    $col = $conn->query("SELECT * FROM exercises WHERE exer_id !='$exer_id' and gender='".$_GET['sex']."' AND exer_category_id='".$_GET['cat_id']."' ORDER BY RAND() LIMIT 4");
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
    .img-fluid {
      width: 100%;
    }a
    .fi{
      font-weight: bold;
    }
    .zoom { 
    transition: transform .2s;   
    margin: 0 auto;
    }

    .zoom:hover {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Safari 3-8 */
    transform: scale(1.5); 
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
                    <h1 class="h3 mb-0 text-gray-800">Details</h1>
                    <a href="editexercises.php?exer_id=<?php echo $ins['exer_id']?>" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-dumbbell fa-sm text-white-50"></i> Edit exercise</a>
                  </div> 

                    <div class="row">                  
                        <div class="col-md-8">
                          <img class="img-fluid" src="images/<?php echo $ins['exer_img']?>" alt="">
                        </div>

                        <div class="col-md-4">
                            
                            <h3 class="fi"><?php echo $ins['exer_name']?></h3>
                            <h3 class="my-3">How to do-</h3>
                            <p>
                              <?php echo $ins['exer_story'];?>
                            </p>
                            
                            <ul>
                              <?php if($ins['gender']=='1') { ?>
                              <li>Gender: Male</li>
                              <?php }else{ ?>
                              <li>Gender: Female</li>
                              <?php } ?>
                              <li>Exercises Category: <?php echo $plus['exercises_name']?></li>
                              <li>Times: <?php echo $ins['exer_times']?></li>
                              <li>Created Date: <?php echo $ins['created_date']?></li>
                              <li>Updateded Date: <?php echo $ins['modified_date']?></li>
                            </ul>
                        </div>                     
                    </div>
                    <h3 class="my-4">Related Exercises</h3>

                  <div class="row">
                    <?php while($co = $col->fetch_assoc()) : ?>
                      <div class="col-md-3 col-sm-6 mb-4">
                        <a href="detail-exercises.php?exer_id=<?php echo $co['exer_id']?>&&cat_id=<?php echo $co['exer_category_id']?>&&sex=<?php echo $co['gender']?>">
                              <img class="img-fluid zoom" src="images/<?php echo $co['exer_img']?>" alt="">
                            </a>
                      </div>
                    <?php endwhile; ?>
                      
                  </div>

                    <hr>

                       
              </div>
              <div id="google_translate_element"></div>

          <script type="text/javascript">
          function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
          }
          </script>
          <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>   
         <?php include('includes/footer.php'); ?>   
        
         </div>         
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
