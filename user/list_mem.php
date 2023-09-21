<?php
$menu = "member"
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

    // Check if the user being deleted is an administrator
    $checkAdminQuery = $conn->query("SELECT mem_sta FROM `tbl_member` WHERE mem_id = $id");
    $userData = $checkAdminQuery->fetch_assoc();
    $isAdministrator = $userData['mem_sta'] == 1;

    // Check the number of administrators in the database
    $adminCountQuery = $conn->query("SELECT COUNT(*) AS adminCount FROM `tbl_member` WHERE mem_sta = 1");
    $adminCountData = $adminCountQuery->fetch_assoc();
    $adminCount = $adminCountData['adminCount'];

    if ($isAdministrator && $adminCount <= 1) {
        echo "<script>alert('There must be at least one administrator. You cannot delete this user.');</script>";
    } else {
        $sql = $conn->query("DELETE FROM `tbl_member` WHERE mem_id = $id");
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('Data has been deleted successfully');</script>";
            $_SESSION['success'] = "Data has been deleted successfully";
            header("refresh:1; url=lsit_mem.php");
        }
    }
}
?>
<div class="card card-Light ">
    <section class="content-header  mt-3">
    <div class="small-box " style="background-color: #F95433; color:  FFFFFF ">
        <div class="inner">
            <h3>ผู้ใช้งาน</h3>
            <p>ตารางข้อมูลผู้ใช้งาน</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-plus text-light"></i>
        </div>
        <a href="test.php" class="small-box-footer">
            <i class="fa fa-arrow-circle-left"> </i>
        </a>
        
    </section>
</div> 
<!-- Main content -->
<section class="content">
    <div class="card card-Light ">
        <div class="card-header ">
            <h3 class="card-title">รายการเพิ่มข้อมูล ผู้ใช้งาน</h3>
            <div align="right">
                        <a href="printmem.php" target="_blank">
                            <button type="button" class="btn btn-outline-success">
                                <i class="fa-solid fa-print fa-xl" style="color: #0058f0;"></i> Print
                            </button>
                        </a>

                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>

            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">


                <table id="example" class="table table-striped table-bordered"  style="width:90%">
                        <thead>
                            <tr >
                                <th>id</th>
                                <th>ไอดีผู้ใช้งาน</th>
                                <th>ชื่อผู้ใช้งาน</th>
                                <th style="width:20%;">ที่อยู่</th>
                                <th>เบอร์โทร</th>
                                <th>เพศ</th>
                                <th>ระดับการใช้งาน</th>
                                <th style="width:5%;">edit</th>
                                <th style="width:5%;">delete</th>
                            </tr>
                        </thead>

                        <tbody>


                            <?php
                            include "db.php";
                            $sql = "SELECT * FROM `tbl_member`";
                            $result = mysqli_query($conn, $sql);
                            // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Count the number of administrators
                                $adminCountQuery = $conn->query("SELECT COUNT(*) AS adminCount FROM `tbl_member` WHERE mem_sta = 1");
                                $adminCountData = $adminCountQuery->fetch_assoc();
                                $adminCount = $adminCountData['adminCount'];
                            
                                // Check if the user is an administrator
                                $isAdministrator = $row['mem_sta'] == 1;
                            
                                // Disable the delete button for administrators when there is only one administrator
                                $disableDeleteButton = $isAdministrator && $adminCount <= 1;

                                // Check if the user is an administrator
                                $isAdministrator = $row['mem_sta'] == 1;

                                // Disable the edit button for administrators when there is only one administrator
                                $disableEditButton = $isAdministrator && $adminCount <= 1;
                            
                                ?>
                                <tr readonly >

                                    <td><?php echo $row['mem_id'] ?></td>
                                    <td><?php echo $row['mem_username'] ?></td>
                                    <td><?php echo $row['mem_name'] ?></td>
                                    <td><?php echo $row['mem_add'] ?></td>
                                    <td><?php 
                                        if($row['mem_tel'] == ''){
                                            echo '-';
                                        }else{
                                            echo ''.$row['mem_tel'];
                                        }
                                    
                                    ?></td>
                                    <td >
                                        <?php

                                        if($row['mem_gender'] == '')  {
                                            echo '-';
                                        } elseif($row['mem_gender'] == 1) {
                                            echo '<a  style="font: size 12pt"><a ?mem_id=' . $row['mem_id'] . '&mem_gender=1"  style="color: fffff" >ชาย</a>';
                                        }else{
                                            echo '<a   style="font-size:12pt"><a ?mem_id=' . $row['mem_id'] . '&mem_gender=2"  style="color: fffff">หญิง</a>';
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <?php

                                        if ($row['mem_sta'] == 1) {
                                            echo '<span class="badge-pill badge-danger"  style="font: size 12pt"><a ?mem_id=' . $row['mem_id'] . '&mem_sta=1"  style="color: fffff" >ผู้ดูแลระบบ</a></span>';
                                        } else {
                                            echo '<span class="badge-pill badge-success"  style="font-size:12pt"><a ?mem_id=' . $row['mem_id'] . '&mem_sta=2"  style="color: fffff">พนักงาน</a></span>';
                                        }
                                        ?>
                                    </td>
                                    <style>
                                    .untouchable-text {
                                        color: red; /* Apply red color */
                                        font-weight: bold; /* Optionally make it bold */
                                    }
                                </style>
                                        <td>
                                            <?php if (!$disableEditButton) : ?>
                                                <a href="edit_mem.php?id=<?= $row['mem_id']; ?>" class="link-Info"><i class="fa fa-edit"></i></a>
                                                <?php else : ?>
                                                <span class="untouchable-text">untouchable</span>
                                            <?php endif; ?>
                                        </td>

                                    <td>
                                        <?php if (!$disableDeleteButton) : ?>
                                            <a data-id="<?= $row['mem_id']; ?>" data-status="<?= $row['mem_sta']; ?>" href="?delete=<?= $row['mem_id']; ?>" class="btn btn-danger delete-btn fa-solid fa-trash-can"></a>
                                            <?php else : ?>
                                                <span class="untouchable-text">untouchable</span>
                                        <?php endif; ?>
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
        $mem_username = $_POST['mem_username'];
        $mem_password = $_POST['mem_password'];
        $mem_name = $_POST['mem_name'];
        $mem_add = $_POST['mem_add'];
        $mem_tel = $_POST['mem_tel'];
        $mem_gender = $_POST['mem_gender'];
        $mem_sta = $_POST['mem_sta'];

        //เช็คข้อมูลซ้ำ
        $sql = "SELECT * FROM `tbl_member` WHERE mem_username='$mem_username' ";
        $result = mysqli_query($conn, $sql);
        //echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result); 

        if (mysqli_num_rows($result) > 0) {
            echo "<script>";
            echo "Swal.fire({
                        icon: 'error',
                        title: 'ไอดีผู้ใช้งานนี้ถูกใช้แล้ว กรุณาตั้งไอดีไหม่',
                        showConfirmButton: false,             
                        })";
            echo "</script>";
            header("refresh:1 ; url=list_mem.php");
        } else {
            $sql = "INSERT INTO `tbl_member`(`mem_username`, `mem_password`, `mem_name`, `mem_add`, `mem_tel`, `mem_gender`, `mem_sta`) 
                    VALUES ('$mem_username','$mem_password','$mem_name','$mem_add','$mem_tel','$mem_gender','$mem_sta')";
            $result = mysqli_query($conn, $sql);


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
                header("refresh:1 ; url=list_mem.php");
            } else {
                $_SESSION['error'] = "Data has not been inserted successfully";
                header("Location: list_mem.php");
            }
        }
    }

    ?>

    <div class="modal fade" id="exampleModal" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <form action="list_mem.php" method="POST">
                <input type="hidden" name="member" value="add">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">

                            <div class="row">
                                <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">ไอดีผู้ใช้งาน</label>
                                    <input type="text" class="form-control" name="mem_username" placeholder="mem_username">
                                </div>
                                <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">รหัส</label>
                                    <input type="Password" class="form-control" name="mem_password" placeholder="Password">
                                </div>
                                <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">ชื่อผู้ใช้งาน</label>
                                    <input type="text" class="form-control" name="mem_name" placeholder="mem_name">
                                </div>
                                <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">ที่อยู่</label>
                                    <input type="text" class="form-control" name="mem_add" placeholder="mem_add">
                                </div>
                                <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">เบอร์โทร</label>
                                    <input type="text" class="form-control" name="mem_tel" placeholder="mem_tel">
                                </div>
                                <div class="col-10" style="margin:0.8rem 0 ;">
                                    <label clas="form-lable">เพศ</label>
                                    <select class="form-control select2" name="mem_gender" id="mem_gender" required>
                                    <option value="">-- เลือกเพศ --</option>
                                        <option value="1">ชาย</option>
                                        <option value="2">หญิง</option>
                                    </select>
                                </div>
                                <div class="col-10" style="margin:0.8rem 0 ;">
                                    <label clas="form-lable">ระดับการใช้งาน </label>
                                    <select class="form-control select2" name="mem_sta" id="mem_sta" required>
                                        <option value="">-- เลือกประเภท --</option>
                                        <option value="1">ผู้ดูแลระบบ(Admin)</option>
                                        <option value="2">พนักงาน</option>

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

 <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(".delete-btn").click(function(e) {
        var userId = $(this).data('id');
        e.preventDefault();
        
        // Allow deletion for all users, including administrators
        deleteConfirm(userId);
    });

    function deleteConfirm(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this user?",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            url: 'list_mem.php',
                            type: 'GET',
                            data: 'delete=' + userId,
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'ลบข้อมูล',
                                text: 'Data deleted',
                            }).then(() => {
                                document.location.href = 'list_mem.php';
                            })
                        })
                });
            },
        });
    }
</script>


    </html>