<?php

namespace App\Controllers;

use App\Models\Aspek_model;

class Aspek extends BaseController
{
    public function index()
    {
        $data['title'] = "Aspek";
        $data['activeMenu'] = "validasi";
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);

        $aspek = new Aspek_model();
        $dataaspek = $aspek->tampildata();
        $data = array('dataAspek' => $dataaspek);
        echo view('aspek', $data);

        echo view('templates/footer');
    }
}
