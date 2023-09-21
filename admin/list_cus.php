<?php
$menu = "customer"
?>


<?php
ob_start();
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>
<?php
require_once "db.php";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE FROM `tbl_customer` WHERE cus_id  = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=lsit_cus.php");
    }
}
?>

<div class="card card-Light ">
    <section class="content-header  mt-3">
        <div class="small-box" style="background-color: #FA61A0; color:  FFFFFF ">
            <div class="inner">
                <h3>ลูกค้า</h3>
                <p>ตารางข้อมูลลูกค้า</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus text-light"></i>
            </div>
            <a href="test.php" class="small-box-footer">
                <i class="fa fa-arrow-circle-left"></i>
            </a>
        </div>
    </section>
</div>
<!-- Main content -->
<section class="content">
    <div class="card card-Light ">
        <div class="card-header ">
            <h3 class="card-title">รายการเพิ่มข้อมูล ลูกค้า</h3>
            <div align="right">

                    
             
            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">


                    <table id="example" class="table table-striped table-bordered" style="width:90%">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>ไอดีลูกค้า</th>
                                <th>ชื่อลูกค้า</th>
                                <th>ที่อยู่</th>
                                <th>เบอร์โทร</th>
                                <th>เพศ</th>
                                <th style="width:5%;">edit</th>
                                <th style="width:5%;">delete</th>
                            </tr>
                        </thead>

                        <tbody>


                            <?php
                            include "db.php";
                            $sql = "SELECT * FROM `tbl_customer`";
                            $result = mysqli_query($conn, $sql);
                            // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr readonly>
                                    <td><?php echo $row['cus_id'] ?></td>
                                    <td><?php echo $row['cus_username'] ?></td>
                                    <td><?php echo $row['cus_name'] ?></td>
                                    <td><?php echo $row['cus_add'] ?></td>
                                    <td><?php echo $row['cus_tel'] ?></td>
                                    <td >
                                        <?php

                                        if($row['cus_gender'] == '')  {
                                            echo '-';
                                        } elseif($row['cus_gender'] == 1) {
                                            echo '<a  style="font: size 12pt"><a ?cus_id=' . $row['cus_id'] . '&cus_gender=1"  style="color: fffff" >ชาย</a>';
                                        }else{
                                            echo '<a   style="font-size:12pt"><a ?cus_id=' . $row['cus_id'] . '&cus_gender=2"  style="color: fffff">หญิง</a>';
                                        }
                                        ?>

                                    </td>

                                    <td>
                                        <a href="edit_cus.php?id=<?= $row['cus_id']; ?>" class="link-Info"><i class="fa-solid fa-pen-to-square fs-5 me-3 "></i></a>
                                    </td>

                                    <td>
                                        <a data-id="<?= $row['cus_id']; ?>" href="?delete=<?= $row['cus_id']; ?>" class="btn  btn-danger delete-btn fa-solid fa-trash-can "></a>

                                    </td>
                                </tr>
                            <?php

                            }
                            ?>

                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    </div>
    <div class="card-footer">
    </div>

    </div>

    

    <?php include('footer.php'); ?>

    </body>

    <!--sweetalert2 ลบข้อมูล -->
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
                                url: 'list_cus.php',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'Data deleted successfully!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'list_cus.php';
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

    </html>