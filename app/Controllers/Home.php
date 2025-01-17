<?php

namespace App\Controllers;

use App\Models\Users;

class Home extends BaseController
{
    protected $user;
    protected $encrypt;
    public function __construct()
    {
        $this->user = new Users();
        $this->encrypt = \Config\Services::encrypter();
    }
    public function index()
    {
        return redirect()->to(base_url('/dashboard'));
    }
    public function dashboard()
    {
        if (!get_cookie('user') || !$this->checkUser()) {
            return redirect()->to(base_url('/login'))->with('error', 'Anda harus login terlebih dahulu');
        }
        $user = $this->decryptUserInfo(get_cookie('user'));
        $data = [
            'page' => 'Dashboard',
            'user_role' => $this->get_role(),
            'username' => $user['username'],
            'krit' => [
                'banyak' => 0,
            ]
        ];
        return view('pages/dashboard', $data);
    }
}
