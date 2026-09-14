<?php
session_start();
include "db.php";

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password_1'])) {
    $first_name = mysqli_real_escape_string($con, $_POST['username']);
    $email      = mysqli_real_escape_string($con, $_POST['email']);
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    // Validasi input
    if (empty($first_name)) { echo "<div class='alert alert-danger'>Username harus diisi!</div>"; exit(); }
    if (empty($email))       { echo "<div class='alert alert-danger'>Email harus diisi!</div>"; exit(); }
    if (empty($password_1))  { echo "<div class='alert alert-danger'>Password harus diisi!</div>"; exit(); }
    if ($password_1 !== $password_2) { echo "<div class='alert alert-danger'>Konfirmasi password tidak cocok!</div>"; exit(); }

    // Cek email sudah terdaftar
    $check  = "SELECT * FROM user_info WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $check);
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<div class='alert alert-danger'>Email sudah terdaftar!</div>";
        exit();
    }

    // Simpan user baru ke tabel user_info
    $password_hashed = md5($password_1);
    $sql = "INSERT INTO user_info (first_name, email, password) VALUES ('$first_name', '$email', '$password_hashed')";
    if (mysqli_query($con, $sql)) {
        $new_id = mysqli_insert_id($con);
        $_SESSION['uid']        = $new_id;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['email']      = $email;
        echo "register_success";
    } else {
        echo "<div class='alert alert-danger'>Registrasi gagal! " . mysqli_error($con) . "</div>";
    }
}
?>
