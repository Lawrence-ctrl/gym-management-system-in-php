<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   date_default_timezone_set('Asia/Rangoon');
   if(isset($_POST['caval'])){
   	 $caval = clean($_POST['caval']);
   	 $nice = $conn->query("SELECT * FROM calories WHERE calorie_food_name LIKE '%".$caval."%' OR calorie_number LIKE '%".$caval."%'");

   	 $output = '<div class="table-responsive">';
   	 $output.= '<table class="table table-bordered table-striped table-success">
   	 			<thead>
   	 			  <td>Food ID</td>
   	 			  <td class="unicode">Food Name</td>
   	 			  <td>Food Calorie</td>
   	 			  <td>Quantity</td>
   	 			  <td>Action</td>
   	 			</thead><tbody>';
  
   foreach ($nice as $room) {
   	 $optionString = '';
	for ($i=1; $i <=100; $i++){
	 $optionString .= '<option value='.$i.'>'.$i.'</option>';
	}
   	 $output .= '<tr>
          <td>'.$room['calorie_id'].'</td>
   	 			<td class="unicode">'.$room['calorie_food_name'].'</td>
   	 			<td class="">'.$room['calorie_number'].'</td>
   	 			<td><select name="calorie" id="caloriee'.$room['calorie_id'].'" class="form-control-sm">
   	 			   '.$optionString.'
   	 			</select></td>
   	 			<td><button type="submit" class="btn btn-info adder_er" data-id='.$room['calorie_id'].'><i class="fas fa-plus"></i> ADD</button></td>
   	 			</tr>';
   }
   $output .='</tbody></table></div>';
   echo $output;
}  
    if(isset($_POST['yours']))
    {   
    	$calid = $conn->real_escape_string($_POST['data_id']);
    	$quantity = clean($_POST['selectval']);
    	$date = date("Y-m-d");
    	$query = $conn->query("SELECT * FROM yours WHERE your_food_id = '$calid' AND created_date= '$date' AND your_userid = '".$_SESSION['userid']."'");
    	if($query->num_rows > 0){
    		$ie = $query->fetch_array();
    		$owl = $conn->query("SELECT * FROM calories WHERE calorie_id = '$calid'");
	    	$ouch = $owl->fetch_array();
	    	$your_calorie = $quantity * $ouch['calorie_number'];
    		$new_quantity = $ie['your_quantity']+$quantity;
    		$new_calorie = $ie['your_calorie']+ $your_calorie;
    		$cool = $conn->query("UPDATE yours SET your_quantity ='$new_quantity',your_calorie='$new_calorie' WHERE your_food_id = '$calid' AND your_userid = '".$_SESSION['userid']."'");
    	}else{
    		$owl = $conn->query("SELECT * FROM calories WHERE calorie_id = '$calid'");
	    	$ouch = $owl->fetch_array();
	    	$your_calorie = $quantity * $ouch['calorie_number'];
    		$cool = $conn->query("INSERT INTO yours (your_userid, your_food_id, your_quantity, your_calorie, created_date, updated_date) VALUES ('".$_SESSION['userid']."','$calid','$quantity','$your_calorie', now(), now())");
    	}
    	if($cool){
    		$date = date('Y-m-d');
            $hello = $conn->query("SELECT * FROM yours WHERE created_date='$date' AND your_userid = '".$_SESSION['userid']."'");
            $total = 0;
            $output = '';
            if($hello->num_rows> 0) {
            foreach ($hello as $haha) {
            $total += $haha['your_calorie'];
            }
             $output.= $total." cal/day";        
    	}
    	  echo $output;   
    }
}
    if(isset($_POST['viewed']))
    {   
    	$date = date('Y-m-d');
    	$hello = $conn->query("SELECT yours.*,calories.* FROM yours LEFT JOIN calories ON yours.your_food_id = calories.calorie_id WHERE yours.created_date='$date' AND yours.your_userid = '".$_SESSION['userid']."'");
    	$output ='';	
    	if($hello->num_rows > 0) {
            foreach ($hello as $haha) {
            	$optionString = '';
	for ($i=1; $i <=100; $i++){
	 $optionString .= '<option value='.$i.' '.(($i == $haha['your_quantity'])?"selected":"").'>'.$i.'</option>';
	}
            	$output.= '<tr width="100%">
            				<td>'.$haha['calorie_food_name'].'</td>
            				<td>'.$haha['calorie_number'].'</td>
            				<td><select name="your_select" id="your_select'.$haha['your_id'].'" class="form-group">
            				  '.$optionString.'
            				  </select><a class="btn btn-success btn-sm change" data-id='.$haha['your_id'].'><i class="fas fa-check fa-sm"></i></a></td>
            				<td class="complex'.$haha['your_id'].'">'.$haha['your_calorie'].'</td>
            				<td><button class="btn btn-danger trash" data-trashid='.$haha['your_id'].'><i class="fas fa-trash"></i></button></td>
            				</tr>';
            }
         echo $output;
    }
}
   if(isset($_POST['trashid'])){
   	  $date = date('Y-m-d');
   	  $trashid = clean($_POST['trashid']);
   	  $raw = $conn->query("DELETE FROM yours WHERE your_id='$trashid' AND created_date='$date' AND your_userid='".$_SESSION['userid']."'");
   }
    if(isset($_POST['changeid'])){
        $one ='';
    	$date = date('Y-m-d');
    	$changeid = clean($_POST['changeid']);
    	$your_select = clean($_POST['your_select']);
    	$oww = $conn->query("SELECT yours.*,calories.* FROM yours LEFT JOIN calories ON yours.your_food_id=calories.calorie_id WHERE yours.your_id='$changeid' AND yours.created_date='$date' AND yours.your_userid='".$_SESSION['userid']."'");
    	$owl = $oww->fetch_assoc();
    	$your_calorie = $owl['calorie_number']*$your_select;
    	$rush = $conn->query("UPDATE yours SET your_quantity='$your_select',your_calorie='$your_calorie' WHERE yours.your_id = '$changeid' AND yours.created_date='$date' AND yours.your_userid='".$_SESSION['userid']."'");
    	$one .= $your_calorie;
    	if($rush){
    		$status = '';
    		$date = date('Y-m-d');
            $hello = $conn->query("SELECT * FROM yours WHERE created_date='$date' AND your_userid = '".$_SESSION['userid']."'");
            $total = 0;
            $output = '';
            if($hello->num_rows> 0) {
            foreach ($hello as $haha) {
            $total += $haha['your_calorie'];
            }
             $status .= $total." cal/day";        
    	}
    	echo json_encode(array('code' => 100,'one'=>$one, 'status' => $status));
    }
}
?>