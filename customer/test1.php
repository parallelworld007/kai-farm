<!DOCTYPE html>
<html>
<head>
    <title>บิลเงินสด</title>
    <style>
        /* CSS สำหรับออกแบบบิล */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .invoice {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
        }

        .item-list {
            margin-top: 20px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .total {
            margin-top: 20px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <?php
        // ข้อมูลสินค้าที่ต้องการแสดงในบิล (เก็บในอาร์เรย์)
        $products = array(
            array("ชื่อสินค้า" => "เสื้อยืด", "ราคา" => 350),
            array("ชื่อสินค้า" => "กางเกงยีนส์", "ราคา" => 890),
            array("ชื่อสินค้า" => "รองเท้าผ้าใบ", "ราคา" => 1200),
        );

        // คำนวณราคารวมทั้งหมด
        $totalPrice = array_reduce(
            $products,
            function ($accumulator, $product) {
                return $accumulator + $product['ราคา'];
            },
            0
        );
    ?>

    <div class="invoice">
        <div class="header">
            <h1>บิลเงินสด</h1>
        </div>
        <div class="item-list">
            <?php foreach ($products as $product): ?>
                <div class="item">
                    <span><?php echo $product['ชื่อสินค้า']; ?></span>
                    <span><?php echo $product['ราคา']; ?> บาท</span>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="total">
            ราคารวมทั้งหมด: <?php echo $totalPrice; ?> บาท
        </div>
    </div>
</body>
</html>