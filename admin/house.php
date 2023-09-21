<?php
$menu = "house"
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
    $sql = $conn->query("DELETE FROM `house` WHERE hou_id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=house.php");
    }
}
?>

</style>
<div class="card card-Light ">
    <section class="content-header mt-3">

        <div class="small-box" style="background-color: #87D819; color:  FFFFFF ">
            <div class="inner">
                <h3>โรงเรือน</h3>
                <p>ตารางข้อมูลโรงเรือน</p>
            </div>
            <div class="icon">
                <i class="fa fa-book text-light"></i>
            </div>
            <a href="test.php" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i></a>
        </div>

    </section>
</div>
<!-- Main content -->
<section class="content">
    <div class="card card-Light ">
        <div class="card-header ">
            <h3 class="card-title">รายการเพิ่มข้อมูล โรงเรือน</h3>
            <div align="right">

                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>

            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col">


                    <table id="example" class="table table-striped table-bordered" style="width:90%">


                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th style="width:20%;">ชื่อโรงเรือน</th>
                                <th style="width:5%;">Edit</th>
                                <th style="width:5%;">Delete</th>
                            </tr>
                        </thead>

                        <tbody>


                            <?php
                            include "db.php";
                            $sql = "SELECT * FROM `house`";
                            $result = mysqli_query($conn, $sql);
                            $i = 1;
                            // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr readonly>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['hou_name'] ?></td>

                                    </td>



                                    <td>
                                        <a href="edit_house.php?id=<?= $row['hou_id']; ?>" class="link-Info"><i class="fa-solid fa-pen-to-square fs-5 me-3 "></i></a>
                                    </td>

                                    <td>
                                        <a data-id="<?= $row['hou_id']; ?>" href="?delete=<?= $row['hou_id']; ?>" class="btn  btn-danger delete-btn fa-solid fa-trash-can "></a>

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

    <!-- เพิ่มโรงเรือน -->
    <?php
    include "db.php";
    if (isset($_POST['submit'])) {
        $hou_name = $_POST['hou_name'];
        $p_id = $_POST['p_id'];

        // Check for duplicate entries
        $sql = "SELECT * FROM `house` WHERE hou_name = '$hou_name'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>";
            echo "Swal.fire({
            icon: 'error',
            title: ' นี้มีในมีอยู่ตารางแล้ว',
            showConfirmButton: false,
        })";
            echo "</script>";
            header("refresh:1 ; url=house.php");
        } else {
            $sql = "INSERT INTO `house`(`hou_name`, `p_id`) VALUES ('$hou_name','$p_id')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $_SESSION['success'] = "Data has been inserted successfully";
                echo "<script>";
                echo "Swal.fire({
                icon: 'success',
                title: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
                showConfirmButton: false,
                timer: 1500,
            })";
                echo "</script>";
                header("refresh:1 ; url=house.php");
            } 
            }
        }
    ?>

    <div class="modal fade" id="exampleModal" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <form action="house.php" method="POST">
                <input type="hidden" name="member" value="add">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">

                            <div class="row">

                                <div class="col-8" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">ชื่อโรงเรือน</label>
                                    <input type="text" class="form-control" name="hou_name" placeholder="โปรดใส่ข้อมูล" required>
                                </div>
                            </div>




                            <div class="col-8" style="margin:0.8rem 0 ;">

                                <select name="p_id" class="form-control" required style="display: none;">
                                    <?php
                                    include "db.php";
                                    $sql = "SELECT p_id FROM product";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['p_id'] . '">' . $row['p_id'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                        </div>
                    </div>
            </form>
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
                                url: 'house.php',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'Data deleted successfully!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'house.php';
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