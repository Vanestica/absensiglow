<?php
include 'koneksi.php';

$nama = $_POST["nama"];
$alamat = $_POST["alamat"];
$email = $_POST["email"];
$sekolah = $_POST["sekolah"];
$kelas = $_POST["kelas"];
$nohp = $_POST["no_hp"];
$tmptlahir = $_POST["tmptlahir"];
$tgllahir = $_POST["tgllahir"];

$status = "anggota";
$kelompok = $_POST['kelompok'];
$tombol = $_POST['tombol'];
$iduser = $_POST['iduser'];
$ket = $_POST['ket'];
$baptis = $_POST['baptis'];
$gender = $_POST["gender"];
$aktif = $_POST["aktif"];
$sesi = $_POST["jam_ibadah"];

$foto = $_POST['image'];
// $foto = $_FILES["image"]['name'];
// $filename = $_FILES["image"]["name"];
// $path = "../upload/".$filename;
// move_uploaded_file($foto,$path);


if($tombol == "Simpan"){
	$sql = "insert into tbanggota
		(nama, gender, alamat, email, unit, class, nohp, tmptlahir, tgllahir, foto, sesi, aktif, status, kelompok, ket, baptis)
		values('$nama','$gender','$alamat','$email','$sekolah','$kelas','$nohp','$tmptlahir','$tgllahir','$foto','$sesi','$aktif','$status','$kelompok','$ket','$baptis')";
	$query = mysqli_query($con,$sql);
}else if($tombol == "Ubah" && !empty($foto)){
	$sql = "update tbanggota set
			nama='$nama', alamat='$alamat', nohp='$nohp', gender='$gender', unit='$sekolah', email='$email', class='$kelas', tmptlahir='$tmptlahir', tgllahir='$tgllahir', sesi='$sesi', kelompok='$kelompok', foto='$foto', ket='$ket', baptis='$baptis'
			where iduser='$iduser'";
	$query = mysqli_query($con,$sql);
}else if($tombol == "Ubah" && $file == 0){
	$sql = "update tbanggota set
			nama='$nama', alamat='$alamat', nohp='$nohp', gender='$gender', unit='$sekolah', email='$email', class='$kelas', tmptlahir='$tmptlahir', tgllahir='$tgllahir', sesi='$sesi', kelompok='$kelompok', ket='$ket', baptis='$baptis'
			where iduser='$iduser'";
	$query = mysqli_query($con,$sql);
}else{
	$sql = "delete from tbanggota where iduser='$iduser'";
	$query = mysqli_query($con,$sql);
}
?>