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
        $response->validade_request('GET');
        return $response->set_response(200, 'API is running');
        //return $this->respond('API is running...',200);
    }

    public function all_products()
    {
        //initialize response object
        $response = new ApiResponse();
        $response->validade_request('GET');

        //get five products from database
        $product_model = new ProductModel();
        $data = $product_model->findAll(100);

        //check if there are no products
        if (empty($data)) {
            return $response->set_response_error(403, 'No data found.');
        } else {
            //return the products as json response
            return $response->set_response(200, 'success', $data);
            //return $this->response->setJSON($data);
        }
    }

    public function product()
    {
        //initialize response object
        $response = new ApiResponse();

        //validate request method
        $response->validade_request('POST');

        //get five products from database
        $product_model = new ProductModel();

        $post = json_decode(file_get_contents('php://input'), true);

        $data = $product_model->find($post['id']);

        if (!empty($data)) {
            //return the product as json response
            return $response->set_response(200, 'success', $data);
        } else {
            return $response->set_response_error(404, 'Product not found.');
        }
    }

    public function all_categories()
    {
        //initialize response object
        $response = new ApiResponse();
        $response->validade_request('GET');

        //get categories from database
        $product_by_category_model = new ProductModel();
        $data = $product_by_category_model->select('category')
            ->distinct()
            ->findAll();

        //check if there are no categories
        if (empty($data)) {
            return $response->set_response_error(403, 'No catgories found.');
        } else {
            //return the categories as json response
            return $response->set_response(200, 'success', $data);
        }
    }

    public function all_product_by_category()
    {
        //initialize response object
        $response = new ApiResponse();
        $response->validade_request('POST');

        //get products from database
        $model = new ProductModel();

        $post = json_decode(file_get_contents('php://input'), true);

        $data = $model->where('category', $post['category'])
            ->findAll(100);

        //check if there are no products in this category
        if (empty($data)) {
            return $response->set_response_error(403, 'No products found in this category.');
        } else {
            //return the products as json response
            return $response->set_response(200, 'success', $data);
        }
    }

    public function all_product_with_stock_between()
    {
        //initialize response object
        $response = new ApiResponse();
        $response->validade_request('POST');

        //get products from database
        $model = new ProductModel();
        $post = json_decode(file_get_contents('php://input'), true);

        $data = $model->where('stock >=', $post['min'])
            ->where('stock <=', $post['max'])
            ->findAll();

        //check if there are no products with stock between min_stock and max_stock
        if (empty($data)) {
            return $response->set_response_error(403, 'No products found with stock between ' . $post['min'] . ' and ' . $post['max'] . '.');
        } else {
            //return the products as json response
            return $response->set_response(200, 'success', $data);
        }
    }

    public function add_product()
    {
        //initialize response object
        $response = new ApiResponse();
        $response->validade_request('POST');

        //get products from database
        $model = new ProductModel();

        $post = json_decode(file_get_contents('php://input'), true);

        $new_product = [
            'product_name'      => $post['product_name'],
            'category'          => $post['category'],
            'price_per_unit'    => $post['price_per_unit'],
            'stock'             => $post['stock'],
            'created_at'        => date('Y-m-d H:i:s'),
        ];

        $data = $model->insert($new_product);

        if ($data) {
            //return the products as json response
            return $response->set_response(200, 'Product added successfully.');
        } else {
            return $response->set_response_error(403, 'Failed to add product.');
        }
    }
}
