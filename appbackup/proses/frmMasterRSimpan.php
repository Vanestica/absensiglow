<?php
include 'koneksi.php';

$idruang = $_POST["idruang"];
$nama = $_POST["namaruang"];
$ket = $_POST["ket"];
$tombol = $_POST['tombol'];

if($tombol == "Simpan"){
	$sql = "insert into tbruangan
		(nama, ket)
		values('$nama','$ket')";
	$query = mysqli_query($con,$sql);
}else if($tombol == "Ubah"){
	$sql = "update tbruangan set
			nama='$nama', ket='$ket'
			where idruang='$idruang'";
	$query = mysqli_query($con,$sql);
}else{
	$sql = "delete from tbruangan where idruang='$idruang'";
	$query = mysqli_query($con,$sql);
}
?>