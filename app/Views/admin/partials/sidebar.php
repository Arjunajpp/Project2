<div class="col-auto p-0 sidebar">
    <div class="d-flex flex-column h-100">
        <!-- Sidebar Header with Logo - Mobile Only -->
        <div class="d-lg-none d-flex align-items-center justify-content-center py-3 border-bottom">
            <i class="fas fa-school fa-2x text-white"></i>
        </div>
        
        <!-- Main Menu -->
        <div class="list-group list-group-flush flex-grow-1">
            <!-- Link menuju Dashboard -->
            <a href="<?= base_url('admin/dashboard') ?>" class="list-group-item list-group-item-action <?= current_url() == base_url('admin/dashboard') ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <!-- Link menuju Data Aset -->
            <?php if (session()->get('school_id') !== NULL): ?>
                <a href="<?= base_url('admin/dataaset') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), 'admin/dataaset') !== false ? 'active' : '' ?>">
                    <i class="fas fa-boxes"></i>
                    <span>Data Aset</span>
                </a>
            <?php endif; ?>

            <!-- Link untuk Superadmin yang mengakses Semua Sekolah -->
            <?php if (session()->get('role') == 'superadmin' && session()->get('school_id') === NULL): ?>
                <!-- Dropdown untuk Kategori -->
                <a href="#dependencyMenu" class="list-group-item list-group-item-action" data-bs-toggle="collapse" aria-expanded="<?= strpos(current_url(), 'admin/kategori') !== false || strpos(current_url(), 'admin/anggaran') !== false || strpos(current_url(), 'admin/ruangan') !== false ? 'true' : 'false' ?>">
                    <i class="fas fa-folder"></i>
                    <span>Master Data <i class="fas fa-angle-down float-end mt-1"></i></span>
                </a>

                <div id="dependencyMenu" class="collapse <?= strpos(current_url(), 'admin/kategori') !== false || strpos(current_url(), 'admin/anggaran') !== false || strpos(current_url(), 'admin/ruangan') !== false ? 'show' : '' ?>">
                    <!-- Kategori Aset -->
                    <a href="<?= base_url('admin/kategori-aset') ?>" class="list-group-item list-group-item-action ps-4 <?= strpos(current_url(), 'admin/kategori-aset') !== false ? 'active' : '' ?>">
                        <i class="fas fa-box"></i>
                        <span>Kategori Aset</span>
                    </a>

                    <!-- Kategori Data -->
                    <a href="<?= base_url('admin/kategori-data') ?>" class="list-group-item list-group-item-action ps-4 <?= strpos(current_url(), 'admin/kategori-data') !== false ? 'active' : '' ?>">
                        <i class="fas fa-database"></i>
                        <span>Kategori Data</span>
                    </a>

                    <!-- Anggaran -->
                    <a href="<?= base_url('admin/anggaran') ?>" class="list-group-item list-group-item-action ps-4 <?= strpos(current_url(), 'admin/anggaran') !== false ? 'active' : '' ?>">
                        <i class="fas fa-wallet"></i>
                        <span>Anggaran</span>
                    </a>

                    <!-- Ruangan -->
                    <a href="<?= base_url('admin/ruangan') ?>" class="list-group-item list-group-item-action ps-4 <?= strpos(current_url(), 'admin/ruangan') !== false ? 'active' : '' ?>">
                        <i class="fas fa-door-open"></i>
                        <span>Ruangan</span>
                    </a>
                </div>

                <!-- Manage Schools -->
                <a href="<?= base_url('admin/schools') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), 'admin/schools') !== false ? 'active' : '' ?>">
                    <i class="fas fa-school"></i>
                    <span>Manage Sekolah</span>
                </a>

                <!-- Manage Users -->
                <a href="<?= base_url('admin/users') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), 'admin/users') !== false ? 'active' : '' ?>">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                </a>

                <!-- Persetujuan Aset -->
                <a href="<?= base_url('admin/approval') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), 'admin/approval') !== false ? 'active' : '' ?>">
                    <i class="fas fa-check-circle"></i>
                    <span>Persetujuan Aset</span>
                    
                    <!-- Badge untuk menunjukkan jumlah persetujuan yang perlu diproses -->
                    <?php 
                    // Logika untuk menghitung persetujuan yang pending
                    $pendingApprovals = 3; // Ganti dengan data sebenarnya dari database
                    if ($pendingApprovals > 0): 
                    ?>
                    <span class="badge bg-danger rounded-pill float-end"><?= $pendingApprovals ?></span>
                    <?php endif; ?>
                </a>
                
                <!-- Laporan -->
                <a href="<?= base_url('admin/reports') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), 'admin/reports') !== false ? 'active' : '' ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Laporan</span>
                </a>
            <?php endif; ?>
            
            <!-- Pengaturan -->
            <a href="<?= base_url('admin/settings') ?>" class="list-group-item list-group-item-action <?= strpos(current_url(), 'admin/settings') !== false ? 'active' : '' ?>">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </div>
        
        <!-- Sidebar Footer -->
        <div class="mt-auto p-3 d-flex align-items-center justify-content-center">
            <div class="small text-white opacity-75">
                &copy; <?= date('Y') ?> E-Sarpras
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Fix height issue for sidebar scrolling
        const fixSidebarHeight = () => {
            const navbarHeight = $('.navbar').outerHeight();
            $('.sidebar').css('height', `calc(100vh - ${navbarHeight}px)`);
        };
        
        // Call once and on window resize
        fixSidebarHeight();
        $(window).on('resize', fixSidebarHeight);
    });
</script>