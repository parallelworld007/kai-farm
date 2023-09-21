<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Farm</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="" href="../assets/img/t.png" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../assets/icheck-bootstrap.min.css">
  <!-- DataTables -->
  <!--css ทำมั่ว-->
  <link rel="stylesheet" href="style.css">

  <link rel="stylesheet" href="../assets/dataTables.bootstrap4.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/adminlte.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../assets/select2.min.css">
  <link rel="stylesheet" href="../assets/select2-bootstrap4.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Kanit:400" rel="stylesheet">

  <link href="../assets/tagsinput.css?v=11" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>
  
  <script src=" https://code.jquery.com/jquery-3.6.1.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- ckeditor -->
  <script src="../assets/ckeditor.js"></script>
  <script>
    if ( window.history.replaceState){
      window.history.replaceState(null, null, window.location.href);
    }

  </script>

  <style>
    body {
      font-family: 'Kanit', sans-serif;
      
      font-size: 14px;
    }
  </style>


  <style type="text/css">
  @media print{
    .btn{
       display: none; /* ซ่อน  */
    }
  }
</style>
</head>
<?php
 
$m_level = $_SESSION['ref_l_id'];
if($m_level != 1 AND $m_level != 2){
   Header("Location: ../index.php");
}
 
include('../condb.php');
 
 ?>


