<?php
$menu = "salesconf"
?>
<?php include("header.php"); ?>
<head><script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .chart {
        max-width: 500px; /* ปรับขนาดตามที่คุณต้องการ */
        margin: 0 auto; /* จัดกึ่งกลาง */
        padding: 10px; /* เพิ่มระยะห่างรอบขอบ */
    }

    h2 {
        font-size: 1.5em; /* ปรับขนาดตัวหัวของกราฟ */
    }

    canvas {
        max-width: 200%; /* ปรับขนาดแผนภาพกราฟให้ไม่เกินพอดีกับคอนเทนเนอร์ */
        height: auto; /* ปรับขนาดความสูงให้ปรับตามขนาดความกว้าง */
    }
</style>
</head>
<?php
require_once "db.php";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE FROM `order_head` WHERE o_id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=sales.php");
    }
}
?>

<!-- Content Header (Page header) -->
<div class="card card-Light ">
    <section class="content-header  mt-3">
    <div class="small-box " style="background-color: #AF9FF9; color:  FFFFFF ">
        <div class="inner">
            <h3>รายการสั่งซื้อ</h3>
            <p>ตารางรายการสั่งซื้อ</p>
        </div>
        <div class="icon">
            <i class="fa fa-shopping-basket text-light"></i>
        </div>
        <a href="test.php" class="small-box-footer">
            <i class="fa fa-arrow-circle-left"> </i>
        </a>
        
    </section>
</div>
  <!-- Main content -->
  <section class="content">
    <div class="card card-gray">
      <div class="card-header ">
        <h3 class="card-title">


        </h3>
        <div align="right">

        
  
        </div>
      </div>
      <br>
      <div class="card-body">




        <div class="row">

<div class="col-md-12">


<table id="example" class="table table-striped table-bordered"  style="width:90%">
        <thead>
            <tr >
                <th style="width:5%;">ID</th>
                <th style="width:16%;">ชื่อผู้สั่งสินค้า</th>
                <th style="width:20%;">อีเมลผู้สั่งซื้อ</th>
                <th style="width:15%;">วันที่ในการสั่งซื้อ</th>
                <th style="width:15%;">สถานะการชำระ</th>
                <th style="width:10%;">จำนวนเงิน</th>
                <th style="width:30%;">ตรวจสอบรายการสั่งซื้อ</th>
                <th style="width:30%;">print</th>
            </tr>
        </thead>

        <tbody>


            <?php
            include "db.php";
            $sql = "SELECT o_id,o_name,o_email,o_dttm,o_wait,o_total
            FROM order_head
            WHERE o_wait = 'ชำระเงินแล้ว'";

            $result = mysqli_query($conn, $sql);
            // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr readonly >

                    <td><?php echo $row['o_id'] ?></td>
                    <td><?php echo $row['o_name'] ?></td>
                    <td ><?php echo $row['o_email'] ?></td>
                    <td ><?php echo $row['o_dttm'] ?></td>
                    
                    <?php
                     if ($row['o_wait'] == "ชำระเงินแล้ว") {
                      ?><td style="color: green; "><?php echo $row['o_wait']; ?></td>
                      <?php }
                      elseif ($row['o_wait'] == "ยังไม่ได้ตรวจสอบ") {
                        ?><td style="color: purple; "><?php echo $row['o_wait']; ?></td>
                        <?php }
                      else {
                      ?> <td style="color: red;"><?php echo $row['o_wait']; ?></td> <?php }  ?>
                      
                      <td ><?php echo  number_format( $row['o_total'], 2 ) ?> บาท</td>


                    <td>
                        <?php
                        echo "<a href='orders.php?o_id=$row[o_id]'>ตรวจสอบรายการสั่งซื้อ</a>"; ?>
                    </td>
                    <td>
                        <?php 
                        echo '<a href="print1.php?o_id=' . $row['o_id'] . '" class="link-Info">print</a>';
                        ?>
                    </td>


                </tr>
            <?php

            }
            ?>

        </tbody>
    </table>

    <div class="chart">
                        
                        <h2 style="text-align: center;"><a>ยอดขาย</a></h2>
                    
                    <canvas id="salesChart1" width="10" height="10"></canvas>

                    <?php
                    include "db.php";
                    $sql = "SELECT DATE_FORMAT(o_dttm, '%Y-%m') AS o_year, SUM(o_total) AS total_per_month
    FROM `order_head`
    WHERE o_wait = 'ชำระเงินแล้ว'";

                    if (isset($_GET['searchYear']) && isset($_GET['searchMonth'])) {
                        $searchYear = $_GET['searchYear'];
                        $searchMonth = $_GET['searchMonth'];
                        $sql .= " AND YEAR(o_dttm) = '$searchYear' AND MONTH(o_dttm) = '$searchMonth'";
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
                        var ctx = document.getElementById('salesChart1').getContext('2d');
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

</div>


</div>



      </div>
      <div class="card-footer">
        
      </div>
      
    </div>

    
    
    
    
    
  </section>
  <script>
        $(".delete-btn").click(function(e) {
            var userId = $(this).data('id');
            e.preventDefault();
            deleteConfirm(userId);
        })

        function deleteConfirm(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "คุณต้องการลบข้อมูล!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'sales.php',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'Data deleted successfully!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'sales.php';
                                })
                            })
                            .fail(function() {
                                Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
        
    </script>

  <!-- /.content -->
  
  
  <?php include('footer.php'); ?>
</body>
</html>
<!-- http://fordev22.com/ -->








