<?php
include('condb.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="index.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script> 
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <title>Register</title>
</head>

<body>
    <section>
        <?php
        include "condb.php";
        if (isset($_POST['submit'])) {
            $cus_username = $_POST['cus_username']; $cus_password = $_POST['cus_password']; $cus_name = $_POST['cus_name'];

            //เช็คข้อมูลซ้ำ
            $sql = "SELECT * FROM `tbl_customer` WHERE cus_username = '$cus_username' ";
            $result = mysqli_query($conn, $sql);
            //echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result); 

            if (mysqli_num_rows($result) > 0) {
                echo "<script>"; echo "Swal.fire({icon: 'error',title: 'ไอดีนี้ถูกใช้แล้ว',showConfirmButton: false,})";
                echo "</script>";
                header("refresh:1 ; url=register.php");
            } else {
                $sql = "INSERT INTO `tbl_customer`( `cus_username`,`cus_password`,`cus_name` ) VALUES ('$cus_username','$cus_password','$cus_name')";
                $result = mysqli_query($conn, $sql);

                if ($sql) {
                    $_SESSION['success'] = "Data has been inserted successfully";
                    echo "<script>"; echo "Swal.fire({  icon: 'success',  title: 'สมัครไอดีเรียบร้อยแล้ว', showConfirmButton: false, timer: 1500, })"; echo "</script>";
                    header("refresh:1 ; url=index.php");
                }
            }
        } ?>
        <div class="form-box">
            <div class="form-value">
                <form action="register.php" method="POST">
                    <h2 style="margin-top: 0px;">Register</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" name="cus_username" id="cus_username" required>
                        <label for="cus_username">username</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="cus_password" id="cus_password" required>
                        <label for="cus_password">Password</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="cus_name" id="cus_name" required>
                        <label for="cus_name">name</label>
                    </div>
                    <button id="submit" name="submit" type="submit" >Register</button>
                    <div class="register">
                        <p>have a account back to <a href="index.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>

    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>