<?php

namespace App\Controllers;

use App\Models\DataAsetModel;
use App\Models\KategoriAsetModel;
use App\Models\RuanganModel;
use App\Models\UserModel;
use App\Models\SchoolModel;

class AdminController extends BaseController
{
    protected $dataAsetModel;
    protected $kategoriAsetModel;
    protected $ruanganModel;
    protected $userModel;
    protected $schoolModel;

    public function __construct()
    {
        $this->dataAsetModel = new DataAsetModel();
        $this->kategoriAsetModel = new KategoriAsetModel();
        $this->ruanganModel = new RuanganModel();
        $this->userModel = new UserModel();
        $this->schoolModel = new SchoolModel();

        // Pastikan hanya admin atau superadmin yang dapat mengakses halaman ini
        if (!session()->get('logged_in') || (session()->get('role') !== 'admin' && session()->get('role') !== 'superadmin')) {
            return redirect()->to('/login')->send();
        }
    }

    // Tampilkan dashboard admin - FIXED
    public function dashboard()
    {
        // Ambil school_id dari session jika bukan superadmin (null atau 0)
        $userSchoolId = session()->get('school_id'); // school_id dari sesi, jika bukan superadmin

        // Ambil filter dari query string (GET request)
        $school_id = $this->request->getGet('school_id') ?? $userSchoolId; // Gunakan school_id dari session jika bukan superadmin
        $start_date = $this->request->getGet('start_date') ?? '2024-01-01';  // Default tanggal awal jika tidak ada filter
        $end_date = $this->request->getGet('end_date') ?? date('Y-m-d');     // Default tanggal sekarang jika tidak ada filter

        // Jika school_id adalah null atau 0, berarti superadmin, ambil semua sekolah
        if (is_null($school_id) || $school_id == 0) {
            // Untuk superadmin, ambil data dari semua sekolah
            $totalHargaAset = $this->dataAsetModel->getTotalHargaAset(null, $start_date, $end_date);
            $totalAsetPerKategori = $this->dataAsetModel->getTotalAsetPerKategori(null, $start_date, $end_date);
            $totalAsetPerRuangan = $this->dataAsetModel->getTotalAsetPerRuangan(null, $start_date, $end_date);
        } else {
            // Untuk operator sekolah, hanya ambil data berdasarkan school_id mereka
            $totalHargaAset = $this->dataAsetModel->getTotalHargaAset($school_id, $start_date, $end_date);
            $totalAsetPerKategori = $this->dataAsetModel->getTotalAsetPerKategori($school_id, $start_date, $end_date);
            $totalAsetPerRuangan = $this->dataAsetModel->getTotalAsetPerRuangan($school_id, $start_date, $end_date);
        }

        // Ambil daftar semua sekolah untuk dropdown jika superadmin
        $allSchools = [];
        if (is_null($userSchoolId)) {
            $allSchools = $this->schoolModel->findAll(); // Superadmin dapat memilih sekolah
        }

        // Ambil kategori aset dan ruangan
        $kategoriAset = $this->kategoriAsetModel->where('status', 'aktif')->findAll();
        $ruangan = $this->ruanganModel->where('status', 'aktif')->findAll();

        // Kirim data ke view dashboard
        return $this->render('admin/dashboard', [
            'totalHargaAset' => $totalHargaAset,
            'totalAsetPerKategori' => $totalAsetPerKategori,
            'kategoriAset' => $kategoriAset,
            'totalAsetPerRuangan' => $totalAsetPerRuangan,
            'ruangan' => $ruangan,
            'allSchools' => $allSchools,
            'school_id' => $school_id,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);
    }

    // Fungsi untuk mengganti sekolah
    public function changeSchool()
    {
        // Ambil school_id dari POST form
        $school_id = $this->request->getPost('school_id');

        if ($school_id == 0) {
            // Set session untuk kembali ke mode superadmin (semua sekolah)
            session()->set('school_id', null);
            session()->set('school_name', 'Semua Sekolah');
            return redirect()->to(base_url('admin/dashboard'))->with('message', 'Kembali ke mode superadmin.');
        }

        // Jika school_id bukan 0, cari sekolah berdasarkan ID
        $school = $this->schoolModel->find($school_id);

        if (!$school) {
            return redirect()->back()->with('error', 'Sekolah tidak ditemukan.');
        }

        // Set session untuk school_id yang dipilih
        session()->set('school_id', $school_id);
        session()->set('school_name', $school['name']);

        return redirect()->to(base_url('admin/dashboard'))->with('message', 'Berhasil berpindah ke sekolah: ' . $school['name']);
    }
}