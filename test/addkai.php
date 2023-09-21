
<?php 
    require_once "db.php";
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = $conn->query("DELETE FROM `add_chicken` WHERE adc_id = $id");
        $deletestmt->execute();
        
        if ($deletestmt) {
            echo "<script>alert('Data has been deleted successfully');</script>";
            $_SESSION['success'] = "Data has been deleted succesfully";
            header("refresh:1; url=addkai.php");
        }
    }
?>
<?php include("header.php"); 
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <h1>เพิ่มข้อมูลไก่</h1>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div class="card-header ">
        <h3 class="card-title" >รายการเพิ่มข้อมูลไก่</h3>
        <div align="right">
          
          <a href="insert_addkai.php" class="btn btn-success" data-toggle data-target> <i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
          
        </div>
      </div>
      <br>
      <div class="card-body">
        <div class="row">
        
        <div class="col-md-12">
   

        <table class="table"  align="center"  >
            <thead>
                <tr class="info">    
                <th>id</th>
                <th>name</th>
                <th>date</th>
                <th>total chicken</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            </thead>
                <tbody>
                                    
                            <?php
                            include "db.php";
                                $sql = "SELECT ac.adc_id , 
                                               h.hou_name , 
                                               ac.adc_date , 
                                               ac.adc_num

                                FROM add_chicken as ac
                                
                                INNER JOIN house as h ON ac.hou_id = h.hou_id";
                                
                                $result =mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['adc_id']?></td>
                                        <td><?php echo $row['hou_name']?></td>
                                        <td><?php echo $row['adc_date']?></td> 
                                        <td><?php echo $row['adc_num']?></td>                                                                           
                                        <td>
                                            <a href="edit_addkai.php?id=<?php echo $row['adc_id']?>" 
                                            class="link-Info"><i class="fa-solid fa-pen-to-square fs-5 me-3 "></i></i></a>
                                        </td> 
                                        <td>   
                                            <a data-id="<?= $row['adc_id']; ?>" href="?delete=<?= $row['adc_id']; ?>" 
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
                                url: 'addkai.php',
                                type: 'GET',
                                data: 'delete=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'Data deleted successfully!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'addkai.php';
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
  <?php include('footer.php'); ?>
  
</body>
</html>