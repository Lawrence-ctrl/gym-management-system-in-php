<?php
   function checkactivity($userid){
   	global $conn;
   	$cute = $conn->query("SELECT * FROM login WHERE uid = '$userid' ORDER BY activity DESC");
   	foreach ($cute as $quat){
   		return $quat['activity'];
   	}
   }
   function refresh_messages($fromid,$toid)
   {
   	global $conn;
   	$cute = $conn->query("SELECT * FROM chat WHERE (fromid = '$fromid' AND toid = '$toid') OR (fromid = '$toid' AND toid = '$fromid')");
   	$output = '';
   	foreach ($cute as $quat){
   		if($quat['fromid'] == $fromid){
   			$output .= '<div class="outgoing_msg">
              <div class="sent_msg">
                <p>'.$quat['chats'].'</p>
                <span class="time_date">'.date('Y-m-d H:i A', strtotime($quat['chat_time'])).'</span> 
                </div>
                </div>
           ';
   		}else{
   			$output.=' <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="../admin/images/'.getuserphoto($quat['fromid']).'" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>'.$quat['chats'].'</p>
                  <span class="time_date">'.date('Y-m-d H:i A', strtotime($quat['chat_time'])).'</span></div>
              </div>
            </div>';
   		}
   	}
   	return $output;
   }
   function getuserphoto($fromid){
   	 global $conn;
   	 $cute = $conn->query("SELECT * FROM users WHERE userid = '$fromid'");
   	 foreach ($cute as $value) {
   	 	 return $value['user_img'];
   	 }
   }
   function checkstandard($height,$weight,$age,$exer,$gender)
   {
    global $conn;
    if($gender == 1){
      $result = $exer*(66 + (6.23 * $weight) + (12.7 * $height) - (6.8*$age));
    }else{
      $result = $exer*(655 + (4.35 * $weight) + (4.7 * $height) - (4.7*$age));
    }
    return "Your daily calorie result is " ."<b>".round($result,2)."</b>";
   }

   function checkmetrics($height,$weight,$age,$exer,$gender)
   {
    global $conn;
    if($gender == 1){
      $result = $exer*(66 + (13.7 * $weight) + (5 * $height) - (6.8*$age));
    }else{
      $result = $exer*(655 + (9.6 * $weight) + (1.8 * $height) - (4.7*$age));
    }
    return "Your daily calorie result is " ."<b>".round($result,2)."</b>";
   }
//    Daily Calories = EXERCISE_LEVEL_FECTOR * (66 + (6.23 x Weight_POUNDS) + (12.7 x Height_INCHES) - (6.8 x Age_Y))
//    Daily Calories = EXERCISE_LEVEL_FECTOR * (66 + (13.7 x Weight_KG) + (5 x Height_CM) - (6.8 x Age_Y))
//     Daily Calories = EXERCISE_LEVEL_FECTOR * (655 + (9.6 x Weight_KG) + (1.8 x Height_CM) - (4.7 x Age_Y)) OR
// Daily Calories = EXERCISE_LEVEL_FECTOR * (655 + (4.35 x Weight_POUNDS) + (4.7 x Height_INCHES) - (4.7 x Age_Y)) 
?>