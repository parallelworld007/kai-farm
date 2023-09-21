<?php 
include('db.php');

$id=$_GET['car_id'];
$car_sta=$_GET['car_sta'];

$sql = "update care set car_sta=$car_sta where car_id=$id";

mysqli_query($conn,$sql);

header('location:care.php');

?>