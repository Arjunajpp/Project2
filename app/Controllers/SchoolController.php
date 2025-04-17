<?php

namespace App\Controllers;

use App\Models\SchoolModel;
use App\Models\KecamatanModel;

class SchoolController extends BaseController
{
    protected $schoolModel;
    protected $kecamatanModel;

    public function __construct()
    {
        $this->schoolModel = new SchoolModel();
        $this->kecamatanModel = new KecamatanModel();
    }

    // Fungsi untuk menampilkan form detail sekolah
    public function detail($id)
    {
        $school = $this->schoolModel->getSchoolById($id);
        $kecamatan = $this->kecamatanModel->findAll();  // Mendapatkan semua kecamatan

        return view('admin/school_form', [
            'school' => $school,
            'kecamatan' => $kecamatan   // Menampilkan kecamatan di form
        ]);
    }

    // Fungsi untuk mengupdate data sekolah
    public function update($id)
    {
        $schoolModel = new SchoolModel();
        $school = $schoolModel->find($id);

        // Ambil data dari form
        $jumlah_siswa_laki = (int) $this->request->getPost('jumlah_siswa_laki');
        $jumlah_siswi = (int) $this->request->getPost('jumlah_siswi');

        // Hitung total siswa
        $total_siswa = $jumlah_siswa_laki + $jumlah_siswi;

        $data = [
            'kecamatan_id' => $this->request->getPost('kecamatan_id'),  // Menyimpan kecamatan
            'name' => $this->request->getPost('name'),
            'alamat_sekolah' => $this->request->getPost('alamat_sekolah'),
            'alamat_email' => $this->request->getPost('alamat_email'),
            'status_lahan' => $this->request->getPost('status_lahan'),
            'luas_lahan' => $this->request->getPost('luas_lahan'),
            'daya_listrik' => $this->request->getPost('daya_listrik'),
            'instalasi_air' => $this->request->getPost('instalasi_air'),
            'status_internet' => $this->request->getPost('status_internet'),
            'nama_kepala_sekolah' => $this->request->getPost('nama_kepala_sekolah'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'jumlah_siswa_laki' => $jumlah_siswa_laki,   // Update jumlah siswa laki-laki
            'jumlah_siswi' => $jumlah_siswi,             // Update jumlah siswi perempuan
            'total_rombel' => $this->request->getPost('total_rombel'),  // Update total rombel
            'total_siswa' => $total_siswa  // Update total siswa otomatis
        ];

        // Cek apakah ada file yang diupload
        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generate nama unik untuk file foto
            $newFileName = $file->getRandomName();

            // Pindahkan file ke folder yang ditentukan
            $file->move('assets/uploads/schools/', $newFileName);

            // Simpan nama file ke database
            $data['foto'] = $newFileName;

            // Hapus file lama jika ada
            if (!empty($school['foto']) && file_exists('assets/uploads/schools/' . $school['foto'])) {
                unlink('assets/uploads/schools/' . $school['foto']);
            }
        }

        // Update data sekolah
        $schoolModel->update($id, $data);

        // Redirect kembali ke halaman detail sekolah
        return redirect()->to(base_url('school/detail/' . $id))->with('success', 'Data sekolah berhasil diperbarui');
    }
}
