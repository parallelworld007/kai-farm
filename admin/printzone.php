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
            border: 1px solid #000;
            /* Use a thicker border by setting the width to 2px and the color to black (#000) */
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
        <table class="table table-striped  table-inputtax-detail " style="width:90%">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th>ชื่อโรงเรือน</th>
                    <th>ชื่อโซน</th>
                </tr>
            </thead>
            <tbody>

                <?php
                include "db.php";
                $sql = "SELECT * 
                        FROM house
                        ";
                $result = mysqli_query($conn, $sql);
                $d = 1;

                while ($row = mysqli_fetch_assoc($result)) {

                ?>

                            <tr>
                                <td><?php echo $d++ ?></td>
                                <td><?= $row['hou_name']; ?></td>
                                <td>
                                    <?php
                                    // Fetch the zon_num data for the current hou_id
                                    $sql2 = "SELECT zon_num FROM zone WHERE hou_id = " . $row['hou_id'];
                                    $result2 = mysqli_query($conn, $sql2);

                                    // Create an array to store the zon_num values
                                    $zon_nums = array();

                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        $zon_nums[] = $row2['zon_num'];
                                    }

                                    // Output the zon_num values as a comma-separated string
                                    echo implode(', ', $zon_nums);
                                    ?>
                                </td>
                            </tr>

                    <?php
                    $sql2 = "SELECT h.hou_id, h.hou_name, z.zon_id, z.zon_num
                            FROM zone as z
                            LEFT JOIN house as h ON z.hou_id = h.hou_id
                            WHERE h.hou_id = " . $row['hou_id'];
                    $result2 = mysqli_query($conn, $sql2);
                    $i = 1;
                    ?>


                          
                        </div>

                    
                    <?php
                }
                    ?>

            </tbody>
        </table>

        <div class="row" style="font-size: 20px; font-weight: bold; text-align: left; margin-left: 30px;">
            <?php
            // คำนวณจำนวนข้อมูลในตาราง zone ทั้งหมด
            $sql1 = "SELECT COUNT(*) AS total_zones FROM zone";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $totalZones = $row1['total_zones'];

            echo "จำนวนโซน ทั้งหมด: " . $totalZones . " โซน";
            ?>
        </div>

        <?php
        $html = ob_get_contents();
        $mpdf->WriteHTML($html);
        $mpdf->Output("zone.pdf");
        ob_end_flush();
        ?>
        <a href="zone.pdf" class="btn btn-primary">Print(pdf)</a>
    </div>

</body>


</html>
