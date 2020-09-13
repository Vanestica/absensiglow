<?php

session_start();
require_once("../proses/koneksi.php");
$email = $_POST['email'];
$password = md5($_POST['password']);

	$sql = "SELECT * FROM tbanggota WHERE email='$email' AND pass='$password'";
	$results = mysqli_query($con, $sql);

	if (mysqli_num_rows($results) == 1) { // user found
		// check if user is admin or user
		$logged_in_user = mysqli_fetch_assoc($results);

		if ($logged_in_user['status'] == 'mentor' || $logged_in_user['status'] == 'admin') {
			$_SESSION['email'] = $logged_in_user;
			header('location: ../homeAdmin.php');
			$iduser = $_SESSION['iduser'];
		}

	} else { 
		?>
		    <script type="text/javascript">
		    alert("Email atau Password salah.");
		    window.location.href = "../homeAdmin.php";
		    </script>
	    <?php
	}
		?>

