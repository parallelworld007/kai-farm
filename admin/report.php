<?php
ob_start();
$menu = "report"
?>


<link rel="stylesheet" href="style.css">

<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<div class="card card-Light ">
    <section class="content-header mt-3">

        <div class="small-box" style="background-color: #FF8674; color:  FFFFFF ">
            <div class="inner">
                <h3>รายงานทั้งหมดของเว็ป</h3>
                <p>ข้อมูลของเว็ป</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-file-export text-light"></i>
            </div>
            <a href="test.php" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i></a>
        </div>

    </section>
</div>
<!-- Main content -->
<section class="content">
    <div class="card card-Light ">
        <div class="card-header ">
            <h3 class="card-title">รายงานของเว็ป</h3>
            <div align="right">
                
                     
            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">

 <!-- Small boxes (Stat box) -->
 <div class="row">


<?php
include "db.php";
$sql = "SELECT * FROM `tbl_member`";
$result = mysqli_query($conn, $sql);
?>
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box" style="background-color: #F95433; color:  FFFFFF ">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($result); ?></h3>

        <p>ข้อมูล ผู้ใช้งาน</p>
      </div>
      <div class="icon">
        <i class="fa fa-id-card text-light"></i>
      </div>
      <a href="printmem.php" target="_blank" class="small-box-footer">Print <i class="fa-solid fa-print fa-xl" ></i></a>
    </div>
  </div>


  <?php
    include "db.php";
    $sql = "SELECT * FROM `tbl_customer`";
    $result = mysqli_query($conn, $sql);
  ?>
  <div class="col-lg-3 ">
    <!-- small box -->
    <div class="small-box " style="background-color: #FA61A0; color:  FFFFFF ">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($result); ?></h3>

        <p>ข้อมูล ลูกค้า</p>
      </div>
      <div class="icon">
        <i class="fa fa-address-book text-light "></i>
      </div>
      <a href="printcus.php" target="_blank" class="small-box-footer">Print <i class="fa-solid fa-print fa-xl"></i></a>
    </div>
  </div>




    <?php
    include "db.php";
    $sql = "SELECT * FROM `house`";
    $result = mysqli_query($conn, $sql);
    ?>
  <div class="col-lg-3">
    <!-- small box -->
    <div class="test11">
      <div class="small-box" style="background-color: #87D819; color:  FFFFFF ">
        <div class="inner">
          <h3><?php echo mysqli_num_rows($result); ?></h3>
          <p>ข้อมูล โรงเรือน</p>
        </div>
        <div class="icon">
          <i class="fa fa-book text-light"></i>
        </div>
        <a href="printhouse.php" target="_blank" class="small-box-footer">Print <i class="fa-solid fa-print fa-xl"></i></a>
      </div>
    </div>
  </div>
  <!-- ./col -->
   


<?php
include "db.php";
$sql = "SELECT * FROM `zone`";
$result = mysqli_query($conn, $sql);
?>
  <div class="col-lg-3 ">
    <!-- small box -->
    <div class="small-box " style="background-color: #0BE398; color:  FFFFFF ">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($result); ?></h3>

        <p>ข้อมูล โซน</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars text-light"></i>
      </div>
      <a href="printzone.php" target="_blank" class="small-box-footer">Print <i class="fa-solid fa-print fa-xl"></i></a>
    </div>
  </div>

  <?php
include "db.php";
$sql = "SELECT * FROM `add_chicken`";
$result = mysqli_query($conn, $sql);
?>
  <!-- ./col -->
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box " style="background-color: #E1D823; color:  FFFFFF ">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($result); ?></h3>

        <p >ข้อมูล การเพิ่มไก่</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph text-light"></i>
      </div>
      <a href="printaddkai.php" target="_blank" class="small-box-footer">Print <i class="fa-solid fa-print fa-xl"></i></a>
    </div>
  </div>
  
  
  
  <?php
include "db.php";
$sql = "SELECT * FROM `d_chicken`";
$result = mysqli_query($conn, $sql);
?>
  <!-- ./col -->
  <div class="col-lg-3 ">
    <!-- small box -->
    <div class="small-box " style="background-color: #848484; color:  FFFFFF "> 
      <div class="inner">
        <h3><?php echo mysqli_num_rows($result); ?></h3>

        <p>ข้อมูล การตาย</p>
      </div>
      <div class="icon">
        <i class="fa fa-pie-chart text-light"></i>
      </div>
      <a href="printkaid.php" target="_blank" class="small-box-footer">Print <i class="fa-solid fa-print fa-xl"></i></a>
    </div>
  </div>

  <?php
include "db.php";
$sql = "SELECT * FROM `s_chicken`";
$result = mysqli_query($conn, $sql);
?>
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box" style="background-color: #AF9FF9 ; color:  FFFFFF ">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($result); ?></h3>

        <p>ข้อมูลการขาย</p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-basket text-light"></i>
      </div>
      <a href="printsell.php" target="_blank" class="small-box-footer">Print <i class="fa-solid fa-print fa-xl"></i></a>
    </div>
  </div>

  <?php
include "db.php";
$sql = "SELECT * 
FROM order_head 
ORDER BY o_id ASC;";
$result = mysqli_query($conn, $sql);
?>
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box" style="background-color: #9FBEF9; color:  FFFFFF ">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($result); ?></h3>

        <p>รายการสั่งซื้อทั้งหมด</p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-cart text-light"></i>
      </div>
      <a href="printcksell.php" target="_blank" class="small-box-footer">Print <i class="fa-solid fa-print fa-xl"></i></a>
    </div>
  </div>


  <?php
include "db.php";
$sql = "SELECT o_id,o_name,o_email,o_dttm,o_wait,o_total
FROM order_head
WHERE o_wait = 'ชำระเงินแล้ว'";
$result = mysqli_query($conn, $sql);
?>
  <div class="col-lg-3">
    <!-- small box -->
    <div class="small-box" style="background-color: #43C6DB; color:  FFFFFF ">
      <div class="inner">
        <h3><?php echo mysqli_num_rows($result); ?></h3>

        <p>รายการบันทึกการขาย</p>
      </div>
      <div class="icon">
        <i class="fa-solid fa-file-invoice text-light"></i>
      </div>
      <a href="printconf.php" target="_blank" class="small-box-footer">Print <i class="fa-solid fa-print fa-xl"></i></a>
    </div>
  </div>


</div>




<?php include('footer.php'); ?>

</body>

</html>