<?php
ob_start();
$menu = "product"
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
        if (isset($_POST['input'])) {

            $image_name = rand(100, 999) . ".jpg";
            $p_pic="http://localhost/farmkai/images/".$image_name;
            move_uploaded_file($_FILES["p_pic"]["tmp_name"],"../images/".$image_name);




            $sql = "UPDATE `product` SET `p_pic`='$p_pic' WHERE p_id = $id";

            $result = mysqli_query($conn, $sql);

            if($sql){
                $_SESSION['success'] = "Data has been inserted successfully";
                echo "<script>";
                echo "Swal.fire({
                    icon: 'success',
                    title: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
                    showConfirmButton: false,
                    timer: 1500,
                    })";
                echo "</script>";
                header("refresh:1 ;");
            }
            else{
                $_SESSION['error'] = "Data has not been inserted successfully";
                header("Location: product.php");
            }

        }

        ?> 

<div class="card-body">
            <div class="row">
                <div class="col-md-9">

                    <form action="" method="post" enctype="multipart/form-data">


                    <?php
                        $id  = $_GET['id'];
                        $sql = "SELECT * FROM `product` WHERE  p_id = $id LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                      


                        <div class="row">
                        <div class="col-sm-10" style="margin:0.8rem 0 ;">
                            <img src='<?php echo $row["p_pic"] ?>' style='width: 20%;'> 
                            
                            </div>
                            <div class="col-sm-10" style="margin:0.8rem 0 ;">

                                <label for="http:/localhost/farmkai/images">รูปภาพสินค้า</label>
                                
                                <input type="file" class="form-control" id="p_pic" name="p_pic" placeholder="p_pic" value="<?php echo $row['p_pic'] ?>" style='width: 100%;'>

                            </div>
                        </div>


                        <br><button id="input" name="input" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> แก้ไขรูปภาพ</button>

                    </form>
                </div>
            </div>
        </div>


        <?php
        include "db.php";
        $id = $_GET['id'];
        if (isset($_POST['submit'])) {
            $p_name = $_POST['p_name'];
            $p_detail = $_POST['p_detail'];
            $p_price = $_POST['p_price'];





            $sql = "UPDATE `product` SET `p_name`='$p_name',`p_detail`='$p_detail',
             `p_price`='$p_price' WHERE p_id = $id";

            $result = mysqli_query($conn, $sql);

            if($sql){
                $_SESSION['success'] = "Data has been inserted successfully";
                echo "<script>";
                echo "Swal.fire({
                    icon: 'success',
                    title: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
                    showConfirmButton: false,
                    timer: 1500,
                    })";
                echo "</script>";
                header("refresh:1 ; url=product.php");
            }
            else{
                $_SESSION['error'] = "Data has not been inserted successfully";
                header("Location: product.php");
            }

        }

        ?> 



        <div class="card-body">
            <div class="row">
                <div class="col-md-9">

                    <form action="" method="post" enctype="multipart/form-data">


                    <?php
                        $id  = $_GET['id'];
                        $sql = "SELECT * FROM product
                        where product.p_id = $id
                        LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                      


                        <div class="row">
                            <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                <label class="form-lable">ชื่อสินค้า</label>
                                <input type="text" class="form-control" name="p_name" placeholder="p_name" value="<?php echo $row['p_name'] ?>">
                            </div>
                            <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                <label class="form-lable">ข้อมูลสินค้า</label>
                                <input type="text" class="form-control" name="p_detail" placeholder="p_detail" value="<?php echo $row['p_detail'] ?>">
                            </div>
                            <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                <label class="form-lable">ราคา</label>
                                <input type="text" class="form-control" name="p_price" placeholder="p_price" value="<?php echo $row['p_price'] ?>">
                            </div>

                      

                            <?php
                                $house = "SELECT * FROM house";
                                $house_qry = mysqli_query($conn, $house);
                            ?>
                               

                        </div>


                        <br><button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> แก้ไขข้อมูลสินค้า</button>
                        <a href="product.php" class="btn btn-danger">กลับ</a>

                    </form>
                </div>
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
    