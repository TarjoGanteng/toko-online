<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!-- ============================================================
     NEWSLETTER STRIP — FULL WIDTH
============================================================ -->
<section id="newsletter-strip">
    <div class="container">
        <h2>Dapatkan Penawaran Terbaik!</h2>
        <p>Daftarkan email Anda dan dapatkan diskon 10% untuk pembelian pertama</p>
        <form class="newsletter-form" onsubmit="return submitNewsletter(event);">
            <input type="email" id="newsletter-email" placeholder="Masukkan email Anda..." required>
            <button type="submit">
                <i class="fa fa-paper-plane"></i> Subscribe
            </button>
        </form>
    </div>
</section>

<!-- ============================================================
     FOOTER — APPLE MINIMAL STYLE
============================================================ -->
<footer id="footer">
    <div class="container">
        <div class="footer-grid">

            <!-- Brand -->
            <div class="footer-brand">
                <div class="logo-wrap" style="display:flex; align-items:center; gap:8px; margin-bottom:16px;">
                    <svg width="30" height="30" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="footerLogoGrad" x1="0" y1="0" x2="38" y2="38" gradientUnits="userSpaceOnUse">
                                <stop offset="0%"   stop-color="#0a1f44"/>
                                <stop offset="100%" stop-color="#0071e3"/>
                            </linearGradient>
                        </defs>
                        <rect width="38" height="38" rx="10" fill="url(#footerLogoGrad)"/>
                        <path d="M10.5 17h17l-2 11H12.5L10.5 17z" fill="white" fill-opacity="0.95"/>
                        <rect x="9.5" y="15.5" width="19" height="2.5" rx="1.25" fill="white" fill-opacity="0.7"/>
                        <path d="M15 15.5 C15 11.5, 23 11.5, 23 15.5" stroke="white" stroke-width="2" stroke-linecap="round" fill="none"/>
                        <circle cx="19" cy="22.5" r="2" fill="#FFD60A" fill-opacity="0.9"/>
                    </svg>
                    <span style="font-size:17px; font-weight:800; letter-spacing:-0.03em; background:linear-gradient(135deg,#0a1f44,#0071e3); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">Online<span style="background:linear-gradient(135deg,#0071e3,#34aadc); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">Shop</span></span>
                </div>
                <p>
                    Platform belanja online terpercaya dengan ribuan produk pilihan.
                    Belanja mudah, aman, dan menyenangkan setiap hari.
                </p>
                <div class="footer-social">
                    <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" title="Instagram"><i class="fa fa-instagram"></i></a>
                    <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" title="YouTube"><i class="fa fa-youtube-play"></i></a>
                </div>
                <div class="payment-icons" style="margin-top:16px;">
                    <i class="fa fa-cc-visa"></i>
                    <i class="fa fa-cc-mastercard"></i>
                    <i class="fa fa-cc-paypal"></i>
                    <i class="fa fa-money"></i>
                </div>
            </div>

            <!-- Informasi -->
            <div class="footer-col">
                <h4>Informasi</h4>
                <ul>
                    <li><a href="about.php">Tentang Kami</a></li>
                    <li><a href="blog.php">Berita &amp; Blog</a></li>
                    <li><a href="privacy.php">Kebijakan Privasi</a></li>
                    <li><a href="terms.php">Syarat &amp; Ketentuan</a></li>
                </ul>
            </div>

            <!-- Layanan -->
            <div class="footer-col">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#" onclick="openModal('modal-cara-belanja'); return false;">Cara Belanja</a></li>
                    <li><a href="orders.php">Pesanan Saya</a></li>
                    <li><a href="#" onclick="openModal('modal-faq'); return false;">FAQ</a></li>
                    <li><a href="cart.php">Keranjang Belanja</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="footer-col">
                <h4>Hubungi Kami</h4>
                <ul class="footer-contact">
                    <li>
                        <i class="fa fa-map-marker"></i>
                        <span>Jl. Colombo No.1, Sleman, Yogyakarta 55281</span>
                    </li>
                    <li>
                        <i class="fa fa-phone"></i>
                        <span>(0274) 000-0000</span>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i>
                        <span>info@onlineshop.com</span>
                    </li>
                    <li>
                        <i class="fa fa-clock-o"></i>
                        <span>Sen–Sab, 08.00–20.00 WIB</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>

<!-- Bottom Footer -->
<div id="bottom-footer">
    <div class="container">
        <p>
            &copy; <?php echo date('Y'); ?> <strong>Online Shop</strong> &mdash;
            Tugas Praktik Manajemen Sistem Informasi &nbsp;|&nbsp; Universitas Negeri Yogyakarta
        </p>
        <div class="footer-legal">
            <a href="privacy.php">Privasi</a>
            <a href="terms.php">Ketentuan</a>
            <a href="about.php">Tentang Kami</a>
        </div>
    </div>
</div>

<!-- ============================================================
     MODAL — CARA BELANJA
============================================================ -->
<div id="modal-cara-belanja" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);" onclick="if(event.target===this) closeModal('modal-cara-belanja')">
    <div style="background:#fff; border-radius:20px; max-width:540px; width:90%; margin:60px auto; padding:40px 36px; position:relative; max-height:85vh; overflow-y:auto;">
        <button onclick="closeModal('modal-cara-belanja')" style="position:absolute;top:16px;right:20px;background:none;border:none;font-size:22px;cursor:pointer;color:#86868b;">&times;</button>
        <h2 style="font-size:22px;font-weight:700;margin-bottom:8px;letter-spacing:-0.03em;">Cara Belanja</h2>
        <p style="color:#86868b;font-size:13px;margin-bottom:28px;">Mudah &amp; cepat dalam 4 langkah</p>
        <div style="display:flex;flex-direction:column;gap:20px;">
            <?php
            $steps = [
                ['icon'=>'fa-search',       'num'=>'1','title'=>'Cari Produk',      'desc'=>'Gunakan kolom pencarian atau pilih kategori untuk menemukan produk yang Anda inginkan.'],
                ['icon'=>'fa-shopping-cart','num'=>'2','title'=>'Tambah ke Keranjang','desc'=>'Klik tombol "Tambah ke Keranjang". Anda bisa menambahkan beberapa produk sekaligus.'],
                ['icon'=>'fa-user',         'num'=>'3','title'=>'Login & Checkout',  'desc'=>'Pastikan sudah login, buka halaman keranjang, lalu klik "Checkout" untuk melanjutkan.'],
                ['icon'=>'fa-check-circle', 'num'=>'4','title'=>'Pembayaran',        'desc'=>'Isi data pengiriman dan pilih metode pembayaran. Pesanan diproses setelah pembayaran dikonfirmasi.'],
            ];
            foreach ($steps as $s): ?>
            <div style="display:flex;gap:16px;align-items:flex-start;">
                <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#0a1f44,#0071e3);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa <?= $s['icon'] ?>" style="color:#fff;font-size:16px;"></i>
                </div>
                <div>
                    <p style="font-size:11px;color:#0071e3;font-weight:600;margin:0 0 2px;">LANGKAH <?= $s['num'] ?></p>
                    <h4 style="font-size:15px;font-weight:700;margin:0 0 4px;"><?= $s['title'] ?></h4>
                    <p style="font-size:13px;color:#86868b;margin:0;line-height:1.5;"><?= $s['desc'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <a href="index.php" onclick="closeModal('modal-cara-belanja')" style="display:block;text-align:center;margin-top:28px;padding:12px;background:linear-gradient(135deg,#0a1f44,#0071e3);color:#fff;border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;">
            <i class="fa fa-shopping-bag"></i> Mulai Belanja Sekarang
        </a>
    </div>
</div>

<!-- ============================================================
     MODAL — FAQ
============================================================ -->
<div id="modal-faq" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);" onclick="if(event.target===this) closeModal('modal-faq')">
    <div style="background:#fff; border-radius:20px; max-width:580px; width:90%; margin:60px auto; padding:40px 36px; position:relative; max-height:85vh; overflow-y:auto;">
        <button onclick="closeModal('modal-faq')" style="position:absolute;top:16px;right:20px;background:none;border:none;font-size:22px;cursor:pointer;color:#86868b;">&times;</button>
        <h2 style="font-size:22px;font-weight:700;margin-bottom:8px;letter-spacing:-0.03em;">FAQ</h2>
        <p style="color:#86868b;font-size:13px;margin-bottom:28px;">Pertanyaan yang sering ditanyakan</p>
        <div style="display:flex;flex-direction:column;gap:8px;">
            <?php
            $faqs = [
                ['q'=>'Apakah saya harus login untuk berbelanja?','a'=>'Ya, Anda perlu membuat akun dan login sebelum checkout. Namun Anda bisa melihat-lihat produk tanpa login.'],
                ['q'=>'Berapa lama waktu pengiriman?','a'=>'Biasanya 1–3 hari kerja tergantung lokasi Anda.'],
                ['q'=>'Metode pembayaran apa saja yang tersedia?','a'=>'Transfer Bank, Kartu Kredit/Debit (Visa, Mastercard), dan pembayaran digital lainnya.'],
                ['q'=>'Bagaimana cara melacak pesanan?','a'=>'Login ke akun Anda lalu buka menu "Pesanan Saya" untuk melihat status pesanan secara real-time.'],
                ['q'=>'Apakah produk bergaransi?','a'=>'Produk elektronik dilengkapi garansi resmi dari distributor. Detail garansi tercantum di halaman produk.'],
                ['q'=>'Bisakah saya membatalkan pesanan?','a'=>'Pembatalan dapat dilakukan selama pesanan masih berstatus "Pending". Hubungi kami segera via email atau telepon.'],
            ];
            foreach ($faqs as $faq): ?>
            <div class="faq-item" style="border:1px solid #f0f0f0;border-radius:12px;overflow:hidden;">
                <button onclick="toggleFaq(this)" style="width:100%;text-align:left;padding:16px 20px;background:#fff;border:none;cursor:pointer;display:flex;justify-content:space-between;align-items:center;font-size:14px;font-weight:600;color:#1d1d1f;">
                    <?= htmlspecialchars($faq['q']) ?>
                    <i class="fa fa-plus" style="color:#0071e3;font-size:12px;flex-shrink:0;margin-left:12px;"></i>
                </button>
                <div class="faq-answer" style="display:none;padding:0 20px 16px;font-size:13px;color:#86868b;line-height:1.6;"><?= htmlspecialchars($faq['a']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    var m = document.getElementById(id);
    if (m) { m.style.display = 'block'; document.body.style.overflow = 'hidden'; }
}
function closeModal(id) {
    var m = document.getElementById(id);
    if (m) { m.style.display = 'none'; document.body.style.overflow = ''; }
}
function toggleFaq(btn) {
    var answer = btn.nextElementSibling;
    var icon   = btn.querySelector('.fa');
    var isOpen = answer.style.display === 'block';
    document.querySelectorAll('.faq-answer').forEach(function(a){ a.style.display='none'; });
    document.querySelectorAll('.faq-item .fa').forEach(function(i){ i.className='fa fa-plus'; });
    if (!isOpen) { answer.style.display='block'; icon.className='fa fa-minus'; }
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { ['modal-cara-belanja','modal-faq'].forEach(closeModal); }
});
</script>

<!-- ============================================================
     JS FILES
============================================================ -->
<!-- PHP Session Status untuk JS -->
<script>
    window.IS_LOGGED_IN = <?php echo isset($_SESSION['uid']) ? 'true' : 'false'; ?>;
</script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/jquery.payform.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/main.js?v=<?php echo filemtime('js/main.js'); ?>"></script>
<script src="js/actions.js?v=<?php echo filemtime('js/actions.js'); ?>"></script>
<script src="js/script.js?v=<?php echo filemtime('js/script.js'); ?>"></script>

<!-- ============================================================
     INLINE SCRIPTS — Scroll animations, category filter, scroll-to-top
============================================================ -->
<script>
// ---- Scroll-to-top button ----
window.addEventListener('scroll', function () {
    var btn = document.getElementById('scroll-top');
    if (btn) {
        if (window.scrollY > 400) {
            btn.classList.add('visible');
        } else {
            btn.classList.remove('visible');
        }
    }
});

// ---- Intersection Observer — fade-in on scroll ----
(function () {
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    // Observe all .fade-in elements
    function observeAll() {
        document.querySelectorAll('.fade-in').forEach(function (el) {
            observer.observe(el);
        });
    }
    observeAll();

    // Re-observe when new products loaded
    window.reObserveFadeIn = observeAll;
})();

// ---- Helper to highlight active nav button ----
function updateCategoryNavActive(catId) {
    document.querySelectorAll('.categoryhome').forEach(function (l) {
        var cid = l.getAttribute('cid') || '0';
        if (String(cid) === String(catId)) {
            l.style.background = 'var(--bg-dark)';
            l.style.color = '#fff';
            l.classList.add('active');
        } else {
            l.style.background = '';
            l.style.color = '#86868b';
            l.classList.remove('active');
        }
    });
}

// ---- Category filter tabs (nav bar) ----
document.addEventListener('click', function (e) {
    var link = e.target.closest('.categoryhome');
    if (!link) return;
    e.preventDefault();

    var cat_id = link.getAttribute('cid') || '0';
    var cat_name = link.innerText.trim();

    if (String(cat_id) === '0') {
        showStackedView();
    } else {
        loadCategoryStack(cat_id, cat_name);
    }
});

// ---- Newsletter submit ----
function submitNewsletter(e) {
    e.preventDefault();
    var email = document.getElementById('newsletter-email').value;
    if (!email) return false;

    $.ajax({
        url: 'newsletter.php',
        method: 'POST',
        data: { email: email, subscribe: true },
        success: function (res) {
            swal("Berhasil!", "Terima kasih sudah berlangganan!", "success");
            document.getElementById('newsletter-email').value = '';
        },
        error: function () {
            swal("Oops!", "Terjadi kesalahan. Coba lagi.", "error");
        }
    });
    return false;
}

// ---- STACKED CARDS: Load category products ----
function loadCategoryStack(catId, catName) {
    // Prevent click bubbling from .stack-group onclick
    if (typeof event !== 'undefined' && event) event.stopPropagation();

    updateCategoryNavActive(catId);

    var stackedView  = document.getElementById('stacked-view');
    var gridView     = document.getElementById('product-grid-view');
    var titleEl      = document.getElementById('grid-cat-title');

    if (!stackedView || !gridView) return;

    // Update title
    if (titleEl) titleEl.textContent = catName;

    // Animate stacked view out, grid in
    stackedView.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
    stackedView.style.opacity    = '0';
    stackedView.style.transform  = 'translateY(-10px)';

    setTimeout(function () {
        stackedView.style.display = 'none';
        gridView.style.display    = 'block';
        gridView.style.opacity    = '0';
        gridView.style.transition = 'opacity 0.3s ease';

        // Scroll to section
        var section = document.getElementById('new-arrivals');
        if (section) section.scrollIntoView({ behavior: 'smooth', block: 'start' });

        // Load products via AJAX
        $.ajax({
            url: 'homeaction.php',
            method: 'POST',
            data: { get_seleted_Category: true, cat_id: catId },
            beforeSend: function () {
                $('#get_product_home').html(
                    '<div style="text-align:center;padding:80px 0;">' +
                    '<i class="fa fa-spinner fa-spin" style="font-size:36px;color:#0071e3;"></i>' +
                    '<p style="margin-top:16px;color:#86868b;">Memuat produk...</p>' +
                    '</div>'
                );
            },
            success: function (data) {
                $('#get_product_home').html(data);
                setTimeout(function () {
                    gridView.style.opacity = '1';
                    if (window.reObserveFadeIn) window.reObserveFadeIn();
                }, 50);
            }
        });
    }, 280);
}

// ---- STACKED CARDS: Return to stacked view ----
function showStackedView() {
    updateCategoryNavActive(0);

    var stackedView = document.getElementById('stacked-view');
    var gridView    = document.getElementById('product-grid-view');

    if (!stackedView || !gridView) return;

    gridView.style.transition = 'opacity 0.25s ease';
    gridView.style.opacity    = '0';

    setTimeout(function () {
        gridView.style.display    = 'none';
        stackedView.style.display = 'flex';
        stackedView.style.opacity = '0';
        stackedView.style.transform = 'translateY(10px)';

        var section = document.getElementById('new-arrivals');
        if (section) section.scrollIntoView({ behavior: 'smooth', block: 'start' });

        setTimeout(function () {
            stackedView.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
            stackedView.style.opacity    = '1';
            stackedView.style.transform  = 'translateY(0)';
        }, 50);
    }, 220);
}

// ---- filterProductsByCategory (from featured section) ----
function filterProductsByCategory(cat_id) {
    var catNames = {1: 'Elektronik', 2: 'Ladies Wear', 3: 'Mens Wear', 4: 'Olahraga'};
    loadCategoryStack(cat_id, catNames[cat_id] || 'Produk');
}
</script>

</body>
</html>
