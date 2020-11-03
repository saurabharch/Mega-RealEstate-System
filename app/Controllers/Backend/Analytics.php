<?php 
namespace App\Controllers\Backend;

use CodeIgniter\Controller;  

class Analytics extends BackendController   
{   
	
    function __construct()
	{
      $this->AccountModel   = model('AccountModel');   
      $this->GeographyModel = model('GeographyModel');   
      $this->PropertyModel  = model('PropertyModel');  
      $this->CrudModel      = model('CrudModel');
      $this->SettingModel   = model('SettingModel');    
      helper('inflector');  
	}   

	function seo_analytics()
	{
		$data['title'] = "SEO Analytics";
    if($this->request->getPost('addScript'))
    {
           $array = array(
             'setting_name'    => $this->request->getPost('script_name'),
             'setting_content' => $this->request->getPost('script_code'),
             'setting_type'    => 'seo_script', 
             'created_at' => date('Y-m-d h:i:s'),  
             'updated_at' => date('Y-m-d h:i:s'),
             'status' => $this->request->getPost('status')
           );
            $this->CrudModel->C('_settings',$array);  
            $this->session->setFlashdata('alert',successAlert('New SEO Script Added'));
            return redirect()->to('/backend/analytics/seo_analytics/addScript');  
    }
    if($this->request->getPost('addMetaTag'))
    {
           $array = array(
             'setting_name'    => $this->request->getPost('metatag_name'),
             'setting_content' => $this->request->getPost('metatag_content'),
             'setting_type'    => 'seo_metatag', 
             'created_at' => date('Y-m-d h:i:s'),  
             'updated_at' => date('Y-m-d h:i:s'),   
             'status' => $this->request->getPost('status') 
           );
            $this->CrudModel->C('_settings',$array);  
            $this->session->setFlashdata('alert',successAlert('New SEO MetaTag Added'));
            return redirect()->to('/backend/analytics/seo_analytics/addMetaTags');    
    }
   if(segment(4) == "delete")
    {
       $this->CrudModel->D('_settings',['id' => segment(5)]); 
       $this->session->setFlashdata('alert',redAlert('Deleted this SEO option!'));
       return redirect()->to('/backend/analytics/seo_analytics');     
    }
    $data['getSeoSettings']  = $this->SettingModel->getSeoSettings(['seo_script','seo_metatag']);    
		return view('backend/seo-analytics',$data);
	} 




	function country_city_state()  
	{
		$data['title'] = "Country State City";
		if($this->request->getPost('addCountry'))
		{
           $array = array(
             'country_name' => $this->request->getPost('country_name'),
             'symbol'     => $this->request->getPost('symbol'),
             'code'       => $this->request->getPost('code'),
             'created_at' => date('Y-m-d h:i:s'),
             'updated_at' => date('Y-m-d h:i:s'),
             'status' => $this->request->getPost('status')
           );
            $this->CrudModel->C('_countries',$array);
            $this->session->setFlashdata('alert',successAlert('New Country Added'));
            return redirect()->to('/backend/analytics/country_city_state/countries');  
		}
		if($this->request->getPost('addCity'))
		{
           $array = array(
             'city_name'  => $this->request->getPost('city_name'),
             'country_id' => $this->request->getPost('country_id'),
             'state_id'   => $this->request->getPost('state_id'),
             'created_at' => date('Y-m-d h:i:s'), 
             'updated_at' => date('Y-m-d h:i:s'),   
             'status'     => $this->request->getPost('status')  
           );
            $this->CrudModel->C('_cities',$array);
            $this->session->setFlashdata('alert',successAlert('New City Added'));
            return redirect()->to('/backend/analytics/country_city_state'); 
		}
		if($this->request->getPost('addState'))
		{
           $array = array(
             'state_name' => $this->request->getPost('state_name'),
             'country_id' => $this->request->getPost('country_id'),
             'created_at' => date('Y-m-d h:i:s'),
             'updated_at' => date('Y-m-d h:i:s'),  
             'status'     => $this->request->getPost('status')   
           );
            $this->CrudModel->C('_states',$array); 
            $this->session->setFlashdata('alert',successAlert('New State Added'));
            return redirect()->to('/backend/analytics/country_city_state'); 
		}
    if(in_array(segment(4),['countries','states','cities']) && segment(5) == "delete")
    {
       $this->CrudModel->D('_'.segment(4),['id' => segment(6)]); 
       $this->session->setFlashdata('alert',redAlert('Deleted this '.segment(4).'!'));
       return redirect()->to('/backend/analytics/country_city_state/'.segment(4));    
    }
		$data['section'] = segment(4);
		$data['countries'] = $this->GeographyModel->countries();
		$data['states'] = $this->GeographyModel->states();
		$data['cities'] = $this->GeographyModel->cities();
		return view('backend/country-city-states',$data);
	}




	function statistics() 
	{
		$data['title'] = "Statistics";
		return view('backend/statistics',$data); 
	}

}