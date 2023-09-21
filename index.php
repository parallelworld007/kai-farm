
<?php 
      include('admin/db.php');
      session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="index.css">
  <title>Customer</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="chk_login2.php" method="post">
                    <h2>Login</h2>
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
                    <button type="submit" name="signin" id="signin" >Log in</button>
                    <div class="register">
                        <p>Don't have a account <a href="register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>