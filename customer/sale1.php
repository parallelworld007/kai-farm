<?php
$menu = "index"
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


   <link rel="stylesheet" href="saless.css">




</head>

<body>

   <?php
   //connect db
   include("db.php");
   $sql = "SELECT 
   product.p_id,
   product.p_name,
   product.p_detail,
   house.hou_name,
   zone.zon_num,
   CASE 
       WHEN CURDATE() <= add_chicken.adc_datesell THEN 0
       ELSE add_chicken.adc_total
   END AS adc_total,
   add_chicken.adc_sell,
   add_chicken.adc_datesell,
   CURDATE()
FROM 
   product
JOIN 
   house ON house.hou_id = house.hou_id
JOIN 
   zone ON house.hou_id = zone.hou_id
JOIN 
   add_chicken ON zone.zon_id = add_chicken.zon_id;";
   // $sql = "select * from product where 1";  //เรียกข้อมูลมาแสดงทั้งหมด
   $result = mysqli_query($conn, $sql);
   ?>

   <!-- ***** Preloader Start ***** -->

   <!-- ***** Preloader End ***** -->


   <!-- ***** Header Area Start ***** -->

   <!-- ***** Header Area End ***** -->

   <!-- ***** Main Banner Area Start ***** -->
   <?php
   while ($row = mysqli_fetch_assoc($result)) {
   ?>
      <div id="top">
         <div class="container-fluid">
            <div class="row">
            <div class="col-lg-4">
   <div class="left-content">
      <div class="inner-content">
         <h4><?php echo $row['p_name'] . ""; ?></h4>
         <h6><?php echo $row['p_detail'] . ""; ?></h6>
         <?php if (isset($row['adc_total']) && $row['adc_total'] > 0) { ?>
            <div class="main-white-button scroll-to-section">
               <a href="product_detail.php?p_id=<?php echo $row['p_id']; ?>">จองสินค้า</a>
            </div>
         <?php } ?>
         <h6><?php
            if (isset($row['adc_total'])) {
               echo "จำนวนที่พร้อมขาย " . $row['adc_total'] . " ตัว ";
            } else {
               echo "ไม่พบข้อมูลจำนวนไก่";
            }
         ?></h6>
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
   <?php
   }
   ?>
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

</html>