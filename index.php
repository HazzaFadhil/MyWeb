<?php
// Koneksi Database
include 'koneksi.php';

// Mengambil data mata kuliah
$stmt = $pdo->prepare("SELECT * FROM mata_kuliah");
$stmt->execute();
$mata_kuliah = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include Layout Header & Sidebar
include 'layouts/header.php';
include 'layouts/sidebar.php';
?>

<!-- AREA KONTEN UTAMA -->
<div class="col-md-9 col-lg-10">

    <!-- JUDUL HALAMAN -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dashboard Utama</h1>
        <a href="mata-kuliah.php" class="btn btn-outline-primary">
            Kelola Mata Kuliah &rarr;
        </a>
    </div>

    <!-- CARD TABEL (SAMA PERSIS DENGAN FORMAT MATA-KULIAH) -->
    <div class="card">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Pratinjau Data Mata Kuliah</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Semester</th>
                        <th>Dosen ID</th>
                        <th>SKS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($mata_kuliah)): ?>
                        <?php foreach ($mata_kuliah as $mk): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($mk['kode']); ?></td>
                                <td><?php echo htmlspecialchars($mk['nama']); ?></td>
                                <td><?php echo htmlspecialchars($mk['semester']); ?></td>
                                <td><?php echo empty($mk['dosen_id']) ? "-" : htmlspecialchars($mk['dosen_id']); ?></td>
                                <td><?php echo empty($mk['sks']) ? "-" : htmlspecialchars($mk['sks']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-3">Tidak ada data mata kuliah.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div> <!-- Penutup col-md-9 -->

<?php 
// Include Footer
include 'layouts/footer.php'; 
?>