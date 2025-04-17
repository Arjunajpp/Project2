<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolModel extends Model
{
    protected $table      = 'schools';  // Nama tabel di database
    protected $primaryKey = 'id';       // Primary key dari tabel

    // Kolom yang diizinkan untuk diisi
    protected $allowedFields = [
        'kecamatan_id',         // Menambahkan kecamatan_id
        'name',
        'category',
        'latitude',
        'longitude',
        'alamat_sekolah',
        'alamat_email',
        'status_lahan',
        'luas_lahan',
        'daya_listrik',
        'instalasi_air',
        'status_internet',
        'nama_kepala_sekolah',
        'nomor_telepon',
        'foto',
        'jumlah_siswa_laki',    // Menambahkan jumlah siswa laki-laki
        'jumlah_siswi',         // Menambahkan jumlah siswi perempuan
        'total_rombel'          // Menambahkan total rombel
    ];

    // Untuk menggunakan timestamp otomatis (created_at, updated_at)
    protected $useTimestamps = false;  // Nonaktifkan penggunaan created_at dan updated_at

    // Validasi data saat insert atau update
    protected $validationRules = [
        'name'               => 'required|min_length[3]|max_length[100]',
        'category'           => 'required|in_list[PAUD,SD,SMP]',
        'latitude'           => 'required|decimal',
        'longitude'          => 'required|decimal',
        'alamat_sekolah'     => 'permit_empty|string|max_length[255]',
        'alamat_email'       => 'permit_empty|valid_email|max_length[255]',
        'status_lahan'       => 'permit_empty|string|max_length[100]',
        'luas_lahan'         => 'permit_empty|decimal',
        'daya_listrik'       => 'permit_empty|decimal',
        'instalasi_air'      => 'permit_empty|string|max_length[100]',
        'status_internet'    => 'permit_empty|string|max_length[100]',
        'nama_kepala_sekolah' => 'permit_empty|string|max_length[255]',
        'nomor_telepon'      => 'permit_empty|string|max_length[50]',
        'foto'               => 'permit_empty|string|max_length[255]',
        'jumlah_siswa_laki'  => 'permit_empty|integer',    // Validasi untuk jumlah siswa laki-laki
        'jumlah_siswi'       => 'permit_empty|integer',    // Validasi untuk jumlah siswi perempuan
        'total_rombel'       => 'permit_empty|integer'     // Validasi untuk total rombel
    ];

    // Custom error messages (opsional)
    protected $validationMessages = [
        'name' => [
            'required' => 'Nama sekolah harus diisi.',
            'min_length' => 'Nama sekolah minimal terdiri dari 3 karakter.',
            'max_length' => 'Nama sekolah tidak boleh lebih dari 100 karakter.'
        ],
        'category' => [
            'required' => 'Kategori sekolah harus diisi.',
            'in_list' => 'Kategori sekolah harus salah satu dari: PAUD,SD, SMP.'
        ],
        'latitude' => [
            'required' => 'Latitude harus diisi.',
            'decimal' => 'Latitude harus dalam format decimal.'
        ],
        'longitude' => [
            'required' => 'Longitude harus diisi.',
            'decimal' => 'Longitude harus dalam format decimal.'
        ]
    ];

    // Fungsi untuk mendapatkan sekolah berdasarkan id
    public function getSchoolById($id)
    {
        return $this->where('id', $id)->first();
    }

    // Fungsi untuk update data sekolah
    public function updateSchool($id, $data)
    {
        return $this->update($id, $data);
    }
}
