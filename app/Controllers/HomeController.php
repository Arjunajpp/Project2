<?php

namespace App\Controllers;

use App\Models\SchoolModel;
use App\Models\DataAsetModel;

class HomeController extends BaseController
{
    protected $schoolModel;
    protected $dataAsetModel;

    public function __construct()
    {
        $this->schoolModel = new SchoolModel(); // Model untuk data sekolah
        $this->dataAsetModel = new DataAsetModel(); // Model untuk data aset
    }

    public function detail_rkb($school_id)
    {
        $db = \Config\Database::connect();

        // Query untuk data RKB
        $data_rkb_query = $db->table('data_aset')
            ->select('data_aset.*, ruangan.nama_ruangan, anggaran.nama_anggaran')
            ->join('ruangan', 'ruangan.id = data_aset.ruangan_id', 'left')
            ->join('anggaran', 'anggaran.id = data_aset.anggaran_id', 'left')
            ->where('data_aset.kategori_data_id', 1) // 1 adalah ID untuk Data RKB
            ->where('data_aset.school_id', $school_id)
            ->get();
        $data['data_rkb'] = $data_rkb_query->getResultArray();

        // Query untuk data Sarana
        $data_sarana_query = $db->table('data_aset')
            ->select('data_aset.*, ruangan.nama_ruangan, anggaran.nama_anggaran')
            ->join('ruangan', 'ruangan.id = data_aset.ruangan_id', 'left')
            ->join('anggaran', 'anggaran.id = data_aset.anggaran_id', 'left')
            ->where('data_aset.kategori_aset_id', 1) // 1 adalah ID untuk Sarana
            ->where('data_aset.school_id', $school_id)
            ->get();
        $data['data_sarana'] = $data_sarana_query->getResultArray();

        // Query untuk data Prasarana
        $data_prasarana_query = $db->table('data_aset')
            ->select('data_aset.*, ruangan.nama_ruangan, anggaran.nama_anggaran')
            ->join('ruangan', 'ruangan.id = data_aset.ruangan_id', 'left')
            ->join('anggaran', 'anggaran.id = data_aset.anggaran_id', 'left')
            ->where('data_aset.kategori_aset_id', 2) // 2 adalah ID untuk Prasarana
            ->where('data_aset.school_id', $school_id)
            ->get();
        $data['data_prasarana'] = $data_prasarana_query->getResultArray();

        // Query untuk data Sarana Pendukung
        $data_sarana_pendukung_query = $db->table('data_aset')
            ->select('data_aset.*, ruangan.nama_ruangan, anggaran.nama_anggaran')
            ->join('ruangan', 'ruangan.id = data_aset.ruangan_id', 'left')
            ->join('anggaran', 'anggaran.id = data_aset.anggaran_id', 'left')
            ->where('data_aset.kategori_aset_id', 3) // 3 adalah ID untuk Sarana Pendukung
            ->where('data_aset.school_id', $school_id)
            ->get();
        $data['data_sarana_pendukung'] = $data_sarana_pendukung_query->getResultArray();

        // Query untuk data Fisik
        $data_fisik_query = $db->table('data_aset')
            ->select('data_aset.*, ruangan.nama_ruangan, anggaran.nama_anggaran')
            ->join('ruangan', 'ruangan.id = data_aset.ruangan_id', 'left')
            ->join('anggaran', 'anggaran.id = data_aset.anggaran_id', 'left')
            ->where('data_aset.kategori_aset_id', 4) // 4 adalah ID untuk Fisik
            ->where('data_aset.school_id', $school_id)
            ->get();
        $data['data_fisik'] = $data_fisik_query->getResultArray();

        // Kirim data ke view
        return view('detail_rkb', $data);
    }


    public function index()
    {
        // Load the school model
        $schoolModel = new SchoolModel();

        // Fetch all schools from the database
        $schools = $schoolModel->findAll();

        // Pass the data to the view
        return view('home', ['schools' => $schools]);
    }
    public function detail($id)
    {
        $schoolModel = new SchoolModel();
        $school = $schoolModel->find($id); // Ambil data sekolah berdasarkan ID

        // Kirim data sekolah ke view
        return view('detail_school', ['school' => $school]);
    }
}
