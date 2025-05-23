<?php
session_start();
include 'config.php';

// Giriş kontrolü
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

// Kullanıcı bilgilerini al
$user = $_SESSION['user'];
$user_id = $user['id']; 

// Seçilen kitapları çek
$sql = "SELECT books.* FROM books
        INNER JOIN user_books ON books.id = user_books.book_id
        WHERE user_books.user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css?v=1.0.2">
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($user['username']) ?>!</h2> <!-- username'ı yaz -->
    <a href="logout.php" id="logout" >Logout</a>
    <p><a href="book_list.php" id="list">Borrow a Book</a></p>

    <h2>Your Selected Books:</h2>
    <table border='1'>
        <tr><th>Title</th><th>Author</th><th>Year</th><th>Category</th><th>Action</th></tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['author']) ?></td>
                <td><?= htmlspecialchars($row['year']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><a href="remove_book.php?book_id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to remove this book?');">Remove</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
