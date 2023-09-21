<?php
$menu = "sale"
?>


<?php
ob_start();
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<head>


   <title>Klassy Cafe - Restaurant HTML Template</title>
   <!--
    
TemplateMo 558 Klassy Cafe

https://templatemo.com/tm-558-klassy-cafe

-->
   <!-- Additional CSS Files -->


   <link rel="stylesheet" href="bobo.css">



   <link rel="stylesheet" type="text/css" href="indexx.css">
   <link rel="stylesheet" type="text/css" href="funny.css">
   <link rel="stylesheet" type="text/css" href="test1.css">
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
   <link rel="stylesheet" href="css/responsee.css">
   <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
   <link rel="stylesheet" href="owl-carousel/owl.theme.css">
   <!-- CUSTOM STYLE -->
   <link rel="stylesheet" href="css/template-style.css">
   <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
   <script type="text/javascript" src="js/jquery-ui.min.js"></script>

</head>

<body>

   <?php
   //connect db
   include("db.php");
   $sql = "
   SELECT product.*,
SUM(add_chicken.adc_total) AS total_adc_total
FROM product 
JOIN house 
ON house.hou_id = house.hou_id
JOIN zone 
ON house.hou_id = zone.hou_id 
JOIN add_chicken 
ON zone.zon_id = add_chicken.zon_id 
WHERE CURDATE() >= add_chicken.adc_datesell;;";
   // $sql = "select * from product where 1";  //เรียกข้อมูลมาแสดงทั้งหมด
   

   $sql1 = "SELECT o_dttm, 
   CASE WHEN CURRENT_DATE > o_dttm 
   AND o_wait <> 'ชำระเงินแล้ว' 
   THEN 'เลยกำหนด' 
   ELSE o_wait END AS o_end,
   SUM(o_qty) AS total_o_qty 
FROM order_head
GROUP BY o_dttm, o_wait
HAVING o_end = 'ยังไม่มารับสินค้า';
   ";
   // $sql = "select * from product where 1";  //เรียกข้อมูลมาแสดงทั้งหมด
   $result1 = mysqli_query($conn, $sql1);
   $result = mysqli_query($conn, $sql);

   
  
   
   ?>


   <!-- ***** Preloader Start ***** -->

   <!-- ***** Preloader End ***** -->


   <!-- ***** Header Area Start ***** -->

   <!-- ***** Header Area End ***** -->

   <!-- ***** Main Banner Area Start ***** -->
   <?php
   while ($row = mysqli_fetch_assoc($result))
    {
      $total_adc_total =  $row['total_adc_total'];
   ?>

      <div id="top">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-4">
                  <div class="left-content">
                     <div class="inner-content">
                        <h4><?php echo $row['p_name'] . ""; ?></h4>
                        <h6>ㅤ</h6>
                        <h6><?php echo $row['p_detail'] . ""; ?></h6>
                        <h6>ㅤ</h6>
                        <h6><?php
                              if (isset($total_adc_total)) {
                                 echo "จำนวนที่พร้อมขาย " . $total_adc_total . " ตัว ";
                              } else {
                                 echo "ไม่พบข้อมูลจำนวนไก่";
                              }
                              ?></h6>
                   

<?php
$total_o_qty_sum = 0; // กำหนดค่าเริ่มต้นให้เป็น 0

while ($row1 = mysqli_fetch_assoc($result1)) {
    $total_o_qty_sum += $row1['total_o_qty'];
    $difference = $total_adc_total - $total_o_qty_sum;
}

if ($total_o_qty_sum > 0) {
    echo "<h6>จำนวนที่จองแล้ว(" . $total_o_qty_sum . "ตัว)</h6>";
}
?>
                   
                   <?php if (isset($total_adc_total) && $total_adc_total > 0) { ?>
                           <div class="main-white-button scroll-to-section">
                              <a href="product_detail.php?p_id=<?php echo $row['p_id']; ?>">จองสินค้า</a>
                           </div>
                        <?php } ?>
                     
                     <?php
                  }
                     ?>
                     <h6>ㅤ</h6>
                     <h6>ㅤ</h6>
                     <h6>ㅤ</h6>
                     <h6>ㅤ</h6>
                     <h6>ㅤ</h6>
                     <h6>ㅤ</h6>
                     <h6>กรุณาเช็คจำนวนที่จองก่อนจอง</h6>
                     
                     </div>
                     
                  </div>
               </div>
               <div class="col-lg-8">
                  <div class="main-banner header-text">
                     <div class="Modern-Slider">
                        <!-- Item -->
                        <div class="item">
                           <div class="img-fill">
                              <img src="http://localhost/farmkai/images/img1.jpg">
                           </div>
                        </div>
                        <!-- // Item -->
                        <!-- Item -->
                        <div class="item">
                           <div class="img-fill">
                              <img src="http://localhost/farmkai/images/img2.jpg">
                           </div>
                        </div>
                        <!-- // Item -->
                        <!-- Item -->
                        <div class="item">
                           <div class="img-fill">
                              <img src="http://localhost/farmkai/images/img3.jpg">
                           </div>
                        </div>
                        <!-- // Item -->
                     </div>
                  </div>
               </div>
            </div>

         </div>
      </div>

      <!-- ***** Main Banner Area End ***** -->

      <!-- ***** About Area Starts ***** -->

      <!-- jQuery -->

      <!-- Plugins -->
      <script src="assets/js/owl-carousel.js"></script>
      <script src="assets/js/accordions.js"></script>

      <script src="assets/js/slick.js"></script>

      <script src="assets/js/isotope.js"></script>

      <!-- Global Init -->
      <script src="assets/js/custom.js"></script>

</body>

<body class="size-1520 primary-color-red background-dark">
   <!-- HEADER -->



   <!-- MAIN -->
   <main role="main">
      <!-- TOP SECTION -->

      <!-- SECTION 1 -->
      <!-- SECTION 5 -->
      <section class="grid margin text-center">
         <div class="m-12 l-4 padding-2x background-dark margin-bottom text-right" style="display: flex; justify-content: space-between;">
         </div>
         <a href="#" class="s-12 m-6 l-2 padding vertical-center margin-bottom facebook hover-zoom">
            <i>FACEBOOK</i>
         </a>
         <a href="#" class="s-12 m-6 l-2 padding vertical-center margin-bottom twitter hover-zoom">
            <i>TWITTER</i>
         </a>
         <a href="#" class="s-12 m-6 l-2 padding vertical-center margin-bottom youtube hover-zoom">
            <i>YOUTUBE</i>
         </a>
         <a href="#" class="s-12 m-6 l-2 padding vertical-center margin-bottom linkedin hover-zoom">
            <i>LINKEDIN</i>
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