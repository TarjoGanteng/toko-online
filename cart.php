<?php
include "header.php";
include "db.php";
?>

<!-- ============================================================
     HALAMAN KERANJANG BELANJA
============================================================ -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title"><i class="fa fa-shopping-cart"></i> Keranjang Belanja</h3>
                </div>
            </div>
        </div>

        <div id="cart_msg"></div>

        <div class="row">
            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead style="background: linear-gradient(to right, #061161, #780206); color:white;">
                            <tr>
                                <th>Produk</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cart_checkout">
                            <!-- Diisi oleh AJAX: checkOutDetails -->
                            <tr>
                                <td colspan="5" class="text-center">
                                    <i class="fa fa-spinner fa-spin"></i> Memuat keranjang...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="net_total text-right" style="font-size:20px; font-weight:bold; margin-top:10px; color:#780206;">
                    Total: Rp 0
                </div>
            </div>

            <!-- Panel Checkout -->
            <div class="col-md-3">
                <div class="panel panel-default" style="border-radius:10px; overflow:hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                    <div class="panel-heading" style="background: linear-gradient(to right, #061161, #780206); color:white; padding:15px;">
                        <h4 style="margin:0; color:white;"><i class="fa fa-credit-card"></i> Ringkasan Order</h4>
                    </div>
                    <div class="panel-body" style="padding:20px;">
                        <?php if (isset($_SESSION['uid'])): ?>
                            <p style="color:#666; margin-bottom:15px;">
                                <i class="fa fa-user"></i> Login sebagai: <strong><?php echo htmlspecialchars($_SESSION['first_name']); ?></strong>
                            </p>
                            <a href="checkout.php" class="primary-btn" style="width:100%; text-align:center; display:block; margin-bottom:10px;">
                                <i class="fa fa-lock"></i> Checkout Sekarang
                            </a>
                            <a href="index.php" class="btn btn-default" style="width:100%; text-align:center;">
                                <i class="fa fa-arrow-left"></i> Lanjut Belanja
                            </a>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <i class="fa fa-exclamation-triangle"></i>
                                Silakan <a href="#" data-toggle="modal" data-target="#Modal_login">login</a> untuk checkout.
                            </div>
                            <a href="index.php" class="btn btn-default" style="width:100%; text-align:center;">
                                <i class="fa fa-arrow-left"></i> Kembali Belanja
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Overlay loading -->
<div class="overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; text-align:center; padding-top:250px;">
    <i class="fa fa-spinner fa-spin" style="font-size:50px; color:white;"></i>
    <p style="color:white; font-size:20px; margin-top:10px;">Loading...</p>
</div>

<?php include "footer.php"; ?>

