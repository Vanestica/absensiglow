<?php
include 'koneksi.php';

$iduser = $_POST["iduser"];
$nama = $_POST["nama"];
$alamat = $_POST["alamat"];
$email = $_POST["email"];
$nohp = $_POST["no_hp"];
$tmptlahir = $_POST["tmptlahir"];
$tgllahir = $_POST["tgllahir"];
$pwd = md5($_POST["pwd"]);

// $glow1 = $_POST['glow1'];
// $glow2 = $_POST['glow2'];
// $sesiArray = array($glow1, $glow2);
// $sesiArray = array_filter($sesiArray);
$sesi = $_POST['sesi'];

$tombol = $_POST['tombol'];

if($tombol == "Simpan"){
	$sql = "insert into tbanggota
		(nama, alamat, email, nohp, tmptlahir, tgllahir, pass, sesi, status)
		values('$nama','$alamat','$email','$nohp','$tmptlahir','$tgllahir','$pwd','$sesi', 'mentor')";
	$query = mysqli_query($con,$sql);
}else if($tombol == "Ubah"){
	$sql = "update tbanggota set
          nama='$nama', alamat='$alamat', nohp='$nohp', email='$email', tmptlahir='$tmptlahir', tgllahir='$tgllahir', sesi='$sesi'
          where iduser='$iduser'";
	$query = mysqli_query($con,$sql);
}else{
	$sql = "delete from tbanggota where iduser='$iduser'";
	$query = mysqli_query($con,$sql);
}
?>