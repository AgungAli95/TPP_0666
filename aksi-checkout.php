<?php
session_start();
include "lib/koneksi.php";
include "lib/config.php";

date_default_timezone_set('Asia/Jakarta');

$total = $_POST['total'];
$id_jasa = $_POST['id_jasa'];
$biaya_jasa = $_POST['biaya_jasa'];
$id_session = session_id();

if ($id_jasa == 0) {
    echo "<script>alert('Silahkan pilih jasa pengiriman terlebih dahulu'); window.location = '$base_url'+'checkout.php';</script>";
}
if ($total == $biaya_jasa) {
    echo "<script>alert('Checkout tidak berhasil, produk tidak ditemukan'); window.location = '$base_url'+'checkout.php';</script>";
}
$QueryOrder = mysqli_query($koneksi, "SELECT id_order,jumlah FROM tbl_order WHERE id_session = '$id_session' AND status_order = 'C'");

$inv = rand(100, 10000);

while ($rowOrder = mysqli_fetch_assoc($QueryOrder)) {
    $id_order = $rowOrder['id_order'];
    $jumlah = $rowOrder['jumlah'];
    $username = $_SESSION['user_username'];
    $tanggal = date('d/m/Y', time());
    $QuerySimpan = mysqli_query($koneksi, "INSERT INTO tbl_detail_order (id_order, id_jasa, invoice, jumlah, total, username, tanggal) VALUES ('$id_order','$id_jasa', '$inv','$jumlah','$total','$username','$tanggal')");
    if ($QuerySimpan) {
        echo "<script>alert('Checkout Berhasil'); window.location = '$base_url'+'index.php';</script>";
        unset($_SESSION['tempKurir']);
        $QueryUpdate = mysqli_query($koneksi, "UPDATE tbl_order SET status_order = 'P' WHERE id_order = '$id_order'");
    } else {
        echo "<script>alert('Checkout Tidak Berhasil'); window.location = '$base_url'+'index.php';</script>";
    }
}