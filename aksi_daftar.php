<?php
include "lib/config.php";
include "lib/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$idkota = $_POST['idkota'];
$email = $_POST['email'];
$hp = $_POST['hp'];
$status = 'Y';


if ($username == "") {
   echo "<script> alert('Username tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($username == " ") {
   echo "<script> alert('Username tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($password == "") {
   echo "<script> alert('Password tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($password == " ") {
   echo "<script> alert('Password tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($nama == "") {
   echo "<script> alert('Nama Lengkap tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($nama == " ") {
   echo "<script> alert('Nama Lengkap tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($alamat == "") {
   echo "<script> alert('Alamat tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($alamat == " ") {
   echo "<script> alert('Alamat tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($email == "") {
   echo "<script> alert('Email tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($email == " ") {
   echo "<script> alert('Email tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($hp == "") {
   echo "<script> alert('No HandPhone tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else if ($hp == " ") {
   echo "<script> alert('No HandPhone tidak boleh kosong!'); window.location = '$base_url'+'daftar.php'</script>";
} else {
   $queryCekUsername = mysqli_query($koneksi, "SELECT * FROM tbl_customer WHERE username = '$username'");
   $jmlUsername = mysqli_num_rows($queryCekUsername);

   if ($jmlUsername > 0) {
      echo "<script> alert('username sudah digunakan, silahkan gunakan username lain');window.location = '$base_url'+'daftar.php'</script>";
   } else {
      $queryDaftar = mysqli_query($koneksi, "INSERT INTO tbl_customer (username,password,nama,alamat,id_kota,email,no_hp,status) VALUES ('$username','$password','$nama','$alamat','$idkota','$email','$hp','$status')");

      if ($queryDaftar) {
         echo "<script>alert('Data Registrasi Berhasil Masuk');window.location = '$base_url'+'index.php'</script>";
      } else {
         echo "<script> alert('Data Registrasi Gagal Masuk');window.location = '$base_url'+'daftar.php'</script>";
      }
   }
}
