<?php

// Koneksi Database
include 'koneksi.php';


// ===============================
// PROSES TAMBAH DATA
// ===============================

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'tambah') {

    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $semester = $_POST['semester'];
    $dosen_id = $_POST['dosen_id'];
    $sks = $_POST['sks'];

    $sql = "INSERT INTO mata_kuliah
            (kode, nama, semester, dosen_id, sks)
            VALUES
            (:kode, :nama, :semester, :dosen_id, :sks)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':kode' => $kode,
        ':nama' => $nama,
        ':semester' => $semester,
        ':dosen_id' => $dosen_id,
        ':sks' => $sks
    ]);

    header("Location: mata-kuliah.php");
    exit;
}


// ===============================
// PROSES HAPUS DATA
// ===============================

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'hapus') {

    $kode = $_POST['kode'];

    $sql = "DELETE FROM mata_kuliah
            WHERE kode = :kode";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':kode' => $kode
    ]);

    header("Location: mata-kuliah.php");
    exit;
}


// ===============================
// MENGAMBIL DATA
// ===============================

$stmt = $pdo->prepare("SELECT * FROM mata_kuliah");
$stmt->execute();

$mata_kuliah = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mata Kuliah</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>


<body>


    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary">

        <div class="container-fluid">

            <a class="navbar-brand" href="index.php">
                MyWeb
            </a>


            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>


            <div
                class="collapse navbar-collapse"
                id="navbarNav">

                <ul class="navbar-nav">

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="index.php">

                            Home

                        </a>

                    </li>


                    <li class="nav-item">

                        <a
                            class="nav-link active"
                            href="mata-kuliah.php">

                            Mata Kuliah

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>


    <!-- ISI HALAMAN -->

    <div class="container mt-4">


        <!-- JUDUL DAN TOMBOL -->

        <div class="d-flex justify-content-between align-items-center">

            <h1>
                Daftar Mata Kuliah
            </h1>


            <div>

                <!-- TOMBOL TAMBAH -->

                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#tambahMataKuliah">

                    + Tambah Mata Kuliah

                </button>


                <!-- TOMBOL HAPUS -->

                <button
                    type="button"
                    class="btn btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#hapusMataKuliah">

                    Hapus Mata Kuliah

                </button>

            </div>

        </div>


        <!-- TABEL -->

        <table class="table table-striped mt-4">

            <thead>

                <tr>

                    <th>
                        Kode
                    </th>

                    <th>
                        Nama Mata Kuliah
                    </th>

                    <th>
                        Semester
                    </th>

                    <th>
                        Dosen ID
                    </th>

                    <th>
                        SKS
                    </th>

                </tr>

            </thead>


            <tbody>


                <?php if (!empty($mata_kuliah)): ?>


                    <?php foreach ($mata_kuliah as $mk): ?>

                        <tr>


                            <td>
                                <?php
                                echo htmlspecialchars($mk['kode']);
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars($mk['nama']);
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars($mk['semester']);
                                ?>
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



    <!-- ================================= -->
    <!-- MODAL TAMBAH MATA KULIAH -->
    <!-- ================================= -->


    <div
        class="modal fade"
        id="tambahMataKuliah"
        tabindex="-1">


        <div class="modal-dialog">


            <div class="modal-content">


                <div class="modal-header">


                    <h5 class="modal-title">

                        Tambah Mata Kuliah

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">

                    </button>


                </div>



                <form method="POST">


                    <div class="modal-body">


                        <!-- ACTION -->

                        <input
                            type="hidden"
                            name="action"
                            value="tambah">


                        <!-- KODE -->

                        <div class="mb-3">

                            <label class="form-label">

                                Kode Mata Kuliah

                            </label>


                            <input
                                type="text"
                                class="form-control"
                                name="kode"
                                required>

                        </div>



                        <!-- NAMA -->

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Mata Kuliah

                            </label>


                            <input
                                type="text"
                                class="form-control"
                                name="nama"
                                required>

                        </div>



                        <!-- SEMESTER -->

                        <div class="mb-3">

                            <label class="form-label">

                                Semester

                            </label>


                            <input
                                type="number"
                                class="form-control"
                                name="semester"
                                required>

                        </div>



                        <!-- DOSEN -->

                        <div class="mb-3">

                            <label class="form-label">

                                Dosen ID

                            </label>


                            <input
                                type="number"
                                class="form-control"
                                name="dosen_id">

                        </div>



                        <!-- SKS -->

                        <div class="mb-3">

                            <label class="form-label">

                                SKS

                            </label>


                            <input
                                type="number"
                                class="form-control"
                                name="sks">

                        </div>


                    </div>



                    <div class="modal-footer">


                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary">

                            Simpan

                        </button>


                    </div>


                </form>


            </div>

        </div>

    </div>



    <!-- ================================= -->
    <!-- MODAL HAPUS MATA KULIAH -->
    <!-- ================================= -->


    <div
        class="modal fade"
        id="hapusMataKuliah"
        tabindex="-1">


        <div class="modal-dialog">


            <div class="modal-content">


                <div class="modal-header">


                    <h5 class="modal-title">

                        Hapus Mata Kuliah

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">

                    </button>


                </div>



                <form method="POST">


                    <div class="modal-body">


                        <!-- ACTION -->

                        <input
                            type="hidden"
                            name="action"
                            value="hapus">


                        <div class="mb-3">


                            <label class="form-label">

                                Pilih Kode Mata Kuliah

                            </label>


                            <select
                                class="form-select"
                                name="kode"
                                required>


                                <option value="">

                                    -- Pilih Mata Kuliah --

                                </option>


                                <?php foreach ($mata_kuliah as $mk): ?>

                                    <option
                                        value="<?php echo htmlspecialchars($mk['kode']); ?>">

                                        <?php
                                        echo htmlspecialchars($mk['kode']);
                                        ?>
                                        -
                                        <?php
                                        echo htmlspecialchars($mk['nama']);
                                        ?>

                                    </option>

                                <?php endforeach; ?>


                            </select>


                        </div>


                        <div class="alert alert-warning">

                            Data yang sudah dihapus tidak dapat dikembalikan.

                        </div>


                    </div>



                    <div class="modal-footer">


                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-danger">

                            Hapus

                        </button>


                    </div>


                </form>


            </div>

        </div>

    </div>



    <!-- BOOTSTRAP JAVASCRIPT -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">

    </script>


</body>

</html>