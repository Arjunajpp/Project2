<?php

namespace App\Controllers;

use App\Models\ApprovalModel;
use App\Models\DataAsetModel;
use App\Models\SchoolModel;
use Config\Database;  // Tambahkan ini
use CodeIgniter\Controller;

class ApprovalController extends Controller
{
    protected $db;  // Tambahkan properti $db
    protected $schoolModel; // Tambahkan properti $schoolModel
    protected $approvalModel;
    protected $dataAsetModel;

    public function __construct()
    {
        $this->db = Database::connect();  // Inisialisasi $db
        $this->schoolModel = new SchoolModel();  // Inisialisasi $schoolModel
        $this->approvalModel = new ApprovalModel();
        $this->dataAsetModel = new DataAsetModel();
    }

    // Menampilkan daftar aset yang memerlukan approval dari admin
    public function index()
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/login');
        }

        // Ambil filter school_id
        $school_id = $this->request->getGet('school_id') ?? 0;

        // Query dengan filter school_id jika diberikan
        $query = $this->db->table('approvals')
            ->select('approvals.*, data_aset.nama_aset, data_aset.kode_inventaris, schools.name as school_name')
            ->join('data_aset', 'data_aset.id = approvals.aset_id')
            ->join('schools', 'schools.id = approvals.school_id');

        if ($school_id != 0) {
            $query->where('approvals.school_id', $school_id);
        }

        $data['approvals'] = $query->get()->getResultArray();
        $data['allSchools'] = $this->schoolModel->findAll();
        $data['school_id'] = $school_id;

        return view('admin/approvals/index', $data);
    }

    public function changeSchool()
    {
        // Ambil school_id dari POST form
        $school_id = $this->request->getPost('school_id');

        // Jika school_id bukan 0, cari sekolah berdasarkan ID
        $school = $this->schoolModel->find($school_id);  // Properti $schoolModel sudah ada

        if (!$school) {
            return redirect()->back()->with('error', 'Sekolah tidak ditemukan.');
        }

        // Set session untuk school_id yang dipilih
        session()->set('school_id', $school_id);
        session()->set('school_name', $school['name']);

        return redirect()->to(base_url('admin/dashboard'))->with('message', 'Berhasil berpindah ke sekolah: ' . $school['name']);
    }

    // Pada ApprovalController
    public function edit($id)
    {
        // Ambil data approval berdasarkan ID
        $approval = $this->db->table('approvals')
            ->select('approvals.*, data_aset.nama_aset, schools.name as school_name')
            ->join('data_aset', 'data_aset.id = approvals.aset_id')
            ->join('schools', 'schools.id = approvals.school_id')
            ->where('approvals.id', $id)
            ->get()
            ->getRowArray();

        // Jika approval tidak ditemukan, tampilkan pesan error
        if (!$approval) {
            return redirect()->to('/admin/approvals')->with('error', 'Approval tidak ditemukan.');
        }

        // Kirim data approval ke view edit
        return view('admin/approvals/edit', ['approval' => $approval]);
    }

    public function approve($id)
    {
        $this->db->table('approvals')->update(['status' => 'Disetujui'], ['id' => $id]);
        return redirect()->to('/admin/approvals')->with('success', 'Aset berhasil disetujui.');
    }

    public function reject($id)
    {
        $this->db->table('approvals')->update(['status' => 'Ditolak'], ['id' => $id]);
        return redirect()->to('/admin/approvals')->with('success', 'Aset berhasil ditolak.');
    }

    public function approveRepair($id)
    {
        $approval = $this->approvalModel->find($id);

        if (!$approval) {
            return redirect()->back()->with('error', 'Approval tidak ditemukan');
        }

        // Ubah status approval menjadi Sudah Diatasi
        $this->approvalModel->update($id, [
            'status' => 'Sudah Diatasi',
            'documentation' => $this->uploadDocumentation()
        ]);

        // Update status aset menjadi Baik setelah perbaikan
        $this->dataAsetModel->update($approval['aset_id'], [
            'kondisi' => 'Baik'
        ]);

        return redirect()->to('/admin/approvals')->with('success', 'Perbaikan aset berhasil disetujui');
    }

    public function approveDelete($id)
    {
        $approval = $this->approvalModel->find($id);

        if (!$approval) {
            return redirect()->back()->with('error', 'Approval tidak ditemukan');
        }

        // Hapus aset setelah approval disetujui
        $this->dataAsetModel->delete($approval['aset_id']);

        // Ubah status approval menjadi Dihapus
        $this->approvalModel->update($id, [
            'status' => 'Dihapus'
        ]);

        return redirect()->to('/admin/approvals')->with('success', 'Penghapusan aset berhasil disetujui');
    }

    public function update($id)
    {
        $data = [
            'status' => $this->request->getPost('status'),
        ];

        // Jika ada dokumentasi yang di-upload
        $documentation = $this->request->getFile('documentation');
        if ($documentation && $documentation->isValid()) {
            $documentationName = $documentation->getRandomName();
            $documentation->move('assets/approval_docs', $documentationName);
            $data['documentation'] = $documentationName;
        }

        $this->db->table('approvals')->update($data, ['id' => $id]);

        return redirect()->to('/admin/approvals')->with('success', 'Status perbaikan diperbarui');
    }

    public function uploadDocumentation()
    {
        $documentation = $this->request->getFile('documentation');
        if ($documentation && $documentation->isValid()) {
            $documentationName = $documentation->getRandomName();

            // Pastikan direktori 'public/assets/approval_docs' ada
            $uploadPath = FCPATH . 'assets/approval_docs/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);  // Buat folder jika belum ada
            }

            // Pindahkan file ke 'public/assets/approval_docs/'
            $documentation->move($uploadPath, $documentationName);

            return $documentationName;  // Return nama file yang di-upload
        }

        return null;  // Jika tidak ada file yang di-upload
    }
}
