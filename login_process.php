<?php
session_start();
include 'config.php'; // Veritabanı bağlantısını dahil et

// Formdan gelen verileri al
$email = $_POST['email'];
$password = $_POST['password'];

// Şifreyi SHA256 ile şifrele
$hashed_password = hash('sha256', $password);

// Veritabanında kullanıcıyı kontrol et
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$hashed_password'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $_SESSION['user'] = mysqli_fetch_assoc($result); // Kullanıcıyı oturuma kaydet
    echo "Login successful!";
} else {
    echo "E-posta veya şifre yanlış!";
}
?>
