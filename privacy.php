<?php include "header.php"; ?>

<div style="min-height:70vh; padding:80px 0; background:var(--bg-primary,#f5f5f7);">
    <div class="container" style="max-width:760px;">

        <div style="text-align:center;margin-bottom:48px;" class="fade-in">
            <span style="font-size:12px;font-weight:600;letter-spacing:.1em;color:#0071e3;text-transform:uppercase;">Legal</span>
            <h1 style="font-size:32px;font-weight:800;letter-spacing:-0.03em;margin:12px 0 12px;">Kebijakan Privasi</h1>
            <p style="font-size:13px;color:#86868b;">Terakhir diperbarui: <?= date('d F Y') ?></p>
        </div>

        <div style="background:#fff;border-radius:20px;padding:40px 44px;box-shadow:0 2px 20px rgba(0,0,0,0.06);" class="fade-in">
            <?php
            $sections = [
                ['Informasi yang Kami Kumpulkan', 'Kami mengumpulkan informasi yang Anda berikan secara langsung, seperti nama, alamat email, alamat pengiriman, dan informasi pembayaran saat Anda mendaftar atau melakukan transaksi di platform kami.'],
                ['Penggunaan Informasi', 'Informasi yang kami kumpulkan digunakan untuk memproses pesanan Anda, mengirimkan konfirmasi dan pembaruan status pesanan, meningkatkan layanan kami, serta mengirimkan penawaran promosi (jika Anda menyetujuinya).'],
                ['Keamanan Data', 'Kami menggunakan enkripsi SSL untuk melindungi data Anda selama transmisi. Informasi sensitif seperti kata sandi disimpan dalam bentuk terenkripsi dan tidak dapat dibaca oleh siapapun.'],
                ['Berbagi Informasi', 'Kami tidak menjual, memperdagangkan, atau mentransfer informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali untuk keperluan pengiriman pesanan melalui mitra logistik kami.'],
                ['Cookie', 'Kami menggunakan cookie untuk meningkatkan pengalaman berbelanja Anda, mengingat preferensi Anda, dan menganalisis trafik situs. Anda dapat menonaktifkan cookie melalui pengaturan browser Anda.'],
                ['Hak Pengguna', 'Anda berhak mengakses, memperbarui, atau menghapus informasi pribadi Anda kapan saja dengan menghubungi kami melalui email di info@onlineshop.com.'],
                ['Perubahan Kebijakan', 'Kami dapat memperbarui kebijakan privasi ini sewaktu-waktu. Perubahan akan diberitahukan melalui email atau pemberitahuan di website kami.'],
            ];
            foreach ($sections as $i => [$title, $body]): ?>
            <div style="<?= $i > 0 ? 'border-top:1px solid #f0f0f0;margin-top:28px;padding-top:28px;' : '' ?>">
                <h2 style="font-size:16px;font-weight:700;margin:0 0 10px;color:#1d1d1f;"><?= ($i+1) . '. ' . $title ?></h2>
                <p style="font-size:14px;color:#555;line-height:1.75;margin:0;"><?= $body ?></p>
            </div>
            <?php endforeach; ?>

            <div style="margin-top:36px;padding:20px;background:#f0f7ff;border-radius:12px;border-left:4px solid #0071e3;">
                <p style="font-size:13px;color:#0071e3;margin:0;line-height:1.6;">
                    <i class="fa fa-envelope"></i> &nbsp;Pertanyaan tentang kebijakan privasi? Hubungi kami di <strong>info@onlineshop.com</strong>
                </p>
            </div>
        </div>

        <div style="text-align:center;margin-top:36px;">
            <a href="index.php" style="display:inline-flex;align-items:center;gap:8px;padding:12px 28px;background:#fff;border:1.5px solid #e0e0e0;border-radius:980px;text-decoration:none;color:#1d1d1f;font-weight:600;font-size:14px;" onmouseover="this.style.background='#0071e3';this.style.color='#fff';this.style.borderColor='#0071e3';" onmouseout="this.style.background='#fff';this.style.color='#1d1d1f';this.style.borderColor='#e0e0e0';">
                <i class="fa fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
