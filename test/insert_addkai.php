<?php include("header.php"); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <h1>Index</h1>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card card-gray">
      <div class="card-header ">
        <h3 class="card-title">....</h3>
        <div align="right">
  
        </div>
      </div>
      <?php
            include "db.php";
            if(isset($_POST['submit'])){
                $hou_id = $_POST['hou_id'];
                $adc_date = $_POST['adc_date'];
                $adc_num = $_POST['adc_num'];
                
                $sql = "INSERT INTO `add_chicken`( `hou_id`, `adc_date`, `adc_num`) 
                        VALUES ('$hou_id','$adc_date','$adc_num')";

                $result = mysqli_query($conn, $sql);
                

                if($sql){
                    $_SESSION['success'] = "Data has been inserted successfully";
                    echo "<script>";
                    echo "Swal.fire({
                        icon: 'success',
                        title: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
                        showConfirmButton: false,
                        timer: 1500,
                        })";
                    echo "</script>";
                    header("refresh:1 ; url=addkai.php");
                }
                else{
                    $_SESSION['error'] = "Data has not been inserted successfully";
                    header("Location: addkai.php");
                }
            }
            ?>
      <br>
      <div class="card-body">
        <div class="row">
          
          <div class="col-md-6">
          <form action="" method="post" style="width:50vw; min-width:300px;">
                       
                       <?php
                                   include "db.php";
                                       $sql = "SELECT * FROM `house`";
                                       $result = mysqli_query($conn, $sql);
                                       
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
                                       
                       <div>
       
       
                       <div class="row">
                           <div class="col">
                               <label class="form-lable">วันที่เพิ่มไก่</label>
                               <input type="date" class="form-control" name="adc_date" 
                               placeholder="โปรดใส่ข้อมูล" required>
                           </div>
                       </div>
       
                       <div class="row">
                           <div class="col">
                               <label class="form-lable">จำนวนไก่ที่เพิ่ม</label>
                               <input type="text" class="form-control" name="adc_num" 
                               placeholder="โปรดใส่ข้อมูล" required>
                           </div>
                       </div>
       
                       <br>
       
                           <button id="submit" type="submit" class="btn btn-success" name="submit" >Save</button>
                           <a href="addkai.php" class="btn btn-danger">Cancle</a>
                         
                       </div>
       
                   </form>
      









          
          </div>
          
        </div>
      </div>
      <div class="card-footer">
        
      </div>
      
    </div>
    
    
    
    
  </section>
  <!-- /.content -->
  
  
  <?php include('footer.php'); ?>

</body>
</html>
