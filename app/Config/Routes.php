<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'Home::index');
$routes->get('/logout', 'Home::logout');

$routes->get('/mapa', 'Mapa::index');
$routes->get('/servicios', 'Servicios::index');
$routes->get('/productos', 'Productos::index');
$routes->get('/profesional', 'Profesional::index');
$routes->get('/perfil', 'Perfil::index');

$routes->match(['get', 'post'], '/register', 'Auth::register');
$routes->match(['get', 'post'], '/signup', 'Auth::signup');
$routes->get('/setup-db', 'Setup::index');
