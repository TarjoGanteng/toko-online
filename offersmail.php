<?php
session_start();
include "db.php";

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'>Email tidak valid!</div>";
        exit();
    }

    // Cek apakah sudah subscribe
    $check = "SELECT * FROM newsletter WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $check);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<div class='alert alert-info'>Email Anda sudah terdaftar!</div>";
    } else {
        $sql = "INSERT INTO newsletter (email, created_at) VALUES ('$email', NOW())";
        if (mysqli_query($con, $sql)) {
            echo "<div class='alert alert-success'><i class='fa fa-check'></i> Terima kasih! Anda berhasil subscribe.</div>";
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan, coba lagi!</div>";
        }
    }
}
?>
