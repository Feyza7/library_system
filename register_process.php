<?php
include 'config.php'; // Veritabanı bağlantısını dahil et

// Formdan gelen verileri al
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Şifreyi SHA256 ile şifrele
$hashed_password = hash('sha256', $password);

// Veritabanına kaydetme
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
if (mysqli_query($conn, $sql)) {
    echo "Kayıt başarılı!";
} else {
    echo "Hata: " . mysqli_error($conn);
}
?>
