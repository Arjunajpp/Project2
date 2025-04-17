<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data RKB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Data RKB: <?= $rkb['nama_sekolah'] ?></h2>

        <form action="<?= base_url('admin/datarkb/update/' . $rkb['id_data_rkb']) ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="row">
                <!-- Nama Sekolah -->
                <div class="col-md-6 mb-3">
                    <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" value="<?= $rkb['nama_sekolah'] ?>" class="form-control" id="nama_sekolah" required>
                </div>

                <!-- Jumlah Siswa -->
                <div class="col-md-6 mb-3">
                    <label for="jumlah_siswa" class="form-label">Jumlah Siswa</label>
                    <input type="number" name="jumlah_siswa" value="<?= $rkb['jumlah_siswa'] ?>" class="form-control" id="jumlah_siswa" required>
                </div>
            </div>

            <div class="row">
                <!-- Jumlah Rombel -->
                <div class="col-md-6 mb-3">
                    <label for="jumlah_rombel" class="form-label">Jumlah Rombel</label>
                    <input type="number" name="jumlah_rombel" value="<?= $rkb['jumlah_rombel'] ?>" class="form-control" id="jumlah_rombel" required>
                </div>

                <!-- Jumlah RKB -->
                <div class="col-md-6 mb-3">
                    <label for="jumlah_rkb" class="form-label">Jumlah RKB</label>
                    <input type="number" name="jumlah_rkb" value="<?= $rkb['jumlah_rkb'] ?>" class="form-control" id="jumlah_rkb" required>
                </div>
            </div>

            <div class="row">
                <!-- Kekurangan RKB -->
                <div class="col-md-6 mb-3">
                    <label for="kekurangan_rkb" class="form-label">Kekurangan RKB</label>
                    <input type="number" name="kekurangan_rkb" value="<?= $rkb['kekurangan_rkb'] ?>" class="form-control" id="kekurangan_rkb">
                </div>

                <!-- Kondisi RKB Baik -->
                <div class="col-md-6 mb-3">
                    <label for="kondisi_rkb_baik" class="form-label">Kondisi RKB Baik (%)</label>
                    <input type="number" name="kondisi_rkb_baik" value="<?= $rkb['kondisi_rkb_baik'] ?>" class="form-control" id="kondisi_rkb_baik">
                </div>
            </div>

            <div class="row">
                <!-- Kondisi RKB Rusak Ringan -->
                <div class="col-md-6 mb-3">
                    <label for="kondisi_rkb_rusak_ringan" class="form-label">Kondisi RKB Rusak Ringan (%)</label>
                    <input type="number" name="kondisi_rkb_rusak_ringan" value="<?= $rkb['kondisi_rkb_rusak_ringan'] ?>" class="form-control" id="kondisi_rkb_rusak_ringan">
                </div>

                <!-- Kondisi RKB Rusak Sedang -->
                <div class="col-md-6 mb-3">
                    <label for="kondisi_rkb_rusak_sedang" class="form-label">Kondisi RKB Rusak Sedang (%)</label>
                    <input type="number" name="kondisi_rkb_rusak_sedang" value="<?= $rkb['kondisi_rkb_rusak_sedang'] ?>" class="form-control" id="kondisi_rkb_rusak_sedang">
                </div>
            </div>

            <div class="row">
                <!-- Kondisi RKB Rusak Berat -->
                <div class="col-md-6 mb-3">
                    <label for="kondisi_rkb_rusak_berat" class="form-label">Kondisi RKB Rusak Berat (%)</label>
                    <input type="number" name="kondisi_rkb_rusak_berat" value="<?= $rkb['kondisi_rkb_rusak_berat'] ?>" class="form-control" id="kondisi_rkb_rusak_berat">
                </div>

                <!-- Meja Kursi Siswa Layak -->
                <div class="col-md-6 mb-3">
                    <label for="meja_kursi_siswa_layak" class="form-label">Meja Kursi Siswa Layak</label>
                    <input type="number" name="meja_kursi_siswa_layak" value="<?= $rkb['meja_kursi_siswa_layak'] ?>" class="form-control" id="meja_kursi_siswa_layak">
                </div>
            </div>

            <div class="row">
                <!-- Meja Kursi Siswa Tidak Layak -->
                <div class="col-md-6 mb-3">
                    <label for="meja_kursi_siswa_tidak_layak" class="form-label">Meja Kursi Siswa Tidak Layak</label>
                    <input type="number" name="meja_kursi_siswa_tidak_layak" value="<?= $rkb['meja_kursi_siswa_tidak_layak'] ?>" class="form-control" id="meja_kursi_siswa_tidak_layak">
                </div>

                <!-- Meja Kursi Guru Layak -->
                <div class="col-md-6 mb-3">
                    <label for="meja_kursi_guru_layak" class="form-label">Meja Kursi Guru Layak</label>
                    <input type="number" name="meja_kursi_guru_layak" value="<?= $rkb['meja_kursi_guru_layak'] ?>" class="form-control" id="meja_kursi_guru_layak">
                </div>
            </div>

            <div class="row">
                <!-- Meja Kursi Guru Tidak Layak -->
                <div class="col-md-6 mb-3">
                    <label for="meja_kursi_guru_tidak_layak" class="form-label">Meja Kursi Guru Tidak Layak</label>
                    <input type="number" name="meja_kursi_guru_tidak_layak" value="<?= $rkb['meja_kursi_guru_tidak_layak'] ?>" class="form-control" id="meja_kursi_guru_tidak_layak">
                </div>

                <!-- Lemari -->
                <div class="col-md-6 mb-3">
                    <label for="lemari" class="form-label">Lemari</label>
                    <input type="number" name="lemari" value="<?= $rkb['lemari'] ?>" class="form-control" id="lemari">
                </div>
            </div>

            <div class="row">
                <!-- Papan Tulis -->
                <div class="col-md-6 mb-3">
                    <label for="papan_tulis" class="form-label">Papan Tulis</label>
                    <input type="number" name="papan_tulis" value="<?= $rkb['papan_tulis'] ?>" class="form-control" id="papan_tulis">
                </div>

                <!-- Papan Pajangan -->
                <div class="col-md-6 mb-3">
                    <label for="papan_pajangan" class="form-label">Papan Pajangan</label>
                    <input type="number" name="papan_pajangan" value="<?= $rkb['papan_pajangan'] ?>" class="form-control" id="papan_pajangan">
                </div>
            </div>

            <div class="row">
                <!-- Proyektor -->
                <div class="col-md-6 mb-3">
                    <label for="proyektor" class="form-label">Proyektor</label>
                    <input type="number" name="proyektor" value="<?= $rkb['proyektor'] ?>" class="form-control" id="proyektor">
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>

        </form>
    </div>
</body>

</html>
