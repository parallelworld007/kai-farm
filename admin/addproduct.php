<?php
$menu = "product"
?>

<?php include("header.php"); ?>
<?php
include("db.php");
?>

<section class="content-header">
</section>
 <style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

textarea[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
</style>

<!-- Main content -->
<section class="content">




  <div class="card card-gray">
    
    <br>
    <div class="card-body">
      <div class="row">
        <body>
    <div class="testbox">
    <script type="application/javascript">
            function saveproduct() {
              alert("เพิ่มข้อมูลสำเร็จ");
              document.forms["frmcart"].submit();
            }
          </script>
          <form id="frmcart" name="frmcart" method="post" action="saveproduct.php" enctype="multipart/form-data">
        

          
        <div class="item">
          <p>ชื่อสินค้า<span class="required">*</span></p>
          <div class="name-item">
            <input name="name" type="text" id="name" required />
          </div>
        </div>
        <div class="contact-item">
          <div class="item">
            <p>ข้อมูลสินค้า<span class="required">*</span></p>
            <input name="detail" type="text" id="detail" required />
          </div>
          <div class="item">
            <p>ราคาสินค้า<span class="required">*</span></p>
            <input name="price" type="text" id="price" required />
          </div>
        </div>
                              




          <div class="item" align="center">
            <p><label for="http:/localhost/farmkai/image">รูปหลักฐานการโอน:</label></p>
            <input type="file" id="p_pic" name="p_pic" style='width: 20%;'>
          </div>

        <div class="btn-block">
        <div style="padding:5px"><button type="button" id="bt_submit" name="bt_submit"  OnClick="saveproduct()" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button></div>
        </div>
      </form>
        
    </div>
  </body>
      </div>
    </div>
    <div class="card-footer">

    </div>

  </div>






</section>
<!-- /.content -->


<?php include('footer.php'); ?>
<script>
  $(function() {
    $(".datatable").DataTable();
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    // http://fordev22.com/
    // });
  });
</script>


</body>

</html>
<!-- http://fordev22.com/ -->