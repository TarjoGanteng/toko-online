<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include "db.php";
if (!isset($_SESSION["uid"])) {
    include "header.php";
    echo '
    <div style="min-height:60vh; display:flex; align-items:center; justify-content:center; padding:60px 20px; text-align:center; background:#f5f5f7;">
        <div style="background:#fff; border-radius:20px; padding:48px 36px; max-width:440px; box-shadow:0 4px 24px rgba(0,0,0,0.06); width:100%;">
            <i class="fa fa-list-alt" style="font-size:56px; color:#0071e3; margin-bottom:16px; display:inline-block;"></i>
            <h2 style="font-size:22px; font-weight:800; color:#1d1d1f; margin-bottom:8px; letter-spacing:-0.02em;">Pesanan Saya</h2>
            <p style="color:#86868b; font-size:14px; line-height:1.5; margin-bottom:28px;">Silakan login terlebih dahulu untuk melihat riwayat pesanan dan status pengiriman produk Anda.</p>
            <a href="#" data-toggle="modal" data-target="#Modal_login" style="display:inline-flex; align-items:center; gap:8px; padding:12px 28px; background:#0071e3; color:#fff; border-radius:980px; text-decoration:none; font-size:14px; font-weight:600; box-shadow:0 4px 14px rgba(0,113,227,0.35);">
                <i class="fa fa-sign-in"></i> Masuk Sekarang
            </a>
        </div>
    </div>';
    include "footer.php";
    exit();
}

$uid = (int)$_SESSION["uid"];
$orders = [];
$res = mysqli_query($con, "SELECT * FROM orders WHERE user_id=$uid ORDER BY created_at DESC");
while ($o = mysqli_fetch_assoc($res)) {
    $res_items = mysqli_query($con, "SELECT * FROM order_items WHERE order_id=" . (int)$o["order_id"]);
    $o["items"] = [];
    while ($it = mysqli_fetch_assoc($res_items)) $o["items"][] = $it;
    $orders[] = $o;
}

$status_label = ["pending"=>"Menunggu Konfirmasi","processing"=>"Sedang Diproses","shipped"=>"Dalam Pengiriman","delivered"=>"Pesanan Diterima","cancelled"=>"Dibatalkan"];
$status_color = ["pending"=>"#ff9500","processing"=>"#0071e3","shipped"=>"#5856d6","delivered"=>"#34c759","cancelled"=>"#e74c3c"];
$status_icon  = ["pending"=>"fa-clock-o","processing"=>"fa-cog","shipped"=>"fa-truck","delivered"=>"fa-check-circle","cancelled"=>"fa-times-circle"];

include "header.php";
?>
<style>
#navigation { display: none !important; }
.ord-page { background:#f5f5f7; min-height:80vh; padding:44px 0 80px; }
.ord-title { font-size:26px; font-weight:800; letter-spacing:-0.04em; color:#1d1d1f; margin-bottom:28px; display:flex; align-items:center; gap:10px; }
.ord-title i { color:#0071e3; }
.ord-breadcrumb { display:flex; align-items:center; gap:8px; font-size:13px; color:#86868b; margin-bottom:22px; }
.ord-breadcrumb a { color:#0071e3; text-decoration:none; }

/* Steps tracker */
.ord-steps { display:flex; align-items:center; margin-bottom:6px; }
.ord-step { display:flex; flex-direction:column; align-items:center; flex:1; }
.ord-step-dot { width:28px; height:28px; border-radius:50%; border:2px solid #e0e0e0; background:#fff; display:flex; align-items:center; justify-content:center; font-size:11px; color:#86868b; flex-shrink:0; transition:all .3s; }
.ord-step.done .ord-step-dot { background:#34c759; border-color:#34c759; color:#fff; }
.ord-step.active .ord-step-dot { background:#0071e3; border-color:#0071e3; color:#fff; }
.ord-step-label { font-size:10px; color:#86868b; margin-top:4px; text-align:center; white-space:nowrap; }
.ord-step.done .ord-step-label, .ord-step.active .ord-step-label { color:#1d1d1f; font-weight:600; }
.ord-step-line { flex:1; height:2px; background:#e0e0e0; }
.ord-step-line.done { background:#34c759; }

/* Order card */
.ord-card { background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,0.06); overflow:hidden; margin-bottom:20px; }
.ord-card-hdr { padding:16px 22px; border-bottom:1px solid #f0f0f0; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; }
.ord-id { font-size:15px; font-weight:800; color:#1d1d1f; }
.ord-date { font-size:12px; color:#86868b; }
.ord-badge { display:inline-flex; align-items:center; gap:6px; padding:5px 12px; border-radius:980px; font-size:12px; font-weight:700; }
.ord-body { padding:18px 22px; }
.ord-item { display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid #f5f5f5; }
.ord-item:last-child { border-bottom:none; }
.ord-item img { width:50px; height:50px; object-fit:cover; border-radius:8px; border:1px solid #f0f0f0; background:#fafafa; flex-shrink:0; }
.ord-item-name { flex:1; font-size:13px; font-weight:600; color:#1d1d1f; }
.ord-item-qty { font-size:12px; color:#86868b; margin-top:2px; }
.ord-item-price { font-size:13px; font-weight:700; color:#1d1d1f; }
.ord-footer { padding:14px 22px; background:#fafafa; border-top:1px solid #f0f0f0; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; }
.ord-total { font-size:15px; font-weight:800; color:#0071e3; }
.ord-pay { font-size:12px; color:#86868b; }
.ord-actions { display:flex; gap:8px; }
.btn-detail { padding:7px 16px; border-radius:980px; background:#f0f0f0; color:#1d1d1f; font-size:12px; font-weight:600; border:none; cursor:pointer; text-decoration:none; }
.btn-detail:hover { background:#e0e0e0; color:#1d1d1f; text-decoration:none; }

/* Empty state */
.ord-empty { text-align:center; padding:80px 40px; }
.ord-empty i { font-size:64px; color:#d0d0d0; display:block; margin-bottom:16px; }
.ord-empty h3 { font-size:20px; font-weight:700; color:#1d1d1f; margin-bottom:8px; }
.ord-empty p { font-size:14px; color:#86868b; margin-bottom:24px; }
.btn-shop { display:inline-flex; align-items:center; gap:8px; padding:12px 24px; border-radius:980px; background:#0071e3; color:#fff; font-size:14px; font-weight:600; text-decoration:none; transition:background .2s; }
.btn-shop:hover { background:#0052a5; color:#fff; text-decoration:none; }
</style>

<div class="ord-page">
<div class="container">

    <div class="ord-breadcrumb">
        <a href="index.php"><i class="fa fa-home"></i> Beranda</a>
        <i class="fa fa-angle-right"></i>
        <span>Pesanan Saya</span>
    </div>

    <h1 class="ord-title"><i class="fa fa-list-alt"></i> Pesanan Saya</h1>

    <?php if (empty($orders)): ?>
    <div class="ord-card">
        <div class="ord-empty">
            <i class="fa fa-shopping-bag"></i>
            <h3>Belum Ada Pesanan</h3>
            <p>Anda belum pernah melakukan pembelian. Yuk mulai belanja!</p>
            <a href="index.php" class="btn-shop"><i class="fa fa-shopping-cart"></i> Mulai Belanja</a>
        </div>
    </div>
    <?php else: ?>

    <?php foreach ($orders as $ord): ?>
    <?php
        $st    = $ord["status"];
        $color = $status_color[$st] ?? "#86868b";
        $label = $status_label[$st] ?? $st;
        $icon  = $status_icon[$st]  ?? "fa-circle";
        $steps = ["pending","processing","shipped","delivered"];
        $cur   = array_search($st, $steps);
    ?>
    <div class="ord-card">
        <!-- Header -->
        <div class="ord-card-hdr">
            <div>
                <div class="ord-id">Order #<?= $ord["order_id"] ?></div>
                <div class="ord-date"><i class="fa fa-calendar-o"></i> <?= date("d M Y, H:i", strtotime($ord["created_at"])) ?></div>
            </div>
            <span class="ord-badge" style="background:<?= $color ?>22; color:<?= $color ?>;">
                <i class="fa <?= $icon ?>"></i> <?= $label ?>
            </span>
        </div>

        <!-- Status Tracker (hanya jika bukan cancelled) -->
        <?php if ($st !== "cancelled"): ?>
        <div style="padding:16px 22px; border-bottom:1px solid #f0f0f0;">
            <div style="display:flex; align-items:center;">
                <?php foreach ($steps as $i => $s): ?>
                <?php
                    $step_class = "ord-step";
                    if ($i < $cur) $step_class .= " done";
                    elseif ($i == $cur) $step_class .= " active";
                    $s_label = ["pending"=>"Menunggu","processing"=>"Diproses","shipped"=>"Dikirim","delivered"=>"Diterima"][$s];
                    $s_icon  = ["pending"=>"fa-clock-o","processing"=>"fa-cog fa-spin","shipped"=>"fa-truck","delivered"=>"fa-check"][$s];
                ?>
                <?php if ($i > 0): ?>
                <div class="ord-step-line <?= ($i <= $cur) ? 'done' : '' ?>"></div>
                <?php endif; ?>
                <div class="<?= $step_class ?>">
                    <div class="ord-step-dot">
                        <i class="fa <?= ($i < $cur) ? 'fa-check' : $s_icon ?>"></i>
                    </div>
                    <div class="ord-step-label"><?= $s_label ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Item List -->
        <div class="ord-body">
            <?php foreach ($ord["items"] as $it): ?>
            <?php
                $img = "img/no-image.png";
                $p   = mysqli_fetch_assoc(mysqli_query($con, "SELECT product_image FROM product WHERE product_id=" . (int)$it["product_id"]));
                if ($p && !empty($p["product_image"])) $img = "img/" . htmlspecialchars($p["product_image"]);
            ?>
            <div class="ord-item">
                <img src="<?= $img ?>" alt="<?= htmlspecialchars($it["product_title"]) ?>" onerror="this.src='"'"'img/no-image.png'"'"'">
                <div>
                    <div class="ord-item-name"><?= htmlspecialchars($it["product_title"]) ?></div>
                    <div class="ord-item-qty"><?= $it["qty"] ?>x &times; Rp <?= number_format($it["product_price"],0,",",".") ?></div>
                </div>
                <div class="ord-item-price">Rp <?= number_format($it["subtotal"],0,",",".") ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Footer -->
        <div class="ord-footer">
            <div>
                <div class="ord-total">Total: Rp <?= number_format($ord["total_amount"],0,",",".") ?></div>
                <div class="ord-pay">
                    <?php
                    $pm = ["transfer"=>"Transfer Bank","ewallet"=>"E-Wallet","cod"=>"COD"];
                    echo $pm[$ord["payment_method"]] ?? $ord["payment_method"];
                    ?> &bull; <?= count($ord["items"]) ?> produk
                </div>
            </div>
            <div class="ord-actions">
                <?php if (!in_array($ord["status"], ["delivered","cancelled"])): ?>
                <button type="button" onclick="confirmSingle(<?= (int)$ord['order_id'] ?>)" class="btn-detail" style="background:#34c759; color:#fff; display:inline-flex; align-items:center; gap:5px;" title="Konfirmasi barang sudah sampai">
                    <i class="fa fa-check"></i> Pesanan Diterima
                </button>
                <?php endif; ?>
                <a href="index.php" class="btn-detail"><i class="fa fa-shopping-bag"></i> Beli Lagi</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php endif; ?>

</div>
</div>

<script>
function confirmSingle(oid) {
    if (!confirm('Konfirmasi pesanan #' + oid + ' telah Anda terima?')) return;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_order_status.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        location.reload();
    };
    xhr.send('order_id=' + oid + '&status=delivered');
}
</script>

<?php
// Kumpulkan order yang masih aktif (bukan delivered/cancelled) untuk simulasi otomatis 30 detik
$active_orders = [];
foreach ($orders as $o) {
    if (!in_array($o['status'], ['delivered','cancelled'])) {
        $active_orders[] = (int)$o['order_id'];
    }
}
?>

<?php if (!empty($active_orders)): ?>
<script>
var activeOrders = <?= json_encode($active_orders) ?>;

// Toast notifikasi progres pesanan
var notif = document.createElement('div');
notif.style.cssText = 'position:fixed;bottom:24px;right:24px;background:#1d1d1f;color:#fff;padding:16px 20px;border-radius:16px;font-size:13px;font-weight:600;box-shadow:0 6px 28px rgba(0,0,0,0.35);z-index:9999;min-width:260px;transition:all .3s;';
document.body.appendChild(notif);

var secs = 30;
function updateToast() {
    var pct = Math.round(((30 - secs) / 30) * 100);
    var stage = secs > 20 ? 'Pesanan diproses penjual...' : (secs > 10 ? 'Sedang dikirim kurir...' : 'Pesanan hampir sampai...');
    var icon  = secs > 20 ? 'fa-cog fa-spin' : (secs > 10 ? 'fa-truck' : 'fa-map-marker');
    notif.innerHTML =
        '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">' +
            '<div style="display:flex;align-items:center;gap:8px;">' +
                '<i class="fa ' + icon + '" style="font-size:16px;color:#0071e3;"></i>' +
                '<span style="font-size:13px;">' + stage + '</span>' +
            '</div>' +
            '<span style="font-size:11px;opacity:0.6;font-weight:700;">' + secs + 's</span>' +
        '</div>' +
        '<div style="background:rgba(255,255,255,0.15);border-radius:6px;overflow:hidden;height:5px;margin-bottom:10px;">' +
            '<div style="height:5px;background:linear-gradient(90deg,#0071e3,#34c759);border-radius:6px;width:' + pct + '%;transition:width 1s;"></div>' +
        '</div>' +
        '<div style="display:flex;align-items:center;justify-content:space-between;">' +
            '<span style="font-size:11px;opacity:0.6;">Simulasi status (30 detik)</span>' +
            '<button type="button" onclick="finishAllOrders()" style="background:#34c759;border:none;color:#fff;font-size:11px;font-weight:700;padding:4px 10px;border-radius:980px;cursor:pointer;">Terima Sekarang</button>' +
        '</div>';
}
updateToast();

function finishAllOrders() {
    clearInterval(timer);
    notif.style.background = '#0071e3';
    notif.innerHTML = '<div style="display:flex;align-items:center;gap:8px;"><i class="fa fa-spinner fa-spin"></i><span>Memperbarui status pesanan...</span></div>';
    var done = 0;
    activeOrders.forEach(function(oid) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_order_status.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            done++;
            if (done >= activeOrders.length) {
                notif.style.background = '#34c759';
                notif.innerHTML = '<div style="display:flex;align-items:center;gap:8px;"><i class="fa fa-check-circle" style="font-size:18px;"></i><span>Semua pesanan telah diterima! 🎉</span></div>';
                setTimeout(function() { location.reload(); }, 1200);
            }
        };
        xhr.send('order_id=' + oid + '&status=delivered');
    });
}

function updateStage(status) {
    activeOrders.forEach(function(oid) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_order_status.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('order_id=' + oid + '&status=' + status);
    });
}

var timer = setInterval(function() {
    secs--;
    if (secs === 20) {
        updateStage('processing');
    } else if (secs === 10) {
        updateStage('shipped');
    }

    if (secs <= 0) {
        finishAllOrders();
    } else {
        updateToast();
    }
}, 1000);
</script>
<?php endif; ?>

<?php include "footer.php"; ?>
