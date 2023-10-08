<?php

namespace App\Controllers;

use App\Models\User_model;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = "Dashboard";
        $data['activeMenu'] = "validasi";
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);

        $user = new User_model();
        $datauser = $user->tampildata();
        $data = array('dataUser' => $datauser);
        echo view('dashboard', $data);

        echo view('templates/footer');
    }
}
