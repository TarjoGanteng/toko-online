<?php include "db.php"; ?>

<!-- ============================================================
     HERO SECTION
============================================================ -->
<section id="home-slider" style="padding: 80px 0 100px;">
    <div class="hero-content">
        <h1 class="hero-title fade-in">
            Belanja Lebih<br><span>Cerdas</span>, Lebih Hemat
        </h1>
        <p class="hero-subtitle fade-in fade-in-delay-1">
            Temukan ribuan produk terbaik — dari elektronik premium hingga fashion terkini,
            semua dengan harga terjangkau dan pengiriman cepat.
        </p>
        <div class="hero-actions fade-in fade-in-delay-2">
            <a href="#new-arrivals" class="btn-primary"
               onclick="event.preventDefault(); document.getElementById('new-arrivals').scrollIntoView({behavior:'smooth', block:'start'});">
                <i class="fa fa-shopping-bag"></i> Belanja Sekarang
            </a>
            <a href="#why-shop" class="btn-secondary"
               onclick="event.preventDefault(); document.getElementById('why-shop').scrollIntoView({behavior:'smooth', block:'start'});">
                Pelajari Lebih Lanjut
            </a>
        </div>

        <!-- Hero Stats -->
        <div style="display:flex; gap:40px; justify-content:center; margin-top:56px; border-top:1px solid rgba(255,255,255,0.1); padding-top:40px;" class="fade-in fade-in-delay-3">
            <div style="text-align:center;">
                <div style="font-size:28px; font-weight:700; color:#fff; letter-spacing:-0.02em;">500+</div>
                <div style="font-size:13px; color:rgba(255,255,255,0.5); margin-top:4px;">Produk</div>
            </div>
            <div style="width:1px; background:rgba(255,255,255,0.1);"></div>
            <div style="text-align:center;">
                <div style="font-size:28px; font-weight:700; color:#fff; letter-spacing:-0.02em;">10K+</div>
                <div style="font-size:13px; color:rgba(255,255,255,0.5); margin-top:4px;">Pelanggan</div>
            </div>
            <div style="width:1px; background:rgba(255,255,255,0.1);"></div>
            <div style="text-align:center;">
                <div style="font-size:28px; font-weight:700; color:#fff; letter-spacing:-0.02em;">4.9★</div>
                <div style="font-size:13px; color:rgba(255,255,255,0.5); margin-top:4px;">Rating</div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     PRODUCT SECTION — STACKED CATEGORY CARDS
============================================================ -->
<section id="new-arrivals" class="section" style="background:var(--bg-primary);">
    <div class="container">

        <div class="section-title fade-in">
            <span class="eyebrow">Koleksi Kami</span>
            <h2 class="title">Produk Pilihan</h2>
            <p class="subtitle">Pilih kategori favorit Anda, atau jelajahi semua produk kami</p>
        </div>

        <!-- ============ STACKED CATEGORY CARDS (default view) ============ -->
        <div id="stacked-view" class="stacked-categories">
            <?php
            $stack_cats = [
                ['id'=>1, 'name'=>'Elektronik',  'icon'=>'fa-laptop',        'accent'=>'#0071e3', 'grad'=>'linear-gradient(135deg,#0a1f44,#0071e3)', 'light'=>'#deeeff'],
                ['id'=>2, 'name'=>'Ladies Wear', 'icon'=>'fa-star',          'accent'=>'#d63384', 'grad'=>'linear-gradient(135deg,#6f1d3e,#d63384)', 'light'=>'#ffe0ef'],
                ['id'=>3, 'name'=>'Mens Wear',   'icon'=>'fa-shield',        'accent'=>'#5856d6', 'grad'=>'linear-gradient(135deg,#1a1355,#5856d6)', 'light'=>'#e8e6ff'],
            ];
            foreach ($stack_cats as $cat):
                // Top product
                $sql_p = "SELECT * FROM product WHERE product_cat={$cat['id']} ORDER BY product_id DESC LIMIT 1";
                $res_p = mysqli_query($con, $sql_p);
                $p     = $res_p ? mysqli_fetch_assoc($res_p) : null;

                // Count
                $res_c = mysqli_query($con, "SELECT COUNT(*) AS c FROM product WHERE product_cat={$cat['id']}");
                $cnt   = $res_c ? (int)mysqli_fetch_assoc($res_c)['c'] : 0;

                $img   = 'img/no-image.png';
                $title = 'Produk Terbaik';
                $price = 0;
                if ($p) {
                    $img_f = $p['product_image'] ?? 'no-image.png';
                    if (!empty($img_f) && $img_f !== 'no-image.png') $img = 'img/' . htmlspecialchars($img_f);
                    $title = htmlspecialchars($p['product_title'] ?? 'Produk');
                    $price = (int)($p['product_price'] ?? 0);
                }
            ?>
            <div class="stack-group fade-in" data-cat="<?= $cat['id'] ?>">
                <div class="stack-wrapper">

                    <!-- Back cards (visual depth) -->
                    <div class="stack-card stack-card-back-2" style="background:<?= $cat['light'] ?>;"></div>
                    <div class="stack-card stack-card-back-1" style="background:<?= $cat['light'] ?>;"></div>

                    <!-- Front card (main) -->
                    <div class="stack-card stack-card-front">

                        <!-- Gradient header -->
                        <div class="stack-header" style="background:<?= $cat['grad'] ?>;">
                            <div class="stack-header-icon">
                                <i class="fa <?= $cat['icon'] ?>"></i>
                            </div>
                            <div class="stack-header-info">
                                <span class="stack-cat-name"><?= htmlspecialchars($cat['name']) ?></span>
                                <span class="stack-cat-count"><?= $cnt ?> Produk</span>
                            </div>
                        </div>

                        <!-- Product image -->
                        <div class="stack-img-wrap">
                            <img src="<?= $img ?>" alt="<?= $title ?>" onerror="this.src='img/no-image.png'">
                        </div>

                        <!-- Product info -->
                        <div class="stack-body">
                            <p class="stack-label">Produk Terpopuler</p>
                            <h3 class="stack-title"><?= $title ?></h3>
                            <?php if ($price > 0): ?>
                            <p class="stack-price" style="color:<?= $cat['accent'] ?>;">
                                Rp <?= number_format($price, 0, ',', '.') ?>
                            </p>
                            <?php endif; ?>
                        </div>

                        <!-- CTA — revealed on hover -->
                        <div class="stack-cta">
                            <button class="stack-btn" style="background:<?= $cat['accent'] ?>;"
                                onclick="loadCategoryStack(<?= $cat['id'] ?>, '<?= addslashes($cat['name']) ?>')">
                                Lihat Semua <?= htmlspecialchars($cat['name']) ?>
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>

                    </div><!-- end front card -->
                </div><!-- end wrapper -->
            </div><!-- end stack-group -->
            <?php endforeach; ?>
        </div><!-- end stacked-view -->

        <!-- ============ PRODUCT GRID VIEW (shown after category clicked) ============ -->
        <div id="product-grid-view" style="display:none;">

            <!-- Grid header -->
            <div class="grid-view-header">
                <div>
                    <span class="eyebrow">Menampilkan</span>
                    <h3 id="grid-cat-title" style="font-size:22px; font-weight:700; margin:4px 0 0; letter-spacing:-0.02em;"></h3>
                </div>
                <button class="btn-outline" onclick="showStackedView()" style="display:inline-flex; gap:8px;">
                    <i class="fa fa-th-large"></i> Semua Kategori
                </button>
            </div>

            <!-- Products loaded via AJAX -->
            <div class="product-grid" id="get_product_home"></div>

        </div><!-- end product-grid-view -->

    </div>
</section>

<!-- ============================================================
     FEATURED / HIGHLIGHT SECTION (Dark)
============================================================ -->
<section id="featured-section">
    <div class="container">
        <div class="section-title fade-in">
            <h2 class="title" style="color:#fff;">Kategori Unggulan</h2>
            <p class="subtitle" style="color:rgba(255,255,255,0.5);">Jelajahi berbagai kategori produk pilihan kami</p>
        </div>

        <div class="featured-grid">
            <div class="featured-card fade-in fade-in-delay-1">
                <div class="icon">
                    <i class="fa fa-mobile fa-2x" style="color:#64d2ff;"></i>
                </div>
                <h3>Elektronik</h3>
                <p>Smartphone, laptop, TV, headphone, dan gadget terbaru dari brand ternama dunia.</p>
                <a href="#new-arrivals" class="btn-outline" style="color:#64d2ff; margin-top:20px; display:inline-flex;"
                   onclick="event.preventDefault(); filterProductsByCategory(1);">
                    Lihat Produk
                </a>
            </div>

            <div class="featured-card fade-in fade-in-delay-2">
                <div class="icon">
                    <i class="fa fa-shopping-bag fa-2x" style="color:#64d2ff;"></i>
                </div>
                <h3>Fashion</h3>
                <p>Koleksi pakaian pria dan wanita dari brand internasional Zara, H&M, Uniqlo, dan lainnya.</p>
                <a href="#new-arrivals" class="btn-outline" style="color:#64d2ff; margin-top:20px; display:inline-flex;"
                   onclick="event.preventDefault(); filterProductsByCategory(2);">
                    Lihat Produk
                </a>
            </div>

            <div class="featured-card fade-in fade-in-delay-3">
                <div class="icon">
                    <i class="fa fa-futbol-o fa-2x" style="color:#64d2ff;"></i>
                </div>
                <h3>Olahraga</h3>
                <p>Sepatu, pakaian, dan perlengkapan olahraga Nike, Adidas untuk performa terbaik Anda.</p>
                <a href="#new-arrivals" class="btn-outline" style="color:#64d2ff; margin-top:20px; display:inline-flex;"
                   onclick="event.preventDefault(); filterProductsByCategory(4);">
                    Lihat Produk
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     WHY SHOP HERE SECTION
============================================================ -->
<section id="why-shop">
    <div class="container">
        <div class="section-title fade-in">
            <span class="eyebrow">Keunggulan Kami</span>
            <h2 class="title">Kenapa Belanja di Sini?</h2>
            <p class="subtitle">Kami berkomitmen memberikan pengalaman belanja terbaik untuk Anda</p>
        </div>

        <div class="why-grid">
            <div class="why-card fade-in fade-in-delay-1">
                <div class="icon">
                    <i class="fa fa-tag"></i>
                </div>
                <h3>Harga Terjangkau</h3>
                <p>Dapatkan harga terbaik dengan kualitas premium. Kami selalu update harga kompetitif setiap hari.</p>
            </div>

            <div class="why-card fade-in fade-in-delay-2">
                <div class="icon">
                    <i class="fa fa-truck"></i>
                </div>
                <h3>Pengiriman Cepat</h3>
                <p>Dikirim dalam 1–3 hari kerja ke seluruh Indonesia. Free ongkir untuk pembelian di atas Rp 200.000.</p>
            </div>

            <div class="why-card fade-in fade-in-delay-3">
                <div class="icon">
                    <i class="fa fa-shield"></i>
                </div>
                <h3>Garansi Resmi</h3>
                <p>Semua produk elektronik bergaransi resmi. Belanja aman dan nyaman tanpa khawatir.</p>
            </div>

            <div class="why-card fade-in fade-in-delay-4">
                <div class="icon">
                    <i class="fa fa-headphones"></i>
                </div>
                <h3>Layanan 24/7</h3>
                <p>Tim customer service kami siap membantu Anda kapan saja via chat, email, maupun telepon.</p>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     SCROLL TO TOP BUTTON
============================================================ -->
<a href="#" id="scroll-top" onclick="event.preventDefault(); window.scrollTo({top:0, behavior:'smooth'});">
    <i class="fa fa-chevron-up"></i>
</a>

<!-- Loading Overlay -->
<div class="overlay" style="display:none;">
    <i class="fa fa-spinner fa-spin"></i>
    <p>Memuat...</p>
</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 0.8; }
}
</style>
