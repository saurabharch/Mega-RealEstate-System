<?php namespace App\Controllers;

class SellProperty extends BaseController
{

   public function index()
	{
		$data['title'] = "List your property for sale";
	    return view('frontend/sell-property',$data);    
	}

}