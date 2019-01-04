<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
  $idpengajar=intval($_GET['idpengajar']);
$namapengajar=$_POST['namapengajar'];
$ret=mysqli_query($con,"update pengajar set namapengajar='$namapengajar',namapengguna='$namapengguna'  where idpengajar='$idpengajar'");
if($ret)
{
$_SESSION['msg']="Data Pengajar Berhasil Diubah !!";
}
else
{
  $_SESSION['msg']="Error : Data Pengajar Tidak Dapat Diubah";
}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Profile Pengajar</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['login']!="")
{
 include('includes/menubar.php');
}
 ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Pendaftaran Pengajar  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                         Pendaftaran Pengajar
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
<?php 
$idpengajar=intval($_GET['idpengajar']);
$sql=mysqli_query($con,"select * from pengajar where idpengajar='$idpengajar'");
$cnt=1;
while($row=mysqli_fetch_array($sql))

 ?>

                        <div class="panel-body">
                       <form name="dept" method="post" enctype="multipart/form-data">
   <div class="form-group">
    <label for="idpengajar">ID Pengajar  </label>
    <input type="text" class="form-control" id="idpengajar" name="idpengajar" value="<?php echo htmlentities($row['idpengajar']);?>" readonly  />
  </div>

 <div class="form-group">
    <label for="namapengajar">Nama Pengajar </label>
    <input type="text" class="form-control" id="namapengajar" name="namapengajar" value="<?php echo htmlentities($row['namapengajar']);?>"  placeholder="namapengajar" />
    
  </div>



 <button type="submit" name="submit" id="submit" class="btn btn-default">Ubah</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>

            </div>





        </div>
    </div>
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>


</body>
</html>
<?php } ?>
