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
        $this->googleClient->setRedirectUri(base_url() . 'auth/googleauth');
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

    public function googleauth()
    {
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if (!isset($token['error'])) {
            $this->googleClient->setAccessToken($token['access_token']);
            $googleService = new Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();
            $row = $this->users->where('email', $data['email'])
                ->where('delete_at', null)
                ->first();

            if ($row == null) {
                session()->setFlashdata('failed', 'User tidak ditemukan/inactive');
                return redirect()->to(base_url('/'));
            } else {
                session()->set('login_unit', $row->nama_unit);
                session()->set('login_user', $row->id_user);
                if ($row->is_admin == 1) {
                    $data = [
                        'id_user' => $row->id_user,
                        'inisial' => $row->inisial,
                        'role' => 1,
                    ];
                    session()->set($data);
                    return redirect()->to(base_url('/admin'));
                } else if ($row->is_admin == 0) {
                    $data = [
                        'id_user' => $row->id_user,
                        'inisial' => $row->inisial,
                        'role' => 0
                    ];
                    session()->set($data);
                    return redirect()->to(base_url('/landingpage'));
                }
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
