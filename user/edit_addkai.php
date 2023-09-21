<?php
ob_start();
$menu = "addkai"
?>

<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="small-box bg-gradient-olive">
        <div class="inner">
            <h3>แก้ไขข้อมูลเพิ่มไก่</h3>
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
            $hou_id = $_POST['hou_id'];
            $zon_id = $_POST['zon_id'];
            $adc_num = $_POST['adc_num'];
            $adc_date = $_POST['adc_date'];
            $adc_datesell = $_POST['adc_datesell'];
            $adc_total = $_POST['adc_total'];
            $adc_d = $_POST['adc_d'];
            $adc_sell = $_POST['adc_sell'];
            $mem_id = $_POST['mem_id'];

            

            $sql = "UPDATE `add_chicken` SET `adc_num`='$adc_num',`adc_date`='$adc_date',`adc_datesell`='$adc_datesell'
            ,`adc_total`='$adc_total',`adc_d`='$adc_d',`adc_sell`='$adc_sell'  
            WHERE adc_id = $id";
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
                header("refresh:1 ; url=addkai.php");
            } else {
                $_SESSION['error'] = "Data has not been inserted successfully";
                header("Location: addkai.php");
            }
        }


        ?>

        <div class="card-body">
            <div class="row">
                <div class="col-md-9">

                    <form action="" method="post" style="width:50vw; min-width:300px;">
                    <?php
                        $sql = "SELECT h.hou_name, z.zon_num, ad.adc_num , ad.adc_date , ad.adc_datesell,
                                ad.adc_total , ad.adc_d ,ad.adc_sell, ad.mem_id ,m.mem_username 
                                FROM add_chicken as ad
                                INNER JOIN house as h ON ad.hou_id = h.hou_id
                                INNER JOIN zone as z ON ad.zon_id = z.zon_id 
                                LEFT JOIN tbl_member as m ON ad.mem_id = m.mem_id 
                                WHERE  ad.adc_id = $id LIMIT 1";
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
                                <label clas="form-lable">จำนวนที่เพิ่ม</label>
                                <input type="number" class="form-control" name="adc_num" value="<?php echo $row['adc_num'] ?>">
                            </div>
                            

                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label clas="form-lable">วันที่เพิ่ม</label>
                                <input type="date" class="form-control" name="adc_date" value="<?php echo $row['adc_date'] ?>">
                            </div>

                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label clas="form-lable">วันที่ขาย</label>
                                <input type="date" class="form-control" name="adc_datesell" value="<?php echo $row['adc_datesell'] ?>">
                            </div>

                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label clas="form-lable">ไก่ที่เหลือ</label>
                                <input type="number" class="form-control" name="adc_total" value="<?php echo $row['adc_total'] ?>">
                            </div>

                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label clas="form-lable">ไก่ที่ตาย</label>
                                <input type="number" class="form-control" name="adc_d" value="<?php echo $row['adc_d'] ?>">
                            </div>

                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label clas="form-lable">ไก่ที่ขาย</label>
                                <input type="number" class="form-control" name="adc_sell" value="<?php echo $row['adc_sell'] ?>">
                            </div>

                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <input type="text" class="form-control"  name="mem_id" value="<?php echo $row['mem_id'] ?>" readonly style="display: none;">
                            </div>
                            

                            
                        </div>

                        <button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                        <a href="addkai.php" class="btn btn-danger">กลับ</a>
                    </div>
                        

                

                </form>



            </div>

        </div>
    </div>
    <div class="card-footer">
    </div>

    </div>
    <?php include('footer.php'); ?>
    </body>
    <script>
        $(document).ready(function(){
            $('#selectID').change(function(){
            var Stdid = $('#selectID').val(); 
        
            $.ajax({
                type: 'POST',
                url: 'ajax/fetch.php',
                data: {id:Stdid},  
                success: function(data)  
                {
                    $('#zon').html(data);
                }
                });
            });
        });
    </script> 

    </html>