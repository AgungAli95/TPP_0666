    <?php
    $sid = session_id();
    ?>
    <!-- Bottom Bar Start -->
    <div class="bottom-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="logo">
                        <a href="index.html">
                            <img src="asset/img/logo.png" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="search">
                        <input type="text" placeholder="Search">
                        <button><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="user">
                        <a href="wishlist.html" class="btn wishlist">
                            <i class="fa fa-heart"></i>
                            <span>(0)</span>
                        </a>
                        <a href="cart.html" class="btn cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span>(0)</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom Bar End -->

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-page-inner">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>gambar</th>
                                        <th>Product</th>
                                        <th>jumlah</th>
                                        <th>harga</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_order,tbl_barang WHERE tbl_order.id_session='$sid' AND tbl_order.id_barang = tbl_barang.id_barang");
                                    while ($r = mysqli_fetch_array($sql)) {
                                        $subtotal = $r['harga'] * $r['jumlah'];
                                    ?>

                                    <tr>
                                        <td class="cart_product">
                                            <a href=""><img height="110" width="110"
                                                    src="admin/upload/<?php echo $r['foto_barang']; ?>" alt=""></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href=""><?php echo $r['nama_barang'] ?></a></h4>
                                        </td>
                                        <td class="cart_quantity" align="center">
                                            <p><?php echo $r['jumlah']; ?></p>
                                        </td>
                                        <td class="cart_price">
                                            <p>Rp. <?php echo number_format($r['harga_barang']); ?></p>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">Rp. <?php echo number_format($subtotal); ?></p>
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--<tbody class="align-middle">
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="asset/img/product-1.jpg" alt="Image"></a>
                                                    <p>Product Name</p>
                                                </div>
                                            </td>
                                            <td>$99</td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="1">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td>$99</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="asset/img/product-2.jpg" alt="Image"></a>
                                                    <p>Product Name</p>
                                                </div>
                                            </td>
                                            <td>$99</td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="1">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td>$99</td>
                                            
                                        </tr>
                                       
                                        </tr>-->
                            </tbody>
                            </table>
                            <a href="checkout.php" class="btn btn-primary " style=" float:right">Checkout belanja</a>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-4">
                        <div class="cart-page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="coupon">
                                       
                                        <button>Apply Code</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                        <div class="cart-content">
                                            <h1>Cart Summary</h1>
                                            <p>Sub Total<span>$99</span></p>
                                            <p>Shipping Cost<span>$1</span></p>
                                            <h2>Grand Total<span>$100</span></h2>
                                        </div>
                                        <div class="cart-btn">
                                            <button>Update Cart</button>
                                            <button>Checkout</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
            </div>
        </div>
    </div>
    <!-- Cart End -->