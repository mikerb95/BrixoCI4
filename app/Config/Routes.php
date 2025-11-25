<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'Home::index');
$routes->get('/logout', 'Home::logout');


$routes->match(['get', 'post'], '/register', 'Auth::register');

$routes->get('/productos', 'Productos::index');
$routes->get('/mapa', 'Mapa::index');
$routes->get('/profesional/(:num)', 'Profesional::ver/$1');
$routes->get('/servicios', 'Servicios::index');
$routes->get('/servicio/(:num)', 'Servicios::detalle/$1');