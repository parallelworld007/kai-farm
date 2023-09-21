<?php
ob_start();
$menu = "member"
?>

<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="small-box bg-gradient-olive">
        <div class="inner">
            <h3>แก้ไขข้อมูลผู้ใช้งาน</h3>
            <p>ตารางแก้ไขข้อมูล</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-plus text-light"></i>
        </div>
        <a class="small-box-footer">
            <i class="fas fa-arrow-circle-right"></i>
        </a>
</section>
<!-- Main content -->
<section class="content">
    <div class="card card-gray">
        <br>

        <?php
        include "db.php";
        $id = $_GET['id'];

        if (isset($_POST['submit'])) {
            $mem_username = $_POST['mem_username'];
            $mem_password = $_POST['mem_password'];
            $mem_name = $_POST['mem_name'];
            $mem_add = $_POST['mem_add'];
            $mem_tel = $_POST['mem_tel'];
            $mem_gender = $_POST['mem_gender'];
            $mem_sta = $_POST['mem_sta'];

            $sql = "UPDATE `tbl_member` SET `mem_username`='$mem_username',`mem_password`='$mem_password',
             `mem_name`='$mem_name',`mem_add`='$mem_add',`mem_tel`='$mem_tel',`mem_gender`='$mem_gender',`mem_sta`='$mem_sta' WHERE mem_id = $id";

            $result = mysqli_query($conn, $sql);


            if ($sql) {
                $_SESSION['success'] = "Data has been inserted successfully";
                echo "<script>";
                echo "Swal.fire({
                        icon: 'success',
                        title: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
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
        ?>

        <div class="card-body">
            <div class="row">
                <div class="col-md-9">

                    <form action="" method="post" style="width:40vw;">



                        <?php
                        $id  = $_GET['id'];
                        $sql = "SELECT * FROM `tbl_member` WHERE  mem_id = $id LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        ?>


                        <div class="row">
                            <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                <label class="form-lable">ไอดีผู้ใช้งาน</label>
                                <input type="text" class="form-control" name="mem_username" placeholder="mem_username" value="<?php echo $row['mem_username'] ?>">
                            </div>
                            <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                <label class="form-lable">รหัส</label>
                                <input type="Password" class="form-control" name="mem_password" placeholder="Password" value="<?php echo $row['mem_password'] ?>">
                            </div>
                            <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                <label class="form-lable">ชื่อผู้ใช้งาน</label>
                                <input type="text" class="form-control" name="mem_name" placeholder="mem_name" value="<?php echo $row['mem_name'] ?>">
                            </div>
                            <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                <label class="form-lable">ที่อยู่</label>
                                <input type="text" class="form-control" name="mem_add" placeholder="mem_add" value="<?php echo $row['mem_add'] ?>">
                            </div>
                            <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                <label class="form-lable">เบอร์โทร</label>
                                <input type="text" class="form-control" name="mem_tel" placeholder="mem_tel" value="<?php echo $row['mem_tel'] ?>">
                            </div>
                            <div class="col-10" style="margin:0.8rem 0 ;">
                                    <label clas="form-lable">เพศ</label>
                                    <select class="form-control select2" name="mem_gender" id="mem_gender" required>
                                        <option value="1" <?php echo ($row['mem_gender'] == '1') ? "selected" : ""; ?>>ชาย</option>
                                        <option value="2" <?php echo ($row['mem_gender'] == '2') ? "selected" : ""; ?>>หญิง</option>
                                    </select>
                            </div>
                            <div class="col-10" style="margin:0.8rem 0 ;">
                                <label for="mem_sta" style="margin-right: 1.5rem;">ระดับการใช้งาน:</label>
                                <select class="form-control" name="mem_sta" id="mem_sta" required>
                                    <option value="1" <?php echo ($row['mem_sta'] == '1') ? "selected" : ""; ?>>ผู้ดูแลระบบ</option>
                                    <option value="2" <?php echo ($row['mem_sta'] == '2') ? "selected" : ""; ?>>ผู้ใช้งาน</option>
                                </select>
                            </div>                 
                        </div>


                        <br><button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                        <a href="list_mem.php" class="btn btn-danger">กลับ</a>

                </div>

                </form>



            </div>
        </div>

    </div>
    <div class="card-footer">
        ---------
    </div>

    </div>
    <?php include('footer.php'); ?>
    </body>

    </html>