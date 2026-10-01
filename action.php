<?php
session_start();
include "db.php";

// ============================================================
//  CATEGORY — Ambil semua kategori untuk sidebar shop
// ============================================================
if (isset($_POST['category'])) {
    $sql    = "SELECT * FROM category";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<ul id="get_category">';
        while ($row = mysqli_fetch_assoc($result)) {
            $name = !empty($row['cat_name']) ? $row['cat_name'] : $row['cat_title'];
            echo '<li>
                    <a href="#" class="category" cid="' . $row['cat_id'] . '">
                        <i class="fa fa-angle-right"></i> ' . htmlspecialchars($name) . '
                    </a>
                  </li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Belum ada kategori.</p>';
    }
}

// ============================================================
//  BRAND — Ambil semua brand untuk sidebar
// ============================================================
if (isset($_POST['brand'])) {
    $sql    = "SELECT * FROM brand";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = !empty($row['brand_title']) ? $row['brand_title'] : ($row['brand_name'] ?? '');
            echo '<div class="form-check">
                    <label class="form-check-label">
                        <a href="#" class="selectBrand" bid="' . $row['brand_id'] . '">' . htmlspecialchars($name) . '</a>
                    </label>
                  </div>';
        }
    } else {
        echo '<p>Belum ada brand.</p>';
    }
}

// ============================================================
//  GET ALL PRODUCTS
// ============================================================
if (isset($_POST['getProduct'])) {
    $limit  = 8;
    $page   = isset($_POST['pageNumber']) ? (int)$_POST['pageNumber'] : 1;
    $start  = ($page - 1) * $limit;
    $sql    = "SELECT p.*, c.cat_title, c.cat_name, b.brand_title
               FROM product p
               LEFT JOIN category c ON p.product_cat = c.cat_id
               LEFT JOIN brand b ON p.product_brand = b.brand_id
               LIMIT $start, $limit";
    $result = mysqli_query($con, $sql);
    renderProducts($result);
}

// ============================================================
//  GET PRODUCTS BY CATEGORY (filter)
// ============================================================
if (isset($_POST['get_seleted_Category'])) {
    $cat_id = (int)$_POST['cat_id'];
    $sql    = "SELECT p.*, c.cat_title, c.cat_name, b.brand_title
               FROM product p
               LEFT JOIN category c ON p.product_cat = c.cat_id
               LEFT JOIN brand b ON p.product_brand = b.brand_id
               WHERE p.product_cat = '$cat_id'";
    $result = mysqli_query($con, $sql);
    renderProducts($result);
}

// ============================================================
//  GET PRODUCTS BY BRAND (filter)
// ============================================================
if (isset($_POST['selectBrand'])) {
    $brand_id = (int)$_POST['brand_id'];
    $sql      = "SELECT p.*, c.cat_title, c.cat_name, b.brand_title
                 FROM product p
                 LEFT JOIN category c ON p.product_cat = c.cat_id
                 LEFT JOIN brand b ON p.product_brand = b.brand_id
                 WHERE p.product_brand = '$brand_id'";
    $result = mysqli_query($con, $sql);
    renderProducts($result);
}

// ============================================================
//  SEARCH PRODUCT
// ============================================================
if (isset($_POST['search'])) {
    $keyword = mysqli_real_escape_string($con, $_POST['keyword']);
    $cat_id  = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0;

    if ($cat_id > 0) {
        $sql = "SELECT p.*, c.cat_title, c.cat_name, b.brand_title
                FROM product p
                LEFT JOIN category c ON p.product_cat = c.cat_id
                LEFT JOIN brand b ON p.product_brand = b.brand_id
                WHERE p.product_cat = '$cat_id'
                  AND (p.product_title LIKE '%$keyword%' OR p.product_keywords LIKE '%$keyword%')";
    } else {
        $sql = "SELECT p.*, c.cat_title, c.cat_name, b.brand_title
                FROM product p
                LEFT JOIN category c ON p.product_cat = c.cat_id
                LEFT JOIN brand b ON p.product_brand = b.brand_id
                WHERE p.product_title LIKE '%$keyword%' OR p.product_keywords LIKE '%$keyword%'";
    }
    $result = mysqli_query($con, $sql);
    renderProducts($result);
}

// ============================================================
//  ADD TO CART
// ============================================================
if (isset($_POST['addToCart'])) {
    if (!isset($_SESSION['uid'])) {
        $_SESSION['cart_login'] = 1;
        echo "<div class='alert alert-warning'>Silakan <strong>login</strong> terlebih dahulu!</div>";
        exit();
    }
    $user_id = $_SESSION['uid'];
    $pro_id  = (int)$_POST['proId'];

    // Cek apakah produk sudah ada di cart (kolom p_id)
    $check = "SELECT * FROM cart WHERE user_id='$user_id' AND p_id='$pro_id' LIMIT 1";
    $result = mysqli_query($con, $check);
    if ($result && mysqli_num_rows($result) > 0) {
        $update = "UPDATE cart SET qty = qty + 1 WHERE user_id='$user_id' AND p_id='$pro_id'";
        mysqli_query($con, $update);
        echo "<div class='alert alert-info'>Jumlah produk diperbarui di keranjang!</div>";
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
        $insert = "INSERT INTO cart (p_id, ip_add, user_id, qty) VALUES ('$pro_id', '$ip', '$user_id', 1)";
        mysqli_query($con, $insert);
        echo "<div class='alert alert-success'>Produk berhasil ditambahkan ke keranjang!</div>";
    }
}

// ============================================================
//  COUNT CART ITEMS
// ============================================================
if (isset($_POST['count_item'])) {
    if (isset($_SESSION['uid'])) {
        $user_id = $_SESSION['uid'];
        $sql     = "SELECT SUM(qty) as total FROM cart WHERE user_id='$user_id'";
        $result  = mysqli_query($con, $sql);
        $row     = mysqli_fetch_assoc($result);
        echo $row['total'] ? $row['total'] : 0;
    } else {
        echo 0;
    }
}

// ============================================================
//  COMMON: GET CART ITEM (dropdown) + CHECKOUT DETAILS
// ============================================================
if (isset($_POST['Common'])) {
    if (isset($_POST['getCartItem'])) {
        if (isset($_SESSION['uid'])) {
            $user_id = $_SESSION['uid'];
            $sql     = "SELECT c.id as cart_id, c.qty, p.product_id, p.product_title, p.product_price, p.product_image
                        FROM cart c
                        JOIN product p ON c.p_id = p.product_id
                        WHERE c.user_id = '$user_id'";
            $result  = mysqli_query($con, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product-widget">
                            <div class="product-img">
                                <img src="img/' . htmlspecialchars($row['product_image']) . '" alt="' . htmlspecialchars($row['product_title']) . '" style="width:60px;">
                            </div>
                            <div class="product-body">
                                <h3 class="product-name">' . htmlspecialchars($row['product_title']) . '</h3>
                                <h4 class="product-price">
                                    <span>' . $row['qty'] . 'x</span>
                                    Rp ' . number_format($row['product_price'], 0, ',', '.') . '
                                </h4>
                            </div>
                            <button class="delete"><i class="fa fa-close"></i></button>
                          </div>';
                }
            } else {
                echo '<p style="padding:10px;">Keranjang kosong.</p>';
            }
        } else {
            echo '<p style="padding:10px;">Silakan login untuk melihat keranjang.</p>';
        }
    }

    if (isset($_POST['checkOutDetails'])) {
        if (isset($_SESSION['uid'])) {
            $user_id = $_SESSION['uid'];
            $sql     = "SELECT c.id as cart_id, c.qty, p.product_id, p.product_title, p.product_price, p.product_image
                        FROM cart c
                        JOIN product p ON c.p_id = p.product_id
                        WHERE c.user_id = '$user_id'";
            $result  = mysqli_query($con, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $subtotal = $row['product_price'] * $row['qty'];
                    $img_src  = !empty($row['product_image']) ? 'img/' . htmlspecialchars($row['product_image']) : 'img/no-image.png';
                    echo '<tr>
                            <td>
                                <div class="cart-product-wrap">
                                    <img src="' . $img_src . '" alt="' . htmlspecialchars($row['product_title']) . '" onerror="this.src=\'img/no-image.png\'">
                                    <span class="cart-product-name">' . htmlspecialchars($row['product_title']) . '</span>
                                </div>
                            </td>
                            <td style="font-weight:600; color:#1d1d1f;">Rp ' . number_format($row['product_price'], 0, ',', '.') . '</td>
                            <td>
                                <input class="qty-input qty" type="number" value="' . $row['qty'] . '" min="1">
                                <input type="hidden" class="price" value="' . $row['product_price'] . '">
                                <input type="hidden" class="total" value="' . $subtotal . '">
                            </td>
                            <td style="font-weight:700; color:#1d1d1f;">
                                Rp <span class="row-total">' . number_format($subtotal, 0, ',', '.') . '</span>
                            </td>
                            <td>
                                <div class="cart-action-btns">
                                    <button class="btn-delete remove" remove_id="' . $row['cart_id'] . '" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button class="btn-update update" update_id="' . $row['cart_id'] . '" title="Update">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                            </td>
                          </tr>';
                }
            } else {
                echo '<tr><td colspan="5" style="text-align:center;">Keranjang kosong.</td></tr>';
            }
        } else {
            echo '<tr><td colspan="5" style="text-align:center;">Silakan login terlebih dahulu.</td></tr>';
        }
    }
}

// ============================================================
//  REMOVE ITEM FROM CART
// ============================================================
if (isset($_POST['removeItemFromCart'])) {
    $rid = (int)$_POST['rid'];
    $sql = "DELETE FROM cart WHERE id='$rid'";
    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success'>Produk berhasil dihapus dari keranjang!</div>";
    } else {
        echo "<div class='alert alert-danger'>Gagal menghapus produk!</div>";
    }
}

// ============================================================
//  UPDATE CART ITEM QTY
// ============================================================
if (isset($_POST['updateCartItem'])) {
    $update_id = (int)$_POST['update_id'];
    $qty       = (int)$_POST['qty'];
    if ($qty < 1) $qty = 1;
    $sql = "UPDATE cart SET qty='$qty' WHERE id='$update_id'";
    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success'>Jumlah produk diperbarui!</div>";
    } else {
        echo "<div class='alert alert-danger'>Gagal memperbarui!</div>";
    }
}

// ============================================================
//  PAGINATION
// ============================================================
if (isset($_POST['page'])) {
    $limit       = 8;
    $sql         = "SELECT COUNT(*) as total FROM product";
    $result      = mysqli_query($con, $sql);
    $row         = mysqli_fetch_assoc($result);
    $total_pages = ceil($row['total'] / $limit);
    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<li><a href="#" id="page" page="' . $i . '">' . $i . '</a></li>';
    }
}

// ============================================================
//  HELPER: Render product cards
// ============================================================
function renderProducts($result) {
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $img      = !empty($row['product_image']) ? 'img/' . htmlspecialchars($row['product_image']) : 'img/no-image.png';
            $cat_name = !empty($row['cat_name']) ? $row['cat_name'] : ($row['cat_title'] ?? '');
            $pro_id   = $row['product_id'];
            echo '
            <div class="col-md-3 col-xs-6">
                <div class="product">
                    <div class="product-img">
                        <img src="' . $img . '" alt="' . htmlspecialchars($row['product_title']) . '" onerror="this.onerror=null;this.src=\'img/no-image.png\'" style="width:100%; height:200px; object-fit:cover;">
                        <div class="product-label">
                            <span class="new">NEW</span>
                        </div>
                    </div>
                    <div class="product-body">
                        <p class="product-category">' . htmlspecialchars($cat_name) . '</p>
                        <h3 class="product-name">' . htmlspecialchars($row['product_title']) . '</h3>
                        <h4 class="product-price">Rp ' . number_format($row['product_price'], 0, ',', '.') . '</h4>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>
                    <div class="add-to-cart">
                        <button id="product" pid="' . $pro_id . '" class="add-to-cart-btn">
                            <i class="fa fa-shopping-cart"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo '<div class="col-md-12"><p class="text-center">Produk tidak ditemukan.</p></div>';
    }
}
?>
