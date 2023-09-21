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
              $zon_id = $_POST['zon_id'];
              $car_num = $_POST['car_num'];
              $car_date = $_POST['car_date'];
              $car_note = $_POST['car_note'];
              



              $sql = "UPDATE `care` SET `zon_id`='$zon_id',`car_num`='$car_num',`car_date`='$car_date',`car_note`='$car_note'   
                      WHERE car_id = $id";
              $result->query( $conn,$sql );

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
                   header("refresh:1 ; url=care.php");
              }
              else{
                  $_SESSION['error'] = "Data has not been inserted successfully";
                  header("Location: care.php");
              }
          }
      ?>

      <div class="card-body">
        <div class="row">
        <div class="col-md-9">
   
        <form action="" method="post" style="width:40vw;">
                        

                <?php
                    include "db.php";
                     $sql = "SELECT * FROM `zone`";
                     $result->query( $conn,$sql );
                ?>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-lable">โซนไก่</label>
                                        <select name="zon_id" class="form-control" required>
                                        <option value="">เลือกโซนไก่</option>
                                            <?php foreach($result as $row) { ?>
                                            <option value="<?=$row['zon_id'];?>"><?=$row['zon_num'];?></option>
                                            <?php } ?>
                                        </select>
                                        <?php                           
                                            ?>
                                    </div>
                                </div>



                <?php
                    $id  = $_GET['id'];
                    $sql = "SELECT `car_id`,`zon_id`, `car_date`, `car_note`, `car_num` FROM `care` WHERE `car_id` = $id";
                    $result->query( $conn,$sql );
                    $row = mysqli_fetch_assoc($result);
                ?>               
                                        
                                <div class="row">
                                    <div class="col">
                                        <label class="form-lable">จำนวน</label>
                                        <input type="number" class="form-control" name="car_num" 
                                        value="<?php echo $row['car_num'] ?>" required="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label class="form-lable">วันที่</label>
                                        <input type="date" class="form-control" name="car_date" 
                                        value="<?php echo $row['car_date'] ?>" required="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label class="form-lable">สาเหตุ</label>
                                        <input type="text" class="form-control" name="car_note" 
                                        value="<?php echo $row['car_note'] ?>" required="">
                                    </div>
                                </div>
    
                                    <br><button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                                     <a href="care.php" class="btn btn-danger">กลับ</a>
                      
                    </div>
    
        </form>
        
    

          </div>
        </div>

      </div>
      <div class="card-footer">
        ---------
      </div>
      
    </div>
  <?php include('footer.php'); ?>
</body>
</html>