<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Capaian extends BaseController
{
    public function index($aspek)
    {
        $nama_aspek = $this->aspek_model->where('id_aspek', $aspek)->first();
        $user = $this->user_model->getUsers();
        $indikators = $this->indikator_model->where('id_aspek', $aspek)->findAll();
        $capaianIndikator = $this->capaianIndikator($indikators);
        $average = $this->capaianAspek($capaianIndikator);

        $data['title'] = "Capaian";
        $data['activeMenu'] = "overview";
        $data['indikators'] = $indikators;
        $data['aspek'] = $nama_aspek;
        $data['capaianIndikator'] = $capaianIndikator;
        $data['hasil'] = $average;
        $data['dataUser'] = $user;
        return view('capaian', $data);
    }
}
