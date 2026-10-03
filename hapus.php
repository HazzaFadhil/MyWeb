<?php
// Koneksi ke database
$pdo = new PDO("mysql:host=localhost;dbname=nama_database", "username", "password");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['drop_table'])) {
    try {
        // Matikan FK check sementara untuk menghindari error jika tabel terhubung ke tabel lain (seperti KRS)
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");
        
        // Query untuk menghapus tabel secara permanen
        $pdo->exec("DROP TABLE IF EXISTS mata_kuliah;");
        
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

        echo "Tabel mata_kuliah berhasil dihapus!";
    } catch (PDOException $e) {
        echo "Gagal menghapus tabel: " . $e->getMessage();
    }
}
?>