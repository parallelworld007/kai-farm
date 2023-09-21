<?php
ob_start();
?>

<?php
$menu = "print"
?>




<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<div class="card card-Light ">
    <section class="content-header mt-3 ">
    <div class="small-box " style="background-color: #F4A62E; color:  FFFFFF ">
        <div class="inner">
            <h3>ใบสั่งซื้อ</h3>
            <p>ตารางใบสั่งซื้อ</p>
        </div>
        <div class="icon">
            <i class="fa fa-pie-chart text-light"></i>
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
            <h3 class="card-title">รายการบันทึกการเลี้ยง</h3>
            <div align="right">

                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>เพิ่มข้อมูล</button>

            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:70%" >


                        <thead>
                            <tr>
                                <th>รหัสสั่งซื้อสินค้า</th>
                                <th>วันที่ในการสั่งซื้อ</th>
                                <th>สถานะการชำระเงิน</th>
                                <th>ดูรายละเอียด</th>
                                <!-- <th>edit</th>
                                <th>delete</th> -->
                            </tr>
                        </thead>

                        <tbody>


                            <?php
                           include("db.php");
                           
                      

                           
                           $sql = "SELECT * FROM `order_head`";  //เรียกข้อมูลมาแสดงทั้งหมด
                           $result = mysqli_query($conn, $sql);
                           while($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr readonly>
                                    <td><?php echo $row["o_id"] ?></td>
                                    <td><?php echo $row["o_dttm"] ?></td>
                                    
                                    <td>
                                            <?php 
                                            
                                                if($row['o_wait']=="ได้ชำระเงินแล้ว") {
                                                    echo '<span class="badge-pill badge-success" style="font: size 11.5em;pt"><a ?hou_id='.$row['o_wait'].'&hou_sta=1"  style="color:  FFFFFF" >ได้ชำระเงินแล้ว</a></span>';    

                                                }else if  ($row['o_wait']=="ยังไม่ได้ตรวจสอบ")  {
                                                    echo '<span class="badge-pill badge-Warning" style="font: size 11.5em;pt"><a ?hou_id='.$row['o_wait'].'&hou_sta=2"  style="color:  FFFFFF" >ยังไม่ได้ตรวจสอบ</a></span>';      
                                                } else {
                                                    echo '<span class="badge-pill badge-danger" style="font: size 11.5em;pt"><a ?hou_id='.$row['o_wait'].'&hou_sta=3"  style="color:  FFFFFF" >ตรวจสอบการชำระเงินผิดพลาด</a></span>';    
                                                }
                                            ?>
                                    </td>
                                           
                                    </td>
                                    <td>
                                        <a href="print1.php?o_id=<?= $row['o_id']; ?>" class="link-Info">พิมพ์ใบสั่งซื้อ</a>
                                    </td>
                                    


                                    <!-- <td>
                                        <a href="edit_house.php?id=<?= $row['hou_id']; ?>" class="link-Info"><i class="fa-solid fa-pen-to-square fs-5 me-3 "></i></a>
                                    </td>

                                    <td>
                                        <a data-id="<?= $row['hou_id']; ?>" href="?delete=<?= $row['hou_id']; ?>" class="btn  btn-danger delete-btn fa-solid fa-trash-can "></a>

                                    </td> -->

                                    
                                    
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
    </div>
    <div class="card-footer">
        +++++++
    </div>

    <?php include('footer.php'); ?>

    </body>

    </html>