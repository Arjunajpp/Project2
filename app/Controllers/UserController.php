<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SchoolModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $schoolModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->schoolModel = new SchoolModel();
    }

    public function selectSchool()
    {
        $schoolModel = new \App\Models\SchoolModel();
        $data['schools'] = $schoolModel->findAll(); // Mengambil semua sekolah
        return view('admin/users/select_school', $data);
    }

    public function index($school_id)
    {
        $userModel = new \App\Models\UserModel();
        $schoolModel = new \App\Models\SchoolModel();

        $data['users'] = $userModel->where('school_id', $school_id)->findAll();
        $data['school'] = $schoolModel->find($school_id); // Informasi sekolah

        return view('admin/users/index', $data);
    }

    public function create($school_id)
    {
        return view('admin/users/create', ['school_id' => $school_id]);
    }


    public function store()
    {
        // Ambil school_id dari form
        $school_id = $this->request->getPost('school_id');

        // Buat data user yang akan disimpan
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'school_id' => $school_id, // Simpan school_id yang diambil dari form
        ];

        // Simpan data user ke database
        $this->userModel->save($data);

        // Redirect ke halaman daftar user berdasarkan school_id
        return redirect()->to(base_url('admin/users/index/' . $school_id));
    }


    public function edit($id)
    {
        // Pastikan user yang dicari ada di database
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        // Jika metode request adalah POST, maka proses form
        if ($this->request->getMethod() === 'post') {
            // Ambil input dari form
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'role' => $this->request->getPost('role'),
            ];

            // Jika password diisi, maka update password, jika tidak biarkan tetap sama
            if ($this->request->getPost('password')) {
                $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }

            // Update data user di database
            $this->userModel->update($id, $data);

            // Redirect ke halaman daftar user setelah update berhasil
            return redirect()->to(base_url('admin/users/index/' . $user['school_id']))
                ->with('message', 'Pengguna berhasil diperbarui.');
        }

        // Jika metode request bukan POST, tampilkan form edit
        return view('admin/users/edit', ['user' => $user]);
    }


    public function update($id)
    {
        // Ambil data user yang ada berdasarkan ID
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        // Ambil input dari form
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
        ];

        // Cek apakah password diisi
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Lakukan update data user di database
        $this->userModel->update($id, $data);

        // Redirect kembali ke halaman daftar user setelah berhasil diupdate
        return redirect()->to(base_url('admin/users/index/' . $user['school_id']))->with('message', 'Pengguna berhasil diperbarui.');
    }


    public function delete($id)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);

        if ($user) {
            $userModel->delete($id);
        }

        return redirect()->to(base_url('admin/users/index/' . $user['school_id']));
    }
}
