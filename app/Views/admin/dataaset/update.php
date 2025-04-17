<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h1>Update Kondisi Aset</h1>
        <form action="<?= base_url('admin/dataaset/update/' . $aset['id']) ?>" method="post" enctype="multipart/form-data">
          <!-- Kode Inventaris (Tampil, tidak bisa diubah) -->
          <div class="form-group mb-3">
            <label for="kode_inventaris">Kode Inventaris:</label>
            <input type="text" name="kode_inventaris" class="form-control" value="<?= htmlspecialchars($aset['kode_inventaris']) ?>" readonly>
          </div>

          <!-- Nama Aset (Tampil, tidak bisa diubah) -->
          <div class="form-group mb-3">
            <label for="nama_aset">Nama Aset:</label>
            <input type="text" name="nama_aset" class="form-control" value="<?= htmlspecialchars($aset['nama_aset']) ?>" readonly>
          </div>

          <!-- Tanggal Aset (Tampil, tidak bisa diubah) -->
          <div class="form-group mb-3">
            <label for="tanggal_aset">Tanggal Pembelian Aset:</label>
            <input type="date" name="tanggal_aset" class="form-control" value="<?= htmlspecialchars($aset['tanggal_aset']) ?>" readonly>
          </div>

          <!-- Masa Garansi (Tampil, tidak bisa diubah) -->
          <div class="form-group mb-3">
            <label for="masa_garansi">Masa Garansi (Tahun):</label>
            <input type="number" name="masa_garansi" class="form-control" value="<?= htmlspecialchars($aset['masa_garansi']) ?>" readonly>
          </div>

          <!-- Harga Aset (Tampil, tidak bisa diubah) -->
          <div class="form-group mb-3">
            <label for="harga_aset">Harga Aset:</label>
            <input type="number" name="harga_aset" class="form-control" value="<?= htmlspecialchars($aset['harga_aset']) ?>" readonly>
          </div>

          <!-- Kondisi Aset (Hanya bisa diubah) -->
          <div class="form-group mb-3">
            <label for="kondisi">Kondisi Barang:</label>
            <select name="kondisi" class="form-control" required>
              <option value="baik" <?= $aset['kondisi'] == 'baik' ? 'selected' : '' ?>>Baik</option>
              <option value="rusak_ringan" <?= $aset['kondisi'] == 'rusak_ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
              <option value="rusak_sedang" <?= $aset['kondisi'] == 'rusak_sedang' ? 'selected' : '' ?>>Rusak Sedang</option>
              <option value="rusak_berat" <?= $aset['kondisi'] == 'rusak_berat' ? 'selected' : '' ?>>Rusak Berat</option>
            </select>
          </div>

          <!-- Pada view form update (update.php) -->
          <?php if (in_array($aset['kondisi'], ['rusak_ringan', 'rusak_sedang', 'rusak_berat'])): ?>
            <div class="form-group">
              <label>Ajukan Perbaikan:</label>
              <input type="checkbox" name="ajukan_perbaikan" value="1">
            </div>
          <?php endif; ?>

          <!-- Upload Bukti Baru (opsional) -->
          <div class="form-group mb-3">
            <label for="bukti_gambar">Upload Bukti Gambar (Opsional):</label>
            <input type="file" name="bukti_gambar" class="form-control-file">

            <?php if ($aset['bukti_gambar']) : ?>
              <p>Bukti saat ini:
                <?php
                $fileExtension = pathinfo($aset['bukti_gambar'], PATHINFO_EXTENSION);
                if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) :
                ?>
                  <img src="<?= base_url('assets/uploads/' . $aset['bukti_gambar']) ?>" alt="Bukti Gambar" width="200px">
                <?php else : ?>
                  <a href="<?= base_url('assets/uploads/' . $aset['bukti_gambar']) ?>" target="_blank">Lihat Dokumen</a>
                <?php endif; ?>
              </p>
            <?php endif; ?>
          </div>

          <!-- Tombol Update -->
          <button type="submit" class="btn btn-primary">Update Kondisi Aset</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->include('admin/partials/footer') ?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>