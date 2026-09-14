<?php
session_start();
include "db.php";

// ============================================================
//  CATEGORY HOME — Navigasi kategori di nav bar
// ============================================================
if (isset($_POST['categoryhome'])) {
    $sql    = "SELECT * FROM category";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<ul class="nav navbar-nav" style="display:flex; flex-direction:row; padding:8px 0; gap:4px; list-style:none;">';
        echo '<li><a href="#" class="filter-btn active categoryhome" cid="0" style="padding:6px 16px; border-radius:980px; font-size:13px; font-weight:500; color:#86868b; transition:all .3s; text-decoration:none;">Semua</a></li>';
        while ($row = mysqli_fetch_assoc($result)) {
            $name = !empty($row['cat_name']) ? $row['cat_name'] : ($row['cat_title'] ?? '');
            echo '<li>
                    <a href="#" class="filter-btn categoryhome" cid="' . $row['cat_id'] . '" style="padding:6px 16px; border-radius:980px; font-size:13px; font-weight:500; color:#86868b; transition:all .3s; text-decoration:none; white-space:nowrap;">
                        ' . htmlspecialchars($name) . '
                    </a>
                  </li>';
        }
        echo '</ul>';
    }
}

// ============================================================
//  GET HOME PRODUCTS — Produk unggulan
// ============================================================
if (isset($_POST['gethomeProduct'])) {
    $sql    = "SELECT p.*, c.cat_title, c.cat_name
               FROM product p
               LEFT JOIN category c ON p.product_cat = c.cat_id
               LIMIT 6";
    $result = mysqli_query($con, $sql);
    renderAppleCards($result);
}

// ============================================================
//  GET PRODUCT HOME — Produk terbaru
// ============================================================
if (isset($_POST['getProducthome'])) {
    $sql    = "SELECT p.*, c.cat_title, c.cat_name
               FROM product p
               LEFT JOIN category c ON p.product_cat = c.cat_id
               ORDER BY p.product_id DESC LIMIT 9";
    $result = mysqli_query($con, $sql);
    renderAppleCards($result);
}

// ============================================================
//  GET PRODUCTS BY CATEGORY
// ============================================================
if (isset($_POST['get_seleted_Category'])) {
    $cat_id = (int)$_POST['cat_id'];
    if ($cat_id === 0) {
        $sql = "SELECT p.*, c.cat_title, c.cat_name
                FROM product p
                LEFT JOIN category c ON p.product_cat = c.cat_id
                ORDER BY p.product_id DESC LIMIT 9";
    } else {
        $sql = "SELECT p.*, c.cat_title, c.cat_name
                FROM product p
                LEFT JOIN category c ON p.product_cat = c.cat_id
                WHERE p.product_cat = '$cat_id' LIMIT 9";
    }
    $result = mysqli_query($con, $sql);
    renderAppleCards($result);
}

// ============================================================
//  HELPER: Render Apple-Style Product Cards
// ============================================================
function renderAppleCards($result) {
    // Badge logic based on product_id
    $badges = ['Baru', 'Populer', 'Best Seller'];

    if ($result && mysqli_num_rows($result) > 0) {
        $index = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            // Image
            $img_field = !empty($row['product_image']) ? $row['product_image'] : ($row['pro_img'] ?? 'no-image.png');
            $img       = !empty($img_field) && $img_field !== 'no-image.png'
                         ? 'img/' . htmlspecialchars($img_field)
                         : 'img/no-image.png';

            // Product info
            $pro_id    = $row['product_id'] ?? $row['pro_id'] ?? 0;
            $title     = $row['product_title'] ?? $row['pro_name'] ?? '';
            $price     = $row['product_price'] ?? $row['pro_price'] ?? 0;
            $desc      = $row['product_desc']  ?? '';
            $cat_name  = !empty($row['cat_name']) ? $row['cat_name'] : ($row['cat_title'] ?? 'Produk');

            // Badge assignment
            $badge_html = '';
            if ($index < 3) {
                $badge_class = $index === 0 ? 'badge-new' : ($index === 1 ? 'badge-hot' : 'badge-sale');
                $badge_label = $badges[$index];
                $badge_html  = '<span class="badge-tag ' . $badge_class . '">' . $badge_label . '</span>';
            }

            // Price format
            $price_formatted = 'Rp ' . number_format($price, 0, ',', '.');

            // Short desc
            $short_desc = !empty($desc) ? mb_substr($desc, 0, 80) . '...' : '';

            echo '
            <div class="product-card fade-in" style="transition-delay:' . ($index * 0.08) . 's;">
                ' . $badge_html . '
                <div class="card-img">
                    <img src="' . $img . '"
                         alt="' . htmlspecialchars($title) . '"
                         onerror="this.onerror=null;this.src=\'img/no-image.png\'">
                </div>
                <div class="card-body">
                    <p class="card-category">' . htmlspecialchars($cat_name) . '</p>
                    <h3 class="card-title">' . htmlspecialchars($title) . '</h3>';

            if ($short_desc) {
                echo '<p class="card-desc">' . htmlspecialchars($short_desc) . '</p>';
            }

            echo '
                    <div class="card-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
                    <div class="card-price">
                        <span>Mulai dari</span>' . $price_formatted . '
                    </div>
                    <div class="card-actions">
                        <button class="btn-add-cart add-to-cart-btn" id="product" pid="' . $pro_id . '">
                            <i class="fa fa-shopping-cart"></i> Tambah
                        </button>
                        <a href="#" class="btn-detail">Detail ›</a>
                    </div>
                </div>
            </div>';

            $index++;
        }
    } else {
        echo '<div class="empty-state" style="grid-column:1/-1;">
                <i class="fa fa-box-open"></i>
                <p>Belum ada produk tersedia.</p>
              </div>';
    }
}
?>
