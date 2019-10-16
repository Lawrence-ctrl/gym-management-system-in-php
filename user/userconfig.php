<?php
  include('../admin/database/connection.php');
  session_start();
  if(empty($_SESSION['userid'] && $_SESSION['useremail'])) {
  	  header("location:userlogin.php");
  	  exit;
  }
?>