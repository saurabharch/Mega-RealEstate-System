<?php 
namespace App\Controllers\Backend;

use CodeIgniter\Controller;  

class Payment extends BackendController   
{   
  
   
  
  function __construct()
  {
      // $this->AccountModel   = model('AccountModel');   
      // $this->UserModel      = model('UserModel');   
      // $this->CrudModel      = model('CrudModel');    
      // $this->PropertyModel  = model('PropertyModel');     
      // $this->GeographyModel = model('GeographyModel');
      // $this->GeographyModel = model('GeographyModel');
       $this->PaymentModel = model('PaymentModel'); 
       helper('property');        
  }   


  function index() 
  {
    $data['title'] = "User";
    return view('backend/user',$data);
  }

  function adsPayments()
  {
    $data['title'] = "Property Ads Payment";
    $data['section'] = "";
    $data['adsPayments'] = $this->PaymentModel->getAllPropertyAdsPayments(NULL);
    //print_r($data['adsPayments']);
    //echo $this->PaymentModel->isAdsRunning(20); 
    return view('backend/property-ads-payment',$data);
  }


 
  

}