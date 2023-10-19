<?php

namespace App\Controllers;
use App\Models\Dokumen_model;

class Dokumen extends BaseController
{
    protected $dokumen_model;
    public function __construct()
    {
        $this->dokumen_model = new Dokumen_model();
    }
    public function upload()
    {
        $idUser = session()->get('id_user');
        $user = session()->get('user');
        $idlevel = $this->request->getPost('id_level');
        $name = "";
        $path = WRITEPATH . './uploads';
        if($this->validate([
            'file' => [
                'uploaded[file]',
                'ext_in[file,pdf,doc,docx]',
                'max_size[file,4096]',
            ],
        ])){
            $file = $this->request->getFile('file');
            if($file->isValid() && !$file->hasMoved()){
                $name = "2023"."_".$user."_".$idlevel.".".$file->getExtension();
                $file->move($path, $name);
                $data = [
                    'file_upload' => $name,
                    'id_user' => $idUser,
                    'id_level_kriteria' => $idlevel,
                    'created_by' => $user,
                ];
                $row = $this->dokumen_model->insertDokumen($data);
                if(!$row){
                    session()->setFlashdata('success', 'File berhasil diupload');
                    $this->response->setStatusCode(201, 'success');
                }else{
                    $this->response->setStatusCode(503, 'Database error');
                }
                
            }else{
                //error
                session()->setFlashdata('failed', 'something went wrong');
                $this->response->setStatusCode(400, 'something went wrong');
            }
        }else {
            session()->setFlashdata('failed', 'format tidak sesuai');
            $this->response->setStatusCode(400, 'format tidak sesuai');
        }
    }
}