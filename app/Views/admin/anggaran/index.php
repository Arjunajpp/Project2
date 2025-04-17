<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h1>Daftar Anggaran</h1>
        
        <!-- Tombol Tambah Anggaran hanya untuk Superadmin -->
        <?php if (session()->get('role') === 'superadmin'): ?>
            <a href="<?= base_url('admin/anggaran/create') ?>" class="btn btn-success mb-3">Tambah Anggaran</a>
        <?php endif; ?>
        
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nama Anggaran</th>
                <th>Status</th>
                <?php if (session()->get('role') === 'superadmin'): ?>
                    <th>Aksi</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($anggaran as $item): ?>
              <tr>
                <td><?= $item['nama_anggaran'] ?></td>
                <td><?= ucfirst($item['status']) ?></td>
                <?php if (session()->get('role') === 'superadmin'): ?>
                    <td>
                      <a href="<?= base_url('admin/anggaran/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                      <a href="<?= base_url('admin/anggaran/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
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
