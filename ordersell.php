<?php
$menu = "seles"
?>





<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Detail</title>


</head>

<body>
  
<?php include("header.php"); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
        <div class="small-box bg-gradient-olive">
            <div class="inner">
                <h3>แก้ไข</h3>
                <p>ตารางแก้ไขข้อมูล</p>
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


                    <table align="center" height="100" width="10">
    <tr>
      <td align="left" bgcolor="#B0E0E6">ลำดับ
        NO.
      </td>
      <td align="left" bgcolor="#B0E0E6">รหัสสินค้า</td>
      <td align="left" bgcolor="#B0E0E6">สินค้า</td>
      <td align="left" bgcolor="#B0E0E6">ราคา</td>
      <td align="left" bgcolor="#B0E0E6">จำนวน</td>
      <td align="left" bgcolor="#B0E0E6">รวม</td>
    </tr>
    <?php
      include("db.php");
      $o_id = $_GET['o_id']; //สร้างตัวแปร p_id เพื่อรับค่า

      $sql = "SELECT * FROM product
              INNER JOIN order_detail ON order_detail.p_id = product.p_id
              WHERE order_detail.o_id = $o_id";

      $result = mysqli_query($conn, $sql);

      $sequence = 1; // Initialize the sequence number variable

      while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td align='left'>$sequence</td>"; // Display the sequence number
        echo "<td align='left'>" . $row["p_id"] . "</td>";
        echo "<td align='left'>" . $row["p_name"] . "</td>";
        echo "<td align='left'>" . number_format($row['p_price'], 2) . "</td>";
        echo "<td align='left'>" . $row['d_qty'] . "</td>";
        echo "<td align='left'>" . number_format($row['d_subtotal'], 2) . " บาท</td>";

        echo "</tr>";

        $sequence++; // Increment the sequence number for the next row
      }
    ?>
    <?php
      //connect db
      include("db.php");
      $o_id = $_GET['o_id']; //สร้างตัวแปร p_id เพื่อรับค่า

      $sql = "SELECT * FROM order_head WHERE o_id = $o_id";

      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
    ?>
    <tr>
      
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td style='font-size:1em' bgcolor="#B0E0E6" >รวม / Total Amount </td>
      <td style='font-size:1em' bgcolor="#B0E0E6" ><?php echo number_format($row['o_total'], 2); ?> บาท</td>
    </tr>
  </table>

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