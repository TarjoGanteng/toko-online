-- ============================================================
--  UPDATE GAMBAR PRODUK
--  Jalankan di phpMyAdmin setelah gambar disalin ke folder img/
-- ============================================================

USE `ecommerce`;

-- Gambar yang sudah tersedia
UPDATE product SET product_image = 'samsung-galaxy-a54.jpg'   WHERE product_title = 'Samsung Galaxy A54';
UPDATE product SET product_image = 'iphone-14-pro.jpg'        WHERE product_title LIKE '%iPhone 14 Pro%';
UPDATE product SET product_image = 'kemeja-pria-slim-fit.jpg'  WHERE product_title LIKE '%Kemeja Pria Slim Fit%';

-- Sisa produk (gambar akan ditambahkan setelah kuota generate gambar reset ~5 jam lagi)
-- Samsung Smart TV 43"
-- Sepatu Nike Air Max
-- Dress Wanita Casual
-- Celana Adidas Training
-- Set Meja Belajar IKEA
-- Buku Pemrograman PHP
-- Jaket Hoodie Pria
-- Sepatu Adidas Stan Smith
-- Rak Piring IKEA
