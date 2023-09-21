<?php
include '../db.php';
$hou_id =   $_POST['hou_data'];

$zone = "SELECT * FROM zone WHERE hou_id = $hou_id";

$zone_qry = mysqli_query($conn, $zone);
$output="";
$output = '<option value="">เลือกโซน</option>';
while ($zone_row = mysqli_fetch_assoc($zone_qry)) {
    $output .= '<option value="' . $zone_row['zon_id'] . '">' . $zone_row['zon_num'] . '</option>';
}
echo $output;
