<?php
	$conn= mysqli_connect("127.0.0.1","root","","chicken_farm") or die("Error: " . mysqli_error($con));
	mysqli_query($conn, "SET NAMES 'utf8' "); 
?>