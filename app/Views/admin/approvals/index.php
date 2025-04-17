<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h1 class="mb-4">Daftar Persetujuan Aset</h1>

        <!-- Filter Sekolah -->
        <form action="<?= base_url('admin/approvals') ?>" method="get" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="school_id" class="form-control">
                        <option value="0">Semua Sekolah</option>
                        <?php foreach ($allSchools as $school): ?>
                            <option value="<?= $school['id'] ?>" <?= $school_id == $school['id'] ? 'selected' : '' ?>>
                                <?= $school['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                </div>
            </div>
        </form>

        <!-- Tabel untuk menampilkan daftar approval dengan DataTable -->
        <div class="table-responsive">
          <table id="approvalTable" class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>No.</th>
                <th>Kode Inventaris</th>
                <th>Nama Aset</th>
                <th>Sekolah</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($approvals as $approval): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($approval['kode_inventaris']) ?></td>
                <td><?= htmlspecialchars($approval['nama_aset']) ?></td>
                <td><?= htmlspecialchars($approval['school_name']) ?></td>
                <td><?= htmlspecialchars($approval['status']) ?></td>
                <td class="text-center">
                  <a href="<?= base_url('admin/approvals/edit/' . $approval['id']) ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-eye"></i> Detail & Ubah Status
                  </a>
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

<!-- Inisialisasi DataTables dan jQuery -->
<script>
  $(document).ready(function() {
    $('#approvalTable').DataTable();
  });
</script>
