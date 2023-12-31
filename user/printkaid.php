<style>
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
</form>

<?php
$total_d_total = 0;
$remaining_chickens = 0;
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
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'B' => 'sarabun'
]);

ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานข้อมูลไก่ตาย</title>
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
        <h1 align="center" style="margin-top: 2.5rem;">รายงานข้อมูลไก่ตาย</h1>
        <h4 align="left">ชื่อฟาร์ม : Chicken Farm</h4>
        <h4 align="left">ที่อยู่ของฟาร์ม : Chicken Farm , ต.อานาน , อ.เมือง , จ.เลย 42000</h4>
        <h4 align="left">รายงานข้อมูลไก่ตาย วันที่ :<?php echo date('d-m-Y'); ?></h4>

        <table class="table table-striped  table-inputtax-detail">
            <thead>
                <tr>
                    <th>#</th>
                    <th>โรงเรือน</th>
                    <th>โซน</th>
                    <th>ตาย</th>
                    <th>สาเหตุ</th>
                    <!-- <th>เหลือ</th> -->
                    <th>วันที่ตาย</th>
                    <th>ชื่อผู้ใช้งาน</th>
                </tr>
              

            <tbody>
          
                <?php
                include "db.php";


                if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                    $from_date = $_GET['from_date'];
                    $to_date = $_GET['to_date'];

                    $sql = "SELECT
                                    d.d_id,
                                    h.hou_name,
                                    z.zon_num,
                                    ad.adc_id,
                                    d.d_total,
                                    d.d_note,
                                    d.d_num,
                                    d.d_date,
                                    m.mem_name
                                    FROM
                                        d_chicken AS d
                                    JOIN house AS h
                                    ON
                                        d.hou_id = h.hou_id
                                    JOIN zone AS z
                                    ON
                                        d.zon_id = z.zon_id
                                    JOIN add_chicken AS ad
                                    ON
                                        d.adc_id = ad.adc_id
                                    JOIN tbl_member AS m
                                    ON  
                                        d.mem_id = m.mem_id 
                                     WHERE d_date BETWEEN '$from_date' AND '$to_date' 
                                     ";
                    $result = mysqli_query($conn, $sql);

                    $i = 1;



                    if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['hou_name'] ?></td>
                                <td><?php echo $row['zon_num'] ?></td>
                                <td><?php echo $row['d_total'] ?></td>
                                <td>
                                    <?php
                                    if ($row['d_id'] == '') {
                                        echo '-';
                                    } else {

                                        switch ($row['d_note']) {
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
                                        echo '<span class="badge-pill " ><a = "?d_id=' . $row['d_id'] . '&d_note=' . $row['d_note'] . '"  style="color: #000000;">' . $note . '</a></span>';
                                    }
                                    ?>

                                </td>
                                <!-- <td>
                                    <?php
                                    // Calculate the remaining chickens
                                    $remaining_chickens = $row['d_num'] - $row['d_total'];
                                    echo "" . $remaining_chickens;
                                    ?>

                                </td> -->
                                <td><?php echo date('d-m-Y', strtotime($row['d_date'])); ?></td>
                                <td> <?php echo $row['mem_name'] ?></td>
                            </tr>
                <?php
                            $total_d_total += $row['d_total'];

                        }
                    } else {
                        echo "No Record Found";
                    }
                }
                ?>

                
            
            </tbody>
            

        </table>
        
    

        <div class="row" style="font-size: 16px; text-align: left; margin-left: 30px;">
            <span style="margin-right: 10px;">Total (ตาย): <?php echo $total_d_total; ?></span>
            <!-- <span style="margin-right: 10px;">Total (เหลือ): <?php echo $remaining_chickens; ?></span> -->
        </div>

        <?php
            $html = ob_get_contents();
            $mpdf->WriteHTML($html);
            $mpdf->Output("kaid.pdf");
            ob_end_flush();
        ?>

        <a href="kaid.pdf" class="btn btn-primary">โหลด(pdf)</a>


    </div>
</body>

</html>