<?php
$menu = "s_chicken"
?>

<?php
ob_start();
?>

<?php
require_once "db.php";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE FROM `s_chicken` WHERE s_id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=s_chicken.php");
    }
}
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<div class="card card-Light ">
    <section class="content-header mt-3 ">
        <div class="small-box " style="background-color: #E1D823; color:  FFFFFF ">
            <div class="inner">
                <h3>ขายไก่</h3>
                <p>ตารางข้อมูลการขายไก่</p>
            </div>
            <div class="icon">
                <i class="fas fa-user text-light"></i>
            </div>
            <a href="test.php" class="small-box-footer">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
        </div>
    </section>
</div>
<!-- Main content -->
<section class="content">
    <div class="card card-Light ">
        <div class="card-header ">
            <h3 class="card-title">รายการเพิ่มข้อมูล ขายไก่</h3>
            <div align="right">

                            <a href="printsell.php" target="_blank">
                            <button type="button" class="btn btn-outline-success">
                                <i class="fa-solid fa-print fa-xl" style="color: #0058f0;"></i> Print
                            </button>
                        </a>

            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">


                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>โรงเรือน</th>
                                <th>โซน</th>
                                <th>id ข้อมูลเพิ่มไก่</th>
                                <th>ขาย</th>
                                <th>เหลือ</th>
                                <th>วันที่ขาย</th>
                                <th>ชื่อผู้ใช้งาน</th>
                                <th style="width:15%;" class="text-center">รายละเอียดการขาย</th>


                            </tr>
                        </thead>



                        <tbody>
                            <?php
                            include "db.php";
                            $sql = "SELECT
                            d.s_id,
                            h.hou_name,
                            z.zon_num,
                            ad.adc_id,
                            d.s_total,           
                            d.s_num,
                            d.s_date,
                            m.mem_name,
                            od.o_id
                            FROM
                                s_chicken AS d
                            JOIN house AS h
                            ON
                                d.hou_id = h.hou_id
                            JOIN zone AS z
                            ON
                                d.zon_id = z.zon_id
                            JOIN add_chicken AS ad
                            ON
                                d.adc_id = ad.adc_id
                            JOIN tbl_member AS m
                            ON
                                d.mem_id = m.mem_id   
                                JOIN order_head as od ON d.o_id = od.o_id            
                            ";
                            $i = 1;
                            $result = mysqli_query($conn, $sql);

                            // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>
                                <tr readonly>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['hou_name'] ?></td>
                                    <td><?php echo $row['zon_num'] ?></td>
                                    <td><?php echo $row['adc_id'] ?></td>
                                    <td><?php echo $row['s_total'] ?></td>
                              
                                    <td>
                                    <?php
                                                            // Calculate the remaining chickens
                                        $remaining_chickens = $row['s_num'] - $row['s_total'];
                                        echo "" . $remaining_chickens;
                                            ?>

                                    </td>
                                    <td><?php echo $row['s_date'] ?></td>
                                    <td><?php echo $row['mem_name'] ?></td>
                                    <td>
                                        <?php
                                        echo "<a href='ordersell.php?o_id=$row[o_id]'>ตรวจสอบรายการสั่งซื้อ</a>";
                                        ?>
                                    </td>


                                </tr>
                            <?php

                            }
                            ?>

                        </tbody>
                    </table>
                </div>

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
                                url: 's_chicken.php',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'Data deleted successfully!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 's_chicken.php';
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
            </div>

        </div>
    </div>
    <div class="card-footer">
        +++++++
    </div>

    </div>

    <?php include('footer.php'); ?>


    </body>

    </html>