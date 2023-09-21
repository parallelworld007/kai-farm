<?php
ob_start();
?>

<?php
$menu = "care"
?>


<?php include("kaid.php"); ?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<div class="card card-Light ">
    <section class="content-header mt-3 ">
        
    <div class="small-box " style="background-color: #F4A62E; color:  FFFFFF ">
        <div class="inner">
            <h3>การเลี่ยง</h3>
            <p>ตารางข้อมูลการเลี่ยง</p>
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


            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">


                    <table id="example" class="table table-striped table-bordered" style="width:45%">
                        <thead>
                            <tr class="info" >
                                <th style="width:10%">id</th>
                                <th style="width:30%">โรงเรือน</th>
                                <th style="width:15%">การเลี้ยง</th>
                                <th style="width:15%">การตาย</th>
                            </tr>
                        </thead>

                        <tbody>
                                    <?php
                                    include "db.php";
                                        $sql = "SELECT * 
                                                FROM house
                                                ";
                                    $result = mysqli_query($conn, $sql);
                                
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>

                                            <td>
                                            <?=  $row['hou_id']; ?>
                                            </td>
                                            <td>
                                                <?=  $row['hou_name']; ?>
                                            </td>
                                            
                                            <td>
                                                <button id="<?= $row['hou_id']; ?>
                                                "data-toggle="modal" data-target="#myModal<?=  $row['hou_id']; ?>" type="button" class="btn btn-outline-success" >
                                                    <i class="fa-solid fa-eye"></i> ข้อมูลการเลี้ยง</button>
                                            </td>
                                            <td>
                                                <button id="<?=  $row['hou_id']; ?>
                                                "data-toggle="modal" data-target="#myModal2<?=  $row['hou_id']; ?>" type="button" class="btn btn-outline-success" >
                                                    <i class="fa-solid fa-eye"></i> ข้อมูลการตาย</button>
                                            </td>
                                        </tr>

                                        <?php 
                                            $sql2 = "SELECT h.hou_id,h.hou_name,z.zon_id,z.zon_num,ad.adc_id,ad.adc_num,c.car_id,c.car_num                
                                                        FROM zone as z
                                                        LEFT JOIN house as h ON z.hou_id = h.hou_id
                                                        LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id
                                                        LEFT JOIN care as c ON z.zon_id = c.zon_id                
                                                        Where h.hou_id =  ". $row['hou_id'] ;
                                            $result2 = mysqli_query($conn, $sql2);
                                            $d = 1;
                                        ?>
               
                                        <div id="myModal<?php echo $row['hou_id']; ?>" class="modal fade" role="dialog">

                                            <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-xl">
                                                <!-- Modal content-->                                
                                                <div class="modal-content">
                                                <div class="modal-header text-light bg-orange" >
                                                    <h5 class="modal-title" id="exampleModalLabel">ข้อมูลการเลี้ยง</h5>
                                                </div>
                                                
                                                <div class="modal-body">
                                            <div class="form-group row" style="padding: 1rem; font-size:18px;">
                                                <?php foreach ($result2 as $row2) {

                                                    $Date = date('d-m-Y'); //วันที่ปัจจุบัน
                                                    
                                                    ?>

                                                    <div class="row" style="margin: 0.5rem;">

                                                    
                                                    <div style="width: 80px;"> #<?= $d++ ?></div>
                                                      
                                                            <div style="width:100px;">
                                                                <?php
                                                                if ($row2['car_id'] == '') {
                                                                    echo '-';
                                                                } else {
                                                                    echo "id " . $row2['car_id'];
                                                                }
                                                                ?>
                                                            </div>

                                                        <div class="col-md"> <?= $row2['hou_name'] ?></div>

                                                       <div class="col-md"> <?= $row2['zon_num'] ?></div>

                                                       <div style="width: 160px;">
                                                            <?php if ($row2['adc_num'] == '') {
                                                                echo '-';
                                                            } else {
                                                                echo "ไก่ที่เพิ่ม " . $row2['adc_num'] . " ตัว";
                                                            } ?>
                                                        </div>

                                                        <div   style="width: 180px;">
                                                            <?php if ($row2['car_num'] == '') {
                                                                echo '-';
                                                            } else {
                                                                echo "ไก่ที่เหลือ " . $row2['car_num'] . " ตัว";
                                                            } ?>
                                                        </div>
                                                        <div style="width: 180px;">
                                                            <?php
                                                            if ($row2['car_id'] == '') {
                                                                echo '-';
                                                            } else {
                                                                echo 'วันที่: ' . $Date;
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-md-1" style="width: 60px;">
                                                            <?php if ($row2['adc_id'] == '') {
                                                                echo ' ';
                                                            } elseif ($row2['car_id'] == '') {
                                                                echo '<a href="insert_care.php?id=' . $row2['hou_id'] . '&name=' . $row2['zon_id'] . '&name2=' . $row2['adc_id'] . '" class="link-success"><i class="fa fa-plus"></i></a>';
                                                            } else {
                                                                echo '<a href="insert_kaid.php?id=' . $row2['hou_id'] . '&name=' . $row2['zon_id'] . '&name2=' . $row2['car_id'] . '" class="link-dark"><i class="fa fa-plus"></i></a>';
                                                            } ?>
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
                                            $sql3 = "SELECT h.hou_name,z.zon_num,d.car_id,c.car_num,d.d_id,d.d_total,d.d_note,d.d_num,d.d_date,d.d_total                            
                                                    FROM d_chicken as d 
                                                    INNER JOIN house as h ON d.hou_id = h.hou_id
                                                    INNER JOIN zone as z ON d.zon_id = z.zon_id 
                                                    LEFT JOIN care as c ON z.zon_id = c.zon_id  
                                                    Where h.hou_id =  ". $row['hou_id'] ;
                                            $result3 = mysqli_query($conn, $sql3);
                                            $d = 1;
                                    ?>                                       
                                 <div id="myModal2<?php echo $row['hou_id']; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen ">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header text-light bg-orange">
                                                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลการตาย</h5>
                                            </div>
                                                
                                                <div class="modal-body">
                                                    
                                            <div class="form-group row" style="padding: 1rem; font-size:18px;">
                                                <?php foreach ($result3 as $row3) { 

                                                    $Dateadd = date('d-m-Y', strtotime($row3['d_date']));
                                                    ?>
                                                   
                                                    
                                                   <div class="row" style="margin: 0.5rem;">
                                                        <!-- Column 1: Incremented Value -->
                                                        <div class="col-md-1" style="width: 100px;">
                                                            # <?= $d++ ?>
                                                        </div>                                                    

                                                        <!-- Column 2: hou_name -->
                                                        <div class="col-md-1" >
                                                            <?= $row3['hou_name'] ?>
                                                        </div>

                                                        <!-- Column 3: zon_num -->
                                                        <div class="col-md-1" >
                                                            <?= $row3['zon_num'] ?>
                                                        </div>

                                                        <div class="col">
                                                                <?php
                                                                if ($row3['d_id'] == '') {
                                                                    echo '-';
                                                                } else {
                                                                    echo "id ข้อมูลการเลี้ยงที่ " . $row3['car_id'];
                                                                }
                                                                ?>
                                                        </div>

                                                        <!-- Column 4: Chicken Status -->
                                                        <div class="col-md-1">
                                                            <?php
                                                            if ($row3['d_id'] == '') {
                                                                echo '-';
                                                            } else {
                                                                echo "ไก่ตาย " . $row3['d_total'] . " ตัว";
                                                            }
                                                            ?>
                                                        </div>

                                                        <!-- Column 5: Chicken Note -->
                                                        <div class="col-md" style="width: 230px;">
                                                            <?php
                                                            if ($row3['d_id'] == '') {
                                                                echo '-';
                                                            } else {
                                                                echo "สาเหตุ";
                                                                switch ($row3['d_note']) {
                                                                    case 1:
                                                                        $note = "ไม่ทราบ";
                                                                        break;
                                                                    case 2:
                                                                        $note = "ไม่กินอาหาร ไม่ดื่มน้ำ";
                                                                        break;
                                                                    case 3:
                                                                        $note = "ตัวผอมลง น้ำหนักลด";
                                                                        break;
                                                                    case 4:
                                                                        $note = "มีอาการง่วง หรือหลับตลอด";
                                                                        break;
                                                                    case 5:
                                                                        $note = "ขนร่วงจนเห็นผิวหนัง";
                                                                        break;
                                                                    case 6:
                                                                        $note = "ท้องเสีย ถ่ายเป็นน้ำบ่อยๆ";
                                                                        break;
                                                                }
                                                                echo '<span class="badge-pill "  style="font-size:12pt"><a = "?d_id=' . $row3['d_id'] . '&d_note=' . $row3['d_note'] . '"  style="color: #000000;">' . $note . '</a></span>';
                                                            }
                                                            ?>
                                                        </div>

                                                        <!-- Column 6: Remaining Chickens -->
                                                        <div class="col-md">
                                                            <?php
                                                            // Calculate the remaining chickens
                                                            $remaining_chickens = $row3['d_num'] - $row3['d_total'];
                                                            echo "คงเหลือ " . $remaining_chickens . " ตัว";
                                                            ?>
                                                        </div>

                                                        <!-- Column 7: Date -->
                                                        <div class="col">
                                                            <?php
                                                            if ($row3['d_id'] == '') {
                                                                echo '-';
                                                            } else {
                                                                echo 'วันที่ : ' . $Dateadd;
                                                            }
                                                            ?>
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


            </div>

        </div>
    </div>
    <div class="card-footer">
        +++++++
    </div>

    </div>

   
    <?php include('footer.php'); ?>

    </body>
  
    </html>

       
              