<?php
session_start();
$sid = session_id();
include "lib/koneksi.php";
$id_pro = $_GET['id_barang'];
$h = $_GET['harga'];

//keranjang dalam keadaan kosong
// untuk mengecek keranjang dalam keadaan kosong, berdasarkan produk yang dipilih 
$sql = mysqli_query($koneksi, "SELECT id_barang FROM tbl_order WHERE id_barang ='$id_pro' AND id_session='$sid'");

$ketemu = mysqli_num_rows($sql);

if ($ketemu == 0) {
	mysqli_query($koneksi, "INSERT INTO tbl_order (status_order,id_barang,jumlah,harga,id_session) VALUES ('P','$id_pro',1,'$h','$sid')");
} else {
	mysqli_query($koneksi, "UPDATE tbl_order SET jumlah = jumlah+1 WHERE id_session='$sid' AND id_barang='$id_pro' ");
}
header('location:keranjang.php');
