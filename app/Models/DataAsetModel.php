<?php

namespace App\Models;

use CodeIgniter\Model;

class DataAsetModel extends Model
{
    protected $table = 'data_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'school_id',
        'kode_inventaris',
        'nama_aset',
        'tanggal_aset',
        'masa_garansi',
        'harga_aset',
        'kondisi',
        'nomor_seri',
        'catatan',
        'bukti_gambar',
        'kategori_aset_id',
        'kategori_data_id',
        'anggaran_id',
        'ruangan_id'
    ];

    // Mendapatkan data aset berdasarkan school_id
    public function getDataAsetBySchool($schoolId)
    {
        return $this->where('school_id', $schoolId)->findAll();
    }

    // Mendapatkan detail aset berdasarkan id dan school_id
    public function getDetailAsetBySchool($id, $schoolId)
    {
        $query = $this->where('id', $id)->where('school_id', $schoolId);

        // Debug query
        echo $this->getLastQuery(); // Ini akan mencetak query yang akan dieksekusi
        return $query->first();
    }


    // Mendapatkan semua kategori aset
    public function getKategoriAset()
    {
        return $this->db->table('kategori_aset')->get()->getResultArray();
    }

    // Mendapatkan semua kategori data
    public function getKategoriData()
    {
        return $this->db->table('kategori_data')->get()->getResultArray();
    }

    // Mendapatkan semua data anggaran
    public function getAnggaran()
    {
        return $this->db->table('anggaran')->get()->getResultArray();
    }

    // Mendapatkan semua data ruangan
    public function getRuangan()
    {
        return $this->db->table('ruangan')->get()->getResultArray();
    }

    // Mengambil total harga aset dengan filter tanggal
    public function getTotalHargaAset($school_id = null, $start_date = '2000-01-01', $end_date = null)
    {
        $end_date = $end_date ?? date('Y-m-d');

        $query = $this->selectSum('harga_aset')
            ->where("tanggal_aset >=", $start_date)
            ->where("tanggal_aset <=", $end_date);

        if ($school_id) {
            $query->where('school_id', $school_id);
        }

        return $query->get()->getRowArray()['harga_aset'] ?? 0;
    }

    // Mengambil total aset per kategori dengan filter tanggal - PERBAIKAN
    public function getTotalAsetPerKategori($school_id = null, $start_date = '2000-01-01', $end_date = null)
    {
        $end_date = $end_date ?? date('Y-m-d');

        $builder = $this->db->table('data_aset a');
        $builder->select('k.id, k.nama_kategori, COUNT(a.id) as total')
               ->join('kategori_aset k', 'k.id = a.kategori_aset_id')
               ->where("a.tanggal_aset >=", $start_date)
               ->where("a.tanggal_aset <=", $end_date)
               ->where('k.status', 'aktif') // Hanya kategori aktif
               ->groupBy('k.id, k.nama_kategori');

        if ($school_id) {
            $builder->where('a.school_id', $school_id);
        }

        return $builder->get()->getResultArray();
    }

    // Mengambil total aset per ruangan dengan filter tanggal - PERBAIKAN
    public function getTotalAsetPerRuangan($school_id = null, $start_date = '2000-01-01', $end_date = null)
    {
        $end_date = $end_date ?? date('Y-m-d');

        $builder = $this->db->table('data_aset a');
        $builder->select('r.id, r.nama_ruangan, COUNT(a.id) as total')
               ->join('ruangan r', 'r.id = a.ruangan_id')
               ->where("a.tanggal_aset >=", $start_date)
               ->where("a.tanggal_aset <=", $end_date)
               ->where('r.status', 'aktif') // Hanya ruangan aktif
               ->groupBy('r.id, r.nama_ruangan');

        if ($school_id) {
            $builder->where('a.school_id', $school_id);
        }

        return $builder->get()->getResultArray();
    }
    
    // DataAsetModel.php
    public function getDataAsetByConditionWithStatus($schoolId, $conditions)
    {
        return $this->select('data_aset.*, approvals.status as approval_status')
            ->join('approvals', 'approvals.aset_id = data_aset.id', 'left')
            ->where('data_aset.school_id', $schoolId)
            ->whereIn('data_aset.kondisi', $conditions)
            ->findAll();
    }
}