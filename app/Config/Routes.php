<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::index');
$routes->get('/dashboard', 'Pages::dashboard');
$routes->get('/user', 'Pages::user');