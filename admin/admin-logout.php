<?php
 include_once('database/connection.php');
 include('adminconfig.php');
 unset($_SESSION['adminphone']);
 header("location:admin-login.php");
 exit;
?>