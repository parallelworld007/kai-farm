<?php
ob_start();
$menu = "sales"
?>

<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="small-box bg-gradient-olive">
        <div class="inner">
            <h3>ขายสินค้า</h3>
            <p>ตารางแก้ไขข้อมูล</p>
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

                    $s_totalnow = $_POST['s_totalnow']; #จำนวนที่เคยเพิ่ม
                    $s_total = $_POST['s_total']; #จำนวนที่จะส่งไปเพิ่ม

                    $s_total1 = $s_totalnow + $s_total;

                    $newnum = $_POST['s_num'];

                    $o_qty = $_POST['o_qty'];

                    $o_qtyl = $o_qty - $s_total1;
                    
                    
                    echo $s_total1;

                    echo $o_qtyl;
                    // ตรวจสอบว่าจำนวนไก่ที่ตายต้องไม่มากกว่าจำนวนไก่คงเหลือ
                    $sql_check = "SELECT adc_total FROM add_chicken WHERE adc_id = $adc_id";
                    $result_check = mysqli_query($conn, $sql_check);
                    $row_check = mysqli_fetch_assoc($result_check);
                    $adc_total_remaining = $row_check['adc_total'] - $s_total;
                    $mem_id = $_POST['mem_id'];
                    $o_id = $_POST['o_id'];
                    // Calculate the cumulative total
                    $update_o_id = $_POST['o_id'];

                    if ($o_qtyl == 0) {
                        $update_sql_o_wait = "UPDATE order_head SET o_wait = 'ชำระเงินแล้ว' WHERE o_id = $update_o_id";
                        mysqli_query($conn, $update_sql_o_wait);
                    }

                    if ($adc_total_remaining < 0) {
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลได้',
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            window.location.href = 'addkaisell.php?o_id=" . $o_id . "';
                        });";
                        echo "</script>";
                    } else {
                        // ดำเนินการ INSERT หรือ UPDATE ข้อมูลตามปกติ
                        $sql = "INSERT INTO `s_chicken`(`hou_id`, `zon_id`, `adc_id`, `s_total`, s_num, `s_date` , mem_id,o_id )
                                VALUES ('$hou_id', '$zon_id', '$adc_id','$s_total' , '$newnum' , NOW(), '$mem_id', '$o_id') ";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            include "db.php";
                            $sql5 = "SELECT ad.adc_id, ad.adc_total,z.zon_id,d.s_id,d.s_total,ad.mem_id
                                     FROM s_chicken as d
                                     JOIN zone as z ON d.zon_id = z.zon_id 
                                     JOIN add_chicken as ad ON d.adc_id = ad.adc_id 
                                     WHERE ad.adc_id = d.adc_id";
                            $result = mysqli_query($conn, $sql5);

                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $row) {
                                    if ($row['adc_id'] == $adc_id && $row['zon_id'] == $zon_id) {
                                        $new_adc_total = $row_check['adc_total'] - $s_total;
                                        // ตรวจสอบว่า new_adc_total มากกว่าหรือเท่ากับ 0 ก่อนทำการอัพเดต
                                        if ($new_adc_total >= 0) {
                                            $update_sql = "UPDATE add_chicken SET adc_total = $new_adc_total WHERE adc_id = $adc_id";
                                            $update_sql2 = "UPDATE add_chicken
                                            JOIN (
                                                SELECT adc_id, SUM(s_total) AS total_sum
                                                FROM s_chicken
                                                GROUP BY adc_id
                                            ) AS summed_data
                                            ON add_chicken.adc_id = summed_data.adc_id
                                            SET add_chicken.adc_sell = summed_data.total_sum;";
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
                                                window.location.href = 'addkaisell.php?o_id=" . $o_id . "';
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
                $o_id = $_GET['o_id'];

                include("db.php");
                $sql = "SELECT  h.hou_id,h.hou_name,z.zon_id,z.zon_num,ad.adc_id,ad.adc_total,order_head.o_id               
                FROM zone as z
                LEFT JOIN house as h ON z.hou_id = h.hou_id
                LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
                JOIN order_head ON order_head.o_id = order_head.o_id
                        Where z.zon_id = $zone and order_head.o_id = $o_id
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

$sql = "SELECT  h.hou_id,h.hou_name,z.zon_id,z.zon_num,ad.adc_id,ad.adc_total,order_head.o_id,order_head.o_wait,order_head.o_qty              
        FROM zone as z
        LEFT JOIN house as h ON z.hou_id = h.hou_id
        LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
        JOIN order_head ON order_head.o_id = order_head.o_id
        Where z.zon_id = $zone and order_head.o_id = $o_id";

$sql1 = "SELECT  s_chicken.s_total                
        FROM order_head 
        JOIN s_chicken ON order_head.o_id = s_chicken.o_id
        Where order_head.o_id = $o_id";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

// Create a variable to store o_qty and set it to 0 if s_total is not available
$o_qty = isset($row['o_qty']) ? $row['o_qty'] : 0;
$s_total = isset($row1['s_total']) ? $row1['s_total'] : 0;

$num = $o_qty-$s_total
?>

                    <div class="col-8" style="margin: 0.8rem 0;">
                        <label class="form-lable">จำนวนที่ขาย</label>
                        <input type="text" class="form-control" name="s_total" value="<?= min($num, $row['adc_total']) ?>" required oninput="validateInput(this);" data-adc-total="<?= $row['adc_total']; ?>">

                        
                    </div>


                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <label class="form-lable">ไก่ที่เหลือ</label>
                        <input type="number" class="form-control" name="s_num" value="<?= $row['adc_total']; ?>" readonly>
                    </div>
                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <label class="form-lable">จำนวนไก่ที่สั่งซื้อ</label>
                        <input type="number" class="form-control" name="o_qty" value="<?= $row['o_qty']; ?>" readonly>
                    </div>
                    <div class="col-8" style="margin:0.8rem 0 ;">
    <label class="form-lable">จำนวนไก่ที่เคยลบจากตารางอื่น</label>
    <input type="number" class="form-control" name="s_totalnow" value="<?= empty($row1['s_total']) ? 0 : $row1['s_total']; ?>" readonly>
</div>

                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <input type="text" class="form-control" name="mem_id" value="<?php echo $_SESSION['mem_id']; ?>" readonly style="display: none;">
                    </div>
                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <input type="number" class="form-control" name="o_id" value="<?= $row['o_id']; ?>" readonly style="display: none;">
                    </div>
                   


                    <div class="col-8" style="margin:0.8rem 0 ;">
                        <input type="text" class="form-control" name="o_wait" value="ชำระเงินแล้ว" readonly style="display: none;">
                    </div>
                </div>

                <div>
                    <button id="submit" name="submit" type="submit" class="btn btn-primary"> ยืนยัน</button>

                    <?php


                    echo '<a href="addkaisell.php?o_id=' . $row['o_id'] . '" class="btn btn-danger">กลับ</a>';
                    ?>
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
<script>
    function validateInput(input) {
        var enteredValue = parseInt(input.value, 10);
        var adcTotal = parseInt(input.getAttribute('data-adc-total'), 10);

        if (isNaN(enteredValue)) {
            input.value = '';
        } else if (enteredValue > adcTotal) {
            input.value = adcTotal.toString();
            alert("จำนวนไก่ไม่เพียงพอ");
        }
    }
</script>

</html>