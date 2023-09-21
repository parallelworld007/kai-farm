<nav class="main-header  navbar navbar-expand navbar-light navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu"><i class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?php if ($menu == "index"){echo "active";} ?>"  href="index.php"><i class="fas fa-home"></i> Home</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
      <i class="fas fa-user"></i> 
          ยินดีตอนรับ : <?php echo $_SESSION['cus_name']; ?>
        
      </li>
    </ul>
    <ul class="navbar-nav" >

      <li class="nav-item" >
        <a  class="nav-link <?php if ($menu == "cart"){echo "active";} ?>"  href="cart.php"><i  class="nav-icon fa fa-shopping-cart"></i> Cart</a>
      </li>
      
    </ul>
  </nav>
