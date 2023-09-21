<!-- Main Sidebar Container -->
<link rel="stylesheet" href="style.css">
<aside class="main-sidebar  sidebar-light-fuchsia  elevation-4 ">


  <a class="brand-link bg-fuchsia ">
    <img src="../assets/img/kai.png" alt="AdminLTE Logo" class="brand-image">
    <span class="brand-text text-light" style="font-size: 18px;">FARM | Kai</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel " style="padding: 1.5rem; ">
      <div class="info">
    
      <h6 class="text-fuchsia " style="font-size: 20px; " >  ยินดีตอนรับ <?php echo $_SESSION['cus_username']; ?> </h6>      </div>
    </div>
    
   

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <!-- nav-compact -->
      <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-header">เมนูสำหรับลูกค้า</li>

        <li class="nav-item">
          <a href="index.php" class="nav-link <?php if ($menu == "index") {
                                                echo "active";
                                              } ?> ">
            <i class="nav-icon fa fa-home "></i>
            <p>index</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="sale.php" class="nav-link <?php if ($menu == "sale") {
                                                echo "active";
                                              } ?> ">
            <i class="nav-icon fa fa-shopping-cart "></i>
            <p>สั่งซื้อไก่</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="print.php" class="nav-link <?php if ($menu == "print") {
                                                echo "active";
                                              } ?> ">
            <i class="nav-icon fa fa-book"></i>
            <p>พิมพ์ใบสั่งซื้อก่อนมารับสินค้า</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="reportcus.php" class="nav-link <?php if ($menu == "reportcus") {
                                                echo "active";
                                              } ?> ">
            <i class="nav-icon fa fa-book"></i>
            <p>การสั่งซื้อของฉัน</p>
          </a>
        </li>
      


       



        
        
      </ul>
      <hr>

      <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
        <?php
include "db.php";
$sql = "SELECT *  FROM tbl_customer LIMIT 1";
$result = mysqli_query($conn, $sql);
// echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
?>
          <a href="edit_cus.php?id=<?=  $_SESSION['cus_id'];  ?>" class="nav-link <?php if ($menu == "edit_cus") {
                                                echo "active";
                                              } ?> ">
            <i class="nav-icon fa fa-address-card"></i>
            <p>แก้ไขข้อมูลตัวเอง</p>
          </a>
          <?php

}
?>
        </li>
        </li>    
        <li class="nav-item">
          <a href="../logout2.php" class="nav-link text-danger">
            <i class="nav-icon fas fa-power-off"></i>
            <p>ออกจากระบบ</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->

  </div>
  <!-- /.sidebar -->
</aside>