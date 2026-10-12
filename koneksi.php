<?php
// Konfigurasi Database
$host = 'localhost';
$dbname = 'MyWeb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal atau terjadi kesalahan: " . $e->getMessage());
}
?>