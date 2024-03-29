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
        if ($id_aspek == 0 || $id_aspek == 1) {
            $data['activeMenu'] = "result";
        } else {
            $data['activeMenu'] = "process";
        }
        $indikators = $this->indikator_model->where('id_aspek', $id_aspek)->findAll();
        $level = $this->hitungLevel($id_aspek);
        $data['level'] = $level;
        $aspek = $this->aspek_model->where('id_aspek', $id_aspek)->first();
        $data['aspek'] = $aspek->aspek;
        $data['dataIndikator'] = $indikators;
        return view('indikator', $data);
    }
}
