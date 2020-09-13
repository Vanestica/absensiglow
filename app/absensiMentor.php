<?php
include "proses/koneksi.php";
$date = date("Y-m-d");

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
  <body>

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

  <div class="container mt-3">

<center>
  <div class="judul">
    Absensi Mentor
  </div>
</center>

<hr>
      <form action="proses/absensiMentorSimpan.php" method="POST">

        <div class="mt-3">
        <div class="row">
            <div class="form-group col-sm-6"> 
              <label for="tgl_lahir">Tanggal</label>
              <input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo $date; ?>">
            </div>

             <div class="form-group col-sm-6">
                <label for="admin">Admin</label>
                <input type="text" id="admin" name="admin" class="form-control" placeholder="Admin" required>
              </div>
        </div>

            <div class="table-responsive mt-4">
              <table id="tabel-data" class="table table-striped">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th style="width:400px">Alamat</th>
                    <th>No HP</th>
                    <th>Kehadiran</th>
                    <th style="width:200px">Ket</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = "select * from tbanggota where status='mentor' order by nama asc";
                  $query = mysqli_query($con,$sql);
                  $indx=0;
                  while($re = mysqli_fetch_assoc($query)){
                    $indx++;
                  ?>

                  <tr>
                    <input type="text" name="iduser<?= $indx ?>" value="<?php echo $re['iduser']; ?>" hidden>
                    <td><?php echo $re['nama']; ?></td>
                    <td><?php echo $re['alamat']; ?></td>
                    <td><?php echo $re['nohp']; ?></td>
                    <td><input type="checkbox" class="form-control" id="hadir<?= $indx ?>" name="hadir<?= $indx ?>" value="1" checked=""></td>
                    <td><input type="text" style="width:200px" class="form-control" id="ket<?= $indx ?>" name="ket<?= $indx ?>" placeholder="Ket"></td>
                  </tr>

                  <?php } ?>

                </tbody>
                <input type="text" name="isiindx" id="isiindx" value="<?= $indx ?>" hidden>
              </table>
            </div>
        

        <div class="row"> 
          <div class="col-sm-10">
          </div>
          <div class="col-sm-2">
            <button type="submit" class="btn btn-primary btn-block my-4">Simpan</button>
          </div>
        </div> 
      </form>
    </div>
  </body>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>