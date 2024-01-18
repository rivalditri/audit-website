<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\User_model;

class Capaian extends BaseController
{
    public function index()
    {
        $data['title'] = "Capaian";
        $data['activeMenu'] = "overview";

        // $user = $this->user_model->getUsers();
        // $data['dataUser']= $user;
        return view('capaian', $data);
    }
}
