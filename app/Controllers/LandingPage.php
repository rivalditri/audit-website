<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LandingPage extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Landing Page',
            'activeMenu' => 'landingpage'
        ];
        return view('landing_page', $data);
    }
}
