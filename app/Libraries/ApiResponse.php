<?php

namespace App\Libraries;

class ApiResponse
{
    public function __construct()
    {
        //check if the API is active

        if (!API_ACTIVE) {
            //exit('API is not active');
            echo $this->_api_not_active();
            die(1);
        }
    }

    public function set_response($status = 200, $message = 'success', $data = [])
    {
        //api generic success
        header('Content-Type: application/json');
        http_response_code($status);
        return json_encode([
            'status'    => $status,
            'message'   => $message,
            'info'      => [
                'version'       => API_VERSION,
                'name'          => API_NAME,
                'documentation' => 'https://api.example.com/docs',
                'contact'       => 'contact@example.com',
                'license'       => 'MIT',
                'author'        => API_AUTHOR,
                'datetime'      => date('Y-m-d H:i:s'),
                'timestamp'     => time(),
            ],
            'data'      => $data
        ]);
    }

    public function set_response_error($status = 404, $message = 'error')
    {
        //api generic error
        header('Content-Type: application/json');
        http_response_code($status);
        return json_encode([
            'status'    => $status,
            'message'   => $message,
            'info'      => [
                'version'       => API_VERSION,
                'name'          => API_NAME,
                'documentation' => 'https://api.example.com/docs',
                'contact'       => 'contact@example.com',
                'license'       => 'MIT',
                'author'        => API_AUTHOR,
                'datetime'      => date('Y-m-d H:i:s'),
                'timestamp'     => time(),
            ],
            'data'              => [],
        ]);
    }

    private function _api_not_active()
    {
        return json_encode([
            'status'    => 403,
            'message'   => 'API is not active...',
            'info'      => [
                'version'       => API_VERSION,
                'name'          => API_NAME,
                'documentation' => 'https://api.example.com/docs',
                'contact'       => 'contact@example.com',
                'license'       => 'MIT',
                'author'        => API_AUTHOR,
                'datetime'      => date('Y-m-d H:i:s'),
                'timestamp'     => time(),
            ],
            'data'              => [],
        ]);
    }
}
