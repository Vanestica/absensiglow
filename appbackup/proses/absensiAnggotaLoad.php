<table class="table table-striped">
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

  <?php 
    include 'koneksi.php';
    $req = "";
    $kelompok = $_GET['kelompok'];
    //$tgl = $_GET['tgl'];
    // cari berdasarkan tgl dan klmpk. kalo tgl nya hari ini ya tampilkan semua

    if($_GET['kelompok'] != ''){
      $select = "select iduser, nama, alamat, nohp from tbanggota where status='anggota' and kelompok=". $kelompok ." order by nama asc ";
      $querybarang = mysqli_query($con,$select);
    }else{
      $select = "select iduser, nama, alamat, nohp from tbanggota where status='anggota' order by nama asc";
      $querybarang = mysqli_query($con,$select);
    }
    $indx=0;
    while ($hasil = mysqli_fetch_array($querybarang)) {
    $indx++;
  ?>
    <tr>
      <input type="text" name="iduser<?= $indx ?>" value="<?php echo $hasil['iduser']; ?>" hidden>
      <td><?php echo $hasil['nama'] ?></td>
      <td><?php echo $hasil['alamat'] ?></td>
      <td><?php echo $hasil['nohp'] ?></td>
      <td>
        <input type="checkbox" class="form-control" id="hadir<?= $indx ?>" name="hadir<?= $indx ?>" value="1" checked="">
      </td>
      <td><input type="text" style="width:200px" class="form-control" id="ket<?= $indx ?>" name="ket<?= $indx ?>" placeholder="Ket"></td>
    </tr>
  <?php
    }
  ?>
  <input type="hidden" name="isiindx" id="isiindx" value="<?= $indx ?>">
</table>
