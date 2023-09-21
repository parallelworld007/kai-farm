<?php include("header.php"); ?>
<?php
$menu = "addkai"
?>
<head>
	<link rel="stylesheet" type="text/css" href="cart1.css">
</head>


<?php
	
	//$p_id = $_GET['p_id']; 
  isset( $_GET['p_id'] ) ? $p_id = $_GET['p_id'] : $p_id = "";
  isset( $_GET['act'] ) ? $act = $_GET['act'] : $act = "";
 

	if($act=='add' && !empty($p_id))
	{
		if(isset($_SESSION['cart'][$p_id]))
		{
			$_SESSION['cart'][$p_id]++;
		}
		else
		{
			$_SESSION['cart'][$p_id]=1;
		}
	}

	if($act=='remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['cart'][$p_id]);
	}

	if($act=='update')
	{
		$amount_array = $_POST['amount'];
		foreach($amount_array as $p_id=>$amount)
		{
			$_SESSION['cart'][$p_id]=$amount;
		}
	}
?>
<section class="content-header">
  <div class="container-fluid">
    <h1>Index</h1>
    
    </div><!-- /.container-fluid -->
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
          

<body>
  
<form id="frmcart" name="frmcart" method="post" action="?act=update">
  
<div class="card">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col"><h4><b>ตระกร้ารายการสั่งซื้อ</b></h4></div>
                            <div class="col align-self-center text-right text-muted">3 items</div>
                        </div>
                    </div>    
                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            <div class="col">
                                <div class="row">
                                <table width="600" border="0" align="center" class="square">
                                <tr>
      <td bgcolor="#EAEAEA">สินค้า</td>
      <td align="center" bgcolor="#EAEAEA">ราคา</td>
      <td align="center" bgcolor="#EAEAEA">รูปภาพสินค้า</td>
      <td align="center" bgcolor="#EAEAEA">จำนวน</td>
      <td align="center" bgcolor="#EAEAEA">รวม(บาท)</td>
      <td align="center" bgcolor="#EAEAEA"></td>
    </tr>
                                  <?php
// Include database connection
include("db.php");

$total = 0;

// Check if the shopping cart is not empty
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $p_id => $qty) {

        $sql = "SELECT 
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
            $sql1 = "SELECT o_dttm, 
            CASE WHEN CURRENT_DATE > o_dttm 
            AND o_wait <> 'ชำระเงินแล้ว' 
            THEN 'เลยกำหนด' 
            ELSE o_wait END AS o_end,
            SUM(o_qty) AS total_o_qty 
         FROM order_head
         GROUP BY o_dttm, o_wait
         HAVING o_end = 'ยังไม่มารับสินค้า';";
         
         // Execute the query
         $result1 = mysqli_query($conn, $sql1);
         
         $total_o_qty_sum = 0; // Initialize a variable to store the total quantity, starting at 0
         
         // Loop through the result set obtained from the SQL query
         while ($row1 = mysqli_fetch_assoc($result1)) {
             // Add the 'total_o_qty' value from each row to the total
             $total_o_qty_sum += $row1['total_o_qty'];
         }

        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $sum = $row['p_price'] * $qty;
        $total += $sum;
        $adc_total = $row['total_adc_total']; // Assuming you already have this value
        // Assuming you have already calculated $total_o_qty_sum as shown in your code
        // Replace with the actual value
        
        // Calculate the difference between $adc_total and $total_o_qty_sum
        $difference = $adc_total - $total_o_qty_sum;
        
        // Now, $difference contains the result of the subtraction
        

        

        echo "<tr>";

        echo "<td width='334'>" . $row["p_name"] . "</td>";
        echo "<td align='center'> " . number_format($row["p_price"], 2) . "</td>";
        echo '<td align="center"><img src="' . $row['p_pic'] . '"  height="50" border="0" /></td>';
        echo "<td width='57' align='right'>";
        echo " <input type='number' name='amount[$p_id]' value='$qty' size='2' min='1' max='$difference' />";
        echo "<td width='93' align='center'>" . number_format($sum, 2) . "</td>";

        echo "<td width='46' align='center'><a href='cart.php?p_id=$p_id&act=remove'>ลบ</a></td>";
        echo "</tr>";

    }
}

// SQL query to retrieve order information
$sql1 = "SELECT o_dttm, 
   CASE WHEN CURRENT_DATE > o_dttm 
   AND o_wait <> 'ชำระเงินแล้ว' 
   THEN 'เลยกำหนด' 
   ELSE o_wait END AS o_end,
   SUM(o_qty) AS total_o_qty 
FROM order_head
GROUP BY o_dttm, o_wait
HAVING o_end = 'ยังไม่มารับสินค้า';";

// Execute the query
$result1 = mysqli_query($conn, $sql1);

$total_o_qty_sum = 0; // Initialize a variable to store the total quantity, starting at 0

// Loop through the result set obtained from the SQL query
while ($row1 = mysqli_fetch_assoc($result1)) {
    // Add the 'total_o_qty' value from each row to the total
    $total_o_qty_sum += $row1['total_o_qty'];
}

?>

<!-- Display the total quantity of reserved orders if greater than 0 -->
<?php if ($total_o_qty_sum > 0): ?>
    <h6>จำนวนที่จองแล้ว(<?php echo $total_o_qty_sum; ?> ตัว)</h6>
<?php endif; ?>


</table>
</div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="back-to-shop"><a href="sale.php">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
                </div>
                <div class="col-md-4 summary">
                    <div><h5><b>Summary</b></h5></div>
                    <hr>

                  

                    <div class="row">
                        <div class="col" style="padding-left:0;">รวมราคา</div>
                        <div class="col text-right"> <?php
$total=0;
if(!empty($_SESSION['cart']))
{
	include("db.php");
	foreach($_SESSION['cart'] as $p_id=>$qty)
	{
		$sql = "SELECT 
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
		$query = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($query);
		$sum = $row['p_price'] * $qty;
		$total += $sum;
	}
	echo "<tr>";
  	echo "<td align='right' bgcolor='#CEE7FF'>"."<b>".number_format($total,2)."</b>"."</td>";
  	echo "<td align='left' bgcolor='#CEE7FF'></td>";
	echo "</tr>";
}
?> บาท</div>
                    </div>
                    <div class="row">
                        <div class="col" style="padding-left:0;">vat</div>
                        <div class="col text-right"> +0%</div>
                    </div>


                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">ราคาที่ต้องจ่าย</div>
                        <div class="col text-right"> <?php
$total=0;
if(!empty($_SESSION['cart']))
{
	include("db.php");
	foreach($_SESSION['cart'] as $p_id=>$qty)
	{
		$sql = "SELECT 
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
		$query = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($query);
		$sum = $row['p_price'] * $qty;
		$total += $sum;
	}
	echo "<tr>";
  	echo "<td align='right' bgcolor='#CEE7FF'>"."<b>".number_format($total,2)."</b>"."</td>";
  	echo "<td align='left' bgcolor='#CEE7FF'></td>";
	echo "</tr>";
}
?></div>
                    </div>
                    <td colspan="4" align="right">
    <input type="submit" name="button" id="button" value="update" />
    <input type="button" name="Submit2" value="สั่งซื้อ" onclick="window.location='confirm.php';" />
</td>
                    
                </div>
            </div>
            
        </div>
</body>
        </div>
      </div>
      <div class="card-footer">
        
      </div>
      
    </div>
    
    
    
    
    
  </section>
  <!-- /.content -->
  
  
  <?php include('footer.php'); ?>
  <script>
  $(function () {
  $(".datatable").DataTable();
  // $('#example2').DataTable({
  //   "paging": true,
  //   "lengthChange": false,
  //   "searching": false,
  //   "ordering": true,
  //   "info": true,
  //   "autoWidth": false,
  // http://fordev22.com/
  // });
  });
  </script>
  
  
</body>
</html>
<!-- http://fordev22.com/ -->