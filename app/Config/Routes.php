<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'Home::index');
$routes->get('/logout', 'Home::logout');

$routes->get('/mapa', 'Mapa::index');
