<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriDataModel extends Model
{
    protected $table = 'kategori_data';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kategori_data', 'status'];
}
