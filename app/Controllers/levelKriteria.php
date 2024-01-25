<?php

namespace App\Controllers;

class levelKriteria extends BaseController
{

    public function index($id_level = 0)
    {
        $data['title'] = "Level Proses";

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
        $komentar = array();
        $status = array();
        $id_user = session()->get('user');

        foreach ($proses as $levelKriteria) {
            $idLevel = $levelKriteria->id_level_kriteria;
            $idFile = $this->dokumen_model->getIdFile($idLevel, $id_user);
            $status[$idLevel] = "-";
            $komentar[$idLevel] = "-";
            if ($idFile) {
                $id_task = $this->taskValidation_model->getValidation($idFile->id_file_dokumen);
                $komentar[$idLevel] = $id_task->komentar;
                $status[$idLevel] = $id_task->id_status;
            }
        }

        $data['komentar'] = $komentar;
        $data['status'] = $status;
        // dd($data);
        $data['kriteria'] = $kriteriaLevel->kriteria_level;
        $data['level'] = $kriteriaLevel->nama_level;
        $data['data_proses'] = $proses;
        if ($aspek == "Keuangan" || $aspek == "Pelayanan") {
            $data['activeMenu'] = "result";
        } else {
            $data['activeMenu'] = "process";
        }
        return view('level_kriteria', $data);
    }
}
