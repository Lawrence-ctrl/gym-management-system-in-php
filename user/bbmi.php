<?php
   include_once('../admin/database/connection.php');
   include('userconfig.php');
   include('../admin/function.php');
   date_default_timezone_set('Asia/Rangoon');
   if(isset($_POST['centi'])){
      $height = mysqli_real_escape_string($conn,$_POST['centi']);
      $weight = mysqli_real_escape_string($conn,$_POST['kilo']);
      $output ='';
      $status ='';
    if($weight > 0 && $height > 0) {
      $bmii = ($weight*10000)/($height*$height);
      $bmi = round($bmii,1);
      if($bmi < 18.5){
        $status = "Underweight ";
      }elseif($bmi >= 18.5 && $bmi <= 24.9) {
        $status .= "Normal";
      }elseif($bmi >= 25 && $bmi <= 29.9){
        $status .= "Overweight";
      }else{
        $status .= "Obese";
      }
      $output .= '<div class="haha">
                    <a class="btn btn-info" href="bmi.php">Recalculate BMI</a>
                    <div class="form-row">
                                  <div class="form-group col-md-6 col-6" style="font-size:16px;">
                                     For the information you entered:<br>
                                     Height: <b>'.$height.'</b> Centimeters<br>
                                     Weight : <b>'.$weight.'</b> Kilograms <br>
                                     Your BMI is <b>'.$bmi.'</b>, indicating your weight is in the <b>'.$status.'</b> category for adults of your height.<br> 
                                  </div>
                                  <div class="form-group col-md-6 col-6">
                                   <table class="table table-bordered">
                                      <tr>
                                         <thead>
                                         <th>BMI</th>
                                         <th>Weight Status</th>
                                         </thead>
                                      </tr>
                                        <tbody>
                                     '.(($status == 'Underweight')?
                                      "<tr style='background:lightblue'>
                                         <td>Below 18.5</td>
                                         <td>Underweight</td>
                                      </tr>
                                      <tr>
                                         <td>18.5 - 24.9</td>
                                         <td>Normal</td>
                                      </tr>
                                      <tr>
                                         <td>25 - 29.9</td>
                                         <td>Overweight</td>
                                      </tr>
                                      <tr>
                                         <td>30.0 and above</td>
                                         <td>Obese</td>
                                      </tr>":"").'
                                     '.(($status == "Normal")?
                                      "<tr>
                                         <td>Below 18.5</td>
                                         <td>Underweight</td>
                                      </tr>
                                      <tr style='background:lightblue'>
                                         <td>18.5 - 24.9</td>
                                         <td>Normal</td>
                                      </tr>
                                      <tr>
                                         <td>25 - 29.9</td>
                                         <td>Overweight</td>
                                      </tr>
                                      <tr>
                                         <td>30.0 and above</td>
                                         <td>Obese</td>
                                      </tr>":"").'
                                      '.(($status == "Overweight")?
                                      "<tr>
                                         <td>Below 18.5</td>
                                         <td>Underweight</td>
                                      </tr>
                                      <tr>
                                         <td>18.5-24.9</td>
                                         <td>Normal</td>
                                      </tr>
                                      <tr style='background:lightblue'>
                                         <td>25-29.9</td>
                                         <td>Overweight</td>
                                      </tr>
                                      <tr>
                                         <td>30.0 and above</td>
                                         <td>Obese</td>
                                      </tr>":"").'
                                      '.(($status == "Obese")?
                                      "<tr>
                                         <td>Below 18.5</td>
                                         <td>Underweight</td>
                                      </tr>
                                      <tr>
                                         <td>18.5 - 24.9</td>
                                         <td>Normal</td>
                                      </tr>
                                      <tr>
                                         <td>25 - 29.9</td>
                                         <td>Overweight</td>
                                      </tr>
                                      <tr style='background:lightblue'>
                                         <td>30.0 and above</td>
                                         <td>Obese</td>
                                      </tr>":"").'
                                      </tbody>
                                    </table>
                                  </div>
                  </div></div>';
      echo "$output";
    }
   }
   if(isset($_POST['feet'])){
      $feet = mysqli_real_escape_string($conn,$_POST['feet']);
      $inches = mysqli_real_escape_string($conn,$_POST['inches']);
      $height = ($feet*12) + $inches;
      $weight = mysqli_real_escape_string($conn,$_POST['pounds']);
      $output ='';
      $status = '';
    if($weight > 0 && $height > 0) {
      $bmii = ($weight*703)/($height*$height);
      $bmi = round($bmii,1);
      if($bmi < 18.5){
        $status = "Underweight";
      }elseif($bmi >= 18.5 && $bmi <= 24.9) {
        $status .= "Normal";
      }elseif($bmi >= 25 && $bmi <=29.9)  {
        $status .= "Overweight";
      }else{
        $status .= "Obese";
      }
      $output .= '<div class="haha">
                    <a class="btn btn-info" href="bmi.php">Recalculate BMI</a>
                    <div class="form-row">
                                  <div class="form-group col-md-6 col-6" style="font-size:16px;">
                                     For the information you entered:<br>
                                     Height: <b>'.$feet.'</b> Feet , <b>'.$inches.'</b> Inches<br>
                                     Weight : <b>'.$weight.'</b> Pounds <br>
                                     Your BMI is <b>'.$bmi.'</b>, indicating your weight is in the <b>'.$status.'</b> category for adults of your height.<br> 
                                  </div>
                                  <div class="form-group col-md-6 col-6">
                                   <table class="table table-bordered">
                                      <tr>
                                         <thead>
                                         <th>BMI</th>
                                         <th>Weight Status</th>
                                         </thead>
                                      </tr>
                                        <tbody>
                                     '.(($status == 'Underweight')?
                                      "<tr style='background:lightblue'>
                                         <td>Below 18.5</td>
                                         <td>Underweight</td>
                                      </tr>
                                      <tr>
                                         <td>18.5 - 24.9</td>
                                         <td>Normal</td>
                                      </tr>
                                      <tr>
                                         <td>25 - 29.9</td>
                                         <td>Overweight</td>
                                      </tr>
                                      <tr>
                                         <td>30.0 and above</td>
                                         <td>Obese</td>
                                      </tr>":"").'
                                     '.(($status == "Normal")?
                                      "<tr>
                                         <td>Below 18.5</td>
                                         <td>Underweight</td>
                                      </tr>
                                      <tr style='background:lightblue'>
                                         <td>18.5 - 24.9</td>
                                         <td>Normal</td>
                                      </tr>
                                      <tr>
                                         <td>25 - 29.9</td>
                                         <td>Overweight</td>
                                      </tr>
                                      <tr>
                                         <td>30.0 and above</td>
                                         <td>Obese</td>
                                      </tr>":"").'
                                      '.(($status == "Overweight")?
                                      "<tr>
                                         <td>Below 18.5</td>
                                         <td>Underweight</td>
                                      </tr>
                                      <tr>
                                         <td>18.5-24.9</td>
                                         <td>Normal</td>
                                      </tr>
                                      <tr style='background:lightblue'>
                                         <td>25-29.9</td>
                                         <td>Overweight</td>
                                      </tr>
                                      <tr>
                                         <td>30.0 and above</td>
                                         <td>Obese</td>
                                      </tr>":"").'
                                      '.(($status == "Obese")?
                                      "<tr>
                                         <td>Below 18.5</td>
                                         <td>Underweight</td>
                                      </tr>
                                      <tr>
                                         <td>18.5 - 24.9</td>
                                         <td>Normal</td>
                                      </tr>
                                      <tr>
                                         <td>25 - 29.9</td>
                                         <td>Overweight</td>
                                      </tr>
                                      <tr style='background:lightblue'>
                                         <td>30.0 and above</td>
                                         <td>Obese</td>
                                      </tr>":"").'
                                      </tbody>
                                    </table>
                                  </div>
                  </div></div>';

                  echo "$output";
    }
   }
?>