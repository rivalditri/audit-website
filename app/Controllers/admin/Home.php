<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\User_model;

class Home extends BaseController
{
    public function index()
    {
        // dd("admin");
        $data['title'] = "Dashboard";
        $data['activeMenu'] = "validasi";

        $user = $this->user_model->getUsers();
        $data['dataUser']= $user;
        return view('dashboard', $data);
    }
}
