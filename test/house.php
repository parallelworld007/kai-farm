
<?php
ob_start();
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<?php 

if (!$_SESSION["mem_id"]){

	  Header("Location: login.php");

}else{?>


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
<section class="content-header">
    <div class="container-fluid">
        <h1>เพิ่มข้อมูลไก่</h1>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="card card-gray">
        <div class="card-header ">
            <h3 class="card-title">รายการเพิ่มข้อมูลไก่</h3>
            <div align="right">

                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>

            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-9">


                <table id="example1" class="table table-bordered  table-hover table-striped">
                        <thead>
                            <tr class="info">
                                <th>id</th>
                                <th>name</th>
                                <th>date</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                        </thead>

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
                                    <?php
                                    if ($row['hou_sta'] == "พร้อมขาย") {
                                    ?><td style="color: green;text-shadow: green 0em 0em 0.5em"><?php echo $row['hou_sta']; ?></td>
                                    <?php } else {
                                    ?> <td style="color: red;text-shadow: red 0em 0em 0.5em""><?php echo $row['hou_sta']; ?></td> <?php } ?>
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
        $hou_sta = $_POST['hou_sta'];

        //เช็คข้อมูลซ้ำ
        $sql = "SELECT * FROM `house` WHERE hou_name='$hou_name' ";
        $result =mysqli_query($conn, $sql);
        //echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result); 

        if (mysqli_num_rows($result) > 0) {
            echo "<script>";
            echo "Swal.fire({
                        icon: 'error',
                        title: 'ชื่อโรงเรือน นี้มีในมีอยู่ตารางแล้ว',
                        showConfirmButton: false,                
                        })";
            echo "</script>";
            header("refresh:1 ; url=house.php");
        } else {
            $sql = "INSERT INTO  house (hou_id,hou_name, hou_sta) 
                    VALUES (NULL, '$hou_name','$hou_sta')";
            $result =mysqli_query($conn, $sql);


            if ($sql) {
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
            } else {
                $_SESSION['error'] = "Data has not been inserted successfully";
                header("Location: house.php");
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
                                <div class="col">
                                    <label class="form-lable">ชื่อโรงเรือน</label>
                                    <input type="text" class="form-control" name="hou_name" placeholder="โปรดใส่ข้อมูล" required>
                                </div>
                            </div>


                            <div class="form-groud" style="padding: 1rem; font-size:18px;">
                                <label style="margin-right: 1.5rem;">Status:</label>
                                <input type="radio" class="form-check-input btn-info" name="hou_sta" id="พร้อมขาย" value="พร้อมขาย" required>
                                <label style="margin-right: 1.5rem;" for="พร้อมขาย" class="form-input-lable">พร้อมขาย</label>

                                <input type="radio" class="form-check-input btn-info" name="hou_sta" id="ไม่พร้อมขาย" value="ไม่พร้อมขาย" required>
                                <label class="form-input-lable" for="ไม่พร้อมขาย">ไม่พร้อมขาย</label>
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
    <?php }?>