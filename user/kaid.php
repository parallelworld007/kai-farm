
<?php
require_once "db.php";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE FROM `d_chicken` WHERE d_id = $id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('Data has been deleted successfully');</script>";
        $_SESSION['success'] = "Data has been deleted succesfully";
        header("refresh:1; url=kaid.php");
    }
}
?>

              
