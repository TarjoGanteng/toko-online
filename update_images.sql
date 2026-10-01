-- ============================================================
--  UPDATE GAMBAR PRODUK
--  Jalankan di phpMyAdmin / MySQL CLI setelah gambar disalin ke folder img/
-- ============================================================

USE `ecommerce`;

-- Gadget & Elektronik
UPDATE product SET product_image = 'HP-Spectre-x360.jpg'          WHERE product_title LIKE '%HP Spectre%';
UPDATE product SET product_image = 'iPhone_12_Pro.jpg'           WHERE product_title LIKE '%iPhone 12 Pro%';
UPDATE product SET product_image = 'iphone-14-pro.jpg'           WHERE product_title LIKE '%iPhone 14 Pro%';
UPDATE product SET product_image = 'iPhone-15-Pro.jpg'           WHERE product_title LIKE '%iPhone 15 Pro%';
UPDATE product SET product_image = 'Samsung-Galaxy-S23-Ultra.jpg' WHERE product_title LIKE '%Samsung Galaxy S23 Ultra%' OR product_title LIKE '%Samsung%S23%';
UPDATE product SET product_image = 'Samsung_Galaxy_S21.jpg'       WHERE product_title LIKE '%Samsung Galaxy S21%' OR product_title LIKE '%Samsung%S21%';
UPDATE product SET product_image = 'samsung-galaxy-a54.jpg'      WHERE product_title LIKE '%Samsung Galaxy A54%';
UPDATE product SET product_image = 'ASUS-ROG-Phone-7.jpg'        WHERE product_title LIKE '%ASUS ROG%';
UPDATE product SET product_image = 'Apple-MacBook-Air-M2.webp'   WHERE product_title LIKE '%MacBook Air%';

-- Fashion & Sport
UPDATE product SET product_image = 'kemeja-pria-slim-fit.jpg'     WHERE product_title LIKE '%Kemeja Pria Slim Fit%' OR product_title LIKE '%Mens Casual Shirt%';
UPDATE product SET product_image = 'Kemeja-Wanita-Oxford-Uniqlo.jpg' WHERE product_title LIKE '%Kemeja Wanita Oxford%';
UPDATE product SET product_image = 'Tunik-Batik-Modern.jpg'       WHERE product_title LIKE '%Tunik Batik%';
UPDATE product SET product_image = 'Celana-Jogger-Training-Adidas.avif' WHERE product_title LIKE '%Jogger Training Adidas%';

-- Tambahan baru
UPDATE product SET product_image = 'Apple Watch Series 9.jpg'       WHERE product_title LIKE '%Apple Watch Series 9%';
UPDATE product SET product_image = 'Xiaomi Redmi Note 12 Pro.jpg'   WHERE product_title LIKE '%Xiaomi Redmi Note 12 Pro%';
UPDATE product SET product_image = 'Xiaomi Smart TV 55 4K.jpg'      WHERE product_title LIKE '%Xiaomi Smart TV 55%';
