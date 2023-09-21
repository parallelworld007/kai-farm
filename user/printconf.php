
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
    <title>รายงานการขายไก่</title>
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
            margin-top: 2.5rem;
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
            border: 1px solid #000;
            /* Use a thicker border by setting the width to 2px and the color to black (#000) */
            text-align: left;
            padding: 4px;
            font-size: 18px;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <img src="../assets/img/kai.png" alt="AdminLTE Logo" class="brand-image">
        <h2 align="center">รายงานการขายไก่</h2>
        <h4 align="left">ชื่อฟาร์ม : Chicken Farm</h4>
        <h4 align="left">ที่อยู่ของฟาร์ม : Chicken Farm , ต.อานาน , อ.เมือง , จ.เลย 42000</h4>
        <h4 align="left">รายงานการขายไก่ วันที่ :<?php echo date('d-m-Y'); ?></h4>




        <table class="table table-striped  table-inputtax-detail">
            <thead>
            <tr >
                <th >ID</th>
                <th >ชื่อผู้สั่งสินค้า</th>
                <th >อีเมลผู้สั่งซื้อ</th>
                <th >วันที่ในการสั่งซื้อ</th>
                <th >สถานะการชำระ</th>
                <th >จำนวนเงิน</th>
            </tr>
            <tbody>
            <?php
            include "db.php";
            $sql = "SELECT o_id,o_name,o_email,o_dttm,o_wait,o_total
            FROM order_head
            WHERE o_wait = 'ชำระเงินแล้ว'";

            $result = mysqli_query($conn, $sql);
            // echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr readonly >

                    <td><?php echo $row['o_id'] ?></td>
                    <td><?php echo $row['o_name'] ?></td>
                    <td ><?php echo $row['o_email'] ?></td>
                    <td ><?php echo $row['o_dttm'] ?></td>
                    
                    <?php
                     if ($row['o_wait'] == "ชำระเงินแล้ว") {
                      ?><td style="color: green; "><?php echo $row['o_wait']; ?></td>
                      <?php }
                      elseif ($row['o_wait'] == "ยังไม่ได้ตรวจสอบ") {
                        ?><td style="color: purple; "><?php echo $row['o_wait']; ?></td>
                        <?php }
                      else {
                      ?> <td style="color: red;"><?php echo $row['o_wait']; ?></td> <?php }  ?>
                      
                      <td ><?php echo  number_format( $row['o_total'], 2 ) ?> บาท</td>



                </tr>
            <?php

            }
            ?>
            </tbody>
        </table>

        <?php
        $html = ob_get_contents();
        $mpdf->WriteHTML($html);
        $mpdf->Output("conf.pdf");
        ob_end_flush();
        ?>

        <a href="conf.pdf" class="btn btn-primary">โหลด(pdf)</a>
    </div>
</body>

</html>