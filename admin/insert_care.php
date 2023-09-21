<?php
ob_start();
$menu = "care"
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
                            $adc_id= $_POST['adc_id'];
                            $car_num = $_POST['car_num'];
                           
                        
                                              

                            $sql = "INSERT INTO `care`( `hou_id`, `zon_id`, `adc_id`,`car_num`) 
                            VALUES ('$hou_id','$zon_id','$adc_id','$car_num')";
                            $result = mysqli_query($conn, $sql);

                            if ($sql) {
                                $_SESSION['success'] = "Data has been inserted successfully";
                                echo "<script>";
                                echo "Swal.fire({
                                            icon: 'success',
                                            title: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
                                            showConfirmButton: false,
                                            timer: 1800,
                                            })";
                                echo "</script>";
                                header("refresh:1 ; url=care.php");
                            } else {
                                $_SESSION['error'] = "Data has not been inserted successfully";
                                header("Location: care.php");
                            }
                        }
                    ?>


                    <?php

                        $zone = $_GET['id'];
                        $zone = $_GET['name'];
                        $zone = $_GET['name'];                         
                             include("db.php");
                        $sql = "SELECT  h.hou_id,h.hou_name, z.zon_id,z.zon_num,ad.adc_id,ad.adc_num                       
                                FROM zone as z
                                LEFT JOIN house as h ON z.hou_id = h.hou_id
                                LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
                                Where z.zon_id = $zone 
                                " ;
         

                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);

                        
                      
                    ?>
                        <div class="row">
                        <div class="col-8" style="margin:0.8rem 0 ;">
                            
                            <label class="form-lable">โรงเรือน</label>
                            <select name="hou_id" class="form-control" readonly >
                                    <?php foreach ($result as $row) { ?>
                                        <option value="<?= $row['hou_id']; ?>"><?= $row['hou_name']; ?></option >
                                    <?php } ?> 
                                </select>
                                
                                <?php

                                ?>
                        </div>
                  
                        <div class="col-8" style="margin:0.8rem 0 ;">
                            
                            <label class="form-lable">โซน</label>
                            <select name="zon_id" class="form-control" readonly >
                                    <?php foreach ($result as $row) { ?>
                                        <option value="<?= $row['zon_id']; ?>"><?= $row['zon_num']; ?></option >
                                    <?php } ?> 
                                </select>
                                
                                <?php

                                ?>
                        </div>

                        <div class="col-8" style="margin:0.8rem 0 ;">
                            
                            <label class="form-lable">จำนวนไก่ที่เพิ่ม</label>
                            <select name="adc_id" class="form-control" readonly >
                                    <?php foreach ($result as $row) { ?>
                                        <option value="<?= $row['adc_id']; ?>"><?= $row['adc_num']; ?></option >
                                    <?php } ?> 
                                </select>
                                
                                <?php

                                ?>
                        </div>

                           

                        <div class="col-8" style="margin:0.8rem 0 ;">
                                 <label class="form-lable">จำนวนไก่คงเหลือ</label>
                                <input type="text" class="form-control" name="car_num" value=<?= $row['adc_num']; ?> readonly>
                        </div>

                          
                                                           

                        </div>
     
                    <div>
                        <button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
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