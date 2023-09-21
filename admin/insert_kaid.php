<?php
ob_start();
$menu = "d_chicken"
?>

<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="small-box bg-gradient-olive">
        <div class="inner">
            <h3>เพิ่มข้อมูลไก่ตาย</h3>
            <p>ตารางเพิ่มข้อมูลไก่ตาย</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-plus text-light"></i>
        </div>
        <a class="small-box-footer">
            <i class="fas fa-arrow-circle-right"></i>
        </a>
</section>

<div class="card-body">
    <div class="row">
        <div class="col-md-9">

            <form action="" method="post" style="width:40vw;">



            <?php
                include "db.php";
                if (isset($_POST['submit'])) {
                    $hou_id = $_POST['hou_id'];
                    $zon_id = $_POST['zon_id'];
                    $adc_id = $_POST['adc_id'];
                    $d_total = $_POST['d_total'];
                    $d_note = $_POST['d_note'];
                    $newnum = $_POST['d_num'];
                    
                    // ตรวจสอบว่าจำนวนไก่ที่ตายต้องไม่มากกว่าจำนวนไก่คงเหลือ
                    $sql_check = "SELECT adc_total FROM add_chicken WHERE adc_id = $adc_id";
                    $result_check = mysqli_query($conn, $sql_check);
                    $row_check = mysqli_fetch_assoc($result_check);
                    $adc_total_remaining = $row_check['adc_total'] - $d_total;
                    $mem_id = $_POST['mem_id'];
                     // Calculate the cumulative total
                     
                    
                    if ($adc_total_remaining < 0) {
                        echo "<script>"; 
                        echo "Swal.fire({
                                icon: 'error',
                                title: 'ไม่สารถเพิ่มข้อมูลได้',
                                showConfirmButton: false, 
                                timer: 1500,
                                }).then(() => {
                                window.location.href = 'addkai.php';
                                });";
                        echo "</script>";
                    } else {
                        // ดำเนินการ INSERT หรือ UPDATE ข้อมูลตามปกติ
                        $sql = "INSERT INTO `d_chicken`(`hou_id`, `zon_id`, `adc_id`, `d_total`, `d_note`, d_num, `d_date` , mem_id)
                                VALUES ('$hou_id', '$zon_id', '$adc_id', '$d_total', '$d_note' , '$newnum' , NOW(), '$mem_id')";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            include "db.php";
                            $sql5 = "SELECT ad.adc_id, ad.adc_total,z.zon_id,d.d_id,d.d_total,ad.mem_id
                                     FROM d_chicken as d
                                     JOIN zone as z ON d.zon_id = z.zon_id 
                                     JOIN add_chicken as ad ON d.adc_id = ad.adc_id 
                                     WHERE ad.adc_id = d.adc_id";
                            $result = mysqli_query($conn, $sql5);

                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $row) {
                                    if ($row['adc_id'] == $adc_id && $row['zon_id'] == $zon_id) {
                                        $adc_total_remaining = $row_check['adc_total'] - $d_total;
                                        // ตรวจสอบว่า adc_total_remaining มากกว่าหรือเท่ากับ 0 ก่อนทำการอัพเดต
                                        if ($adc_total_remaining >= 0) {
                                            $update_sql = "UPDATE add_chicken SET adc_total = $adc_total_remaining WHERE adc_id = $adc_id";
                                            $update_sql2 = "UPDATE add_chicken
                                            JOIN (
                                                SELECT adc_id, SUM(d_total) AS total_sum
                                                FROM d_chicken
                                                GROUP BY adc_id
                                            ) AS summed_data
                                            ON add_chicken.adc_id = summed_data.adc_id
                                            SET add_chicken.adc_d = summed_data.total_sum;";
                                            mysqli_query($conn, $update_sql);
                                            mysqli_query($conn, $update_sql2);
                                            $_SESSION['success'] = "Data has been inserted success";
                                            echo "<script>";
                                            echo "Swal.fire({
                                                icon: 'success',
                                                title: 'เพิ่มข้อมูลได้',
                                                showConfirmButton: false,
                                                timer: 1500,
                                                }).then(() => {
                                                    window.location.href = 'addkai.php';
                                                });";
                                            echo "</script>";
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            ?>



                <?php
                $zone = $_GET['id'];
                $zone = $_GET['name'];
                $zone = $_GET['name'];

                include("db.php");
                $sql = "SELECT  h.hou_id,h.hou_name,z.zon_id,z.zon_num,ad.adc_id,ad.adc_total              
                        FROM zone as z
                        LEFT JOIN house as h ON z.hou_id = h.hou_id
                        LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
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

                        <label class="form-lable">โซน</label>
                        <select name="zon_id" class="form-control" readonly>
                            <?php foreach ($result as $row) { ?>
                                <option value="<?= $row['zon_id']; ?>"><?= $row['zon_num']; ?></option>
                            <?php } ?>
                        </select>

                        <?php

                        ?>
                    </div>

                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <input type="number" class="form-control" id="" name="adc_id" value="<?= $row['adc_id']; ?>" readonly style="display: none;">
                    </div>

                    <?php
                    $zone = $_GET['id'];
                    $zone = $_GET['name'];
                    $zone = $_GET['name'];

                    include("db.php");
                    $sql = "SELECT  h.hou_id,h.hou_name,z.zon_id,z.zon_num,ad.adc_id,ad.adc_total,d.d_id,d.d_total,d.d_note,ad.mem_id           
                        FROM zone as z
                        LEFT JOIN house as h ON z.hou_id = h.hou_id
                        LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
                        LEFT JOIN d_chicken as d ON z.zon_id = d.zon_id
                        Where z.zon_id = $zone
                                ";


                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>

                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <label class="form-lable">ไก่ที่เหลือ</label>
                        <input type="number" class="form-control" name="d_num" value="<?= $row['adc_total']; ?>" readonly>
                    </div>

                    <div class="col-8" style="margin: 0.8rem 0;">
                        <label class="form-lable">จำนวนไก่ที่ตาย</label>
                        <input type="text" class="form-control" name="d_total" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>


                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <label style="margin-right: 1.5rem;">สาเหตุ:</label> <br>
                        <select class="ui dropdown" name="d_note">
                            <option value="1">ไม่ทราบ</option>
                            <option value="2">ไม่กินอาหาร ไม่ดื่มน้ำ</option>
                            <option value="3">ตัวผอมลง น้ำหนักลด</option>
                            <option value="4">มีอาการง่วง หรือหลับตลอด</option>
                            <option value="5">ขนร่วงจนเห็นผิวหนัง</option>
                            <option value="6">ท้องเสีย ถ่ายเป็นน้ำบ่อยๆ</option>
                        </select>
                    </div>


                   <div class="col-8" style="margin:0.8rem 0 ;">
                                <input type="text" class="form-control"  name="mem_id" value="<?php echo $_SESSION['mem_id']; ?>" readonly style="display: none;">
                    </div>


                </div>

                <div>
                    <button id="submit" name="submit" type="submit" class="btn btn-primary"> ยืนยัน</button>

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