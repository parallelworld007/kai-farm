<?php include("header.php"); ?>
<?php
$menu = "addkai"
?>
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
      <div class="row"></div>
        <head>
          <title>HOME</title>
          <link rel="stylesheet" type="text/css" href="conf.css">
        </head>
        <body>
    <div class="testbox">
    <script type="application/javascript">
            function saveorder() {
              alert("เพิ่มข้อมูลสำเร็จ");
              document.forms["frmcart"].submit();
            }
          </script>
          <form id="frmcart" name="frmcart" method="post" action="saveorder.php" enctype="multipart/form-data">
            <table width="900" border="0" align="center" class="square">
              <tr>
              <div class="banner">
          <h1>สั่งซื้อสินค้า</h1>
        </div>
              </tr>
              <tr>
                <td bgcolor="#ddd">สินค้า</td>
                <td align="center" bgcolor="#ddd">ราคา</td>
                <td align="center" bgcolor="#ddd">จำนวน</td>
                <td align="center" bgcolor="#ddd">รวม/รายการ</td>
              </tr>
              <?php
              $total = 0;
              foreach ($_SESSION['cart'] as $p_id => $qty) {
                $sql  = "select * from product where p_id=$p_id";
                $query  = mysqli_query($conn, $sql);
                $row  = mysqli_fetch_array($query);
                $sum  = $row['p_price'] * $qty;
                $total  += $sum;
                echo "<tr>";
                echo "<td>" . $row["p_name"] . "</td>";
                echo "<td align='right'>" . number_format($row['p_price'], 2) . "</td>";
              ?>
                <td style="text-align: center;">
                  <input style="border: none;text-align: center;" readonly value="<?php echo $qty; ?>" name="total_qty" type="text" id="total_qty" required />
                </td>
              <?php
                // echo "<td align='right' id='total_qty' name='total_qty'>$qty</td>";
                echo "<td align='center'>" . number_format($sum, 2) . "</td>";
                echo "</tr>";
              }
              echo "<tr>";
              echo "<td  align='right' colspan='3' bgcolor='#ddd'><b>รวม</b></td>";
              echo "<td align='center' bgcolor='#ddd'>" . "<b>" .
              "<input style='border: none;text-align: center;' readonly value=" . number_format($total, 2,'.', '') ." name='total' type='text' id='total' required />"
              ."</b>" . "</td>";
              echo "</tr>";
              ?>
            </table>
        <div class="item">
          <p>ชื่อผู้สั่งสินค้า<span class="required">*</span></p>
          <div class="name-item">
            <input name="name" type="text" id="name" value="<?php echo $_SESSION['cus_name']; ?>" required />
          </div>
        </div>
        <div class="contact-item">
          <div class="item">
            <p>Email<span class="required">*</span></p>
            <input name="email" type="text" id="email" required />
          </div>
          <div class="item">
            <p>Phone<span class="required">*</span></p>
            <input name="phone" type="text" id="phone"  required />
          </div>
        </div>
        <div class="item">
          <p>ที่อยู่<span class="required">*</span></p>
          <div class="name-item">
          <textarea name="address" type=text cols="35" rows="5" id="address"  required></textarea>
          </div>
        </div>




           <div class="question">
          <div class="question-answer">
            <div align="center">
            <input type="checkbox" id="wait" name="wait" value="ยังไม่มารับสินค้า">
                <label  for="wait"> ฉันได้ตรวจสอบที่อยู่และคำสั่งซื้อเรียบร้อยแล้ว</label>
            </div>
          </div>
        </div>

        <div class="btn-block">
        <div style="padding:5px"><button type="button" id="bt_submit" name="bt_submit" OnClick="saveorder()">บันทึก</button></div>
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