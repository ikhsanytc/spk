<?php

namespace App\Controllers;

use App\Models\Users;

class Home extends BaseController
{
    protected $user;
    protected $helpers = ['cookie', 'url', 'form'];

    public function __construct()
    {
        $this->user = new Users();
    }
    public function index(): string
    {
        return view('welcome_message');
    }
    public function login()
    {
        return view('pages/auth/login');
    }
    public function loginAction()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $this->user->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            setcookie('spk_user', $user['id_user'], strtotime('+30 days'), '/');
            setcookie('spk_role', $user['role'], strtotime('+30 days'), '/');
            setcookie('spk_nama', $user['nama'], strtotime('+30 days'), '/');
            setcookie('spk_email', $user['email'], strtotime('+30 days'), '/');
            return redirect()->to(base_url('/'));
        } else {
            return redirect()->to(base_url('/login'))->with('error', 'Username atau password salah');
        }
    }
}
