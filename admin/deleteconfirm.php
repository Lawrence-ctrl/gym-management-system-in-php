<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
    if(isset($_POST['trash_id'])) {
    	$trash_id = $conn->real_escape_string($_POST['trash_id']);
    	$yes = $conn->query("DELETE FROM booking WHERE book_id = '$trash_id'");
    }
?>