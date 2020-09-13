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

<link href="../dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../dist/css/dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="datatables/dtbs4.css" />
<script src="datatables/jq331.min.js"></script>
<script src="datatables/dtjq.min.js"></script>
<script src="datatables/dtbs4.js"></script>

<div class="row m-2">
  <div style="padding-left:0px;padding-right:0px" class="col-sm-12 col-12 d-flex justify-content-between flex-wrap flex-md-nowrap pb-2 align-items-center border-bottom">
    <h2>Dashboard</h2>

    <!-- Filterisasi Berdasarkan Tahun -->

    <!-- <form id="my-form" method="GET" action="data.php">
      <div class="row">
      <div class="form-group my-1">
        <select onchange="tahunFunc()" class="form-control" id="tahun" name="tahun">
          <option value="2019">2019</option>
        </select>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Lihat</button>
      </div>
    </div>
    </form> -->

    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <button class="btn btn-sm btn-outline-secondary">Share</button>
        <button class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
      <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span class="mr-2" data-feather="calendar"></span>This week
      </button>
    </div>
  </div>
</div>

<canvas class="my-4" id="myChart" width="900" height="580"></canvas>

<!-- Table -->

<h2>Ketidakhadiran</h2>
          <div class="table-responsive mb-4">
            <table id="tabel-data" class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>IDUSER</th>
                  <th>TGL</th>
                  <th>NAMA</th>
                  <th>KET</th>
                  <th>MENTOR</th>
                  <th>ADMIN</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $sql = "SELECT a1.iduser, ab.tgl, a1.nama, ad.ket, a2.nama as mentor, ab.admin as admin 
                          FROM tbanggota a1 
                          LEFT JOIN (
                          SELECT 
                              (@row_number:=@row_number + 1) AS num, 
                              tgl,
                              userid,
                              admin,
                              mentor
                          FROM
                              tbabsensi,
                              (SELECT @row_number:=0) AS t
                          ORDER BY 
                            NO) ab ON a1.iduser = ab.userid
                          LEFT JOIN tbanggota a2 ON ab.mentor = a2.iduser and a2.status='mentor'
                          LEFT JOIN 
                          (SELECT 
                            (@rn:=@rn + 1) AS num, 
                            ket,
                            iduser,
                            hadir
                          FROM
                            tbabsensidetil,
                            (SELECT @rn:=0) AS t
                          ORDER BY 
                            NO ) ad ON a1.iduser = ad.iduser and ad.num = ab.num
                          where ad.hadir = 0";
                $query = mysqli_query($con,$sql);
                while($re = mysqli_fetch_assoc($query)){
                  $iduser = $re['iduser'];
                  $tgl = $re['tgl'];
                  $nama = $re['nama'];
                  $ket = $re['ket'];
                  $mentor = $re['mentor'];
                  $admin = $re['admin'];
                ?>
                <tr>
                  <td><?= $iduser ?></td>
                  <td><?= $tgl ?></td>
                  <td><?= $nama ?></td>
                  <td><?= $ket ?></td>
                  <td><?= $mentor ?></td>
                  <td><?= $admin ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>

<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
      feather.replace()
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
$(document).ready(function(){
  $.ajax({
    url: "data.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var month = [];
      var total = [];

      for(var i in data) {
        month.push("Bulan " + data[i].month);
        total.push(data[i].total);
      }

      var chartdata = {
        labels: month,
        datasets : [
          {
            label: 'Kehadiran Tahun 2019',
            backgroundColor: 'rgba(0, 0, 255, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: total
          }
        ]
      };

      var ctx = $("#myChart");

      var barGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});

$(document).ready(function(){
    $('#tabel-data').DataTable();
});
</script>