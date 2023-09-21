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
            $d_total = $_POST['d_total'];
            $d_note = $_POST['d_note'];
            $d_date = $_POST['d_date'];

                $sql = "UPDATE `d_chicken` SET `d_total`='$d_total',`d_note`='$d_note',`d_date`='$d_date'
                          WHERE d_id = $id";
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
                    header("refresh:1 ; url=care.php");
                } else {
                    $_SESSION['error'] = "Data has not been inserted successfully";
                    header("Location: care.php");
                }
            }
        ?>

        <div class="card-body">
            <div class="row">
                <div class="col-md-9">

                    <form action="" method="post" style="width:40vw;">
                    <?php
                        $sql = "SELECT d.d_id ,h.hou_name,z.zon_num, d.d_total ,d.d_note ,d.d_date                            
                                FROM d_chicken as d 
                                INNER JOIN house as h ON d.hou_id = h.hou_id
                                INNER JOIN zone as z ON d.zon_id = z.zon_id 
                                WHERE  d.d_id = $id LIMIT 1";
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
                                <input type="number" class="form-control" name="d_total" value="<?php echo $row['d_total'] ?>">
                            </div>


                            <div class="col-8" style="margin:0.8rem 0 ;">
                        <label style="margin-right: 1.5rem;">อาการ:</label> <br>
                        <select class="ui dropdown" name="d_note">
                            <option value="1" <?php echo ($row['d_note'] == '1') ? "selected" : ""; ?>>ไม่ทราบ</option>
                            <option value="2" <?php echo ($row['d_note'] == '2') ? "selected" : ""; ?>>ไม่กินอาหาร ไม่ดื่มน้ำ</option>
                            <option value="3" <?php echo ($row['d_note'] == '3') ? "selected" : ""; ?>>ตัวผอมลง น้ำหนักลด</option>
                            <option value="4" <?php echo ($row['d_note'] == '4') ? "selected" : ""; ?>>มีอาการง่วง หรือหลับตลอด</option>
                            <option value="5" <?php echo ($row['d_note'] == '5') ? "selected" : ""; ?>>ขนร่วงจนเห็นผิวหนัง</option>
                            <option value="6" <?php echo ($row['d_note'] == '6') ? "selected" : ""; ?>>ท้องเสีย ถ่ายเป็นน้ำบ่อยๆ</option>
                        </select>
                    </div>

                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label class="form-lable">เวลา</label>
                                <input type="date" class="form-control" name="d_date" value="<?php echo $row['d_date'] ?>">
                            </div>

                            
                        </div>

                        <br><button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                        <a href="care.php" class="btn btn-danger">กลับ</a>

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