<?php
include '../db.php';

$zon_id =  $_POST['zon_data'];

$adkai = "SELECT * FROM add_chicken WHERE zon_id = $zon_id";
$adkai_qry = mysqli_query($conn, $adkai);


$output = '<option value="">จำนวนไก่</option>';
while ($adkai_row = mysqli_fetch_assoc($adkai_qry)) {
    $output .= '<option value="' . $adkai_row['adc_id'] . '">' . $adkai_row['adc_num'] . '</option>';
}
echo $output;
