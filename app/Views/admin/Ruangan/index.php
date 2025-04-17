<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h1>Daftar Ruangan</h1>
        
        <!-- Tombol Tambah Ruangan hanya untuk Superadmin -->
        <?php if (session()->get('role') === 'superadmin'): ?>
          <a href="<?= base_url('admin/ruangan/create') ?>" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah Ruangan
          </a>
        <?php endif; ?>
        
        <!-- Tabel Ruangan -->
        <div class="table-responsive">
          <table class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>Nama Ruangan</th>
                <th>Status</th>
                <?php if (session()->get('role') === 'superadmin'): ?>
                  <th>Aksi</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ruangan as $item): ?>
              <tr>
                <td><?= htmlspecialchars($item['nama_ruangan']) ?></td>
                <td><?= ucfirst($item['status']) ?></td>
                <?php if (session()->get('role') === 'superadmin'): ?>
                  <td>
                    <a href="<?= base_url('admin/ruangan/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="<?= base_url('admin/ruangan/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                      <i class="fas fa-trash-alt"></i> Delete
                    </a>
                  </td>
                <?php endif; ?>
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
