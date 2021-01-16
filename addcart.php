<?php
session_start();
include "lib/koneksi.php";
include "lib/config.php";

$id = $_POST['id'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$id_session = session_id();

$QuesryCheck = mysqli_query($koneksi, "SELECT id_barang FROM tbl_order WHERE id_barang = '$id' AND id_session = '$id_session' AND status_order = 'C'");
$CheckCart = mysqli_num_rows($QuesryCheck);

if ($CheckCart == 0) {
    $QueryAdd = mysqli_query($koneksi, "INSERT INTO tbl_order VALUES ('', 'C', '$id', '$quantity', '$price', '$id_session')");
} else {
    $QueryUpdate = mysqli_query($koneksi, "UPDATE tbl_order SET jumlah = jumlah+'$quantity' WHERE id_barang = '$id' AND id_session = '$id_session'");
}
header('location:cart.php');