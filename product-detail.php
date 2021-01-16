<?php
include 'template/header.php';
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
            <li class="breadcrumb-item active">Product Detail</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Detail Start -->

<?php 

$id = $_GET['id_barang'];
$q = mysqli_query ($koneksi, "select * from tbl_barang WHERE id_barang=$id");
$r = mysqli_fetch_array($q);
?>

<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-detail-top row">
                    <div class="align-items-center">
                        <div class="product-slider-single normal-slider">
                            <img src="admin/upload/<?=$r['foto_barang'] ?>" alt="Product Image">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="product-content">
                            <div class="title">
                                <h2><?= $r['nama_barang'] ?></h2>
                            </div>
                            <div class="ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="price">
                                <h4>Harga:</h4>
                                <p><?= $r['harga_barang'] ?></p>
                            </div>
                            <div class="quantity">
                                <h4>Quantity:</h4>
                                <div class="qty">
                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                    <input type="text" value="1">
                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="action">
                                <form action="addcart.php" method="POST">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="id" value="<?= $r['id_barang']; ?>">
                                    <input type="hidden" name="price" value="<?= $r['harga_barang']; ?>">
                                    <button type="submit" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                    <!-- <a class="btn" href="cart.php"><i class="fa fa-shopping-cart"></i>Add to Cart</a> -->
                                    <a class="btn" href="#"><i class="fa fa-shopping-bag"></i>Buy Now</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 product-detail-bottom row">
                <div class="">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#">Description</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="description" class="container tab-pane active">
                            <h4>Deskripsi Barang</h4>
                            <p>
                                <?= $r['deskripsi_barang'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php
include 'template/footer.php';
?>