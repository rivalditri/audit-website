<?php

namespace App\Controllers;

class Dokumen extends BaseController
{

    public function upload()
    {
        $idUser = session()->get('id_user');
        $user = session()->get('user');
        $idlevel = $this->request->getPost('id_level');
        $name = "";
        $path = WRITEPATH . './uploads';
        if ($this->validate([
            'file' => [
                'uploaded[file]',
                'ext_in[file,pdf,doc,docx]',
                'max_size[file,4096]',
            ],
        ])) {
            $file = $this->request->getFile('file');
            if ($file->isValid() && !$file->hasMoved()) {
                $name = "2023" . "_" . $user . "_" . $idlevel . "." . $file->getExtension();
                $file->move($path, $name);
                $data = [
                    'file_upload' => $file->getName(),
                    'id_user' => $idUser,
                    'id_level_kriteria' => $idlevel,
                    'created_by' => $user,
                ];
                $row = $this->dokumen_model->insertDokumen($data);
                if ($row) {
                    session()->setFlashdata('success', 'File berhasil diupload');
                    $this->response->setStatusCode(201, 'Created');
                    return redirect()->back();
                } else {
                    session()->setFlashdata('failed', 'something went wrong');
                    $this->response->setStatusCode(400, 'Bad Request');
                    return redirect()->back();
                }
            } else {
                //error
                session()->setFlashdata('failed', 'file tidak valid');
                $this->response->setStatusCode(400, 'Bad Request');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('failed', 'format tidak sesuai');
            $this->response->setStatusCode(400, 'Bad Request');
            return redirect()->back();
        }
    }
    public function download($id_level)
    {
        $idFile = $this->dokumen_model->getIdFile($id_level);
        if ($idFile) {
            $dokumen = $this->dokumen_model->find($idFile->id_file_dokumen);
            // Tentukan path file yang akan diunduh
            $path = WRITEPATH . 'uploads/' . $dokumen->file_upload;

            // Periksa apakah file ada
            if (file_exists($path)) {
                // Inisialisasi respon download
                return $this->response->download($path, null);
            } else {
                // Jika file tidak ditemukan, tampilkan pesan kesalahan
                return redirect()->back()->with('error', 'File tidak ditemukan');;
            }
        }
        return redirect()->back()->with('error', 'File tidak ditemukan di proses' . $id_level);
    }
}
