<?php
// Koneksi Database
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                MyWeb
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="mata-kuliah.php">
                            Mata Kuliah
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>


    <!-- ISI HALAMAN -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Daftar Mata Kuliah</h1>
            <!-- TOMBOL TAMBAH -->
        </div>


        <!-- TABEL -->
        <table class="table table-striped mt-4">
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
                            <td>
                                <?php echo htmlspecialchars($mk['kode']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($mk['nama']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($mk['semester']); ?>
                            </td>


                            <td>
                                <?php
                                if (empty($mk['dosen_id'])) {
                                    echo "-";
                                } else {
                                    echo htmlspecialchars($mk['dosen_id']);
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                if (empty($mk['sks'])) {
                                    echo "-";
                                } else {
                                    echo htmlspecialchars($mk['sks']);
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>

                    <tr>
                        <td colspan="5">
                            Tidak ada data mata kuliah.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>


    <!-- MODAL TAMBAH MATA KULIAH -->

    <div class="modal fade" id="tambahMataKuliah" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Mata Kuliah
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>


                <form method="POST">

                    <div class="modal-body">

                        <!-- KODE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Kode Mata Kuliah
                            </label>

                            <input type="text" class="form-control" name="kode" required>

                        </div>


                        <!-- NAMA -->

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Mata Kuliah
                            </label>

                            <input type="text" class="form-control" name="nama" required>

                        </div>


                        <!-- SEMESTER -->

                        <div class="mb-3">

                            <label class="form-label">
                                Semester
                            </label>

                            <input type="number" class="form-control" name="semester" required>

                        </div>


                        <!-- DOSEN -->

                        <div class="mb-3">

                            <label class="form-label">
                                Dosen ID
                            </label>

                            <input type="number" class="form-control" name="dosen_id">

                        </div>


                        <!-- SKS -->

                        <div class="mb-3">

                            <label class="form-label">
                                SKS
                            </label>

                            <input type="number" class="form-control" name="sks">

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                            Batal

                        </button>


                        <button type="submit" class="btn btn-primary">

                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <!-- BOOTSTRAP JAVASCRIPT -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>