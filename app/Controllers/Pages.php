<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {
        return view('dashboard');
    }

    public function user()
    {
        $data['title'] = "Data User";
        $data['activeMenu'] = "user";
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('user');
        echo view('templates/footer');
    }

    public function dashboard()
    {
        $data['title'] = "Dashboard";
        $data['activeMenu'] = "validasi";
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('dashboard');
        echo view('templates/footer');
    }

    public function aspek()
    {
        $data['title'] = "Aspek";
        $data['activeMenu'] = "validasi";
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('aspek');
        echo view('templates/footer');
    }

    public function indikator()
    {
        $data['title'] = "Indikator";
        $data['activeMenu'] = "validasi";
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('indikator');
        echo view('templates/footer');
    }
}
