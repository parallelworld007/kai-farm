
<?php 
      include('admin/db.php');
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

    <title>Login</title>

</head>
<form action="chk_login.php" method="post">
<body>
   <div class="box">
    <div class="container">

        <div class="top">
            <span>ยินดีตอนรับ</span>
            <header>Login</header>
        </div>

        <div class="input-field">
            <input type="text" class="input" name="mem_username" id="mem_username" placeholder="Username">
            <i class='bx bx-user' ></i>
        </div>

        <div class="input-field">
            <input type="Password" class="input" name="mem_password" id="mem_password" placeholder="Password">
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