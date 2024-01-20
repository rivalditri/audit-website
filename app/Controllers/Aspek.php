<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Aspek extends BaseController
{

    public function index($id_user = 0)
    {
        $data['title'] = "Aspek";
        $data['activeMenu'] = "validasi";
        $user = $this->user_model->where('id_user', $id_user)->first();
        $nama_unit = $user->nama_unit;
        session()->set('nama_unit', $nama_unit);
        session()->set('user', $id_user);
        $aspeks = $this->aspek_model->findAll();
        foreach ($aspeks as $aspek) {
            $id_aspek = $aspek->id_aspek;
            $level = $this->hitungLevel($id_aspek);
            $average = $this->averageLevel($level);
            $maturitas[$id_aspek] = $average;
        }
        $data['maturitas'] = $maturitas;
        $data['dataAspek'] = $aspeks;
        return view('aspek', $data);
    }

    public function result($id_user = 0)
    {
        $data['title'] = "Aspek";
        $data['activeMenu'] = "result";
        $user = $this->user_model->where('id_user', $id_user)->first();
        $nama_unit = $user->nama_unit;
        session()->set('nama_unit', $nama_unit);
        session()->set('user', $id_user);
        $aspeks = $this->aspek_model->findAll();
        foreach ($aspeks as $aspek) {
            $id_aspek = $aspek->id_aspek;
            $level = $this->hitungLevel($id_aspek);
            $average = $this->averageLevel($level);
            $maturitas[$id_aspek] = $average;
        }
        $data['maturitas'] = $maturitas;
        $data['dataAspek'] = $aspeks;
        $data['kategori'] = 'result';
        return view('aspek', $data);
    }

    public function process($id_user = 0)
    {
        $data['title'] = "Aspek";
        $data['activeMenu'] = "process";
        $user = $this->user_model->where('id_user', $id_user)->first();
        $nama_unit = $user->nama_unit;
        session()->set('nama_unit', $nama_unit);
        session()->set('user', $id_user);
        $aspeks = $this->aspek_model->findAll();
        foreach ($aspeks as $aspek) {
            $id_aspek = $aspek->id_aspek;
            $level = $this->hitungLevel($id_aspek);
            $average = $this->averageLevel($level);
            $maturitas[$id_aspek] = $average;
        }
        $data['maturitas'] = $maturitas;
        $data['dataAspek'] = $aspeks;
        $data['kategori'] = 'process';
        return view('aspek', $data);
    }
}
