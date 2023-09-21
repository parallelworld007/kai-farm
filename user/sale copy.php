<?php
$menu = "sale"
?>


<?php
ob_start();
?>

<?php
//connect db
include("db.php");
$sql = "select * from product where 1";
// $sql = "select * from product where 1";  //เรียกข้อมูลมาแสดงทั้งหมด
$result = mysqli_query($conn, $sql);
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>
<div class="card card-gray">
<div class="row">
  <?php
  while ($row = mysqli_fetch_array($result)) {
  ?>
    <div class="col-md-3">
      <div class="el-wrapper" style="border-radius: 25px;">
        <div class="box-up">
          <div class="center">
            <img src='<?php echo $row["p_pic"] ?>' style='width: 100%;'>
          </div>
          <div class="img-info">
            <div class="info-inner">
              <span class="p-name">
                <div align="center">
                  <?php echo $row['p_name'] . "<br>"; ?>
                </div>
              </span>
            </div>
          </div>
        </div>
        <div class="box-down">
          <div class="h-bg">
            <div class="h-bg-inner"></div>
          </div>
          <a class='cart' href='product_detail.php?p_id= <?php echo $row["p_id"] ?>'>
            <span class="price">
              <div align='center'> <?php echo number_format($row["p_price"], 2) ?> <b> บาท</b></div>
            </span>
            <span class="add-to-cart">
              <span class="txt">เพิ่มลงตระกร้าสินค้า</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</div>
</div>


<!-- เพิ่มโรงเรือน -->




<?php include('footer.php'); ?>


<!--sweetalert2 ลบข้อมูล -->