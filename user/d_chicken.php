<?php
$menu = "d_chicken"
?>

<?php
ob_start();
?>

<?php
require_once "db.php";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE FROM `d_chicken` WHERE d_id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=d_chicken.php");
    }
}
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<div class="card card-Light ">
    <section class="content-header mt-3 ">
        <div class="small-box " style="background-color: #848484; color:  FFFFFF ">
            <div class="inner">
                <h3>ข้อมูลไก่ตาย</h3>
                <p>ตารางมูลไก่ตาย</p>
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
            <h3 class="card-title">รายการเพิ่มข้อมูล เพิ่มไก่</h3>
            <div align="right">

                        <a href="printkaid.php" target="_blank">
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
                                <th>ตาย</th>
                                <th>สาเหตุ</th>
                                <th>เหลือ</th>
                                <th>วันที่ตาย</th>
                                <th>ชื่อผู้ใช้งาน</th>
                                <th style="width:6%;" class="text-center">ลบ</th>
                                <th style="width:3%;" class="text-center">แก้ไข</th>


                            </tr>
                        </thead>



                        <tbody>
                            <?php
                            include "db.php";
                            $sql = "SELECT
                                        d.d_id,
                                        h.hou_name,
                                        z.zon_num,
                                        ad.adc_id,
                                        d.d_total,
                                        d.d_note,
                                        d.d_num,
                                        d.d_date,
                                        m.mem_name
                                        FROM
                                            d_chicken AS d
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
                            ";
                            $i = 1;
                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>
                                <tr readonly>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['hou_name'] ?></td>
                                    <td><?php echo $row['zon_num'] ?></td>
                                    <td><?php echo $row['d_total'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['d_id'] == '') {
                                            echo '-';
                                        } else {

                                            switch ($row['d_note']) {
                                                case 1:
                                                    $note = "ไม่ทราบ";
                                                    break;
                                                case 2:
                                                    $note = "ไม่กินอาหาร ไม่ดื่มน้ำ";
                                                    break;
                                                case 3:
                                                    $note = "ตัวผอมลง น้ำหนักลด";
                                                    break;
                                                case 4:
                                                    $note = "มีอาการง่วง หรือหลับตลอด";
                                                    break;
                                                case 5:
                                                    $note = "ขนร่วงจนเห็นผิวหนัง";
                                                    break;
                                                case 6:
                                                    $note = "ท้องเสีย ถ่ายเป็นน้ำบ่อยๆ";
                                                    break;
                                            }
                                            echo '<span class="badge-pill "  style="font-size:12pt"><a = "?d_id=' . $row['d_id'] . '&d_note=' . $row['d_note'] . '"  style="color: #000000;">' . $note . '</a></span>';
                                        }
                                        ?>

                                    </td>
                                    <td>
                                    <?php
                                                            // Calculate the remaining chickens
                                        $remaining_chickens = $row['d_num'] - $row['d_total'];
                                        echo "" . $remaining_chickens;
                                            ?>

                                    </td>
                                    <td><?php  echo date('d-m-Y', strtotime($row['d_date'])); ?></td>
                                    <td><?php echo $row['mem_name'] ?></td>
                                    <td>
                                        <a href="edit_d_chicken.php?id=<?= $row['d_id']; ?>" class="link-Info"><i class="fa-solid fa-pen-to-square fs-5 me-3 "></i></a>
                                    </td>

                                    <td>
                                        <a data-id="<?= $row['d_id']; ?>" href="?delete=<?= $row['d_id']; ?>" class="btn  btn-danger delete-btn fa-solid fa-trash-can "></a>

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
                                url: 'd_chicken.php',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'Data deleted successfully!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'd_chicken.php';
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