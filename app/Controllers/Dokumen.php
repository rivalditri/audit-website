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
                    'file_upload' => $name,
                    'id_user' => $idUser,
                    'id_level_kriteria' => $idlevel,
                    'created_by' => $user,
                ];
                $row = $this->dokumen_model->insertDokumen($data);
                if (!$row) {
                    session()->setFlashdata('success', 'File berhasil diupload');
                    $this->response->setStatusCode(201, 'Created');
                    return redirect()->back();
                } else {
                    $this->response->setStatusCode(400, 'Bad Request');
                    return redirect()->back();
                }
            } else {
                //error
                session()->setFlashdata('failed', 'something went wrong');
                $this->response->setStatusCode(400, 'Bad Request');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('failed', 'format tidak sesuai');
            $this->response->setStatusCode(400, 'Bad Request');
            return redirect()->back();
        }
    }
}
