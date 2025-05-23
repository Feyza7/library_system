<?php
session_start();
include('config.php');

// Kullanıcının giriş yapıp yapmadığını ve geçerli book_id olup olmadığını kontrol et
if (isset($_GET['book_id']) && isset($_SESSION['user']['id'])) {
    $book_id = (int) $_GET['book_id'];
    $user_id = (int) $_SESSION['user']['id'];

    // Kitabın stok durumunu kontrol et
    $stmt = $conn->prepare("SELECT stock FROM books WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $stock_result = $stmt->get_result()->fetch_assoc();

    if (!$stock_result) {
        echo "<script>
                alert('This book does not exist.');
                window.location.href = 'dashboard.php'; // önceki sayfaya geri dön
              </script>";
        exit;
    } elseif ($stock_result['stock'] <= 0) {
        echo "<script>
                alert('Sorry, this book is out of stock.');
                window.location.href = 'dashboard.php'; // önceki sayfaya geri dön
              </script>";
        exit;
    }

    // Kullanıcının zaten kaç kitabı olduğunu kontrol et (limit 3)
    $stmt = $conn->prepare("SELECT COUNT(*) as book_count FROM user_books WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $count_result = $stmt->get_result()->fetch_assoc();
    if ($count_result['book_count'] >= 3) {
        // 3 kitaptan fazla alamaz
        echo "<script>
                alert('You cannot borrow more than 3 books.');
                window.location.href = 'dashboard.php'; // önceki sayfaya geri dön
              </script>";
        exit;
    }

    // Kullanıcı zaten bu kitabı eklemiş mi kontrol et
    $stmt = $conn->prepare("SELECT * FROM user_books WHERE user_id = ? AND book_id = ?");
    $stmt->bind_param("ii", $user_id, $book_id);
    $stmt->execute();
    $already_added = $stmt->get_result();

    if ($already_added->num_rows === 0) {
        // Transaction başlat (stok güncelleme ve ekleme beraber olacak)
        $conn->begin_transaction();

        try {
            // Kitabı ekle
            $insert = $conn->prepare("INSERT INTO user_books (user_id, book_id) VALUES (?, ?)");
            $insert->bind_param("ii", $user_id, $book_id);
            $insert->execute();

            // Stoğu 1 azalt
            $update = $conn->prepare("UPDATE books SET stock = stock - 1 WHERE id = ?");
            $update->bind_param("i", $book_id);
            $update->execute();

            $conn->commit();

            header("Location: dashboard.php");
            exit();
        } catch (Exception $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
            exit;
        }
    } else {
        echo "<script>
                alert('You already borrowed this book.');
                window.location.href = 'dashboard.php'; // önceki sayfaya geri dön
              </script>";
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
