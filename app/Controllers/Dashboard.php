<?php namespace App\Controllers;

class Dashboard extends BaseController
{   


	function __construct()
	{
        $this->AccountModel   = model('AccountModel');   
        $this->GeographyModel = model('GeographyModel');   
        $this->PropertyModel  = model('PropertyModel');
        $this->StatisticModel  = model('StatisticModel');
        $this->UserModel       = model('UserModel'); 
        $this->CrudModel       = model('CrudModel'); 
        helper('number');   
        helper('property');   
	}



	public function index()
	{
		$data['title']            = "Agent Dashboard | Welcome to PropertyRaja"; 
		$data['featured']         = $this->PropertyModel->getAllFeaturedProperties();
		$data['cities']           = $this->GeographyModel->cities();  
		$data['property_type']    = $this->PropertyModel->getPropertyType(); 
		$data['totalSalesAmount'] = $this->PropertyModel->totalSalesAmountByUser(cUserId());
		$data['totalActual']      = $this->StatisticModel->totalActualAmountByUser(cUserId()); 
		$data['totalTarget']      = $this->StatisticModel->totalTargetAmountByUser(cUserId()); 
	    return view('frontend/dashboard/dashboard',$data);        
	}
    


    public function projects()
	{
		   $data['title'] = "Developer Projects | Welcome to PropertyRaja";
		   $section = segment(3);
		   if($section == "add")
		   {   
		   	  $data['section'] = 'add';
		   	  if($this->request->getPost('addProject'))
		   	  {
	              $this->CrudModel->C('_project',[ 
	             'user_id' => cUserId(),
	             'project_name' => $this->request->getPost('project_name'), 
	             'created_at'  => date('Y-m-d h:i:s'),
	             'updated_at'  => date('Y-m-d h:i:s'),
	             'status' => $this->request->getPost('status') 
	          ]);
	             $this->session->setFlashdata('alert',successAlert('Project Created!')); 
	             return redirect()->to('/dashboard/projects/add');    
		   	  }      
		   }

		    if($section == "link_property")
		   {   
		   	  $data['section'] = 'link_property';
		   	  if($this->request->getPost('linkProperty'))
		   	  {
	              $this->CrudModel->C('_project_property_map',[  
	                'user_id' => cUserId(),
	                'project_id'  => $this->request->getPost('project_id'), 
	                'property_id' => $this->request->getPost('property_id'), 
	                'created_at'  => date('Y-m-d h:i:s'),
	                'updated_at'  => date('Y-m-d h:i:s'), 
	                'status' => $this->request->getPost('status') 
	             ]);
	             $this->session->setFlashdata('alert',successAlert('Property Linked!')); 
	             return redirect()->to('/dashboard/projects/link_property');    
		   	  }
		   	  $data['projects'] = $this->PropertyModel->getProjects(
	          	$projectId = NULL,
	          	$userId = cUserId(),
	          	$status = NULL);
	          $data['properties'] = $this->PropertyModel->getPropertiesByUserId(cUserId());	        
		   }

		   if($section == "edit")
		   {  
		   	  $data['section'] = 'edit';
		   	  if($this->request->getPost('editProject'))
		   	  {
	              $this->CrudModel->U('_project',['id' => segment(4)],[ 
	             'user_id' => cUserId(),
	             'project_name' => $this->request->getPost('project_name'), 
	             'updated_at'  => date('Y-m-d h:i:s'), 
	             'status' => $this->request->getPost('status') 
	          ]);
	             $this->session->setFlashdata('alert',successAlert('Project Updated!')); 
	             return redirect()->to('/dashboard/projects/edit/'.segment(4));    
		   	  }     
	          $data['projects'] = $this->PropertyModel->getProjects(
	          	$projectId = segment(4),
	          	$userId = cUserId(), 
	          	$status = NULL);     
		   } 

		   if($section == "all" || $section == "" || $section == NULL) 
		   {  
		   	  $data['section'] = 'all';
	          $data['projects'] = $this->PropertyModel->getProjects(
	          	$projectId = NULL,
	          	$userId = cUserId(),
	          	$status = NULL);    
		   }

		   if($section == 'delete')
		   {
                $this->CrudModel->D('_project',[  
	                'id' => segment(4) 
	             ]);
	             $this->session->setFlashdata('alert',redAlert('Property Deleted!')); 
	             return redirect()->to('/dashboard/projects');   
		   } 

	     return view('frontend/dashboard/projects',$data);    
	} 



	public function listings()
	{
	   $data['title'] = ucfirst(\Config\Services::session()->get('role'))." Listings | Welcome to PropertyRaja";
	   $data['listings'] = $this->PropertyModel->getPropertiesByUserId(cUserId());
	   return view('frontend/dashboard/listings',$data);  
	}



	public function properties()
	{  
	   return view('frontend/dashboard/properties',$data);
	}



	public function appointments()  
	{
		$data['title'] = ucfirst(\Config\Services::session()->get('role'))." Appointments | Welcome to PropertyRaja";
		   $section = segment(3);
		    if($section == "edit")
		   {  
		   	  $data['section'] = 'edit';
		   	  if($this->request->getPost('editAppointment'))
		   	  {
	              $this->CrudModel->U('_appointments',['id' => segment(4)],[
	             'visit_date' => $this->request->getPost('visit_date'), 
	             'visit_time' => $this->request->getPost('visit_time'), 
	             'is_approved' => $this->request->getPost('is_approved'), 
	             'updated_at'  => date('Y-m-d h:i:s'),   
	             'status' => $this->request->getPost('status') 
	          ]);
	             $this->session->setFlashdata('alert',successAlert('Appointment Updated!')); 
	             return redirect()->to('/dashboard/appointments/edit/'.segment(4));     
		   	  }     
	          $data['appointmentDetail'] = $this->UserModel->getAppointmentDetail(segment(4));      
		   }  
		  if($section == "all" || $section == "" || $section == NULL) 
		   {  
		   	  $data['section'] = 'all';  
	          $data['appointments'] = $this->UserModel->getAllUserAppointment($userType = 'seller',$userId = cUserId(),$status = NULL);  
		   }
		
	   return view('frontend/dashboard/appointments',$data);
	}    




	public function leads()  
	{
	   $data['title'] = ucfirst(\Config\Services::session()->get('role'))." Leads | Welcome to PropertyRaja"; 
	   $data['getLeads'] = $this->UserModel->getAllLeadsbyUserId($status = NULL,$id = NULL,$userId = cUserId()); 
	   return view('frontend/dashboard/leads',$data);
	}




	public function sales() 
	{  
	   $data['title'] = ucfirst(\Config\Services::session()->get('role'))." Leads | Welcome to PropertyRaja";
	   $data['sales'] = $this->PropertyModel->salesByUser($userId = cUserId()); 
	   return view('frontend/dashboard/sales',$data);    
	}




	public function profit_target()
	{
       return view('frontend/dashboard/profit_target',$data);
	}




	public function contacts()
	{
		return view('frontend/dashboard/contacts',$data);
	}




	public function messages()
	{
		//return view('frontend/dashboard/messages',$data);
		return redirect()->to('/messages');  
	}




	public function reviews()
	{   
		$data['title'] = ucfirst(\Config\Services::session()->get('role'))." Reviews | Welcome to PropertyRaja";
		$data['getAllReviews'] = $this->UserModel->getAllReviews($userType = 'seller',$userId = cUserId(),$status = 1);
		return view('frontend/dashboard/reviews',$data);
	}




	public function credits() 
	{
		return view('frontend/dashboard/credits',$data); 
	}




	public function notifications()
	{
		return redirect()->to('/notifications');
	}

	public function applyFluid() 
	{  
	   if(!$this->session->get('fluid'))
	   {
	   	  $this->session->set('fluid',1);
	   }	
       return redirect()->to('/dashboard/index');  
	}

	public function removeFluid()
	{
	   if($this->session->get('fluid'))
	   {
	   	  $this->session->set('fluid',"");
	   } 
	   return redirect()->to('/dashboard/index'); 		 
	}



}	