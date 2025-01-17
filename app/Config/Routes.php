<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->post('/loginAction', 'Auth::loginAction');
$routes->get('/dashboard', 'Home::dashboard');
$routes->delete('/logout', function () {
    setcookie('spk_user', '', time() - 3600, '/');
    return redirect()->to(base_url('/login'));
});
