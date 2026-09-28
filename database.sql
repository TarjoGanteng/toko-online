-- ============================================================
--  DATABASE SETUP: ecommerce
--  Import file ini melalui phpMyAdmin > Import > pilih file ini
-- ============================================================

-- Buat dan pilih database
CREATE DATABASE IF NOT EXISTS `ecommerce` 
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;

USE `ecommerce`;

-- ============================================================
--  TABEL: user_info (data pengguna yang login)
-- ============================================================
CREATE TABLE IF NOT EXISTS `user_info` (
    `user_id`    INT AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name`  VARCHAR(100) DEFAULT '',
    `email`      VARCHAR(150) NOT NULL UNIQUE,
    `password`   VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABEL: register (untuk config.php - sistem login lama)
-- ============================================================
CREATE TABLE IF NOT EXISTS `register` (
    `id`       INT AUTO_INCREMENT PRIMARY KEY,
    `Name`     VARCHAR(100) NOT NULL,
    `email`    VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABEL: category
-- ============================================================
CREATE TABLE IF NOT EXISTS `category` (
    `cat_id`   INT AUTO_INCREMENT PRIMARY KEY,
    `cat_name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABEL: brand
-- ============================================================
CREATE TABLE IF NOT EXISTS `brand` (
    `brand_id`   INT AUTO_INCREMENT PRIMARY KEY,
    `brand_name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABEL: product
-- ============================================================
CREATE TABLE IF NOT EXISTS `product` (
    `pro_id`    INT AUTO_INCREMENT PRIMARY KEY,
    `pro_name`  VARCHAR(200) NOT NULL,
    `pro_price` DECIMAL(12,2) NOT NULL DEFAULT 0,
    `pro_img`   VARCHAR(255) DEFAULT 'no-image.png',
    `cat_id`    INT,
    `brand_id`  INT,
    `keywords`  VARCHAR(255) DEFAULT '',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`cat_id`) REFERENCES `category`(`cat_id`) ON DELETE SET NULL,
    FOREIGN KEY (`brand_id`) REFERENCES `brand`(`brand_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABEL: cart
-- ============================================================
CREATE TABLE IF NOT EXISTS `cart` (
    `cart_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `pro_id`  INT NOT NULL,
    `qty`     INT DEFAULT 1,
    FOREIGN KEY (`user_id`) REFERENCES `user_info`(`user_id`) ON DELETE CASCADE,
    FOREIGN KEY (`pro_id`) REFERENCES `product`(`pro_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABEL: orders
-- ============================================================
CREATE TABLE IF NOT EXISTS `orders` (
    `order_id`       INT AUTO_INCREMENT PRIMARY KEY,
    `user_id`        INT NOT NULL,
    `fname`          VARCHAR(100) NOT NULL,
    `lname`          VARCHAR(100) DEFAULT '',
    `email`          VARCHAR(150) NOT NULL,
    `address`        TEXT NOT NULL,
    `city`           VARCHAR(100) NOT NULL,
    `state`          VARCHAR(100) DEFAULT '',
    `zip`            VARCHAR(20) NOT NULL,
    `total_amount`   DECIMAL(12,2) NOT NULL DEFAULT 0,
    `payment_method` VARCHAR(50) NOT NULL DEFAULT 'transfer',
    `status`         ENUM('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
    `created_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABEL: order_items
-- ============================================================
CREATE TABLE IF NOT EXISTS `order_items` (
    `item_id`       INT AUTO_INCREMENT PRIMARY KEY,
    `order_id`      INT NOT NULL,
    `product_id`    INT NOT NULL,
    `product_title` VARCHAR(255) NOT NULL,
    `product_price` DECIMAL(12,2) NOT NULL,
    `qty`           INT NOT NULL DEFAULT 1,
    `subtotal`      DECIMAL(12,2) NOT NULL,
    INDEX (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  TABEL: newsletter
-- ============================================================
CREATE TABLE IF NOT EXISTS `newsletter` (
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `email`      VARCHAR(150) NOT NULL UNIQUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
--  DATA CONTOH: Category
-- ============================================================
INSERT INTO `category` (`cat_name`) VALUES
('Elektronik'),
('Fashion Pria'),
('Fashion Wanita'),
('Olahraga'),
('Rumah & Dapur'),
('Buku & Alat Tulis');

-- ============================================================
--  DATA CONTOH: Brand
-- ============================================================
INSERT INTO `brand` (`brand_name`) VALUES
('Samsung'),
('Apple'),
('Nike'),
('Adidas'),
('Zara'),
('IKEA'),
('Gramedia');

-- ============================================================
--  DATA CONTOH: Product
-- ============================================================
INSERT INTO `product` (`pro_name`, `pro_price`, `pro_img`, `cat_id`, `brand_id`, `keywords`) VALUES
('Samsung Galaxy A54', 5499000, 'no-image.png', 1, 1, 'samsung,hp,android,ponsel'),
('iPhone 14 Pro', 17999000, 'no-image.png', 1, 2, 'apple,iphone,ios,ponsel'),
('Kemeja Pria Slim Fit', 199000, 'no-image.png', 2, 5, 'kemeja,baju,pria,fashion'),
('Sepatu Nike Air Max', 1299000, 'no-image.png', 4, 3, 'nike,sepatu,olahraga,lari'),
('Dress Wanita Casual', 259000, 'no-image.png', 3, 5, 'dress,wanita,fashion,casual'),
('Celana Adidas Training', 449000, 'no-image.png', 4, 4, 'adidas,celana,training,olahraga'),
('Set Meja Belajar IKEA', 1850000, 'no-image.png', 5, 6, 'ikea,meja,furniture,belajar'),
('Buku Pemrograman PHP', 89000, 'no-image.png', 6, 7, 'buku,php,programming,pemrograman'),
('Samsung Smart TV 43"', 6299000, 'no-image.png', 1, 1, 'samsung,tv,elektronik,smart'),
('Jaket Hoodie Pria', 349000, 'no-image.png', 2, 4, 'jaket,hoodie,pria,fashion'),
('Sepatu Adidas Stan Smith', 999000, 'no-image.png', 4, 4, 'adidas,sepatu,casual,stan smith'),
('Rak Piring IKEA', 450000, 'no-image.png', 5, 6, 'ikea,rak,dapur,furniture');

-- ============================================================
--  DATA CONTOH: User (password = "password123" di-hash MD5)
-- ============================================================
INSERT INTO `user_info` (`first_name`, `last_name`, `email`, `password`) VALUES
('Admin', 'Shop', 'admin@onlineshop.com', MD5('password123')),
('Budi', 'Santoso', 'budi@email.com', MD5('password123'));

-- ============================================================
--  SELESAI!
--  Akses website di: http://localhost/NAMA_FOLDER_ANDA/
--  phpMyAdmin      : http://localhost/phpmyadmin
-- ============================================================
