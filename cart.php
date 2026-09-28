<?php
include "header.php";
include "db.php";
?>

<!-- ============================================================
     HALAMAN KERANJANG BELANJA
============================================================ -->
<style>
.cart-page { background:#f5f5f7; min-height:70vh; padding:48px 0 80px; }
.cart-breadcrumb { display:flex; align-items:center; gap:8px; font-size:13px; color:#86868b; margin-bottom:28px; }
.cart-breadcrumb a { color:#0071e3; text-decoration:none; }
.cart-breadcrumb a:hover { text-decoration:underline; }
.cart-page-title { font-size:30px; font-weight:800; letter-spacing:-0.04em; color:#1d1d1f; margin-bottom:28px; display:flex; align-items:center; gap:12px; }
.cart-page-title i { color:#0071e3; }
.cart-layout { display:grid; grid-template-columns:1fr 340px; gap:24px; align-items:start; }
.cart-card { background:#fff; border-radius:18px; box-shadow:0 2px 20px rgba(0,0,0,0.07); overflow:hidden; }
.cart-card table { width:100%; border-collapse:collapse; margin:0; }
.cart-card thead th { background:#0a1f44; color:#fff; padding:13px 18px; font-size:12px; font-weight:700; letter-spacing:0.05em; text-transform:uppercase; border-bottom:2px solid rgba(255,255,255,0.1); border-right:1px solid rgba(255,255,255,0.12); }
.cart-card thead th:last-child { border-right:none; }
.cart-card thead th.th-product { background:linear-gradient(135deg,#0a1f44,#0071e3); color:#fff; border-right:1px solid rgba(255,255,255,0.2); border-bottom:2px solid rgba(255,255,255,0.15); }
.cart-card tbody tr { border-bottom:1px solid #f0f0f0; transition:background .15s; }
.cart-card tbody tr:last-child { border-bottom:none; }
.cart-card tbody tr:hover { background:#fafafa; }
.cart-card tbody td { padding:16px 18px; vertical-align:middle; font-size:14px; color:#1d1d1f; border-right:1px solid #f0f0f0; }
.cart-card tbody td:last-child { border-right:none; }
.cart-product-wrap { display:flex; align-items:center; gap:12px; }
.cart-product-wrap img { width:60px; height:60px; object-fit:cover; border-radius:10px; border:1px solid #f0f0f0; background:#fafafa; }
.cart-product-name { font-size:13px; font-weight:600; color:#1d1d1f; line-height:1.4; }
.qty-input { width:60px; padding:6px 8px; border:1.5px solid #e0e0e0; border-radius:8px; font-size:14px; font-weight:600; text-align:center; color:#1d1d1f; transition:border-color .2s; -moz-appearance:textfield; }
.qty-input:focus { outline:none; border-color:#0071e3; }
.qty-input::-webkit-outer-spin-button,.qty-input::-webkit-inner-spin-button { -webkit-appearance:none; }
.cart-action-btns { display:flex; gap:6px; }
.btn-delete { width:34px; height:34px; border-radius:8px; border:none; background:#fff0f0; color:#e74c3c; font-size:13px; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all .2s; }
.btn-delete:hover { background:#e74c3c; color:#fff; }
.btn-update { width:34px; height:34px; border-radius:8px; border:none; background:#e8f0fe; color:#0071e3; font-size:13px; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all .2s; }
.btn-update:hover { background:#0071e3; color:#fff; }
.cart-footer { padding:18px 22px; background:#fafafa; border-top:1px solid #f0f0f0; display:flex; align-items:center; justify-content:space-between; gap:16px; }
.continue-btn { display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border-radius:980px; background:#f0f0f0; color:#1d1d1f; font-size:13px; font-weight:600; text-decoration:none; transition:all .2s; }
.continue-btn:hover { background:#e0e0e0; color:#1d1d1f; text-decoration:none; }
.cart-total-row { display:flex; align-items:center; gap:12px; }
.cart-total-label { font-size:14px; color:#86868b; }
.cart-total-value { font-size:22px; font-weight:800; color:#1d1d1f; letter-spacing:-0.03em; }
.order-summary { background:#fff; border-radius:18px; box-shadow:0 2px 20px rgba(0,0,0,0.07); overflow:hidden; position:sticky; top:90px; }
.order-summary-header { background:linear-gradient(135deg,#0a1f44,#0071e3); padding:18px 22px; color:#fff; }
.order-summary-header h4 { margin:0; font-size:15px; font-weight:700; display:flex; align-items:center; gap:8px; }
.order-summary-body { padding:22px; }
.summary-line { display:flex; justify-content:space-between; align-items:center; padding:9px 0; border-bottom:1px solid #f5f5f5; font-size:13px; }
.summary-line:last-of-type { border-bottom:none; }
.summary-line .lbl { color:#86868b; }
.summary-line .val { font-weight:600; color:#1d1d1f; }
.summary-divider { height:1px; background:#ebebeb; margin:10px 0; }
.summary-total-line { display:flex; justify-content:space-between; align-items:center; padding:12px 0 0; }
.summary-total-line .lbl { font-size:15px; font-weight:700; color:#1d1d1f; }
.summary-total-value { font-size:20px; font-weight:800; color:#0071e3; letter-spacing:-0.03em; }
.checkout-btn { display:flex; align-items:center; justify-content:center; gap:10px; width:100%; padding:15px 20px; margin-top:18px; background:linear-gradient(135deg,#0071e3 0%,#0052a5 100%); color:#fff; font-size:15px; font-weight:700; border-radius:14px; border:none; cursor:pointer; text-decoration:none; transition:all .25s; box-shadow:0 6px 20px rgba(0,113,227,0.35); position:relative; overflow:hidden; }
.checkout-btn::before { content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg,transparent,rgba(255,255,255,0.15),transparent); transition:left .5s; }
.checkout-btn:hover { background:linear-gradient(135deg,#005bb5,#003d7a); color:#fff; text-decoration:none; transform:translateY(-2px); box-shadow:0 10px 28px rgba(0,113,227,0.45); }
.checkout-btn:hover::before { left:100%; }
.checkout-btn-icon { width:30px; height:30px; background:rgba(255,255,255,0.2); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:14px; flex-shrink:0; }
.secure-badges { display:flex; align-items:center; justify-content:center; gap:6px; margin-top:12px; font-size:12px; color:#86868b; }
.secure-badges i { color:#34c759; }
.login-required-box { background:linear-gradient(135deg,#fff8e1,#fff3cd); border:1.5px solid #ffc107; border-radius:12px; padding:16px; margin-top:16px; text-align:center; font-size:13px; color:#856404; }
.login-required-box .login-btn { display:inline-flex; align-items:center; gap:6px; margin-top:10px; padding:9px 18px; background:#0071e3; color:#fff; border-radius:980px; font-size:13px; font-weight:600; text-decoration:none; transition:background .2s; }
.login-required-box .login-btn:hover { background:#0052a5; color:#fff; }
@media (max-width:768px) { .cart-layout { grid-template-columns:1fr; } .order-summary { position:static; } }
</style>

<div class="cart-page">
    <div class="container">
        <div class="cart-breadcrumb">
            <a href="index.php"><i class="fa fa-home"></i> Beranda</a>
            <i class="fa fa-angle-right"></i>
            <span>Keranjang Belanja</span>
        </div>
        <h1 class="cart-page-title"><i class="fa fa-shopping-bag"></i> Keranjang Belanja</h1>
        <div id="cart_msg"></div>
        <div class="cart-layout">
            <div>
                <div class="cart-card">
                    <table>
                        <thead>
                            <tr>
                                <th class="th-product" style="width:42%">Produk</th>
                                <th>Harga Satuan</th>
                                <th style="width:90px">Jumlah</th>
                                <th>Subtotal</th>
                                <th style="width:80px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cart_checkout">
                            <tr>
                                <td colspan="5" style="text-align:center;padding:60px 20px;color:#86868b;">
                                    <i class="fa fa-spinner fa-spin" style="font-size:22px;display:block;margin-bottom:10px;"></i>
                                    Memuat keranjang...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cart-footer">
                        <a href="index.php" class="continue-btn"><i class="fa fa-arrow-left"></i> Lanjut Belanja</a>
                        <div class="cart-total-row">
                            <span class="cart-total-label">Total:</span>
                            <span class="cart-total-value net_total">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="order-summary">
                    <div class="order-summary-header">
                        <h4><i class="fa fa-receipt"></i> Ringkasan Order</h4>
                    </div>
                    <div class="order-summary-body">
                        <div class="summary-line">
                            <span class="lbl">Subtotal Produk</span>
                            <span class="val net_total">Rp 0</span>
                        </div>
                        <div class="summary-line">
                            <span class="lbl">Ongkos Kirim</span>
                            <span class="val" style="color:#34c759;">Gratis</span>
                        </div>
                        <div class="summary-line">
                            <span class="lbl">Diskon</span>
                            <span class="val" style="color:#ff6b00;">-Rp 0</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-total-line">
                            <span class="lbl">Total Pembayaran</span>
                            <span class="summary-total-value net_total">Rp 0</span>
                        </div>
                        <?php if (isset($_SESSION['uid'])): ?>
                        <a href="checkout.php" class="checkout-btn">
                            <span class="checkout-btn-icon"><i class="fa fa-lock"></i></span>
                            <span>Checkout Sekarang</span>
                            <i class="fa fa-long-arrow-right" style="margin-left:auto;font-size:16px;opacity:0.8;"></i>
                        </a>
                        <div class="secure-badges"><i class="fa fa-shield"></i> Transaksi aman &amp; terenkripsi</div>
                        <?php else: ?>
                        <div class="login-required-box">
                            <i class="fa fa-exclamation-circle" style="font-size:22px;display:block;margin-bottom:8px;color:#ffc107;"></i>
                            <strong>Login diperlukan</strong>
                            <p style="margin:5px 0 0;font-size:12px;">Silakan login untuk melanjutkan checkout</p>
                            <a href="" data-toggle="modal" data-target="#Modal_login" class="login-btn"><i class="fa fa-sign-in"></i> Login Sekarang</a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overlay" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.4);z-index:9999;text-align:center;padding-top:280px;backdrop-filter:blur(4px);">
    <div style="display:inline-flex;flex-direction:column;align-items:center;gap:12px;background:#fff;padding:28px 40px;border-radius:16px;box-shadow:0 8px 40px rgba(0,0,0,0.2);">
        <i class="fa fa-spinner fa-spin" style="font-size:28px;color:#0071e3;"></i>
        <span style="font-size:14px;font-weight:600;color:#1d1d1f;">Memperbarui keranjang...</span>
    </div>
</div>

<?php include "footer.php"; ?>
