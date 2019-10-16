<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   include('function.php');
   date_default_timezone_set('Asia/Rangoon');
   if(isset($_GET['userid'])){
    $userid = clean($_GET['userid']);
    $hello = $conn->query("SELECT * FROM users WHERE userid = '$userid'");
    $hi = $hello->fetch_assoc();
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
  <link rel="stylesheet" href="../admin/vendor/datatables/dataTables.bootstrap4.min.css">
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
        .dot {
          font-size: 20px;
          font-weight: bold;
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
  <link rel="stylesheet" href="assets/css/chat.css">
</head>
<body>
  <div class="wrapper">
    <?php include('includes/usernavbar.php');?>
    
    <?php include('includes/usersidebar.php');?>

    <div class="main-panel">
      <div class="content">
        <div class="page-inner">
          <!-- Card -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h4 class="page-title">Chat</h4>
          </div>
              <hr>
                 <div class="row">
           
        <div class="col-12 col-md-8 col-xl-6 mesgs" style="border: 3px solid lightgray; border-radius: 5px;">
          <div class="header" style="border-bottom: 1px solid lightgray; padding-bottom: 5px;">
            <img src="../admin/images/<?php echo $hi['user_img']?>" style="height: 25px;width: 35px;" class="rounded-circle"> &nbsp;<?php echo $hi['username']?> 
          </div>
          <div class="msg_history" id="<?php echo $hi['userid']?>" style="height: 400px;">
          
          </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a message" />
              <button class="msg_send_btn" type="button"><i class="fas fa-paper-plane plane" aria-hidden="true" id="<?php echo $hi['userid']?>"></i></button>
            </div>
          </div>
   
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
  <script src="../admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="../admin/js/demo/datatables-demo.js"></script>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    setInterval(function(){
      refresh_chat_history();
    },1000);
     $('.plane').on('click',function(){
        var userid = $(this).attr('id');
        var conversation = $('.write_msg').val();
        if(conversation != ''){
          $.ajax({
            url : 'messagetodatabase.php',
            method : 'POST',
            data : {userid:userid, conversation:conversation},
            success : function(data){
              $('.write_msg').val('');
              $('.msg_history').html(data);
            }
          });
        }
     });
     function good_chat_history(){
          var userid = $('.msg_history').attr('id');
         $.ajax({
           url : "refreshing.php",
           method : "POST",
           data : {userid:userid},
           success: function(data){
            $('.msg_history').html(data);
           }
         });
     }
   
   function refresh_chat_history(){
        $('.msg_history').each(function() {
        var userid = $(this).attr('id');
        good_chat_history();
      });
   }
   });
</script>
