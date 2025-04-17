<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Sarpras Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons (Updated to 6.x) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-dark: #3a5cbe;
            --secondary-color: #6c757d;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #343a40;
            --border-radius: 0.35rem;
            --box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* Navbar styles */
        .navbar-custom {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-custom .navbar-brand {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .navbar-custom .nav-link {
            font-weight: 500;
            color: var(--dark-color);
        }
        
        /* Sidebar style */
        .sidebar {
            background-color: var(--primary-color);
            transition: all 0.3s ease;
            height: calc(100vh - 56px);
            position: sticky;
            top: 56px;
            width: 250px;
            z-index: 100;
        }
        
        .sidebar .list-group-item {
            background-color: transparent;
            color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 0;
            transition: all 0.2s ease;
            padding: 0.75rem 1rem;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .sidebar .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        
        .sidebar .list-group-item.active {
            background-color: #fff;
            color: var(--primary-color);
            border-left: 4px solid var(--primary-dark);
            font-weight: 600;
        }
        
        .sidebar .list-group-item i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        /* Collapsed sidebar */
        .sidebar-collapsed {
            width: 70px;
        }
        
        .sidebar-collapsed .list-group-item span {
            display: none;
        }
        
        .sidebar-collapsed .list-group-item i {
            margin-right: 0;
            font-size: 1.2rem;
        }
        
        /* Modal customization */
        .modal-header {
            border-radius: calc(var(--border-radius) - 1px) calc(var(--border-radius) - 1px) 0 0;
        }
        
        /* User dropdown */
        .user-dropdown {
            padding: 0.5rem;
            min-width: 220px;
        }
        
        .user-dropdown .dropdown-item {
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 0.25rem;
        }
        
        .user-dropdown .dropdown-item:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }
        
        .user-dropdown .dropdown-divider {
            margin: 0.5rem 0;
        }
        
        /* Profile picture */
        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
            overflow: hidden;
        }
        
        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Utility classes */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        
        .bg-gradient-success {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        }
        
        .bg-gradient-info {
            background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
        }
        
        .bg-gradient-warning {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
        }
        
        .bg-gradient-danger {
            background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
        }
        
        .bg-gradient-dark {
            background: linear-gradient(135deg, #5a5c69 0%, #373840 100%);
        }
        
        /* Card styles */
        .card {
            border: 0;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 0.3rem 2rem 0 rgba(58, 59, 69, 0.15);
            transform: translateY(-2px);
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e3e6f0;
        }
        
        /* Custom shape for cards */
        .rounded-xl {
            border-radius: 1rem !important;
        }
        
        /* Button customization */
        .btn {
            font-weight: 500;
            border-radius: var(--border-radius);
            padding: 0.375rem 1rem;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        /* Toast notifications */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
        
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <button id="sidebarToggle" class="btn btn-link me-2">
                <i class="fas fa-bars"></i>
            </button>
            
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url('admin/dashboard') ?>">
                <i class="fas fa-school me-2 text-primary"></i>
                <span>E-Sarpras</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <!-- School Info -->
                    <li class="nav-item d-flex align-items-center me-3">
                        <i class="fas fa-building text-primary me-2"></i>
                        <span><?= session()->get('school_name') ?? 'Semua Sekolah' ?></span>
                    </li>
                    
                    <!-- Notifications Dropdown -->
                    <li class="nav-item dropdown me-2">
                        <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Notification counter -->
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                                <span class="visually-hidden">unread notifications</span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="notificationsDropdown" style="min-width: 300px;">
                            <h6 class="dropdown-header">
                                Notifikasi
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="me-3">
                                    <div class="icon-circle bg-primary text-white p-2">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-muted">15 April 2025</div>
                                    <span>Aset baru telah ditambahkan oleh SMPN 1 PPU</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="me-3">
                                    <div class="icon-circle bg-warning text-white p-2">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-muted">14 April 2025</div>
                                    <span>Pengajuan persetujuan aset memerlukan tindakan</span>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-muted" href="#">Tampilkan Semua Notifikasi</a>
                        </div>
                    </li>
                    
                    <!-- User Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-pic me-1">
                                <?php 
                                $username = session()->get('username');
                                if ($username) {
                                    echo strtoupper(substr($username, 0, 1));
                                } else {
                                    echo '<i class="fas fa-user"></i>';
                                }
                                ?>
                            </div>
                            <span class="d-none d-lg-inline ms-1"><?= session()->get('username') ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow user-dropdown" aria-labelledby="userDropdown">
                            <div class="dropdown-header">
                                <h6 class="mb-0"><?= session()->get('username') ?></h6>
                                <small class="text-muted"><?= session()->get('role') ?></small>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                                <i class="fas fa-user-circle me-2 text-primary"></i>
                                Profil Saya
                            </a>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#schoolDetailModal">
                                <i class="fas fa-school me-2 text-success"></i>
                                Detail Sekolah
                            </a>
                            
                            <!-- Superadmin only: Switch School -->
                            <?php if (session()->get('role') === 'superadmin'): ?>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-id-cabang">
                                    <i class="fas fa-exchange-alt me-2 text-info"></i>
                                    Pindah Sekolah
                                </a>
                            <?php endif; ?>
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('logout') ?>">
                                <i class="fas fa-sign-out-alt me-2 text-danger"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Toast Container for Notifications -->
    <div class="toast-container"></div>
    
    <!-- Modal untuk Pindah Lokasi -->
    <div class="modal fade" id="modal-id-cabang" tabindex="-1" aria-labelledby="modalCabangLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="<?= base_url('admin/dashboard/changeSchool') ?>" method="post">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalCabangLabel">
                            <i class="fas fa-exchange-alt me-2"></i>
                            Pilih Lokasi Sekolah
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <p class="text-muted mb-3">Pilih sekolah untuk melihat data inventaris sekolah tersebut:</p>
                        
                        <!-- Dropdown Select2 untuk memilih sekolah -->
                        <select class="form-select select2" name="school_id" required style="width: 100%;">
                            <option disabled selected>-- Pilih Lokasi --</option>

                            <!-- Tambahkan opsi untuk kembali ke sesi superadmin -->
                            <option value="0">Kembali ke Superadmin (Semua Sekolah)</option>

                            <!-- List sekolah -->
                            <?php if (isset($schools) && !empty($schools)): ?>
                                <?php foreach ($schools as $school): ?>
                                    <option value="<?= $school['id'] ?>">
                                        <?= $school['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check me-1"></i> Pilih Sekolah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 pada dropdown
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: "-- Pilih Lokasi --",
                allowClear: true
            });
            
            // Sidebar Toggle
            $("#sidebarToggle").on("click", function() {
                $(".sidebar").toggleClass("sidebar-collapsed");
                // Mengubah lebar konten utama saat sidebar diubah
                if ($(".sidebar").hasClass("sidebar-collapsed")) {
                    $(".main-content").css("margin-left", "70px");
                } else {
                    $(".main-content").css("margin-left", "250px");
                }
            });
            
            // Aktifkan tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>