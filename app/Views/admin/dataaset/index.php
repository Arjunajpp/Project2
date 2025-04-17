<?= $this->include('admin/partials/header') ?>

<div class="container-fluid">
  <div class="row mt-4">
    <?= $this->include('admin/partials/sidebar') ?>

    <div class="col-md-9">
      <div class="container mt-5">
        <h1 class="mb-4">Daftar Data Aset</h1>

        <!-- Button untuk menambahkan Data Aset baru -->
        <div class="d-flex justify-content-between mb-3">
          <a href="<?= base_url('admin/dataaset/create') ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Tambah Data Aset
          </a>
        </div>

        <!-- Tabel untuk menampilkan daftar aset yang rusak -->
        <?php if (!empty($asetRusak)) : ?>
          <h2 class="mb-3 text-danger">Aset yang Memerlukan Perbaikan</h2>
          <div class="table-responsive">
            <table id="dataAsetRusakTable" class="table table-hover table-striped table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th>No.</th>
                  <th>Kode Inventaris</th>
                  <th>Nama Aset</th>
                  <th>Kondisi</th>
                  <th>Harga</th>
                  <th>Tanggal Aset</th>
                  <th>Status</th> <!-- Tambahkan kolom Status -->
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($asetRusak as $item): ?>
                  <tr class="table-danger">
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($item['kode_inventaris']) ?></td>
                    <td><?= htmlspecialchars($item['nama_aset']) ?></td>
                    <td><?= htmlspecialchars($item['kondisi']) ?></td>
                    <td>Rp. <?= number_format($item['harga_aset'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($item['tanggal_aset']) ?></td>
                    <td><?= htmlspecialchars($item['approval_status'] ?? 'Belum Ditinjau') ?></td> <!-- Tampilkan status -->
                    <td class="text-center">
                      <button class="btn btn-info btn-sm" onclick="showDetail(<?= $item['id'] ?>)">
                        <i class="fas fa-eye"></i> Detail
                      </button>
                      <a href="<?= base_url('admin/dataaset/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Update Kondisi
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>

        <!-- Tabel untuk menampilkan daftar aset yang baik -->
        <h2 class="mb-3">Daftar Aset dalam Kondisi Baik</h2>
        <div class="table-responsive">
          <table id="dataAsetBaikTable" class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>No.</th>
                <th>Kode Inventaris</th>
                <th>Nama Aset</th>
                <th>Kondisi</th>
                <th>Harga</th>
                <th>Tanggal Aset</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($asetBaik as $item): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($item['kode_inventaris']) ?></td>
                  <td><?= htmlspecialchars($item['nama_aset']) ?></td>
                  <td><?= htmlspecialchars($item['kondisi']) ?></td>
                  <td>Rp. <?= number_format($item['harga_aset'], 2, ',', '.') ?></td>
                  <td><?= htmlspecialchars($item['tanggal_aset']) ?></td>
                  <td class="text-center">
                    <!-- Button untuk membuka detail data aset dalam pop-up -->
                    <button class="btn btn-info btn-sm" onclick="showDetail(<?= $item['id'] ?>)">
                      <i class="fas fa-eye"></i> Detail
                    </button>

                    <!-- Button untuk mengedit kondisi aset -->
                    <a href="<?= base_url('admin/dataaset/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">
                      <i class="fas fa-edit"></i> Update Kondisi
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

<!-- Modal untuk menampilkan detail data aset -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Data Aset</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Konten detail aset akan dimuat menggunakan AJAX -->
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Inisialisasi Select2
    $('.select2').select2({
      theme: 'bootstrap4',
      placeholder: "-- Pilih Lokasi --",
      allowClear: true
    });

    // Inisialisasi DataTables
    $('#dataAsetTable').DataTable({
      "searching": true,
      "paging": true,
      "info": true,
      "lengthChange": true,
      "language": {
        "search": "Cari:",
        "lengthMenu": "Tampilkan _MENU_ data",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "paginate": {
          "previous": "Sebelumnya",
          "next": "Berikutnya"
        }
      }
    });

    // Fungsi untuk menampilkan detail data aset dalam modal pop-up
    window.showDetail = function(id) {
      $.ajax({
        url: "<?= base_url('admin/dataaset/detail/') ?>" + id,
        method: "GET",
        success: function(response) {
          // Pastikan response diterima dengan baik
          $('#detailModal .modal-body').html(response);
          $('#detailModal').modal('show');
        },
        error: function(xhr, status, error) {
          // Tampilkan pesan error jika gagal
          alert('Gagal memuat data detail. Silakan coba lagi.');
          console.log('Error:', xhr.responseText);
        }
      });
    }
  });
</script>
<script>
  $(document).ready(function() {
    $('#dataAsetRusakTable').DataTable({
      "language": {
        "search": "Cari:",
        "lengthMenu": "Tampilkan _MENU_ data",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "paginate": {
          "previous": "Sebelumnya",
          "next": "Berikutnya"
        }
      }
    });

    $('#dataAsetBaikTable').DataTable({
      "language": {
        "search": "Cari:",
        "lengthMenu": "Tampilkan _MENU_ data",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        "paginate": {
          "previous": "Sebelumnya",
          "next": "Berikutnya"
        }
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    // Inisialisasi DataTables dan Select2 seperti sebelumnya
    $('.select2').select2();
    $('#dataAsetTable').DataTable();

    // Fungsi untuk menampilkan detail data aset dalam modal pop-up
    window.showDetail = function(id) {
      $.ajax({
        url: "<?= base_url('admin/dataaset/detail/') ?>" + id, // URL untuk mengambil detail
        method: "GET",
        success: function(response) {
          $('#detailModal .modal-body').html(response); // Masukkan respons ke modal body
          $('#detailModal').modal('show'); // Tampilkan modal
        },
        error: function(xhr, status, error) {
          alert('Gagal memuat data detail. Silakan coba lagi.'); // Tampilkan error
          console.log('Error:', xhr.responseText); // Debugging jika ada masalah
        }
      });
    }
  });
</script>



<!-- jQuery -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS dan JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- DataTables CSS dan JS -->
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>