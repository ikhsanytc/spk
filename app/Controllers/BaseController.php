<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'url', 'cookie'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');
    }
    /**
     * Encrypt user info dari array ke json lalu di encrypt menggunakan service encrypter dari codeigniter4
     */
    public function encryptUserInfo(array $data)
    {
        $encrypter = \Config\Services::encrypter();
        $userInfoJson = json_encode($data);
        $userInfoEncrypted = $encrypter->encrypt($userInfoJson);
        return $userInfoEncrypted;
    }
    /**
     * Decrypt user info dari json yg udh di encrypt menggunakan encryptUserInfo lalu menjadi array assosiative
     */
    public function decryptUserInfo(string $userInfoEncrypted)
    {
        $encrypter = \Config\Services::encrypter();
        $userInfoJson = $encrypter->decrypt($userInfoEncrypted);
        $userInfo = json_decode($userInfoJson, true);
        return $userInfo;
    }
    /**
     * Mendapatkan informasi role jika user sudah login.
     */
    public function get_role()
    {
        if (get_cookie('user')) {
            $user = $this->decryptUserInfo(get_cookie('user'));
            if ($user['role'] == '1') {
                return 'admin';
            }
            return 'user';
        }
        return false;
    }
    /**
     * Cek apakah user sudah login atau belum.
     */
    public function checkUser()
    {
        try {
            $userInfo = $this->decryptUserInfo(get_cookie('user'));
            if (!isset($userInfo['id_user'], $userInfo['username'], $userInfo['role'])) {
                set_cookie('spk_user', '', strtotime('-30 days'), '/');
                return false;
            }
            return true;
        } catch (\Exception $e) {
            setcookie('spk_user', '', strtotime('-30 days'), '/');
            return false;
        }
    }
}
