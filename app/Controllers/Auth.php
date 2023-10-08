<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index(): string
    {
        $data['title'] = "Login Page";
        return view('login', $data);
    }
    public function login()
    {
        // get data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        //cek data dari form
        if ($username == "admin" && $password == "admin") {
            //jika benar, maka redirect ke halaman dashboard
            return redirect()->to(base_url('home'));
        } else if($username == "saintek" && $password == "saintek"){
            return redirect()->to(base_url('home'));
        }else{
            //jika salah, maka redirect ke halaman login
            return redirect()->to(base_url('/'));
        }
    }
}