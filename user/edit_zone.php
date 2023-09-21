<?php
ob_start();
$menu = "zone"
?>

<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="small-box bg-gradient-olive">
        <div class="inner">
            <h3>แก้ไขชื่อโซน</h3>
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


        <?php
        include "db.php";
        $id = $_GET['id'];

        if (isset($_POST['submit'])) {
            $hou_id = $_POST['hou_id'];
            $zon_num = $_POST['zon_num'];


          
                $sql = "UPDATE `zone` SET `hou_id`='$hou_id',`zon_num`='$zon_num' WHERE zon_id = $id";
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
                    header("refresh:1 ; url=zone.php");
                } else {
                    $_SESSION['error'] = "Data has not been inserted successfully";
                    header("Location: zone.php");
                }
            }


        ?>

        <div class="card-body">
            <div class="row">
                <div class="col-md-9">

                    <form action="" method="post" style="width:40vw;">



                    <?php
                        $sql = "SELECT z.zon_id,h.hou_id, h.hou_name, z.zon_num                            
                        FROM zone as z
                        INNER JOIN house as h ON z.hou_id = h.hou_id WHERE  zon_id = $id LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                    ?>
                        <div class="row">
                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label class="form-lable">โรงเรือน</label>
                                <select name="hou_id" class="form-control" readonly>
                                        <?php foreach ($result as $row) { ?>
                                            <option value="<?= $row['hou_id']; ?>"><?= $row['hou_name']; ?></option >
                                        <?php } ?> 
                                    </select>
                                    
                                    <?php

                                    ?>
                              
                            </div>

                            <div class="col-8" style="margin:0.8rem 0 ;">
                                <label clas="form-lable">โซน</label>
                                <input type="text" class="form-control" name="zon_num" value="<?php echo $row['zon_num'] ?>">
                            </div>
                        </div>
     
                    <div>
                        <button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                        <a href="zone.php" class="btn btn-danger">กลับ</a>
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