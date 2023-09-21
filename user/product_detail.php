<?php
$menu = "sale"
?>


<?php
ob_start();
?>
<style>
a:link, a:visited {
  color: white;
}
</style>

<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<section class="content-header">
    <div class="container-fluid">
    <h1><i class="nav-icon fa fa-shopping-cart text-indigo"></i> การสั่งซื้อ</h1>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content" >
    <div class="card card-Light " >
        <div class="card-header ">
            <h3 class="card-title"
            ></h3>
        </div>
        <br>
        <div class="card-body"  align="center">
            <div class="row">

                <div class="col-md-9">

                <table   width="2000" border="0" align="center" class="square">
<?php
//connect db
    /*include("db.php");
	$p_id = $_GET['p_id']; //สร้างตัวแปร p_id เพื่อรับค่า
	
	$sql = "select * from product where p_id=$p_id";  //รับค่าตัวแปร p_id ที่ส่งมา
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	//แสดงรายละเอียด
	echo "<tr>";
  	echo "<td width='85' valign='center'><b>ชื่อสินค้า</b></td>";
    echo "<td width='279'>" . $row["p_name"] . "</td>";
    echo "<td align='center'><img src=". $row["p_pic"]." style='width: 30%;'></td>";
  	echo "</tr>";
  	echo "<tr>";
    echo "<td valign='top'><b>รายละเอียด</b></td>";
    echo "<td>" . $row["p_detail"] . "</td>";
  	echo "</tr>";
  	echo "<tr>";
    echo "<td valign='top'><b>ราคา</b></td>";
    echo "<td>" .number_format($row["p_price"],2) . "</td>";
  	echo "</tr>"; 
  	echo "<tr>";
    echo "<td colspan='2' align='center'>";
    echo "<a href='cart.php?p_id=$row[p_id]&act=add'> เพิ่มลงตะกร้าสินค้า </a></td>";
    echo "</tr>"; */
?>

</table>     



<div class="container pb-5">
    <div class="row" >
      <div class="col-lg-5 mt-5">
        <div class="card mb-3"><?php
//connect db
    include("db.php");
	$p_id = $_GET['p_id'];
	

	$sql = "select * from product where p_id=$p_id";  //รับค่าตัวแปร p_id ที่ส่งมา
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	//แสดงรายละเอียด
	echo "<tr>";
    echo "<td align='center'><img src=". $row["p_pic"]." style='width: 100%;'></td>";
    

?>



</div>
      </div>
      
      

      <div class="col-lg-7 mt-5">
        <div class="card">
          <div class="card-body">
            <h1 class="h2"><?php
//connect db
    include("db.php");
	$p_id = $_GET['p_id']; //สร้างตัวแปร p_id เพื่อรับค่า
	
	$sql = "select * from product where p_id=$p_id";  //รับค่าตัวแปร p_id ที่ส่งมา
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	//แสดงรายละเอียด
	echo "<tr>";
    echo "<td width='279'>" . $row["p_name"] . "</td>";
    echo "</tr>";
?></h1>

            
            <p class="h3 py-2"><?php
//connect db
    include("db.php");
	$p_id = $_GET['p_id']; //สร้างตัวแปร p_id เพื่อรับค่า
	
	$sql = "select * from product where p_id=$p_id";  //รับค่าตัวแปร p_id ที่ส่งมา
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	//แสดงรายละเอียด
	echo "<tr>";
    echo "<td>ราคา  " .number_format($row["p_price"],2) . " บาท</td>";
    echo "</tr>";
?></p>
            <p class="py-2"><i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-secondary"></i> <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span></p>
            <ul class="list-inline">
              <li class="list-inline-item">
                <h6>Brand:</h6>
              </li>
              <li class="list-inline-item">
                <p class="text-muted"><strong>Easy Wear</strong></p>
              </li>
            </ul>
            <h6>รายละเอียดสินค้า:</h6>
            <p><?php
//connect db
    include("db.php");
	$p_id = $_GET['p_id']; //สร้างตัวแปร p_id เพื่อรับค่า
	
	$sql = "select * from product where p_id=$p_id";  //รับค่าตัวแปร p_id ที่ส่งมา
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	//แสดงรายละเอียด
	echo "<tr>";
    echo "<td>" . $row["p_detail"] . "</td>";
    echo "</tr>";
?></p>
            <ul class="list-inline">
              <li class="list-inline-item">
                <h6>Avaliable Color :</h6>
              </li>
              <li class="list-inline-item">
                <p class="text-muted"><strong>White / Black</strong></p>
                
              </li>
            </ul>
            <form action="#" method="post">
              <input type="hidden" name="product-title" value="Activewear">
              <div class="row">
                <div class="col-auto">
                </div>
              </div>
              <div class="row pb-3">
                <div class="col d-grid">
                  <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                </div>
                <div class="col d-grid">
                  <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">
                    <?php
//connect db
    include("db.php");
	$p_id = $_GET['p_id']; //สร้างตัวแปร p_id เพื่อรับค่า

	$sql = "select * from product where p_id=$p_id";  //รับค่าตัวแปร p_id ที่ส่งมา
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);
	//แสดงรายละเอียด
	echo "<tr>";
  echo "<a href='cart.php?p_id=" . $row['p_id'] . "&act=add' >เพิ่มลงตระกร้าสินค้า</a>";
    echo "</tr>";
    
?></button>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



                
                </div>


            </div>

        </div>
    </div>
    <div class="card-footer">
    </div>


    <!-- เพิ่มโรงเรือน -->
    

    

    <?php include('footer.php'); ?>

    </body>

    <!--sweetalert2 ลบข้อมูล -->
 
 

    </html>