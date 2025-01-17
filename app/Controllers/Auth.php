<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;

class Auth extends BaseController
{
    protected $user; // membuat variabel user dengan tipe Users (model).
    /**
     * Fungsi yg dijalankan pertama kali oleh program secara otomatis.
     */
    public function __construct()
    {
        $this->user = new Users(); // membuat objek baru dari model Users.
    }
    /**
     * Fungsi untuk menampilkan halaman login (views).
     */
    public function login()
    {
        // jika user sudah login, maka redirect ke home page.
        if (get_cookie('user') && $this->checkUser()) {
            return redirect()->to(base_url('/'));
        }
        return view('pages/auth/login');
    }
    /**
     * Fungsi untuk melakukan proses login (post).
     */
    public function loginAction()
    {
        // ambil data dari form login.
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        // cek apakah user dengan username tersebut ada di database.
        $user = $this->user->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // jika user ditemukan, maka buat cookie dan redirect ke home page.
            $userInfo = [
                'id_user' => $user['id_user'],
                'username' => $user['username'],
                'role' => $user['role'],
            ];
            $userInfoEncrypt = $this->encryptUserInfo($userInfo);
            setcookie('spk_user', $userInfoEncrypt, strtotime('+30 days'), '/');
            return redirect()->to(base_url('/'));
        } else {
            // jika user tidak ditemukan, maka redirect ke halaman login dengan pesan error.
            return redirect()->to(base_url('/login'))->with('error', 'Username atau password salah')->withInput();
        }
    }
}
