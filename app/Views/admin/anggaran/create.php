<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h3>Tambah Anggaran</h3>
        <form action="<?= base_url('admin/anggaran/create') ?>" method="post">
          <div class="form-group mb-3">
            <label for="nama_anggaran">Nama Anggaran</label>
            <input type="text" name="nama_anggaran" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control">
              <option value="aktif">Aktif</option>
              <option value="tidak aktif">Tidak Aktif</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Tambah Anggaran</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->include('admin/partials/footer') ?>
