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

    <title>FRM</title>

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
function edit(iduser, nama, no_hp, alamat, email, tmptlahir, tgllahir, sesi){
  document.getElementById("iduser").value = iduser;
  document.getElementById("nama").value = nama;
  document.getElementById("no_hp").value = no_hp;
  document.getElementById("alamat").value = alamat;
  document.getElementById("email").value = email;
  document.getElementById("tmptlahir").value = tmptlahir;
  document.getElementById("tgllahir").value = tgllahir;
  document.getElementById("tombol").value = "Ubah";
  document.getElementById("pwd").style.display = "none";

  if(sesi == "Glow 1"){
    document.getElementById('glow1').checked = true;
  }else if(sesi == " Glow 2"){
    document.getElementById('glow2').checked = true;
  }else if(sesi == "Glow 1, Glow 2"){
    document.getElementById('glow1').checked = true;
    document.getElementById('glow2').checked = true;
  }else{
    document.getElementById('glow1').checked = false;
    document.getElementById('glow2').checked = false;
  }
}

// Fungsi untuk kirim data save update

function savemk(){
  var iduser = document.getElementById("iduser").value;
  var nama = document.getElementById("nama").value;
  var no_hp = document.getElementById("no_hp").value;
  var alamat = document.getElementById("alamat").value;
  var email = document.getElementById("email").value;
  var tmptlahir = document.getElementById("tmptlahir").value;
  var tgllahir = document.getElementById("tgllahir").value;
  var pwd = document.getElementById("pwd").value;
  var tombol = document.getElementById("tombol").value;

  var sesi = [];
  $('.get_value').each(function(){
    if($(this).is(":checked"))
    {
      sesi.push($(this).val());
    }
  });
  sesi = sesi.toString();

  $.ajax({
    type: "POST",
    url: 'proses/frmMentorSimpan.php',
    data: {
      iduser: iduser,
      nama: nama,
      no_hp: no_hp,
      alamat: alamat,
      email: email,
      tmptlahir: tmptlahir,
      tgllahir: tgllahir,
      pwd: pwd,
      sesi: sesi,
      tombol: tombol
    },
    success: function(result){
      if(tombol == "Simpan"){
        refresh();
        // alert(result);
      }else if(tombol == "Ubah"){
        refresh3();
      }
    }
  });
}

// tombol hapus

function del(iduser){
  if(confirm("Apakah Anda yakin menghapus ini?")==true){
    $.ajax({
    type: "POST",
    url: 'proses/frmMentorSimpan.php',
    data: {
              iduser: iduser,
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
    url: 'frmMentor.php',
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
    url: 'frmMentor.php',
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
    url: 'frmMentor.php',
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
  <button class="btn mr-4 btn-warning mb-1" style="border-radius: 50%;padding:7px 7px 0px 7px" id="icontambah">
    <span data-feather="plus-circle"></span></button>
    Tambah & List Mentor
  </div>
</center>

<hr>

<div id="tambahkan" style="display:none">
  <form action="proses/frmMentorSimpan.php" method="POST" class="myForm">
    <div class="row">
      <input type="text" name="iduser" id="iduser" hidden>
      <div class="form-group col-sm-6">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required>
      </div>
      <div class="form-group col-sm-6">
        <label for="no_hp">No HP</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No HP">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm-6">
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
      </div> 
      <div class="form-group col-sm-6">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm-6">
        <label for="tmptlahir">Tempat Lahir</label>
        <input type="Text" class="form-control" id="tmptlahir" name="tmptlahir" placeholder="Tempat Lahir">
      </div>
      <div class="form-group col-sm-6"> 
        <label for="tgllahir">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tgllahir" name="tgllahir">
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm-4">
        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
      </div>

      <label class="col-sm-1 pt-2">Sesi : </label>

      <div class="form-group col-sm-2 pt-2">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input get_value" id="glow1" name="glow1" value="Glow 1">
          <label class="custom-control-label" for="glow1">Glow 1</label>
        </div>
      </div>

      <div class="form-group col-sm-2 pt-2">    
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input get_value" id="glow2" name="glow2" value=" Glow 2">
          <label class="custom-control-label" for="glow2">Glow 2</label>
        </div>
      </div>

      <div class="form-group col-sm-3">
        <input type="button" name="tombol" id="tombol" class="btn btn-primary btn-block mb-4" value="Simpan" onclick="savemk()">
      </div>
    </div>
  </form>
</div>

  <div class="table-responsive mb-4">
    <table id="tabel-data" class="table table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Email</th>
          <th>No HP</th>
          <th>TmptLahir</th>
          <th>TglLahir</th>
          <th>Sesi</th>
          <th>Action</th>
        </tr>
      </thead>

    <?php
    $sql = "select * from tbanggota where status='mentor' order by nama asc";
    $query = mysqli_query($con,$sql);

    while($re = mysqli_fetch_assoc($query)){
      $iduser = $re['iduser'];
      $nama = $re['nama'];
      $alamat = $re['alamat'];
      $email = $re['email'];
      $nohp = $re['nohp'];
      $tmptlahir = $re['tmptlahir'];
      $tgllahir = $re['tgllahir'];
      $sesi = $re['sesi'];

    ?>

      <tr>
        <td><?= $nama; ?></td>
        <td><?= $alamat; ?></td>
        <td><?= $email; ?></td>
        <td><?= $nohp; ?></td>
        <td><?= $tmptlahir; ?></td>
        <td><?= $tgllahir; ?></td>
        <td><?= $sesi; ?></td>
        <td>
          <button style="width:40px" class="btn btn-warning" name="edit" id="edit" onclick="return edit(<?php echo "'$iduser','$nama','$nohp','$alamat','$email','$tmptlahir','$tgllahir','$sesi'"; ?>)">
          <i class="fa fa-pencil"></i>
          </button>
          <button style="width:40px" class="btn btn-danger" name="del" id="del" onclick="return del(<?= "'$iduser'"; ?>)">
            <i class="fa fa-trash-o"></i>
          </button>
        </td>
      </tr>

    <?php } ?>

    </table>
  </div>
</div>

<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
      feather.replace()
</script>
</body>
</html>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>

<script>
$(document).ready(function(){
  $("#icontambah").click(function(){
    $("#tambahkan").slideToggle();
  });
});
</script>