<?php
namespace App\Models;

use CodeIgniter\Model;

class ApprovalModel extends Model
{
    protected $table = 'approvals';
    protected $allowedFields = ['aset_id', 'school_id', 'status', 'note', 'created_at', 'updated_at'];

    // Ambil semua persetujuan (approval)
    public function getAllApprovals()
    {
        return $this->select('approvals.*, data_aset.nama_aset, schools.name as school_name')
                    ->join('data_aset', 'data_aset.id = approvals.aset_id')
                    ->join('schools', 'schools.id = approvals.school_id')
                    ->get()
                    ->getResultArray();
    }

    // Ambil persetujuan berdasarkan ID
    public function getApprovalById($id)
    {
        return $this->where('approvals.id', $id)
                    ->join('data_aset', 'data_aset.id = approvals.aset_id')
                    ->join('schools', 'schools.id = approvals.school_id')
                    ->first();
    }

    // Update status persetujuan (approve/reject)
    public function updateApprovalStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }
}
