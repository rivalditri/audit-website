<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index()
    {
        $data['title'] = "Register";
        echo view('register', $data);
    }
}
