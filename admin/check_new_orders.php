<?php
include "db.php";
$sql = "SELECT COUNT(*) AS newOrders FROM order_head WHERE o_wait = 'รอการชำระเงิน'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
} else {
    echo json_encode(['newOrders' => 0]); // ถ้ามีข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล
}
?>
