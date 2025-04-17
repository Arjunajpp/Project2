<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h1>Edit Kategori Aset</h1>
        <form action="<?= base_url('admin/kategori-aset/update/' . $kategori_aset['id']) ?>" method="post">
          <!-- Nama Kategori -->
          <div class="form-group mb-3">
            <label for="nama_kategori">Nama Kategori:</label>
            <input type="text" name="nama_kategori" class="form-control" value="<?= htmlspecialchars($kategori_aset['nama_kategori']) ?>" required>
          </div>

          <!-- Status Kategori -->
          <div class="form-group mb-3">
            <label for="status">Status:</label>
            <select name="status" class="form-control" required>
              <option value="aktif" <?= $kategori_aset['status'] === 'aktif' ? 'selected' : '' ?>>Aktif</option>
              <option value="tidak aktif" <?= $kategori_aset['status'] === 'tidak aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
            </select>
          </div>

          <!-- Tombol Simpan -->
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->include('admin/partials/footer') ?>
