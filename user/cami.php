<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   include('function.php');
   date_default_timezone_set('Asia/Rangoon');
   if(isset($_POST['feet'])) {
   	 $gender = clean($_POST['gender']);
   	 $age = clean($_POST['age']);
   	 $feet = clean($_POST['feet'])*12;
   	 $inches = clean($_POST['inches']);
   	 $height = $feet + $inches;
   	 $weight = clean($_POST['pounds']);
   	 $exercise_level = clean($_POST['exercise_level']);
   	 echo checkstandard($height,$weight,$age,$exercise_level,$gender);
}
  if(isset($_POST['centir'])){
  	 $gender = clean($_POST['genderer']);
   	 $age = clean($_POST['ager']);
   	 $height = clean($_POST['centir']);
   	 $weight = clean($_POST['kilor']);
   	 $exercise_level = clean($_POST['exercise_levelr']);
   	 echo checkmetrics($height,$weight,$age,$exercise_level,$gender);
  }
?>