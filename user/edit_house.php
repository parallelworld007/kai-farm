<?php
 ob_start();
 $menu = "house"
?>

<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
        <div class="small-box bg-gradient-olive">
            <div class="inner">
                <h3>แก้ไขชื่อโรงเรือน</h3>
                <p>ตารางแก้ไขข้อมูล</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus text-light"></i>
            </div>
            <a  class="small-box-footer">
                <i class="fas fa-arrow-circle-right"></i>
            </a>
</section>
  <!-- Main content -->
  <section class="content">
    <div class="card card-gray">
      <br>

      <?php
                include "db.php";
                $id = $_GET['id'];

                        if(isset($_POST['submit'])){
                          $hou_name = $_POST['hou_name'];
      
      
                          $sql = "UPDATE `house` SET  `hou_name`='$hou_name'   
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
                                    
              <div class="row" style="padding: 1rem; font-size:18px;">
                    <div class="col-md-8">
                        <label class="form-lable">ชื่อโรงเรือน</label>
                        <input type="text" class="form-control" name="hou_name" 
                        value="<?php echo $row['hou_name'] ?>" required="">
                    </div>
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