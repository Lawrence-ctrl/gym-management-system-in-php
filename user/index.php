<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   date_default_timezone_set('Asia/Rangoon');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8_general_ci">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <title>G M S</title>
  <link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>
   <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=myanmar3' />
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi' /> 
   <!-- Fonts and icons -->
  <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/azzara.css">
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css">
  <link rel="stylesheet" href="assets/css/my.css">
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
        @media(min-width: 576px){
          .cool,.haha {
            position: absolute;
            top: 20%;
            left: 18%;
            border: 5px solid lightgray;
            border-radius: 5px;
            padding: 15px;
          }
          .true{
            position: relative;
            left:36.5%;
          }
          .crazy{
            position: relative;
            top: 60%;
            left: 2%;
          }
          .holy {
            font-size: 25px;
          }
        }
        @media(max-width: 576px){
            .holy {
              font-size: 20px;
            }
            .collapse {
              display: block;
            }
          }
    </style>
  
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
              <h4 class="page-title">Daily Calorie</h4>
          </div>
              <hr>
                    <div class="text-center true">
                            <div class="shadow" id="search-nav">
                            <form class="navbar-left navbar-form nav-search mr-md-3 mb-3">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <button type="submit" class="btn btn-search pr-1">
                                    <i class="fa fa-search search-icon"></i>
                                  </button>
                                </div>
                                <input type="text" placeholder="Search ..." id="calsearch" class="form-control unicode">
                              </div>
                            </form>
                        </div>  
                    </div>
                                  
                    <div class="eaten_calorie"></div>
                    <div class="text-center crazy">
                       <?php 
                       $date = date('Y-m-d');
                       $hello = $conn->query("SELECT * FROM yours WHERE created_date='$date' AND your_userid = '".$_SESSION['userid']."'");
                       $total = 0;
                       if($hello->num_rows> 0) {
                       foreach ($hello as $haha) {
                         $total += $haha['your_calorie'];
                       }
                      echo '<center><p class="holy"> Your calorie for today is <b class="success">'.$total.' cal/day</b></p><button type="button" class="btn btn-secondary btn-rounded eaten" data-toggle="modal" data-target="#caloriess"><i class="fas fa-eye"></i> View</button></center>';
                     }else{
                      echo '<center><p class="holy"> Your calorie for today is <b class="success">'.$total.' cal/day</b></p><button type="button" class="btn btn-secondary btn-rounded eaten" data-toggle="modal" data-target="#caloriess"><i class="fas fa-eye"></i> View</button></center>';
                     } ?>
                    </div>
                    <div class="modal fade" id="caloriess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h2 class="modal-title" id="caloriess">Your calories for Today</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="table-responsive">
                              <table class="table table-bordered table-danger">
                                 <thead>
                                     <tr>
                                        <td>Food Name</td>
                                        <td>Calories</td>
                                        <td>Quantity</td>
                                        <td>Total Calories</td>
                                        <td>Action</td>
                                     </tr>
                                 </thead>
                                 <tbody id="secret" class="unicode">
                               
                                 </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<script type="text/javascript">
   $(document).ready(function(){
      $('#calsearch').keyup(function(){
        var caval = $(this).val();
        if(caval != '')
        {
          $.ajax({
            url : "checkcalorie.php",
            method : "POST",
            data : {caval:caval},
            success: function(data){
              $('.eaten_calorie').html(data);
            }
          })
        }
      });
   });
 
    $(document).on('click','.adder_er',function(){
        var data_id = $(this).data('id');
        var selectval = $('#caloriee'+ data_id).val();
        $.ajax({
          url : "checkcalorie.php",
          method : "POST",
          data : {
            'yours' : 1, 
            'data_id':data_id, 
            'selectval':selectval},
          success: function(data){
            alert('successfully added');
            $('.success').html(data);
          }
        });
      }); 
</script>
<script type="text/javascript">
  $(document).ready(function(){ 
      $('.eaten').on('click',function(){
        $.ajax({
           url: "checkcalorie.php",
           method: "POST",
           data :{
            'viewed' : 1
           },
           success:function(data){
             $('#secret').html(data);
           }
        });
      });
    });
  $(document).on('click','.trash',function(){
    var trashid = $(this).data('trashid');
    $clicked = $(this).parent().parent();
       if(confirm("Are you sure you want to delete this?")) {
          $.ajax({
            url: "checkcalorie.php",
            method: "POST",
            data: {trashid:trashid},
            success: function(data){
              alert('Deleted successfully');
              $clicked.remove();
            }
          });
       }
  });
</script>
<script type="text/javascript">
    $(document).on('click','.change',function(){
       var changeid = $(this).data('id');
       var your_select = $('#your_select'+changeid).val();
       $.ajax({
        url: "checkcalorie.php",
        method: "POST",
        dataType : 'json',
        data: {changeid:changeid,your_select:your_select},
        success: function(data){
          alert('Changed Quantity successfully');
          $('.complex'+changeid).html(data.one);
          $('.success').html(data.status);
        }
       });
    });
</script>
