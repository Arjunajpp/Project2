<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h1 class="mb-4">Detail Persetujuan Aset</h1>

        <table class="table table-bordered">
            <tr>
                <th>Nama Aset</th>
                <td><?= htmlspecialchars($approval['nama_aset']) ?></td>
            </tr>
            <tr>
                <th>Sekolah</th>
                <td><?= htmlspecialchars($approval['school_name']) ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= htmlspecialchars($approval['status']) ?></td>
            </tr>
            <tr>
                <th>Catatan</th>
                <td><?= isset($approval['note']) ? htmlspecialchars($approval['note']) : 'Tidak ada catatan' ?></td>
            </tr>
        </table>

        <!-- Jika status 'Sedang Ditinjau', tampilkan tombol setujui/tolak -->
        <?php if($approval['status'] == 'Sedang Ditinjau'): ?>
            <form action="<?= base_url('admin/approval/approve/'.$approval['id']) ?>" method="post" class="d-inline">
                <div class="form-group">
                    <label for="documentation">Upload Dokumentasi (opsional):</label>
                    <input type="file" name="documentation" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-success">Setujui</button>
            </form>
            <form action="<?= base_url('admin/approval/reject/'.$approval['id']) ?>" method="post" class="d-inline">
                <button type="submit" class="btn btn-danger">Tolak</button>
            </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?= $this->include('admin/partials/footer') ?>
