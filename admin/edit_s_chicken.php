<?php
ob_start();
$menu = "care"
?>

<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="small-box bg-gradient-olive">
        <div class="inner">
            <h3>แก้ไข</h3>
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
            $s_total = $_POST['s_total'];
            $s_date = $_POST['s_date'];

                $sql = "UPDATE `s_chicken` SET `s_total`='$s_total',`s_date`='$s_date'
                          WHERE s_id = $id";
                $result = mysqli_query($conn, $sql);


                if ($sql) {
                    $_SESSION['success'] = "Data has been inserted successfully";
                    echo "<script>";
                    echo "Swal.fire({
                            icon: 'success',
                            title: 'แก้ข้อมูลเรียบร้อยแล้ว',
                            showConfirmButton: false,
                            timer: 1500,
                            })";
                    echo "</script>";
                    header("refresh:1 ; url=s_chicken.php");
                } else {
                    $_SESSION['error'] = "Data has not been inserted successfully";
                    header("Location: s_chicken.php");
                }
            }
        ?>

        <div class="card-body">
            <div class="row">
                <div class="col-md-9">

                    <form action="" method="post" style="width:40vw;">
                    <?php
                        $sql = "SELECT d.s_id ,h.hou_name,z.zon_num, d.s_total ,d.s_date                            
                                FROM s_chicken as d 
                                INNER JOIN house as h ON d.hou_id = h.hou_id
                                INNER JOIN zone as z ON d.zon_id = z.zon_id 
                                WHERE  d.s_id = $id LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                    ?>

                    
                    <div class="row">
                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label class="form-lable">โรงเรือน</label>
                                <input type="text" class="form-control" name="hou_id" value="<?php echo $row['hou_name'] ?>" readonly>
                            </div>
                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label clas="form-lable">โซน</label>
                                <input type="text" class="form-control" name="zon_id" value="<?php echo $row['zon_num'] ?>" readonly>
                            </div>
                            
                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label clas="form-lable">จำนวนไก่ที่ตาย</label>
                                <input type="number" class="form-control" name="s_total" value="<?php echo $row['s_total'] ?>">
                            </div>

                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label class="form-lable">เวลา</label>
                                <input type="date" class="form-control" name="s_date" value="<?php echo $row['s_date'] ?>">
                            </div>

                            
                        </div>

                        <br><button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                        <a href="s_chicken.php" class="btn btn-danger">กลับ</a>

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