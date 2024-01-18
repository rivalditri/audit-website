<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\User_model;

class Overview extends BaseController
{
    public function index()
    {
        $data['title'] = "Overview";
        $data['activeMenu'] = "overview";

        // $user = $this->user_model->getUsers();
        // $data['dataUser']= $user;
        return view('overview', $data);
    }
}
