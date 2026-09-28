<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include "db.php";
header("Content-Type: application/json");

if (!isset($_SESSION["uid"])) {
    echo json_encode(["success"=>false,"msg"=>"Login diperlukan"]);
    exit();
}

$uid = (int)$_SESSION["uid"];

// Validasi input
$fname   = mysqli_real_escape_string($con, trim($_POST["fname"] ?? ""));
$lname   = mysqli_real_escape_string($con, trim($_POST["lname"] ?? ""));
$email   = mysqli_real_escape_string($con, trim($_POST["email"] ?? ""));
$phone   = mysqli_real_escape_string($con, trim($_POST["phone"] ?? ""));
$address = mysqli_real_escape_string($con, trim($_POST["address"] ?? ""));
$city    = mysqli_real_escape_string($con, trim($_POST["city"] ?? ""));
$postal  = mysqli_real_escape_string($con, trim($_POST["postal"] ?? ""));
$payment = mysqli_real_escape_string($con, $_POST["payment"] ?? "transfer");

if (!$fname || !$email || !$phone || !$address || !$city) {
    echo json_encode(["success"=>false,"msg"=>"Lengkapi semua field yang wajib diisi"]);
    exit();
}

// Ambil item keranjang
$res = mysqli_query($con, "SELECT c.qty, p.product_id, p.product_title, p.product_price
                           FROM cart c JOIN product p ON c.p_id = p.product_id
                           WHERE c.user_id = \"$uid\"");
$items = [];
$grand = 0;
while ($r = mysqli_fetch_assoc($res)) {
    $r["sub"] = $r["product_price"] * $r["qty"];
    $grand += $r["sub"];
    $items[] = $r;
}

if (empty($items)) {
    echo json_encode(["success"=>false,"msg"=>"Keranjang kosong"]);
    exit();
}

// Simpan ke tabel orders
$sql_order = "INSERT INTO orders (user_id,fname,lname,email,phone,address,city,postal,payment_method,total_amount,status)
              VALUES (\"$uid\",\"$fname\",\"$lname\",\"$email\",\"$phone\",\"$address\",\"$city\",\"$postal\",\"$payment\",$grand,\"pending\")";
mysqli_query($con, $sql_order);
$order_id = mysqli_insert_id($con);

// Simpan order_items
foreach ($items as $item) {
    $pid   = (int)$item["product_id"];
    $title = mysqli_real_escape_string($con, $item["product_title"]);
    $price = (int)$item["product_price"];
    $qty   = (int)$item["qty"];
    $sub   = (int)$item["sub"];
    mysqli_query($con, "INSERT INTO order_items (order_id,product_id,product_title,product_price,qty,subtotal)
                        VALUES ($order_id,$pid,\"$title\",$price,$qty,$sub)");
}

// Kosongkan keranjang user
mysqli_query($con, "DELETE FROM cart WHERE user_id=\"$uid\"");

echo json_encode(["success"=>true,"order_id"=>$order_id,"msg"=>"Pesanan berhasil dibuat"]);

