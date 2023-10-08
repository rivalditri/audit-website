<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Auth::index');
$routes->post('/auth', 'Auth::login');
// $routes->get('/user', 'Pages::user');
// $routes->get('/dashboard', 'Pages::dashboard');
// $routes->get('/aspek', 'Pages::aspek');
// $routes->get('/indikator', 'Pages::indikator');
