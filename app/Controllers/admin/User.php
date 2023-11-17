<?php

namespace App\Controllers\admin;

use App\Models\User_model;
use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        $data['title'] = "Data User";
        $data['activeMenu'] = "user";

        $user = new User_model();
        $datauser = $user->findAll();
        $data['dataUser'] = $datauser;
        return view('user', $data);
    }

    public function create()
    {
    }

    public function edit($id)
    {
        $nama_unit = $this->request->getPost('nama_unit');
        $inisial = $this->request->getPost('inisial');
        $email = $this->request->getPost('email');
        $is_admin = $this->request->getPost('status');
        $data = [
            'email' => $email,
            'nama_unit' => $nama_unit,
            'inisial' => $inisial,
            'is_admin' => $is_admin,
            'is_keuangan' => 0,
        ];
        $result = $this->user_model->update($id, $data);
        if ($result) {
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to('/users');
        } else {
            session()->setFlashdata('error', 'Data gagal diubah');
            return redirect()->to('/users');
        }
    }

    public function delete($id)
    {
        // dd($id);
        $result = $this->user_model->delete($id);
        if ($result) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
            return redirect()->to('/users');
        } else {
            session()->setFlashdata('error', 'Data gagal dihapus');
            return redirect()->to('/users');
        }
    }
}
