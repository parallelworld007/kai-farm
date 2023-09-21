<?php
 ob_start();
?> 

<?php 
    session_start();
    require_once "db.php";
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = $conn->query("DELETE FROM `zone` WHERE zon_id = $id");
        $deletestmt->execute();
        
        if ($deletestmt) {
            echo "<script>alert('Data has been deleted successfully');</script>";
            $_SESSION['success'] = "Data has been deleted succesfully";
            header("refresh:1; url=zone.php");
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
                <th>โรงเรือน</th>
                <th>โซน</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            </thead>

            <tbody>   

            <?php
                            include "db.php";
                                $sql = "SELECT z.zon_id , h.hou_name , z.zon_num 
                                        FROM zone as z 
                                        INNER JOIN house as h ON z.hou_id = h.hou_id";
                                $result =mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['zon_id']?></td>
                                        <td><?php echo $row['hou_name']?></td>
                                        <td><?php echo $row['zon_num']?></td>                                                                           
                                        <td>
                                            <a href="edit_zone.php?id=<?php echo $row['zon_id']?>" 
                                            class="link-Info"><i class="fa-solid fa-pen-to-square fs-5 me-3 "></i></i></a>
                                    </td>
                                    <td>
                                            <a data-id="<?= $row['zon_id']; ?>" href="?delete=<?= $row['zon_id']; ?>" 
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
                                url: 'zone.php',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'Data deleted successfully!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'zone.php';
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
      </div>
      
    </div>

<!-- เพิ่มโรงเรือน -->
<?php
            include "db.php";
            if(isset($_POST['submit'])){
                $hou_id = $_POST['hou_id'];
                $zon_num = $_POST['zon_num'];
                
               //เช็คข้อมูลซ้ำ
                $sql = "SELECT * FROM `zone` WHERE  zon_num='$zon_num' ";
                $result =mysqli_query($conn, $sql);
                //echo 'จำนวนข้อมูลที่ query ได้' .mysqli_num_rows($result); 
            
                if(mysqli_num_rows($result) > 0){
                    echo "<script>";
                    echo "Swal.fire({
                        icon: 'error',
                        title: 'โซน นี้มีในมีอยู่ตารางแล้ว',
                        showConfirmButton: false,                
                        })";
                    echo "</script>";
                    header("refresh:1 ; url=zone.php");

                }else{
                    $sql = "INSERT INTO `zone`( `hou_id`,`zon_num` ) 
                    VALUES ('$hou_id','$zon_num')";
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
                        header("refresh:1 ; url=zone.php");
                    }
                    else{
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("Location: zone.php");
                    }
                }
            }
            
            ?>

    <div class="modal fade" id="exampleModal" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <form action="zone.php" method="POST" >
        <input type="hidden" name="member" value="add">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
          </div>
          <div class="modal-body">
            <div class="form-group row">

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

                                <div class="row">
                                    <div class="col">
                                        <label class="form-lable">ZONE</label>
                                        <input type="text" class="form-control" name="zon_num" 
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