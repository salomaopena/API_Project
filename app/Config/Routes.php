<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    echo 'Acess Denied!';
});
$routes->get('/status', 'Api::apiStatus');
$routes->get('/all_products', 'Api::all_products');
$routes->get('/product/(:num)', 'Api::product/$1');
