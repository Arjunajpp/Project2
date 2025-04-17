<div class="sidebar" id="sidebar">
    <!-- Base Maps Section -->
    <h3 class="section-title">Base Maps <i class="fas fa-chevron-down toggle-section"></i></h3>
    <div class="section-content">
        <label><input type="radio" name="basemap" value="streets" checked>
            <img src="https://cdn-icons-png.flaticon.com/512/5088/5088218.png" alt="Street" width="20" height="20"> Street
        </label><br>

        <label><input type="radio" name="basemap" value="satellite">
            <img src="https://cdn-icons-png.flaticon.com/512/5088/5088218.png" alt="Satellite" width="20" height="20"> Satellite
        </label><br>

        <label><input type="radio" name="basemap" value="osm">
            <img src="https://cdn-icons-png.flaticon.com/512/5088/5088218.png" alt="Detail" width="20" height="20"> Detail
        </label><br>
    </div>

    <!-- Kategori Sekolah Section -->
    <h3 class="section-title">SARPRAS <i class="fas fa-chevron-down toggle-section"></i></h3>
    <div class="section-content checkbox-group">
        <label><input type="checkbox" value="PAUD" checked>
            <img src="https://cdn-icons-png.flaticon.com/512/5088/5088254.png" alt="Detail" width="20" height="20"> PAUD
        </label><br>
        <label><input type="checkbox" value="SD" checked>
            <img src="https://cdn-icons-png.flaticon.com/512/5088/5088254.png" alt="Detail" width="20" height="20">SD
        </label><br>
        <label><input type="checkbox" value="SMP" checked>
            <img src="https://cdn-icons-png.flaticon.com/512/5088/5088254.png" alt="Detail" width="20" height="20">SMP
        </label><br>
    </div>
</div>

<!-- Toggle Button -->
<button id="toggle-sidebar" class="toggle-btn">
    <i class="fa fa-arrow-left"></i>
</button>
<style>
    /* Styling Sidebar */
    .sidebar {
        background-color: #fff;
        border-left: 1px solid #ccc;
        height: calc(100vh - 60px);
        /* Full height minus header */
        width: 300px;
        padding: 15px;
        position: fixed;
        right: 0;
        top: 60px;
        /* Below the header */
        transition: transform 0.3s ease;
        overflow-y: auto;
    }

    .sidebar.hidden {
        transform: translateX(100%);
    }

    /* Section Title Styling */
    .section-title {
        font-size: 16px;
        font-weight: bold;
        color: #007bff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        margin-bottom: 5px;
    }

    /* Content of each section */
    .section-content {
        transition: max-height 0.3s ease, opacity 0.3s ease;
        max-height: 200px;
        /* Default max-height */
        opacity: 1;
        overflow: hidden;
        margin-bottom: 10px;
    }

    /* Collapsed content */
    .section-content.collapsed {
        max-height: 0;
        opacity: 0;
        margin-bottom: 0;
    }

    label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        margin: 5px 0;
        /* Adjusted spacing between items */
    }

    label input {
        margin-right: 10px;
    }

    label img {
        width: 20px;
        /* Set width for the icons */
        height: 20px;
        /* Set height for the icons */
        display: inline-block;
    }

    .fa-map-marker-alt {
        color: orange;
    }

    .fa-school {
        color: green;
    }

    /* Styling Toggle Button */
    .toggle-btn {
        position: absolute;
        top: 70px;
        right: 310px;
        z-index: 999;
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 5px;
        transition: right 0.3s ease;
    }

    .toggle-btn.hidden {
        right: 10px;
    }

    .toggle-btn i {
        font-size: 18px;
    }

    /* Responsive Sidebar */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            left: 0;
            right: 0;
            top: 60px;
        }
    }
</style>