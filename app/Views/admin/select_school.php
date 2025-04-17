<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Sekolah</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Pilih Sekolah untuk Diakses</h2>

        <!-- Dropdown untuk memilih sekolah dengan Select2 -->
        <form action="<?= base_url('admin/dashboard/changeSchool') ?>" method="post">
            <div class="mb-3">
                <select class="form-select select2" name="school_id" required>
                    <option disabled selected>-- Pilih Lokasi --</option>

                    <!-- Tambahkan opsi untuk kembali ke sesi superadmin -->
                    <option value="0">Kembali ke Superadmin (Semua Sekolah)</option>

                    <!-- List sekolah -->
                    <?php foreach ($schools as $school): ?>
                        <option value="<?= $school['id'] ?>">
                            <?= $school['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Kunjungi</button>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 CSS dan JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "-- Pilih Lokasi --",
                allowClear: true
            });
        });
    </script>
</body>

</html>