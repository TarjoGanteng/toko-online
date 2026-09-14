-- ============================================================
--  PRODUK OLAHRAGA (product_cat = 4)
--  Nike (brand_id = 10), Adidas (brand_id = 11)
--
--  Cara pakai:
--  1. Buka http://localhost/phpmyadmin
--  2. Pilih database ecommerce
--  3. Klik tab "SQL"
--  4. Copy-paste isi file ini, lalu klik "Go"
-- ============================================================

INSERT INTO `product` (`product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES

-- ---- NIKE (brand_id = 10) ----

(4, 10, 'Sepatu Nike Air Max 270', 1499000,
 'Sepatu lari Nike Air Max 270 dengan unit Air terbesar di tumit, memberikan cushioning maksimal dan kenyamanan sepanjang hari. Upper mesh breathable untuk ventilasi optimal.',
 'nike-airmax270.jpg',
 'nike,sepatu,air max,270,lari,running,olahraga'),

(4, 10, 'Sepatu Nike Air Force 1', 1299000,
 'Ikon sneaker Nike Air Force 1 dengan desain klasik yang tak lekang waktu. Bantalan udara di bagian bawah memberikan kenyamanan ekstra untuk pemakaian sehari-hari.',
 'nike-airforce1.jpg',
 'nike,sepatu,air force,1,sneaker,kasual,olahraga'),

(4, 10, 'Kaos Compression Nike Pro', 349000,
 'Kaos compression Nike Pro dengan teknologi Dri-FIT yang mengalirkan keringat dari tubuh, memberikan dukungan otot optimal saat berolahraga intensitas tinggi.',
 'kaos-compression-nike.jpg',
 'kaos,compression,nike,pro,dri-fit,olahraga,gym'),

(4, 10, 'Jaket Lari Nike Windrunner', 899000,
 'Jaket lari ringan Nike Windrunner dengan bahan tahan angin, desain klasik chevron di dada, kerah krah tinggi, dan kantong tersembunyi. Ideal untuk lari outdoor.',
 'jaket-lari-nike.jpg',
 'jaket,lari,nike,windrunner,running,olahraga,windbreaker'),

(4, 10, 'Tas Gym Nike Brasilia', 549000,
 'Tas gym Nike Brasilia berkapasitas besar dengan kompartemen sepatu terpisah, material polyester tahan lama, dan tali bahu yang dapat disesuaikan.',
 'tas-gym-nike.jpg',
 'tas,gym,nike,brasilia,sport,bag,olahraga'),

-- ---- ADIDAS (brand_id = 11) ----

(4, 11, 'Sepatu Adidas Ultraboost 23', 1999000,
 'Sepatu lari premium Adidas Ultraboost 23 dengan teknologi BOOST midsole yang memberikan energi balik terbaik, upper Primeknit+ adaptif, dan outsole Continental rubber.',
 'adidas-ultraboost23.jpg',
 'adidas,ultraboost,23,sepatu,lari,running,boost,olahraga'),

(4, 11, 'Sepatu Adidas Stan Smith', 999000,
 'Sneaker legendaris Adidas Stan Smith dengan desain minimalis klasik, upper kulit premium, dan tiga strip ikonik. Cocok untuk olahraga ringan maupun gaya kasual.',
 'adidas-stansmith.jpg',
 'adidas,stan smith,sepatu,sneaker,kasual,olahraga'),

(4, 11, 'Jersey Adidas Tiro 23', 399000,
 'Jersey olahraga Adidas Tiro 23 dengan teknologi AEROREADY yang menyerap keringat, potongan slim fit, dan material daur ulang. Cocok untuk futsal, gym, maupun latihan.',
 'jersey-adidas-tiro.jpg',
 'jersey,adidas,tiro,23,futsal,gym,olahraga,training'),

(4, 11, 'Celana Pendek Adidas Squadra', 299000,
 'Celana pendek olahraga Adidas Squadra 21, bahan ringan dan cepat kering, elastis di pinggang, cocok untuk futsal, basket, gym, atau olahraga apapun.',
 'celana-adidas-squadra.jpg',
 'celana,pendek,adidas,squadra,olahraga,futsal,gym,training');

-- ============================================================
--  SELESAI! Total: 9 produk olahraga ditambahkan
--
--  CATATAN GAMBAR:
--  Simpan gambar produk di folder: toko-online/img/
--  dengan nama file sesuai kolom product_image di atas.
--  Jika belum ada gambar, produk tetap tampil dengan
--  placeholder "no-image.png"
-- ============================================================
