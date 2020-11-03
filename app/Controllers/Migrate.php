<?php 
namespace App\Controllers;
//require APPPATH.'/Libraries/vendor/pusher/pusher-php-server/src/Pusher.php';

class Migrate extends BaseController 
{ 
   
     public function index()
    {
            $migrate = \Config\Services::migrations();

            try
            {
                    $migrate->latest();
            }
            catch (\Throwable $e)
            {
                    // Do something with the error here...
            }
    }

}
