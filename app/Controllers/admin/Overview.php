<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Overview extends BaseController
{
    public function index()
    {
        $user = $this->user_model->getUsers();
        $aspeks = $this->aspek_model->where('id_aspek >', 2)->findAll();

        foreach ($aspeks as $aspek) {
            $indikators = $this->indikator_model->where('id_aspek', $aspek->id_aspek)->findAll();
            $capaianIndikator = $this->capaianIndikator($indikators);
            $average[$aspek->id_aspek] = $this->capaianAspek($capaianIndikator);
        }

        foreach ($user as $u) {
            $total = 0;
            foreach ($aspeks as $aspek) {
                $total += $average[$aspek->id_aspek][$u->id_user];
            }
            $average[$u->nama_unit] = $total / count($aspeks);
        }

        $data['title'] = "Overview";
        $data['activeMenu'] = "overview";
        $data['aspeks'] = $aspeks;
        $data['hasil'] = $average;
        $data['dataUser'] = $user;
        return view('overview', $data);
    }
}
