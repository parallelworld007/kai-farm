<?php
$menu = "index"
?>


<?php
ob_start();
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<section class="content-header">
    <div class="container-fluid">
    <h1><i class="nav-icon fa fa-shopping-cart text-indigo"></i> การสั่งซื้อ</h1>
    </div><!-- /.container-fluid -->
</section>

<head><link rel="stylesheet" type="text/css" href="SL1.css"></head>

<body onLoad="window.print()">
<div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>สีขาวฟาร์ม</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>รายละเอียด</h2>
        <p> 
              
<?php
//connect db
    include("db.php");
		$o_id = $_GET['o_id']; //สร้างตัวแปร p_id เพื่อรับค่า

	$sql = "select * from order_head  where o_id=$o_id"; 
  
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	//แสดงรายละเอียด

  	echo "<td width='10' valign='center'><b>รหัสการสั่งซื้อ: </b></td>";
    echo "<td width='10'>" . $row["o_id"] . "</td>";
    echo "</br>";
  	echo "<td width='10' valign='center'><b>วันที่ในการสั่งซื้อ: </b></td>";
    echo "<td width='10'>" . $row["o_dttm"] . "</td>";
    echo "</br>";
  	echo "<td width='100' valign='center'><b>ชิ่อผู้สั่ง: </b></td>";
    echo "<td width='300'>" . $row["o_name"] . "</td>";
    echo "</br>";
  	echo "<td width='100' valign='center'><b>emailของผู้สั่งซื้อ: </b></td>";
    echo "<td width='300'>" . $row["o_email"] . "</td>";
    echo "</br>";
  	echo "<td width='100' valign='center'><b>เบอร์โทรศัพท์: </b></td>";
    echo "<td width='300'>" . $row["o_phone"] . "</td>";
    echo "</br>";
    echo "<td width='100' valign='center'><b>ที่อยู่: </b></td>";
    echo "<td width='300'>" . $row["o_addr"] . "</td>";
    echo "</br>";
  	echo "<td width='100' valign='center'><b>สถานะ: </b></td>";
    echo "<td width='300'>" . $row["o_wait"] . "</td>";
    echo "</br>";
    echo "<td width='100' valign='center'><b>รวมรายการ: </b><b> </b></td>";
    echo "<td width='300'>" . $row["o_qty"] . "<b> รายการ</b></td>";
    echo "</br>";
?>  

        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

					<div id="table">
                    <table width="600"  align="center"  height ="100" border="0" >
              <tr>
              </tr>
              <tr>
                <td align="left" style='font-size:0.50em' bgcolor="#ddd">สินค้า</td>
                <td align="left" style='font-size:0.50em' bgcolor="#ddd">ราคา</td>
                <td align="left" style='font-size:0.50em' bgcolor="#ddd">จำนวน</td>
                <td align="left" style='font-size:0.50em' bgcolor="#ddd">รวม</td>
              </tr>
              <?php
              include("db.php");
              $o_id = $_GET['o_id']; //สร้างตัวแปร p_id เพื่อรับค่า
              
              $sql = "SELECT * FROM product
              INNER JOIN order_detail ON order_detail.p_id = product.p_id
              where order_detail.o_id = $o_id";
              


              
              $result = mysqli_query($conn, $sql);

              while( $row = mysqli_fetch_array($result)) {

                echo "<tr>";
                echo "<td width ='800' style='font-size:0.50em'  align='left' >" . $row["p_name"] . "</td>";
                echo "<td  width ='400'  style='font-size:0.50em' align='left' >" . number_format($row['p_price'], 2) . "</td>";
                echo "<td  width ='400' style='font-size:0.50em' align='left' >" . $row['d_qty'] . "</td>";
                echo "<td  width ='400' style='font-size:0.50em' align='left' >" . number_format( $row['d_subtotal'], 2 ). "  บาท</td>";

                echo "</tr>";
              }
              ?>
              <?php
//connect db
    include("db.php");
		$o_id = $_GET['o_id']; //สร้างตัวแปร p_id เพื่อรับค่า

	$sql = "select * from order_head  where o_id=$o_id"; 
  
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	//แสดงรายละเอียด
    echo "<td style='font-size:0.50em' >รวม</td>";
    echo "<td>";
    echo "<td>";
    echo "<td style='font-size:0.50em'>" . number_format($row['o_total'], 2) . " บาท</td>";


?>  
            </table>
					</div><!--End Table-->

					<div id="legalcopy">
						<p class="legal"><strong>ขอขอบคุณสำหรับใช้บริการสั่งซื้อสินค้าจากฟาร์มเรา</strong>  
						</p>
					</div>

				</div><!--End InvoiceBot-->
  </div>

    

    

    <?php include('footer.php'); ?>

    </body>


 
 

    </html>