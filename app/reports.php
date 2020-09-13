<?php
include "proses/koneksi.php";

session_start();
if(!isset($_SESSION['email'])) {
   header('location: akses/index.php'); 
} else { 
   $email = $_SESSION['email'];
   $email = $email['email'];
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Glow Ministry</title>

   <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/floating-labels.css" rel="stylesheet">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="datatables/dtbs4.css" />
    <script src="datatables/jq331.min.js"></script>
    <script src="datatables/dtjq.min.js"></script>
    <script src="datatables/dtbs4.js"></script>
  </head>

<script>
function edit(idklmpk, namaklmpk, ket){
  document.getElementById("idklmpk").value = idklmpk;
  document.getElementById("namaklmpk").value = namaklmpk;
  document.getElementById("ket").value = ket;
  document.getElementById("tombol").value = "Ubah";
}

function del(idklmpk){
  if(confirm("Apakah Anda yakin menghapus ini?")==true)
           window.location="proses/frmMasterKSimpan.php?idklmpk="+idklmpk;
    return true;
}

$(document).click(function(){
  $("#tombol").click(function(){
  $.ajax({
      url:'proses/frmMasterKSimpan.php',
      method:'POST',
      data: $("form").serialize()   
  });
 });
});
</script>

<style>
@media screen and (max-width: 1024px) {
    .nonehp {
        display: none !important;
    }
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
    .judul {
      font-size:22px;
      font-family: Arial;
      font-weight:bold;
    }
}

@media screen and (min-width: 1024px) {
    .noneweb {
        display: none !important;
    }
    .judul {
      font-size:36px;
      font-family: Arial;
      font-weight:bold;
    }
}
</style>

  <body> 

  <div class="container mt-3">

<center>
  <div class="judul">
    Laporan Absensi
  </div>
</center>

<hr>
      <div class="table-responsive my-4">
        <table id="tabel-data" class="table table-striped">
          <thead>
            <tr>
              <th>NO</th>
              <!-- <th>IDUSER</th> -->
              <th>NAMA</th>
              <th>KEHADIRAN</th>
              <th>KET</th>
              <th>TGL</th>
            </tr>
          </thead>

          <?php
          $sql = "select * from tbabsensidetil inner join tbanggota on tbabsensidetil.iduser = tbanggota.iduser";
          $query = mysqli_query($con,$sql);
            $no = 0;
          while($re = mysqli_fetch_assoc($query)){
            $no++;

            $iduser = $re['iduser'];
            $nama = $re['nama'];
            $kehadiran = $re['hadir'];
            $ket = $re['ket'];
            $tgl = $re['created'];
          ?>
            <tr>
              <td><?= $no; ?></td>
              <!-- <td><?= $iduser; ?></td> -->
              <td><?= $nama; ?></td>
              <td><?= $kehadiran; ?></td>
              <td><?= $ket; ?></td>
              <td><?= $tgl; ?></td>
              
            </tr>
          <?php } ?>

        </table>
      </div>
    </div>
  </body>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>