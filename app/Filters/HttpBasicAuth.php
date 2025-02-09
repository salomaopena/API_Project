<?php

namespace App\Filters;

use App\Libraries\ApiResponse;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class HttpBasicAuth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        //check if the request has the authorization header
        if (!$request->hasHeader('Authorization')) {
            $this->_get_error(401, 'Invalid authorization credencials');
        }

        //get the authorization from username and password

        $username = $request->getServer('PHP_AUTH_USER');
        $password = $request->getServer('PHP_AUTH_PW');

        //check if the username and password are valid
        if ($username != API_USERNAME || $password != API_PASSWORD) {
            $this->_get_error(401, 'Invalid authorization credencials');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }

    private function _get_error($code, $message)
    {
        $response = new ApiResponse();
        echo $response->set_response_error($code, $message);
        die(1);
    }
}
