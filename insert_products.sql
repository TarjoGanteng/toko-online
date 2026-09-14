-- ============================================================
--  TAMBAH BRAND BARU
--  (brand_id 1=HP, 2=Samsung, 3=Apple sudah ada)
-- ============================================================
INSERT INTO `brand` (`brand_title`) VALUES
('Xiaomi'),       -- brand_id = 4
('Sony'),         -- brand_id = 5
('ASUS'),         -- brand_id = 6
('Zara'),         -- brand_id = 7
('H&M'),          -- brand_id = 8
('Uniqlo'),       -- brand_id = 9
('Nike'),         -- brand_id = 10
('Adidas');       -- brand_id = 11

-- ============================================================
--  PRODUK: ELECTRONICS (product_cat = 1)
-- ============================================================
-- Samsung Galaxy S21 sudah ada (product_id = 1), skip
-- Tambah produk electronics baru:

INSERT INTO `product` (`product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES

-- Samsung (brand_id = 2)
(1, 2, 'Samsung Galaxy S23 Ultra', 16999000,
 'Smartphone flagship Samsung terbaru dengan kamera 200MP, layar 6.8 inci Dynamic AMOLED, chipset Snapdragon 8 Gen 2, dan stylus S-Pen terintegrasi.',
 'samsung-s23ultra.jpg',
 'samsung,galaxy,s23,ultra,smartphone,android,flagship'),

(1, 2, 'Samsung Galaxy Tab S9', 11999000,
 'Tablet premium Samsung dengan layar Dynamic AMOLED 11 inci, chipset Snapdragon 8 Gen 2, tahan air IP68, dan stylus S-Pen termasuk dalam paket.',
 'samsung-tabs9.jpg',
 'samsung,galaxy,tab,s9,tablet,android'),

-- Apple (brand_id = 3)
(1, 3, 'iPhone 15 Pro', 19999000,
 'iPhone terbaru Apple dengan chip A17 Pro, kamera 48MP, layar Super Retina XDR 6.1 inci, dan titanium frame yang ringan namun kuat.',
 'iphone15pro.jpg',
 'apple,iphone,15,pro,smartphone,ios'),

(1, 3, 'Apple MacBook Air M2', 18499000,
 'Laptop ultra-tipis Apple dengan chip M2, layar Liquid Retina 13.6 inci, baterai tahan hingga 18 jam, dan desain tanpa kipas angin.',
 'macbook-air-m2.jpg',
 'apple,macbook,air,m2,laptop'),

(1, 3, 'Apple Watch Series 9', 6999000,
 'Smartwatch Apple terkini dengan layar always-on Retina, sensor detak jantung canggih, deteksi kecelakaan, dan tahan air hingga 50 meter.',
 'apple-watch9.jpg',
 'apple,watch,series,9,smartwatch,wearable'),

-- Xiaomi (brand_id = 4)
(1, 4, 'Xiaomi Redmi Note 12 Pro', 3499000,
 'Smartphone mid-range Xiaomi dengan kamera 50MP OIS, layar AMOLED 6.67 inci 120Hz, baterai 5000mAh, dan pengisian cepat 67W.',
 'xiaomi-note12pro.jpg',
 'xiaomi,redmi,note,12,pro,smartphone,android'),

(1, 4, 'Xiaomi Smart TV 55 4K', 5999000,
 'Smart TV Xiaomi 55 inci resolusi 4K UHD, panel IPS, dukungan Dolby Vision dan HDR10, Android TV 11 dengan Google Assistant bawaan.',
 'xiaomi-tv55.jpg',
 'xiaomi,smart,tv,55,4k,android,television'),

-- Sony (brand_id = 5)
(1, 5, 'Sony WH-1000XM5 Headphones', 4999000,
 'Headphone wireless premium Sony dengan Active Noise Cancellation terbaik di kelasnya, suara Hi-Res Audio, baterai 30 jam, dan lipatan ultra-tipis.',
 'sony-wh1000xm5.jpg',
 'sony,headphone,wh1000xm5,wireless,noise cancelling,audio'),

-- ASUS (brand_id = 6)
(1, 6, 'ASUS ROG Phone 7', 9999000,
 'Gaming smartphone ASUS ROG terkencang dengan Snapdragon 8 Gen 2, layar AMOLED 165Hz, RAM 16GB, baterai 6000mAh, dan sistem pendingin canggih.',
 'asus-rog7.jpg',
 'asus,rog,phone,7,gaming,smartphone,android');

-- ============================================================
--  PRODUK: LADIES WEAR (product_cat = 2)
-- ============================================================
INSERT INTO `product` (`product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES

-- Zara (brand_id = 7)
(2, 7, 'Dress Floral Midi Zara', 599000,
 'Dress midi bercorak bunga-bunga cantik dari Zara, bahan rayon lembut, desain A-line yang elegan dan cocok untuk acara kasual maupun formal.',
 'dress-floral-zara.jpg',
 'dress,floral,midi,zara,wanita,fashion'),

(2, 7, 'Celana Palazzo Wide Leg Zara', 429000,
 'Celana palazzo cut wide leg dari Zara, bahan ringan dan jatuh, cocok dipadukan dengan berbagai atasan untuk tampilan stylish sehari-hari.',
 'celana-palazzo-zara.jpg',
 'celana,palazzo,wide,leg,zara,wanita,fashion'),

(2, 7, 'Jumpsuit Casual Zara', 649000,
 'Jumpsuit kasual elegan dari Zara dengan potongan longgar, bahan breathable, pilihan sempurna untuk tampilan minimalis yang chic.',
 'jumpsuit-zara.jpg',
 'jumpsuit,casual,zara,wanita,fashion'),

-- H&M (brand_id = 8)
(2, 8, 'Blouse Casual H&M', 279000,
 'Blouse kasual ringan dari H&M dengan bahan katun premium, berbagai pilihan warna, cocok untuk kegiatan sehari-hari maupun hangout.',
 'blouse-hm.jpg',
 'blouse,casual,hm,wanita,fashion,atasan'),

(2, 8, 'Jaket Wanita Oversize H&M', 489000,
 'Jaket oversize trendi dari H&M, bahan tebal berkualitas, cocok untuk style kasual atau menemani aktivitas luar ruangan di cuaca sejuk.',
 'jaket-wanita-hm.jpg',
 'jaket,oversize,hm,wanita,fashion,outerwear'),

(2, 8, 'Cardigan Rajut H&M', 319000,
 'Cardigan rajut lembut dari H&M, terbuat dari bahan akrilik berkualitas, desain panjang yang versatile dan cocok dipadukan berbagai outfit.',
 'cardigan-hm.jpg',
 'cardigan,rajut,knit,hm,wanita,fashion'),

-- Uniqlo (brand_id = 9)
(2, 9, 'Rok Midi Flare Uniqlo', 349000,
 'Rok midi flare dari Uniqlo dengan bahan chiffon ringan, desain klasik yang timeless, pilihan ideal untuk tampilan feminin dan elegan.',
 'rok-midi-uniqlo.jpg',
 'rok,midi,flare,uniqlo,wanita,fashion'),

(2, 9, 'Kemeja Wanita Oxford Uniqlo', 299000,
 'Kemeja wanita bahan Oxford premium dari Uniqlo, cut slim namun nyaman, bisa dipakai formal maupun kasual, tersedia berbagai pilihan warna.',
 'kemeja-wanita-uniqlo.jpg',
 'kemeja,oxford,uniqlo,wanita,fashion,formal'),

(2, 9, 'Tunik Batik Modern Uniqlo', 259000,
 'Tunik batik motif modern dari Uniqlo kolaborasi dengan pengrajin lokal, bahan katun adem, cocok untuk tampilan kasual bertema budaya.',
 'tunik-batik.jpg',
 'tunik,batik,modern,uniqlo,wanita,fashion,indonesia');

-- ============================================================
--  PRODUK: MENS WEAR (product_cat = 3)
-- ============================================================
INSERT INTO `product` (`product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES

-- Zara (brand_id = 7)
(3, 7, 'Kemeja Pria Slim Fit Zara', 399000,
 'Kemeja slim fit premium dari Zara untuk pria modern, bahan cotton twill berkualitas tinggi, cocok untuk tampilan formal maupun smart casual.',
 'kemeja-pria-zara.jpg',
 'kemeja,slim,fit,zara,pria,fashion,formal'),

-- H&M (brand_id = 8)
(3, 8, 'Kaos Polo Pria H&M', 199000,
 'Kaos polo pria kasual dari H&M, bahan pique cotton breathable, pilihan warna bervariasi, cocok untuk kegiatan sehari-hari atau olahraga ringan.',
 'polo-hm.jpg',
 'polo,kaos,hm,pria,fashion,casual'),

(3, 8, 'Kemeja Flannel Pria H&M', 299000,
 'Kemeja flannel kotak-kotak klasik dari H&M, bahan brushed cotton tebal dan hangat, sempurna untuk gaya kasual musim dingin atau berkemah.',
 'flannel-hm.jpg',
 'kemeja,flannel,hm,pria,fashion,casual'),

-- Uniqlo (brand_id = 9)
(3, 9, 'Celana Chinos Slim Uniqlo', 449000,
 'Celana chinos slim fit dari Uniqlo dengan bahan stretch yang nyaman, desain bersih dan rapi, ideal untuk tampilan smart casual pria.',
 'chinos-uniqlo.jpg',
 'celana,chinos,slim,uniqlo,pria,fashion'),

(3, 9, 'Kaos Oversize Premium Uniqlo', 249000,
 'Kaos oversize pria dari Uniqlo, bahan supima cotton ultra-soft, potongan longgar trendi, tersedia dalam berbagai pilihan warna.',
 'kaos-uniqlo.jpg',
 'kaos,oversize,uniqlo,pria,fashion,casual'),

-- Nike (brand_id = 10)
(3, 10, 'Jaket Bomber Nike Air', 799000,
 'Jaket bomber pria dari Nike dengan desain sporty modern, bahan water-resistant ringan, dilengkapi logo Nike di dada untuk tampilan streetwear.',
 'jaket-bomber-nike.jpg',
 'jaket,bomber,nike,pria,fashion,sporty,outerwear'),

-- Adidas (brand_id = 11)
(3, 11, 'Hoodie Adidas Originals', 599000,
 'Hoodie fleece pria dari Adidas Originals, bahan cotton fleece tebal dan hangat, cocok untuk olahraga kasual maupun tampilan streetwear.',
 'hoodie-adidas.jpg',
 'hoodie,adidas,originals,pria,fashion,sporty'),

(3, 11, 'Celana Jogger Training Adidas', 499000,
 'Celana jogger pria dari Adidas dengan bahan French terry yang nyaman, elastic waistband, dan kantong samping, cocok untuk olahraga atau santai.',
 'jogger-adidas.jpg',
 'celana,jogger,adidas,pria,fashion,sporty,training');

-- ============================================================
--  SELESAI! Total: 8 brand baru + 27 produk baru
-- ============================================================
