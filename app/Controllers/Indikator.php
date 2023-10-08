<?php

namespace App\Controllers;

use App\Models\Indikator_model;

class Indikator extends BaseController
{
    public function index()
    {
        $data['title'] = "Indikator";
        $data['activeMenu'] = "validasi";
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);

        $indikator = new Indikator_model();
        $dataindikator = $indikator->tampildata();
        $data = array('dataIndikator' => $dataindikator);
        echo view('indikator', $data);

        echo view('templates/footer');
    }
}
