<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<center>Anda harus login terlebih dahulu<br>";
    echo "<a href=../../index.php>Klik disini untuk Login</a></center>";
} else {
    
    include "../../../lib/config.php";
    include "../../../lib/koneksi.php";

    $namaGambar = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $path = "../../upload/" . $namaGambar;

    $idProduk = $_POST['id_barang'];
    $kategori = $_POST['kategori'];
    $namaProduk = $_POST['namaProduk'];
    $deskripsiProduk = $_POST['deskripsiProduk'];
    $hargaProduk = $_POST['hargaProduk'];
    $slide = $_POST['slide'];
    $rekomendasi = $_POST['rekomendasi'];

    if (empty($namaProduk)) {
        $error['nama_barang'] = 'Nama produk kosong';
    } else {
        if (strlen($namaProduk) < 10) {
            $error['nama_barang'] = "Minimal 10 huruf";
        };
    }
    if (empty($deskripsiProduk)) {
        $error['deskripsi_barang'] = 'Deskripsi produk kosong';
    } else {
        if (strlen($deskripsiProduk) < 20) {
            $error['deskripsi_barang'] = "Minimal 20 huruf";
        };
    }
    if (empty($hargaProduk)) {
        $error['harga_barang'] = 'Harga produk kosong';
    } else {
        if (!is_numeric($hargaProduk)) {
            $error['harga_barang'] = 'Harga produk harus berupa angka';
        }
    }


        if ($tipe_file == "image/jpeg" || $tipe_file = "image/png") {
            if ($ukuran_file <= 1000000) {
                if (move_uploaded_file($tmp_file, $path)) {
                    $QueryEdit = mysqli_query($koneksi, " UPDATE tbl_barang SET
                id_kategori = '$kategori'
                nama_produk = '$namaProduk',
                deskripsi = '$deskripsiProduk',
                harga = '$hargaProduk',
                gambar = '$namaGambar',
                slide = '$slide',
                rekomendasi = '$rekomendasi'
                WHERE id_barang = '$idProduk'");
                    if ($QueryEdit) {
                        echo "
                    <script>
                        alert('Data berhasil dirubah');
                        window.location = '$admin_url'+'asset/adminweb.php?module=produk';
                    </script>";
                    } else {
                        echo "
                    <script>
                        alert('Data gagal dirubah');
                        window.location = '$admin_url'+'asset/adminweb.php?module=edit_produk&id_produk='+'$idProduk';
                    </script>";
                    }
                } else {
                    echo "
                <script>
                    alert('Data gambar gagal');
                    window.location = '$admin_url'+'asset/adminweb.php?module=tambah_produk';
                </script>";
                }
            } else {
                echo "
            <script>
                alert('Data gambar terlalu besar');
                window.location = '$admin_url'+'asset/adminweb.php?module=tambah_produk';
            </script>";
            }
        } else {
            echo "
        <script>
            alert('Type gambar salah');
            window.location = '$admin_url'+'asset/adminweb.php?module=tambah_produk';
        </script>";
        } 
}
