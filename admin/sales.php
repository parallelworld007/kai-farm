<?php
$menu = "sales"
?>
<?php include("header.php"); ?>
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
                <h3>รายการตรวจสอบรายการสั่งซื้อ</h3>
                <p>ตารางตรวจสอบรายการสั่งซื้อ</p>
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
    <div class="card">
        <div class="card-header ">
            <h3 class="card-title">
                ตรวจสอบรายการสั่งซื้อ
            </h3>
            <div align="right">

              

            </div>
        </div>
        <br>
        <div class="card-body">




            <div class="row">

                <div class="col-md-12">


                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:2%;">ลำดับ</th>
                                <th style="width:5%;">ID</th>
                                <th style="width:10%;">การสั่ง</th>
                                <th style="width:10%;">ชื่อผู้สั่งสินค้า</th>
                                <th style="width:15%;">อีเมลผู้สั่งซื้อ</th>
                                <th style="width:16%;">วันที่ในการสั่งซื้อ</th>
                                <th style="width:5%;">จำนวน</th>
                                <th style="width:13%;">กำหนดรับสินค้า</th>
                                <th style="width:11%;">สถานะการชำระ</th>
                                <th style="width:15%;">ตรวจสอบรายการสั่งซื้อ</th>
                                <th style="width:30%;">ขาย</th>
                                <th style="width:30%;">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "db.php";
                            $sql = "SELECT * 
                            FROM order_head 
                            WHERE o_wait <> 'ชำระเงินแล้ว' 
                            ORDER BY o_id ASC;";
                            $result = mysqli_query($conn, $sql);

                            $rowNumber = 1; // ตัวแปรสำหรับเก็บลำดับ

                            while ($row = mysqli_fetch_assoc($result)) {
                                $today = date("Y-m-d");
                                $o_dttm = $row["o_dttm"]; // วันที่จากฐานข้อมูล
                                $new_date = date("Y-m-d", strtotime($o_dttm . " +3 days"));
                                $date_diff = date_diff(date_create($today), date_create($new_date));
                            ?>
                                <tr>
                                    <td><?php echo $rowNumber; ?></td>
                                    <td><?php echo $row['o_id'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['cus_id'] == 'null') {
                                            echo "สั่งซื้อหน้าร้าน";
                                        } else {
                                            echo "สั่งซื้ออนไลน์";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['o_name'] ?></td>
                                    <td><?php echo $row['o_email'] ?></td>
                                    <td><?php echo $row['o_dttm'] ?></td>
                                    <td><?php echo $row['o_qty'] ?></td>
                                    <td> <?php
                                            $currentDateTime = date('d-m-Y');
                                            $new_date = date("Y-m-d", strtotime($o_dttm . " +3 days"));
                                            $currentDateTime1 = new DateTime($currentDateTime);
                                            $datetime2 = new DateTime($new_date);

                                            if ($currentDateTime1 > $datetime2) {
                                                $daysDifference = 0;
                                                $textColor = 'red'; // สีเขียว
                                            } else {
                                                $interval = $currentDateTime1->diff($datetime2);
                                                $daysDifference = $interval->days;
                                                $textColor = 'green'; // สีแดง
                                            }

                                            // ตรวจสอบสถานะการขาย
                                            if ($currentDateTime1 < $datetime2) {
                                                $interval = $currentDateTime1->diff($datetime2);
                                                $daysDifference = $interval->days;
                                                echo '<span style="color: ' . $textColor . '">เหลืออีก ' . $daysDifference . ' วัน</span>';
                                            } else {
                                                echo '<span style="color: ' . $textColor . '">เลยกำหนด</span>';
                                            }
                                            ?></td>

                                       
                                            <?php
                                            if ($row['o_wait'] == "ชำระเงินแล้ว") {
                                            ?><td style="color: green;"><?php echo $row['o_wait']; ?></td>
                                            <?php } elseif ($row['o_wait'] == "ยังไม่มารับสินค้า") { ?>
                                                <td style="color: orange; "><?php echo $row['o_wait']; ?></td>
                                            <?php } else { ?>
                                                <td style="color: red;"><?php echo $row['o_wait']; ?></td>
                                            <?php } ?>
                                             
                                    <td>
                                        <?php
                                        echo "<a href='orders.php?o_id=$row[o_id]'>ตรวจสอบรายการสั่งซื้อ</a>";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "<a href='addkaisell.php?o_id=$row[o_id]'><i class='fas fa-shopping-cart'></i></a>";
                                        ?>
                                    </td>
                                    <td>
                                        <a data-id="<?= $row['o_id']; ?>" href="?delete=<?= $row['o_id']; ?>" class="btn btn-danger delete-btn fa-solid fa-trash-can "></a>
                                    </td>
                                </tr>
                            <?php
                                $rowNumber++; // เพิ่มลำดับทีละ 1 หลังจบแถว
                            }
                            ?>
                        </tbody>
                    </table>




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