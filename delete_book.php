<?php
include('config.php'); // Veritabanı bağlantısını dahil et

if (isset($_GET['id'])) { // URL'den kitap id'si al
    $book_id = $_GET['id']; // id'yi al
    $sql = "DELETE FROM books WHERE id = $book_id"; // SQL sorgusu
    if (mysqli_query($conn, $sql)) { // Eğer sorgu başarılıysa
        header("Location: book_list.php"); // Liste sayfasına yönlendir
        exit(); // Yönlendirme yapıldıktan sonra işlemi sonlandır
    } else {
        echo "Error deleting record: " . mysqli_error($conn); // Hata mesajı
    }
} else {
    echo "No book ID provided."; // Eğer id yoksa hata mesajı
}
?>
