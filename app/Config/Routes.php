<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Login::novo', ['filter'=>'visitante']);

$routes->group('admin', static function ($routes) {
    $routes->get('formas', 'Admin\FormasPagamento::index');
});
