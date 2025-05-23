<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $hashed_password = hash('sha256', $password);

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user;
        $_SESSION['user_id'] = $user['id']; // Gerekirse ID'yi ayrıca kaydet
        header("Location: dashboard.php");
        exit(); // Bu çok önemli!
    } else {
        echo "E-posta veya şifre yanlış!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        // Form gönderildiğinde
        $("#loginForm").on("submit", function(e){
            e.preventDefault(); // Sayfa yenilenmesini engelle
            var email = $("#email").val();
            var password = $("#password").val();

            $.ajax({
                url: "login_process.php", // PHP dosyasına veri gönderilecek
                type: "POST",
                data: { email: email, password: password },
                success: function(response){
                    if(response === "Login successful!") {
                        window.location.href = "dashboard.php"; // Giriş başarılıysa dashboard'a yönlendir
                    } else {
                        alert(response); // Hata mesajını göster
                    }
                },
                error: function(){
                    alert("Bir hata oluştu!");
                }
            });
        });
    });
    </script>
</head>
<body>
    <form id="loginForm">
        <h2>Login</h2>
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
        <p><a href="register.php">Don't have an account?</a></p>
    </form>
</body>
</html>


