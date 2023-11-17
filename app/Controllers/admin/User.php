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

    public function adduser()
    {
        $email = $this->request->getPost('email');
        $nama_unit = $this->request->getPost('nama_unit');
        $inisial = $this->request->getPost('inisial');

        $data = [
            'id_user' => $inisial,
            'email' => $email,
            'nama_unit' => $nama_unit,
            'inisial' => $inisial,
            'is_admin' => 0,
            'is_keuangan' => 1,
            'created_by' => 'admin'
        ];

        $user = new User_model();
        $tabelUser = "m_user";

        $user->saveUser($tabelUser, $data);
        return redirect()->back();
    }

    public function edituser()
    {
        $id = $this->request->getPost('id');
        $email = $this->request->getPost('email');
        $nama_unit = $this->request->getPost('nama_unit');
        $inisial = $this->request->getPost('inisial');
        $status = $this->request->getPost('status');

        $data = [
            'email' => $email,
            'nama_unit' => $nama_unit,
            'inisial' => $inisial,
            'is_keuangan' => $status,
        ];

        $where = ['id_user' => $id];

        $user = new User_model();
        $tabeluser = "m_user";

        $user->updateUser($tabeluser, $data, $where);
        return redirect()->back();
    }

    public function deleteuser($id)
    {
        $user = new User_model();
        $user->removeUser($id);
        return redirect()->back();
    }
}
