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
    $coursecode=$_POST['coursecode'];
    $coursename=$_POST['coursename'];
    $courseunit=$_POST['courseunit'];
    $seatlimit=$_POST['seatlimit'];
    $ret=mysqli_query($con,"insert into course(courseCode,courseName,courseUnit,noofSeats) values('$coursecode','$coursename','$courseunit','$seatlimit')");
        if($ret)    
    {
    $_SESSION['msg']="Jadwal Berhasil Ditambahkan !!";
    }
        else
        {
         $_SESSION['msg']="Error : Jadwal Tidak Dapat Dapat Ditambahkan";
        }
}
    if(isset($_GET['del']))
      {
              mysqli_query($con,"delete from course where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Jadwal Berhasil Dihapus !!";
      }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Jadwal</title>
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
                        <h1 class="page-head-line">Jadwal</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           Jadwal Kursus Musik
                        </div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="coursecode">Kode Jadwal </label>
    <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Masukkan Kode Jadwal " required />
  </div>

 <div class="form-group">
    <label for="coursename">Nama Jadwal  </label>
    <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Masukan Nama Jadwal" required />
  </div>

<div class="form-group">
    <label for="courseunit">Nama Pengajar  </label>
    <input type="text" class="form-control" id="courseunit" name="courseunit" placeholder="Masukan Nama Pengajar" required />
  </div> 

<div class="form-group">
    <label for="seatlimit">Jumlah Siswa  </label>
    <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Masukan Jumlah Siswa" required />
  </div>   

 <button type="submit" name="submit" class="btn btn-default">Simpan</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Jadwal Kursus Musik
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Jadwal</th>
                                            <th>Nama Jadwal </th>
                                            <th>Nama Pengajar</th>
                                            <th>Jumlah Siswa</th>
                                             <th>Tanggal Jadwal</th>
                                             <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select * from course");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['courseCode']);?></td>
                                            <td><?php echo htmlentities($row['courseName']);?></td>
                                            <td><?php echo htmlentities($row['courseUnit']);?></td>
                                             <td><?php echo htmlentities($row['noofSeats']);?></td>
                                            <td><?php echo htmlentities($row['creationDate']);?></td>
                                            <td>
                                            <a href="edit-course.php?id=<?php echo $row['id']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>                                        
  <a href="course.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Apakah ingin Menghapus Jadwal ?')">
                                            <button class="btn btn-danger">Delete</button>
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
