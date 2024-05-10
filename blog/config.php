<?php
define('DB_HOST', 'localhost'); // Veritabanı sunucu adresi
define('DB_NAME', 'blog'); // Veritabanı adı
define('DB_USER', 'root'); // Veritabanı kullanıcı adı
define('DB_PASS', ''); // Veritabanı şifresi
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    die("Veritabanına bağlanılamadı: " . $e->getMessage());
}
?>
