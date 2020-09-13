<?php
// header('Content-Type: application/json');
// include "proses/koneksi.php";

// $tahun = $_POST['tahun'];

// // $sql = "select date_format(tgl, '%". $tahun ."') as 'year', date_format(tgl, '%m') as 'month', count(no) as 'total' from tbabsensi group by date_format(tgl, '%Y%m')";
// $sql = "select date_format(tgl, '%Y') as 'year', date_format(tgl, '%m') as 'month', count(no) as 'total' from tbabsensi group by date_format(tgl, '%Y%m')";
// $query = mysqli_query($con,$sql);

// while($re = mysqli_fethz)


// if($tahunnya == $tahun){
// 	$data = array();
// 	foreach($query as $row){
// 		$data[] = $row;
// 	}
// }

// print json_encode($data);
?>

<?php
header('Content-Type: application/json');
include "proses/koneksi.php";

$sql = "select date_format(tgl, '%Y') as 'year', date_format(tgl, '%m') as 'month', count(no) as 'total' from tbabsensi group by date_format(tgl, '%Y%m')";
$query = mysqli_query($con,$sql);

$data = array();
foreach($query as $row){
	$data[] = $row;
}

print json_encode($data);
?>