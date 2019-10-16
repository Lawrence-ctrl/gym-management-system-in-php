<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   include('function.php');
   date_default_timezone_set('Asia/Rangoon');
   if(isset($_POST['userid'])){
   	$toid = mysqli_real_escape_string($conn,$_POST['userid']);
   	$fromid = mysqli_real_escape_string($conn, $_SESSION['userid']);
   	$conversation = mysqli_real_escape_string($conn,$_POST['conversation']);
   	$conver = $conn->query("INSERT INTO chat (fromid,toid,chats,status,chat_time) VALUES ('$fromid','$toid','$conversation','1',now())");
   }
   echo refresh_messages($fromid,$toid);
?>