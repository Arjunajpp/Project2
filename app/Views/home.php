<?php include('header.php'); ?>

<!-- Map Container -->
<div id="map-container">
    <div id="map"></div>
</div>

<?php include('sidebar.php'); ?>

<!-- Script for Leaflet -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
<!-- Leaflet MarkerCluster CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

<script>
    var accessToken = 'pk.eyJ1IjoiY3lhbmRpbmUiLCJhIjoiY20wZWo2NWI4MHFlZzJqczF6d2xodm82eCJ9.Nv-4Ep_LWHdU_xd42qzAXw'; // Ganti dengan token Mapbox yang valid.

    // Initialize the map
    var map = L.map('map').setView([-1.255971, 116.831456], 10);

    // Ensure the map is resized correctly on load
    setTimeout(function() {
        map.invalidateSize();
    }, 100);

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

    // Cluster group for school markers with animation
    var markersCluster = L.markerClusterGroup({
        animateAddingMarkers: true, // Enable animation when adding markers
        spiderfyOnMaxZoom: true, // Enable spiderfy on max zoom
        showCoverageOnHover: false // Disable the coverage hover effect
    });

    // Data sekolah (ganti dengan data nyata dari backend)
    var schoolData = <?= json_encode($schools); ?>;

    // Fungsi untuk menambahkan marker sesuai kategori
    function addMarkers(category) {
        schoolData.forEach(function(school) {
            if (school.category === category) {
                var marker = L.marker([school.latitude, school.longitude]);

                // Membuat konten popup khusus
                var popupContent = `
                    <div>
                        <h4>${school.name}</h4>
                        <img src="assets/uploads/schools/${school.foto}" alt="${school.name}" style="width: 100%; height: auto; border-radius: 8px;">
                        <p><strong>Nama Kepala Sekolah:</strong> ${school.nama_kepala_sekolah}</p>
                        <p><strong>Alamat Sekolah:</strong> ${school.alamat_sekolah}</p>
                        <p><strong>Alamat Email:</strong> ${school.alamat_email}</p>
                        <p><strong>No. Telp:</strong> ${school.nomor_telepon}</p>
                        <a href="detail/${school.id}" class="btn btn-sm btn-default btn-block">Detail</a>
                    </div>
                `;

                marker.bindPopup(popupContent); // Bind popup khusus ke marker
                markersCluster.addLayer(marker);
            }
        });

        map.addLayer(markersCluster); // Tambahkan cluster marker ke peta
    }

    function clearMarkers() {
        markersCluster.clearLayers(); // Clear markers
    }

    // Checkbox change event for school categories
    document.querySelectorAll('.checkbox-group input').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            clearMarkers();
            document.querySelectorAll('.checkbox-group input:checked').forEach(function(checkedBox) {
                addMarkers(checkedBox.value);
            });
        });
    });

    // Initially display all categories
    addMarkers('PAUD');
    addMarkers('SD');
    addMarkers('SMP');
    

    // Sidebar toggle functionality
    var sidebarVisible = true;

    document.getElementById('toggle-sidebar').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var mapContainer = document.getElementById('map-container');
        var toggleIcon = this.querySelector('i');
        var toggleButton = document.getElementById('toggle-sidebar');

        if (sidebarVisible) {
            // Hide sidebar
            sidebar.classList.add('hidden');
            mapContainer.style.right = '0'; // Make the map fullscreen
            toggleIcon.classList.remove('fa-arrow-left');
            toggleIcon.classList.add('fa-arrow-right');
            toggleButton.style.right = '10px'; // Move button along with sidebar
        } else {
            // Show sidebar
            sidebar.classList.remove('hidden');
            mapContainer.style.right = '300px'; // Leave space for sidebar
            toggleIcon.classList.remove('fa-arrow-right');
            toggleIcon.classList.add('fa-arrow-left');
            toggleButton.style.right = '310px'; // Move button back
        }

        // Resize map to fit new container size
        setTimeout(function() {
            map.invalidateSize();
        }, 300); // Delay to match transition time

        sidebarVisible = !sidebarVisible;
    });

    // Toggle sections (Base Maps and SARPRAS)
    document.querySelectorAll('.section-title').forEach(function(section) {
        section.addEventListener('click', function() {
            const content = section.nextElementSibling;
            content.classList.toggle('collapsed');
            section.querySelector('i').classList.toggle('collapsed');
        });
    });
</script>
<style>
    #map-container {
        position: absolute;
        top: 60px;
        /* Pastikan peta berada di bawah header */
        bottom: 0;
        left: 0;
        right: 300px;
        /* Tinggalkan ruang untuk sidebar */
        transition: right 0.3s ease;
    }

    #map {
        height: 100%;
        width: 100%;
    }

    .btn-custom {
        background-color: #007bff;
        /* Warna dasar biru */
        color: white;
        /* Warna teks putih */
        padding: 10px 20px;
        /* Ukuran padding untuk tombol */
        border: none;
        /* Hilangkan border default */
        border-radius: 5px;
        /* Ujung tombol melengkung */
        cursor: pointer;
        /* Pointer pada hover */
        font-size: 14px;
        /* Ukuran font tombol */
        /* transition: background-color 0.3s ease; */
        /* Animasi saat hover */
    }

    .btn-custom:hover {
        background-color: #0056b3;
        /* Warna saat tombol di-hover */
        color: white;
        /* Pastikan warna teks tetap putih saat hover */
    }
</style>
</body>

</html>