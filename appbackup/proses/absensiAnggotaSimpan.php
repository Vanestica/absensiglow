<?php
include "koneksi.php";

$tgl = $_POST['tgl'];
$mentor = $_POST['mentor'];
$kelompok = $_POST['kelompok'];
$ruang = $_POST['ruang'];
$deskripsi = $_POST['deskripsi'];
$created = $_POST['created'];
$indx= $_POST['isiindx'];


$v=1;

while ($v <= $indx){
 	$satu = $_POST['hadir'.$v];
 	$dua = $_POST['ket'.$v];
 	$tiga = $_POST['iduser'.$v];
  $insert = "insert into tbabsensidetil (iduser, hadir, ket) values('".$tiga."','".$satu."','".$dua."')";

	$sqls = "insert into tbabsensi
		(tgl, userid, room, mentor, deskripsi, grup)
		values('".$tgl."','".$tiga."','".$ruang."','".$mentor."','".$deskripsi."','".$kelompok."')";
	$querys = mysqli_query($con,$sqls);

  if (mysqli_query($con,$insert)===TRUE) {
    ?>
    <script type="text/javascript">
    alert("Berhasil menyimpan");
    window.location.href = "../homeAdmin.php";
    </script>
    <?php
  }
  else{
   ?>
    <script type="text/javascript">
    alert("Gagal menyimpan.");
    window.location.href = "../homeAdmin.php";
    </script>
    <?php
  }
  $v++;
 }

?>