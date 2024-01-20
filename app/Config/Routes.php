<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Auth::index');
$routes->get('/aspek/(:segment)', 'Aspek::index/$1');
$routes->get('/aspek/result/(:segment)', 'Aspek::result/$1');
$routes->get('/admin', 'admin\Home::index');
$routes->get('/users', 'admin\User::index');
$routes->get('/overview', 'admin\Overview::index');
$routes->get('/capaian', 'admin\Capaian::index');
$routes->post('/users/add', 'admin\User::adduser');
$routes->post('/users/edit/(:segment)', 'admin\User::edit/$1');
$routes->post('/users/delete/(:segment)', 'admin\User::delete/$1');
$routes->get('/indikator/(:num)', 'Indikator::index/$1');
$routes->get('/levelIndikator/(:segment)', 'levelIndikator::index/$1');
$routes->get('/levelKriteria/(:segment)', 'levelKriteria::index/$1');
$routes->post('/authGoogle', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->post('/dokumen', 'Dokumen::upload');
$routes->post('/validasi', 'Validation::validasi');
$routes->get('/download/(:segment)', 'Dokumen::download/$1');
