<?php include "header.php"; ?>

<div style="min-height:70vh; padding:80px 0; background:var(--bg-primary,#f5f5f7);">
    <div class="container" style="max-width:780px;">

        <!-- Header -->
        <div style="text-align:center; margin-bottom:56px;" class="fade-in">
            <span style="font-size:12px;font-weight:600;letter-spacing:.1em;color:#0071e3;text-transform:uppercase;">Tentang Kami</span>
            <h1 style="font-size:36px;font-weight:800;letter-spacing:-0.03em;margin:12px 0 16px;">Online<span style="color:#0071e3;">Shop</span></h1>
            <p style="font-size:16px;color:#86868b;max-width:500px;margin:0 auto;line-height:1.6;">Platform belanja online terpercaya dengan ribuan produk pilihan</p>
        </div>

        <!-- Story -->
        <div style="background:#fff;border-radius:20px;padding:40px;margin-bottom:24px;box-shadow:0 2px 20px rgba(0,0,0,0.06);" class="fade-in">
            <h2 style="font-size:20px;font-weight:700;margin:0 0 16px;letter-spacing:-0.02em;">Siapa Kami?</h2>
            <p style="color:#555;line-height:1.8;margin:0;">
                Online Shop adalah platform belanja daring yang hadir untuk memudahkan kehidupan sehari-hari Anda.
                Kami menyediakan berbagai produk berkualitas — mulai dari elektronik, fashion, olahraga, hingga kebutuhan rumah —
                dengan harga terjangkau dan pengalaman belanja yang menyenangkan.
            </p>
        </div>

        <!-- Values -->
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin-bottom:24px;">
            <?php
            $values = [
                ['icon'=>'fa-heart',        'color'=>'#e74c3c','title'=>'Kepercayaan',  'desc'=>'Kami berkomitmen menjaga kepercayaan pelanggan dengan produk asli dan berkualitas.'],
                ['icon'=>'fa-bolt',         'color'=>'#f39c12','title'=>'Kecepatan',    'desc'=>'Pengiriman cepat 1–3 hari kerja ke seluruh wilayah Indonesia.'],
                ['icon'=>'fa-shield',       'color'=>'#0071e3','title'=>'Keamanan',     'desc'=>'Transaksi Anda aman dengan sistem enkripsi dan pembayaran terpercaya.'],
                ['icon'=>'fa-headphones',   'color'=>'#30b650','title'=>'Dukungan',     'desc'=>'Tim CS kami siap membantu 7 hari seminggu via email dan telepon.'],
            ];
            foreach ($values as $v): ?>
            <div style="background:#fff;border-radius:16px;padding:28px 24px;box-shadow:0 2px 16px rgba(0,0,0,0.05);" class="fade-in">
                <div style="width:48px;height:48px;border-radius:12px;background:<?= $v['color'] ?>20;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                    <i class="fa <?= $v['icon'] ?>" style="color:<?= $v['color'] ?>;font-size:20px;"></i>
                </div>
                <h3 style="font-size:15px;font-weight:700;margin:0 0 8px;"><?= $v['title'] ?></h3>
                <p style="font-size:13px;color:#86868b;margin:0;line-height:1.6;"><?= $v['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Stats -->
        <div style="background:linear-gradient(135deg,#0a1f44,#0071e3);border-radius:20px;padding:40px;display:flex;justify-content:space-around;flex-wrap:wrap;gap:24px;" class="fade-in">
            <?php
            $stats = [['500+','Produk'],['10K+','Pelanggan'],['4.9★','Rating'],['99%','Kepuasan']];
            foreach ($stats as $s): ?>
            <div style="text-align:center;">
                <div style="font-size:32px;font-weight:800;color:#fff;letter-spacing:-0.02em;"><?= $s[0] ?></div>
                <div style="font-size:13px;color:rgba(255,255,255,0.6);margin-top:4px;"><?= $s[1] ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Back button -->
        <div style="text-align:center;margin-top:40px;">
            <a href="index.php" style="display:inline-flex;align-items:center;gap:8px;padding:12px 28px;background:#fff;border:1.5px solid #e0e0e0;border-radius:980px;text-decoration:none;color:#1d1d1f;font-weight:600;font-size:14px;transition:all .2s;" onmouseover="this.style.background='#0071e3';this.style.color='#fff';this.style.borderColor='#0071e3';" onmouseout="this.style.background='#fff';this.style.color='#1d1d1f';this.style.borderColor='#e0e0e0';">
                <i class="fa fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

<?php include "footer.php"; ?>
