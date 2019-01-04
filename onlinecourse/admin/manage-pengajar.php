<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from pengajar where idpengajar = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Data Pengajar Berhasil Dihapus !!";
      }

     if(isset($_GET['pass']))
      {
        $password="tes123";
        $newpass=md5($password);
              mysqli_query($con,"update pengajar set password='$newpass' where idpengajar = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Kata Sandi Telah Di Atur Ulang. Kata Sandi Baru adalah tes123";
      } 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Data Pengajar Kursus</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Data Pengajar Kursus  </h1>
                    </div>
                </div>
                <div class="row" >
                 
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Mengatur Data Pengajar
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID Pengajar </th>
                                            <th>Nama Pengajar </th>
                                            <th>Nama Pengguna</th>
                                            <th>Tanggal Pembuatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select * from pengajar");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['idpengajar']);?></td>
                                            <td><?php echo htmlentities($row['namapengajar']);?></td>
                                            <td><?php echo htmlentities($row['username']);?></td>
                                            <td><?php echo htmlentities($row['creationdate']);?></td>
                                            <td>
                                            <a href="edit-pengajar.php?id=<?php echo $row['idpengajar']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>                                        
<a href="manage-pengajar.php?id=<?php echo $row['idpengajar']?>&del=delete" onClick="return confirm('Apakah anda yakin ingin menghapus?')">
                                            <button class="btn btn-danger">Hapus</button>
</a>
<a href="manage-pengajar.php?id=<?php echo $row['idpengajar']?>&pass=update" onClick="return confirm('Apakah anda yakin ingin mengatur ulang kata sandi?')">
<button type="submit" name="submit" id="submit" class="btn btn-default">Atur Ulang Kata Sandi</button>
</a>
                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!--  End  Bordered Table  -->
                </div>
            </div>





        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
