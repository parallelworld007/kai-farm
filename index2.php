
<?php 
      include('condb.php');
      session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js" integrity="sha256-5WYg3s9NxGKR2MpEBTy0QMT3Gvgxl3yKjbW4l0CfUUY=" crossorigin="anonymous"></script>

    <title>Login</title>

</head>
<form action="chk_login2.php" method="post">
<body>
   <div class="box">
    <div class="container">

        <div class="top">
            <span>ยินดีตอนรับ</span>
            <header>Login</header>
        </div>

        <div class="input-field">
            <input type="text" class="input" name="cus_username" id="cus_username" placeholder="Username">
            <i class='bx bx-user' ></i>
        </div>

        <div class="input-field">
            <input type="Password" class="input" name="cus_password" id="cus_password" placeholder="Password">
            <i class='bx bx-lock-alt'></i>
        </div>

        <div class="input-field">
            <?php
    echo "<input type='submit' class='submit' onclick='callAlert()' value='Login'>";
                ?>
        </div>
   

    </div>
</div>  
</body>
</form>
</html>