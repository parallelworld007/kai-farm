<?php
$menu = "seles"
?>





<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Detail</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  
<?php include("header.php"); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
        <div class="small-box bg-gradient-olive">
            <div class="inner">
                <h3>รายการสั่งซื้อ</h3>
                <p>ข้อมูลการสั่งซื้อ</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus text-light"></i>
            </div>
            <a  class="small-box-footer">
                <i class="fas fa-arrow-circle-right"></i>
            </a>
</section>
  
  <!-- Main content -->
  <section class="content">
    <div class="card card-gray">
      <div class="card-header ">
        <h3 class="card-title">


        </h3>
        <div align="right">
  
        </div>
      </div>
      <br>
      <div class="card-body">
        <div class="row">
          
          <div class="col-md-6">
            
          

          </div>
          <head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<body>
<table width="600" border="0" align="center" class="square">
  
<?php
//connect db
    include("db.php");
		$o_id = $_GET['o_id']; //สร้างตัวแปร p_id เพื่อรับค่า
    if(isset($_POST['submit'])){
      $o_wait = $_POST['o_wait'];

        //เช็คข้อมูลซ้ำ

          //echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);  {
              $sql2 = "UPDATE `order_head` SET   `o_wait`='$o_wait'     
                      WHERE o_id = $o_id";
              $result =mysqli_query($conn, $sql2);


              if ($sql2) {
                  $_SESSION['success'] = "Data has been inserted successfully";
                  echo "<script>";
                  echo "Swal.fire({
                              icon: 'success',
                              title: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
                              showConfirmButton: false,
                              timer: 1500,
                              })";
                  echo "</script>";
              } else {
                  $_SESSION['error'] = "Data has not been inserted successfully";
                  header("Location: seles.php");
              }
          }
      
	
	$sql = "select * from order_head where o_id=$o_id"; 
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	//แสดงรายละเอียด
	echo "<tr>";
  	echo "<td width='200' valign='center'><b>รหัสการสั่งซื้อ</b></td>";
    echo "<td width='279'>" . $row["o_id"] . "</td>";
    echo "<tr>";
  	echo "<td width='200' valign='center'><b>วันที่ในการสั่งซื้อ</b></td>";
    echo "<td width='279'>" . $row["o_dttm"] . "</td>";
    echo "<tr>";
  	echo "<td width='200' valign='center'><b>ชิ่อผู้สั่ง</b></td>";
    echo "<td width='279'>" . $row["o_name"] . "</td>";
    echo "<tr>";
  	echo "<td width='200' valign='center'><b>emailของผู้สั่งซื้อ</b></td>";
    echo "<td width='279'>" . $row["o_email"] . "</td>";
    echo "<tr>";
  	echo "<td width='200' valign='center'><b>เบอร์โทรศัพท์</b></td>";
    echo "<td width='279'>" . $row["o_phone"] . "</td>";
    echo "<tr>";
    echo "<td width='200' valign='center'><b>ที่อยู่</b></td>";
    echo "<td width='279'>" . $row["o_addr"] . "</td>";
    echo "<tr>";
  	echo "<td width='200' valign='center'><b>สถานะ</b></td>";
    echo "<td width='279'>" . $row["o_wait"] . "</td>";
    echo "<tr>";
    echo "<td width='200' valign='center'><b>รวมรายการ</b><b> </b></td>";
    echo "<td width='279'>" . $row["o_qty"] . "<b> รายการ</b></td>";
    echo "<tr>";
    echo "<td width='200' valign='center'><b>รวมที่ต้องชำระ</b></td>";
    echo "<td width='279'>" . number_format($row['o_total'], 2) . " บาท</td>";
    echo "<tr>";
   
    
?>
                      
</table>

<?php
                include "db.php";
                $o_id = $_GET['o_id'];

                if(isset($_POST['submit'])){
                    $o_wait = $_POST['o_wait'];

                      //เช็คข้อมูลซ้ำ

                        //echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);  {
                            $sql2 = "UPDATE `order_head` SET   `o_wait`='$o_wait'     
                                    WHERE o_id = $o_id";
                            $result =mysqli_query($conn, $sql2);


                            if ($sql2) {
                                $_SESSION['success'] = "Data has been inserted successfully";
                                echo "<script>";
                                echo "Swal.fire({
                                            icon: 'success',
                                            title: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
                                            showConfirmButton: false,
                                            timer: 1500,
                                            })";
                                echo "</script>";
                            } else {
                                $_SESSION['error'] = "Data has not been inserted successfully";
                                header("Location: seles.php");
                            }
                        }
                    

    ?>

  



<div class="col-md-9">
  
                                     <a href="sales.php" class="btn btn-danger">กลับ</a>
                                     
                      
                    </div>
</body>
        </div>
      </div>
      <div class="card-footer">
        
      </div>
      
    </div>
    
    
    
    
    
  </section> 
  
  <?php include('footer.php'); ?>
  </script>
  
  
</body>
</html>
</body>
</html>