<?php

namespace App\Controllers;

use App\Models\Aspek_model;

class Aspek extends BaseController
{
    public function index()
    {
        $data['title'] = "Aspek";
        $data['activeMenu'] = "validasi";

        $aspek = new Aspek_model();
        $dataaspek = $aspek->tampildata();
        $data['dataAspek']= $dataaspek;
        return view('aspek', $data);
    }
}
