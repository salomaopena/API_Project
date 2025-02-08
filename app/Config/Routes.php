<?php

use CodeIgniter\Router\RouteCollection;
use App\Libraries\ApiResponse;

/**
 * @var RouteCollection $routes
 */

$routes->set404Override(function(){
    $response = new ApiResponse();
    return $response->set_response_error(404, 'Endpoint does not exist.');
});
$routes->get('/', function () {
    $response = new ApiResponse();
    return $response->set_response_error(404, 'Access Denied!');
});
$routes->get('/status', 'Api::apiStatus');
$routes->get('/all_products', 'Api::all_products');
$routes->post('/product', 'Api::product');
$routes->get('/all_categories','Api::all_categories');
$routes->post('/all_product_by_category','Api::all_product_by_category');
$routes->post('/all_product_with_stock_between','Api::all_product_with_stock_between');
$routes->post('/add_product','Api::add_product');
$routes->post('/update_product','Api::update_product');
$routes->post('/delete_product','Api::delete_product');
