<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::dash', ['filter' => 'login']);
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
### route data user admin
    $routes->get('datauser', 'Home::datauser',['as'=>'user',]);
    $routes->get('adduser', 'Home::adduser',['as'=>'adduser']);
    $routes->post('simpanuser', 'Home::simpanuser',['as'=>'simpanuser']);
    $routes->post('gantipass', 'Home::ubahpass',['as'=>'gantipass']);

### route data rekan kerjasama
    $routes->get('perusahaan', 'Home::perusahaanindex',['as'=>'perusahaan',]);
    $routes->post('addrelasi', 'Home::addrelasi',['as'=>'addrelasi']);
    $routes->post('editrelasi', 'Home::editrelasi',['as'=>'editrelasi']);
    $routes->post('deleterelasi', 'Home::deleterelasi',['as'=>'deleterelasi']);

### route data hamasiswa
    $routes->get('mahasiswa', 'Home::mahasiswaindex',['as'=>'mahasiswa',]);
    $routes->post('addmahasiswa', 'Home::addmahasiswa',['as'=>'addmahasiswa']);
    $routes->post('editmahasiswa', 'Home::editmahasiswa',['as'=>'editmahasiswa']);
    $routes->post('deletemahasiswa', 'Home::deletemahasiswa',['as'=>'deletemahasiswa']);

 ### route data lowongan
    $routes->get('lowongan', 'Home::lowonganindex',['as'=>'lowongan']);
    $routes->post('addlowongan', 'Home::addlowongan',['as'=>'addlowongan']);
    $routes->post('editlowongan', 'Home::editlowongan',['as'=>'editlowongan']);
    $routes->post('deletelowongan', 'Home::deletelowongan',['as'=>'deletelowongan']);

 ### route data lowongan
    $routes->get('jadwaltes', 'Home::jadwaltesindex',['as'=>'jadwaltes']);
    $routes->post('addjadwal', 'Home::addjadwal',['as'=>'addjadwal']);
    $routes->post('editjadwaltes', 'Home::editjadwaltes',['as'=>'editjadwaltes']);
    $routes->post('deletejadwaltes', 'Home::deletejadwaltes',['as'=>'deletejadwaltes']);

 ### route data lowongan
    $routes->get('informasi', 'Home::informasiindex',['as'=>'informasi']);
    $routes->post('addinfo', 'Home::addinfo',['as'=>'addinfo']);
    // $routes->post('editjadwaltes', 'Home::editjadwaltes',['as'=>'editjadwaltes']);
    $routes->post('deleteinfo', 'Home::deleteinfo',['as'=>'deleteinfo']);

});