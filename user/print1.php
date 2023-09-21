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

<head><link rel="stylesheet" type="text/css" href="SL1.css">
<style>
  /* CSS for the table */
  #table {
    border-collapse: collapse;
    width: 600px;
    margin: auto;
  }

  #table td {
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 0.50em;
  }
  #tables {
    border-collapse: collapse;
    width: 600px;
    margin: auto;
  }
  #tables td {
    border: 0.1px solid #ddd;
    padding: 4px;
    font-size: 0.50em;
  }
  
</style>
</head>

<body>
<div id="invoice-POS">
    
    <div id="mid">
      <div class="info">
      <center>
        <h5>ใบเสร็จรับเงิน</h5>
        <div class="logo"></div>
      <div class="info"> 
        <h2>สีขาวฟาร์ม</h2>
      </div><!--End Info-->
      <div class="info"> 
        <h2>
ที่อยู่ของฟาร์ม สีขาวฟาร์ม , ต.วังสะพุง , อ.วังสะพุง , จ.เลย 
42130 </h2>
      </div>
        </center><!--End InvoiceTop-->
        <p> 
          
              
<?php
//connect db
    include("db.php");
		$o_id = $_GET['o_id']; //สร้างตัวแปร p_id เพื่อรับค่า

	$sql = "select * from order_head  where o_id=$o_id"; 
  
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	//แสดงรายละเอียด

?>
<div id="tables">
  <table width="10" border="1" cellspacing="0" cellpadding="5">
    <tr>
      
      <td ><b>เลขที่เอกสาร / NO :</b> <?php echo $row["o_id"]; ?> </td>
      <td ></td>
      <td ><b>วันที่ / DATE :</b> <?php echo $row["o_dttm"]; ?></td>
      <td ></td>
    </tr>
    <tr>
      
      <td width="200"><b>ลูกค้า / CUSTOMER :</b> <?php echo $row["o_name"]; ?></td>
      <td width="200"></td>
      <td width="200"><b>เบอร์โทร / TEL :</b> <?php echo $row["o_phone"]; ?></td>
      <td width="200"></td>
    </tr>
    <tr>
      <td><b>ที่อยู่ / Address :</b> <?php echo $row["o_addr"]; ?></td>
      <td colspan="3"></td>
    </tr>
  </table>
</div>  

        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

    <div id="table">
  <table align="center" height="100">
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
      <td style='font-size:0.50em' bgcolor="#B0E0E6" >รวม / Total Amount </td>
      <td style='font-size:0.50em' bgcolor="#B0E0E6" ><?php echo number_format($row['o_total'], 2); ?> บาท</td>
    </tr>
  </table>
  <table align="center" height="10">
    <tr>
      <td align="left" >ผู้รับเงิน / Cashier....................................................................</td>
      <td align="left" >ผู้ส่งสินค้า / Delivered By ....................................................................</td>
      <td align="left" >ผู้รับสินค้า / Received By ....................................................................</td>
      
    </tr>
    <?php

echo "<tr>";
echo "<td align='left'>วันที่ .............................../............................../...............................</td>";
echo "<td align='left'>วันที่ .............................../............................../...............................</td>";
echo "<td align='left'>วันที่ .............................../............................../...............................</td>"; // Display the sequence number
echo "</tr>";
?>
  </table>
</div><!-- End Table -->

					<div id="legalcopy">
          <center>
						<p class="legal"><strong>ขอขอบคุณสำหรับใช้บริการสั่งซื้อสินค้าจากฟาร์มเรา</strong>  
            <p class="legal"><strong>เบอร์โทรติดต่อ 094-515-4671</strong>  
						</p>
    </center>
					</div>

				</div><!--End InvoiceBot-->

    

    

    <?php include('footer.php'); ?>

    </body>


 
 

    </html>