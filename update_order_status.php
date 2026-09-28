<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include "db.php";
header("Content-Type: application/json");

if (!isset($_SESSION["uid"])) {
    echo json_encode(["success"=>false]);
    exit();
}

$uid      = (int)$_SESSION["uid"];
$order_id = (int)($_POST["order_id"] ?? 0);
$status   = $_POST["status"] ?? "";

$allowed = ["pending","processing","shipped","delivered","cancelled"];
if (!$order_id || !in_array($status, $allowed)) {
    echo json_encode(["success"=>false,"msg"=>"Invalid"]);
    exit();
}

// Pastikan order milik user ini
$check = mysqli_query($con, "SELECT order_id FROM orders WHERE order_id=$order_id AND user_id=$uid LIMIT 1");
if (!mysqli_fetch_assoc($check)) {
    echo json_encode(["success"=>false,"msg"=>"Unauthorized"]);
    exit();
}

$esc = mysqli_real_escape_string($con, $status);
mysqli_query($con, "UPDATE orders SET status=\"$esc\" WHERE order_id=$order_id");
echo json_encode(["success"=>true]);

