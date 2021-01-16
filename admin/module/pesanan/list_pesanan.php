<?php
  include "../../lib/config.php";
  include "../../lib/koneksi.php";
?>
<div class="content-body">

    <div class="container-fluid mt-3">
        <div class="content-wrapper">
            <section class="content-header">
                <h2>
                    Manajemen Pesanan
                </h2>
            </section>

            <section class="content">
                <div class="card">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">List Pesanan</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Username</th>
                                                <th>Tanggal</th>
                                                <th style="width: 110px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                    $QueryCart = mysqli_query(
                                        $koneksi,
                                        "SELECT DISTINCT invoice, total, username, tanggal FROM tbl_detail_order do INNER JOIN tbl_order o ON do.id_order = o.id_order INNER JOIN tbl_jasa k ON do.id_jasa = k.id_jasa"
                                    );
                                    while ($row = mysqli_fetch_array($QueryCart)) {
                                    ?>
                                            <tr>
                                                <td>INV-<?= $row['invoice']; ?></td>
                                                <td>Rp <?= number_format($row['total']); ?></td>
                                                <td>
                                                    <?php
                                                $invoice = $row['invoice'];
                                                $QueryItems = mysqli_query($koneksi, "SELECT DISTINCT status_order FROM tbl_detail_order do INNER JOIN tbl_order o ON do.id_order = o.id_order INNER JOIN tbl_barang p ON o.id_barang = p.id_barang WHERE do.invoice = '$invoice'");;
                                                $rowItems = mysqli_fetch_array($QueryItems);
                                                if ($rowItems['status_order'] == 'P') {
                                                    $status = 'Proses';
                                                } elseif ($rowItems['status_order'] == 'K') {
                                                    $status = 'Kirim';
                                                } elseif ($rowItems['status_order'] == 'S') {
                                                    $status = 'Selesai';
                                                }
                                                echo $status;
                                                ?>
                                                </td>
                                                <td><?= $row['username']; ?></td>
                                                <td><?= $row['tanggal']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-warning"
                                                            href="<?= $admin_url; ?>asset/adminweb.php?module=edit_pesanan&invoice=<?= $row['invoice']; ?>"><i
                                                                class="fa fa-pencil"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer clearfix">
                                    <a class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal"
                                        data-target="#laporan">Laporan</a>
                                    <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All
                                        Orders</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="modal fade" id="laporan">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Laporan Pemesanan</h4>
                    </div>
                    <form action="../module/pesanan/aksi_laporan.php" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" name="mulai" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" name="selesai" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>