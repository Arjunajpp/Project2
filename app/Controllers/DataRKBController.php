<?php

namespace App\Controllers;

use App\Models\DataRKBModel;
use CodeIgniter\Controller;

class DataRKBController extends Controller
{
    protected $dataRKBModel;

    public function __construct()
    {
        $this->dataRKBModel = new DataRKBModel();
    }

    // Function to display all Data RKB (Index)
    public function index()
    {
        $data['data_rkb'] = $this->dataRKBModel->findAll();

        return view('admin/datarkb/index', $data);
    }

    // Function to show the form for creating new Data RKB (Create)
    public function create()
    {
        return view('admin/datarkb/create');
    }

    // Function to store new Data RKB to the database (Store)
    public function store()
    {
        // Validate and save the data
        $this->dataRKBModel->save([
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'jumlah_siswa' => $this->request->getPost('jumlah_siswa'),
            'jumlah_rombel' => $this->request->getPost('jumlah_rombel'),
            'jumlah_rkb' => $this->request->getPost('jumlah_rkb'),
            'kekurangan_rkb' => $this->request->getPost('kekurangan_rkb'),
            'kondisi_rkb_baik' => $this->request->getPost('kondisi_rkb_baik'),
            'kondisi_rkb_rusak_ringan' => $this->request->getPost('kondisi_rkb_rusak_ringan'),
            'kondisi_rkb_rusak_sedang' => $this->request->getPost('kondisi_rkb_rusak_sedang'),
            'kondisi_rkb_rusak_berat' => $this->request->getPost('kondisi_rkb_rusak_berat'),
            'meja_kursi_siswa_layak' => $this->request->getPost('meja_kursi_siswa_layak'),
            'meja_kursi_siswa_tidak_layak' => $this->request->getPost('meja_kursi_siswa_tidak_layak'),
            'meja_kursi_guru_layak' => $this->request->getPost('meja_kursi_guru_layak'),
            'meja_kursi_guru_tidak_layak' => $this->request->getPost('meja_kursi_guru_tidak_layak'),
            'lemari' => $this->request->getPost('lemari'),
            'papan_tulis' => $this->request->getPost('papan_tulis'),
            'papan_pajangan' => $this->request->getPost('papan_pajangan'),
            'proyektor' => $this->request->getPost('proyektor'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('admin/datarkb'))->with('success', 'Data RKB berhasil ditambahkan');
    }

    // Function to show the form for editing Data RKB (Edit)
    public function edit($id)
    {
        $data['rkb'] = $this->dataRKBModel->find($id);

        return view('admin/datarkb/edit', $data);
    }

    // Function to update Data RKB (Update)
    public function update($id)
    {
        // Validate and update the data
        $this->dataRKBModel->update($id, [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'jumlah_siswa' => $this->request->getPost('jumlah_siswa'),
            'jumlah_rombel' => $this->request->getPost('jumlah_rombel'),
            'jumlah_rkb' => $this->request->getPost('jumlah_rkb'),
            'kekurangan_rkb' => $this->request->getPost('kekurangan_rkb'),
            'kondisi_rkb_baik' => $this->request->getPost('kondisi_rkb_baik'),
            'kondisi_rkb_rusak_ringan' => $this->request->getPost('kondisi_rkb_rusak_ringan'),
            'kondisi_rkb_rusak_sedang' => $this->request->getPost('kondisi_rkb_rusak_sedang'),
            'kondisi_rkb_rusak_berat' => $this->request->getPost('kondisi_rkb_rusak_berat'),
            'meja_kursi_siswa_layak' => $this->request->getPost('meja_kursi_siswa_layak'),
            'meja_kursi_siswa_tidak_layak' => $this->request->getPost('meja_kursi_siswa_tidak_layak'),
            'meja_kursi_guru_layak' => $this->request->getPost('meja_kursi_guru_layak'),
            'meja_kursi_guru_tidak_layak' => $this->request->getPost('meja_kursi_guru_tidak_layak'),
            'lemari' => $this->request->getPost('lemari'),
            'papan_tulis' => $this->request->getPost('papan_tulis'),
            'papan_pajangan' => $this->request->getPost('papan_pajangan'),
            'proyektor' => $this->request->getPost('proyektor'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('admin/datarkb'))->with('success', 'Data RKB berhasil diperbarui');
    }

    // Function to delete Data RKB (Delete)
    public function delete($id)
    {
        $this->dataRKBModel->delete($id);

        return redirect()->to(base_url('admin/datarkb'))->with('success', 'Data RKB berhasil dihapus');
    }
}
