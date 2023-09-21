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
    include "db.php";
    $p_name = $_POST["p_name"];
    $p_detail = $_POST["p_detail"];
    $p_price = $_POST["p_price"];

    $image_name = rand(100, 999) . ".jpg";
    $p_pic = "http://localhost/farmkai/images/" . $image_name;
    //copy($_FILES["p_pic"]["tmp_name"], "../images/" . $image_name);




    $sql = "UPDATE `product`( `p_name`, `p_detail`, `p_price`, `p_pic`) 
    VALUES ('$p_name','$p_detail','$p_price','$p_pic')";
    $result = mysqli_query($conn, $sql);

    if ($sql) {
        $_SESSION['success'] = "Data has been inserted successfully";
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
        $_SESSION['error'] = "Data has not been inserted successfully";
        header("Location: product.php");
    }



    ?>

    <script type="text/javascript">
        alert("<?php echo $msg; ?>");
        window.location = 'product.php?';
    </script>






</body>

</html>