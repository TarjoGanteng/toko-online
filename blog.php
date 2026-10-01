<?php include "header.php"; ?>

<div style="min-height:70vh; padding:80px 0; background:var(--bg-primary,#f5f5f7);">
    <div class="container" style="max-width:960px;">

        <!-- Header -->
        <div style="text-align:center; margin-bottom:56px;" class="fade-in">
            <span style="font-size:12px;font-weight:600;letter-spacing:.1em;color:#0071e3;text-transform:uppercase;">Wawasan &amp; Update</span>
            <h1 style="font-size:36px;font-weight:800;letter-spacing:-0.03em;margin:12px 0 16px;">Berita &amp; <span style="color:#0071e3;">Blog</span></h1>
            <p style="font-size:16px;color:#86868b;max-width:540px;margin:0 auto;line-height:1.6;">
                Artikel pilihan, panduan belanja cerdas, tips teknologi, dan pembaruan promo terkini dari kami.
            </p>
        </div>

        <!-- Featured / Highlights Grid -->
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(290px, 1fr)); gap:24px; margin-bottom:48px;">
            <?php
            $articles = [
                [
                    'tag' => 'Promo & Event',
                    'tag_color' => '#0071e3',
                    'date' => '01 Oktober 2026',
                    'read_time' => '3 mnt baca',
                    'icon' => 'fa-bullhorn',
                    'title' => 'Flash Sale Awal Bulan: Diskon Ekstra Hingga 50% untuk Produk Unggulan!',
                    'desc' => 'Nikmati potongan harga spesial untuk berbagai produk elektronik, pakaian pria & wanita, serta perlengkapan olahraga pilihan selama periode terbatas.'
                ],
                [
                    'tag' => 'Gadget & Tips',
                    'tag_color' => '#8e44ad',
                    'date' => '28 September 2026',
                    'read_time' => '5 mnt baca',
                    'icon' => 'fa-laptop',
                    'title' => 'Panduan Memilih Laptop untuk Kuliah dan Produktivitas Kerja',
                    'desc' => 'Ketahui spesifikasi penting seperti prosesor, RAM, kapasitas penyimpanan SSD, dan daya tahan baterai sebelum menentukan pilihan laptop terbaik Anda.'
                ],
                [
                    'tag' => 'Fashion & Style',
                    'tag_color' => '#e67e22',
                    'date' => '24 September 2026',
                    'read_time' => '4 mnt baca',
                    'icon' => 'fa-tshirt',
                    'title' => 'Tren Gaya Minimalis 2026: Nyaman dan Tetap Terlihat Elegan',
                    'desc' => 'Kombinasi warna netral dan potongan busana simpel kini menjadi tren utama. Simak tips mix and match pakaian sehari-hari tanpa ribet.'
                ],
                [
                    'tag' => 'Olahraga & Kesehatan',
                    'tag_color' => '#27ae60',
                    'date' => '19 September 2026',
                    'read_time' => '4 mnt baca',
                    'icon' => 'fa-heartbeat',
                    'title' => 'Cara Merawat Sepatu Lari dan Olahraga Agar Awet Bertahun-tahun',
                    'desc' => 'Mulai dari pencucian yang benar, penyimpanan di tempat kering, hingga rotasi pemakaian sepatu untuk menjaga elastisitas bantalan sol.'
                ],
                [
                    'tag' => 'Tips Belanja',
                    'tag_color' => '#d35400',
                    'date' => '14 September 2026',
                    'read_time' => '3 mnt baca',
                    'icon' => 'fa-shield',
                    'title' => 'Keamanan Transaksi Online: Tips Berbelanja Cerdas dan Bebas Khawatir',
                    'desc' => 'Kenali langkah-langkah memverifikasi situs belanja aman, menjaga kerahasiaan kata sandi akun, dan memilih metode pembayaran terpercaya.'
                ],
                [
                    'tag' => 'Seputar Toko',
                    'tag_color' => '#2980b9',
                    'date' => '08 September 2026',
                    'read_time' => '2 mnt baca',
                    'icon' => 'fa-truck',
                    'title' => 'Peningkatan Layanan Pengiriman Lebih Cepat ke Seluruh Indonesia',
                    'desc' => 'Kami terus memperluas jaringan kemitraan ekspedisi untuk memastikan pesanan Anda sampai dengan aman dan tepat waktu di depan pintu rumah.'
                ]
            ];

            foreach ($articles as $art): ?>
            <article style="background:#fff; border-radius:20px; padding:32px 28px; box-shadow:0 2px 20px rgba(0,0,0,0.05); display:flex; flex-direction:column; justify-content:space-between; transition:transform .25s ease, box-shadow .25s ease;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='none';this.style.boxShadow='0 2px 20px rgba(0,0,0,0.05)';">
                <div>
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:18px;">
                        <span style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:<?= $art['tag_color'] ?>; background:<?= $art['tag_color'] ?>14; padding:5px 12px; border-radius:980px;">
                            <?= htmlspecialchars($art['tag']) ?>
                        </span>
                        <span style="font-size:12px; color:#86868b; display:inline-flex; align-items:center; gap:6px;">
                            <i class="fa fa-clock-o"></i> <?= $art['read_time'] ?>
                        </span>
                    </div>

                    <h2 style="font-size:18px; font-weight:700; line-height:1.45; color:#1d1d1f; margin:0 0 12px; letter-spacing:-0.01em;">
                        <?= htmlspecialchars($art['title']) ?>
                    </h2>

                    <p style="font-size:14px; color:#666; line-height:1.65; margin:0 0 20px;">
                        <?= htmlspecialchars($art['desc']) ?>
                    </p>
                </div>

                <div style="border-top:1px solid #f2f2f5; padding-top:16px; display:flex; justify-content:space-between; align-items:center; font-size:12px; color:#86868b;">
                    <span><i class="fa fa-calendar-o"></i> <?= $art['date'] ?></span>
                    <span style="color:#0071e3; font-weight:600; display:inline-flex; align-items:center; gap:4px; cursor:pointer;">
                        Baca selengkapnya <i class="fa fa-chevron-right" style="font-size:10px;"></i>
                    </span>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- Back Button -->
        <div style="text-align:center;">
            <a href="index.php" style="display:inline-flex;align-items:center;gap:8px;padding:12px 28px;background:#fff;border:1.5px solid #e0e0e0;border-radius:980px;text-decoration:none;color:#1d1d1f;font-weight:600;font-size:14px;transition:all .2s;" onmouseover="this.style.background='#0071e3';this.style.color='#fff';this.style.borderColor='#0071e3';" onmouseout="this.style.background='#fff';this.style.color='#1d1d1f';this.style.borderColor='#e0e0e0';">
                <i class="fa fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

<?php include "footer.php"; ?>
