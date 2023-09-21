<?php
 ob_start();
 $menu = "edit_cus"
?>

<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
        <div class="small-box bg-gradient-olive">
            <div class="inner">
                <h3>แก้ไข</h3>
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
                $cus_username = $_POST['cus_username'];
                $cus_password = $_POST['cus_password'];
                $cus_name = $_POST['cus_name'];
                $cus_add = $_POST['cus_add'];
                $cus_tel = $_POST['cus_tel'];
                $cus_gender = $_POST['cus_gender'];
                
                $sql = "UPDATE `tbl_customer` SET `cus_username`='$cus_username',`cus_password`='$cus_password',`cus_name`='$cus_name' 
                ,`cus_add`='$cus_add',`cus_tel`='$cus_tel',`cus_gender`='$cus_gender'WHERE cus_id = $id";

                $result = mysqli_query($conn, $sql);
                

                if($sql){
                    $_SESSION['success'] = "Data has been inserted successfully";
                    echo "<script>";
                    echo "Swal.fire({
                        icon: 'success',
                        title: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
                        showConfirmButton: false,
                        timer: 1500,
                        })";
                    echo "</script>";
                    header("refresh:1 ; url=index.php");
                }
                else{
                    $_SESSION['error'] = "Data has not been inserted successfully";
                    header("Location: list_cus.php");
                }
            }
            ?>

      <div class="card-body">
        <div class="row">
        <div class="col-md-9">
   
        <form action="" method="post" style="width:40vw;">
                        
                                  
                             
                        <?php
                            $id  = $_GET['id'];
                            $sql = "SELECT * FROM `tbl_customer` WHERE  cus_id = $id LIMIT 1";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                        ?>               
                       
                                    <div class="form-group row">

                                        <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                            <label class="form-lable">ไอดีผู้ใช้</label>
                                            <input type="text" class="form-control" name="cus_username" placeholder="ไอด๊ที่ใช้สมัคร"
                                            value="<?php echo $row['cus_username'] ?>">
                                        </div>
                                        <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                            <label class="form-lable">รหัส</label>
                                            <input type="Password" class="form-control" name="cus_password" placeholder="รหัสที่ใช้สมัคร"
                                            value="<?php echo $row['cus_password'] ?>">
                                        </div>
                                        <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                            <label class="form-lable">ชื่อผู้ใช้</label>
                                            <input type="text" class="form-control" name="cus_name" placeholder="ชื่อที่ใช้สมัคร"
                                            value="<?php echo $row['cus_name'] ?>">
                                        </div>
                                        <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                            <label class="form-lable">ที่อยู่</label>
                                            <input type="text" class="form-control" name="cus_add" placeholder="cus_add" value="<?php echo $row['cus_add'] ?>">
                                        </div>
                                        <div class="col-sm-10" style="margin:0.8rem 0 ;">
                                            <label class="form-lable">เบอร์โทร</label>
                                            <input type="text" class="form-control" name="cus_tel" placeholder="cus_tel" value="<?php echo $row['cus_tel'] ?>">
                                        </div>
                                        <div class="col-10" style="margin:0.8rem 0 ;">
                                            <label clas="form-lable">เพศ</label>
                                            <select class="form-control select2" name="cus_gender" id="cus_gender" >
                                                <option value="" <?php echo ($row['cus_gender'] == '') ? "selected" : ""; ?>>-</option>
                                                <option value="1" <?php echo ($row['cus_gender'] == '1') ? "selected" : ""; ?>>ชาย</option>
                                                <option value="2" <?php echo ($row['cus_gender'] == '2') ? "selected" : ""; ?>>หญิง</option>
                                            </select>
                                        </div>

                                    </div>

                                  
    
                                    <br><button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                                     <a href="index.php" class="btn btn-danger">กลับ</a>
                      
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