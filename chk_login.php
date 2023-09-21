
<?php 
session_start();
        if(isset($_POST['mem_username'])){
        //connection
                  include("condb.php");
        //รับค่า user & mem_password       
                  $mem_username = mysqli_real_escape_string($conn,$_POST['mem_username']);
                  $mem_password = mysqli_real_escape_string($conn,($_POST['mem_password']));
                  $chk = trim($mem_username) OR trim($mem_password);
                  if($chk==''){
                      echo '<script>';
                        echo "alert(\" username หรือ  mem_password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                      echo '</script>';
                    }//close if chk trim
                    else{
                    //query 
                              $sql="SELECT * FROM tbl_member 
                              WHERE mem_username='".$mem_username."' 
                              AND mem_password='".$mem_password."' ";
                              $result = mysqli_query($conn,$sql);
                              
                              if(mysqli_num_rows($result)==1){
                                  $row = mysqli_fetch_array($result);
                                  $_SESSION["mem_id"] = $row["mem_id"];
                                  $_SESSION["mem_name"] = $row["mem_name"];
                                  $_SESSION["mem_sta"] = $row["mem_sta"];
                                 
                                  if($_SESSION["mem_sta"]=="1"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php
                                   
                                    Header("Location: admin/test.php");

                                  }
                                  elseif($_SESSION["mem_sta"]=="2"){  

                                    Header("Location: user/test.php");
                                  }

                              }else{
                                echo "<script>";
                                    echo "alert(\" username หรือ  mem_password ไม่ถูกต้อง\");"; 
                                    echo "window.history.back()";
                                echo "</script>";
                              }
                    }//close else chk trim
                    //exit();
        }else{
             Header("Location: login.php"); //user & mem_password incorrect back to login again
        }
?>