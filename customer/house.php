<?php
$menu = "house"
?>


<?php
ob_start();
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>


<div class="card card-Light ">
<section class="content-header mt-3">

    <div class="small-box" style="background-color: #87D819; color:  FFFFFF ">
                <div class="inner">
                    <h3>โรงเรือน</h3>
                    <p>ตารางข้อมูลโรงเรือน</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book text-light"></i>
                </div>
                <a href="test.php" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i></a>
            </div>
            
</section>
</div>
<!-- Main content -->
<section class="content">
    <div class="card card-Light ">
        <div class="card-header ">
            <h3 class="card-title">โรงเรือน</h3>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col">


                <table id="example" class="table table-striped table-bordered" style="width:90%" >


                        <thead>
                            <tr>
                                <th style="width:5%;">id</th>
                                <th style="width:20%;">ชื่อโรงเรือน</th>
                                <th style="width:10%;">สถานะโรงเรือน</th>
                            </tr>
                        </thead>

                        <tbody>


                            <?php
                            include "db.php";
                            $sql = "SELECT * FROM `house`";
                            $result = mysqli_query($conn, $sql);
                            // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr readonly>
                                    <td><?php echo $row['hou_id'] ?></td>
                                    <td><?php echo $row['hou_name'] ?></td>
                                    
                                    <td>
                                            <?php 
                                            
                                                if($row['hou_sta']==1){
                                                    echo '<span class="badge-pill badge-success" style="font: size 11.5em;pt"><a ?hou_id='.$row['hou_id'].'&hou_sta=1"  style="color:  FFFFFF" >พร้อมขาย</a></span>';    

                                                }else if ($row['hou_sta']==2) {
                                                    echo '<span class="badge-pill badge-Warning" style="font: size 11.5em;pt"><a ?hou_id='.$row['hou_id'].'&hou_sta=2"  style="color:  FFFFFF" >กำลังเครียโรงเรือน</a></span>';      
                                                } else {
                                                    echo '<span class="badge-pill badge-danger" style="font: size 11.5em;pt"><a ?hou_id='.$row['hou_id'].'&hou_sta=3"  style="color:  FFFFFF" >ไม่พร้อมขาย</a></span>';    
                                                }
                                                
                                            ?>
                                    </td>
                                           
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
    <div class="card-footer">
    </div>


    <?php include('footer.php'); ?>

    </body>

    </html>