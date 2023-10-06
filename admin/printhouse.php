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
    <title>รายงานข้อมูลโรงเรือน</title>
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
    <h2 align="center">รายงานข้อมูลโรงเรือน</h2>
    <h4 align="left">ชื่อฟาร์ม : Chicken Farm</h4>
    <h4 align="left">ที่อยู่ของฟาร์ม : Chicken Farm , ต.อานาน , อ.เมือง , จ.เลย 42000</h4>
    <h4 align="left">รายงานข้อมูลโรงเรือน วันที่ :<?php echo date('d-m-Y'); ?></h4>
    
    <table class="table table-striped table-inputtax-detail" >
        <thead>
            <tr>
                <th style="width:15%;">#</th>
                <th>ชื่อโรงเรือน</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "db.php";
            $sql = "SELECT * FROM `house`";
            $result = mysqli_query($conn, $sql);
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr readonly>
                    <td align='left'> <?php echo $i++ ?></td>
                    <td align='left'> <?php echo $row['hou_name'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

        <div class="row" style="font-size: 20px; font-weight: bold; text-align: left; margin-left: 30px;">
                <span style="margin-right: 10px;">(Total)ทั้งหมด : <?php echo mysqli_num_rows($result); ?> โรงเรือน</span>
        </div>
    <?php
    $html = ob_get_contents();
    $mpdf->WriteHTML($html);
    $mpdf->Output("house.pdf");
    ob_end_flush();
    ?>
    <a href="house.pdf" class="btn btn-primary">Print(pdf)</a>
</div>
</body>
</html>
