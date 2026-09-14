<?php
session_start();
include "db.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email    = mysqli_real_escape_string($con, $_POST['email']);
    $password = md5(mysqli_real_escape_string($con, $_POST['password']));

    if (empty($email)) {
        echo "Email harus diisi!";
        exit();
    }
    if (empty($_POST['password'])) {
        echo "Password harus diisi!";
        exit();
    }

    // Coba login via tabel user_info
    $sql    = "SELECT * FROM user_info WHERE email='$email' AND password='$password' LIMIT 1";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['uid']        = $row['user_id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['email']      = $row['email'];

        if (isset($_SESSION['cart_login'])) {
            unset($_SESSION['cart_login']);
            echo "cart_login";
        } else {
            echo "login_success";
        }
    } else {
        echo "<div class='alert alert-danger' style='margin:0;'>Email atau password salah!</div>";
    }
}
?>
