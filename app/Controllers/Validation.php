<?php

namespace App\Controllers;

class Validation extends BaseController
{
    public function validasi()
    {
        //get input data
        $id_proses = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $komentar = $this->request->getPost('komentar');

        //get id file from id proses
        $id_file = $this->dokumen_model->getIdFile($id_proses);
        $id = $this->taskValidation_model->getValidation($id_file)->id_task_validation;

        $data = [
            'id_status' => $status,
            'komentar' => $komentar,
            'validation_by' => 'admin',
        ];
        $row = $this->taskValidation_model->update($id, $data);
        if ($row) {
            session()->setFlashdata('success', 'Dokumen Berhasil Di Audit');
            $this->response->setStatusCode(200, 'OK')->setJSON([
                'status' => 'success',
                'message' => 'Dokumen Berhasil Di Audit',
                'data' => $data
            ]);
        } else {
            session()->setFlashdata('failed', 'Dokumen Gagal Di Audit');
            $this->response->setStatusCode(400, 'Bad Request')->setJSON([
                'status' => 'failed',
                'message' => 'Dokumen Gagal Di Audit',
                'data' => $data
            ]);;
        }
    }

    public function getStatus()
    {
        $this->taskValidation_model->find();
    }

    public function index()
    {
        $data['title'] = "Register";
        echo view('register', $data);
    }
}
