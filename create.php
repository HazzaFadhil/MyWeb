<body>

    <div class="container mt-4">

        <h1>Daftar Mata Kuliah</h1>

        <h2 class="mt-4">Tambah Mata Kuliah</h2>

        <form method="POST">

            <div class="mb-3">
                <label for="kode" class="form-label">
                    Kode Mata Kuliah
                </label>

                <input type="text" class="form-control" id="kode" name="kode" required>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">
                    Nama Mata Kuliah
                </label>

                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-3">
                <label for="semester" class="form-label">
                    Semester
                </label>

                <input type="number" class="form-control" id="semester" name="semester" required>
            </div>


            <div class="mb-3">
                <label for="dosen_id" class="form-label">
                    Dosen ID
                </label>

                <input type="number" class="form-control" id="dosen_id" name="dosen_id" required>
            </div>


            <div class="mb-3">
                <label for="sks" class="form-label">
                    SKS
                </label>

                <input type="number" class="form-control" id="sks" name="sks">
            </div>

            <button type="submit" class="btn btn-primary">
                Tambah Mata Kuliah
            </button>

        </form>

        <hr class="my-4">

        <h2>Daftar Mata Kuliah</h2>

        <table class="table table-striped-columns">