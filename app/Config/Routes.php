<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::dash', ['filter' => 'login']);
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('datauser', 'Home::datauser',['as'=>'user',]);
    $routes->get('mahasiswa', 'Home::mahasiswaindex',['as'=>'mahasiswa',]);
    $routes->get('perusahaan', 'Home::perusahaanindex',['as'=>'perusahaan',]);
    $routes->get('adduser', 'Home::adduser',['as'=>'adduser']);
    $routes->post('simpanuser', 'Home::simpanuser',['as'=>'simpanuser']);
    $routes->post('gantipass', 'Home::ubahpass',['as'=>'gantipass']);
    $routes->post('editrelasi', 'Home::editrelasi',['as'=>'editrelasi']);
    $routes->post('addrelasi', 'Home::addrelasi',['as'=>'addrelasi']);
    $routes->post('deleterelasi', 'Home::deleterelasi',['as'=>'deleterelasi']);
    $routes->post('editmahasiswa', 'Home::editmahasiswa',['as'=>'editmahasiswa']);
    $routes->post('addmahasiswa', 'Home::addmahasiswa',['as'=>'addmahasiswa']);
    $routes->post('deletemahasiswa', 'Home::deletemahasiswa',['as'=>'deletemahasiswa']);
});