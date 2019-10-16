<?php
	function checkname($name)
	{
		global $conn;	
		$result = $conn->query("SELECT * FROM exercises WHERE exer_name LIKE '%".$name."%'");		
		if(mysqli_num_rows($result)>0){
			return false;
		}else{
			return true;
		}
	}
	function checkposname($name)
	{
		global $conn;	
		$result = $conn->query("SELECT * FROM pos WHERE pos_name='$name'");		
		if(mysqli_num_rows($result)>0){
			return false;
		}else{
			return true;
		}
	}
	function clean($string)
	{
		global $conn;
		return mysqli_real_escape_string($conn,$string);
	}
	function checkemail($email)
	{
		global $conn;
		$res = $conn->query("SELECT * FROM users WHERE useremail='$email'");
		if($res->num_rows >0){
			return false;
		}else{
			return true;
		}
	}
	function checkusername($username)
	{
		global $conn;
		$res = $conn->query("SELECT * FROM users WHERE username='$username'");
		if($res->num_rows >0){
			return false;
		}else{
			return true;
		}
	}
	function checkadmin($phone,$password){
		global $conn;
		$res = $conn->query("SELECT * FROM admin_page WHERE admin_phone='$phone' AND admin_password='$password'");
		if($res->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}
	function checker($username,$userid)
	{
		global $conn;
		$res = $conn->query("SELECT * FROM users WHERE username='$username' AND userid != '$userid'");
		if($res->num_rows >0){
			return false;
		}else{
			return true;
		}
	}
	function checkbooker($username)
	{
		global $conn;
		$res = $conn->query("SELECT * FROM booking WHERE bookuser_name LIKE '%".$username."%'" );
		if($res->num_rows >0){
			return false;
		}else{
			return true;
		}
	}
	function passcheck($password,$userid,$useremail)
	{
		global $conn;
		$res = $conn->query("SELECT * FROM users WHERE userpass='$password' AND useremail='$useremail' AND userid ='$userid'");
		if($res->num_rows > 0)
		{
			return true;
		}else{
			return false;
		}
	}
	function checknamers($name,$id)
	{
		global $conn;	
		$result = $conn->query("SELECT * FROM exercises WHERE exer_name LIKE '%".$name."%' AND exer_id !='$id'");		
		if(mysqli_num_rows($result)>0){
			return false;
		}else{
			return true;
		}
	}
	function checkposnamers($name,$id)
	{
		global $conn;	
		$result = $conn->query("SELECT * FROM pos WHERE pos_name='$name' AND pos_id != '$id'");		
		if(mysqli_num_rows($result)>0){
			return false;
		}else{
			return true;
		}
	}
?>