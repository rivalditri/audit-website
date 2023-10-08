<?php

namespace App\Controllers;

use App\Models\Indikator_model;

class Indikator extends BaseController
{
    public function index()
    {
        $data['title'] = "Indikator";
        $data['activeMenu'] = "validasi";

        $indikator = new Indikator_model();
        $dataindikator = $indikator->tampildata();
        $data['dataIndikator'] = $dataindikator;
        return view('indikator', $data);
    }
}
