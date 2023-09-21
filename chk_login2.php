<?php 
session_start(); 
include "condb.php";

if (isset($_POST['cus_username']) && isset($_POST['cus_password'])) {



	$cus_username = ($_POST['cus_username']);
	$cus_password = ($_POST['cus_password']);

	if (empty($cus_username)) {
      echo '<script>';
      echo "alert(\" username หรือ  password ไม่ถูกต้อง\");"; 
      echo "window.history.back()";
      echo '</script>';
	    exit();
	}else if(empty($cus_password)){
      echo '<script>';
      echo "alert(\" username หรือ  password ไม่ถูกต้อง\");"; 
      echo "window.history.back()";
      echo '</script>';
	    exit();
	}else{
		// hashing the password

        
		$sql = "SELECT * FROM tbl_customer WHERE cus_username='$cus_username' AND cus_password='$cus_password'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['cus_username'] === $cus_username && $row['cus_password'] === $cus_password) {
            	$_SESSION['cus_username'] = $row['cus_username'];
            	$_SESSION['cus_name'] = $row['cus_name'];
            	$_SESSION['cus_id'] = $row['cus_id'];
            	header("Location: customer/index.php");
		        exit();
            }else{
              echo '<script>';
              echo "alert(\" username หรือ  password ไม่ถูกต้อง\");"; 
              echo "window.history.back()";
              echo '</script>';
		        exit();
			            }
              }else{
              echo '<script>';
              echo "alert(\" username หรือ  password ไม่ถูกต้อง\");"; 
              echo "window.history.back()";
              echo '</script>';
              exit();
                }
              }
              
            }else{
              header("Location: index.php");
              exit();
            }