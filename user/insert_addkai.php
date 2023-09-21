<?php
ob_start();
$menu = "addkai"
?>

<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="small-box bg-gradient-olive">
        <div class="inner">
            <h3>เพิ่ม</h3>
            <p>ตารางแก้ไขข้อมูล</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-plus text-light"></i>
        </div>
        <a class="small-box-footer">
            <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</section>

<div class="card-body">
    <div class="row">
        <div class="col-md-9">
            <form action="" method="post" style="width:40vw;">
            <?php
                // ตรวจสอบว่ามีการกด submit หรือไม่
                if (isset($_POST['submit'])) {
                    include "db.php";

                    // รับค่าจากฟอร์ม
                    $hou_id = $_POST['hou_id'];
                    $zon_id = $_POST['zon_id'];
                    $adc_num = $_POST['adc_num'];
                    $adc_date = $_POST['adc_date'];

                    // แปลงค่า adc_date ให้เป็น timestamp
                    $adc_date_timestamp = strtotime($adc_date);

                    // เพิ่ม 2 ปีให้กับ timestamp เพื่อหาวันที่ adc_sell
                    $adc_datesell_timestamp = strtotime('+2 years', $adc_date_timestamp);

                    // แปลง timestamp เป็นรูปแบบวันที่ที่ต้องการ
                    $adc_datesell = date('Y-m-d', $adc_datesell_timestamp);

                    // ให้ $adc_total เท่ากับค่าที่ผู้ใช้ป้อนในฟิลด์ "จำนวนไก่ที่เพิ่ม"
                    $adc_total = $_POST['adc_num']; // ให้ adc_total เท่ากับ adc_num

                    $adc_d = $_POST['adc_d'];
                    $adc_sell = $_POST['adc_sell'];
                    $mem_id = $_POST['mem_id'];

                    // ทำการ INSERT ข้อมูลลงในฐานข้อมูล
                    $sql = "INSERT INTO `add_chicken`(`hou_id`, `zon_id`, `adc_num`, `adc_date`, `adc_datesell`, 
                                                    `adc_total`, `adc_d`, `adc_sell`, `mem_id`) 
                                        VALUES ('$hou_id','$zon_id','$adc_num','$adc_date','$adc_datesell','$adc_total','$adc_d','$adc_sell','$mem_id')";
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
                        header("refresh:1 ; url=addkai.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("Location: addkai.php");
                    }
                }
                ?>


                <?php
                $zone = $_GET['id'];
                $zone = $_GET['name'];
                include("db.php");
                $sql = "SELECT  h.hou_id,h.hou_name, z.zon_id,z.zon_num                  
                                FROM zone as z
                                LEFT JOIN house as h ON z.hou_id = h.hou_id
                                Where z.zon_id = $zone 
                                ";

                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="row">
                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <label class="form-lable">โรงเรือน</label>
                        <select name="hou_id" class="form-control" readonly>
                            <?php foreach ($result as $row) { ?>
                                <option value="<?= $row['hou_id']; ?>"><?= $row['hou_name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php
                        ?>
                    </div>
                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <label class="form-lable">โรงเรือน</label>
                        <select name="zon_id" class="form-control" readonly>
                            <?php foreach ($result as $row) { ?>
                                <option value="<?= $row['zon_id']; ?>"><?= $row['zon_num']; ?></option>
                            <?php } ?>
                        </select>
                        <?php
                        ?>
                    </div>

                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <label class="form-lable">จำนวนไก่ที่เพิ่ม</label>
                        <input type="text" class="form-control" name="adc_num" placeholder="โปรดใส่ข้อมูล" required>
                    </div>

                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <label class="form-lable">วันที่นำเข้า</label>
                        <input type="date" class="form-control" name="adc_date">
                    </div>


                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <label class="form-lable">จำนวนไก่ตาย</label>
                        <input type="number" class="form-control" name="adc_d" value="0" readonly>
                    </div>

                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <label class="form-lable">จำนวนไก่ขาย</label>
                        <input type="number" class="form-control" name="adc_sell" value="0" readonly>
                    </div>

                    <div class="col-8" style="margin: 0.8rem 0;">
                        <input type="text" class="form-control" name="mem_id" value="<?php echo $_SESSION['mem_id']; ?>" readonly style="display: none;">
                    </div>



                </div>

                <div>
                    <button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                    <a href="addkai.php" class="btn btn-danger">กลับ</a>
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
