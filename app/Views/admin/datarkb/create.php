<!-- admin/datarkb/create.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data RKB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Tambah Data RKB</h2>
        <form action="<?= base_url('admin/datarkb/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                    <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" required>
                </div>
                <div class="col-md-6">
                    <label for="jumlah_siswa" class="form-label">Jumlah Siswa</label>
                    <input type="number" class="form-control" id="jumlah_siswa" name="jumlah_siswa" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="jumlah_rombel" class="form-label">Jumlah Rombel</label>
                    <input type="number" class="form-control" id="jumlah_rombel" name="jumlah_rombel" required>
                </div>
                <div class="col-md-6">
                    <label for="jumlah_rkb" class="form-label">Jumlah RKB</label>
                    <input type="number" class="form-control" id="jumlah_rkb" name="jumlah_rkb" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="kekurangan_rkb" class="form-label">Kekurangan RKB</label>
                    <input type="number" class="form-control" id="kekurangan_rkb" name="kekurangan_rkb" required>
                </div>
            </div>

            <h4>Kondisi RKB</h4>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="kondisi_rkb_baik" class="form-label">RKB Baik</label>
                    <input type="number" class="form-control" id="kondisi_rkb_baik" name="kondisi_rkb_baik" required>
                </div>
                <div class="col-md-3">
                    <label for="kondisi_rkb_rusak_ringan" class="form-label">RKB Rusak Ringan</label>
                    <input type="number" class="form-control" id="kondisi_rkb_rusak_ringan" name="kondisi_rkb_rusak_ringan" required>
                </div>
                <div class="col-md-3">
                    <label for="kondisi_rkb_rusak_sedang" class="form-label">RKB Rusak Sedang</label>
                    <input type="number" class="form-control" id="kondisi_rkb_rusak_sedang" name="kondisi_rkb_rusak_sedang" required>
                </div>
                <div class="col-md-3">
                    <label for="kondisi_rkb_rusak_berat" class="form-label">RKB Rusak Berat</label>
                    <input type="number" class="form-control" id="kondisi_rkb_rusak_berat" name="kondisi_rkb_rusak_berat" required>
                </div>
            </div>

            <h4>Kondisi Meja Kursi Siswa</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="meja_kursi_siswa_layak" class="form-label">Meja Kursi Siswa Layak</label>
                    <input type="number" class="form-control" id="meja_kursi_siswa_layak" name="meja_kursi_siswa_layak" required>
                </div>
                <div class="col-md-6">
                    <label for="meja_kursi_siswa_tidak_layak" class="form-label">Meja Kursi Siswa Tidak Layak</label>
                    <input type="number" class="form-control" id="meja_kursi_siswa_tidak_layak" name="meja_kursi_siswa_tidak_layak" required>
                </div>
            </div>

            <h4>Kondisi Meja Kursi Guru</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="meja_kursi_guru_layak" class="form-label">Meja Kursi Guru Layak</label>
                    <input type="number" class="form-control" id="meja_kursi_guru_layak" name="meja_kursi_guru_layak" required>
                </div>
                <div class="col-md-6">
                    <label for="meja_kursi_guru_tidak_layak" class="form-label">Meja Kursi Guru Tidak Layak</label>
                    <input type="number" class="form-control" id="meja_kursi_guru_tidak_layak" name="meja_kursi_guru_tidak_layak" required>
                </div>
            </div>

            <h4>Sarana Pendukung</h4>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="lemari" class="form-label">Jumlah Lemari</label>
                    <input type="number" class="form-control" id="lemari" name="lemari" required>
                </div>
                <div class="col-md-3">
                    <label for="papan_tulis" class="form-label">Jumlah Papan Tulis</label>
                    <input type="number" class="form-control" id="papan_tulis" name="papan_tulis" required>
                </div>
                <div class="col-md-3">
                    <label for="papan_pajangan" class="form-label">Jumlah Papan Pajangan</label>
                    <input type="number" class="form-control" id="papan_pajangan" name="papan_pajangan" required>
                </div>
                <div class="col-md-3">
                    <label for="proyektor" class="form-label">Jumlah Proyektor</label>
                    <input type="number" class="form-control" id="proyektor" name="proyektor" required>
                </div>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-success">Simpan Data</button>
        </form>
    </div>
</body>

</html>
