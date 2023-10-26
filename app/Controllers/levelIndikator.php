<?php

namespace App\Controllers;

class levelIndikator extends BaseController
{

    public function index($id_indikator = 0)
    {
        $data['title'] = "Level Indikator";
        $data['activeMenu'] = "validasi";

        $indikator = $this->indikator_model->getIndikator($id_indikator);
        $aspek = $this->indikator_model->getAspek($id_indikator);
        $levelindikator = $this->levelIndikator_model->getLevel($id_indikator);
        $cpu = array();

        foreach ($levelindikator as $level) {
            $idLevel = $level->id_level_kapabilitas;
            $jumlah = $this->levelProses_model->countProses($idLevel)->jumlah_proses;
            $count = $this->dokumen_model->getUploadedDocument($idLevel)->jumlah_dokumen;
            $cpu[$idLevel] = $count / $jumlah;
            $cpu[$idLevel] = round($cpu[$idLevel] * 100, 2);
        }
        $data['cpu'] = $cpu;
        $data['indikator'] = $indikator;
        $data['aspek'] = $aspek;
        $data['dataLevel'] = $levelindikator;
        return view('level_indikator', $data);
    }
}
