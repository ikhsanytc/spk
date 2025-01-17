<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new Users();
    }
    public function login()
    {
        if (get_cookie('user') && $this->checkUser()) {
            return redirect()->to(base_url('/'));
        }
        return view('pages/auth/login');
    }
    public function loginAction()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $this->user->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {

            $userInfo = [
                'id_user' => $user['id_user'],
                'username' => $user['username'],
                'role' => $user['role'],
            ];
            $userInfoEncrypt = $this->encryptUserInfo($userInfo);
            setcookie('spk_user', $userInfoEncrypt, strtotime('+30 days'), '/');
            return redirect()->to(base_url('/'));
        } else {
            return redirect()->to(base_url('/login'))->with('error', 'Username atau password salah')->withInput();
        }
    }
}
