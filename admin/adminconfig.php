<?php
 session_start();
 if(empty($_SESSION['adminphone'])) {
    header("location: admin-login.php");
    exit;
 }
?>