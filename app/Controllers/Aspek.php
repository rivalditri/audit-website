<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Aspek extends BaseController
{

    public function index($id_user = 0)
    {
        $data['title'] = "Aspek";
        $data['activeMenu'] = "validasi";
        $user = $this->user_model->where('id_user', $id_user)->first();
        $nama_unit = $user->nama_unit;
        session()->set('nama_unit', $nama_unit); ;
        $aspek = $this->aspek_model->findAll();
        $data['dataAspek']= $aspek;
        return view('aspek', $data);
    }
}
