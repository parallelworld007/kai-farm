<?php
$menu = "product"
?>


<?php
ob_start();
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>
<?php
require_once "db.php";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE FROM `product` WHERE p_id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=lsit_mem.php");
    }
}
?>
<div class="card card-Light ">
    <section class="content-header  mt-3">
    <div class="small-box " style="background-color: #9FBEF9; color:  FFFFFF ">
        <div class="inner">
            <h3>สินค้า</h3>
            <p>ตารางข้อมูลสินค้า</p>
        </div>
        <div class="icon">
            <i class="fa fa-shopping-cart text-light"></i>
        </div>
        <a href="test.php" class="small-box-footer">
            <i class="fa fa-arrow-circle-left"> </i>
        </a>
        
    </section>
</div> 
<!-- Main content -->
<section class="content">
    <div class="card card-Light ">
        <div class="card-header ">
            <h3 class="card-title">รายการเพิ่มข้อมูล ผู้ใช้งาน</h3>
            <div align="right">

            <a href="addproduct.php"><button type="button" class="btn btn-outline-success" ><i class="fa fa-plus"></i> เพิ่มข้อมูล</button></a>

            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">


                <table id="example" class="table table-striped table-bordered"  style="width:90%">
                        <thead>
                            <tr >
                                <th style="width:7%;">ไอดีสินค้า</th>
                                <th style="width:8%;">ชื่อสินค้า</th>
                                <th style="width:20%;">ข้อมูลสินค้า</th>
                                <th style="width:5%;">ราคา</th>
                                <th style="width:30%;">รูปภาพสินค้า</th> 
                                <th style="width:5%;">edit</th>
                                <th style="width:5%;">delete</th>
                            </tr>
                        </thead>

                        <tbody>


                            <?php
                            include "db.php";
                            $sql = "SELECT * FROM `product`
                            ";

                            $result = mysqli_query($conn, $sql);
                            // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr readonly >

                                    <td><?php echo $row['p_id'] ?></td>
                                    <td><?php echo $row['p_name'] ?></td>
                                    <td><?php echo $row['p_detail'] ?></td>
                                    <td ><?php echo $row['p_price'] ?></td>
                                    <td><img src='<?php echo $row["p_pic"] ?>' style='width: 50%;'> 
                                   
                                </td>
                               

                                    <td>
                                        <a href="edit_product.php?id=<?= $row['p_id']; ?>" class="link-Info"><i class="fa-solid fa-pen-to-square fs-5 me-3 "></i></a>
                                    </td>

                                    <td>
                                        <a data-id="<?= $row['p_id']; ?>" href="?delete=<?= $row['p_id']; ?>" class="btn  btn-danger delete-btn fa-solid fa-trash-can "></a>

                                    </td>

                                    
                                    


                                </tr>
                            <?php

                            }
                            ?>

                        </tbody>
                    </table>



                </div>


            </div>

        </div>
    </div>



    <?php
    include "db.php";
    if (isset($_FILES['submit'])) {
        $p_name = $_POST['p_name'];
        $p_detail = $_POST['p_detail'];
        $p_price = $_POST['p_price'];

        $image_name = rand(100,999).".jpg";
        $p_pic="http://localhost/farmkai/images/".$image_name;
        copy($_FILES["p_pic"]["tmp_name"],"../images/".$image_name);


        //เช็คข้อมูลซ้ำ
        $sql = "SELECT * FROM `product` WHERE p_name = '$p_name' ";
        $result = mysqli_query($conn, $sql);
        //echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result); 

        if (mysqli_num_rows($result) > 0) {
            echo "<script>";
            echo "Swal.fire({
                            icon: 'error',
                            title: 'มีสินค้านี้อยู่แล้ว',
                            showConfirmButton: false,                
                            })";
            echo "</script>";
            header("refresh:1 ; url=product.php");
        } else {
            $sql = "INSERT INTO `product`( `p_name`,`p_detail`,`p_price`,`p_pic`) 
                        VALUES ('$p_name','$p_detail','$p_price','$p_pic')";
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
                header("refresh:1 ; url=product.php");
            } else {
                $_SESSION['error'] = "Data has not been inserted successfully";
                header("Location: product.php");
            }
        }
    }



    ?>




    <div class="modal fade" id="exampleModal" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <form action="product.php" method="POST">
                <input type="hidden" name="member" value="add">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">

                            <div class="row">
                               
                                <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">ชื่อสินค้า</label>
                                    <input type="text" class="form-control" name="p_name" placeholder="p_name">
                                </div>
                                <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">ข้อมูลสินค้า</label>
                                    <input type="text" class="form-control" name="p_detail" placeholder="p_detail">
                                </div>
                                <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">ราคา</label>
                                    <input type="text" class="form-control" name="p_price" placeholder="p_price">
                                </div>
                                <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                <label for="http:/localhost/farmkai/images">รูปภาพสินค้า:</label>
                                  <input type="file" id="p_pic" name="p_pic" style='width: 20%;'>
                                </div>
                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                <button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                            </div>
                        </div>
            </form>
        </div>
    </div>
                     
                     


    <?php include('footer.php'); ?>

    </body>

    <!--sweetalert2 ลบข้อมูล -->
    <script>
        $(".delete-btn").click(function(e) {
            var userId = $(this).data('id');
            e.preventDefault();
            deleteConfirm(userId);
        })

        function deleteConfirm(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "คุณต้องการลบข้อมูล!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'product.php',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'Data deleted successfully!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'product.php';
                                })
                            })
                            .fail(function() {
                                Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
        
    </script>


    </html>