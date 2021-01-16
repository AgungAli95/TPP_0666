<?php
session_start();
include "lib/koneksi.php";
include "lib/config.php";

if (!empty($_SESSION['idCustomer'])) {
	include "template/header.php";
	include "pages/checkout.php";
	include "template/footer.php";
} else {

	header("location:login.php");
}