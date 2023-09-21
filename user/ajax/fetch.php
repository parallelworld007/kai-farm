<?php
  include('../db.php');
 
  $id = $_POST['id'];
  $sql = "SELECT * FROM zone WHERE hou_id= $id ";
  $result = mysqli_query($conn,$sql);
 
  $out='<option value="" disabled selected>เลือกโซน</option>';
  while($row = mysqli_fetch_array($result)) 
  {   
     $out .=  '<option value="' . $row['zon_id'] . '">' . $row['zon_num'] . '</option>'; 
  }
   echo $out;
?>


