<?php
ob_start();
$menu = "test"
?>
<head>  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link rel="stylesheet" type="text/css" href="SL2.css">
  <style>body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;
}
@media print {
  body, page {
    background: white;
    margin: 0;
    box-shadow: 0;
  }
}</style>
  <style>
    @media print {

      /* ซ่อนฟอร์มเมื่อผู้ใช้กดปริ้น */
      #searchForm {
        display: none;
      }
    }
    
  </style>
  <style>
    element.style {
      display: block;
      box-sizing: border-box;
      height: 50px;
      width: 50px;
    }

    .chart {
      max-width: 100px;
      /* Adjust the maximum width of the chart container */
      margin: 0 auto;
      /* Center-align the chart container horizontally */
    }

    /* CSS for canvas element (the chart itself) */
    #barChart {
      width: 100%;
      /* Make the chart responsive to its container width */
      max-height: 200px;
      /* Set a maximum height for the chart */
    }
  </style>
  <style>
    /* CSS for chart container */
    .chart {
      max-width: 190px;
      /* Adjust the maximum width of the chart container */
      margin: 0 auto;
      /* Center-align the chart container horizontally */
    }


    #salesChart14 {
      display: block;
      box-sizing: border-box;
      height: 50px;
      width: 50px;
    }
  </style>
  <style>
    /* CSS for the table */
    #table {
      border-collapse: collapse;
      width: 600px;
      margin: auto;
    }

    #table td {
      border: 1px solid #ddd;
      padding: 8px;
      font-size: 0.50em;
    }

    #tables {
      border-collapse: collapse;
      width: 600px;
      margin: auto;
    }

    #tables td {
      border: 0.1px solid #ddd;
      padding: 4px;
    }
  </style>
  <style>#invoice-POS {
    box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    padding: 1mm;
    margin: 0 auto;
    width: 200mm;
    background: #fff;

}</style>
<style>
  /* Style the form container */
  #searchForm {
    max-width: 300px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  /* Style labels */
  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  /* Style select boxes */
  select {
    width: 100%;
    padding: 1px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
  }

  /* Style submit button */
  input[type="submit"] {
    background-color: #007bff;
    color: white;
    padding: 1px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #0056b3;
  }

  /* Style reset button */
  input[type="button"] {
    background-color: #ccc;
    color: #333;
    padding: 1px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    text-decoration: none;
  }

  input[type="button"]:hover {
    background-color: #999;
  }
  #printButton {
    background-color: #4caf50;
    color: white;
    padding: 1px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    margin-right: 10px; /* Add some spacing to the right of the button */
  }

  #printButton:hover {
    background-color: #45a049;
  }
</style>
<style>

#invoice-POS {
    box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    padding: 1mm;
    margin: 0 auto;
    width: 420mm;
    background: #fff;
}
</style>

</head>

<link rel="stylesheet" href="style.css">

<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<!-- Main content -->
<section class="content-header">
  
  <div class="card card-Light mt-2">
    <div class="container-fluid mt-3">

     
        <!-- Small boxes (Stat box) -->
        <div class="row">


          <script>
    // 2. เพิ่มฟังก์ชัน JavaScript เพื่อให้ปุ่ม "Print" ทำงาน
    function printPage() {
      // ซ่อนปุ่ม "Print" หลังจากกด
      document.getElementById("printButton").style.display = "none";

      window.print(); // เรียกใช้งานฟังก์ชันพิมพ์ของเบราว์เซอร์

      // แสดงปุ่ม "Print" อีกครั้งหลังจากพิมพ์เสร็จ
      document.getElementById("printButton").style.display = "block";
    }
  </script>
  
  <div id="invoice-POS">
  <center>
        <form method="get" action="" onsubmit="searchYear();" id="searchForm">

<label for="searchYear">ปี:</label>
<select name="searchYear" id="searchYear">
  <option value="00"></option>
  <option value="2020">2020</option>
  <option value="2021">2021</option>
  <option value="2022">2022</option>
  <option value="2023">2023</option>
  <option value="2024">2024</option>
  <option value="2025">2025</option>
  <option value="2026">2026</option>
  <option value="2027">2027</option>
  <option value="2028">2028</option>
  <option value="2029">2029</option>
  <option value="2030">2030</option>
  <!-- เพิ่มเพื่อปีถัดไปตามต้องการ -->
</select>
<style>
  #searchYear option[value="00"] {
    display: none;
  }
</style>
<label for="searchMonth">เดือน:</label>
<select name="searchMonth" id="searchMonth">
  <option value="00"></option>
  <option value="01">มกราคม</option>
  <option value="02">กุมภาพันธ์</option>
  <option value="03">มีนาคม</option>
  <option value="04">เมษายน</option>
  <option value="05">พฤษภาคม</option>
  <option value="06">มิถุนายน</option>
  <option value="07">กรกฎาคม</option>
  <option value="08">สิงหาคม</option>
  <option value="09">กันยายน</option>
  <option value="10">ตุลาคม</option>
  <option value="11">พฤศจิกายน</option>
  <option value="12">ธันวาคม</option>
  <!-- ... (เพิ่มตั้งค่าเดือนต่อไป) ... -->
</select>
<style>
  #searchMonth option[value="00"] {
    display: none;
  }
</style>
<input type="submit" value="ค้นหา">
<a href="test.php"><input type="button" value="รีเซ็ต"></a>
<button id="printButton" onclick="printPage()">Print</button>
</form></center>
        <p>

        <?php
// Check if the form is submitted and if the 'searchYear' parameter is set in the URL
if (isset($_GET['searchYear'])) {
    // Get the selected year value from the URL
    $selectedYear = $_GET['searchYear'];

    // Check if 'searchMonth' is not equal to "00" and is set in the URL
    if (isset($_GET['searchMonth']) && $_GET['searchMonth'] !== "00") {
        $selectedMonth = $_GET['searchMonth'];

        // Define an array of Thai month names
        $thaiMonths = array(
            "01" => "มกราคม",
            "02" => "กุมภาพันธ์",
            "03" => "มีนาคม",
            "04" => "เมษายน",
            "05" => "พฤษภาคม",
            "06" => "มิถุนายน",
            "07" => "กรกฎาคม",
            "08" => "สิงหาคม",
            "09" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม"
        );

        // Use the selected year and month to create labels
        $labels = array();
        if (isset($thaiMonths[$selectedMonth])) {
            $labels[] = $thaiMonths[$selectedMonth] . " " . $selectedYear;
        }
    }
    // Check if labels exist and echo them
    if (!empty($labels)) {
      echo '<div style="text-align: center;">';
      echo "รายงานเรื่องประจำเดือน : " . implode(", ", $labels) . "<br>";
      echo '</div>';
    }
}
?>



<?php
// Check if the form is submitted and if the 'searchYear' parameter is set in the URL
if (isset($_GET['searchYear'])) {
    // Get the selected year value from the URL
    $selectedYear = $_GET['searchYear'];

    // Check if 'searchMonth' is not equal to "00" and is set in the URL

        // Define an array of Thai month names
        $thaiMonths = array(
            "01" => "มกราคม",
            "02" => "กุมภาพันธ์",
            "03" => "มีนาคม",
            "04" => "เมษายน",
            "05" => "พฤษภาคม",
            "06" => "มิถุนายน",
            "07" => "กรกฎาคม",
            "08" => "สิงหาคม",
            "09" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม"
        );

      echo "<center>ปี :   ($selectedYear) </center>";
    }

?>
      <center><h5>รายงาน</h5>
      <h2>สีขาวฟาร์ม</h2>
    </center>
    <div id="mid">
      <div class="info">
        <div id="tables">






          
          <table width="20" border="1" cellspacing="0" cellpadding="5">
            <tr>

              <td><b>เลขที่เอกสารรายงาน</b> </td>
              <td></td>
              <td><b>วันที่ / DATE :</b></td>
              <td><?php
                  $today = date("Y-m-d H:i:s"); // รูปแบบ "ปี-เดือน-วัน ชั่วโมง:นาที:วินาที"
                  echo $today;
                  ?></td>
            </tr>
            <tr>

              <td width="200"><b>ผู้พิมพ์รายงาน </b> </td>
              <td width="200"></td>
              <td width="200"><b>เบอร์โทร / TEL :</b> </td>
              <td width="200">064-231-8695</td>
            </tr>
            <tr>
              <td><b>ที่อยู่ / Address :</b> </td>
              <td colspan="3">ที่อยู่ของฟาร์ม สีขาวฟาร์ม , อ.นาอาน , อ.เมือง , จ.เลย 42000</td>
            </tr>
          </table>

          <table id="chickenTable" width="10" border="1" cellspacing="0" cellpadding="5">
            <tr>
              <td width="200"> <?php
            include "db.php";
            $sql = "SELECT * FROM `tbl_customer`";
            $result = mysqli_query($conn, $sql);
          ?>
         
            <!-- small box -->
            <div class="small-box " style="background-color: #FA61A0; color:  FFFFFF ">
              <div class="inner">
                <h3><?php echo mysqli_num_rows($result); ?></h3>

                <p>ข้อมูล ลูกค้า</p>
              </div>
              <div class="icon">
                <i class="fa fa-address-book text-light "></i>
              </div>
              <a href="list_cus.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </td>
              <td width="200">
                <div class="chart">
                  <h2 style="text-align: center;"><a>จำนวนลูกค้า</a></h2>
                  <canvas id="genderChart" width="10" height="10"></canvas>

                  <script>
                    <?php
                    include "db.php";
                    // คำสั่ง SQL เพื่อดึงข้อมูลจำนวนลูกค้าแยกตามเพศ
                    $sql = "SELECT cus_gender, COUNT(*) AS count FROM tbl_customer GROUP BY cus_gender";
                    $result = $conn->query($sql);

                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                      $gender = ($row['cus_gender'] == 1) ? "ชาย" : "หญิง";
                      $data[] = array('gender' => $gender, 'count' => $row['count']);
                    }

                    // เพิ่มเงื่อนไขเพื่อเพิ่มข้อมูล "ไม่ระบุเพศ" เมื่อไม่พบข้อมูล
                    if (empty($data)) {
                      $data[] = array('gender' => 'ไม่ระบุเพศ', 'count' => 0);
                    }

                    $conn->close();
                    ?>

                    // สร้างกราฟวงกลม
                    var ctx = document.getElementById('genderChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'pie',
                      data: {
                        labels: [
                          <?php foreach ($data as $item) {
                            echo "'" . $item['gender'] . "', ";
                          } ?>
                        ],
                        datasets: [{
                          data: [
                            <?php foreach ($data as $item) {
                              echo $item['count'] . ", ";
                            } ?>
                          ],
                          backgroundColor: ['blue', 'pink']
                        }]
                      },
                      options: {
                        title: {
                          display: true,
                          text: 'จำนวนลูกค้าแยกตามเพศ'
                        }
                      }
                    });
                  </script>
                </div>
              </td>
              <td width="200"> <?php
        include "db.php";
        $sql = "SELECT * FROM `tbl_member`";
        $result = mysqli_query($conn, $sql);
        ?>
          
            <!-- small box -->
            <div class="small-box" style="background-color: #F95433; color:  FFFFFF ">
              <div class="inner">
                <h3><?php echo mysqli_num_rows($result); ?></h3>

                <p>ข้อมูล ผู้ใช้งาน</p>
              </div>
              <div class="icon">
                <i class="fa fa-id-card text-light"></i>
              </div>
              <a href="list_mem.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </td>
              <td width="200">
                <div class="chart">
                  <h2 style="text-align: center;"><a>จำนวนผู้ใช้งาน</a></h2>
                  <canvas id="employ" width="10" height="10"></canvas>

                  <script>
                    <?php
                    include "db.php";
                    // คำสั่ง SQL เพื่อดึงข้อมูลจำนวนลูกค้าแยกตามเพศ
                    $sql = " SELECT mem_sta, COUNT(*) AS count FROM tbl_member GROUP BY mem_sta ";
                    $result = $conn->query($sql);

                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                      $gender = ($row['mem_sta'] == 1) ? "พนักงาน" : "แอดมิน";
                      $data[] = array('gender' => $gender, 'count' => $row['count']);
                    }

                    // เพิ่มเงื่อนไขเพื่อเพิ่มข้อมูล "ไม่ระบุเพศ" เมื่อไม่พบข้อมูล
                    if (empty($data)) {
                      $data[] = array('gender' => 'ไม่ระบุเพศ', 'count' => 0);
                    }

                    $conn->close();
                    ?>

                    // สร้างกราฟวงกลม
                    var ctx = document.getElementById('employ').getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'pie',
                      data: {
                        labels: [
                          <?php foreach ($data as $item) {
                            echo "'" . $item['gender'] . "', ";
                          } ?>
                        ],
                        datasets: [{
                          data: [
                            <?php foreach ($data as $item) {
                              echo $item['count'] . ", ";
                            } ?>
                          ],
                          backgroundColor: ['green', 'black']
                        }]
                      },
                      options: {
                        title: {
                          display: true,
                          text: 'จำนวนลูกค้าแยกตามเพศ'
                        }
                      }
                    });
                  </script>
                </div>
              </td>
            </tr>
            <tr>
              <td width="200"><b>ผู้ใช้งาน :</b></td>
              <td width="200">รวม
              <?php include "db.php";
                    // คำสั่ง SQL เพื่อดึงข้อมูลจำนวนลูกค้าแยกตามเพศ
                    $sql = " SELECT cus_id, COUNT(*) AS count FROM tbl_customer ";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                    
                    echo $row['count'];}
                    ?>
                    คน
              </td>
              <td width="200"><b>สมาชิก :</b></td>
              <td width="200">รวม
              <?php include "db.php";
                    // คำสั่ง SQL เพื่อดึงข้อมูลจำนวนลูกค้าแยกตามเพศ
                    $sql = " SELECT mem_sta, COUNT(*) AS count FROM tbl_member ";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                    
                    echo $row['count'];}
                    ?>
                    คน
              </td>
            </tr>
            <tr>
              <td width="200"> <?php
            include "db.php";
            $sql = "SELECT * FROM `house`";
            $result = mysqli_query($conn, $sql);
            ?>
          
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
          </td>
              <td width="200">
                <table id="example" style="width:90%">




                  <tbody>


                    <?php
                    include "db.php";
                    $sql = "SELECT * FROM `house`";
                    $result = mysqli_query($conn, $sql);

                    // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <tr readonly>
                        <td><?php echo $row['hou_id'] ?></td>
                        <td><?php echo $row['hou_name'] ?></td>

                      </tr>
                    <?php
                    }
                    ?>

                  </tbody>
                </table>
              </td>
              <td width="200"><?php
      include "db.php";
      $sql = "SELECT * FROM `zone`";
      $result = mysqli_query($conn, $sql);
      ?>
          
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
          </td>
              <td width="200">
                <table id="example" style="width:90%">

                  <tbody>


                    <?php
                    include "db.php";
                    $sql = "SELECT house.*,zone.* FROM `house`
    JOIN zone ON house.hou_id = zone.hou_id";
                    $result = mysqli_query($conn, $sql);

                    // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <tr readonly>
                        <td><?php echo $row['zon_id'] ?></td>
                        <td><?php echo $row['hou_name'] ?></td>
                        <td><?php echo $row['zon_num'] ?></td>
                      </tr>
                    <?php

                    }
                    ?>

                  </tbody>
                </table>
              </td>
            </tr>


            <tr>
              <td><?php
      include "db.php";
      $sql = "SELECT * FROM `add_chicken`";
      $result = mysqli_query($conn, $sql);
      ?>
          <!-- ./col -->
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
          </td>
              <td>
                <div class="chart">
                  <canvas id="barChart" width="10" height="10"></canvas>

                  <?php
                  include "db.php";

                  // Execute SQL query
                  $query = "SELECT DATE_FORMAT(adc_date, '%Y-%m') AS o_year, hou.hou_name, SUM(add_chicken.adc_total) AS total_car_num
                FROM house hou
                JOIN zone zon ON hou.hou_id = zon.hou_id
                JOIN add_chicken ON zon.zon_id = add_chicken.zon_id";

                  if (isset($_GET['searchYear'])) {
                    $searchYear = $_GET['searchYear'];
                    $query .= " WHERE YEAR(adc_date) = '$searchYear'";

                    if (isset($_GET['searchMonth']) && $_GET['searchMonth'] !== "00") {
                      $searchMonth = $_GET['searchMonth'];
                      $query .= " AND MONTH(adc_date) = '$searchMonth'";
                    }
                  }

                  $query .= " GROUP BY hou.hou_name, hou.hou_id";

                  $result = mysqli_query($conn, $query);

                  // Prepare data for the graph
                  $data = array();
                  while ($row = mysqli_fetch_assoc($result)) {
                    $data[$row['hou_name']] = intval($row['total_car_num']);
                  }
                  ?>

                  <script>
                    // JavaScript code to create a bar chart from the data
                    var ctx = document.getElementById('barChart').getContext('2d');

                    var data = {
                      labels: [<?php
                                $labels = array_keys($data);
                                echo "'" . implode("', '", $labels) . "'";
                                ?>],
                      datasets: [{
                        label: 'จำนวนไก่ในโรงเรือน',
                        data: [<?php
                                $values = array_values($data);
                                echo implode(", ", $values);
                                ?>],
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                      }]
                    };

                    var options = {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    };

                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: data,
                      options: options
                    });
                  </script>
                </div>
              </td>
              <td><?php
      include "db.php";
      $sql = "SELECT * FROM `d_chicken`";
      $result = mysqli_query($conn, $sql);
      ?>
          <!-- ./col -->
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
          </td>
              <td>
                <?php
                include "db.php";

                // Initialize the search year and month
                $searchYear = isset($_GET['searchYear']) ? $_GET['searchYear'] : '';

                // Check if searchMonth is provided and not equal to "00"
                $searchMonth = isset($_GET['searchMonth']) && $_GET['searchMonth'] !== '00' ? $_GET['searchMonth'] : '';

                // Construct the base SQL query
                $sql = "SELECT DATE_FORMAT(adc_date, '%Y-%m') AS o_year, h.hou_id, h.hou_name, z.zon_id, z.zon_num, ad.adc_id, ad.adc_num, ad.adc_date, ad.adc_datesell, ad.adc_total, ad.adc_num, ad.adc_d, ad.adc_sell, m.mem_id, m.mem_name
FROM zone as z
LEFT JOIN house as h ON z.hou_id = h.hou_id
LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
LEFT JOIN tbl_member as m ON ad.mem_id = m.mem_id";

                // Add WHERE conditions based on user selections
                $whereConditions = [];

                if (!empty($searchYear)) {
                  $whereConditions[] = "YEAR(adc_date) = '$searchYear'";
                }

                if (!empty($searchMonth)) {
                  $whereConditions[] = "MONTH(adc_date) = '$searchMonth'";
                }

                if (!empty($whereConditions)) {
                  $sql .= " WHERE " . implode(" AND ", $whereConditions);
                }

                // Add an ORDER BY clause to display the most recent entries first
                $sql .= " ORDER BY adc_date DESC";

                // Execute the SQL query
                $result = mysqli_query($conn, $sql);
                $i = 1;

                // Display the results in an HTML table
                ?>
                <table id="example" style="width:90%">
                  <tr>
                    <td width="10">#</td>
                    <td width="80">โรงเรือน</td>
                    <td width="50">โซน</td>
                    <td width="80">เหลือ</td>
                    <td>ตาย</td>
                  </tr>
                  <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                    // Calculate the status
                    if (empty($row['adc_date']) || empty($row['adc_datesell'])) {
                      $status = "-";
                    } elseif ($row['adc_date'] == $row['adc_datesell']) {
                      $status = "พร้อมขาย";
                    } else {
                      $status = "เลี้ยง";
                    }
                  ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $row['hou_name'] ?></td>
                      <td><?php echo $row['zon_num'] ?></td>
                      <td><?php echo empty($row['adc_total']) ? '-' : $row['adc_total'] ?></td>
                      <td><?php echo empty($row['adc_d']) ? '-' : $row['adc_d'] ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </table>
              </td>
            </tr>
            <tr>
              <td width="200"><b>โรงเรือน</b></td>
              <td width="200">
                <?php
                include "db.php";
                $sql = "SELECT DATE_FORMAT(o_dttm, '%Y-%m') AS o_year, COUNT(o_total) AS total_per_month
            FROM `order_head`";
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <?php echo number_format($row['total_per_month']) ?> รายการ
                <?php
                }
                ?>
              </td>
              <td width="200"><b>จำนวนยอดขาย</b></td>
              <td width="200">
                <?php
                include "db.php";

                // Initialize the search year and month
                $searchYear = isset($_GET['searchYear']) ? $_GET['searchYear'] : '';
                // Check if searchMonth is provided and not equal to "00"
                $searchMonth = isset($_GET['searchMonth']) && $_GET['searchMonth'] !== '00' ? $_GET['searchMonth'] : '';
                // Construct the base SQL query
                $sql = "SELECT DATE_FORMAT(adc_date, '%Y-%m') AS o_year, h.hou_id, h.hou_name, z.zon_id,
z.zon_num, ad.adc_id, ad.adc_num, ad.adc_date, ad.adc_datesell,
ad.adc_total, ad.adc_num, ad.adc_d, ad.adc_sell, m.mem_id, m.mem_name, COUNT(h.hou_id)
FROM zone as z
LEFT JOIN house as h ON z.hou_id = h.hou_id
LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
LEFT JOIN tbl_member as m ON ad.mem_id = m.mem_id";

                // Add WHERE conditions based on user selections
                $whereConditions = [];

                if (!empty($searchYear)) {
                  $whereConditions[] = "YEAR(adc_date) = '$searchYear'";
                }

                if (!empty($searchMonth)) {
                  $whereConditions[] = "MONTH(adc_date) = '$searchMonth'";
                }

                if (!empty($whereConditions)) {
                  $sql .= " WHERE " . implode(" AND ", $whereConditions);
                }

                // Add an ORDER BY clause to display the most recent entries first
                $sql .= " ORDER BY adc_date DESC";

                // Execute the SQL query
                $result = mysqli_query($conn, $sql);
                $i = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                  // Calculate the status
                  if (empty($row['adc_date']) || empty($row['adc_datesell'])) {
                    $status = "-";
                  } elseif ($row['adc_date'] == $row['adc_datesell']) {
                    $status = "พร้อมขาย";
                  } else {
                    $status = "เลี้ยง";
                  }
                ?>
                  <?php echo empty($row['COUNT(h.hou_id)']) ? '-' : $row['COUNT(h.hou_id)'] ?> โรงเรือน
                <?php
                }
                ?>
                <?php
                include "db.php";

                // Initialize the search year and month
                $searchYear = isset($_GET['searchYear']) ? $_GET['searchYear'] : '';
                // Check if searchMonth is provided and not equal to "00"
                $searchMonth = isset($_GET['searchMonth']) && $_GET['searchMonth'] !== '00' ? $_GET['searchMonth'] : '';

                // Construct the base SQL query
                $sql = "SELECT DATE_FORMAT(adc_date, '%Y-%m') AS o_year, h.hou_id, h.hou_name, z.zon_id,
z.zon_num, ad.adc_id, ad.adc_num, ad.adc_date, ad.adc_datesell,
ad.adc_total, ad.adc_num, ad.adc_d, ad.adc_sell, m.mem_id, m.mem_name, 
COUNT(CASE WHEN ad.adc_id IS NOT NULL THEN z.zon_id END) AS zon_id_count
FROM zone as z
LEFT JOIN house as h ON z.hou_id = h.hou_id
LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
LEFT JOIN tbl_member as m ON ad.mem_id = m.mem_id";

                // Add WHERE conditions based on user selections
                $whereConditions = [];

                if (!empty($searchYear)) {
                  $whereConditions[] = "YEAR(adc_date) = '$searchYear'";
                }

                if (!empty($searchMonth)) {
                  $whereConditions[] = "MONTH(adc_date) = '$searchMonth'";
                }

                if (!empty($whereConditions)) {
                  $sql .= " WHERE " . implode(" AND ", $whereConditions);
                }

                // Add an ORDER BY clause to display the most recent entries first
                $sql .= " ORDER BY adc_date DESC";

                // Execute the SQL query
                $result = mysqli_query($conn, $sql);
                $i = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                  // Calculate the status
                  if (empty($row['adc_date']) || empty($row['adc_datesell'])) {
                    $status = "-";
                  } elseif ($row['adc_date'] == $row['adc_datesell']) {
                    $status = "พร้อมขาย";
                  } else {
                    $status = "เลี้ยง";
                  }
                ?>
                  <?php echo empty($row['zon_id_count']) ? '-' : $row['zon_id_count'] ?> โซน
                <?php
                }
                ?>

                <?php
                include "db.php";

                // Initialize the search year and month
                $searchYear = isset($_GET['searchYear']) ? $_GET['searchYear'] : '';
                // Check if searchMonth is provided and not equal to "00"
                $searchMonth = isset($_GET['searchMonth']) && $_GET['searchMonth'] !== '00' ? $_GET['searchMonth'] : '';

                // Construct the base SQL query
                $sql = "SELECT DATE_FORMAT(adc_date, '%Y-%m') AS o_year, h.hou_id, h.hou_name, z.zon_id,
z.zon_num, ad.adc_id, ad.adc_num, ad.adc_date, ad.adc_datesell,
ad.adc_total, ad.adc_num, ad.adc_d, ad.adc_sell, m.mem_id, m.mem_name, SUM(ad.adc_total)
FROM zone as z
LEFT JOIN house as h ON z.hou_id = h.hou_id
LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
LEFT JOIN tbl_member as m ON ad.mem_id = m.mem_id";

                // Add WHERE conditions based on user selections
                $whereConditions = [];

                if (!empty($searchYear)) {
                  $whereConditions[] = "YEAR(adc_date) = '$searchYear'";
                }

                if (!empty($searchMonth)) {
                  $whereConditions[] = "MONTH(adc_date) = '$searchMonth'";
                }

                if (!empty($whereConditions)) {
                  $sql .= " WHERE " . implode(" AND ", $whereConditions);
                }

                // Add an ORDER BY clause to display the most recent entries first
                $sql .= " ORDER BY adc_date DESC";

                // Execute the SQL query
                $result = mysqli_query($conn, $sql);
                $i = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                  // Calculate the status
                  if (empty($row['adc_date']) || empty($row['adc_datesell'])) {
                    $status = "-";
                  } elseif ($row['adc_date'] == $row['adc_datesell']) {
                    $status = "พร้อมขาย";
                  } else {
                    $status = "เลี้ยง";
                  }
                ?>
                  เหลือ <?php echo empty($row['SUM(ad.adc_total)']) ? '-' : $row['SUM(ad.adc_total)'] ?> ตัว
                <?php
                }
                ?>

              </td>
            </tr>
            <tr>

              <td><?php
      include "db.php";
      $sql = "SELECT * FROM `order_head`";
      $result = mysqli_query($conn, $sql);
      ?>
     
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
          </td>
              <td>
                <div class="chart">

                  <h2 style="text-align: center;"><a>ยอดสั่งซื้อ(รวม)</a></h2>


                  <canvas id="salesChart13" width="10" height="10"></canvas>

                  <?php
                  include "db.php";
                  $sql = "SELECT DATE_FORMAT(o_dttm, '%Y-%m') AS o_year, SUM(o_total) AS total_per_month
                   FROM `order_head`";

                  // Modify the query to include year and month filtering based on the selected values
                  if (isset($_GET['searchYear'])) {
                    $searchYear = $_GET['searchYear'];

                    // Check if searchMonth is not equal to "00" or is not set
                    if (!isset($_GET['searchMonth']) || $_GET['searchMonth'] !== "00") {
                      $searchMonth = $_GET['searchMonth'];
                      $sql .= " WHERE YEAR(o_dttm) = '$searchYear' AND MONTH(o_dttm) = '$searchMonth'";
                    } else {
                      $sql .= " WHERE YEAR(o_dttm) = '$searchYear'";
                    }
                  }

                  $sql .= " GROUP BY o_year";
                  $result = mysqli_query($conn, $sql);

                  $labels = [];
                  $data = [];

                  $thai_months = array(
                    "01" => "มกราคม",
                    "02" => "กุมภาพันธ์",
                    "03" => "มีนาคม",
                    "04" => "เมษายน",
                    "05" => "พฤษภาคม",
                    "06" => "มิถุนายน",
                    "07" => "กรกฎาคม",
                    "08" => "สิงหาคม",
                    "09" => "กันยายน",
                    "10" => "ตุลาคม",
                    "11" => "พฤศจิกายน",
                    "12" => "ธันวาคม"
                  );

                  while ($row = mysqli_fetch_assoc($result)) {
                    $month = substr($row['o_year'], 5, 2);
                    $labels[] = $thai_months[$month] . " " . (int)substr($row['o_year'], 0, 4);
                    $data[] = $row['total_per_month'];
                  }
                  ?>

                  <script>
                    var ctx = document.getElementById('salesChart13').getContext('2d');
                    var salesChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: [{
                          label: 'ยอดขาย(รวมที่ยังไม่ชำระ)',
                          data: <?php echo json_encode($data); ?>,
                          backgroundColor: 'rgba(75, 192, 192, 0.2)',
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  </script>
                </div>
              </td>
              <td><?php
      include "db.php";
      $sql = "SELECT DATE_FORMAT(o_dttm, '%Y-%m') AS o_year, SUM(o_total) AS total_per_month
      FROM `order_head`
      WHERE o_wait = 'ชำระเงินแล้ว'";
      $result = mysqli_query($conn, $sql);
      ?>
         
            <!-- small box -->
            <div class="small-box" style="background-color: #9FBEF9; color:  FFFFFF ">
              <div class="inner">
                <h3><?php echo mysqli_num_rows($result); ?></h3>

                <p>ยอดขาย</p>
              </div>
              <div class="icon">
                <i href="product.php" class="fa fa-shopping-cart text-light"></i>
              </div>
              <a href="product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </td>
              <td>
                <div class="chart">

                  <h2 style="text-align: center;"><a>ยอดขาย</a></h2>

                  <canvas id="salesChart14" width="10" height="10"></canvas>

                  <?php
                  include "db.php";
                  $sql = "SELECT DATE_FORMAT(o_dttm, '%Y-%m') AS o_year, SUM(o_total) AS total_per_month
    FROM `order_head`
    WHERE o_wait = 'ชำระเงินแล้ว'";

                  if (isset($_GET['searchYear'])) {
                    $searchYear = $_GET['searchYear'];
                    $sql .= " AND YEAR(o_dttm) = '$searchYear'";

                    if (isset($_GET['searchMonth']) && $_GET['searchMonth'] !== '00') {
                      $searchMonth = $_GET['searchMonth'];
                      $sql .= " AND MONTH(o_dttm) = '$searchMonth'";
                    }
                  }

                  $sql .= " GROUP BY o_year";
                  $result = mysqli_query($conn, $sql);

                  $labels = [];
                  $data = [];


                  while ($row = mysqli_fetch_assoc($result)) {
                    $month = substr($row['o_year'], 5, 2);
                    $labels[] = $thai_months[$month] . " " . (int)substr($row['o_year'], 0, 4);
                    $data[] = $row['total_per_month'];
                  }
                  ?>

                  <script>
                    var ctx = document.getElementById('salesChart14').getContext('2d');
                    var salesChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: [{
                          label: 'ยอดขาย(ที่ชำระเงินแล้ว)',
                          data: <?php echo json_encode($data); ?>,
                          backgroundColor: 'rgba(75, 192, 192, 0.2)',
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  </script>
                </div>
              </td>
            </tr>
            <tr>
              <td width="200"><b>จำนวนรายการสั่งซื้อ</b></td>
              <td width="200">
                <?php
                include "db.php";
                $sql = "SELECT DATE_FORMAT(o_dttm, '%Y-%m') AS o_year, COUNT(o_total) AS total_per_month
            FROM `order_head`";

                if (isset($_GET['searchYear'])) {
                  $searchYear = $_GET['searchYear'];

                  // Check if searchMonth is not '00' and set the condition accordingly
                  if (isset($_GET['searchMonth']) && $_GET['searchMonth'] !== '00') {
                    $searchMonth = $_GET['searchMonth'];
                    $sql .= " WHERE YEAR(o_dttm) = '$searchYear' AND MONTH(o_dttm) = '$searchMonth'";
                  } else {
                    $sql .= " WHERE YEAR(o_dttm) = '$searchYear'";
                  }
                }

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <?php echo number_format($row['total_per_month']) ?> รายการ
                <?php
                }
                ?>
              </td>
              <td width="200"><b>จำนวนยอดขาย</b></td>
              <td width="200">
                <?php
                include "db.php";
                $sql = "SELECT DATE_FORMAT(o_dttm, '%Y-%m') AS o_year, COUNT(o_total) AS total_per_month
            FROM `order_head`
            WHERE o_wait = 'ชำระเงินแล้ว'";

                if (isset($_GET['searchYear'])) {
                  $searchYear = $_GET['searchYear'];
                  $searchMonth = isset($_GET['searchMonth']) ? $_GET['searchMonth'] : null;

                  // Check if $searchMonth is "00"; if not, append the month condition
                  if ($searchMonth !== "00") {
                    $sql .= " AND MONTH(o_dttm) = '$searchMonth'";
                  }

                  // Append the year condition
                  $sql .= " AND YEAR(o_dttm) = '$searchYear'";
                }

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <?php echo number_format($row['total_per_month']) ?> รายการ
                <?php
                }
                ?>
              </td>
            </tr>
            <tr>
              <td width="200"><b>รวมที่ต้องได้ :</b></td>
              <td width="200">
                <?php
                include "db.php";
                $sql = "SELECT DATE_FORMAT(o_dttm, '%Y-%m') AS o_year, SUM(o_total) AS total_per_month
            FROM `order_head`";

                if (isset($_GET['searchYear'])) {
                  $searchYear = $_GET['searchYear'];
                  $sql .= " WHERE YEAR(o_dttm) = '$searchYear'";

                  if (isset($_GET['searchMonth']) && $_GET['searchMonth'] !== "00") {
                    $searchMonth = $_GET['searchMonth'];
                    $sql .= " AND MONTH(o_dttm) = '$searchMonth'";
                  }
                }

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <?php echo number_format($row['total_per_month']) ?> บาท
                <?php
                }
                ?>
              </td>
              <td width="200"><b>รวมยอดขายที่ได้รับ :</b></td>
              <td width="200">
                <?php
                include "db.php";
                $sql = "SELECT DATE_FORMAT(o_dttm, '%Y-%m') AS o_year, SUM(o_total) AS total_per_month
            FROM `order_head`
            WHERE o_wait = 'ชำระเงินแล้ว'";

                if (isset($_GET['searchYear']) && isset($_GET['searchMonth'])) {
                  $searchYear = $_GET['searchYear'];
                  $searchMonth = $_GET['searchMonth'];

                  // เช็คค่า searchMonth ว่าเป็น "00" หรือไม่
                  if ($searchMonth !== '00') {
                    $sql .= " AND YEAR(o_dttm) = '$searchYear' AND MONTH(o_dttm) = '$searchMonth'";
                  } else {
                    $sql .= " AND YEAR(o_dttm) = '$searchYear'";
                  }
                }



                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <?php echo number_format($row['total_per_month']) ?> บาท
                <?php
                }
                ?>
              </td>
            </tr>
            <tr>

          </table>

        </div>

        </p>
      </div>
    </div><!--End Invoice Mid-->

          <!-- ./col -->
        </div>
      
      <!-- /.row -->
      <!-- Main row -->
      
</section>
<!-- /.content -->






<?php include('footer.php'); ?>

</body>

</html>