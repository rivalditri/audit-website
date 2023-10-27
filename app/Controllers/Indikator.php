<?php

namespace App\Controllers;

use App\Models\Indikator_model;
use App\Models\Aspek_model;

class Indikator extends BaseController
{
    protected $indikator_model;
    protected $aspek_model;

    public function __construct()
    {
        $this->indikator_model = new Indikator_model();
        $this->aspek_model = new Aspek_model();
    }

    public function index($id_aspek = 0)
    {
        $data['title'] = "Indikator";
        $data['activeMenu'] = "validasi";

        $indikator = $this->indikator_model->where('id_aspek', $id_aspek)->findAll();
        $aspek = $this->aspek_model->where('id_aspek', $id_aspek)->first();
        $data['aspek'] = $aspek->aspek;
        $data['dataIndikator'] = $indikator;
        return view('indikator', $data);
    }
}
