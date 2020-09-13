<?php
include "proses/koneksi.php";
$date = date("Y-m-d");
$created = date("Y-m-d H:i:s");

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

<script type="text/javascript">
function buatajax(){
  if (window.XMLHttpRequest) {
    return new XMLHttpRequest();
  }
}
function st(){
  var data;
  if(ajaxku.readyState == 4 ){
    data = ajaxku.responseText;
    document.getElementById('tabel-data').innerHTML = data;
  }
}
function f_view(btnview){
  var kelompok = document.getElementById('kelompok').value;
  var btnview = document.getElementById('btnview').value;

  var url = "proses/absensiAnggotaLoad.php?kelompok="+kelompok+"&btnview="+btnview;
  url = url +"&sid="+Math.random();
  ajaxku = buatajax();
  ajaxku.onreadystatechange=st;
  ajaxku.open("GET",url,true);
  ajaxku.send(null);
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


  <div class="mt-3">

<center>
  <div class="judul">
    Absensi Anggota
  </div>
</center>

<hr>

      <form action="proses/absensiAnggotaSimpan.php" method="POST">  
        <div class="container mt-3">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group"> 
              <label for="tgl_lahir">Tanggal</label>
              <input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo $date; ?>">
            </div>
          </div>

          <input type="text" class="form-control" id="created" name="created" value="<?php echo $created; ?>" hidden>

          <div class="col-sm-5 col-8">
            <div class="form-group">
            <label for="kelompok">Pilih Kelompok</label>

            <select name="kelompok" id="kelompok" class="custom-select">

              <option value="">Pilih Kelompok</option>

           <?php
            $sql = "select * from tbkelompok";
            $query = mysqli_query($con,$sql);
            while($re = mysqli_fetch_assoc($query)){
              $idklmpk = $re['idklmpk'];
            ?>

              <option value="<?php echo $idklmpk; ?>"><?php echo $re['namaklmpk']; ?></option>

            <?php } ?>


            </select>
          </div>
          </div>

          <div class="col-sm-1 col-4">
            <label style="color:white">Cari</label>
            <input type="button" class="btn btn-danger btn-block" name="btnview" id="btnview" value="VIEW" onclick="f_view(this.value)">
          </div>

        </div>
        <div class="row">
          <div class="col-sm-6 col-6">
            <div class="form-group">
            <label for="mentor">Nama Mentor</label>
             <select name="mentor" id="mentor" class="custom-select">
              <option selected>Pilih Mentor </option>
              <?php
              $sql2 = "select * from tbanggota where status='Mentor'";
              $query2 = mysqli_query($con,$sql2);
              while($re2 = mysqli_fetch_assoc($query2)){
              ?>
              <option value="<?php echo $re2['iduser']; ?>"><?php echo $re2['nama']; ?></option>
            <?php } ?>
            </select>
          </div>
          </div>
          <div class="col-sm-6 col-6">
            <div class="form-group">
            <label for="Nama Ruang">Nama Ruang</label>
            <select name="ruang" id="ruang" class="custom-select">
              <option selected>Pilih Ruang </option>
              <?php
              $sql3 = "select * from tbruangan";
              $query3 = mysqli_query($con,$sql3);
              while($re3 = mysqli_fetch_assoc($query3)){
              ?>
              <option value="<?php echo $re3['nama']; ?>"><?php echo $re3['nama']; ?></option>
            <?php } ?>
            </select>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">         
          
             <div class="form-group"> 
                <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Description"></textarea> 
                
              </div>  
          </div>
        </div>
          <div class="table-responsive mt-4">
            <table id="tabel-data" class="table table-striped">
              <thead>
                <tr>
                  <!-- <th>ID</th> -->
                  <th>Nama</th>
                  <th style="width:400px">Alamat</th>
                  <th>No HP</th>
                  <th>Kehadiran</th>
                  <th style="width:200px">Ket</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        <div class="row"> 
          <div class="col-sm-10">
          </div>
          <div class="col-sm-2 mb-4">
            <button type="submit" name="simpan" class="btn btn-primary btn-block">Simpan</button>
          </div>
        </div> 
      </form>
    </div>
  </body>
</html>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>