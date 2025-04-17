<?php

namespace App\Models;

use CodeIgniter\Model;

class DataRKBModel extends Model
{
    protected $table = 'data_rkb';
    protected $primaryKey = 'id_data_rkb';

    protected $allowedFields = [
        'nama_sekolah', 'jumlah_siswa', 'jumlah_rombel', 'jumlah_rkb', 'kekurangan_rkb',
        'kondisi_rkb_baik', 'kondisi_rkb_rusak_ringan', 'kondisi_rkb_rusak_sedang', 
        'kondisi_rkb_rusak_berat', 'meja_kursi_siswa_layak', 'meja_kursi_siswa_tidak_layak',
        'meja_kursi_guru_layak', 'meja_kursi_guru_tidak_layak', 'lemari', 'papan_tulis', 
        'papan_pajangan', 'proyektor', 'school_id', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
