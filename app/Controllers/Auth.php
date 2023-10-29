<?php

namespace App\Controllers;

use App\Models\User_model;
use Google\Client;
use Google\Service\Oauth2;

class Auth extends BaseController
{
    protected $googleClient;
    protected $users;

    public function __construct()
    {
        $this->users = new User_model();
        $this->googleClient = new Client();

        $this->googleClient->setClientId('935411030534-t7m9e0dl25363f655giiiksh1kkp9838.apps.googleusercontent.com');
        $this->googleClient->setClientSecret('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');
        $this->googleClient->setRedirectUri('http://localhost:8080/auth/googleauth');
        $this->googleClient->setAccessType('offline');
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');
    }

    public function index(): string
    {
        $data['title'] = "Login Page";
        $data['link'] = $this->googleClient->createAuthUrl();
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

    public function googleauth()
    {
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if (!isset($token['error'])) {
            $this->googleClient->setAccessToken($token['access_token']);
            $googleService = new Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();
            $row = $this->users->where('email', $data['email'])->first();

            if ($row == null) {
                session()->setFlashdata('failed', 'User tidak ditemukan');
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

            // $row = [
            //     'id_user' => $data['id'],
            //     'email' => $data['email'],
            //     'nama_unit' => $data['name'],
            //     'inisial' => $data['family_name'],
            //     'created_by' => 'admin',
            // ];
            // $this->users->save($row);

            // $dataSession = [
            //     'id_user' => $data['id'],
            //     'user' => $data['name'],
            //     'role' => 0
            // ];
            // session()->set($dataSession);
            // return redirect()->to(base_url('/aspek/' . $data['id']));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
