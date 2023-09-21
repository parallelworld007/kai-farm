
<?php 
      include('condb.php');
      session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
  <title>MEMBER</title>
</head>
<body>
    <section2>
        <div class="form-box">
            <div class="form-value">
                <form action="chk_login.php" method="post">
                    <h2>MEMBER</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" name="mem_username" id="mem_username" required>
                        <label for="mem_username">username</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="mem_password" id="mem_password" required>
                        <label for="mem_password">Password</label>
                    </div>
                    <button type="submit" name="signin" id="signin" >Log in</button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script> 
    
</body>
</html>