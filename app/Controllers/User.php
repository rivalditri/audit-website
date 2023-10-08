<?php

namespace App\Controllers;

use App\Models\User_model;

class User extends BaseController
{
    public function index()
    {
        $data['title'] = "Data User";
        $data['activeMenu'] = "user";
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);

        $user = new User_model();
        $datauser = $user->tampildata();
        $data = array('dataUser' => $datauser);
        echo view('user', $data);

        echo view('templates/footer');
    }
}
