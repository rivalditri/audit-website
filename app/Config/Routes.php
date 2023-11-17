<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Auth::index');
$routes->get('/aspek/(:segment)', 'aspek::index/$1');
$routes->get('/admin', 'admin\home::index');
$routes->get('/users', 'admin\User::index');
$routes->post('/editUser/(:segment)', 'admin\User::edit/$1');
$routes->get('/deleteUser/(:segment)', 'admin\User::delete/$1');
$routes->get('/indikator/(:num)', 'indikator::index/$1');
$routes->get('/levelIndikator/(:segment)', 'levelIndikator::index/$1');
$routes->get('/levelKriteria/(:segment)', 'levelKriteria::index/$1');
// $routes->post('/auth', 'Auth::login');
$routes->post('/authGoogle', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->post('/dokumen', 'Dokumen::upload');
$routes->post('/validasi', 'Validation::validasi');
$routes->get('/download/(:segment)', 'Dokumen::download/$1');
// $routes->get('/user', 'Pages::user');
// $routes->get('/dashboard', 'Pages::dashboard');
// $routes->get('/aspek', 'Pages::aspek');
// $routes->get('/indikator', 'Pages::indikator');
