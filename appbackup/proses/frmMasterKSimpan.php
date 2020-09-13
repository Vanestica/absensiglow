<?php
include 'koneksi.php';

$nama = $_POST["namaklmpk"];
$ket = $_POST["ket"];
$idklmpk = $_POST["idklmpk"];
$tombol = $_POST['tombol'];

if($tombol == "Simpan"){
	$sql = "insert into tbkelompok
		(namaklmpk, ket)
		values('$nama','$ket')";
	$query = mysqli_query($con,$sql);
}else if($tombol == "Ubah"){
	$sql = "update tbkelompok set
			namaklmpk='$nama', ket='$ket'
			where idklmpk='$idklmpk'";
	$query = mysqli_query($con,$sql);
}else{
	$sql = "delete from tbkelompok where idklmpk='$idklmpk'";
	$query = mysqli_query($con,$sql);
}
?>