<?php
ob_start();
?>


<?php
$menu = "zone"
?>
<?php
require_once "db.php";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE FROM `zone` WHERE zon_id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=zone.php");
    }
}
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>
<div class="card card-Light ">
    <section class="content-header mt-3 ">
        <div class="small-box" style="background-color: 0BE398; color:  FFFFFF ">
            <div class="inner">
                <h3>โซน</h3>
                <p>ตารางข้อมูลโซน</p>
            </div>
            <div class="icon">
                <i class="ion-stats-bars text-light"></i>
            </div>
            <a href="test.php" class="small-box-footer">
                <i class="fas fa fa-arrow-circle-left"></i>
            </a>
        </div>
    </section>
</div>
<!-- Main content -->
<section class="content">
    <div class="card card-Light ">
        <div class="card-header ">
            <h3 class="card-title">รายการเพิ่มข้อมูล โซน</h3>
            <div align="right">
            
                
            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">


                    <table id="example" class="table table-striped table-bordered" style="width:50%">
                        <thead>
                            <tr class="info">
                                <th style="width:15%;">#</th>
                                <th>โรงเรือน</th>
                                <th style="width:20%;">โซน</th>
                                
                                
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            include "db.php";
                                $sql = "SELECT * 
                                        FROM house
                                        ";
                            $result = mysqli_query($conn, $sql);
                            $d = 1;
                          
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>
                            
                                <tr>

                                    <td><?php echo $d++ ?></td>
                                    <td><?=  $row['hou_name']; ?> 
                                    </td>

                                    <td> 
	
                                        <button id="<?=  $row['hou_id']; ?>
                                        "data-toggle="modal" data-target="#myModal<?=  $row['hou_id']; ?>" type="button" class="btn btn-outline-success" ><i class="fa-solid fa-eye"></i> ข้อมูลโซน</button>
                                    </td>
                                </tr>




                               
                                <?php 
                                        $sql2 = "SELECT h.hou_id, h.hou_name, z.zon_id, z.zon_num
                                        FROM zone as z
                                        LEFT JOIN house as h ON z.hou_id = h.hou_id
                                        WHERE h.hou_id = ". $row['hou_id'];
                                        $result2 = mysqli_query($conn, $sql2);  
                                        $i = 1;                                                   
                                ?>
        

                                <div id="myModal<?php echo $row['hou_id']; ?>" class="modal fade" role="dialog">

                                 <!-- ข้อมูลใน modal ของโซน -->
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                                        <!-- Modal content-->                                
                                        <div class="modal-content">
                                        <div class="modal-header bg-success" >
                                            <h5 class="modal-title" id="exampleModalLabel">ข้อมูลโซน</h5>
                                        </div>
                                            <div class="row" style="margin: 0.5rem; ">
                                                <a class='cart' href='insert_zone.php?hou_id= <?php echo $row["hou_id"] ?>'>
                                                    
                                                    <button type="button" class="btn btn-outline-success" ><i class="fa fa-plus"></i>เพิ่มโซน</button>
                                                    
                                                </a>
                                            </div>       
                                        <div class="modal-body">
                                    <div class="form-group row" style="padding: 1rem; font-size:18px;">
                                    
                                        <?php foreach ($result2 as $row2) { ?>
                                            <div class="row" style="margin: 0.3rem;">

                                            <div style="width: 60px;">
                                                    #<?= $i++ ?>
                                                </div>

                                                <div class="col-md">
                                                    <?= $row2['hou_name'] ?>
                                                </div>

                                                <div class="col-md">
                                                    <?= $row2['zon_num'] ?>
                                                </div>

                                                <div class="col-md-1" style="margin-right: 18px;">
                                                    <a href="edit_zone.php?id=<?= $row2['zon_id']; ?>" class="link-success"><i class="fa-solid fa-pen-to-square fs-3 me-3 "></i></a>
                                                </div>

                                                <div class="col-md-1" >
                                                    <a id="<?= $row2['zon_id']; ?>" href="?delete=<?= $row2['zon_id']; ?>" class="btn  btn-danger delete-btn fa-solid fa-trash-can "></a>
                                                </div>
                                                                                     
                                            </div>
                                        
                                        <?php } ?>
                                        </div>
                                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                
                            </div>
                                </div>
                                       

                                    </div>
                                </div>

                         <!-- ข้อมูลใน modal ของโซน -->
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>


                <!--sweetalert2 ลบข้อมูล -->
                <script>
                    $(".delete-btn").click(function(e) {
                        var userId = this.getAttribute('id');
                        console.log(userId);
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
                                            url: 'zone.php',
                                            type: 'GET',
                                            data: 'delete=' + userId,
                                        })
                                        .done(function() {
                                            Swal.fire({
                                                title: 'success',
                                                text: 'Data deleted successfully!',
                                                icon: 'success',
                                            }).then(() => {
                                                document.location.href = 'zone.php';
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


            </div>

        </div>
    </div>
    <div class="card-footer">
    </div>

    </div>

    <!-- เพิ่มโรงเรือน -->
    <?php
    include "db.php";
    if (isset($_POST['submit'])) {
        $hou_id = $_POST['hou_id'];
        $zon_num = $_POST['zon_num'];

        $sql = "INSERT INTO `zone`( `hou_id`,`zon_num` ) 
                    VALUES ('$hou_id','$zon_num')";
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
                    

    <div class="modal fade" id="exampleModal" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <form action="zone.php" method="POST">
                <input type="hidden" name="member" value="add">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row" style="padding: 1rem; font-size:18px;">

                            <?php
                            include "db.php";
                            $sql = "SELECT * FROM `house`";
                            $result = mysqli_query($conn, $sql);
                            ?>
                            <div class="row">
                                <div class="col-10" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">โรงเรือน</label>
                                    <select name="hou_id" class="form-control" required>
                                        <option value="">เลือกโรงเรือน</option>
                                        <?php foreach ($result as $row) { ?>
                                            <option value="<?= $row['hou_id']; ?>"><?= $row['hou_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php

                                    ?>
                                </div>

                                <div class="col-10" style="margin:0.8rem 0 ;">
                                    <label class="form-lable">โซน</label>
                                    <input type="text" class="form-control" name="zon_num" placeholder="โปรดใส่ข้อมูล" required>
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
    <!-- <?php include('footer.php'); ?> -->

    </body>

    </html>