<div class="footer" style="background-color: #f8f9fa; text-align: center; padding: 10px; position: fixed; bottom: 0; width: 100%;">
    &copy; 2024 E-Sarpras. All Rights Reserved.
</div>

<!-- Script for Leaflet -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
<script>

    var accessToken = 'pk.eyJ1IjoiY3lhbmRpbmUiLCJhIjoiY20wZWo2NWI4MHFlZzJqczF6d2xodm82eCJ9.Nv-4Ep_LWHdU_xd42qzAXw'; // Ganti dengan token Mapbox yang valid.

    // Initialize the map
    var map = L.map('map').setView([-1.255971, 116.831456], 10);

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

    // Keep the markers on the map when switching basemaps
    var currentLayer = streets;

    // Add event listener for changing base maps
    document.querySelectorAll('input[name="basemap"]').forEach(function(input) {
        input.addEventListener('change', function() {
            map.removeLayer(currentLayer); // Remove the current basemap

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

    // Cluster group for school markers
    var markersCluster = L.markerClusterGroup();

    // Display school markers with clustering (replace dummy data with actual school data)
    var schoolData = <?= json_encode($schools); ?>; // Data dari database

    function addMarkers(category) {
        schoolData.forEach(function(school) {
            if (school.category === category) {
                var marker = L.marker([school.latitude, school.longitude])
                    .bindPopup("<b>" + school.name + "</b><br>" + school.description);
                markersCluster.addLayer(marker);
            }
        });
        map.addLayer(markersCluster); // Add cluster to map
    }

    function clearMarkers() {
        markersCluster.clearLayers(); // Clear the cluster group
    }

    // Handle category checkbox change
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
    

    var sidebarVisible = true;

    document.getElementById('toggle-sidebar').addEventListener('click', function() {
        var sidebar = document.getElementById('sidebar');
        var toggleIcon = this.querySelector('i');

        if (sidebarVisible) {
            // Sembunyikan sidebar
            sidebar.classList.add('hidden');
            this.classList.add('hidden');
            toggleIcon.classList.remove('fa-arrow-left');
            toggleIcon.classList.add('fa-arrow-right');
        } else {
            // Tampilkan sidebar
            sidebar.classList.remove('hidden');
            this.classList.remove('hidden');
            toggleIcon.classList.remove('fa-arrow-right');
            toggleIcon.classList.add('fa-arrow-left');
        }

        sidebarVisible = !sidebarVisible;
    });
</script>
</body>

</html>