<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::dash', ['filter' => 'login']);
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('datauser', 'Home::datauser',['as'=>'user',]);
    $routes->get('adduser', 'Home::adduser',['as'=>'adduser']);
    $routes->post('simpanuser', 'Home::simpanuser',['as'=>'simpanuser']);
    $routes->post('gantipass', 'Home::ubahpass',['as'=>'gantipass']);
});