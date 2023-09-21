<?php
 ob_start();
?>

<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <h1>เพิ่มข้อมูลไก่</h1>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card card-gray">
      <div class="card-header ">
        <h3 class="card-title">-----------</h3>
       
      </div>
      <br>

      <?php
                include "db.php";
                $id = $_GET['id'];

                if(isset($_POST['submit'])){
                    $hou_name = $_POST['hou_name'];
                    $hou_sta = $_POST['hou_sta'];

                    $sql = "UPDATE `house` SET  `hou_name`='$hou_name',    `hou_sta`='$hou_sta'     
                            WHERE hou_id = $id";
                    $result = mysqli_query($conn, $sql);

                    if($sql){
                        $_SESSION['success'] = "Data has been inserted successfully";
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขเรียบร้อยแล้ว',
                            showConfirmButton: false,
                            timer: 1500,
                            })";
                         echo "</script>";
                         header("refresh:1 ; url=house.php");
                    }
                    else{
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("Location: house.php");
                    }
                }
            ?>

      <div class="card-body">
        <div class="row">
        <div class="col-md-9">
   
        <form action="" method="post" style="width:50vw; min-width:300px;">
                        


              <?php
                  $id  = $_GET['id'];
                  $sql = "SELECT * FROM `house` WHERE  hou_id = $id LIMIT 1";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
              ?>
                                    
              <div class="row">
                    <div class="col">
                        <label class="form-lable">ชื่อโรงเรือน</label>
                        <input type="text" class="form-control" name="hou_name" 
                        value="<?php echo $row['hou_name'] ?>" required="">
                    </div>
                </div>


                <div class="form-groud" style="padding: 1rem; font-size:18px;">
                            <label style="margin-right: 1.5rem;">Status:</label> &nbsp;
                            <input type="radio" class="form-check-input btn-info" name="hou_sta"
                            id="พร้อมขาย" value="พร้อมขาย" <?php echo ($row['hou_sta']=='พร้อมขาย')? 
                            "checked":""; ?>>
                            <label style="margin-right: 1.5rem;" for="พร้อมขาย" class="form-input-lable">พร้อมขาย</label>
                            
                            <input type="radio" class="form-check-input btn-danger" name="hou_sta"
                            id="ไม่พร้อมขาย"  value="ไม่พร้อมขาย"  <?php echo ($row['hou_sta']=='ไม่พร้อมขาย')? 
                            "checked":""; ?>>
                            <label  for="ไม่พร้อมขาย" class="form-input-lable ">ไม่พร้อมขาย</label>
                </div>
                <button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                                     <a href="house.php" class="btn btn-danger">กลับ</a>
                      
                    </div>
    
                </form>
        
    

          </div>
          
        </div>
      </div>
      <div class="card-footer">
      </div>
      
    </div>
  <?php include('footer.php'); ?>
</body>
</html>