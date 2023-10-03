<?php
    $adc_num_total = 0;
    $adc_total_total = 0;
    $adc_d_total = 0;
    $adc_sell_total = 0;
?>


<?php

require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI'=> 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'default_font' => 'sarabun'
]);

ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานข้อมูลเพิ่มไก่</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: sarabun;
        }

        .container {
            text-align: center;
            /* Center-align the content within the container */
        }

        .brand-image {
            width: 65px;
            display: block;
            margin: 0 auto;
            /* Center-align the image within the container */
        }

        .table-inputtax-head {
            margin-bottom: 10px;
            width: 100%;
        }

        .table-inputtax-detail {
            border-collapse: collapse;
            width: 100%;
        }

        .table-inputtax-detail,
    td,
    th {
        border: 1px solid #000; /* Use a thicker border by setting the width to 2px and the color to black (#000) */
        text-align: left;
        padding: 4px;
        font-size: 19px;
    }  
    </style>
</head>
<body>
<div class="container">
    <img src="../assets/img/kai.png" alt="AdminLTE Logo" class="brand-image">
    <h2 align="center">รายงานข้อมูลเพิ่มไก่</h2>
    <h4 align="left">ชื่อฟาร์ม : Chicken Farm</h4>
    <h4 align="left">ที่อยู่ของฟาร์ม : Chicken Farm , ต.อานาน , อ.เมือง , จ.เลย 42000</h4>
    <h4 align="left">รายงานข้อมูลเพิ่มไก่ วันที่ :<?php echo date('d-m-Y'); ?></h4>
    <table class="table table-striped  table-inputtax-detail"> 
        <thead>
            <tr>
                <th style="width: 10%;">#</th>
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
              
              $result = mysqli_query($conn, $sql);
              $i = 1 ; 
              $total_zon_num = 0; // 
                while ($row = mysqli_fetch_assoc($result)) {
                if (empty($row['adc_date']) || empty($row['adc_datesell'])) {
                    $status = "-";
                } elseif ($row['adc_date'] == $row['adc_datesell']) {
                    $status = "พร้อมขาย";
                } else {
                    $status = "เลี้ยง";
                }

                if (!empty($row['zon_num'])) {
                    $total_zon_num += intval($row['zon_num']);
                }
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
                                    echo date('d-m-Y', strtotime($row['adc_date']));
                               }
                        ?>
                    </td>
                    <td>
                        <?php
                              if ($row['adc_datesell'] == '') {
                                    echo '-';
                               } else {
                                echo date('d-m-Y', strtotime($row['adc_datesell']));
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
                    <td><?php echo $status ?></td>
                    <td>
                        <?php
                              if ($row['mem_name'] == '') {
                                    echo '-';
                               } else {
                                    echo "". $row['mem_name'] ;
                               }
                        ?>
                    </td>
                </tr>
                <?php
                  $adc_num_total += $row['adc_num'];
                  $adc_total_total += $row['adc_total'];
                  $adc_d_total += $row['adc_d'];
                  $adc_sell_total += $row['adc_sell'];
            }
            ?>

        </tbody>

    </table>

    <div class="row" style="font-size: 20px; font-weight: bold; text-align: left; margin-left: 30px;">
        <span style="margin-right: 10px;">(Total) นำเข้า: <?php echo $adc_num_total; ?> ตัว</span>
        <span style="margin-right: 10px;"> เหลือ: <?php echo $adc_total_total; ?> ตัว</span>
        <span style="margin-right: 10px;"> ตาย: <?php echo $adc_d_total; ?> ตัว</span>
        <span> ขาย: <?php echo $adc_sell_total; ?> ตัว</span>
    </div>

   
    <?php
    $html = ob_get_contents();
    $mpdf->WriteHTML($html);
    $mpdf->Output("addkai.pdf");
    ob_end_flush();
    ?>
    
    <a href="addkai.pdf" class="btn btn-primary">โหลด(pdf)</a>
</div>
</body>
</html>
