<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Libraries\ApiResponse;


class Api extends BaseController
{
    public function apiStatus()
    {
        $response = new ApiResponse();
        return $response->set_response(200, 'API is running');
        //return $this->respond('API is running...',200);
    }

    public function all_products()
    {
        //initialize response object
        $response = new ApiResponse();

        //get five products from database
        $product_model = new ProductModel();
        $data = $product_model->findAll();

        //check if there are no products
        if (empty($data)) {
            return $response->set_response_error(403, 'No data found.');
        } else {
            //return the products as json response
            return $response->set_response(200, 'success', $data);
            //return $this->response->setJSON($data);
        }
    }

    public function product($id)
    {
        //initialize response object
        $response = new ApiResponse();

        //get five products from database
        $product_model = new ProductModel();
        $data = $product_model->find($id);

        if (!empty($data)) {
            //return the product as json response
            return $response->set_response(200, 'success', $data);
        } else {
            return $response->set_response_error(404, 'Product not found.');
        }
    }
}
