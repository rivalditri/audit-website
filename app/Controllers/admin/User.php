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
}
