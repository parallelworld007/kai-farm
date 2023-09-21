<?php
	session_start();
    include("db.php");  
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirm</title>
</head>
<body>
<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php
            $p_name = $_POST['p_name'];
            $p_detail = $_POST['p_detail'];
            $p_price = $_POST['p_price'];
            
            $image_name = rand(100,999).".jpg";
            $p_pic="http://localhost/farmkai/images/".$image_name;



    $sql = "UPDATE `product`( `p_name`, `p_detail`, `p_price`, `p_pic`) 
    VALUES ('$name','$detail','$price','$p_pic')";
    $result = mysqli_query($conn, $sql);
		
	
	if($query1 && $query4){
		mysqli_query($conn, "COMMIT");
		$msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
		foreach($_SESSION['cart'] as $p_id)
		{	
			unset($_SESSION['cart'][$p_id]);
			unset($_SESSION['cart']);
		}
	}
	else{
		mysqli_query($conn, "ROLLBACK");  
		$msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";	
	}
?>


<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='sale.php?';
	
	
</script>

 




</body>
</html>