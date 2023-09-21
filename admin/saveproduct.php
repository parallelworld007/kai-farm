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
	$detail = $_POST["detail"];
	$price = $_POST["price"];

	$image_name = rand(100, 999) . ".jpg";
    $p_pic = "http://localhost/farmkai/images/" . $image_name;
    copy($_FILES["p_pic"]["tmp_name"], "../images/" . $image_name);

	// เชื่อมต่อกับฐานข้อมูลของคุณที่นี่

	// ตรวจสอบว่า hou_id และ zon_id ไม่ซ้ำกับข้อมูลที่มีอยู่แล้ว
	
    // บันทึกข้อมูลใหม่เมื่อไม่มีข้อมูลที่ซ้ำ
    $sql = "INSERT INTO `product`(`p_name`, `p_detail`, `p_price`, `p_pic`) 
            VALUES ('$name','$detail','$price','$p_pic')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['success'] = "บันทึกข้อมูลเรียบร้อยแล้ว";
        echo "<script>";
        echo "Swal.fire({
                   icon: 'success',
                   title: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
                   showConfirmButton: false,
                   timer: 1500,
                   })";
        echo "</script>";
        header("refresh:1 ; url=product.php");
    } else {
        $_SESSION['error'] = "บันทึกข้อมูลไม่สำเร็จ";
        header("Location: product.php");
    }
?>

<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='product.php?';
	
	
</script>

 




</body>
</html>