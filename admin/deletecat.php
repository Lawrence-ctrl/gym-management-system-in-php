<?php
  include('database/connection.php');
  include('function.php');
  include('adminconfig.php');
  if(isset($_POST['deleted'])){
  	$userid = clean($_POST['trashid']);
  	$del = $conn->query("DELETE FROM users WHERE userid = '$userid'");
  	if($del){
  		echo json_encode(array('code'=>101));
  	}
  }

  if(isset($_POST['dora'])){
  	$posid = clean($_POST['trashid']);
  	$hidden = clean($_POST['hidden']);
  	$hidid = clean($_POST['hidid']);
  	$del = $conn->query("DELETE FROM pos_income WHERE posi_id = '$posid'");
  	if($del){
  		$hello = $conn->query("SELECT * FROM pos WHERE pos_id = '$hidid'");
  		$yo = $hello->fetch_assoc();
  		$plus = $yo['pos_quantity'] + $hidden;
  		$yooo = $conn->query("UPDATE pos SET pos_quantity = '$plus' WHERE pos_id = '$hidid'");
  		if($yooo) {
  		echo json_encode(array('code'=>101));
  	  }
  	}
  }
?>