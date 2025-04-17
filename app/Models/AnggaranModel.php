<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggaranModel extends Model
{
    protected $table = 'anggaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_anggaran', 'status'];
}
