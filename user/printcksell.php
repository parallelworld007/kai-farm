<!-- <style>
    .f4 {
        width: 50%;
        margin-top: 5rem;
        margin-left: 35%;
    }
</style>
<form action="" method="GET" class="f4">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>From Date</label>
                <input type="date" name="from_date" value="<?php if (isset($_GET['from_date'])) {
                                                                echo $_GET['from_date'];
                                                            } ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>To Date</label>
                <input type="date" name="to_date" value="<?php if (isset($_GET['to_date'])) {
                                                                echo $_GET['to_date'];
                                                            } ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Click to Filter</label> <br>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </div>
</form> -->

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
    <title>รายงานตรวจสอบรายการสั่งซื้อ</title>
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
        <h2 align="center">รายงานตรวจสอบรายการสั่งซื้อ</h2>
        <h4 align="left">ชื่อฟาร์ม : Chicken Farm</h4>
        <h4 align="left">ที่อยู่ของฟาร์ม : Chicken Farm , ต.อานาน , อ.เมือง , จ.เลย 42000</h4>
        <h4 align="left">รายงานตรวจสอบรายการสั่งซื้อ วันที่ :<?php echo date('d-m-Y'); ?></h4>




        <table class="table table-striped  table-inputtax-detail">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ID</th>
                    <th>ชื่อผู้สั่งสินค้า</th>
                    <th>อีเมลผู้สั่งซื้อ</th>
                    <th>วันที่ในการสั่งซื้อ</th>
                    <th>จำนวน</th>
                    <th>กำหนดรับสินค้า</th>
                    <th>สถานะการชำระ</th>
                    <th>ตรวจสอบรายการสั่งซื้อ</th>
                </tr>
            <tbody>
                <?php
                include "db.php";
                $sql = "SELECT * 
                            FROM order_head 
                            WHERE o_wait <> 'ชำระเงินแล้ว' 
                            ORDER BY o_id ASC;";
                $result = mysqli_query($conn, $sql);

                $rowNumber = 1; // ตัวแปรสำหรับเก็บลำดับ

                while ($row = mysqli_fetch_assoc($result)) {
                    $today = date("Y-m-d");
                    $o_dttm = $row["o_dttm"]; // วันที่จากฐานข้อมูล
                    $new_date = date("Y-m-d", strtotime($o_dttm . " +3 days"));
                    $date_diff = date_diff(date_create($today), date_create($new_date));
                ?>
                    <tr>
                        <td><?php echo $rowNumber; ?></td>
                        <td><?php echo $row['o_id'] ?></td>
                        <td><?php echo $row['o_name'] ?></td>
                        <td><?php echo $row['o_email'] ?></td>
                        <td><?php echo $row['o_dttm'] ?></td>
                        <td><?php echo $row['o_qty'] ?></td>
                        <td> <?php
                                $currentDateTime = date('d-m-Y');
                                $new_date = date("Y-m-d", strtotime($o_dttm . " +3 days"));
                                $currentDateTime1 = new DateTime($currentDateTime);
                                $datetime2 = new DateTime($new_date);

                                if ($currentDateTime1 > $datetime2) {
                                    $daysDifference = 0;
                                    $textColor = 'red'; // สีเขียว
                                } else {
                                    $interval = $currentDateTime1->diff($datetime2);
                                    $daysDifference = $interval->days;
                                    $textColor = 'green'; // สีแดง
                                }

                                // ตรวจสอบสถานะการขาย
                                if ($currentDateTime1 < $datetime2) {
                                    $interval = $currentDateTime1->diff($datetime2);
                                    $daysDifference = $interval->days;
                                    echo '<span style="color: ' . $textColor . '">เหลืออีก ' . $daysDifference . ' วัน</span>';
                                } else {
                                    echo '<span style="color: ' . $textColor . '">เลยกำหนด</span>';
                                }
                                ?></td>
                        <?php
                        if ($row['o_wait'] == "ชำระเงินแล้ว") {
                        ?><td style="color: green;"><?php echo $row['o_wait']; ?></td>
                        <?php } elseif ($row['o_wait'] == "ยังไม่มารับสินค้า") { ?>
                            <td style="color: orange;"><?php echo $row['o_wait']; ?></td>
                        <?php } else { ?>
                            <td style="color: red;"><?php echo $row['o_wait']; ?></td>
                        <?php } ?>

                        <td>
                            <?php
                            echo "ตรวจสอบรายการสั่งซื้อ";
                            ?>
                        </td>   
                    </tr>
                <?php
                    $rowNumber++; // เพิ่มลำดับทีละ 1 หลังจบแถว
                }
                ?>
            </tbody>
        </table>

        <?php
        $html = ob_get_contents();
        $mpdf->WriteHTML($html);
        $mpdf->Output("cksell.pdf");
        ob_end_flush();
        ?>

        <a href="cksell.pdf" class="btn btn-primary">โหลด(pdf)</a>
    </div>
</body>

</html>