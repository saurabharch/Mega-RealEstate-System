<?php 
namespace App\Controllers\Backend;

use CodeIgniter\Controller;  

class Dashboard extends BackendController   
{   
	
	function __construct()
	{
      $this->AccountModel   = model('AccountModel');   
      $this->GeographyModel = model('GeographyModel');   
      $this->PropertyModel  = model('PropertyModel');  
      $this->UserModel      = model('UserModel');  
      $this->CrudModel      = model('CrudModel');
      helper('inflector');    
	}   

	function index()
	{ 
		$data['title'] = "Dashboard";   

		$data['totalProperties'] = count($this->PropertyModel->getProperties());
		$data['totalAgents']     = count($this->UserModel->getAllUsersByRole('agent'));
		$data['totalDevelopers'] = count($this->UserModel->getAllUsersByRole('developers'));

		$data['totalAdmin']      = count($this->UserModel->getAllUsersByRole('admin'));
		$data['totalSubAdmin']   = count($this->UserModel->getAllUsersByRole('sub-admin'));
		$data['totalSales']      = count($this->UserModel->getAllUsersByRole('sales'));
		$data['totalAccountant'] = count($this->UserModel->getAllUsersByRole('accountant')); 
		$data['totalStaff'] = $data['totalAdmin'] + $data['totalSubAdmin'] + $data['totalSales'] + $data['totalAccountant'];
		return view('backend/dashboard',$data); 
	}

}	