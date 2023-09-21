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
                $hou_id = $_POST['hou_id'];
                $adc_date = $_POST['adc_date'];
                $adc_num = $_POST['adc_num'];
                
                $sql = "UPDATE `add_chicken` SET `hou_id`='$hou_id', `adc_date`='$adc_date',`adc_num`='$adc_num' WHERE adc_id = $id";

                $result->query( $conn,$sql );
                

                if($sql){
                    $_SESSION['success'] = "Data has been inserted successfully";
                    echo "<script>";
                    echo "Swal.fire({
                        icon: 'success',
                        title: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
                        showConfirmButton: false,
                        timer: 800,
                        })"; 
                    echo "</script>";
                    // echo"<script>window.location.href='addkai.php'</script>";
                    header("refresh:1 ; url=addkai.php"); 
                  
                }
                else{
                    $_SESSION['error'] = "Data has not been inserted successfully";
                }
            }
            ?>

      <div class="card-body">
        <div class="row">
        <div class="col-md-9">
   
        <form action="" method="post" style="width:50vw; min-width:300px;">
                        


                        <?php
                            include "db.php";
                            $sql = "SELECT * FROM `house`";
                            $result =mysqli_query($conn, $sql);
                                                
                        ?>
                                <div class="row">
                                <div class="col">
                                    <label class="form-lable">โรงเรือน</label>
                                    <select name="hou_id" class="form-control" required>
                                        <option value="">เลือกโรงเรือน</option>
                                        <?php foreach($result as $row) { ?>
                                        <option value="<?=$row['hou_id'];?>"><?=$row['hou_name'];?></option>
                                        <?php } ?>
                                    </select>
                                        <?php                             
                                        ?>
                                </div>
                                </div>
                                    
                             
                        <?php
                            $id  = $_GET['id'];
                            $sql = "SELECT * FROM `add_chicken` WHERE  adc_id = $id LIMIT 1";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                        ?>               
                           
                                <div class="row">
                                        <div class="col">
                                            <label class="form-lable">วันที่เพิ่มไก่</label>
                                            <input type="date" class="form-control" name="adc_date" 
                                            value="<?php echo $row['adc_date'] ?>" >
                                        </div>
                                    </div>
    
                                    
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-lable">จำนวนไก่</label>
                                            <input type="text" class="form-control" name="adc_num" 
                                            value="<?php echo $row['adc_num'] ?>" >
                                        </div>
                                    </div>    
    
                                    <br><button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
                                     <a href="addkai.php" class="btn btn-danger">กลับ</a>
                      
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