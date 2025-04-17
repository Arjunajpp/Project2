<?php

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table      = 'kecamatan';   // Nama tabel di database
    protected $primaryKey = 'id';          // Primary key dari tabel

    // Kolom yang diizinkan untuk diisi
    protected $allowedFields = ['name'];

    // Validasi untuk memastikan nama kecamatan tidak kosong
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]'
    ];

    // Custom pesan error
    protected $validationMessages = [
        'name' => [
            'required' => 'Nama kecamatan harus diisi.',
            'min_length' => 'Nama kecamatan minimal terdiri dari 3 karakter.',
            'max_length' => 'Nama kecamatan tidak boleh lebih dari 100 karakter.'
        ]
    ];
}
