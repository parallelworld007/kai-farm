<?php
$menu = "sales"
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
                <h3>ขายสินค้า</h3>
                <p>ตารางข้อมูลขายสินค้า</p>
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

            </div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">


        <table id="example" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>#</th>
                <th>โรงเรือน</th>
                <th>โซน</th>
                <th>นำเข้า</th>
                <th>วันที่เพิ่ม</th>
                <th>วันที่ขาย</th>
                <th>เหลือ</th>
                <th>ตาย</th>
                <th>ขาย</th>
                <th>สถานะ</th>
                <th>ชื่อผู้ใช้งาน</th>
                <th style="width:6%;" class="text-center">ขาย</th>
                <th style="width:6%;" class="text-center">ลบ</th>
                <th style="width:3%;" class="text-center">แก้ไข</th>
               
                
            </tr>
        </thead>


        
        <tbody>
                            <?php
                            include "db.php";
                            $sql = "SELECT h.hou_id,h.hou_name,z.zon_id,z.zon_num,ad.adc_id,ad.adc_num,ad.adc_date,ad.adc_datesell,ad.adc_total,ad.adc_num,ad.adc_d,ad.adc_sell,m.mem_id,m.mem_name           
                            FROM zone as z
                            LEFT JOIN house as h ON z.hou_id = h.hou_id
                            LEFT JOIN add_chicken as ad ON z.zon_id = ad.zon_id 
                            LEFT JOIN tbl_member as m ON ad.mem_id = m.mem_id              
                            ";
                            $i = 1;
                            $result = mysqli_query($conn, $sql);
                            $o_id = $_GET['o_id'];
                            // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
                            while ($row = mysqli_fetch_assoc($result)) {
                         
                            ?>
                                <tr readonly>
                                    <td><?php echo $i++?></td>
                                    <td><?php echo $row['hou_name'] ?></td>
                                    <td><?php echo $row['zon_num'] ?></td>
                                    <td>
                                        <?php
                                              if ($row['adc_num'] == '') {
                                                    echo '-';
                                               } else {
                                                    echo "". $row['adc_num'] ;
                                               }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                              if ($row['adc_date'] == '') {
                                                    echo '-';
                                               } else {
                                                    echo "". $row['adc_date'] ;
                                               }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                              if ($row['adc_datesell'] == '') {
                                                    echo '-';
                                               } else {
                                                    echo "". $row['adc_datesell'] ;
                                               }
                                        ?>
                                    </td>

                                 
                                    <td>
                                        <?php
                                              if ($row['adc_total'] == '') {
                                                    echo '-';
                                               } else {
                                                    echo "". $row['adc_total'] ;
                                               }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                              if ($row['adc_d'] == '') {
                                                    echo '-';
                                               } else {
                                                    echo "". $row['adc_d'] ;
                                               }
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                              if ($row['adc_sell'] == '') {
                                                    echo '-';
                                               } else {
                                                    echo "". $row['adc_sell'] ;
                                               }
                                        ?>
                                    </td>

                                    <td>
                                    <?php
                                    if (empty($row['adc_date']) || empty($row['adc_datesell'])) {
                                        $status = '-';
                                    } else {
                                        $adcDate = strtotime($row['adc_date']);
                                        $adcDateSell = strtotime($row['adc_datesell']);
                                        $currentDate = strtotime(date('Y-m-d'));

                                        if ($currentDate < $adcDateSell) {
                                            $status = 'เลี้ยง';
                                        } else {
                                            $status = 'พร้อมขาย';
                                        }
                                    }
                                    echo $status;
                                    ?>
                                </td>
                                    <td>
                                        <?php
                                              if ($row['mem_name'] == '') {
                                                    echo '-';
                                               } else {
                                                    echo "". $row['mem_name'] ;
                                               }
                                        ?>
                                    </td>

                                            <td class="text-center">
                                    <?php if ($row['zon_id'] == '') {
                                                echo ' ';
                                           } elseif ($row['adc_id'] == '') {
                                                echo '<a href="insert_addkai.php?id=' . $row['hou_id'] . '&name=' . $row['zon_id'].'" class="link-success"><i class="fa fa-plus-circle"></i></a>';
                                            } else {
                                                echo '<a href="insert_sell.php?id=' . $row['hou_id'] . '&name=' . $row['zon_id'] . '&name2=' . $row['adc_id'] .'&o_id=' . $o_id . '" class="link-green"><i class="fa fa-plus-circle"></i></a>';
                                            } ?>
                                            </td>
                                   <td class="text-center">
                                            <?php
                                             if ($row['adc_id'] == '') {
                                                 echo ' ';
                                             }else {
                                                echo '<a data-id="' . $row['adc_id'] . '" href="?delete=' . $row['adc_id'] . '" class="btn btn-danger del-btn fa-solid fa-trash-can "></a>';
                                                } ?>
                                    </td>

                                    <td style="text-align: center;">
                                        <?php
                                        if ($row['adc_id'] == '') {
                                            echo ' ';
                                        } else {
                                            echo '<a href="edit_addkai.php?id=' . $row['adc_id'] . '" class="link-success"><i class="fa-solid fa-pen-to-square fs-3 me-4"></i></a>';
                                        }
                                        ?>
                                    </td>

                                </tr>
                            <?php

                            }
                            ?>

                            </tbody>
                    </table>
                </div>

                <script>
                    $(".del-btn").click(function(e) {
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

    <?php include('footer.php'); ?>


    </body>

    </html>