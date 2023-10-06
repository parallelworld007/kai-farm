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
            'BI' => 'THSarabunNew BoldItalic.ttf'
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
    <title>รายงานข้อมูลลูกค้า</title>
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
        <h2 align="center" style="margin-top: 2.5rem;">รายงานข้อมูลลูกค้า</h2>
        <h4 align="left">ชื่อฟาร์ม : Chicken Farm</h4>
        <h4 align="left">ที่อยู่ของฟาร์ม : Chicken Farm , ต.อานาน , อ.เมือง , จ.เลย 42000</h4>
        <h4 align="left">รายงานข้อมูลลูกค้า วันที่ :<?php echo date('d-m-Y'); ?></h4>
        <table class="table table-striped  table-inputtax-detail"> 
            <thead>
                <tr>
                    <th>#</th>
                    <th>ไอดีลูกค้า</th>
                    <th>ชื่อลูกค้า</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทร</th>
                    <th>เพศ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "db.php";
                $sql = "SELECT * FROM `tbl_customer`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>

                        <td><?php echo $row['cus_id'] ?></td>
                        <td><?php echo $row['cus_username']?></td>
                        <td><?php echo $row['cus_name'] ?></td>
                        <td><?php echo $row['cus_add'] ?></td>
                        <td><?php echo $row['cus_tel'] ?></td>
                        <td>
                            <?php
                            if ($row['cus_gender'] == 1) {
                                echo 'ชาย';
                            } elseif ($row['cus_gender'] == 2) {
                                echo 'หญิง';
                            } else {
                                echo 'ไม่ระบุ';
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
        <?php

// สร้างตัวแปรเพื่อเก็บข้อมูลผู้ใช้งานในแต่ละกลุ่ม
        $totalMale = 0;
        $totalFemale = 0;


        include "db.php";
        $sql = "SELECT * FROM `tbl_customer`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            
            // คำนวณผลรวมข้อมูลเพศและระดับการใช้งาน
            if ($row['cus_gender'] == 1) {
                $totalMale++;
            } elseif ($row['cus_gender'] == 2) {
                $totalFemale++;
            }
            
        }
// แสดงผลรวมข้อมูลเพศ
?>
<div class="row" style="font-size: 20px; font-weight: bold; text-align: left; margin-left: 30px;">
    <span style="margin-right: 10px;">(Total) ชาย: <?php echo $totalMale; ?> คน</span>,
    <span style="margin-right: 10px;">หญิง: <?php echo $totalFemale; ?> คน</span>
</div>


        <?php
        $html = ob_get_contents();
        $mpdf->WriteHTML($html);
        $mpdf->Output("cus.pdf");
        ob_end_flush();
        ?>
        <a href="cus.pdf" class="btn btn-primary">Print(pdf)</a>
    </div>
</body>

</html>