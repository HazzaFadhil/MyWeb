<?php
// Koneksi Database
include 'koneksi.php';

// ===============================
// PROSES TAMBAH DATA
// ===============================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'tambah') {
    $kode     = $_POST['kode'];
    $nama     = $_POST['nama'];
    $semester = $_POST['semester'];
    $dosen_id = $_POST['dosen_id'];
    $sks      = $_POST['sks'];

    $sql = "INSERT INTO mata_kuliah (kode, nama, semester, dosen_id, sks)
            VALUES (:kode, :nama, :semester, :dosen_id, :sks)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':kode'     => $kode,
        ':nama'     => $nama,
        ':semester' => $semester,
        ':dosen_id' => $dosen_id,
        ':sks'      => $sks
    ]);

    header("Location: mata-kuliah.php");
    exit;
}

// ===============================
// PROSES HAPUS DATA
// ===============================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'hapus') {
    $kode = $_POST['kode'];

    $sql  = "DELETE FROM mata_kuliah WHERE kode = :kode";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':kode' => $kode]);

    header("Location: mata-kuliah.php");
    exit;
}

// ===============================
// PROSES UBAH DATA
// ===============================
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'ubah') {
    $kode_lama = $_POST['kode_lama'];
    $kode      = $_POST['kode'];
    $nama      = $_POST['nama'];
    $semester  = $_POST['semester'];
    $dosen_id  = $_POST['dosen_id'];
    $sks       = $_POST['sks'];

    $sql = "UPDATE mata_kuliah
            SET kode = :kode,
                nama = :nama,
                semester = :semester,
                dosen_id = :dosen_id,
                sks = :sks
            WHERE kode = :kode_lama";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':kode'      => $kode,
        ':nama'      => $nama,
        ':semester'  => $semester,
        ':dosen_id'  => $dosen_id,
        ':sks'       => $sks,
        ':kode_lama' => $kode_lama
    ]);

    header("Location: mata-kuliah.php");
    exit;
}

// Mengambil data
$stmt = $pdo->prepare("SELECT * FROM mata_kuliah");
$stmt->execute();
$mata_kuliah = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include Layout
include 'layouts/header.php';
include 'layouts/sidebar.php';
?>

<!-- AREA KONTEN UTAMA -->
<div class="col-md-9 col-lg-10">

    <!-- JUDUL DAN TOMBOL -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Mata Kuliah</h1>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMataKuliah">
                + Tambah Mata Kuliah
            </button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusMataKuliah">
                Hapus Mata Kuliah
            </button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahMataKuliah">
                Ubah Mata Kuliah
            </button>
        </div>
    </div>

    <!-- CARD TABEL -->
    <div class="card">
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


<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahMataKuliah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mata Kuliah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="tambah">
                    <div class="mb-3">
                        <label class="form-label">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <input type="number" class="form-control" name="semester" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosen ID</label>
                        <input type="number" class="form-control" name="dosen_id">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SKS</label>
                        <input type="number" class="form-control" name="sks">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL HAPUS -->
<div class="modal fade" id="hapusMataKuliah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Mata Kuliah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="hapus">
                    <div class="mb-3">
                        <label class="form-label">Pilih Kode Mata Kuliah</label>
                        <select class="form-select" name="kode" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <?php foreach ($mata_kuliah as $mk): ?>
                                <option value="<?php echo htmlspecialchars($mk['kode']); ?>">
                                    <?php echo htmlspecialchars($mk['kode']) . ' - ' . htmlspecialchars($mk['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="alert alert-warning">
                        Data yang sudah dihapus tidak dapat dikembalikan.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL UBAH -->
<div class="modal fade" id="ubahMataKuliah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Mata Kuliah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="ubah">
                    <div class="mb-3">
                        <label class="form-label">Pilih Mata Kuliah</label>
                        <select id="pilihMataKuliah" class="form-select" name="kode_lama" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <?php foreach ($mata_kuliah as $mk): ?>
                                <option value="<?php echo htmlspecialchars($mk['kode']); ?>"
                                        data-kode="<?php echo htmlspecialchars($mk['kode']); ?>"
                                        data-nama="<?php echo htmlspecialchars($mk['nama']); ?>"
                                        data-semester="<?php echo htmlspecialchars($mk['semester']); ?>"
                                        data-dosen="<?php echo htmlspecialchars($mk['dosen_id']); ?>"
                                        data-sks="<?php echo htmlspecialchars($mk['sks']); ?>">
                                    <?php echo htmlspecialchars($mk['kode']) . ' - ' . htmlspecialchars($mk['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" id="kodeUbah" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="namaUbah" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <input type="number" class="form-control" id="semesterUbah" name="semester" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dosen ID</label>
                        <input type="number" class="form-control" id="dosenUbah" name="dosen_id">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SKS</label>
                        <input type="number" class="form-control" id="sksUbah" name="sks">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('pilihMataKuliah').addEventListener('change', function () {
        const pilihan = this.options[this.selectedIndex];
        document.getElementById('kodeUbah').value     = pilihan.getAttribute('data-kode');
        document.getElementById('namaUbah').value     = pilihan.getAttribute('data-nama');
        document.getElementById('semesterUbah').value = pilihan.getAttribute('data-semester');
        document.getElementById('dosenUbah').value    = pilihan.getAttribute('data-dosen');
        document.getElementById('sksUbah').value      = pilihan.getAttribute('data-sks');
    });
</script>

<?php 
include 'layouts/footer.php'; 
?>