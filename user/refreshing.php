<?php
	include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('function.php');
   date_default_timezone_set('Asia/Rangoon');
     if(isset($_POST['userid'])) {
     	$from = $_SESSION['userid'];
     	$to = $_POST['userid'];
         echo refresh_messages($from,$to);
 }
?>