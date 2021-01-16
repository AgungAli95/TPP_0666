<?php
include "lib/koneksi.php";
include "lib/config.php";

$username = $_POST['username'];
$password = $_POST['password'];

$queryLogin = mysqli_query($koneksi, "SELECT * FROM tbl_customer WHERE username='$username' AND password='$password'");
$resultQuery = mysqli_num_rows($queryLogin);
$result = mysqli_fetch_array($queryLogin);
$status = $result['status'];
if ($resultQuery > 0) {
	if ($status == "Y") {
		// membuat session
		session_start();
		$_SESSION['idMember'] = $result['id_customer'];
		$_SESSION['user_username'] = $result['username'];
		header('location:product-list.php');
	} else {
		//kembali ke form login
		echo "<script> alert ('akun sudah dinonaktifkan');window.location='$base_url'+'login.php'</script>";
	}
} else {
	//kembali ke form login
	echo "<script> alert ('username atau password tidak ditemukan');window.location='$base_url'+'login.php'</script>";
}
