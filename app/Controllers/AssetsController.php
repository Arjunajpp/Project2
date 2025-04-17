<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Assets extends Controller
{
    // Method untuk meng-handle file uploads
    public function uploads()
    {
        // Menerima file yang diupload
        $file = $this->request->getFile('bukti_gambar');

        if ($file->isValid() && !$file->hasMoved()) {
            // Menghasilkan nama file acak
            $newName = $file->getRandomName();
            
            // Memindahkan file ke direktori public/assets/uploads
            $file->move('assets/uploads', $newName);
            
            // Mengirimkan respons sukses
            return redirect()->back()->with('success', 'File berhasil diupload!');
        } else {
            // Menangani error upload file
            return redirect()->back()->with('error', 'Gagal mengupload file.');
        }
    }
}
