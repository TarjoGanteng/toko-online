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
     PRODUCT SECTION — WITH CATEGORY FILTER
============================================================ -->
<section id="new-arrivals" class="section" style="background:var(--bg-primary);">
    <div class="container">

        <div class="section-title fade-in">
            <span class="eyebrow">Koleksi Kami</span>
            <h2 class="title">Produk Pilihan</h2>
            <p class="subtitle">Dari elektronik canggih hingga fashion terkini — semuanya ada di sini</p>
        </div>

        <!-- Loading state -->
        <div id="product_msg"></div>

        <!-- Product Grid -->
        <div class="product-grid" id="get_product_home">
            <!-- Skeleton loading cards -->
            <?php for($i = 0; $i < 6; $i++): ?>
            <div class="product-card" style="animation: pulse 1.5s infinite; opacity:0.5;">
                <div class="card-img" style="min-height:220px; background:#e8e8ed;"></div>
                <div class="card-body">
                    <div style="height:12px; background:#e8e8ed; border-radius:6px; margin-bottom:8px; width:40%;"></div>
                    <div style="height:18px; background:#e8e8ed; border-radius:6px; margin-bottom:8px; width:80%;"></div>
                    <div style="height:14px; background:#e8e8ed; border-radius:6px; margin-bottom:16px; width:60%;"></div>
                    <div style="height:38px; background:#e8e8ed; border-radius:20px;"></div>
                </div>
            </div>
            <?php endfor; ?>
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
