<?= $this->include('admin/partials/header') ?>

<div class="container-fluid p-0">
    <div class="row g-0">
        <?= $this->include('admin/partials/sidebar') ?>

        <div class="col-md-9 col-lg-10 main-content">
            <!-- Header Section with Profile Button -->
            <div class="d-flex justify-content-between align-items-center p-4 bg-white shadow-sm sticky-top">
                <div>
                    <h4 class="m-0 fw-bold">Dashboard E-Sarpras</h4>
                </div>
                <div class="d-flex align-items-center">
                    <?php if (session()->get('school_id') == null): ?>
                        <button id="filterToggleBtn" class="btn btn-outline-primary me-3">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                    <?php endif; ?>
                    
                    <div class="dropdown">
                        <button class="btn btn-light rounded-circle p-2 d-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 42px; height: 42px;">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li class="dropdown-header px-4 py-3">
                                <h6 class="mb-0 fw-bold"><?= session()->get('username') ?></h6>
                                <small class="text-muted"><?= session()->get('role') ?></small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                                <i class="fas fa-user-circle me-2 text-primary"></i> Profil Saya
                            </a></li>
                            <li><a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#schoolDetailModal">
                                <i class="fas fa-school me-2 text-success"></i> Detail Sekolah
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item py-2" href="<?= base_url('logout') ?>">
                                <i class="fas fa-sign-out-alt me-2 text-danger"></i> Logout
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-4">
                <!-- Filter Section for Superadmin -->
                <?php if (session()->get('school_id') == null): ?>
                    <div id="filterForm" class="card mb-4 border-0 shadow-sm" style="display: none;">
                        <div class="card-body p-4">
                            <form method="get" action="<?= base_url('admin/dashboard') ?>">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="schoolFilter" class="form-label small fw-bold text-muted">
                                            <i class="fas fa-school me-1"></i> Sekolah
                                        </label>
                                        <select name="school_id" id="schoolFilter" class="form-select form-select-sm">
                                            <option value="0" <?= $school_id == 0 ? 'selected' : '' ?>>Semua Sekolah</option>
                                            <?php foreach ($allSchools as $school): ?>
                                                <option value="<?= $school['id'] ?>" <?= $school_id == $school['id'] ? 'selected' : '' ?>>
                                                    <?= $school['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="startDate" class="form-label small fw-bold text-muted">
                                            <i class="far fa-calendar-alt me-1"></i> Mulai Tanggal
                                        </label>
                                        <input type="date" name="start_date" id="startDate" class="form-control form-control-sm" value="<?= $start_date ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="endDate" class="form-label small fw-bold text-muted">
                                            <i class="far fa-calendar-alt me-1"></i> Sampai Tanggal
                                        </label>
                                        <input type="date" name="end_date" id="endDate" class="form-control form-control-sm" value="<?= $end_date ?>">
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" id="resetFilterBtn" class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="fas fa-undo me-1"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-search me-1"></i> Terapkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Current Filter Info -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h6 class="mb-1 text-muted">
                            <i class="fas fa-filter me-1"></i> Filter Aktif:
                            <span class="fw-bold"><?= $school_id == 0 ? 'Semua Sekolah' : (session()->get('school_name') ?? 'Sekolah Tertentu') ?></span> | 
                            <span class="fw-bold"><?= date('d M Y', strtotime($start_date)) ?> - <?= date('d M Y', strtotime($end_date)) ?></span>
                        </h6>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-success">
                            <i class="fas fa-download me-1"></i> Export Data
                        </button>
                    </div>
                </div>

                <!-- Info Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="d-flex">
                                    <div class="col-4 p-3 d-flex align-items-center justify-content-center bg-gradient-primary text-white">
                                        <i class="fas fa-money-bill-wave fa-2x"></i>
                                    </div>
                                    <div class="col-8 p-3">
                                        <p class="text-muted small mb-1">Total Harga Aset</p>
                                        <h4 class="fw-bold mb-0">Rp <?= number_format($totalHargaAset, 0, ',', '.'); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="d-flex">
                                    <div class="col-4 p-3 d-flex align-items-center justify-content-center bg-gradient-success text-white">
                                        <i class="fas fa-boxes fa-2x"></i>
                                    </div>
                                    <div class="col-8 p-3">
                                        <p class="text-muted small mb-1">Total Aset</p>
                                        <h4 class="fw-bold mb-0">
                                            <?php 
                                            $totalAssets = 0;
                                            foreach ($totalAsetPerKategori as $item) {
                                                $totalAssets += $item['total'];
                                            }
                                            echo number_format($totalAssets, 0, ',', '.');
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="d-flex">
                                    <div class="col-4 p-3 d-flex align-items-center justify-content-center bg-gradient-info text-white">
                                        <i class="fas fa-door-open fa-2x"></i>
                                    </div>
                                    <div class="col-8 p-3">
                                        <p class="text-muted small mb-1">Ruangan</p>
                                        <h4 class="fw-bold mb-0"><?= count($ruangan) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row g-4 mb-4">
                    <!-- Kategori Aset Chart -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <div class="card-header bg-white py-3 border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold text-primary">
                                        <i class="fas fa-chart-bar me-2"></i> Statistik Per Kategori
                                    </h6>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary chart-type-selector" data-chart="kategoriAsetChart" data-type="bar">
                                            <i class="fas fa-chart-bar"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary chart-type-selector" data-chart="kategoriAsetChart" data-type="pie">
                                            <i class="fas fa-chart-pie"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary chart-type-selector" data-chart="kategoriAsetChart" data-type="doughnut">
                                            <i class="fas fa-circle-notch"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" style="position: relative; height: 250px;">
                                    <canvas id="kategoriAsetChart"></canvas>
                                </div>
                                
                                <!-- Tabel Data -->
                                <div class="table-responsive mt-4">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Kategori</th>
                                                <th class="text-end">Jumlah</th>
                                                <th class="text-end">Persentase</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach ($kategoriAset as $kategori): 
                                                $total = $kategoriMapping[$kategori['nama_kategori']] ?? 0;
                                                $percentage = $totalAssets > 0 ? ($total / $totalAssets * 100) : 0;
                                            ?>
                                            <tr>
                                                <td><span class="badge bg-light text-dark"><?= $kategori['nama_kategori'] ?></span></td>
                                                <td class="text-end"><?= number_format($total, 0, ',', '.') ?></td>
                                                <td class="text-end"><?= number_format($percentage, 1) ?>%</td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Ruangan Chart -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                            <div class="card-header bg-white py-3 border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold text-primary">
                                        <i class="fas fa-chart-bar me-2"></i> Statistik Per Ruangan
                                    </h6>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary chart-type-selector" data-chart="ruanganChart" data-type="bar">
                                            <i class="fas fa-chart-bar"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary chart-type-selector" data-chart="ruanganChart" data-type="pie">
                                            <i class="fas fa-chart-pie"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary chart-type-selector" data-chart="ruanganChart" data-type="doughnut">
                                            <i class="fas fa-circle-notch"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" style="position: relative; height: 250px;">
                                    <canvas id="ruanganChart"></canvas>
                                </div>
                                
                                <!-- Tabel Data -->
                                <div class="table-responsive mt-4">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Ruangan</th>
                                                <th class="text-end">Jumlah</th>
                                                <th class="text-end">Persentase</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach ($ruangan as $r): 
                                                $total = $ruanganMapping[$r['nama_ruangan']] ?? 0;
                                                $percentage = $totalAssets > 0 ? ($total / $totalAssets * 100) : 0;
                                            ?>
                                            <tr>
                                                <td><span class="badge bg-light text-dark"><?= $r['nama_ruangan'] ?></span></td>
                                                <td class="text-end"><?= number_format($total, 0, ',', '.') ?></td>
                                                <td class="text-end"><?= number_format($percentage, 1) ?>%</td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kondisi Aset Section -->
                <div class="row g-4 mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header bg-white py-3 border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold text-primary">
                                        <i class="fas fa-clipboard-check me-2"></i> Kondisi Aset
                                    </h6>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> Lihat Detail
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <div class="chart-container" style="position: relative; height: 250px;">
                                            <canvas id="kondisiChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-sm align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col">Kondisi</th>
                                                        <th scope="col" class="text-end">Jumlah</th>
                                                        <th scope="col" class="text-end">Persentase</th>
                                                        <th scope="col" class="text-center">Status</th>
                                                        <th scope="col" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><span class="badge bg-success">Baik</span></td>
                                                        <td class="text-end">
                                                            <?php
                                                                // Hitung total berdasarkan kondisi
                                                                $kondisiBaik = 0;
                                                                foreach ($totalAsetPerKategori as $item) {
                                                                    $kondisiBaik += $item['total_baik'] ?? 0;
                                                                }
                                                                echo number_format($kondisiBaik, 0, ',', '.');
                                                            ?>
                                                        </td>
                                                        <td class="text-end"><?= $totalAssets > 0 ? number_format(($kondisiBaik / $totalAssets * 100), 1) : 0 ?>%</td>
                                                        <td class="text-center"><i class="fas fa-check-circle text-success"></i></td>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-warning text-dark">Rusak Ringan</span></td>
                                                        <td class="text-end">
                                                            <?php
                                                                $kondisiRusakRingan = 0;
                                                                foreach ($totalAsetPerKategori as $item) {
                                                                    $kondisiRusakRingan += $item['total_rusak_ringan'] ?? 0;
                                                                }
                                                                echo number_format($kondisiRusakRingan, 0, ',', '.');
                                                            ?>
                                                        </td>
                                                        <td class="text-end"><?= $totalAssets > 0 ? number_format(($kondisiRusakRingan / $totalAssets * 100), 1) : 0 ?>%</td>
                                                        <td class="text-center"><i class="fas fa-exclamation-circle text-warning"></i></td>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-danger">Rusak Sedang</span></td>
                                                        <td class="text-end">
                                                            <?php
                                                                $kondisiRusakSedang = 0;
                                                                foreach ($totalAsetPerKategori as $item) {
                                                                    $kondisiRusakSedang += $item['total_rusak_sedang'] ?? 0;
                                                                }
                                                                echo number_format($kondisiRusakSedang, 0, ',', '.');
                                                            ?>
                                                        </td>
                                                        <td class="text-end"><?= $totalAssets > 0 ? number_format(($kondisiRusakSedang / $totalAssets * 100), 1) : 0 ?>%</td>
                                                        <td class="text-center"><i class="fas fa-exclamation-triangle text-danger"></i></td>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-dark">Rusak Berat</span></td>
                                                        <td class="text-end">
                                                            <?php
                                                                $kondisiRusakBerat = 0;
                                                                foreach ($totalAsetPerKategori as $item) {
                                                                    $kondisiRusakBerat += $item['total_rusak_berat'] ?? 0;
                                                                }
                                                                echo number_format($kondisiRusakBerat, 0, ',', '.');
                                                            ?>
                                                        </td>
                                                        <td class="text-end"><?= $totalAssets > 0 ? number_format(($kondisiRusakBerat / $totalAssets * 100), 1) : 0 ?>%</td>
                                                        <td class="text-center"><i class="fas fa-times-circle text-dark"></i></td>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Latest Updates Section -->
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header bg-white py-3 border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-bold text-primary">
                                        <i class="fas fa-history me-2"></i> Aktivitas Terbaru
                                    </h6>
                                    <div>
                                        <a href="<?= base_url('admin/dataaset') ?>" class="btn btn-sm btn-outline-primary">
                                            Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-sm align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Kode</th>
                                                <th scope="col">Nama Aset</th>
                                                <th scope="col">Sekolah</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data dinamis akan ditampilkan di sini -->
                                            <tr>
                                                <td><small class="text-muted"><?= date('d/m/Y', strtotime('-1 day')) ?></small></td>
                                                <td><code>INV-001</code></td>
                                                <td>Komputer</td>
                                                <td><span class="badge bg-light text-dark">SMPN 1 PPU</span></td>
                                                <td><span class="badge bg-success">Baik</span></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><small class="text-muted"><?= date('d/m/Y', strtotime('-2 day')) ?></small></td>
                                                <td><code>INV-002</code></td>
                                                <td>Proyektor</td>
                                                <td><span class="badge bg-light text-dark">SMPN 2 PPU</span></td>
                                                <td><span class="badge bg-warning text-dark">Rusak Ringan</span></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><small class="text-muted"><?= date('d/m/Y', strtotime('-3 day')) ?></small></td>
                                                <td><code>INV-003</code></td>
                                                <td>Meja Guru</td>
                                                <td><span class="badge bg-light text-dark">SMPN 3 PPU</span></td>
                                                <td><span class="badge bg-success">Baik</span></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><small class="text-muted"><?= date('d/m/Y', strtotime('-4 day')) ?></small></td>
                                                <td><code>INV-004</code></td>
                                                <td>AC Split</td>
                                                <td><span class="badge bg-light text-dark">SMPN 4 PPU</span></td>
                                                <td><span class="badge bg-danger">Rusak Sedang</span></td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Profile -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Profil Pengguna</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="avatar rounded-circle bg-light p-3 mx-auto mb-3" style="width: 100px; height: 100px;">
                        <i class="fas fa-user-circle fa-4x text-primary"></i>
                    </div>
                    <h5 class="fw-bold"><?= session()->get('username') ?></h5>
                    <p class="text-muted"><?= session()->get('role') ?></p>
                </div>
                
                <div class="list-group list-group-flush mb-4">
                    <div class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Username:</span>
                        <span class="fw-bold"><?= session()->get('username') ?></span>
                    </div>
                    <div class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Email:</span>
                        <span class="fw-bold"><?= session()->get('email') ?></span>
                    </div>
                    <div class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">Sekolah:</span>
                        <span class="fw-bold"><?= session()->get('school_name') ?? 'Semua Sekolah' ?></span>
                    </div>
                    <div class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">NPSN:</span>
                        <span class="fw-bold"><?= session()->get('npsn') ?? 'N/A' ?></span>
                    </div>
                </div>
                
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary" data-bs-dismiss="modal">
                        <i class="fas fa-edit me-1"></i> Edit Profil
                    </button>
                    <a href="<?= base_url('logout') ?>" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal School Detail -->
<div class="modal fade" id="schoolDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Detail Sekolah</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <?php if (session()->get('school_id')): ?>
                    <?php 
                    // Ambil data sekolah berdasarkan school_id di session
                    $currentSchool = null;
                    foreach ($allSchools ?? [] as $school) {
                        if ($school['id'] == session()->get('school_id')) {
                            $currentSchool = $school;
                            break;
                        }
                    }
                    ?>
                    
                    <?php if ($currentSchool): ?>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <?php if (isset($currentSchool['foto']) && !empty($currentSchool['foto'])): ?>
                                    <img src="<?= base_url('uploads/schools/' . $currentSchool['foto']) ?>" class="img-fluid rounded-4 shadow-sm" alt="<?= $currentSchool['name'] ?>">
                                <?php else: ?>
                                    <div class="bg-light rounded-4 d-flex align-items-center justify-content-center p-5 text-center h-100">
                                        <div>
                                            <i class="fas fa-school fa-4x text-muted mb-3"></i>
                                            <p class="text-muted">Foto sekolah tidak tersedia</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-3"><?= $currentSchool['name'] ?></h5>
                                
                                <div class="list-group list-group-flush mb-4">
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Kategori:</span>
                                        <span class="badge bg-primary"><?= $currentSchool['category'] ?></span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Alamat:</span>
                                        <span class="fw-bold"><?= $currentSchool['alamat_sekolah'] ?? 'N/A' ?></span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Kepsek:</span>
                                        <span class="fw-bold"><?= $currentSchool['nama_kepala_sekolah'] ?? 'N/A' ?></span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Email:</span>
                                        <span class="fw-bold"><?= $currentSchool['alamat_email'] ?? 'N/A' ?></span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Telepon:</span>
                                        <span class="fw-bold"><?= $currentSchool['nomor_telepon'] ?? 'N/A' ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-primary mb-3">Informasi Lahan & Fasilitas</h6>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Status Lahan:</span>
                                        <span class="fw-bold"><?= $currentSchool['status_lahan'] ?? 'N/A' ?></span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Luas Lahan:</span>
                                        <span class="fw-bold"><?= ($currentSchool['luas_lahan'] ?? 0) . ' m²' ?></span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Daya Listrik:</span>
                                        <span class="fw-bold"><?= ($currentSchool['daya_listrik'] ?? 0) . ' VA' ?></span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Instalasi Air:</span>
                                        <span class="fw-bold"><?= $currentSchool['instalasi_air'] ?? 'N/A' ?></span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Status Internet:</span>
                                        <span class="badge bg-<?= ($currentSchool['status_internet'] == 'Ada') ? 'success' : 'danger' ?>"><?= $currentSchool['status_internet'] ?? 'N/A' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-primary mb-3">Data Siswa & Rombel</h6>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Jumlah Siswa Laki-laki:</span>
                                        <span class="fw-bold"><?= number_format($currentSchool['jumlah_siswa_laki'] ?? 0, 0, ',', '.') ?> siswa</span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Jumlah Siswi:</span>
                                        <span class="fw-bold"><?= number_format($currentSchool['jumlah_siswi'] ?? 0, 0, ',', '.') ?> siswi</span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Total Siswa:</span>
                                        <span class="fw-bold"><?= number_format(($currentSchool['jumlah_siswa_laki'] ?? 0) + ($currentSchool['jumlah_siswi'] ?? 0), 0, ',', '.') ?> siswa</span>
                                    </div>
                                    <div class="list-group-item px-0 py-2 d-flex justify-content-between">
                                        <span class="text-muted">Total Rombel:</span>
                                        <span class="fw-bold"><?= number_format($currentSchool['total_rombel'] ?? 0, 0, ',', '.') ?> rombel</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 d-flex justify-content-between">
                            <button class="btn btn-outline-success" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Tutup
                            </button>
                            <?php if (session()->get('role') === 'superadmin' || session()->get('role') === 'admin'): ?>
                                <a href="<?= base_url('admin/schools/edit/' . $currentSchool['id']) ?>" class="btn btn-success">
                                    <i class="fas fa-edit me-1"></i> Edit Sekolah
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-school fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Data sekolah tidak ditemukan</h5>
                            <?php if (session()->get('role') === 'superadmin'): ?>
                                <p>Anda login sebagai superadmin untuk semua sekolah.</p>
                                <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#modal-id-cabang">
                                    <i class="fas fa-exchange-alt me-1"></i> Pilih Sekolah
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-school fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada sekolah yang dipilih</h5>
                        <?php if (session()->get('role') === 'superadmin'): ?>
                            <p>Anda login sebagai superadmin untuk semua sekolah.</p>
                            <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#modal-id-cabang">
                                <i class="fas fa-exchange-alt me-1"></i> Pilih Sekolah
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->include('admin/partials/footer') ?>

<!-- Custom styles untuk dashboard -->
<style>
    /* Warna gradient untuk card */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
    .bg-gradient-success {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
    }
    .bg-gradient-info {
        background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
    }
    
    /* Rounded card design */
    .rounded-4 {
        border-radius: 1rem!important;
    }
    
    /* Main content area */
    .main-content {
        background-color: #f8f9fc;
        min-height: 100vh;
    }
    
    /* Chart container */
    .chart-container {
        position: relative;
        width: 100%;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
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
    
    /* Table improvements */
    .table-sm {
        font-size: 0.85rem;
    }
    
    /* Shadow transitions */
    .card {
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1)!important;
    }
</style>

<script>
    $(document).ready(function() {
        // Toggle visibility of the filter form
        <?php if (session()->get('school_id') == null): ?>
            $('#filterToggleBtn').on('click', function() {
                $('#filterForm').toggle('fade', {}, 300);
                if ($('#filterForm').is(':visible')) {
                    $(this).html('<i class="fas fa-times me-1"></i> Sembunyikan');
                    $(this).removeClass('btn-outline-primary').addClass('btn-primary');
                } else {
                    $(this).html('<i class="fas fa-filter me-1"></i> Filter');
                    $(this).removeClass('btn-primary').addClass('btn-outline-primary');
                }
            });
            
            $('#resetFilterBtn').on('click', function() {
                window.location.href = '<?= base_url('admin/dashboard') ?>';
            });
        <?php endif; ?>

        // Chart color palettes
        const colorPalette1 = [
            'rgba(54, 162, 235, 0.8)', 'rgba(255, 99, 132, 0.8)', 
            'rgba(75, 192, 192, 0.8)', 'rgba(255, 159, 64, 0.8)',
            'rgba(153, 102, 255, 0.8)', 'rgba(255, 205, 86, 0.8)',
            'rgba(201, 203, 207, 0.8)', 'rgba(255, 99, 71, 0.8)',
            'rgba(60, 179, 113, 0.8)', 'rgba(106, 90, 205, 0.8)'
        ];
        
        const colorPalette2 = [
            'rgba(75, 192, 192, 0.8)', 'rgba(255, 159, 64, 0.8)',
            'rgba(153, 102, 255, 0.8)', 'rgba(255, 205, 86, 0.8)',
            'rgba(54, 162, 235, 0.8)', 'rgba(255, 99, 132, 0.8)', 
            'rgba(201, 203, 207, 0.8)', 'rgba(255, 99, 71, 0.8)',
            'rgba(60, 179, 113, 0.8)', 'rgba(106, 90, 205, 0.8)'
        ];
        
        // Kondisi aset colors
        const kondisiColors = [
            'rgba(40, 167, 69, 0.8)',  // Baik (success)
            'rgba(255, 193, 7, 0.8)',  // Rusak Ringan (warning)
            'rgba(220, 53, 69, 0.8)',  // Rusak Sedang (danger)
            'rgba(52, 58, 64, 0.8)'    // Rusak Berat (dark)
        ];
        
        // Chart data untuk kategori
        const kategoriLabels = [];
        const kategoriData = [];
        
        <?php 
        // Membuat mapping data dari hasil query
        $kategoriMapping = [];
        foreach ($totalAsetPerKategori as $item) {
            $kategoriMapping[$item['nama_kategori']] = $item['total'];
        }
        ?>
        
        // Data dari hasil query
        const kategoriMapping = <?= json_encode($kategoriMapping) ?>;
        
        // Untuk setiap kategori, ambil nilainya dari mapping atau 0 jika tidak ada
        <?php foreach ($kategoriAset as $kategori): ?>
            kategoriLabels.push('<?= $kategori['nama_kategori'] ?>');
            kategoriData.push(kategoriMapping['<?= $kategori['nama_kategori'] ?>'] || 0);
        <?php endforeach; ?>
        
        // Chart data untuk ruangan
        const ruanganLabels = [];
        const ruanganData = [];
        
        <?php 
        // Membuat mapping data dari hasil query
        $ruanganMapping = [];
        foreach ($totalAsetPerRuangan as $item) {
            $ruanganMapping[$item['nama_ruangan']] = $item['total'];
        }
        ?>
        
        // Data dari hasil query
        const ruanganMapping = <?= json_encode($ruanganMapping) ?>;
        
        // Untuk setiap ruangan, ambil nilainya dari mapping atau 0 jika tidak ada
        <?php foreach ($ruangan as $r): ?>
            ruanganLabels.push('<?= $r['nama_ruangan'] ?>');
            ruanganData.push(ruanganMapping['<?= $r['nama_ruangan'] ?>'] || 0);
        <?php endforeach; ?>
        
        // Data untuk kondisi aset
        const kondisiLabels = ['Baik', 'Rusak Ringan', 'Rusak Sedang', 'Rusak Berat'];
        const kondisiData = [
            <?= $kondisiBaik ?? 0 ?>, 
            <?= $kondisiRusakRingan ?? 0 ?>, 
            <?= $kondisiRusakSedang ?? 0 ?>, 
            <?= $kondisiRusakBerat ?? 0 ?>
        ];
        
        // Chart objects
        let kategoriAsetChart;
        let ruanganChart;
        let kondisiChart;
        
        // Create charts
        createKategoriChart('bar');
        createRuanganChart('bar');
        createKondisiChart();
        
        // Function to create kategori chart
        function createKategoriChart(type) {
            const ctx = document.getElementById('kategoriAsetChart').getContext('2d');
            
            // Destroy existing chart if it exists
            if (kategoriAsetChart) {
                kategoriAsetChart.destroy();
            }
            
            const config = {
                type: type,
                data: {
                    labels: kategoriLabels,
                    datasets: [{
                        label: 'Jumlah Aset',
                        data: kategoriData,
                        backgroundColor: colorPalette1,
                        borderColor: colorPalette1.map(color => color.replace('0.8', '1')),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: type !== 'bar',
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || 0;
                                    let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let percentage = total > 0 ? Math.round((value / total * 100) * 10) / 10 : 0;
                                    
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            display: type === 'bar',
                            beginAtZero: true
                        },
                        x: {
                            display: type === 'bar'
                        }
                    }
                }
            };
            
            kategoriAsetChart = new Chart(ctx, config);
        }
        
        // Function to create ruangan chart
        function createRuanganChart(type) {
            const ctx = document.getElementById('ruanganChart').getContext('2d');
            
            // Destroy existing chart if it exists
            if (ruanganChart) {
                ruanganChart.destroy();
            }
            
            const config = {
                type: type,
                data: {
                    labels: ruanganLabels,
                    datasets: [{
                        label: 'Jumlah Aset',
                        data: ruanganData,
                        backgroundColor: colorPalette2,
                        borderColor: colorPalette2.map(color => color.replace('0.8', '1')),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: type !== 'bar',
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || 0;
                                    let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let percentage = total > 0 ? Math.round((value / total * 100) * 10) / 10 : 0;
                                    
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            display: type === 'bar',
                            beginAtZero: true
                        },
                        x: {
                            display: type === 'bar'
                        }
                    }
                }
            };
            
            ruanganChart = new Chart(ctx, config);
        }
        
        // Function to create kondisi chart (doughnut by default)
        function createKondisiChart() {
            const ctx = document.getElementById('kondisiChart').getContext('2d');
            
            // Destroy existing chart if it exists
            if (kondisiChart) {
                kondisiChart.destroy();
            }
            
            const config = {
                type: 'doughnut',
                data: {
                    labels: kondisiLabels,
                    datasets: [{
                        data: kondisiData,
                        backgroundColor: kondisiColors,
                        borderColor: kondisiColors.map(color => color.replace('0.8', '1')),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || 0;
                                    let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let percentage = total > 0 ? Math.round((value / total * 100) * 10) / 10 : 0;
                                    
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            };
            
            kondisiChart = new Chart(ctx, config);
        }
        
        // Chart type selector
        $('.chart-type-selector').on('click', function(e) {
            e.preventDefault();
            
            const chartId = $(this).data('chart');
            const chartType = $(this).data('type');
            
            // Update active state
            $(this).closest('.btn-group').find('.btn').removeClass('active btn-secondary').addClass('btn-outline-secondary');
            $(this).removeClass('btn-outline-secondary').addClass('active btn-secondary');
            
            if (chartId === 'kategoriAsetChart') {
                createKategoriChart(chartType);
            } else if (chartId === 'ruanganChart') {
                createRuanganChart(chartType);
            }
        });
    });
</script>