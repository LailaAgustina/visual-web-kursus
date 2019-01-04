<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$idpengajar=$_POST['idpengajar'];
$namapengajar=$_POST['namapengajar'];
$username=$_POST['username'];
$password=md5($_POST['password']);
$ret=mysqli_query($con,"insert into pengajar(idpengajar,namapengajar,username,password) values('$idpengajar','$namapengajar','$username','$password')");
if($ret)
{
$_SESSION['msg']="Pengajar Berhasil Ditambahkan !!";
}
else
{
  $_SESSION['msg']="Error : Pengajar Tidak Terdaftar";
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
    <title>Admin | Pendaftaran Pengajar</title>
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
                        <h1 class="page-head-line">Pendaftaran Pengajar  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                         Pendaftaran Pengajar Kursus
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="idpengajar">ID Pengajar  </label>
    <input type="text" class="form-control" id="studentname" name="idpengajar" placeholder="Masukkan ID Pengajar" required />
  </div>

 <div class="form-group">
    <label for="namapengajar">Nama Pengajar  </label>
    <input type="text" class="form-control" id="studentregno" name="namapengajar" onBlur="userAvailability()" placeholder="Masukkan Nama" required />
     <span id="user-availability-status1" style="font-size:12px;">
  </div>

<div class="form-group">
    <label for="username"> Nama Pengguna  </label>
    <input type="password" class="form-control" id="username" name="username" placeholder="Masukkan Nama Pengguna" required />
  </div> 


<div class="form-group">
    <label for="password">Kata Sandi  </label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi" required />
  </div>   

 <button type="submit" name="submit" id="submit" class="btn btn-default">Daftar</button>
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
<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'regno='+$("#studentregno").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


</body>
</html>
<?php } ?>
