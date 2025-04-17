<!-- admin/dashboard.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data RKB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Data RKB</h2>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="nav-link">Sekolah: <strong><?= session()->get('school_name') ?></strong></h3>
            <a href="<?= base_url('admin/datarkb/create') ?>" class="btn btn-primary">Tambah Data</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Sekolah</th>
                    <th>Jumlah Siswa</th>
                    <th>Jumlah Rombel</th>
                    <th>Jumlah RKB</th>
                    <th>Kekurangan RKB</th>
                    <th>Kondisi RKB (Baik)</th>
                    <th>Kondisi RKB (Rusak Ringan)</th>
                    <th>Kondisi RKB (Rusak Sedang)</th>
                    <th>Kondisi RKB (Rusak Berat)</th>
                    <th>Meja Kursi Siswa (Layak)</th>
                    <th>Meja Kursi Siswa (Tidak Layak)</th>
                    <th>Meja Kursi Guru (Layak)</th>
                    <th>Meja Kursi Guru (Tidak Layak)</th>
                    <th>Lemari</th>
                    <th>Papan Tulis</th>
                    <th>Papan Pajangan</th>
                    <th>Proyektor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_rkb as $key => $rkb): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $rkb['nama_sekolah'] ?></td>
                        <td><?= $rkb['jumlah_siswa'] ?></td>
                        <td><?= $rkb['jumlah_rombel'] ?></td>
                        <td><?= $rkb['jumlah_rkb'] ?></td>
                        <td><?= $rkb['kekurangan_rkb'] ?></td>
                        <td><?= $rkb['kondisi_rkb_baik'] ?>%</td>
                        <td><?= $rkb['kondisi_rkb_rusak_ringan'] ?>%</td>
                        <td><?= $rkb['kondisi_rkb_rusak_sedang'] ?>%</td>
                        <td><?= $rkb['kondisi_rkb_rusak_berat'] ?>%</td>
                        <td><?= $rkb['meja_kursi_siswa_layak'] ?></td>
                        <td><?= $rkb['meja_kursi_siswa_tidak_layak'] ?></td>
                        <td><?= $rkb['meja_kursi_guru_layak'] ?></td>
                        <td><?= $rkb['meja_kursi_guru_tidak_layak'] ?></td>
                        <td><?= $rkb['lemari'] ?></td>
                        <td><?= $rkb['papan_tulis'] ?></td>
                        <td><?= $rkb['papan_pajangan'] ?></td>
                        <td><?= $rkb['proyektor'] ?></td>
                        <td>
                            <a href="<?= base_url('admin/datarkb/edit/'.$rkb['id_data_rkb']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= base_url('admin/datarkb/delete/'.$rkb['id_data_rkb']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
