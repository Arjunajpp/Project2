<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sekolah</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Detail Sekolah: <?= $school['name'] ?></h2>

        <form action="<?= base_url('school/update/' . $school['id']) ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- Nama Sekolah -->
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="<?= $school['name'] ?>" class="form-control" id="name" required>
                </div>

                <!-- Alamat Sekolah -->
                <div class="col-md-6 mb-3">
                    <label for="alamat_sekolah" class="form-label">Alamat Sekolah <span class="text-danger">*</span></label>
                    <textarea name="alamat_sekolah" class="form-control" id="alamat_sekolah" rows="2" required><?= $school['alamat_sekolah'] ?></textarea>
                </div>
            </div>

            <div class="row">
                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label for="alamat_email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="alamat_email" value="<?= $school['alamat_email'] ?>" class="form-control" id="alamat_email" required>
                </div>

                <!-- Status Lahan -->
                <div class="col-md-6 mb-3">
                    <label for="status_lahan" class="form-label">Status Lahan <span class="text-danger">*</span></label>
                    <select name="status_lahan" class="form-select" id="status_lahan" required>
                        <option value="Sertifikat" <?= $school['status_lahan'] == 'Sertifikat' ? 'selected' : '' ?>>Sertifikat</option>
                        <option value="Segel" <?= $school['status_lahan'] == 'Segel' ? 'selected' : '' ?>>Segel</option>
                        <option value="Hibah" <?= $school['status_lahan'] == 'Hibah' ? 'selected' : '' ?>>Hibah</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <!-- Luas Lahan -->
                <div class="col-md-6 mb-3">
                    <label for="luas_lahan" class="form-label">Luas Lahan (m<sup>2</sup>)</label>
                    <input type="number" name="luas_lahan" value="<?= $school['luas_lahan'] ?>" class="form-control" id="luas_lahan" min="0">
                </div>

                <!-- Daya Listrik -->
                <div class="col-md-6 mb-3">
                    <label for="daya_listrik" class="form-label">Daya Listrik (Watt)</label>
                    <input type="number" name="daya_listrik" value="<?= $school['daya_listrik'] ?>" class="form-control" id="daya_listrik" min="0">
                </div>
            </div>

            <div class="row">
                <!-- Instalasi Air -->
                <div class="col-md-6 mb-3">
                    <label for="instalasi_air" class="form-label">Instalasi Air <span class="text-danger">*</span></label>
                    <select name="instalasi_air" class="form-select" id="instalasi_air" required>
                        <option value="PDAM" <?= $school['instalasi_air'] == 'PDAM' ? 'selected' : '' ?>>PDAM</option>
                        <option value="Sumur Bor" <?= $school['instalasi_air'] == 'Sumur Bor' ? 'selected' : '' ?>>Sumur Bor</option>
                        <option value="Sumur Galian" <?= $school['instalasi_air'] == 'Sumur Galian' ? 'selected' : '' ?>>Sumur Galian</option>
                        <option value="Tadah Hujan" <?= $school['instalasi_air'] == 'Tadah Hujan' ? 'selected' : '' ?>>Tadah Hujan</option>
                    </select>
                </div>

                <!-- Status Internet -->
                <div class="col-md-6 mb-3">
                    <label for="status_internet" class="form-label">Status Internet</label>
                    <input type="text" name="status_internet" value="<?= $school['status_internet'] ?>" class="form-control" id="status_internet">
                </div>
            </div>

            <div class="row">
                <!-- Nama Kepala Sekolah -->
                <div class="col-md-6 mb-3">
                    <label for="nama_kepala_sekolah" class="form-label">Nama Kepala Sekolah</label>
                    <input type="text" name="nama_kepala_sekolah" value="<?= $school['nama_kepala_sekolah'] ?>" class="form-control" id="nama_kepala_sekolah">
                </div>

                <!-- Nomor Telepon -->
                <div class="col-md-6 mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" value="<?= $school['nomor_telepon'] ?>" class="form-control" id="nomor_telepon">
                </div>
            </div>

            <!-- Foto Sekolah -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Sekolah</label>
                <input type="file" name="foto" class="form-control" id="foto">
                <?php if (!empty($school['foto'])): ?>
                    <div class="mt-3">
                        <img src="<?= base_url('assets/uploads/schools/' . $school['foto']) ?>" alt="Foto Sekolah" class="img-thumbnail" width="200">
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tombol Submit -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>