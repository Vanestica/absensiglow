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

  <!-- Custom styles for this template -->
  <link href="../dist/css/dashboard.css" rel="stylesheet">
    
  <!-- DataTables -->
  <link rel="stylesheet" href="datatables/dtbs4.css" />
  <script src="datatables/jq331.min.js"></script>
  <script src="datatables/dtjq.min.js"></script>
  <script src="datatables/dtbs4.js"></script>

  <!-- PWA -->
<!--   <link rel="manifest" href="/manifest.json">
  <meta name="Description" content="@ArtTerror23" /> -->
<!-- theme-color defines the top bar color (blue in my case)-->
  <!-- <meta name="theme-color" content="#414f57" /> -->
  <!-- Add to home screen for Safari on iOS-->
  <!-- <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="default" />
  <meta name="apple-mobile-web-app-title" content="@ArtTerror23" />
  <link rel="apple-touch-icon" href="assets/img/icons/ar23logo128.png" /> -->
  <!-- Add to home screen for Windows-->
 <!--  <meta name="msapplication-TileImage" content="assets/img/icons/ar23logo128.png" />
  <meta name="msapplication-TileColor" content="#000000" /> -->


  
</head>

<style>
@media screen and (max-width: 1024px) {
    .nonehp {
        display: none !important;
    }
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}

@media screen and (min-width: 1024px) {
    .noneweb {
        display: none !important;
    }
}

.bar {
  width: 35px;
  height: 5px;
  background-color: white;
  margin: 6px 0;
}

.bar1, .bar2, .bar3 {
  width: 35px;
  height: 5px;
  background-color: white;
  margin: 6px 0;
  transition: 0.4s;
}

.change .bar1 {
  -webkit-transform: rotate(-45deg) translate(-9px, 6px);
  transform: rotate(-45deg) translate(-9px, 6px);
}

.change .bar2 {opacity: 0;}

.change .bar3 {
  -webkit-transform: rotate(45deg) translate(-8px, -8px);
  transform: rotate(45deg) translate(-8px, -8px);
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  overflow-x: hidden;
  padding-top: 60px;
  background-color: #f8f9fa;
  width:240px;
}

.sidenav a {
  padding: 8px 8px 8px 20px;
  text-decoration: none;
  font-size: 20px;
  color: white;
  display: block;
}

.sidenav a:hover {
  color: #007bff;
}

.sidenav .closebtn {
  position: absolute;
  top: -10px;
  right: 10px;
  font-size: 16px;
  margin-left: 50px;
}

.closebtn {
  top:100px;
  right:50px;
}

.sideweb {
  background-color: #f8f9fa;
}

a:hover {
  text-decoration: none;
}

.cursor {
  cursor:pointer;
}
</style>

<script>
function tahunFunc(){
    var form = document.getElementById("my-form");
    var action = form.getAttribute("action");
    var data = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("GET", action);
    xhr.send(data);
}
</script>

<body>

<!-- Top Navbar -->

  <nav class="navbar navbar-dark sticky-top bg-dark p-0 pt-2 pb-2">
    <a class="navbar-brand text-white col-2 mr-0" href="homeAdmin.php" style="font-size:1.2em">
      Glow Ministry
    </a>

    <input class="form-control form-control-dark col-9 nonehp" type="text" placeholder="Search" aria-label="Search">

    <a href="akses/logout.php" style="font-size:0.8em" class="text-white col-1 text-right nonehp">Log out <i class="fa fa-sign-out ml-2"></i></a>

<!-- Three Lines Menu -->
    <div class="col-2 text-white noneweb" id="barmenu">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </div>
<!-- End Three Lines Menu -->
  </nav>

<!-- Slide Menu Mobile -->

  <div id="mySidenav" style="margin-right:0px;display:none" class="sidenav noneweb bg-dark">
    
    <div class="row text-white offset-1 pb-3 pt-1 dashboard" style="font-size:18px">
      <span class="mr-2" data-feather="home"></span>Dashboard
    </div>

    <div class="row text-white offset-1 pb-3 pt-1 absensiMentor" style="font-size:18px">
      <span class="mr-2" data-feather="layers"></span>Absensi Mentor
    </div>

    <div class="row text-white offset-1 pb-3 pt-1 absensiAnggota" style="font-size:18px">
      <span class="mr-2" data-feather="layers"></span>Absensi Anggota
    </div>

    <div class="row text-white offset-1 pb-3 pt-1 frmMentor" style="font-size:18px">
      <span class="mr-2" data-feather="users"></span>Data Mentor
    </div>

    <div class="row text-white offset-1 pb-3 pt-1 frmAnggota" style="font-size:18px">
      <span class="mr-2" data-feather="users"></span>Data Anggota
    </div>

    <div class="row text-white offset-1 pb-3 pt-1 frmMasterK" style="font-size:18px">
      <span class="mr-2" data-feather="file"></span>Master Kelompok
    </div>

    <div class="row text-white offset-1 pb-3 pt-1 frmMasterR" style="font-size:18px">
      <span class="mr-2" data-feather="file"></span>Master Ruangan
    </div>

    <div class="row text-white offset-1 pb-3 pt-1" style="font-size:18px">
      <span class="mr-2" data-feather="bar-chart-2"></span>Reports
    </div>

    <div class="row text-white offset-1 pb-4 pt-1" style="font-size:18px">
      <span class="mr-2" data-feather="layers"></span>Integrations
    </div>

    <div class="row text-muted offset-1 pb-3 pt-1 d-flex justify-content-between align-items-center" style="font-size:18px">
      Saved reports<span class="mr-4" data-feather="plus-circle"></span>
    </div>

    <div class="row text-white offset-1 pb-3 pt-1" style="font-size:18px">
      <span class="mr-2" data-feather="file-text"></span>Current month
    </div>

    <div class="row text-white offset-1 pb-3 pt-1" style="font-size:18px">
      <span class="mr-2" data-feather="file-text"></span>Last quarter
    </div>

	<a href="akses/logout.php">
    <div class="text-muted offset-1 pb-3 pt-1 d-flex justify-content-between align-items-center font-weight-bold" style="font-size:18px">
      Log out<span class="mr-4" data-feather="log-out"></span></span>
    </div>
</a>
  </div>

<!-- Side Menu Website -->

  <div class="container-fluid">
      <div class="row">

          <!-- Side Menu -->

          <div class="nonehp col-sm-2 sideweb position-fixed h-100 py-4 px-2 bg-dark">
              <div class="row text-white offset-1 pb-3 pt-1 dashboard cursor" style="font-size:18px">
                <span class="mr-2" data-feather="home"></span>Dashboard
              </div>

              <div class="row text-white offset-1 pb-3 pt-1 absensiMentor cursor" style="font-size:18px">
                <span class="mr-2" data-feather="layers"></span>Absensi Mentor
              </div>

              <div class="row text-white offset-1 pb-3 pt-1 absensiAnggota cursor" style="font-size:18px">
                <span class="mr-2" data-feather="layers"></span>Absensi Anggota
              </div>

              <div class="row text-white offset-1 pb-3 pt-1 frmMentor cursor" style="font-size:18px">
                <span class="mr-2" data-feather="users"></span>Data Mentor
              </div>

              <div class="row text-white offset-1 pb-3 pt-1 frmAnggota cursor" style="font-size:18px">
                <span class="mr-2" data-feather="users"></span>Data Anggota
              </div>

              <div class="row text-white offset-1 pb-3 pt-1 frmMasterK cursor" style="font-size:18px">
                <span class="mr-2" data-feather="file"></span>Master Kelompok
              </div>

              <div class="row text-white offset-1 pb-3 pt-1 frmMasterR cursor" style="font-size:18px">
                <span class="mr-2" data-feather="file"></span>Master Ruangan
              </div>

              <div class="row text-white offset-1 pb-3 pt-1 reports cursor" style="font-size:18px">
                <span class="mr-2" data-feather="bar-chart-2"></span>Reports
              </div>

              <div class="row text-white offset-1 pb-4 pt-1 cursor" style="font-size:18px">
                <span class="mr-2" data-feather="layers"></span>Integrations
              </div>

              <div class="row text-muted offset-1 pb-3 pt-1 d-flex justify-content-between align-items-center" style="font-size:18px">
                Saved reports<span class="mr-4" data-feather="plus-circle"></span>
              </div>

              <div class="row text-white offset-1 pb-3 pt-1 cursor" style="font-size:18px">
                <span class="mr-2" data-feather="file-text"></span>Current month
              </div>

              <div class="row text-white offset-1 pb-3 pt-1 cursor" style="font-size:18px">
                <span class="mr-2" data-feather="file-text"></span>Last quarter
              </div>
          </div>

          <!-- OUTPUT DI SINI -->

          <div class="col-12 col-sm-10 offset-sm-2" id="output">
            <div class="row m-2">
              <div style="padding-left:0px;padding-right:0px" class="col-sm-12 col-12 d-flex justify-content-between flex-wrap flex-md-nowrap pb-2 align-items-center border-bottom">
                <h2>Dashboard</h2>

                <!-- Filterisasi Berdasarkan Tahun -->

                <!-- <form id="my-form" method="GET" action="data.php">
                  <div class="row">
                  <div class="form-group mt-1">
                    <select onchange="tahunFunc()" class="form-control" id="tahun" name="tahun">
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                    </select>
                  </div>
                  <div class="form-group ml-2 mt-1">
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
          </div>

          <!-- End Grafik dan lain-lain -->

      </div>
  </div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
      feather.replace()
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
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

</script>
</body>
</html>

<script>
// function myFunction(x) {
//   x.classList.toggle("change");
//   document.getElementById("mySidenav").style.width = "240px";
// }

// function closeNav() {
//   document.getElementById("mySidenav").style.width = "0";
// }

$(document).ready(function(){
  $("#barmenu").click(function(){
    $("#barmenu").toggleClass("change");
    $("#mySidenav").slideToggle();
  });
});

$(document).ready(function(){
    $('#tabel-data').DataTable();
});

$(document).ready(function(){
    $(".dashboard").click(function(){
      $("#output").load("dashboard.php");
    });
    $(".absensiMentor").click(function(){
      $("#output").load("absensiMentor.php");
      // jQuery(".dial").knob();
    });
    $(".absensiAnggota").click(function(){
      $("#output").load("absensiAnggota.php");
    });
    $(".frmMentor").click(function(){
      $("#output").load("frmMentor.php");
    });
    $(".frmAnggota").click(function(){
      $("#output").load("frmAnggota.php");
    });
    $(".frmMasterK").click(function(){
      $("#output").load("frmMasterK.php");
    });
    $(".frmMasterR").click(function(){
      $("#output").load("frmMasterR.php");
    });
    $(".reports").click(function(){
      $("#output").load("reports.php");
    });
});
</script>