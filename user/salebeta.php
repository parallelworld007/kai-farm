<?php
$menu = "sale"
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
<!-- Main content -->
<section class="content">
    <div class="card card-Light ">
        <div class="card-header ">
            <h3 class="card-title"
            ></h3>
            <div align="right">

                

            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-9">

<table table style="width:130%">
  
  
  <?php
  //connect db
  include("db.php");
  $sql = "select * from product order by p_id";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
  	echo "<td>";
    echo "<a>";
     echo "<div align='center'><img src=". $row["p_pic"]." style='width: 100%;'></div>";
	// echo "<td align='center'><img src='https://s359.thaibuffer.com/pagebuilder/ba154685-db18-4ac7-b318-a4a2b15b9d4c.jpg' style='width: 30%;'></td>";
	 echo "<div align='center'>" . $row["p_name"] . "</div>";
    echo "<div align='center'>" .number_format($row["p_price"],2). "<b> บาท</b></div>";
    echo "<div align='center'><a href='product_detail.php?p_id=$row[p_id]'>คลิก</a></div>";
    echo "</a>";
	echo "</td>";
  
  }
  ?>
  
</table>

<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="sale.css">
</head>
<table>
  <td>
<div class="container page-wrapper">
  <div class="page-inner">
    <div class="row">
      <div class="el-wrapper">
        <div class="box-up">

        <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=1";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
     echo "<div align='center'><img src=". $row["p_pic"]." style='width: 100%;'></div>";
  }
  ?>
          <div class="img-info">
            <div class="info-inner">
              <span class="p-name"><?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=1";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div align='center'>" . $row["p_name"] . "</div>";
  }
  ?></span>
            </div>
          </div>
        </div>

        <div class="box-down">
          <div class="h-bg">
            <div class="h-bg-inner"></div>
          </div>

          <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=1";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {

    echo "<a class='cart' href='product_detail.php?p_id=$row[p_id]'>";

  
  }
  ?>
            <span class="price">
              <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=1";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div align='center'>" .number_format($row["p_price"],2). "<b> บาท</b></div>";
  }
  ?>
  </span>
            <span class="add-to-cart">
              <span class="txt">เพิ่มลงตระกร้าสินค้า</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</td>
<td>
<div class="container page-wrapper">
  <div class="page-inner">
    <div class="row">
      <div class="el-wrapper">
        <div class="box-up">

        <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=2";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
     echo "<div align='center'><img src=". $row["p_pic"]." style='width: 100%;'></div>";
  }
  ?>
          <div class="img-info">
            <div class="info-inner">
              <span class="p-name"><?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=2";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div align='center'>" . $row["p_name"] . "</div>";
  }
  ?></span>
            </div>
          </div>
        </div>

        <div class="box-down">
          <div class="h-bg">
            <div class="h-bg-inner"></div>
          </div>

          <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=2";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {

    echo "<a class='cart' href='product_detail.php?p_id=$row[p_id]'>";

  
  }
  ?>
            <span class="price">
              <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=2";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div align='center'>" .number_format($row["p_price"],2). "<b> บาท</b></div>";
  }
  ?>
  </span>
            <span class="add-to-cart">
              <span class="txt">เพิ่มลงตระกร้าสินค้า</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</td>
<td>
<div class="container page-wrapper">
  <div class="page-inner">
    <div class="row">
      <div class="el-wrapper">
        <div class="box-up">

        <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=3";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
     echo "<div align='center'><img src=". $row["p_pic"]." style='width: 100%;'></div>";
  }
  ?>
          <div class="img-info">
            <div class="info-inner">
              <span class="p-name"><?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=3";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div align='center'>" . $row["p_name"] . "</div>";
  }
  ?></span>
            </div>
          </div>
        </div>

        <div class="box-down">
          <div class="h-bg">
            <div class="h-bg-inner"></div>
          </div>

          <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=3";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {

    echo "<a class='cart' href='product_detail.php?p_id=$row[p_id]'>";

  
  }
  ?>
            <span class="price">
              <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=3";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div align='center'>" .number_format($row["p_price"],2). "<b> บาท</b></div>";
  }
  ?>
  </span>
            <span class="add-to-cart">
              <span class="txt">เพิ่มลงตระกร้าสินค้า</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</td>


</table>
<table >
  <td>
<div class="container page-wrapper">
  <div class="page-inner">
    <div class="row">
      <div class="el-wrapper">
        <div class="box-up">

        <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=5";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
     echo "<div align='center'><img src=". $row["p_pic"]." style='width: 100%;'></div>";
  }
  ?>
          <div class="img-info">
            <div class="info-inner">
              <span class="p-name"><?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=5";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div align='center'>" . $row["p_name"] . "</div>";
  }
  ?></span>
            </div>
          </div>
        </div>

        <div class="box-down">
          <div class="h-bg">
            <div class="h-bg-inner"></div>
          </div>

          <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=5";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {

    echo "<a class='cart' href='product_detail.php?p_id=$row[p_id]'>";

  
  }
  ?>
            <span class="price">
              <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=5";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div align='center'>" .number_format($row["p_price"],2). "<b> บาท</b></div>";
  }
  ?>
  </span>
            <span class="add-to-cart">
              <span class="txt">เพิ่มลงตระกร้าสินค้า</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</td>
<td>
<div class="container page-wrapper">
  <div class="page-inner">
    <div class="row">
      <div class="el-wrapper">
        <div class="box-up">

        <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=6";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
     echo "<div align='center'><img src=". $row["p_pic"]." style='width: 100%;'></div>";
  }
  ?>
          <div class="img-info">
            <div class="info-inner">
              <span class="p-name"><?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=6";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div align='center'>" . $row["p_name"] . "</div>";
  }
  ?></span>
            </div>
          </div>
        </div>

        <div class="box-down">
          <div class="h-bg">
            <div class="h-bg-inner"></div>
          </div>

          <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=6";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {

    echo "<a class='cart' href='product_detail.php?p_id=$row[p_id]'>";

  
  }
  ?>
            <span class="price">
              <?php
  //connect db
  include("db.php");
  $sql = "select * from product where p_id=6";  //เรียกข้อมูลมาแสดงทั้งหมด
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div align='center'>" .number_format($row["p_price"],2). "<b> บาท</b></div>";
  }
  ?>
  </span>
            <span class="add-to-cart">
              <span class="txt">เพิ่มลงตระกร้าสินค้า</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</td>

</table>



                
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