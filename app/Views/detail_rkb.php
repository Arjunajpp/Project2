<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sekolah</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <style>
        /* Gaya tampilan untuk layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        #map {
            height: 100%;
            width: 75%;
            float: right;
        }

        .school-info {
            width: 25%;
            padding: 20px;
            float: left;
            font-size: 16px;
            background-color: #eee;
        }

        .school-info h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .school-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .school-info td {
            padding: 8px 0;
            font-size: 14px;
            vertical-align: top;
        }

        .school-info td:first-child {
            font-weight: bold;
            width: 30%;
        }

        .school-info img {
            width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 8px;
        }

        /* Button container styling */
        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            text-align: center;
            flex: 1;
            margin: 0 5px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Table styles */
        .data-section {
            margin-top: 20px;
        }

        .data-section h3 {
            background-color: #333;
            color: white;
            padding: 10px;
        }

        .data-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-section th,
        .data-section td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .data-section tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .data-section th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Include Header -->
    <?= $this->include('header'); ?>

    <!-- School Information Section -->

    <!-- Data Section for RKB -->
    <div class="data-section">
        <h3>RKB (Ruang Kelas Baru)</h3>
        <table>
            <tr>
                <th>Kode Inventaris</th>
                <th>Nama Aset</th>
                <th>Kondisi</th>
                <th>Ruangan</th>
                <th>Anggaran</th>
            </tr>
            <?php foreach ($data_rkb as $aset) : ?>
                <tr>
                    <td><?= $aset['kode_inventaris']; ?></td>
                    <td><?= $aset['nama_aset']; ?></td>
                    <td><?= $aset['kondisi']; ?></td>
                    <td><?= $aset['nama_ruangan']; ?></td>
                    <td><?= $aset['nama_anggaran']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Data Section for Sarana Pendukung -->
    <div class="data-section">
        <!-- Tabel untuk Sarana -->
        <!-- Tabel untuk Sarana -->
        <h3>Data Sarana</h3>
        <table>
            <tr>
                <th>Kode Inventaris</th>
                <th>Nama Aset</th>
                <th>Kondisi</th>
                <th>Ruangan</th>
                <th>Anggaran</th>
            </tr>
            <?php foreach ($data_sarana as $aset) : ?>
                <tr>
                    <td><?= $aset['kode_inventaris']; ?></td>
                    <td><?= $aset['nama_aset']; ?></td>
                    <td><?= $aset['kondisi']; ?></td>
                    <td><?= $aset['nama_ruangan']; ?></td>
                    <td><?= $aset['nama_anggaran']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Tabel untuk Prasarana -->
        <h3>Data Prasarana</h3>
        <table>
            <tr>
                <th>Kode Inventaris</th>
                <th>Nama Aset</th>
                <th>Kondisi</th>
                <th>Ruangan</th>
                <th>Anggaran</th>
            </tr>
            <?php foreach ($data_prasarana as $aset) : ?>
                <tr>
                    <td><?= $aset['kode_inventaris']; ?></td>
                    <td><?= $aset['nama_aset']; ?></td>
                    <td><?= $aset['kondisi']; ?></td>
                    <td><?= $aset['nama_ruangan']; ?></td>
                    <td><?= $aset['nama_anggaran']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Tabel untuk Sarana Pendukung -->
        <h3>Data Sarana Pendukung</h3>
        <table>
            <tr>
                <th>Kode Inventaris</th>
                <th>Nama Aset</th>
                <th>Kondisi</th>
                <th>Ruangan</th>
                <th>Anggaran</th>
            </tr>
            <?php foreach ($data_sarana_pendukung as $aset) : ?>
                <tr>
                    <td><?= $aset['kode_inventaris']; ?></td>
                    <td><?= $aset['nama_aset']; ?></td>
                    <td><?= $aset['kondisi']; ?></td>
                    <td><?= $aset['nama_ruangan']; ?></td>
                    <td><?= $aset['nama_anggaran']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Tabel untuk Fisik -->
        <h3>Data Fisik</h3>
        <table>
            <tr>
                <th>Kode Inventaris</th>
                <th>Nama Aset</th>
                <th>Kondisi</th>
                <th>Ruangan</th>
                <th>Anggaran</th>
            </tr>
            <?php foreach ($data_fisik as $aset) : ?>
                <tr>
                    <td><?= $aset['kode_inventaris']; ?></td>
                    <td><?= $aset['nama_aset']; ?></td>
                    <td><?= $aset['kondisi']; ?></td>
                    <td><?= $aset['nama_ruangan']; ?></td>
                    <td><?= $aset['nama_anggaran']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <script>
            // Optional: Initialize Leaflet map (if required for the project)
        </script>
</body>

</html>