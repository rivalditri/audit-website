<?php

namespace App\Controllers;

class levelKriteria extends BaseController
{

    public function index($id_level = 0)
    {
        $data['title'] = "Level Indikator";
        $data['activeMenu'] = "validasi";

        $levelindikator = $this->levelIndikator_model->getLevel($id_level);
        $data['dataLevel'] = $levelindikator;
        return view('level_indikator', $data);
    }
}
