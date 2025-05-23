<?php
include 'config.php';

$query = "SELECT * FROM books";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book List</title>
    <link rel="stylesheet" href="book_list.css?v=1.0.">


</head>
<body>
<p><a href="dashboard.php" id="back_list">Back to your List</a></p>
<h2>Library Book List:</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Category</th>
            <th>Action</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['title']); ?></td>
            <td><?= htmlspecialchars($row['author']); ?></td>
            <td><?= $row['year']; ?></td>
            <td><?= htmlspecialchars($row['category']); ?></td>
            <td><a href="add_to_dashboard.php?book_id=<?= $row['id'] ?>">Add</a></td>
            <td><?= htmlspecialchars($row['stock']); ?></td>
        </tr>
    <?php endwhile; ?>
</tbody>

</table>

</body>
</html>
