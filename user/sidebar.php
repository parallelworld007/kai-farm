<!-- Main Sidebar Container -->
<link rel="stylesheet" href="style.css">
<aside class="main-sidebar   sidebar-dark-olive  elevation-4 ">


  <a class="brand-link bg-olive ">
    <img src="../assets/img/kai.png" alt="AdminLTE Logo" class="brand-image">
    <span class="brand-text text-light" style="font-size: 18px;">FARM | Kai</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel " style="padding: 1.5rem; ">
      <div class="info">
    
        <h6 class="text-teal " style="font-size: 20px; " >ระดับผู้ใช้งาน : MEMBER</h6>
      </div>
    </div>
    
   

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <!-- nav-compact -->


      <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
     
        <li class="nav-item">
          <a href="test.php" class="nav-link <?php if ($menu == "test") {
                                                echo "active";
                                              } ?> ">
            <i class="nav-icon fa fa-home"></i>
            <p>Home</p>
          </a>
        </li>



      </ul>
    


      <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-header">เมนู</li>

        <li class="nav-item">
          <a href="sale.php" class="nav-link <?php if ($menu == "sale") {
                                                echo "active";
                                              } ?> ">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            <p>สั่งซื้อสินค้า</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="product.php" class="nav-link <?php if ($menu == "product") {
                                                echo "active";
                                              } ?> ">
            <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            <p>สินค้า</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="house.php" class="nav-link <?php if ($menu == "house") {
                                                echo "active";
                                              } ?> ">
            <i class="fa-solid fa-file"></i>
            <p>โรงเรือน</p>
          </a>
        </li>



        <li class="nav-item">
          <a href="zone.php" class="nav-link <?php if ($menu == "zone") {
                                                echo "active";
                                              } ?> ">
            <i class="fa-solid fa-file"></i>
            <p>โซน</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="addkai.php" class="nav-link <?php if ($menu == "addkai") {
                                                  echo "active";
                                                } ?> ">
           <i class="fa-solid fa-file"></i>
            <p>เพิ่มไก่</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="d_chicken.php" class="nav-link <?php if ($menu == "d_chicken") {
                                                echo "active";
                                              } ?> ">
            <i class="fa-solid fa-file"></i>
            <p style="color:light;">ข้อมูลการตาย</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="s_chicken.php" class="nav-link <?php if ($menu == "s_chicken") {
                                                echo "active";
                                              } ?> ">
            <i class="fa-solid fa-file"></i>
            <p style="color:light;">ข้อมูลการขาย</p>
          </a>
        </li>


        <li class="nav-item">
    <a href="sales.php" class="nav-link <?php if ($menu == "sales") {
        echo "active";
    } ?> ">
        <?php
        // ตรวจสอบว่ามีข้อมูลใหม่หรือไม่ แล้วกำหนดไอคอนตามเงื่อนไข
        $hasNewData = true; // ตั้งค่าตามต้องการ

        if ($hasNewData) {
            // ถ้ามีข้อมูลใหม่ ให้แสดงไอคอนที่คุณต้องการ เช่น font-awesome
            echo '<i class="fa-regular fa-bell"></i>';
        } else {
            // ถ้าไม่มีข้อมูลใหม่ ให้แสดงไอคอนปกติ
            echo '<i class="fa-regular fa-square-check"></i>';
        }
        ?>
        <p>ตรวจสอบรายการสั่งซื้อ</p>
    </a>
</li>


        
        <li class="nav-item">
          <a href="salesconf.php" class="nav-link <?php if ($menu == "salesconf") {
                                                echo "active";
                                              } ?> ">
            <i class="fa-solid fa-square-check fa-sm"></i>
            <p>บันทึกการขาย</p>
          </a>
        </li>
        
      
        
        
      </ul>
      <hr>




     


      <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="../logout.php" class="nav-link text-danger">
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