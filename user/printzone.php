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
    <title>รายงานข้อมูลโซน</title>
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
    <h2 align="center">รายงานข้อมูลโซน</h2>
    <h4 align="left">ชื่อฟาร์ม : Chicken Farm</h4>
    <h4 align="left">ที่อยู่ของฟาร์ม : Chicken Farm , ต.อานาน , อ.เมือง , จ.เลย 42000</h4>
    <h4 align="left">รายงานข้อมูลโซน วันที่ :<?php echo date('d-m-Y'); ?></h4>
    <table class="table table-striped  table-inputtax-detail"> 
        <thead>
            <tr>
                <th style="width: 20%;">ไอดีโซน</th>
                <th>ชื่อโรงโซน</th>
                <th>ชื่อโซน</th>
            </tr>
        </thead>
        <tbody>
             <?php 
               include "db.php";
             $sql = "SELECT h.hou_id,h.hou_name,z.zon_id,z.zon_num      
             FROM zone as z
             LEFT JOIN house as h ON z.hou_id = h.hou_id ";
             $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr readonly>
                    <td align='left'> <?php echo $row['zon_id'] ?></td>
                    <td align='left'> <?php echo $row['hou_name'] ?></td>
                    <td align='left'> <?php echo $row['zon_num'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
    $html = ob_get_contents();
    $mpdf->WriteHTML($html);
    $mpdf->Output("zone.pdf");
    ob_end_flush();
    ?>
    <a href="zone.pdf" class="btn btn-primary">โหลด(pdf)</a>
</div>
</body>
</html>
