<div class="container mt-5">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Informasi</th>
          <th scope="col">Detail</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Kode Inventaris</th>
          <td><?= htmlspecialchars($aset['kode_inventaris']) ?></td>
        </tr>
        <tr>
          <th>Nama Aset</th>
          <td><?= htmlspecialchars($aset['nama_aset']) ?></td>
        </tr>
        <tr>
          <th>Tanggal Aset</th>
          <td><?= htmlspecialchars($aset['tanggal_aset']) ?></td>
        </tr>
        <tr>
          <th>Masa Garansi</th>
          <td><?= htmlspecialchars($aset['masa_garansi']) ?></td>
        </tr>
        <tr>
          <th>Harga Aset</th>
          <td>Rp. <?= number_format($aset['harga_aset'], 2, ',', '.') ?></td>
        </tr>
        <tr>
          <th>Kondisi</th>
          <td>
            <?php
            $kondisi = [
              'baik' => 'Baik',
              'rusak_ringan' => 'Rusak Ringan',
              'rusak_sedang' => 'Rusak Sedang',
              'rusak_berat' => 'Rusak Berat'
            ];
            echo htmlspecialchars($kondisi[$aset['kondisi']]);
            ?>
          </td>
        </tr>
        <tr>
          <th>Nomor Seri</th>
          <td><?= htmlspecialchars($aset['nomor_seri']) ?></td>
        </tr>
        <tr>
          <th>Catatan</th>
          <td><?= htmlspecialchars($aset['catatan']) ?></td>
        </tr>
        <tr>
          <th>Kategori Aset</th>
          <td><?= htmlspecialchars($aset['kategori_aset']) ?></td>
        </tr>
        <tr>
          <th>Kategori Data</th>
          <td><?= htmlspecialchars($aset['kategori_data']) ?></td>
        </tr>
        <tr>
          <th>Anggaran</th>
          <td><?= htmlspecialchars($aset['anggaran']) ?></td>
        </tr>
        <tr>
          <th>Ruangan</th>
          <td><?= htmlspecialchars($aset['ruangan']) ?></td>
        </tr>
        <tr>
          <th>Bukti Dokumentasi</th>
          <td>
            <?php
            // Mendapatkan ekstensi file
            $fileExtension = pathinfo($aset['bukti_gambar'], PATHINFO_EXTENSION);

            // Tentukan tipe file untuk menampilkan preview atau download
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Daftar ekstensi gambar
            $documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx']; // Daftar ekstensi dokumen

            if (in_array(strtolower($fileExtension), $imageExtensions)) :
              // Jika file adalah gambar, tampilkan gambar
            ?>
              <img src="<?= base_url('assets/uploads/' . $aset['bukti_gambar']) ?>" alt="Dokumentasi" width="200px">
            <?php
            elseif (in_array(strtolower($fileExtension), $documentExtensions)) :
              // Jika file adalah dokumen, tampilkan tautan untuk mengunduh atau melihat
            ?>
              <a href="<?= base_url('assets/uploads/' . $aset['bukti_gambar']) ?>" target="_blank">Lihat Dokumen</a>
            <?php else : ?>
              <!-- Jika bukan file yang dikenali, tampilkan pesan -->
              <p>File tidak dapat ditampilkan. <a href="<?= base_url('assets/uploads/' . $aset['bukti_gambar']) ?>" download>Unduh File</a></p>
            <?php endif; ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<?= $this->include('admin/partials/footer') ?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>