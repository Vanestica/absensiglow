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
function edit(idruang, namaruang, ket){
  document.getElementById("idruang").value = idruang;
  document.getElementById("namaruang").value = namaruang;
  document.getElementById("ket").value = ket;
  document.getElementById("tombol").value = "Ubah";
}

// Fungsi untuk kirim data save update

function savemk(){
  var namaruang = document.getElementById("namaruang").value;
  var idruang = document.getElementById("idruang").value;
  var ket = document.getElementById("ket").value;
  var tombol = document.getElementById("tombol").value;

  $.ajax({
    type: "POST",
    url: 'proses/frmMasterRSimpan.php',
    data: {
      idruang: idruang,
      namaruang: namaruang,
      ket: ket,
      tombol: tombol
    },
    success: function(result){
      if(tombol == "Simpan"){
        refresh();
      }else if(tombol == "Ubah"){
        refresh3();
      }
    }});
}

// tombol hapus

function del(idruang){
  if(confirm("Apakah Anda yakin menghapus ini?")==true){
    $.ajax({
    type: "POST",
    url: 'proses/frmMasterRSimpan.php',
    data: {
              idruang:idruang,
              tombol: 'Hapus'
    },
    success: function(result){
      refresh2();
    }});
  }
}

// Refresh page biar ga balik ke dashboard mulu

function refresh(){
  $.ajax({
    type: "POST",
    url: 'frmMasterR.php',
    data: {
      tombol: 'Simpan'
    },
    success: function(result){
      $("#output").html(result);
    }});
}

function refresh2(){
  $.ajax({
    type: "POST",
    url: 'frmMasterR.php',
    data: {
      tombol: 'Hapus'
    },
    success: function(result){
      $("#output").html(result);
    }});
}

function refresh3(){
  $.ajax({
    type: "POST",
    url: 'frmMasterR.php',
    data: {
      tombol: 'Ubah'
    },
    success: function(result){
      $("#output").html(result);
    }});
}
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
    Master Ruangan
  </div>
</center>

<hr>

      <form method="POST" action="proses/frmMasterRSimpan.php">
        <div class="row">
          <div class="form-group col-sm-4">
              <input type="text" name="idruang" id="idruang" hidden>
              <label for="nama">Ruangan</label>
              <input type="text" id="namaruang" name="namaruang" class="form-control" placeholder="Ruangan" required>
          </div> 
          <div class="form-group col-sm-4">
              <label for="ket">Keterangan</label>
              <input type="text" id="ket" name="ket" class="form-control" placeholder="Keterangan" required>
          </div>
          <div class="form-group col-sm-4">
            <label class="text-white">f</label>
            <input type="button" name="tombol" id="tombol" value="Simpan" class="btn btn-primary btn-block" onclick="savemk()">
          </div>
        </div>
      </form>

      <div class="table-responsive my-4">
        <table id="tabel-data" class="table table-striped">
          <thead>
            <tr>
              <th>Kelompok</th>
              <th>Keterangan</th>
              <th>Action</th>
            </tr>
          </thead>

          <?php
          $sql = "select * from tbruangan";
          $query = mysqli_query($con,$sql);
          while($re = mysqli_fetch_assoc($query)){
            $idruang = $re['idruang'];
            $nama = $re['nama'];
            $ket = $re['ket'];
          ?>
            <tr>
              <td><?= $nama ?></td>
              <td><?= $ket ?></td>
              <td>
                <button style="width:40px" class="btn btn-warning" name="edit" id="edit" onclick="return edit(<?php echo "'$idruang','$nama','$ket'"; ?>)">
                  <i class="fa fa-pencil"></i>
                </button>
                <button style="width:40px" class="btn btn-danger" name="del" id="del" onclick="return del(<?= "'$idruang'"; ?>)">
                  <i class="fa fa-trash-o"></i>
                </button>
              </td>
            </tr>
          <?php } ?>

        </table>
      </div>
    </div>
  </body>
</html>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>