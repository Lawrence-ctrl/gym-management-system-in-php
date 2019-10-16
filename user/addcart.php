<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   date_default_timezone_set('Asia/Rangoon');
       $total = 0;
       if(isset($_POST['buy'])){
         foreach ($_SESSION['cart'] as $tri => $try) {
          $selec = $conn->query("SELECT * FROM pos WHERE pos_id = '".$try['pos_id']."'");
          $yawn = $selec->fetch_assoc();
            $poss_user_id = $_SESSION['userid'];
            $poss_id = clean($try['pos_id']);
            $poss_member_id = clean($try['member_id']);
            $poss_price = clean($try['pos_price']);
            $poss_quantity = clean($try['pos_quantity']);
            $poss_total = $poss_price*$poss_quantity;
            $posandposs = number_format($yawn['pos_quantity'] - $poss_quantity);
            $insert = $conn->query("INSERT INTO pos_income (poss_id,poss_member_id,poss_user_id,poss_price,poss_quantity,poss_total,poss_status,pos_created_date,pos_updated_date) VALUES ('$poss_id','$poss_member_id','$poss_user_id','$poss_price','$poss_quantity','$poss_total','0',now(),now())");
            if($insert){
              $wow = $conn->query("UPDATE pos SET pos_quantity='$posandposs' WHERE pos_id= '".$try['pos_id']."'");
              echo "<script>
              window.alert('Send to admin successfully');
              window.location.href = 'poss.php';
              </script>";
              unset($_SESSION['cart']);
            }
         }
       }
       if(isset($_GET['delete_id'])){
         $delete_id = clean($_GET['delete_id']);
         foreach ($_SESSION['cart'] as $tri => $try) {
                  if($try['pos_id'] == $delete_id){
                    unset($_SESSION['cart'][$tri]);
                  }
         }
       }

       if(isset($_GET['clear'])){
         unset($_SESSION['cart']);
       }
       if(isset($_GET['change_id'])){
        $array = array_column($_SESSION['cart'],'pos_id');
        if(in_array($_GET['change_id'], $array))
        {
          foreach ($array as $kid => $vro) 
          {     
            if($_GET['change_id'] == $vro['0'])
            {
              $_SESSION['cart'][$kid]['pos_quantity'] = $_POST['pos_quantity'];
            }
          }
        }
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
        .yo{
              position: absolute;
              left :44%;
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
              <h4 class="page-title">Cart</h4>
          </div>
              <hr>
           
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Product ID</th>
                              <th>Product Name</th>
                              <th>Member ID</th>
                              <th>Product Price</th>
                              <th>Quantity</th>
                              <th>Total Price</th>
                              <th>Delete</th>
                            </tr>
                          </thead>
                            <tbody>
                            <?php if(isset($_SESSION['cart'])) : ?>
                              <?php foreach ($_SESSION['cart'] as $cart) :
                                $sell= $conn->query("SELECT * FROM pos WHERE pos_id='".$cart['pos_id']."'");
                                $se = $sell->fetch_assoc();
                                // print_r($se);
                                 $total += $cart['pos_price']*$cart['pos_quantity'];?>
                                  <tr>
                                    <td><?php echo $cart['pos_id']?></td>
                                    <td><?php echo $cart['pos_name']?></td>
                                    <td><?php echo $cart['member_id']?></td>
                                    <td><?php echo $cart['pos_price']?></td>
                                    <td>
                                      <form action="addcart.php?change_id=<?php echo $cart['pos_id']?>" method='POST'>
                                      <select class="mr-sm-2 form-group" name="pos_quantity">
                                        <?php for($i=1; $i<=$se['pos_quantity']; $i++) { ?>
                                        <option value="<?php echo $i?>"
                                        <?php if($i == $cart['pos_quantity']) echo "selected";?>><?php echo $i?></option>
                                        <?php } ?>
                                        <input type="submit" class="btn btn-primary btn-sm btn-rounded" name="change" value="Change">
                                      </form>
                              </select>
                                    </td>
                                  <td><?php echo number_format($cart['pos_price']*$cart['pos_quantity']);?> MMK</td>
                                  <td><a style="text-decoration: none;" href="addcart.php?delete_id=<?php echo $cart['pos_id']?>"><i class="fas fa-trash text-danger"></i></a></td>
                                  </tr>
                              <?php endforeach; ?>
                            <?php endif; ?>
                               <tr>
                                     <td colspan="5" class="text-right">Total:
                                     <td><?php echo $total;?>MMK</td>
                                  </tr>
                            </tbody>
                        </table>
                     
                      </div>
                         <table width="100%">
                        <tr>
                           <td><a href="poss.php"><i class="fas fa-backward fa-lg text-info"></i></a></td>
                           <td class="yo"><a href="addcart.php?clear" class="btn btn-danger btn-rounded btn-md">Clear</a></td>
                           <td class="text-right">
                        <form action="addcart.php" method="POST">
                              <input type="submit" class="btn btn-success btn-rounded btn-md" name="buy" value="Buy">
                            </form>
                          </td>
                        </tr>
                        </table>
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
