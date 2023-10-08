<?php

namespace App\Controllers;

use App\Models\User_model;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = "Dashboard";
        $data['activeMenu'] = "validasi";

        $user = new User_model();
        $datauser = $user->tampildata();
        $data['dataUser']= $datauser;
        return view('dashboard', $data);
    }
}
