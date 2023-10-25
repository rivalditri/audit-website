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

        $row = $this->user_model->where('inisial', $username)->first();
        if ($row == null) {
            return redirect()->to(base_url('/'));
        } else {
            if ($row->is_admin == 1) {
                $data = [
                    'id_user' => $row->id_user,
                    'user' => $row->inisial,
                    'role' => $row->is_admin,
                ];
                session()->set($data);
                return redirect()->to(base_url('/admin'));
            } else if ($row->is_admin == 0) {
                $data = [
                    'id_user' => $row->id_user,
                    'user' => $row->inisial,
                    'role' => 0
                ];
                session()->set($data);
                return redirect()->to(base_url('/aspek/' . $row->id_user));
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
