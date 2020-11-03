<?php 
namespace App\Controllers\Backend;

use CodeIgniter\Controller;  

class BackendController extends Controller   
{     

	protected $helpers = ['form','url','common','text','cookie'];   

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		$this->session    = \Config\Services::session(); 
		$this->validation = \Config\Services::validation();   
		$this->isTrustedUser();  
	}

	public function isTrustedUser() 
	{   
		$role = $this->session->get('role');
		if($role){   
            if(in_array($role,['admin','subadmin','contentwriter','sales'])){
	          return true;
			}else{
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			}
		}else{
           if($this->request->uri->getSegment(1) != "login-staff") 
           {
              throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
           }
		}
	}        


}   	