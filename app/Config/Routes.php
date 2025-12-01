<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/mapa', 'Mapa::index');
$routes->get('/panel', 'Panel::index');
$routes->get('/perfil', 'Panel::index');

$routes->get('reportes/contratistas', 'Reportes::contratistas');

// Páginas estáticas del footer
$routes->get('sobre-nosotros', 'Info::sobreNosotros');
$routes->get('como-funciona', 'Info::comoFunciona');
$routes->get('seguridad', 'Info::seguridad');
$routes->get('ayuda', 'Info::ayuda');
$routes->get('unete-pro', 'Info::unetePro');
$routes->get('historias-exito', 'Info::historiasExito');
$routes->get('recursos', 'Info::recursos');
$routes->get('carreras', 'Info::carreras');
$routes->get('prensa', 'Info::prensa');
$routes->get('blog', 'Info::blog');

