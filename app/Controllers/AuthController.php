<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SchoolModel;

class AuthController extends BaseController
{
    protected $userModel;
    protected $schoolModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->schoolModel = new SchoolModel();
    }

    // Menampilkan halaman login
    public function login()
    {
        return view('auth/login');
    }

    // Proses login
    public function attemptLogin()
    {
        $npsn = $this->request->getPost('npsn');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan NPSN
        $user = $this->userModel->where('npsn', $npsn)->first();

        // Validasi password
        if ($user && password_verify($password, $user['password'])) {
            if ($user['school_id'] === null) {
                // Jika school_id null, maka user adalah superadmin
                $schoolName = 'Akses semua sekolah';
            } else {
                // Ambil nama sekolah dari school_id user, jika ada
                $school = $this->schoolModel->find($user['school_id']);
                $schoolName = $school ? $school['name'] : 'Tidak ada sekolah';
            }

            // Set session dengan data user dan nama sekolah
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'npsn' => $user['npsn'],  // Simpan NPSN dalam session
                'role' => $user['role'],
                'school_id' => $user['school_id'],
                'school_name' => $schoolName,
                'logged_in' => true
            ]);

            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Login gagal');
        }
    }

    // Proses logout
    public function logout()
    {
        // Hapus semua data session
        session()->destroy();
        return redirect()->to('/login');
    }

    // Menampilkan halaman register
    public function register()
    {
        return view('auth/register');
    }

    // Proses registrasi
    public function attemptRegister()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'npsn' => $this->request->getPost('npsn'),  // Ambil NPSN dari input form
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user',
            'school_id' => $this->request->getPost('school_id')
        ];

        $this->userModel->save($data);
        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Menampilkan dashboard berdasarkan role user
    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session()->get('role') === 'admin' || session()->get('role') === 'superadmin') {
            return view('admin/dashboard');
        } else {
            return redirect()->to('/');
        }
    }
}
