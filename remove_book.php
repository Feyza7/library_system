<?php
session_start();
include('config.php');

// Giriş yapılmış mı kontrol et
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

if (isset($_GET['book_id'])) {
    $book_id = (int) $_GET['book_id'];

    // Sadece ilgili kullanıcıya ait olan kitabı sil
    $stmt = $conn->prepare("DELETE FROM user_books WHERE user_id = ? AND book_id = ?");
    $stmt->bind_param("ii", $user_id, $book_id);
    $stmt->execute();
}

header("Location: dashboard.php");
exit();
