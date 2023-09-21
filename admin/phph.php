<?php
$menu = "addkai"
?>

<?php
ob_start();
?>


<?php
require_once "db.php";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE FROM `add_chicken` WHERE adc_id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=addkai.php");
    }
}
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<div class="card card-Light ">
    <section class="content-header mt-3 ">
        <div class="small-box " style="background-color: #E1D823; color:  FFFFFF ">
            <div class="inner">
                <h3>เพิ่มไก่</h3>
                <p>ตารางข้อมูลการเพิ่มไก่</p>
            </div>
            <div class="icon">
                <i class="fas fa-user text-light"></i>
            </div>
            <a href="test.php" class="small-box-footer">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
        </div>
    </section>
</div>
<!-- Main content -->
<section class="content">
    <div class="card card-Light ">
        <div class="card-header ">
            <h3 class="card-title">รายการเพิ่มข้อมูล เพิ่มไก่</h3>
            <div align="right">

                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>

            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">


                    <table id="example" class="table table-striped table-bordered" style="width:50%">
                        <thead>
                            <tr class="info">
                                <th style="width:15%">id</th>
                                <th>โรงเรือน</th>
                                <th style="width:20%">เพิ่มไก่</th>    
                                
                            </tr>
                        </thead>

                        <tbody>

                                <?php
                                include "db.php";
                                    $sql = "SELECT * 
                                            FROM house
                                            ";
                                $result = mysqli_query($conn, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>

                                        <td><?=  $i++; ?> </td>
                                        <td >
                                            <?=  $row['hou_name']; ?>
                                        </td>
                                        <td>
                                                <button id="<?=  $row['hou_id']; ?>
                                                "data-toggle="modal" data-target="#myModal<?=  $row['hou_id']; ?>" type="button" class="btn btn-outline-success" ><i class="fa-solid fa-eye"></i> ข้อมูลเพิ่มไก่</button>
                                         </td>
                                    
                                    </tr>

                                    <?php 
                                        $sql2 = "SELECT ad.adc_id, h.hou_name, z.zon_num, ad.adc_num , ad.adc_date                             
                                                 FROM add_chicken as ad
                                                 INNER JOIN house as h ON ad.hou_id = h.hou_id
                                                 INNER JOIN zone as z ON ad.zon_id = z.zon_id WHERE  h.hou_id =  ". $row['hou_id'] ;
                                        $result2 = mysqli_query($conn, $sql2);
                                    ?>

                                    <?php 
                                        // $sql2 = "SELECT  ad.adc_id, h.hou_name, z.zon_num, ad.adc_num , ad.adc_date                             
                                        //             FROM zone as z
                                        //             LEFT JOIN house as h ON z.hou_id = h.hou_id
                                        //             LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
                                        //             Where h.hou_id =  ". $row['hou_id'] ;
                                        // $result2 = mysqli_query($conn, $sql2);
                                    ?>

                                    <?php 
                                    ?>
                                    <div id="myModal<?php echo $row['hou_id']; ?>" class="modal fade" role="dialog">

                                        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg  ">
                                            <!-- Modal content-->                                
                                            <div class="modal-content">
                                            <div class="modal-header text-light bg-yellow" >
                                                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลเพิ่มไก่</h5>
                                            </div>
                                            <div class="modal-body">
                                        <div class="form-group row" style="padding: 1rem; font-size:18px;">
                                            <?php foreach ($result2 as $row2) { ?>
                                                
                                                <div class="row" style="margin: 0.2rem;">
                                                  
                                                    <div class="col">
                                                        <?= $row2['zon_num'] ?>
                                                    </div>

                                                    <div class="col">
                                                        <?= $row2['adc_num'] ?>

                                                    </div>

                                                    <div class="col">
                                                        <?= $row2['adc_date'] ?>
                                                    </div>
                                                   
                                                    <div class="col-md-1">
                                                    <a href="edit_addkai.php?id=<?= $row2['adc_id']; ?>" class="link-success"><i class="fa-solid fa-pen-to-square fs-3 me-3 "></i></a>
                                                    </div>

                                                    <div class="col-md-1" style="margin-right: 3px;">
                                                        <a id="<?= $row2['adc_id']; ?>" href="?delete=<?= $row2['adc_id']; ?>" class="btn delete-btn"> <i class="fa-solid fa-trash-can" style="color: #fe0606;"></i>
                                                    </a>
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
                                    </div>
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
                                            url: 'addkai.php',
                                            type: 'GET',
                                            data: 'delete=' + userId,
                                        })
                                        .done(function() {
                                            Swal.fire({
                                                title: 'success',
                                                text: 'Data deleted successfully!',
                                                icon: 'success',
                                            }).then(() => {
                                                document.location.href = 'addkai.php';
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
        +++++++
    </div>

    </div>

    <!-- เพิ่มโรงเรือน -->
    <?php
    include "db.php";
    if (isset($_POST['submit'])) {
        $hou_id = $_POST['hou_id'];
        $zon_id = $_POST['zon_id'];
        $adc_num = $_POST['adc_num'];
        $adc_date = $_POST['adc_date'];



        $sql = "INSERT INTO `add_chicken`(hou_id,zon_id,adc_num,adc_date) 
                VALUES ('$hou_id','$zon_id','$adc_num',NOW())";
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
            header("refresh:1 ; url=addkai.php");
        } else {
            $_SESSION['error'] = "Data has not been inserted successfully";
            header("Location: addkai.php");
        }
    }

    ?>

    <?php include('footer.php'); ?>


    </body>

    </html>