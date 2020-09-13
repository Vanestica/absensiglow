 <?php

include "proses/koneksi.php";

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

<script>
function edit(iduser, nama, no_hp, alamat, email, tmptlahir, tgllahir, sesi, unit, kelas, aktif, gender, image, klmpk, ket, baptis){
  document.getElementById("iduser").value = iduser;
  document.getElementById("nama").value = nama;
  document.getElementById("no_hp").value = no_hp;
  document.getElementById("alamat").value = alamat;
  document.getElementById("email").value = email;
  document.getElementById("tmptlahir").value = tmptlahir;
  document.getElementById("tgllahir").value = tgllahir;
  document.getElementById("sekolah").value = unit;
  document.getElementById("ket").value = ket;
  document.getElementById("kelas").value = kelas;
  document.getElementById("tombol").value = "Ubah";
  document.getElementById("namafoto").innerHTML = image;
  document.getElementById("kelompok").value = klmpk;

  if(aktif == "ya"){
    document.getElementById('aktif').checked = true;
  }else if(aktif == ""){
    document.getElementById('aktif').checked = false;
  }

  if(sesi == "Glow 1"){
    document.getElementById('glow1').checked = true;
  }else if(sesi == "Glow 2"){
    document.getElementById('glow2').checked = true;
  }

  if(gender == "P"){
    document.getElementById('genderP').checked = true;
  }else if(gender == "L"){
    document.getElementById('genderL').checked = true;
  }

  if(baptis == "Sudah"){
    document.getElementById('sudah').checked = true;
  }else if(baptis == "Belum"){
    document.getElementById('belum').checked = true;
  }
}

// Fungsi untuk kirim data save update
// file masih blm

function savemk(){
  var iduser = document.getElementById("iduser").value;
  var nama = document.getElementById("nama").value;
  var no_hp = document.getElementById("no_hp").value;
  var alamat = document.getElementById("alamat").value;
  var email = document.getElementById("email").value;
  var tmptlahir = document.getElementById("tmptlahir").value;
  var tgllahir = document.getElementById("tgllahir").value;
  var sekolah = document.getElementById("sekolah").value;
  var kelas = document.getElementById("kelas").value;
  var kelompok = document.getElementById("kelompok").value;
  var ket = document.getElementById("ket").value;
  var tombol = document.getElementById("tombol").value;

  var image = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')

  var aktif = [];
  $('.get_aktif').each(function(){
    if($(this).is(":checked"))
    {
      aktif.push($(this).val());
    }
  });
  aktif = aktif.toString();

  var jam_ibadah = [];
  $('.get_jam').each(function(){
    if($(this).is(":checked"))
    {
      jam_ibadah.push($(this).val());
    }
  });
  jam_ibadah = jam_ibadah.toString();

  var gender = [];
  $('.get_gender').each(function(){
    if($(this).is(":checked"))
    {
      gender.push($(this).val());
    }
  });
  gender = gender.toString();

  var baptis = [];
  $('.get_baptis').each(function(){
    if($(this).is(":checked"))
    {
      baptis.push($(this).val());
    }
  });
  baptis = baptis.toString();

  $.ajax({
    type: "POST",
    url: 'proses/frmAnggotaSimpan.php',
    data: {
      aktif: aktif,
      jam_ibadah: jam_ibadah,
      gender: gender,
      iduser: iduser,
      nama: nama,
      no_hp: no_hp,
      alamat: alamat,
      email: email,
      tmptlahir: tmptlahir,
      tgllahir: tgllahir,
      sekolah: sekolah,
      kelas: kelas,
      ket: ket,
      
      image: image,
      kelompok: kelompok,
      baptis: baptis,
      image:image,
      tombol: tombol
    },
    success: function(result){
      if(tombol == "Simpan"){
        refresh();
        // alert(result);
      }else if(tombol == "Ubah"){
        refresh3();
        // alert(result);
      }
    }});
}

// tombol hapus

function del(iduser){
  if(confirm("Apakah Anda yakin menghapus ini?")==true){
    $.ajax({
    type: "POST",
    url: 'proses/frmAnggotaSimpan.php',
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
    url: 'frmAnggota.php',
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
    url: 'frmAnggota.php',
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
    url: 'frmAnggota.php',
    data: {
      tombol: 'Ubah'
    },
    success: function(result){
      $("#output").html(result);
    }});
}
</script>

  </head>

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
    Tambah & List Anggota
  </div>
</center>

<hr>

<div id="tambahkan" style="display:none">
      <form action="proses/frmAnggotaSimpan.php" method="POST" enctype="multipart/form-data">         

        <div class="row">
        <div class="form-group col-sm-5">
            <input type="text" name="iduser" id="iduser" hidden>

            <label for="nama">Nama</label>
            <input type="nama" id="nama" name="nama" class="form-control" placeholder="Nama" required>
        </div>

        <div class="form-group col-sm-3">
          <label style="padding-bottom:6px">Jenis Kelamin</label><BR>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input get_gender" id="genderL" name="gender" value="L">
            <label class="custom-control-label" for="genderL">Laki-Laki</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input get_gender" id="genderP" name="gender" value="P">
            <label class="custom-control-label" for="genderP">Perempuan</label>
          </div>
        </div>

        <div class="form-group col-sm-4">
            <label for="inputEmail">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required>
        </div> 

       
      </div>

       

        <div class="row">

        <div class="form-group col-sm-6">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
        </div> 
        
        <div class="form-group col-sm-5">
            <label for="sekolah">Sekolah</label>
            <input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Sekolah">
        </div>
        <div class="form-group col-sm-1">          
          <label for="kelas">Kelas</label>
          <select id="kelas" name="kelas" class="form-control">
            <option value="VII">VII (7)</option>
            <option value="VIII">VIII (8)</option>
            <option value="IX">IX (9)</option>
            <option value="X">X (10)</option>
            <option value="XI">XI (11)</option>
            <option value="XII">XII (12)</option>
          </select>
          <!-- <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Kelas"> -->
        </div>

      </div>

      <div class="row">

        <div class="form-group col-sm-4">
          <label for="no_hp">No HP</label>
          <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No HP">
        </div>
        <div class="form-group col-sm-4">
          <label for="tmptlahir">Tempat Lahir</label>
          <input type="Text" class="form-control" id="tmptlahir" name="tmptlahir" placeholder="Tempat Lahir" style="text-transform: capitalize;">
         </div>
         <div class="form-group col-sm-4"> 
          <label for="tgllahir">Tanggal Lahir</label>
          <input type="date" class="form-control" id="tgllahir" name="tgllahir">
        </div>

      </div>

      <div class="row">

        
        <div class="form-group col-sm-2 pt-1">
          <p class="float-left mr-2 font-weight-bold">Status : </p>
          <div class="custom-control custom-checkbox float-left">
            <input type="checkbox" class="custom-control-input get_aktif" id="aktif" name="aktif" value="ya">
            <label class="custom-control-label" for="aktif">Aktif</label>
          </div>
        </div>
        
        <div class="form-group col-sm-3 pt-1">
          <p class="float-left mr-2 font-weight-bold">Sesi : </p>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input get_jam" id="glow1" name="jam_ibadah" value="Glow 1">
            <label class="custom-control-label" for="glow1">Glow 1</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input get_jam" id="glow2" name="jam_ibadah" value="Glow 2">
            <label class="custom-control-label" for="glow2">Glow 2</label>
          </div>
        </div>

        <div class="form-group col-sm-3 pt-1">
          <p class="float-left mr-2 font-weight-bold">Baptis : </p>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input get_baptis" id="sudah" name="baptis" value="Sudah">
            <label class="custom-control-label" for="sudah">Sudah</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input get_baptis" id="belum" name="baptis" value="Belum">
            <label class="custom-control-label" for="belum">Belum</label>
          </div>
        </div>

        <div class="form-group col-sm-4">
          <input class="form-control" type="text" name="ket" id="ket" placeholder="Keterangan">
        </div>

        <!-- <div class="form-group col-sm-6">
          <p class="float-left mr-2 font-weight-bold">Jenis Kelamin : </p>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="genderL" name="gender" value="L">
            <label class="custom-control-label" for="genderL">Laki-Laki</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" class="custom-control-input" id="genderP" name="gender" value="P">
            <label class="custom-control-label" for="genderP">Perempuan</label>
          </div>
        </div> -->

      </div>

      <div class="row">

        <div class="form-group col-sm-4">

        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="image" name="image">
            <label class="custom-file-label" for="image" id="namafoto">Pilih file Foto</label>
          </div>
        </div>


        <div class="form-group col-sm-4">
          <select name="kelompok" id="kelompok" class="custom-select">
            <option>Pilih Kelompok</option>
            <?php
            $sql = "select * from tbkelompok";
            $query = mysqli_query($con,$sql);
            while($re = mysqli_fetch_assoc($query)){
            ?>
            <option value="<?php echo $re['idklmpk']; ?>"><?php echo $re['namaklmpk']; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group col-sm-4">
          <input type="button" class="btn btn-primary btn-block mb-4" name="tombol" id="tombol" value="Simpan" onclick="savemk()">
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
            <th>Baptis</th>
            <th>Action</th>
            </tr>
          </thead>

        <?php
        $sql = "select * from tbanggota where status='anggota' order by nama asc";
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
          $baptis = $re['baptis'];
          $unit = $re['unit'];
          $class = $re['class'];
          $klpk = $re['kelompok'];
          $aktif = $re['aktif'];
          $gender = $re['gender'];
          $foto = $re['foto'];
          $klmpk = $re['kelompok'];
          $ket = $re['ket'];
        ?>

          <tr>
            <td><?= $nama; ?></td>
            <td><?= $alamat; ?></td>
            <td><?= $email; ?></td>
            <td><?= $nohp; ?></td>
            <td><?= $tmptlahir; ?></td>
            <td><?= $tgllahir; ?></td>
            <td><?= $sesi; ?></td>
            <td><?= $baptis; ?></td>
            <td>
              <button style="width:40px" class="btn btn-warning" name="edit" id="edit" onclick="return edit(<?php echo "'$iduser','$nama','$nohp','$alamat','$email','$tmptlahir','$tgllahir','$sesi','$unit','$class','$aktif','$gender','$foto','$klmpk','$ket','$baptis'"; ?>)">
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
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
})
</script>

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