<?php
// Gunakan guard agar tidak konflik dengan header.php
if (session_status() === PHP_SESSION_NONE) session_start();
include "db.php";

// Redirect jika belum login
if (!isset($_SESSION['uid'])) {
    header('Location: index.php');
    exit();
}

$uid = (int)$_SESSION['uid'];

// Data user
$res_u = mysqli_query($con, "SELECT * FROM user_info WHERE user_id='$uid' LIMIT 1");
$user  = mysqli_fetch_assoc($res_u) ?: [];

// Item keranjang
$res_c = mysqli_query($con, "SELECT c.id, c.qty, p.product_title, p.product_price, p.product_image
                              FROM cart c
                              JOIN product p ON c.p_id = p.product_id
                              WHERE c.user_id='$uid'");
$items       = [];
$grand_total = 0;
while ($r = mysqli_fetch_assoc($res_c)) {
    $r['sub']    = $r['product_price'] * $r['qty'];
    $grand_total += $r['sub'];
    $items[]     = $r;
}

// Jika keranjang kosong
if (empty($items)) {
    header('Location: cart.php');
    exit();
}

$total_count = count($items);

include "header.php";
?>

<style>
.co-page { background:#f5f5f7; min-height:80vh; padding:44px 0 80px; }
.co-title { font-size:26px; font-weight:800; letter-spacing:-0.04em; color:#1d1d1f; margin-bottom:28px; display:flex; align-items:center; gap:10px; }
.co-title i { color:#0071e3; }
.co-layout { display:grid; grid-template-columns:1fr 330px; gap:24px; align-items:start; }
.co-card { background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,0.06); overflow:hidden; margin-bottom:20px; }
.co-card-hdr { padding:16px 22px; border-bottom:1px solid #f0f0f0; display:flex; align-items:center; gap:10px; background:#fafafa; }
.co-card-hdr span { width:24px; height:24px; border-radius:50%; background:#0071e3; color:#fff; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:800; flex-shrink:0; }
.co-card-hdr h3 { margin:0; font-size:14px; font-weight:700; color:#1d1d1f; }
.co-card-body { padding:20px 22px; }
.f-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px; }
.f-row.full { grid-template-columns:1fr; }
.f-grp { display:flex; flex-direction:column; gap:5px; }
.f-grp label { font-size:11px; font-weight:700; color:#555; letter-spacing:0.04em; text-transform:uppercase; }
.f-grp input, .f-grp select { padding:10px 13px; border:1.5px solid #e0e0e0; border-radius:9px; font-size:14px; color:#1d1d1f; font-family:inherit; transition:border-color .2s; width:100%; box-sizing:border-box; background:#fff; }
.f-grp input:focus, .f-grp select:focus { outline:none; border-color:#0071e3; box-shadow:0 0 0 3px rgba(0,113,227,0.1); }
.f-grp input::placeholder { color:#b0b0b0; }

/* Sidebar */
.co-sidebar { background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,0.06); overflow:hidden; position:sticky; top:90px; }
.co-sidebar-hdr { background:#1d1d1f; padding:16px 20px; }
.co-sidebar-hdr h4 { margin:0; font-size:14px; font-weight:700; color:#fff; display:flex; align-items:center; gap:8px; }
.co-item { display:flex; align-items:center; gap:10px; padding:12px 18px; border-bottom:1px solid #f5f5f5; }
.co-item img { width:46px; height:46px; object-fit:cover; border-radius:8px; border:1px solid #f0f0f0; background:#fafafa; flex-shrink:0; }
.co-item-name { font-size:13px; font-weight:600; color:#1d1d1f; flex:1; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:140px; }
.co-item-sub { font-size:12px; color:#86868b; margin-top:2px; }
.co-item-price { font-size:13px; font-weight:700; color:#1d1d1f; white-space:nowrap; }
.co-totals { padding:14px 18px; }
.co-line { display:flex; justify-content:space-between; font-size:13px; padding:5px 0; }
.co-line .l { color:#86868b; }
.co-line .v { font-weight:600; }
.co-grand { display:flex; justify-content:space-between; align-items:center; padding:14px 18px; border-top:2px solid #f0f0f0; }
.co-grand .l { font-size:14px; font-weight:700; color:#1d1d1f; }
.co-grand .v { font-size:18px; font-weight:800; color:#0071e3; }

/* Order button */
.order-btn { display:flex; align-items:center; justify-content:center; gap:10px; width:100%; padding:15px; background:linear-gradient(135deg,#0071e3,#0052a5); color:#fff; font-size:15px; font-weight:700; border:none; cursor:pointer; transition:all .25s; box-shadow:0 4px 16px rgba(0,113,227,0.3); position:relative; overflow:hidden; }
.order-btn::before { content:''; position:absolute; top:0; left:-100%; width:100%; height:100%; background:linear-gradient(90deg,transparent,rgba(255,255,255,0.12),transparent); transition:left .5s; }
.order-btn:hover { background:linear-gradient(135deg,#005bb5,#003d7a); box-shadow:0 8px 24px rgba(0,113,227,0.4); }
.order-btn:hover::before { left:100%; }

.secure-note { text-align:center; padding:10px 18px; font-size:11px; color:#86868b; display:flex; align-items:center; justify-content:center; gap:5px; }
.secure-note i { color:#34c759; }

/* Success message */
.success-box { background:#e8f9ed; border:1.5px solid #34c759; border-radius:12px; padding:20px; text-align:center; margin-bottom:20px; }
.success-box i { font-size:32px; color:#34c759; display:block; margin-bottom:10px; }
.success-box h3 { margin:0 0 6px; font-size:16px; font-weight:700; color:#1a7a34; }
.success-box p { margin:0; font-size:13px; color:#555; }

.co-breadcrumb { display:flex; align-items:center; gap:8px; font-size:13px; color:#86868b; margin-bottom:24px; }
.co-breadcrumb a { color:#0071e3; text-decoration:none; }
@media(max-width:768px) { .co-layout{grid-template-columns:1fr;} .co-sidebar{position:static;} .f-row{grid-template-columns:1fr;} }
</style>

<div class="co-page">
<div class="container">

    <!-- Breadcrumb -->
    <div class="co-breadcrumb">
        <a href="index.php"><i class="fa fa-home"></i> Beranda</a>
        <i class="fa fa-angle-right"></i>
        <a href="cart.php">Keranjang</a>
        <i class="fa fa-angle-right"></i>
        <span>Checkout</span>
    </div>

    <h1 class="co-title"><i class="fa fa-credit-card"></i> Checkout</h1>

    <div id="co_msg"></div>

    <div class="co-layout">

        <!-- KIRI: Form -->
        <div>
            <form id="co-form">

                <!-- Alamat -->
                <div class="co-card">
                    <div class="co-card-hdr">
                        <span>1</span>
                        <h3>Alamat Pengiriman</h3>
                    </div>
                    <div class="co-card-body">
                        <div class="f-row">
                            <div class="f-grp">
                                <label>Nama Depan</label>
                                <input type="text" name="fname" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" placeholder="Nama depan" required>
                            </div>
                            <div class="f-grp">
                                <label>Nama Belakang</label>
                                <input type="text" name="lname" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" placeholder="Nama belakang">
                            </div>
                        </div>
                        <div class="f-row">
                            <div class="f-grp">
                                <label>Email</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" placeholder="Email" required>
                            </div>
                            <div class="f-grp">
                                <label>No. Telepon</label>
                                <input type="tel" name="phone" placeholder="08xx-xxxx-xxxx" required>
                            </div>
                        </div>
                        <div class="f-row full">
                            <div class="f-grp">
                                <label>Alamat Lengkap</label>
                                <input type="text" name="address" placeholder="Jalan, No. rumah, RT/RW" required>
                            </div>
                        </div>
                        <div class="f-row">
                            <div class="f-grp">
                                <label>Kota</label>
                                <input type="text" name="city" placeholder="Nama kota" required>
                            </div>
                            <div class="f-grp">
                                <label>Kode Pos</label>
                                <input type="text" name="postal" placeholder="12345">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pembayaran -->
                <div class="co-card">
                    <div class="co-card-hdr">
                        <span>2</span>
                        <h3>Metode Pembayaran</h3>
                    </div>
                    <div class="co-card-body" style="display:flex;flex-direction:column;gap:10px;">
                        <label style="display:flex;align-items:center;gap:12px;padding:12px 14px;border:1.5px solid #0071e3;border-radius:10px;cursor:pointer;background:#f0f7ff;">
                            <input type="radio" name="payment" value="transfer" checked style="accent-color:#0071e3;">
                            <i class="fa fa-bank" style="color:#0071e3;font-size:16px;width:20px;text-align:center;"></i>
                            <div><div style="font-size:13px;font-weight:700;color:#1d1d1f;">Transfer Bank</div><div style="font-size:12px;color:#86868b;">BCA, BNI, BRI, Mandiri</div></div>
                        </label>
                        <label style="display:flex;align-items:center;gap:12px;padding:12px 14px;border:1.5px solid #e0e0e0;border-radius:10px;cursor:pointer;" id="pay-ewallet">
                            <input type="radio" name="payment" value="ewallet" style="accent-color:#0071e3;">
                            <i class="fa fa-mobile" style="color:#34c759;font-size:16px;width:20px;text-align:center;"></i>
                            <div><div style="font-size:13px;font-weight:700;color:#1d1d1f;">E-Wallet</div><div style="font-size:12px;color:#86868b;">GoPay, OVO, Dana</div></div>
                        </label>
                        <label style="display:flex;align-items:center;gap:12px;padding:12px 14px;border:1.5px solid #e0e0e0;border-radius:10px;cursor:pointer;" id="pay-cod">
                            <input type="radio" name="payment" value="cod" style="accent-color:#0071e3;">
                            <i class="fa fa-money" style="color:#ffc107;font-size:16px;width:20px;text-align:center;"></i>
                            <div><div style="font-size:13px;font-weight:700;color:#1d1d1f;">Bayar di Tempat (COD)</div><div style="font-size:12px;color:#86868b;">Bayar saat pesanan tiba</div></div>
                        </label>
                    </div>
                </div>

            </form>
        </div>

        <!-- KANAN: Ringkasan -->
        <div>
            <div class="co-sidebar">
                <div class="co-sidebar-hdr">
                    <h4><i class="fa fa-shopping-bag"></i> Pesanan Anda (<?= $total_count ?> item)</h4>
                </div>

                <?php foreach ($items as $it): ?>
                <?php $img = !empty($it['product_image']) ? 'img/'.htmlspecialchars($it['product_image']) : 'img/no-image.png'; ?>
                <div class="co-item">
                    <img src="<?= $img ?>" alt="<?= htmlspecialchars($it['product_title']) ?>" onerror="this.src='img/no-image.png'">
                    <div style="flex:1;min-width:0;">
                        <div class="co-item-name"><?= htmlspecialchars($it['product_title']) ?></div>
                        <div class="co-item-sub"><?= $it['qty'] ?>x</div>
                    </div>
                    <div class="co-item-price">Rp <?= number_format($it['sub'], 0, ',', '.') ?></div>
                </div>
                <?php endforeach; ?>

                <div class="co-totals">
                    <div class="co-line"><span class="l">Subtotal</span><span class="v">Rp <?= number_format($grand_total, 0, ',', '.') ?></span></div>
                    <div class="co-line"><span class="l">Ongkos Kirim</span><span class="v" style="color:#34c759;">Gratis</span></div>
                </div>
                <div class="co-grand">
                    <span class="l">Total Pembayaran</span>
                    <span class="v">Rp <?= number_format($grand_total, 0, ',', '.') ?></span>
                </div>

                <button type="submit" form="co-form" class="order-btn" id="order-btn">
                    <i class="fa fa-lock"></i>
                    <span>Buat Pesanan</span>
                    <i class="fa fa-long-arrow-right" style="margin-left:auto;opacity:0.8;"></i>
                </button>
                <div class="secure-note"><i class="fa fa-shield"></i> Transaksi aman &amp; terenkripsi</div>
            </div>
        </div>

    </div>
</div>
</div>

<script>
document.getElementById('co-form').addEventListener('submit', function(e) {
    e.preventDefault();
    var btn  = document.getElementById('order-btn');
    var form = document.getElementById('co-form');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> <span>Memproses...</span>';

    var data = new FormData(form);

    fetch('checkout_process.php', {
        method: 'POST',
        body: data
    })
    .then(function(res) { return res.json(); })
    .then(function(json) {
        if (json.success) {
            document.getElementById('co_msg').innerHTML =
                '<div class="success-box">' +
                '<i class="fa fa-check-circle"></i>' +
                '<h3>Pesanan Berhasil Dibuat! 🎉</h3>' +
                '<p>No. Order: <strong>#' + json.order_id + '</strong></p>' +
                '<p>Anda akan diarahkan ke halaman pesanan dalam <span id="co-countdown">3</span> detik...</p>' +
                '</div>';
            window.scrollTo({ top: 0, behavior: 'smooth' });

            // Countdown & redirect
            var sec = 3;
            var timer = setInterval(function() {
                sec--;
                var el = document.getElementById('co-countdown');
                if (el) el.textContent = sec;
                if (sec <= 0) {
                    clearInterval(timer);
                    window.location.href = 'orders.php';
                }
            }, 1000);

        } else {
            document.getElementById('co_msg').innerHTML =
                '<div style="background:#fef0f0;border:1.5px solid #e74c3c;border-radius:12px;padding:14px 18px;color:#cc0000;margin-bottom:16px;">' +
                '<i class="fa fa-exclamation-circle"></i> ' + json.msg +
                '</div>';
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-lock"></i><span>Buat Pesanan</span><i class="fa fa-long-arrow-right" style="margin-left:auto;opacity:0.8;"></i>';
        }
    })
    .catch(function() {
        document.getElementById('co_msg').innerHTML =
            '<div style="background:#fef0f0;border:1.5px solid #e74c3c;border-radius:12px;padding:14px 18px;color:#cc0000;margin-bottom:16px;">' +
            '<i class="fa fa-exclamation-circle"></i> Terjadi kesalahan. Coba lagi.' +
            '</div>';
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-lock"></i><span>Buat Pesanan</span><i class="fa fa-long-arrow-right" style="margin-left:auto;opacity:0.8;"></i>';
    });
});

// Highlight payment option saat dipilih
document.querySelectorAll('input[name="payment"]').forEach(function(r) {
    r.addEventListener('change', function() {
        document.querySelectorAll('label[id^="pay-"]').forEach(function(l) {
            l.style.borderColor = '#e0e0e0';
            l.style.background  = '';
        });
        var lbl = this.closest('label');
        if (lbl && lbl.id) {
            lbl.style.borderColor = '#0071e3';
            lbl.style.background  = '#f0f7ff';
        }
    });
});
</script>

<?php include "footer.php"; ?>
