<?php

namespace App\Controllers;

class Dokumen extends BaseController
{
    public function upload()
    {
        $id = $this->request->getPost('id');
        if($this->validate([
            'file' => [
                'uploaded[file]',
                'ext_in[file,pdf,doc,docx]',
                'max_size[file,4096]',
            ],
        ])){
            $file = $this->request->getFile('file');
            if($file->isValid() && !$file->hasMoved()){
                $name = $id;
                $file->move('./uploads', $name);
                echo "File berhasil diupload";
            }else{
                echo "File gagal diupload";
            }
        }else {
            echo "File gagal diupload";
        }
    }
}