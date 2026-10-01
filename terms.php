<?php include "header.php"; ?>

<div style="min-height:70vh; padding:80px 0; background:var(--bg-primary,#f5f5f7);">
    <div class="container" style="max-width:760px;">

        <div style="text-align:center;margin-bottom:48px;" class="fade-in">
            <span style="font-size:12px;font-weight:600;letter-spacing:.1em;color:#0071e3;text-transform:uppercase;">Legal</span>
            <h1 style="font-size:32px;font-weight:800;letter-spacing:-0.03em;margin:12px 0 12px;">Syarat &amp; Ketentuan</h1>
            <p style="font-size:13px;color:#86868b;">Terakhir diperbarui: <?= date('d F Y') ?></p>
        </div>

        <div style="background:#fff;border-radius:20px;padding:40px 44px;box-shadow:0 2px 20px rgba(0,0,0,0.06);" class="fade-in">
            <?php
            $sections = [
                ['Penerimaan Syarat', 'Dengan mengakses dan menggunakan layanan Online Shop, Anda menyetujui untuk terikat dengan syarat dan ketentuan ini. Jika Anda tidak menyetujui, harap tidak menggunakan layanan kami.'],
                ['Akun Pengguna', 'Anda bertanggung jawab untuk menjaga kerahasiaan akun dan kata sandi Anda. Segala aktivitas yang terjadi di bawah akun Anda menjadi tanggung jawab Anda sepenuhnya.'],
                ['Pemesanan & Pembayaran', 'Semua harga yang tercantum sudah termasuk pajak. Kami berhak membatalkan pesanan jika terjadi kesalahan harga atau stok tidak tersedia. Pembayaran harus diselesaikan dalam 1×24 jam.'],
                ['Pengiriman', 'Estimasi waktu pengiriman adalah 1–3 hari kerja. Keterlambatan yang disebabkan oleh pihak jasa pengiriman di luar tanggung jawab Online Shop.'],
                ['Pengembalian Barang', 'Pengembalian dapat dilakukan dalam 7 hari setelah barang diterima, dengan syarat produk masih dalam kondisi original, belum digunakan, dan kemasan masih utuh. Biaya pengiriman retur ditanggung pembeli.'],
                ['Hak Kekayaan Intelektual', 'Seluruh konten pada website ini — termasuk logo, teks, gambar, dan desain — adalah milik Online Shop dan dilindungi oleh hukum hak cipta yang berlaku.'],
                ['Batasan Tanggung Jawab', 'Online Shop tidak bertanggung jawab atas kerugian tidak langsung yang timbul dari penggunaan layanan kami. Tanggung jawab kami dibatasi pada nilai transaksi yang bersangkutan.'],
                ['Perubahan Ketentuan', 'Kami berhak mengubah syarat dan ketentuan ini kapan saja. Perubahan berlaku segera setelah dipublikasikan di website. Penggunaan lanjutan atas layanan kami berarti Anda menyetujui perubahan tersebut.'],
            ];
            foreach ($sections as $i => [$title, $body]): ?>
            <div style="<?= $i > 0 ? 'border-top:1px solid #f0f0f0;margin-top:28px;padding-top:28px;' : '' ?>">
                <h2 style="font-size:16px;font-weight:700;margin:0 0 10px;color:#1d1d1f;"><?= ($i+1) . '. ' . $title ?></h2>
                <p style="font-size:14px;color:#555;line-height:1.75;margin:0;"><?= $body ?></p>
            </div>
            <?php endforeach; ?>

            <div style="margin-top:36px;padding:20px;background:#fff8e1;border-radius:12px;border-left:4px solid #f39c12;">
                <p style="font-size:13px;color:#b7860b;margin:0;line-height:1.6;">
                    <i class="fa fa-info-circle"></i> &nbsp;Dengan berbelanja di Online Shop, Anda dianggap telah membaca dan menyetujui seluruh syarat dan ketentuan di atas.
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
