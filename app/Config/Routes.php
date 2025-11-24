<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'Home::index');
$routes->get('/logout', 'Home::logout');


$routes->match(['get', 'post'], '/register', 'Auth::register');