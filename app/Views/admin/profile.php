<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <!-- Sidebar -->
                    <?= $this->include('admin/partials/sidebar') ?>
                    <h2>Profil User</h2>
                    <ul>
                        <li>Username: <?= isset($user['username']) ? $user['username'] : 'Tidak ada username' ?></li>
                        <li>Email: <?= isset($user['email']) ? $user['email'] : 'Tidak ada email' ?></li>
                        <li>Sekolah: <?= isset($school['name']) ? $school['name'] : 'Tidak ada sekolah terkait' ?></li>
                    </ul>
                    <a href="<?= base_url('school/detail/' . $user['school_id']) ?>" class="btn btn-primary">Detail Sekolah</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?= $this->include('admin/partials/footer') ?>