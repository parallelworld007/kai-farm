<?php
$menu = "index"
?>


<?php
ob_start();
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<head>
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" type="text/css" href="test.css">
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    .cards-wrapper {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      gap: 20px;
      padding: 20px;
      background-color: #f2f2f2;
    }

    .card {
      text-decoration: none;
      width: 300px;
      border: 1px solid #ccc;
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card div {
      padding: 20px;
    }

    .card h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .card .tags {
      margin-top: 15px;
    }

    .card .tag {
      background-color: #007bff;
      color: #fff;
      padding: 5px 10px;
      border-radius: 5px;
      display: inline-block;
    }
  </style>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Free responsive business website template</title>
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/icons.css">
  <link rel="stylesheet" href="css/responsee1.css">
  <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="owl-carousel/owl.theme.css">
  <!-- CUSTOM STYLE -->
  <link rel="stylesheet" href="css/template-style1.css">
  <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
</head>

<!--
    You can change the color scheme of the page. Just change the class of the <body> tag. 
    You can use this class: "primary-color-white", "primary-color-red", "primary-color-orange", "primary-color-blue", "primary-color-aqua", "primary-color-dark" 
    -->

<!--
    Each element is able to have its own background or text color. Just change the class of the element.  
    You can use this class: 
    "background-white", "background-red", "background-orange", "background-blue", "background-aqua", "background-primary" 
    "text-white", "text-red", "text-orange", "text-blue", "text-aqua", "text-primary"
    -->

<body class="size-1520 primary-color-red background-dark">
  <!-- HEADER -->

  <!-- MAIN -->
  <main role="main">
    <!-- TOP SECTION -->
    <section class="grid">
      <!-- Main Carousel -->
      <div class="s-12 margin-bottom carousel-fade-transition owl-carousel carousel-main carousel-nav-white carousel-hide-arrows background-dark">
        <div class="item background-image" style="background-image:url(img/farm1.png)">
          <p class="text-padding text-strong text-white text-s-size-30 text-size-60 text-uppercase background-primary">ฟาร์มก่บ้านไร่ทาม</p>
          <p class="text-padding text-size-20 text-dark text-uppercase background-white">ㅤㅤㅤㅤไก่ไข่ 2,000 ตัว จะออกไข่ 85% หรือตกวันละ 1,700 ฟองต่อวัน หากมีแหล่งจำหน่ายที่แน่นอนจะสร้างรายได้ในครัวเรือนได้อย่างสม่ำเสมอ แต่กว่าจะไปถึงตรงนั้นต้องลงทุนเท่าไหร่ ไปแจกแจงค่าใช้จ่าย ต้นทุน สิ่งที่ต้องมีในขั้นเริ่มต้นㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ</p>
        </div>
        <div class="item background-image" style="background-image:url(img/farm2.png)">
          <p class="text-padding text-strong text-white text-s-size-30 text-size-60 text-uppercase background-primary">ㅤㅤงบก่อสร้างโรงเรือนไก่ไข่</p>
          <p class="text-padding text-size-20 text-dark text-uppercase background-white">โรงเรือนไก่ไข่ สำหรับไก่ไข่อายุ 20 สัปดาห์ขึ้นไป แนะนำให้เลี้ยงแบบลักษณะโรงเรือนเปิด กรงตับ 2 ชั้น พื้นที่เลี้ยง 4.5-5 ตารางเมตร/ตัว ดังนั้นไก่ไข่ 2,000 ตัว จะต้องใช้โรงเรือนขนาด 6.5 x 40 = 260 ตร.ม. (ความสูง 2.5 ม. ขึ้นไป เพื่อความโปร่ง อากาศถ่ายเทได้สะดวก) หลังคาสามารถกันแดดและฝนได้ อาจทำจากกระเบื้อง สังกะสี ทั้งนี้ขึ้นอยู่กับงบประมาณ และอุปกรณ์ที่หาได้สะดวกในท้องถิ่นนั้นๆ
ราคาประมาณ 100,000 ถึง 150,000 บาท</p>
        </div>
      </div>
    </section>

    <!-- SECTION 1 -->

    <body>
<section class="cards-wrapper">
    <div class="card-grid-space">

    <?php
include "db.php";
$sql = "SELECT *  FROM tbl_customer LIMIT 1";
$result = mysqli_query($conn, $sql);
// echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($result)) {
?>
          <a style="--bg-img: url(http://localhost/farmkai/images/id-card-name-icon-cartoon-style-vector-36057413.jpg)"
           href="edit_cus.php?id=<?=  $_SESSION['cus_id'];  ?>" class="card <?php if ($menu == "edit_cus") {
                                                echo "active";
                                              } ?> ">
            <div>
          <h1>แก้ไขข้อมูล</h1>
          <p>แก้ไขข้อมูล ของตัวเอง</p>

        </div>
          </a>
          <?php

}
?>

    </div>
    <div class="card-grid-space">
      <a class="card" href="sale.php" style="--bg-img: url(http://localhost/farmkai/images/Brown-eggs.webp)">
        <div>
          <h1>สั่งซื้อสินค้า</h1>
          <p>สั่งซื้อสินค้าจากฟาร์ม ประเภท ไข่ ปุ๋ยมูลสัตว์ และสินค้าอื่นๆของฟาร์มอีกมากมาย</p>

        </div>
      </a>
    </div>
    <div class="card-grid-space">
      <a class="card" href="house.php" style="--bg-img: url('http://localhost/farmkai/images/cl3oal8w6000c79570tgf4k1k.jpg')">
        <div>
          <h1>รายการสั่งซื้อ</h1>
          <p>ตรวจสอบ รายการสั่งซื้อของฉัน หรือ พิมพ์ใบสั่งซื้อ</p>
        </div>
      </a>
    </div>
    <div class="card-grid-space">
      <?php
      include "db.php";
      $sql = "SELECT * FROM tbl_customer LIMIT 1";
      $result = mysqli_query($conn, $sql);
      // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <a class="card" href="test.php?id=<?=  $_SESSION['cus_id']; ?>" style="--bg-img: url('http://localhost/farmkai/images/565000002715604.webp')">
          <div>
            <h1>ความรู้</h1>
            <p>เรียนศึกษา วิธีการทำฟาร์มไก่ยังไงให้ประสบความสำเร็จ</p>
          </div>
        </a>
      <?php
      }
      ?>
    </div>
  </section>
  </body>


    <!-- SECTION 5 -->
    <section class="grid margin text-center">
      <div class="m-12 l-4 padding-2x background-dark margin-bottom text-right">
        <p>ㅤㅤㅤㅤ</p>
      </div>
      <a href="/" class="s-12 m-6 l-2 padding vertical-center margin-bottom facebook hover-zoom">
        <i class="icon-sli-social-facebook text-size-60 text-white center"></i>
      </a>
      <a href="/" class="s-12 m-6 l-2 padding vertical-center margin-bottom twitter hover-zoom">
        <i class="icon-sli-social-twitter text-size-60 text-white center"></i>
      </a>
      <a href="/" class="s-12 m-6 l-2 padding vertical-center margin-bottom youtube hover-zoom">
        <i class="icon-sli-social-youtube text-size-60 text-white center"></i>
      </a>
      <a href="/" class="s-12 m-6 l-2 padding vertical-center margin-bottom linkedin hover-zoom">
        <i class="icon-sli-social-linkedin text-size-60 text-white center"></i>
      </a>
    </section>

  </main>


  <!-- FOOTER -->
  <footer class="grid">
    <!-- Footer - top -->
    <!-- Image-->
    <div class="s-12 l-3 m-row-3 margin-bottom background-image" style="background-image:url(img/img-04.jpg)"></div>

    <div class="s-12 m-9 l-3 padding-2x margin-bottom background-dark">
      <h2 class="text-strong text-uppercase">Contact Us</h2>
      <p><b class="text-primary margin-right-10">P</b> 0203162431</p>
      <p><b class="text-primary margin-right-10">M</b> <a class="text-primary-hover" href="mailto:contact@sampledomain.com">wutthiphong@sampledomain.com</a></p>
      <p><b class="text-primary margin-right-10">M</b> <a class="text-primary-hover" href="mailto:office@sampledomain.com">wutthiphong@sampledomain.com</a></p>
    </div>
  </footer>
  <script type="text/javascript" src="js/responsee.js"></script>
  <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
  <script type="text/javascript" src="js/template-scripts.js"></script>

</body>

</html>