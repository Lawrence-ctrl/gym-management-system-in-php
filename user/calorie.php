<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   date_default_timezone_set('Asia/Rangoon');
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
          .hello,.hel {
          text-align: center;
          font-size: 20px;
        }
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
              <h4 class="page-title">Calorie Calculator</h4>
          </div>
              <hr>
                <div class="row">
                   <div class="col-lg-6 col-md-6 cool">
                       <nav>
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#bmi-standard" role="tab" aria-controls="nav-home" aria-selected="true">Standard</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#bmi-metric" role="tab" aria-controls="nav-profile" aria-selected="false">Metric</a>
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="bmi-standard" role="tabpanel" aria-labelledby="nav-home-tab">
                            <form method="POST" action="bmi.php" id="standard">
                                <div class="form-row">
                                  <div class="form-group col-md-12">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control" id="age" name="age"  placeholder="Age">
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-12">
                                    <label for="gender">Gender</label>&nbsp;&nbsp;
                                    <input type="radio" value="1" id="gender" name="gender"  placeholder="gender">Male&nbsp; &nbsp;
                                    <input type="radio" value="2" id="gender" name="gender"  placeholder="gender">Female
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-6 col-6">
                                    <label for="feet">Height (Feet)</label>
                                    <input type="number" class="form-control" id="feet" name="feet" placeholder="Feet">
                                  </div>
                                  <div class="form-group col-md-6 col-6">
                                    <label for="inches">Height (Inch)</label>
                                    <input type="number" class="form-control" id="inches" name="inches"  placeholder="Inches">
                                  </div>
                                </div>
                                  <div class="form-row">
                                  <div class="form-group col-md-12">
                                    <label for="pounds">Weight (lb)</label>
                                    <input type="number" class="form-control" id="pounds" name="pounds"  placeholder="Pounds">
                                  </div>
                                </div>
                                  <div class="form-row">
                                  <div class="form-group col-md-12">
                                     <label for="exercise_level">Exercise Level</label>
                                      <select name="exercise_level" id="exercise_level" class="form-control">
                                         <option value="">--SELECT--</option>
                                         <option value="1.2">Sedentary: little or no exercise</option>
                                         <option value="1.375">Light: exercise 1-3 times/week</option>
                                         <option value="1.55">Moderate: exercise 4-5 times/week</option>
                                         <option value="1.725">Very Active: intense exercise 6-7 times/week</option>
                                         <option value="1.9">Extra Active: very intense exercise daily, or physical job</option>
                                      </select>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="standard">Calculate</button>
                                <div class="col-md-12 hello"></div>
                              </form>
                          </div>
                          <div class="tab-pane fade" id="bmi-metric" role="tabpanel" aria-labelledby="nav-profile-tab">
                              <form method="POST" id="metrics">
                                <div class="form-row">
                                  <div class="form-group col-md-12">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control" id="ager" name="ager" placeholder="Age">
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-12">
                                    <label for="gender">Gender</label>&nbsp;&nbsp;
                                    <input type="radio" value="1" id="genderer" name="genderer">Male&nbsp; &nbsp;
                                    <input type="radio" value="2" id="genderer" name="genderer">Female
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-12">
                                    <label for="centimetres">Height (cm)</label>
                                    <input type="number" class="form-control" id="centir" name="centir" placeholder="Centimetres">
                                  </div>
                                </div>
                                  <div class="form-row">
                                  <div class="form-group col-md-12">
                                    <label for="kilo">Weight (kg)</label>
                                    <input type="number" class="form-control" id="kilor" name="kilor" placeholder="Kilograms">
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-12">
                                     <label for="exercise_level">Exercise Level</label>
                                      <select name="exercise_levelr" id="exercise_levelr" class="form-control">
                                         <option value="">--SELECT--</option>
                                         <option value="1.2">Sedentary: little or no exercise</option>
                                         <option value="1.375">Light: exercise 1-3 times/week</option>
                                         <option value="1.55">Moderate: exercise 4-5 times/week</option>
                                         <option value="1.725">Very Active: intense exercise 6-7 times/week</option>
                                         <option value="1.9">Extra Active: very intense exercise daily, or physical job</option>
                                      </select>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Calculate</button>
                               <div class="col-md-12 hel"></div>
                              </form>
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
</body>
</html>
<script type="text/javascript">
   $(document).ready(function(){
        $('#standard').on('submit',function(event){
      event.preventDefault();
      var age = $('#age').val();
      var feet = $('#feet').val();
      var inches = $('#inches').val();
      var pounds = $('#pounds').val();
      var gender = $('input:radio[name="gender"]:checked').length;
      if(feet!='' && inches!='' && pounds!='' && age!='' && gender!='') {
         if($('#exercise_level').val() !='') {
       $.ajax({
          url : "cami.php",
          method: "POST",
          data : $('#standard').serialize(),
          success: function(data){         
            $('.hello').html(data);
          }
       });
     }else{
      alert('Select value is required');
     } 
     }else{
      alert('u must filled all fields');
     }
    });

    $('#metrics').on('submit',function(event){
      event.preventDefault();
      var ager = $('#ager').val();
      var centir = $('#centir').val();
      var kilor = $('#kilor').val();
      var genderer = $('input:radio[name="genderer"]:checked').length;
      if(centir!='' && kilor!='' && ager!='' && genderer!='') {
        if($('#exercise_levelr').val()!='') {
       $.ajax({
          url : "cami.php",
          method: "POST",
          data : $('#metrics').serialize(),
          success: function(data) {
            $('.hel').html(data);   
          }
       });
      }else{
      alert('Select value is required');
     } 
     }else{
      alert('u must filled all fields');
     }
    });
   });
</script>
