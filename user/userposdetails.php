<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
  if(isset($_GET['possid']))
  {
    $posid = $_GET['possid'];
    $insert = $conn->query("SELECT * FROM pos WHERE pos_id = '$posid'");
    $ins = $insert->fetch_assoc();

    $find =$conn->query("SELECT p.*,c.* FROM pos as p JOIN pos_category as c ON p.pos_category=c.pos_cat_id WHERE p.pos_id = '$posid'");
    $plus = $find->fetch_assoc();
    
    $col = $conn->query("SELECT * FROM pos WHERE pos_id !='$posid' AND pos_category='".$_GET['pos_cat_id']."' ORDER BY RAND() LIMIT 4");
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
        .img-fluid {
          width: 100%;
        }
        .fi{
          font-weight: bold;
        }
        .zoom { 
        transition: transform .2s;   
        margin: 0 auto;
        width: 100%;
        }

        .zoom:hover {
        -ms-transform: scale(1.5); /* IE 9 */
        -webkit-transform: scale(1.5); /* Safari 3-8 */
        transform: scale(1.5); 
         }
        @media (max-width: 575.98px) {
           .jk {
            margin:0;           
            padding: 0;
           }
        }
    </style>
  <!-- Fonts and icons -->
  <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/azzara.min.css">
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
             <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">POS Details</h1>
                  </div> 
                 <div class="row">                  
                        <div class="col-md-8">
                          <img style="height: 600px" class="img-fluid" src="../admin/images/<?php echo $ins['pos_image']?>" alt="">
                        </div>

                        <div class="col-md-4">
                            
                            <h3 class="fi"><?php echo $ins['pos_name']?></h3>
                            <h3 class="my-3">Description</h3>
                            <p>
                              <?php echo $ins['pos_desc'];?>
                            </p>
                            
                            <ul>
                              <li>Price : <?php echo $ins['pos_price'];?></li>
                              <li>Quantity: <?php echo $ins['pos_quantity']?> Left</li>
                              <li>POS Category: <?php echo $plus['pos_cat_name']?></li>
                              <li>Created Date: <?php echo $ins['created_date']?></li>
                              <li>Updated Date: <?php echo $ins['updated_date']?></li>
                            </ul>
                        </div>                     
                    </div>
                    <h3 class="my-4">Related Products</h3>

                  <div class="row">
                    <?php while($co = $col->fetch_assoc()) : ?>
                      <div class="col-md-3 col-sm-6 mb-4">
                        <a href="userposdetails.php?possid=<?php echo $co['pos_id']?>&&pos_cat_id=<?php echo $co['pos_category']?>">
                              <img style="height: 300px" class="img-fluid zoom" src="../admin/images/<?php echo $co['pos_image']?>" alt="">
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
        </div>
      </div>
      
    </div>
    
    <!-- Custom template | don't include it in your project! -->
    <?php include('includes/usersettings.php');?>
    <a class="scroll-to-top rounded" href="#scroll">
    <i class="fas fa-angle-up"></i>
   </a>
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
<!-- <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {"families":["Open+Sans:300,400,600,700"]},
      custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['assets/css/fonts.css']},
      active: function() {
        sessionStorage.fonts = true;
      }
    });
</script> -->