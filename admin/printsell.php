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
                <label>กดเพื่อค้นหา</label> <br>
                <button type="submit" class="btn btn-primary">ยืนยัน</button>
            </div>
        </div>
    </div>
</form>
<?php
$total_s_total = 0;
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
        <?php
        $from_date = isset($_GET['from_date']) ? date('d-m-Y', strtotime($_GET['from_date'])) : '';
        $to_date = isset($_GET['to_date']) ? date('d-m-Y', strtotime($_GET['to_date'])) : '';

        if (!empty($from_date) && !empty($to_date)) {
            $date_range = $from_date . ' ถึง ' . $to_date;
        } else {
            $date_range = '-';
        }
        ?>
        <h4 align="left">รายงานข้อมูลขายไก่ วันที่ : <?php echo $date_range; ?></h4>



        <table class="table table-striped  table-inputtax-detail">
            <thead>
                <tr>
                    <th>#</th>
                    <th>โรงเรือน</th>
                    <th>โซน</th>
                    <th>ขาย</th>
                    <th>วันที่ขาย</th>
                    <th>ชื่อผู้ใช้งาน</th>
                </tr>
            <tbody>


                <?php
                include "db.php";

                if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                    $from_date = $_GET['from_date'];
                    $to_date = $_GET['to_date'];
                    $sql = "SELECT
                    d.s_id,
                    h.hou_name,
                    z.zon_num,
                    ad.adc_id,
                    d.s_total,           
                    d.s_num,
                    d.s_date,
                    m.mem_name,
                    od.o_id
                    FROM
                        s_chicken AS d
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
                        JOIN order_head as od ON d.o_id = od.o_id      
                                WHERE s_date BETWEEN '$from_date' AND '$to_date'           
                            ";
                    $i = 1;
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                ?>
                            <tr>
                            <td><?php echo $i++ ?></td>
                                    <td><?php echo $row['hou_name'] ?></td>
                                    <td><?php echo $row['zon_num'] ?></td>
                                
                                    <td><?php echo $row['s_total'] ?></td>
                              
                                 
                                    <td><?php echo date('d-m-Y', strtotime($row['s_date'])); ?></td>
                                    <td><?php echo $row['mem_name'] ?></td>
                                    
                            </tr>
                <?php
                             $total_s_total += $row['s_total'];
                        }
                    } else {
                        echo "No Record Found";
                    }
                }
                ?>


            </tbody>
        </table>

        <div class="row" style="font-size: 20px; font-weight: bold; text-align: left; margin-left: 30px;">
            <span style="margin-right: 10px;">Total (ขาย): <?php echo $total_s_total; ?></span>
            
        </div>

        <?php
        $html = ob_get_contents();
        $mpdf->WriteHTML($html);
        $mpdf->Output("s_chicken.pdf");
        ob_end_flush();
        ?>

        <a href="s_chicken.pdf" class="btn btn-primary">โหลด(pdf)</a>
    </div>
</body>

</html>