<?php
session_start();
include "lib/koneksi.php";
include "lib/config.php";

$kurir = $_POST['kurir'];

$_SESSION['tempKurir'] = $kurir;

header('location: checkout.php');