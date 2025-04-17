<?php

namespace App\Controllers;

use App\Models\KategoriAsetModel;
use App\Models\KategoriDataModel;
use App\Models\AnggaranModel;
use App\Models\RuanganModel;

class DependencyController extends BaseController
{
    // Kategori Aset
    public function indexKategoriAset()
    {
        $kategoriAsetModel = new KategoriAsetModel();
        $data['kategori_aset'] = $kategoriAsetModel->findAll();
        return view('admin/kategori_aset/index', $data);
    }

    public function createKategoriAset()
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }
        return view('admin/kategori_aset/create');
    }

    public function storeKategoriAset()
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $kategoriAsetModel = new KategoriAsetModel();
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'status' => $this->request->getPost('status'),
        ];
        $kategoriAsetModel->insert($data);

        return redirect()->to('/admin/kategori-aset');
    }

    public function editKategoriAset($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $kategoriAsetModel = new KategoriAsetModel();
        $data['kategori_aset'] = $kategoriAsetModel->find($id);
        return view('admin/kategori_aset/edit', $data);
    }

    public function updateKategoriAset($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $kategoriAsetModel = new KategoriAsetModel();
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'status' => $this->request->getPost('status'),
        ];
        $kategoriAsetModel->update($id, $data);

        return redirect()->to('/admin/kategori-aset');
    }

    public function deleteKategoriAset($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $kategoriAsetModel = new KategoriAsetModel();
        $kategoriAsetModel->delete($id);

        return redirect()->to('/admin/kategori-aset');
    }

    // Kategori Data
    public function indexKategoriData()
    {
        $kategoriDataModel = new KategoriDataModel();
        $data['kategori_data'] = $kategoriDataModel->findAll();
        return view('admin/kategori_data/index', $data);
    }

    public function createKategoriData()
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }
        return view('admin/kategori_data/create');
    }

    public function storeKategoriData()
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $kategoriDataModel = new KategoriDataModel();
        $data = [
            'nama_kategori_data' => $this->request->getPost('nama_kategori_data'),
            'status' => $this->request->getPost('status'),
        ];
        $kategoriDataModel->insert($data);

        return redirect()->to('/admin/kategori-data');
    }

    public function editKategoriData($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $kategoriDataModel = new KategoriDataModel();
        $data['kategori_data'] = $kategoriDataModel->find($id);
        return view('admin/kategori_data/edit', $data);
    }

    public function updateKategoriData($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $kategoriDataModel = new KategoriDataModel();
        $data = [
            'nama_kategori_data' => $this->request->getPost('nama_kategori_data'),
            'status' => $this->request->getPost('status'),
        ];
        $kategoriDataModel->update($id, $data);

        return redirect()->to('/admin/kategori-data');
    }

    public function deleteKategoriData($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $kategoriDataModel = new KategoriDataModel();
        $kategoriDataModel->delete($id);

        return redirect()->to('/admin/kategori-data');
    }

    // Anggaran
    public function indexAnggaran()
    {
        $anggaranModel = new AnggaranModel();
        $data['anggaran'] = $anggaranModel->findAll();
        return view('admin/anggaran/index', $data);
    }

    public function createAnggaran()
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }
        return view('admin/anggaran/create');
    }

    public function storeAnggaran()
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $anggaranModel = new AnggaranModel();
        $data = [
            'nama_anggaran' => $this->request->getPost('nama_anggaran'),
            'status' => $this->request->getPost('status'),
        ];
        $anggaranModel->insert($data);

        return redirect()->to('/admin/anggaran');
    }

    public function editAnggaran($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $anggaranModel = new AnggaranModel();
        $data['anggaran'] = $anggaranModel->find($id);
        return view('admin/anggaran/edit', $data);
    }

    public function updateAnggaran($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $anggaranModel = new AnggaranModel();
        $data = [
            'nama_anggaran' => $this->request->getPost('nama_anggaran'),
            'status' => $this->request->getPost('status'),
        ];
        $anggaranModel->update($id, $data);

        return redirect()->to('/admin/anggaran');
    }

    public function deleteAnggaran($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $anggaranModel = new AnggaranModel();
        $anggaranModel->delete($id);

        return redirect()->to('/admin/anggaran');
    }

    // Ruangan
    public function indexRuangan()
    {
        $ruanganModel = new RuanganModel();
        $data['ruangan'] = $ruanganModel->findAll();
        return view('admin/ruangan/index', $data);
    }

    public function createRuangan()
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }
        return view('admin/ruangan/create');
    }

    public function storeRuangan()
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $ruanganModel = new RuanganModel();
        $data = [
            'nama_ruangan' => $this->request->getPost('nama_ruangan'),
            'status' => $this->request->getPost('status'),
        ];
        $ruanganModel->insert($data);

        return redirect()->to('/admin/ruangan');
    }

    public function editRuangan($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $ruanganModel = new RuanganModel();
        $data['ruangan'] = $ruanganModel->find($id);
        return view('admin/ruangan/edit', $data);
    }

    public function updateRuangan($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $ruanganModel = new RuanganModel();
        $data = [
            'nama_ruangan' => $this->request->getPost('nama_ruangan'),
            'status' => $this->request->getPost('status'),
        ];
        $ruanganModel->update($id, $data);

        return redirect()->to('/admin/ruangan');
    }

    public function deleteRuangan($id)
    {
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak.');
        }

        $ruanganModel = new RuanganModel();
        $ruanganModel->delete($id);

        return redirect()->to('/admin/ruangan');
    }
}
