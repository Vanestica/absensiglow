<?php
include "../proses/koneksi.php";
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
  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../dist/css/dashboard.css" rel="stylesheet">
    
  <!-- DataTables -->
  <link rel="stylesheet" href="../datatables/dtbs4.css" />
  <script src="../datatables/jq331.min.js"></script>
  <script src="../datatables/dtjq.min.js"></script>
  <script src="../datatables/dtbs4.js"></script>
</head>
<body class="bg-light">

<!-- Halaman Daftar -->

  <div class="container py-5">

    <center><h1>ABSENSI GLOW MINISTRY</h1></center>

    <div class="row">
      <div class="col-sm-7 mx-auto bg-white p-4 my-4" style="box-shadow: 0px 10px 10px -5px #ccc;border-radius: 0 30px;">
        <form action="login.php" method="POST">

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Ketikkan Email Anda" name="email"  >
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password"  >
          </div>

          <input value="Masuk" type="submit" class="btn btn-primary btn-block"><center>

        </form>
      </div>
    </div>

  </div>

</body>
</html>
