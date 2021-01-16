<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "tugas_Tpp";

$koneksi = mysqli_connect($server, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "Failed to connect Mysql: " . mysqli_connect_error();
    exit();
}
