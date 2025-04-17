<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sekolah</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <style>
        /* Gaya tampilan untuk layout */
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

        /* Sidebar styles */
        #sidebar {
            width: 300px;
            position: fixed;
            top: 60px;
            right: 0;
            bottom: 0;
            background-color: white;
            padding: 10px;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .section-title {
            font-weight: bold;
            cursor: pointer;
        }

        .collapsed {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Include Header -->
    <?= $this->include('header'); ?>

    <!-- School Information Section -->
    <div class="school-info">
        <h2>Data Umum</h2>
        <h2 style="font-size: 36px;"><i class="fas fa-building"></i><?= $school['name']; ?></h2>
        <table>
            <tr>
                <td>Alamat</td>
                <td>: <?= $school['alamat_sekolah']; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: <?= $school['alamat_email']; ?></td>
            </tr>
            <tr>
                <td>No. Telp</td>
                <td>: <?= $school['nomor_telepon']; ?></td>
            </tr>
            <tr>
                <td>Status Lahan</td>
                <td>: <?= $school['status_lahan']; ?></td>
            </tr>
            <tr>
                <td>Instalasi Air</td>
                <td>: <?= $school['instalasi_air']; ?></td>
            </tr>
            <tr>
                <td>Daya Listrik</td>
                <td>: <?= $school['daya_listrik']; ?> KWH</td>
            </tr>
            <tr>
                <td>Internet</td>
                <td>: <?= $school['status_internet']; ?></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>: <?= $school['kecamatan_id']; ?></td>
            </tr>
            <tr>
                <td>Luas Tanah</td>
                <td>: <?= $school['luas_lahan']; ?> M²</td>
            </tr>
            <tr>
                <td>Jumlah Murid</td>
                <td>: <?= $school['jumlah_siswa_laki'] + $school['jumlah_siswi']; ?></td>
            </tr>
        </table>
        <img src="<?= base_url('assets/uploads/schools/' . $school['foto']); ?>" alt="<?= $school['name']; ?>">

        <!-- Button Section -->
        <div class="button-container">
            <a href="<?= base_url('/'); ?>" class="btn-custom">Kembali</a>
            <a href="<?= site_url('detail_rkb/' . $school['id']); ?>" class="btn-custom">Data Sekolah</a>
            <a href="<?= base_url('/data-fisik-prioritas'); ?>" class="btn-custom">Data Fisik Prioritas</a>
        </div>
    </div>

    <!-- Map Section -->
    <div id="map"></div>

    <?php include('sidebar.php'); ?>

    <script>
        // Leaflet map initialization
        var accessToken = 'pk.eyJ1IjoiY3lhbmRpbmUiLCJhIjoiY20wZWo2NWI4MHFlZzJqczF6d2xodm82eCJ9.Nv-4Ep_LWHdU_xd42qzAXw'; // Ganti dengan token Mapbox yang valid.
        var map = L.map('map').setView([<?= $school['latitude']; ?>, <?= $school['longitude']; ?>], 15); // Zoom ke sekolah

        // Define base layers
        var streets = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=' + accessToken, {
            attribution: '&copy; OpenStreetMap contributors, Imagery © Mapbox',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(map);

        var satellite = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/{z}/{x}/{y}?access_token=' + accessToken, {
            tileSize: 512,
            zoomOffset: -1
        });

        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            tileSize: 256
        });

        var night = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/dark-v10/tiles/{z}/{x}/{y}?access_token=' + accessToken, {
            tileSize: 512,
            zoomOffset: -1
        });

        // Current base layer
        var currentLayer = streets;

        // Event listener for changing base maps
        document.querySelectorAll('input[name="basemap"]').forEach(function(input) {
            input.addEventListener('change', function() {
                map.removeLayer(currentLayer); // Remove current layer

                switch (this.value) {
                    case 'streets':
                        currentLayer = streets;
                        break;
                    case 'satellite':
                        currentLayer = satellite;
                        break;
                    case 'osm':
                        currentLayer = osm;
                        break;
                    case 'night':
                        currentLayer = night;
                        break;
                }
                currentLayer.addTo(map); // Add the selected basemap
            });
        });

        // Marker untuk sekolah
        L.marker([<?= $school['latitude']; ?>, <?= $school['longitude']; ?>]).addTo(map)
            .bindPopup('<b><?= $school['name']; ?></b><br><?= $school['alamat_sekolah']; ?>')
            .openPopup();
    </script>
</body>

</html>
