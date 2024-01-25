<?php

namespace App\Controllers;

class levelIndikator extends BaseController
{

    public function index($id_indikator = 0)
    {
        $data['title'] = "Level Indikator";
        $indikator = $this->indikator_model->getIndikator($id_indikator);
        $aspek = $this->indikator_model->getAspek($id_indikator);
        $levelindikator = $this->levelIndikator_model->getLevel($id_indikator);
        $capaian = $this->capaian($id_indikator);
        $data['cpu'] = $capaian['cpu'];
        $data['csatker'] = $capaian['csatker'];
        $data['indikator'] = $indikator;
        $data['aspek'] = $aspek;
        $data['dataLevel'] = $levelindikator;
        if ($aspek == "Keuangan" || $aspek == "Pelayanan") {
            $data['activeMenu'] = "result";
        } else {
            $data['activeMenu'] = "process";
        }
        return view('level_indikator', $data);
    }
}
