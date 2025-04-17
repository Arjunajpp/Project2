
<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
    <div class="row mt-4">
        <?= $this->include('admin/partials/sidebar') ?>

        <div class="col-md-9">
            <div class="container mt-5">
                <h2 class="mb-4">Pilih Sekolah untuk Melihat Pengguna</h2>
                <div class="row justify-content-center">
                    <?php foreach ($schools as $school): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card shadow-sm h-100 border-0">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title mb-3"><?= strtoupper($school['name']) ?></h5>
                                    <p class="card-text text-muted flex-grow-1"><?= $school['alamat_sekolah'] ?></p>
                                    <a href="<?= base_url('admin/users/index/' . $school['id']) ?>" class="btn btn-outline-success btn-circle">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('admin/partials/footer') ?>