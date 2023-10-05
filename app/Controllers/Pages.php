<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {
        return view('dashboard');
    }
    public function dashboard()
    {
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('dashboard');
        echo view('templates/footer');
    }
    public function user()
    {
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('user');
        echo view('templates/footer');
    }


}