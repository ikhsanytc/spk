<?php

namespace App\Controllers;

use App\Models\Users;

class Home extends BaseController
{
    protected $user;
    protected $encrypt;
    /**
     * Fungsi yg dijalankan pertama kali oleh program secara otomatis.
     */
    public function __construct()
    {
        $this->user = new Users(); // Load model
        $this->encrypt = \Config\Services::encrypter(); // Load encryption library
    }

    public function index()
    {
        return redirect()->to(base_url('/dashboard'));
    }
    public function dashboard()
    {
        // jika user belum login, maka redirect ke halaman login.
        if (!get_cookie('user') || !$this->checkUser()) {
            return redirect()->to(base_url('/login'))->with('error', 'Anda harus login terlebih dahulu');
        }
        // jika user sudah login, maka tampilkan halaman dashboard.
        $user = $this->decryptUserInfo(get_cookie('user'));
        $data = [
            'page' => 'Dashboard',
            'user_role' => $this->get_role(),
            'username' => $user['username'],
            'krit' => [
                'banyak' => 0,
            ]
        ]; // Data yang akan dikirim ke view
        return view('pages/dashboard', $data);
    }
}
