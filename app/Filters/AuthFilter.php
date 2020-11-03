<?php namespace App\Filters;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface 
{
        /**
         * This is a demo implementation of using the Throttler class
         * to implement rate limiting for your application.
         *
         * @param RequestInterface|\CodeIgniter\HTTP\IncomingRequest $request
         * @param array|null                                         $arguments
         *
         * @return mixed
         */
        public function before(RequestInterface $request, $arguments = null)
        {
            $AuthModel = model('AuthModel');

            if ($AuthModel->isLoggedIn() == FALSE) 
            {
                return redirect()->to('login');        
            }
        }    

        //--------------------------------------------------------------------

        /**
         * We don't have anything to do here.
         *
         * @param RequestInterface|\CodeIgniter\HTTP\IncomingRequest $request
         * @param ResponseInterface|\CodeIgniter\HTTP\Response       $response
         * @param array|null                                         $arguments
         *
         * @return mixed
         */
        public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
        {
            
        }
}