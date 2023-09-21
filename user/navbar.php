<nav class="main-header  navbar navbar-expand navbar-light navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu"><i class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?php if ($menu == "test"){echo "active";} ?>"  href="test.php"><i class="fas fa-home"></i> Home</a>
      </li>
      
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" ท>
      <li class="nav-item ">
          <i class="fas fa-user"></i> 
          ยินดีตอนรับ : <?php echo $_SESSION['mem_name']; ?>
        
      </li>
    
    </ul>
  </nav>
