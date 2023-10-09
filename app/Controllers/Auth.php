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

        $row = $this->user_model->where('inisial', $username)->first();
        if($row->is_admin == 1){
            $data = [
                'role' => $row->is_admin,
            ];
            session()->set($data);
            return redirect()->to(base_url('/admin'));
        }else if($row->is_admin == 0){
            $data = [
                'id_user' => $row->id_user,
                'role' => 0
            ];
            session()->set($data);
            return redirect()->to(base_url('/aspek/'.$row->id_user));
        }
        return redirect()->to(base_url('/'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}