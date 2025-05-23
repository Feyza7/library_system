<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php'; // Veritabanı bağlantısı

    // Kullanıcı giriş verileri al
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        // Form gönderildiğinde
        $("#registerForm").on("submit", function(e){
            e.preventDefault(); // Sayfa yenilenmesini engelle
            var username = $("#username").val();
            var email = $("#email").val();
            var password = $("#password").val();

            $.ajax({
                url: "register_process.php", // PHP dosyasına veri gönderilecek
                type: "POST",
                data: { username: username, email: email, password: password },
                success: function(response){
                    alert(response); // PHP'den gelen yanıtı göster
                    if(response === "Kayıt başarılı!") {
                        window.location.href = "login.php"; // Kayıt başarılıysa login sayfasına yönlendir
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
    <form id="registerForm">
        <h1>WELCOME TO LIBRARY SYSTEM<H1>
        <h2>Please Register</h2>
        <input type="text" id="username" name="username" placeholder="Username" required><br>
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
        <p><a href="login.php">Already have an account?</a></p>
    </form>
</body>
</html>
