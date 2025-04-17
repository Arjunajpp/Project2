<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriAsetModel extends Model
{
    protected $table = 'kategori_aset';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kategori', 'status'];
}
