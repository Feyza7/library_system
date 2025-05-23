<?php
session_start();
session_unset(); // Oturumdaki tüm verileri temizle
session_destroy(); // Oturumu sonlandır
header("Location: login.php"); // Giriş sayfasına yönlendir
exit;
