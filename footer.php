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
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Karier</a></li>
                    <li><a href="#">Berita & Blog</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <!-- Layanan -->
            <div class="footer-col">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#">Cara Belanja</a></li>
                    <li><a href="#">Lacak Pesanan</a></li>
                    <li><a href="#">Pengembalian Barang</a></li>
                    <li><a href="#">FAQ</a></li>
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
            <a href="#">Privasi</a>
            <a href="#">Ketentuan</a>
            <a href="#">Sitemap</a>
        </div>
    </div>
</div>

<!-- ============================================================
     JS FILES
============================================================ -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/jquery.payform.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/main.js"></script>
<script src="js/actions.js"></script>
<script src="js/script.js"></script>

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

// ---- Category filter tabs (nav bar) ----
document.addEventListener('click', function (e) {
    var link = e.target.closest('.categoryhome');
    if (!link) return;
    e.preventDefault();

    // Active state
    document.querySelectorAll('.categoryhome').forEach(function (l) {
        l.style.background = '';
        l.style.color = '#86868b';
    });
    link.style.background = 'var(--bg-dark)';
    link.style.color = '#fff';

    var cat_id = link.getAttribute('cid') || '0';

    // Scroll to products
    var section = document.getElementById('new-arrivals');
    if (section) section.scrollIntoView({ behavior: 'smooth' });

    // AJAX load products
    $.ajax({
        url: 'homeaction.php',
        method: 'POST',
        data: { get_seleted_Category: true, cat_id: cat_id },
        beforeSend: function () {
            $('#get_product_home').css('opacity', '0.4').css('transition', 'opacity 0.2s');
        },
        success: function (data) {
            $('#get_product_home').html(data).css('opacity', '1');
            if (window.reObserveFadeIn) window.reObserveFadeIn();
        }
    });
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

// ---- filterProductsByCategory (from featured section links) ----
function filterProductsByCategory(cat_id) {
    var section = document.getElementById('new-arrivals');
    if (section) section.scrollIntoView({ behavior: 'smooth' });

    $.ajax({
        url: 'homeaction.php',
        method: 'POST',
        data: { get_seleted_Category: true, cat_id: cat_id },
        beforeSend: function () {
            $('#get_product_home').css('opacity', '0.4');
        },
        success: function (data) {
            $('#get_product_home').html(data).css('opacity', '1');
            if (window.reObserveFadeIn) window.reObserveFadeIn();
        }
    });
}
</script>

</body>
</html>
