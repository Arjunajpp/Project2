<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h1>Tambah Data Aset</h1>
        <form action="<?= base_url('admin/dataaset/store') ?>" method="post" enctype="multipart/form-data">
          <!-- Kode Inventaris -->
          <div class="form-group mb-3">
            <label for="kode_inventaris">Kode Inventaris:</label>
            <input type="text" name="kode_inventaris" class="form-control" required>
          </div>

          <!-- Nama Aset -->
          <div class="form-group mb-3">
            <label for="nama_aset">Nama Aset:</label>
            <input type="text" name="nama_aset" class="form-control" required>
          </div>

          <!-- Tanggal Aset -->
          <div class="form-group mb-3">
            <label for="tanggal_aset">Tanggal Pembelian Aset:</label>
            <input type="date" name="tanggal_aset" class="form-control" required>
          </div>

          <!-- Masa Garansi -->
          <div class="form-group mb-3">
            <label for="masa_garansi">Masa Garansi (Tahun):</label>
            <input type="number" name="masa_garansi" class="form-control" required>
          </div>

          <!-- Harga Aset -->
          <div class="form-group mb-3">
            <label for="harga_aset">Harga Aset:</label>
            <input type="number" name="harga_aset" class="form-control" required>
          </div>

          <!-- Kondisi Aset -->
          <div class="form-group mb-3">
            <label for="kondisi">Kondisi Barang:</label>
            <select name="kondisi" class="form-control" required>
              <option value="baik">Baik</option>
              <option value="rusak_ringan">Rusak Ringan</option>
              <option value="rusak_sedang">Rusak Sedang</option>
              <option value="rusak_berat">Rusak Berat</option>
            </select>
          </div>

          <!-- Nomor Seri -->
          <div class="form-group mb-3">
            <label for="nomor_seri">Nomor Seri (Opsional):</label>
            <input type="text" name="nomor_seri" class="form-control">
          </div>

          <!-- Catatan/Keterangan -->
          <div class="form-group mb-3">
            <label for="catatan">Catatan/Keterangan:</label>
            <textarea name="catatan" class="form-control"></textarea>
          </div>

          <!-- Upload Gambar -->
          <div class="form-group mb-3">
            <label for="bukti_gambar">Upload Bukti Dokumentasi:</label>
            <input type="file" name="bukti_gambar" class="form-control-file">
          </div>

          <!-- Kategori Aset -->
          <div class="form-group mb-3">
            <label for="kategori_aset">Kategori Aset:</label>
            <select name="kategori_aset_id" class="form-control">
              <?php foreach ($kategori_aset as $kategori): ?>
                <option value="<?= $kategori['id'] ?>"><?= $kategori['nama_kategori'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Kategori Data -->
          <div class="form-group mb-3">
            <label for="kategori_data">Kategori Data:</label>
            <select name="kategori_data_id" class="form-control">
              <?php foreach ($kategori_data as $data): ?>
                <option value="<?= $data['id'] ?>"><?= $data['nama_kategori_data'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Anggaran -->
          <div class="form-group mb-3">
            <label for="anggaran">Anggaran:</label>
            <select name="anggaran_id" class="form-control">
              <?php foreach ($anggaran as $item): ?>
                <option value="<?= $item['id'] ?>"><?= $item['nama_anggaran'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Ruangan -->
          <div class="form-group mb-3">
            <label for="ruangan">Ruangan:</label>
            <select name="ruangan_id" class="form-control">
              <?php foreach ($ruangan as $room): ?>
                <option value="<?= $room['id'] ?>"><?= $room['nama_ruangan'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Tombol Simpan -->
          <button type="submit" class="btn btn-primary">Simpan Data Aset</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->include('admin/partials/footer') ?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>