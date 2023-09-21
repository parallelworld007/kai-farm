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

	$name = $_POST["name"];
	$address = $_POST["address"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$qty = $_POST["total_qty"];
	$total = $_POST["total"];
	$dttm = Date("Y-m-d G:i:s");
	$wait = $_POST["wait"];
	$mem_id = $_SESSION['mem_id'];

	echo $total;
	echo $name;
	echo $address;
	echo $phone;
	echo $qty;
	echo $total;
	echo $dttm;
	echo $wait;

	
	//บันทึกการสั่งซื้อลงใน order_detail
	mysqli_query($conn, "BEGIN"); 
	$sql1	= "insert into order_head values(null, '$dttm', '$name', '$address', '$email', '$phone', '$qty', '$total', '$wait','null','$mem_id')";
	$query1	= mysqli_query($conn, $sql1);
	//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
	$sql2 = "select max(o_id) as o_id from order_head where o_name='$name' and o_email='$email' and o_dttm='$dttm' and o_wait='$wait' ";
	$query2	= mysqli_query($conn, $sql2);
	$row = mysqli_fetch_array($query2);
	$o_id = $row["o_id"];



//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
	foreach($_SESSION['cart'] as $p_id=>$qty)
	{
		
		$sql3	= "SELECT 
		product.*,
		SUM(add_chicken.adc_total) AS total_adc_total,
		CURDATE() 
	 FROM 
		product
	 JOIN 
		house ON house.hou_id = house.hou_id
	 JOIN 
		zone ON house.hou_id = zone.hou_id
	 JOIN 
		add_chicken ON zone.zon_id = add_chicken.zon_id
	 WHERE 
		CURDATE() >= add_chicken.adc_datesell
		AND product.p_id = $p_id;";
		$query3	= mysqli_query($conn, $sql3);

		$row3	= mysqli_fetch_array($query3);
		$total	= $row3['p_price']*$qty;
		
		$sql4	= "insert into order_detail values(null, '$o_id', '$p_id', '$qty', '$total')";
		$query4	= mysqli_query($conn, $sql4);
		
		
	}


if ($query1 && $query4) {
    mysqli_query($conn, "COMMIT");
    $msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
    foreach ($_SESSION['cart'] as $p_id) {
        unset($_SESSION['cart'][$p_id]);
    }
    unset($_SESSION['cart']);
} else {
    mysqli_query($conn, "ROLLBACK");
    $msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";
}





	
?>




<script type="text/javascript"> alert("<?php echo $msg;?>"); window.location ='sale.php?'; </script>



</body>
</html>