<?php

namespace App\Controllers;

class levelKriteria extends BaseController
{

    public function index($id_level = 0)
    {
        $data['title'] = "Level Proses";
        $data['activeMenu'] = "validasi";

        //get Indikator dari level indikator
        $indikator = $this->levelProses_model->getIndikator($id_level);
        $data['indikator'] = $indikator->indikator;
        
        //get aspek dari indikator
        $aspek = $this->indikator_model->getAspek($indikator->id_indikator);
        $data['aspek'] = $aspek;

        //kriteria dari level Indikator
        $kriteriaLevel = $this->levelIndikator_model->getKriteriaLevel($id_level);
        //get all proses on level
        $proses = $this->levelProses_model->getAllProses($id_level);
        
        $data['kriteria'] = $kriteriaLevel->kriteria_level;
        $data['level'] = $kriteriaLevel->nama_level;
        $data['data_proses'] = $proses;
        return view('level_kriteria', $data);
    }
}
