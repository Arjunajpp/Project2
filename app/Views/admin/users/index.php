<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
    <div class="row mt-4">
        <?= $this->include('admin/partials/sidebar') ?>

        <div class="col-md-9">
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-4">Daftar Pengguna untuk Sekolah: <?= $school['name'] ?></h2>
                    <!-- Button Tambah Pengguna -->
                    <a href="<?= base_url('admin/users/create/' . $school['id']) ?>" class="btn btn-primary">Tambah Pengguna</a>
                </div>
                
                <div class="table-responsive">
                    <table id="usersTable" class="table table-striped table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['role'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/users/edit/' . $user['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('admin/users/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('admin/partials/footer') ?>
