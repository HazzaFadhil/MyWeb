<?php
// Mengambil nama file halaman yang sedang diakses
$page = basename($_SERVER['PHP_SELF']);
?>

<!-- SIDEBAR -->
<div class="col-md-3 col-lg-2 mb-4">
    <div class="list-group">
        <a href="index.php" class="list-group-item list-group-item-action <?php echo ($page == 'index.php') ? 'active' : ''; ?>">
            Home
        </a>
        <a href="mata-kuliah.php" class="list-group-item list-group-item-action <?php echo ($page == 'mata-kuliah.php') ? 'active' : ''; ?>">
            Mata Kuliah
        </a>
    </div>
</div>