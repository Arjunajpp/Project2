<?php

namespace App\Controllers;

use App\Models\DataAsetModel;
use CodeIgniter\Controller;
use Config\Database;

class DataAsetController extends Controller
{
    protected $dataAsetModel;
    protected $db;  // Tambahkan properti $db

    public function __construct()
    {
        $this->dataAsetModel = new DataAsetModel();
        $this->db = Database::connect();  // Inisialisasi $db
    }

    // 1. Index - Menampilkan Data Aset dalam DataTable
    public function index()
    {
        $schoolId = session()->get('school_id');
        $data['asetRusak'] = $this->dataAsetModel->getDataAsetByConditionWithStatus($schoolId, ['rusak_ringan', 'rusak_sedang', 'rusak_berat']);
        $data['asetBaik'] = $this->dataAsetModel->where('school_id', $schoolId)->where('kondisi', 'baik')->findAll();

        return view('admin/dataaset/index', $data);
    }

    // 2. Detail - Menampilkan detail data aset dalam bentuk pop-up
    // Controller untuk detail
    public function detail($id)
    {
        $schoolId = session()->get('school_id');

        // Ambil data aset
        $data['aset'] = $this->dataAsetModel->getDetailAsetBySchool($id, $schoolId);

        if (!$data['aset']) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }

        // Ambil detail kategori aset
        $kategoriAsetModel = new \App\Models\KategoriAsetModel();
        $kategoriAset = $kategoriAsetModel->find($data['aset']['kategori_aset_id']);
        $data['aset']['kategori_aset'] = $kategoriAset ? $kategoriAset['nama_kategori'] : 'Tidak ada kategori';

        // Ambil detail kategori data
        $kategoriDataModel = new \App\Models\KategoriDataModel();
        $kategoriData = $kategoriDataModel->find($data['aset']['kategori_data_id']);
        $data['aset']['kategori_data'] = $kategoriData ? $kategoriData['nama_kategori_data'] : 'Tidak ada kategori data';

        // Ambil detail anggaran
        $anggaranModel = new \App\Models\AnggaranModel();
        $anggaran = $anggaranModel->find($data['aset']['anggaran_id']);
        $data['aset']['anggaran'] = $anggaran ? $anggaran['nama_anggaran'] : 'Tidak ada anggaran';

        // Ambil detail ruangan
        $ruanganModel = new \App\Models\RuanganModel();
        $ruangan = $ruanganModel->find($data['aset']['ruangan_id']);
        $data['aset']['ruangan'] = $ruangan ? $ruangan['nama_ruangan'] : 'Tidak ada ruangan';

        return view('admin/dataaset/detail', $data);
    }

    // 3. Create - Menampilkan form tambah data aset
    public function create()
    {
        $data['kategori_aset'] = $this->dataAsetModel->getKategoriAset();
        $data['kategori_data'] = $this->dataAsetModel->getKategoriData();
        $data['anggaran'] = $this->dataAsetModel->getAnggaran();
        $data['ruangan'] = $this->dataAsetModel->getRuangan();
        return view('admin/dataaset/create', $data);
    }

    // 4. Store - Menyimpan data aset baru
    public function store()
    {
        $data = [
            'school_id' => session()->get('school_id'),
            'kode_inventaris' => $this->request->getPost('kode_inventaris'),
            'nama_aset' => $this->request->getPost('nama_aset'),
            'tanggal_aset' => $this->request->getPost('tanggal_aset'),
            'masa_garansi' => $this->request->getPost('masa_garansi'),
            'harga_aset' => $this->request->getPost('harga_aset'),
            'kondisi' => $this->request->getPost('kondisi'),
            'nomor_seri' => $this->request->getPost('nomor_seri'),
            'catatan' => $this->request->getPost('catatan'),
            'kategori_aset_id' => $this->request->getPost('kategori_aset_id'),
            'kategori_data_id' => $this->request->getPost('kategori_data_id'),
            'anggaran_id' => $this->request->getPost('anggaran_id'),
            'ruangan_id' => $this->request->getPost('ruangan_id'),
            'bukti_gambar' => $this->_uploadGambar(), // Fungsi upload gambar
        ];

        $this->dataAsetModel->insert($data);
        return redirect()->to('/admin/dataaset')->with('success', 'Data aset berhasil ditambahkan');
    }

    // 5. Edit - Menampilkan form update kondisi aset
    public function edit($id)
    {
        $data['aset'] = $this->dataAsetModel->find($id);
        return view('admin/dataaset/update', $data);
    }

    // 6. Update - Mengupdate kondisi aset dan bukti gambar jika ada
    public function update($id)
    {
        $data = [
            'kondisi' => $this->request->getPost('kondisi'),
        ];

        // Cek apakah ada file baru yang diunggah
        $buktiGambar = $this->request->getFile('bukti_gambar');
        if ($buktiGambar && $buktiGambar->isValid()) {
            // Hapus file lama jika ada
            $existingAset = $this->dataAsetModel->find($id);
            if (!empty($existingAset['bukti_gambar']) && file_exists(FCPATH . 'assets/uploads/' . $existingAset['bukti_gambar'])) {
                unlink(FCPATH . 'assets/uploads/' . $existingAset['bukti_gambar']);
            }

            // Upload gambar baru
            $data['bukti_gambar'] = $this->_uploadGambar();
        }

        // Update data di database
        $this->dataAsetModel->update($id, $data);

        // Cek jika operator mengajukan perbaikan
        if ($this->request->getPost('ajukan_perbaikan')) {
            // Ambil school_id dari session
            $school_id = session()->get('school_id');

            $this->db->table('approvals')->insert([
                'aset_id' => $id,
                'school_id' => $school_id,  // Menyimpan ID sekolah yang terkait
                'status' => 'Sedang Ditinjau',
            ]);
        }

        // Tambahkan redirect setelah semua proses selesai
        return redirect()->to('/admin/dataaset')->with('success', 'Kondisi aset berhasil diperbarui');
    }

    public function requestRepair($id)
    {
        // Ambil data aset berdasarkan ID
        $aset = $this->dataAsetModel->find($id);

        // Pastikan aset ditemukan
        if (!$aset) {
            return redirect()->back()->with('error', 'Aset tidak ditemukan.');
        }

        // Cek apakah kondisi aset memenuhi syarat untuk diajukan perbaikan
        if (in_array($aset['kondisi'], ['rusak_ringan', 'rusak_sedang', 'rusak_berat'])) {
            // Tambahkan data ke tabel approvals
            $this->db->table('approvals')->insert([
                'aset_id' => $id,
                'school_id' => $aset['school_id'],
                'status' => 'Belum Ditinjau',
                'note' => 'Permintaan perbaikan aset diajukan oleh operator.'
            ]);

            // Berikan pesan sukses dan redirect ke halaman sebelumnya
            return redirect()->to('/admin/dataaset')->with('success', 'Permintaan perbaikan telah diajukan.');
        }

        return redirect()->back()->with('error', 'Kondisi aset tidak memungkinkan untuk diajukan perbaikan.');
    }

    public function requestDelete($id)
    {
        // Ambil data aset berdasarkan ID
        $aset = $this->dataAsetModel->find($id);

        // Pastikan aset ditemukan
        if (!$aset) {
            return redirect()->back()->with('error', 'Aset tidak ditemukan.');
        }

        // Ajukan permintaan penghapusan dengan status 'Belum Ditinjau'
        $this->db->table('approvals')->insert([
            'aset_id' => $id,
            'school_id' => $aset['school_id'],
            'status' => 'Belum Ditinjau',
            'note' => 'Permintaan penghapusan aset diajukan oleh operator.'
        ]);

        // Berikan pesan sukses dan redirect ke halaman sebelumnya
        return redirect()->to('/admin/dataaset')->with('success', 'Permintaan penghapusan telah diajukan.');
    }

    // 7. Upload - Fungsi untuk meng-upload file gambar
    private function _uploadGambar()
    {
        $buktiGambar = $this->request->getFile('bukti_gambar');
        if ($buktiGambar && $buktiGambar->isValid() && !$buktiGambar->hasMoved()) {
            $buktiGambarName = $buktiGambar->getRandomName();

            // Pastikan direktori 'assets/uploads' di dalam 'public' ada
            $uploadPath = FCPATH . 'assets/uploads/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);  // Buat folder jika belum ada
            }

            // Pindahkan file ke 'public/assets/uploads/'
            $buktiGambar->move($uploadPath, $buktiGambarName);

            return $buktiGambarName;
        }
        return null;
    }

    // 8. Delete - Menghapus data aset
    public function delete($id)
    {
        $this->dataAsetModel->delete($id);
        return redirect()->to('/admin/dataaset')->with('success', 'Data aset berhasil dihapus');
    }
}
