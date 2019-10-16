<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   include('function.php');
   date_default_timezone_set('Asia/Rangoon');
    if(isset($_POST['action']) && $_POST['action'] == 'refreshuser') {
    	 $quesr = $conn->query("SELECT users.*,booking.* FROM users LEFT JOIN booking ON users.userid = booking.bookuser_id WHERE (users.userid = booking.bookuser_id OR users.userstatus='2') AND users.userid!='".$_SESSION['userid']."'");
    foreach ($quesr as $rose) {
     $action = '';
     $time = strtotime(date('Y-m-d H:i:s').'-10 second');
     $real = date('Y-m-d H:i:s',$time);
     $activityofuser = checkactivity($rose['userid']);
     if($activityofuser > $real) {
      $action = '<button class="btn btn-success">Online</button>';
     }else{
      $action = '<button class="btn btn-danger">Offline</button>';
     }
    $output =  '<tr>
    				  <td>'.$rose['username'].'<i style="text-align:right"></i></td>
    				  <td><img src="../admin/images/'.$rose['user_img'].'" style="height:25px; width:25px"></td>
    				  <td>'.(($rose['userstatus'] == '1')?"Member":"Trainer").'</td>
    				  <td>'.$action.'</td>
    				  <td><a href="twouserchat.php?userid='.$rose['userid'].'" name="conversation" id='.$rose['userid'].' class="btn btn-info conversation"><i class="fas fa-comment"></i> &nbsp;Start Chat</a>
    				  </td>
    		</tr>';
           echo $output;
   } 
}
	
	if(isset($_POST['action']) && $_POST['action'] == 'refresh'){
		$quesr = $conn->query("UPDATE login SET activity = now() WHERE logid = '".$_SESSION['lid']."'");
	}

