
<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
$sql=mysqli_query($con,"SELECT password FROM  students where password='".md5($_POST['cpass'])."' && studentRegno='".$_SESSION['login']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update students set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where studentRegno='".$_SESSION['login']."'");
$_SESSION['msg']="Ganti Kata Sandi Berhasil !!";
}
else
{
$_SESSION['msg']="Sandi Saat Ini Tidak Sesuai !!";
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
    <title>Peserta | Kata Sandi Peserta</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.cpass.value=="")
{
alert("Kolom Kata Sandi Saat Ini Kosong !!");
document.chngpwd.cpass.focus();
return false;
}
else if(document.chngpwd.newpass.value=="")
{
alert("Kolom Kata Sandi Baru Kosong !!");
document.chngpwd.newpass.focus();
return false;
}
else if(document.chngpwd.cnfpass.value=="")
{
alert("Kolom Konfirmasi Kata Sandi Baru Kosong !!");
document.chngpwd.cnfpass.focus();
return false;
}
else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
{
alert("Kata Sandi dan Konfirmasi Kata Sandi Tidak Sesuai  !!");
document.chngpwd.cnfpass.focus();
return false;
}
return true;
}
</script>
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
                        <h1 class="page-head-line">Ganti Kata Sandi Peserta </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Ganti Kata Sandi
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="chngpwd" method="post" onSubmit="return valid();">
   <div class="form-group">
    <label for="exampleInputPassword1">Kata Sandi Saat Ini</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="cpass" placeholder="Kata Sandi Saat Ini" />
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Kata Sandi Baru</label>
    <input type="password" class="form-control" id="exampleInputPassword2" name="newpass" placeholder="Kata Sandi Baru" />
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Konfirmasi Kata Sandi Baru</label>
    <input type="password" class="form-control" id="exampleInputPassword3" name="cnfpass" placeholder="Konfirmasi Kata Sandi Baru" />
  </div>
 
  <button type="submit" name="submit" class="btn btn-default">Simpan</button>
                           <hr />
   



</form>
                            </div>
                            </div>
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
