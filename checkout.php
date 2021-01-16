<?php
include 'template/header.php';
include "lib/koneksi.php";
?>
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Shipping</h2>
                    <form action="<?= $base_url ?>shipping.php" method="POST" class="contact-form row">
                        <div class="form-group col-md-9">
                            <select name="kurir" class="form-control">
                                <option value=""> -- Pilih Jasa Pengiriman --</option>
                                <?php
                                $qKurir = mysqli_query($koneksi, "SELECT * FROM tbl_jasa");
                                while ($kurir = mysqli_fetch_array($qKurir)) {
                                ?>
                                <option value="<?= $kurir['id_jasa'] ?>"><?= $kurir['nama_jasa'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3" style="margin-top: -15px;">
                            <button type="submit" name="submit" class="btn btn-primary pull-right"
                                style="height: 45px;">Choose Shipping</button>
                        </div>
                    </form>
                    <h2 class="title text-center">Personal Information</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <?php
                    $username = $_SESSION['user_username'];
                    $QueryProfile = mysqli_query($koneksi, "SELECT * FROM tbl_customer tm INNER JOIN tbl_kota tk ON tm.id_kota = tk.id_kota WHERE tm.username = '$username'");
                    $row = mysqli_fetch_assoc($QueryProfile);
                    ?>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="<?= $row['nama'] ?>" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="<?= $row['email'] ?>" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="notelp" class="form-control" placeholder="No Telp"
                                value="<?= $row['no_hp'] ?>" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control" name="kota" disabled>
                                <option value="<?= $row['id_kota'] ?>"><?= $row['nama_kota'] ?></option>
                                <?php
                                include "lib/koneksi.php";
                                $qKota = mysqli_query($koneksi, "SELECT * FROM tbl_kota");
                                while ($kota = mysqli_fetch_array($qKota)) {
                                ?>
                                <option value="<?= $kota['id_kota'] ?>"><?= $kota['nama_kota'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="alamat" id="message" class="form-control" rows="8" placeholder="Alamat"
                                disabled><?= $row['alamat'] ?></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            if (!empty($_SESSION['tempKurir'])) {
                $idkurir = $_SESSION['tempKurir'];
            } else {
                $idkurir = 0;
            }
            $username = $_SESSION['user_username'];
            $id_session = session_id();

            $QueryProfile = mysqli_query($koneksi, "SELECT * FROM tbl_customer WHERE username = '$username'");
            $rowUser = mysqli_fetch_assoc($QueryProfile);
            $kota = $rowUser['id_kota'];

            $bOngkir = 0;

            if (isset($_SESSION['tempKurir']) && !empty($_SESSION['tempKurir'])) {
                $QueryOngkir = mysqli_query($koneksi, "SELECT * FROM tbl_biaya_kirim tbo INNER JOIN tbl_jasa tbk
                ON tbo.id_jasa = tbk.id_jasa INNER JOIN tbl_kota tbkota
                ON tbo.id_kota = tbkota.id_kota
                WHERE tbo.id_jasa = '$idkurir' AND tbo.id_kota = '$kota'");
                $rowOngkir = mysqli_fetch_assoc($QueryOngkir);
                $bOngkir = $rowOngkir['biaya'];
            }

            $QueryOrder = mysqli_query($koneksi, "SELECT SUM(jumlah*harga) as subtotal FROM tbl_order WHERE id_session = '$id_session' AND status_order = 'C'");
            $rowOrder = mysqli_fetch_assoc($QueryOrder);


            $subtotal = $rowOrder['subtotal'];
            $total = $rowOrder['subtotal'] + $bOngkir;
            
            ?>


            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Detail Order</h2>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <table class="table table-condensed total-result text-right">
                                <tr>
                                    <td>Sub Total</td>
                                    <td>Rp <?= number_format($subtotal) ?></td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <?php if (!empty($_SESSION['tempKurir'])) { ?>
                                    <td>Rp <?= number_format($rowOngkir['biaya']) ?></td>
                                    <?php } else { ?>
                                    <td>Rp 0</td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>Rp <?= number_format($total) ?></td>
                                </tr>
                            </table>
                        </table>
                    </div>
                </div>
                <form method="POST" action="<?= $base_url ?>aksi-checkout.php">
                    <input type="hidden" name="total" value="<?= $total ?>">
                    <input type="hidden" name="id_jasa" value="<?= $idkurir ?>">
                    <input type="hidden" name="biaya_jasa" value="<?= $rowOngkir['biaya'] ?>">
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-primary pull-right">Confirm Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container" id="cart_items">
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $id_session = session_id();
                include "lib/koneksi.php";
                $username = $_SESSION['user_username'];

                $QueryCart = mysqli_query($koneksi, "SELECT * FROM tbl_order tbo INNER JOIN tbl_barang tbp ON tbo.id_barang = tbp.id_barang WHERE tbo.id_session = '$id_session' AND tbo.jumlah > 0 AND tbo.status_order = 'C'");
                while ($row = mysqli_fetch_array($QueryCart)) {
                ?>
                <tr>
                    <td class="cart_product" style="margin: 10px 20px">
                        <img src="admin/upload/<?= $row['foto_barang'] ?>" width="150">
                    </td>
                    <td class="cart_description">
                        <h4><?= $row['nama_barang'] ?></h4>
                    </td>
                    <td class="cart_price">
                        <p>Rp <?= number_format($row['harga']) ?></p>
                    </td>
                    <td class="cart_quantity">
                        <p><?= $row['jumlah'] ?></p>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">Rp <?= number_format($row['harga'] * $row['jumlah']) ?></p>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include 'template/footer.php';
?>