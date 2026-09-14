<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Online Shop — Temukan produk terbaik dengan harga terjangkau. Elektronik, Fashion, Olahraga, dan banyak lagi.">

    <title>Online Shop — Belanja Produk Terbaik</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

    <!-- noUiSlider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Main Stylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
</head>
<body>

<!-- ============================================================
     TOP ANNOUNCEMENT BAR
============================================================ -->
<div id="top-header">
    <div class="container">
        <ul class="header-links pull-right">
            <li>
                <a href="#"><i class="fa fa-inr"></i> IDR</a>
            </li>
            <li>
                <?php
                include "db.php";
                if (isset($_SESSION["uid"])) {
                    $sql   = "SELECT first_name FROM user_info WHERE user_id='$_SESSION[uid]'";
                    $query = mysqli_query($con, $sql);
                    $row   = mysqli_fetch_array($query);
                    echo '
                    <div class="dropdownn">
                        <a href="#" class="dropdownn">
                            <i class="fa fa-user-o"></i> Hi, ' . htmlspecialchars($row["first_name"]) . '
                        </a>
                        <div class="dropdownn-content">
                            <a href="" data-toggle="modal" data-target="#profile">
                                <i class="fa fa-user-circle"></i> My Profile
                            </a>
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i> Log Out
                            </a>
                        </div>
                    </div>';
                } else {
                    echo '
                    <div class="dropdownn">
                        <a href="#" class="dropdownn">
                            <i class="fa fa-user-o"></i> My Account
                        </a>
                        <div class="dropdownn-content">
                            <a href="" data-toggle="modal" data-target="#Modal_login">
                                <i class="fa fa-sign-in"></i> Login
                            </a>
                            <a href="" data-toggle="modal" data-target="#Modal_register">
                                <i class="fa fa-user-plus"></i> Register
                            </a>
                        </div>
                    </div>';
                }
                ?>
            </li>
        </ul>
    </div>
</div>

<!-- ============================================================
     MAIN HEADER — GLASSMORPHISM NAVBAR
============================================================ -->
<div id="header">
    <div class="container">
        <div class="row" style="display:flex; align-items:center; justify-content:space-between; height:52px; flex-wrap:nowrap;">

            <!-- LOGO -->
            <div class="header-logo" style="flex-shrink:0;">
                <a href="index.php" class="logo" style="display:flex; align-items:center; gap:10px; text-decoration:none;">

                    <!-- SVG Logo Icon -->
                    <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink:0;">
                        <defs>
                            <linearGradient id="logoGrad" x1="0" y1="0" x2="38" y2="38" gradientUnits="userSpaceOnUse">
                                <stop offset="0%"   stop-color="#0a1f44"/>
                                <stop offset="100%" stop-color="#0071e3"/>
                            </linearGradient>
                            <linearGradient id="shineGrad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%"   stop-color="#ffffff" stop-opacity="0.2"/>
                                <stop offset="100%" stop-color="#ffffff" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                        <!-- Background rounded square -->
                        <rect width="38" height="38" rx="10" fill="url(#logoGrad)"/>
                        <!-- Shine overlay top half -->
                        <rect width="38" height="19" rx="10" fill="url(#shineGrad)"/>
                        <!-- Shopping bag: trapezoid body -->
                        <path d="M10.5 17h17l-2 11H12.5L10.5 17z" fill="white" fill-opacity="0.95"/>
                        <!-- Shopping bag: top rim bar -->
                        <rect x="9.5" y="15.5" width="19" height="2.5" rx="1.25" fill="white" fill-opacity="0.7"/>
                        <!-- Shopping bag: U-shape handle -->
                        <path d="M15 15.5 C15 11.5, 23 11.5, 23 15.5" stroke="white" stroke-width="2" stroke-linecap="round" fill="none"/>
                        <!-- Gold star / sparkle on bag -->
                        <circle cx="19" cy="22.5" r="2" fill="#FFD60A" fill-opacity="0.9"/>
                    </svg>

                    <!-- Wordmark with gradient text -->
                    <span style="
                        font-size: 19px;
                        font-weight: 800;
                        letter-spacing: -0.03em;
                        background: linear-gradient(135deg, #0a1f44 0%, #0071e3 100%);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        background-clip: text;
                        line-height: 1;
                    ">Online<span style="
                        background: linear-gradient(135deg, #0071e3 0%, #34aadc 100%);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        background-clip: text;
                    ">Shop</span></span>

                </a>
            </div>

            <!-- SEARCH BAR -->
            <div class="header-search" style="flex:1; max-width:420px; margin:0 24px;">
                <form onsubmit="return false;">
                    <i class="fa fa-search" style="color:var(--text-secondary); font-size:14px;"></i>
                    <select class="input-select" id="search-category">
                        <option value="0">Semua</option>
                        <option value="1">Elektronik</option>
                        <option value="2">Fashion Wanita</option>
                        <option value="3">Fashion Pria</option>
                        <option value="4">Olahraga</option>
                        <option value="5">Rumah & Dapur</option>
                        <option value="6">Buku</option>
                    </select>
                    <input class="input" id="search" type="text" placeholder="Cari produk...">
                    <button type="submit" id="search_btn" class="search-btn">Cari</button>
                </form>
            </div>

            <!-- HEADER RIGHT -->
            <div class="header-ctn" style="flex-shrink:0; display:flex; align-items:center; gap:4px;">

                <!-- Cart Dropdown -->
                <div class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="display:flex; align-items:center; gap:6px;">
                        <i class="fa fa-shopping-bag"></i>
                        <span style="font-size:14px; font-weight:500;">Keranjang</span>
                        <div class="badge qty" id="cart-count">0</div>
                    </a>
                    <div class="cart-dropdown">
                        <div class="cart-list" id="cart_product">
                            <div class="empty-state" style="padding:32px 0;">
                                <i class="fa fa-shopping-cart"></i>
                                <p>Keranjang kosong</p>
                            </div>
                        </div>
                        <div class="cart-btns">
                            <a href="cart.php"><i class="fa fa-edit"></i> Lihat Keranjang</a>
                        </div>
                    </div>
                </div>

                <!-- Menu Toggle (mobile) -->
                <div class="menu-toggle">
                    <a href="#" style="padding:7px 10px; color:var(--text-primary);">
                        <i class="fa fa-bars" style="font-size:18px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     NAVIGATION — CATEGORY BAR
============================================================ -->
<nav id="navigation">
    <div class="container" id="get_category_home">
        <!-- Filled by AJAX homeaction.php -->
    </div>
</nav>

<!-- ============================================================
     MODALS — LOGIN
============================================================ -->
<div class="modal fade" id="Modal_login" role="dialog">
    <div class="modal-dialog" style="max-width:420px; margin:60px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="font-size:22px;">&times;</button>
            </div>
            <div class="modal-body">
                <?php include "login_form.php"; ?>
            </div>
        </div>
    </div>
</div>

<!-- MODALS — REGISTER -->
<div class="modal fade" id="Modal_register" role="dialog">
    <div class="modal-dialog" style="max-width:480px; margin:60px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="font-size:22px;">&times;</button>
            </div>
            <div class="modal-body">
                <?php include "register_form.php"; ?>
            </div>
        </div>
    </div>
</div>