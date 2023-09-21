<?php
ob_start();
$menu = "test"
?>


<link rel="stylesheet" href="style.css">

<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<!-- Main content -->
<section class="content-header">
  <div class="card card-Light mt-2">
    <div class="container-fluid mt-3">

     
        <!-- Small boxes (Stat box) -->
        <div class="row">


      
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
                <a href="house.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="zone.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="addkai.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="d_chicken.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php
      include "db.php";
      $sql = "SELECT * FROM `order_head`";
      $result = mysqli_query($conn, $sql);
      ?>
          <div class="col-lg-3">
            <!-- small box -->
            <div class="small-box" style="background-color: #AF9FF9 ; color:  FFFFFF ">
              <div class="inner">
                <h3><?php echo mysqli_num_rows($result); ?></h3>

                <p>รายการสั่งซื้อ</p>
              </div>
              <div class="icon">
                <i class="fa fa-shopping-basket text-light"></i>
              </div>
              <a href="sales.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php
      include "db.php";
      $sql = "SELECT * FROM `product`";
      $result = mysqli_query($conn, $sql);
      ?>
          <div class="col-lg-3">
            <!-- small box -->
            <div class="small-box" style="background-color: #9FBEF9; color:  FFFFFF ">
              <div class="inner">
                <h3><?php echo mysqli_num_rows($result); ?></h3>

                <p>สินค้า</p>
              </div>
              <div class="icon">
                <i href="product.php" class="fa fa-shopping-cart text-light"></i>
              </div>
              <a href="product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
        </div>
      
      <!-- /.row -->
      <!-- Main row -->
      </dvi>
</section>
<!-- /.content -->
</div>




<?php include('footer.php'); ?>

</body>

</html>