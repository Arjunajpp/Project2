<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h1>Tambah Kategori Data</h1>
        <form action="<?= base_url('admin/kategori-data/store') ?>" method="post">
          <!-- Nama Kategori Data -->
          <div class="form-group mb-3">
            <label for="nama_kategori_data">Nama Kategori Data:</label>
            <input type="text" name="nama_kategori_data" class="form-control" required>
          </div>

          <!-- Status -->
          <div class="form-group mb-3">
            <label for="status">Status:</label>
            <select name="status" class="form-control" required>
              <option value="aktif">Aktif</option>
              <option value="tidak aktif">Tidak Aktif</option>
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
