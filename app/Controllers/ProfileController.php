<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SchoolModel;

class ProfileController extends BaseController
{
    protected $userModel;
    protected $schoolModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->schoolModel = new SchoolModel();
    }

    // Fungsi untuk menampilkan halaman profil user
    public function profile()
    {
        // Cek apakah user sudah login dan ada session school_id
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Ambil data user dari session
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        // Ambil nama sekolah berdasarkan school_id user
        $school = null;
        if ($user['school_id'] !== null) {
            $school = $this->schoolModel->find($user['school_id']);
        }

        // Kirim data user dan school ke view
        return view('admin/profile', [
            'user' => $user,
            'school' => $school
        ]);
    }
}
