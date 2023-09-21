<?php
 ob_start();
?> 

<?php 
    session_start();
    require_once "db.php";
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = $conn->query("DELETE FROM `care` WHERE car_id = $id");
        $deletestmt->execute();
        
        if ($deletestmt) {
            echo "<script>alert('Data has been deleted successfully');</script>";
            $_SESSION['success'] = "Data has been deleted succesfully";
            header("refresh:1; url=care.php");
        }
    }
?>


<!-- Content Header (Page header) -->
<?php include("header.php"); ?>

<section class="content-header">
  <div class="container-fluid">
    <h1>เพิ่มข้อโซนไก่</h1>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card card-gray">
      <div class="card-header ">
        <h3 class="card-title">รายการเพิ่มข้อมูลโซนไก่</h3>
        <div align="right">
          
          <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
          
        </div>
      </div>
      <br>
      <div class="card-body">
        <div class="row">
        
        <div class="col-md-9">
   

        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
                <tr class="info">    
                <th>id</th>
                <th>โซน</th>
                <th>จำนวนไก่</th>
                <th>วันที่</th>
                <th>สาเหตุ</th>
                <th>สถานะ</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            </thead>

            <tbody>   

            <?php
                            include "db.php";
                            $sql = "SELECT c.car_id , z.zon_num , c.car_num , c.car_date, c.car_note , c.car_sta
                                    FROM care as c
                                    INNER JOIN zone as z ON c.zon_id = z.zon_id";
                            $result =mysqli_query($mysqli, $sql);
                            while ($row = mysqli_fetch_assoc($result)){
                                ?>
                                
                                <tr>
                                    <td><?php echo $row['car_id'];?></td> 
                                    <td><?php echo $row['zon_num'];?></td>                        
                                    <td><?php echo $row['car_num'];?></td>
                                    <td><?php echo $row['car_date'];?></td>
                                    <td><?php echo $row['car_note'];?></td>  
                                    <td>
                                            <?php 
                                            
                                                if($row['car_sta']==1){
                                                    echo '<p><a href="status.php?car_id='.$row['car_id'].'&car_sta=0"   style="border:none" class="text-bg-success" >ปกติ</a></p>';    
                                                } else{
                                                    echo '<p><a href="status.php?car_id='.$row['car_id'].'&car_sta=1"   class="text-bg-warning">ป่วย</a></p>';
                                                }                                          
                                            ?>
                                    </td>                        
                                    <td>
                                            <a href="edit_care.php?id=<?php echo $row['car_id']?>" 
                                            class="link-Info"><i class="fa-solid fa-pen-to-square fs-5 me-3 "></i></i></a>
                                    </td>
                                    <td>
                                            <a data-id="<?= $row['car_id']; ?>" href="?delete=<?= $row['car_id']; ?>" 
                                            class="btn  btn-danger delete-btn fa-solid fa-trash-can " ></a>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>

                                </tbody>
                    </table>
    </div>


   <!--sweetalert2 ลบข้อมูล --> 
    <script>

        $(".delete-btn").click(function(e) {
            var userId = $(this).data('id');
            e.preventDefault();
            deleteConfirm(userId);
        })
        function deleteConfirm(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "คุณต้องการลบข้อมูล!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'care.php',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'Data deleted successfully!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'care.php';
                                })
                            })
                            .fail(function() {
                                Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
    </script>
    

          </div>
          
        </div>
      </div>
      <div class="card-footer">
        +++++++
      </div>
      
    </div>

<!-- เพิ่มโรงเรือน -->
<?php
           include "db.php";

           if(isset($_POST['submit'])){
           
               $zon_id = $_POST['zon_id'];
               $car_num = $_POST['car_num'];
               $car_date = $_POST['car_date'];
               $car_note = $_POST['car_note'];
               $car_sta = $_POST['car_sta'];
              
               
               $sql = "INSERT INTO care ( zon_id , car_num, car_date , car_note, car_sta) 
                       VALUES ('$zon_id','$car_num','$car_date','$car_note','$car_sta')";

               $result = mysqli_query($mysqli, $sql);

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
                   header("refresh:1 ; url=care.php");
               }
               else{
                   $_SESSION['error'] = "Data has not been inserted successfully";
                   header("Location: care.php");
               }
           }
           ?>

    <div class="modal fade" id="exampleModal" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <form action="care.php" method="POST" >
        <input type="hidden" name="member" value="add">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
          </div>
          <div class="modal-body">
            <div class="form-group row">

            <?php
                            include "db.php";
                                $sql = "SELECT * FROM `zone`";
                                $result =mysqli_query($mysqli, $sql);
                                                    ?>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-lable">โซน</label>
                                        <select name="zon_id" class="form-control" required>
                                            <option value="">เลือกโซน</option>
                                            <?php foreach($result as $row) { ?>
                                            <option value="<?=$row['zon_id'];?>"><?=$row['zon_num'];?></option>
                                            <?php } ?>
                                        </select>
                                        <?php
                                                
                                            ?>
                                    </div>
                                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-lable">จำนวน</label>
                        <input type="text" class="form-control" name="car_num" 
                        placeholder="โปรดใส่ข้อมูล" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-lable">วันที่</label>
                        <input type="date" class="form-control" name="car_date" 
                        placeholder="โปรดใส่ข้อมูล" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-lable">สาเหตุ</label>
                        <input type="text" class="form-control" name="car_note" 
                        placeholder="ไม่มีสาเหตุไม่ต้องใส่" >
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="form-lable">สถานะ 1=ปกติ 0=ป่วย </label>
                        <input type="number" class="form-control" name="car_sta" 
                        placeholder="โปรดใส่ข้อมูล" required>
                    </div>
                </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
          <button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> ยืนยัน</button>
        </div>
      </div>
    </form>
  </div>
</div> 
  <?php include('footer.php'); ?>
  
</body>
</html>