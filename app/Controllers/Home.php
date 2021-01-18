<?php namespace App\Controllers;

class Home extends BaseController
{   
	function __construct()
	{
        $this->AccountModel   = model('AccountModel');   
        $this->GeographyModel = model('GeographyModel');   
        $this->PropertyModel  = model('PropertyModel');
        $this->UserModel      = model('UserModel'); 
        $this->CrudModel      = model('CrudModel'); 
        helper('geography'); 
        helper('number'); 
        helper('text'); 
        helper('inflector'); 
        helper('property'); 
	}

	public function index() 
	{
		$data['title']         = "Welcome to PropertyRaja"; 
		$data['featured']      = $this->PropertyModel->getAllFeaturedProperties($status = 1); 
		$data['cities']        = $this->GeographyModel->cities();
		$data['property_type'] = $this->PropertyModel->getPropertyType();
	    return view('landing',$data);       
	}

	public function buy()  
	{
       $data['title'] = "Buy Properties";
	   return view('landing',$data); 
	}

	public function sell() 
	{
		$data['title'] = "Sell Properties";
	    return view('frontend/sell',$data);
	}

	public function rent()
	{
		$data['title'] = "Rent Properties";
	    return view('frontend/rent',$data);
	}

	public function browse() 
	{
		  $data['title'] = "Browse Properties";
          
          $data['listing_type']  = $this->request->getGet('listing_type') ? $this->request->getGet('listing_type') : NULL;
          $data['city']          = $this->request->getGet('city') ? $this->request->getGet('city') : NULL;
	      
	        $array = NULL;
          $role  = NULL;  
          
	      if($this->request->getGet('listing_type'))
	      {
	         $array['_properties.listing_type'] = $this->request->getGet('listing_type');   
	      }
	      if($this->request->getGet('property_type'))
	      {
	         $array['_properties.property_type'] = $this->request->getGet('property_type');
	      }
	      if($this->request->getGet('searchByPriceType'))
	      {
	            if($array['_properties.listing_type'] == "rent"){ 
	                $price = explode('-',$this->request->getGet('searchByPriceType'));
	                $array['_properties.rent_per_mon >='] = intval($price[0]);
	                $array['_properties.rent_per_mon <='] = intval($price[1]);   
	            }else{
	                $array['_properties.total_price <='] = $this->request->getGet('searchByPriceType');  
	            }
	      }
	      if($this->request->getGet('city'))
	      {
	         $array['_properties.city'] = $this->request->getGet('city');    
	      }

          if(is_array($array)) 
          {
             $data['result']    = $this->PropertyModel->searchPropertyAjax($array,NULL);
          }else{ 
          	 $data['result']    = $this->PropertyModel->getPropertiesByLocation();  
          	
          } 
		   //print_r($this->PropertyModel->getPropertiesByLocation());exit;  
		  $data['property_type'] = $this->PropertyModel->getPropertyType(); 
	      return view('frontend/browse',$data);   
	}



    
    public function contact()
    {
       $data['title'] = "Contact Us"; 
       if($this->request->getPost('submitContactUs'))
       {
       	   //  if(! $this->validate([
           //    'fname'   => 'required|min_length[3]|max_length[40]|',  
           //    'lname'   => 'required|min_length[3]|max_length[40]',
           //    'email'   => 'required|min_length[6]|max_length[20]|valid_email',
           //    'comment' => 'required|min_length[30]|max_length[300]'  
           // ])){
               
           // }else{ 
           	  $data = [
                  'firstname' => $this->request->getPost('fname'),
		          'lastname'  => $this->request->getPost('lname'),
		          'email'     => $this->request->getPost('email'),
		          'comment'   => $this->request->getPost('comment'),
		          'created'   => date('Y-m-d h:i:s'), 
                  'updated'   => date('Y-m-d h:i:s'),   
                  'status'    => 1  
		      ]; 
		      $this->CrudModel->C('_user_queries',$data);  
		      $this->session->setFlashdata('alert',successAlert('Query Successful Sent'));
		      return redirect()->to('/contact');    
          // }	   
       }
	   return view('frontend/contact',$data);
    }

	public function about()
    {
       $data['title'] = "About Us";
	   return view('frontend/about',$data);
    } 
    
	public function policy()
    {
       $data['title'] = "Our Policy";
	   return view('frontend/policy',$data);
    }
    
	public function support()
    {
       $data['title'] = "Customer Support";
	   return view('frontend/support',$data);
    }

    public function terms()
    {
       $data['title'] = "Terms And Conditions";
	   return view('frontend/terms',$data);
    } 

     public function testimonials()
    {
       $data['title'] = "Testimonials";
	   return view('frontend/testimonials',$data);
    }

    public function report()
    {
       $data['title'] = "Report a problem";
	   return view('frontend/report',$data);
    }

    public function safety()
    {
       $data['title'] = "Safety Guide"; 
	   return view('frontend/safety',$data);
    }

    public function careers()
    {
       $data['title'] = "Careers";
	   return view('frontend/careers',$data);
    }

    public function findAgent() 
    {
       $data['title'] = "Find Agent";
       $data['agents'] = $this->UserModel->getAllUsersByRole('agent');
       if(@$_GET['location'] !="" || @$_GET['name'] !="") 
       {  
          $location = isset($_GET['location']) ? $_GET['location'] : ""; 
          $name = isset($_GET['name']) ? $_GET['name'] : ""; 
          $service = isset($_GET['service']) ? $_GET['service'] : "";  
          $data['sAgents'] = $this->UserModel->userSearchFilter($location,$name,$service,$role = 'agent',$status = 1);
          //print_r($data['sAgents']);     
       }
	     return view('frontend/find-agent',$data); 
    }

    public function publicProfile() 
    {
       $data['title'] = "Agent Profile";
       $username = segment(2);
       $data['sAgents'] = $this->UserModel->userSearchFilter(NULL,$name = $username,NULL,$role = 'agent',$status = 1);
       $userId = $this->UserModel->getUserIdFromUsername($username);
       $data['getAllReviews'] = $this->UserModel->getAllReviews($userType = 'seller',$userId,$status = 1);
       if(segment(3) == 'write-review')
       { 
         if($this->request->getPost('submitReview'))
         {
            $overStar = $this->request->getPost('selectedStar');
            $process_expertise = $this->request->getPost('process_expertise');
            $responsiveness     = $this->request->getPost('responsiveness');
            $negotiation_skills = $this->request->getPost('negotiation_skills');
            $local_knowledge  = $this->request->getPost('local_knowledge');
            $service_provided = $this->request->getPost('service_provided');
            $complete_address = $this->request->getPost('complete_address');
            //$propertyId     = $this->request->getPost('property_id');    
            $property_link    = $this->request->getPost('property_link');
            $complete_address = $this->request->getPost('complete_address');
            $title = $this->request->getPost('title');

            $message = $this->request->getPost('message');   
           
            $this->CrudModel->C('_reviews',[
              //'property_id' => $propertyId,
              'buyer_id'    => cUserId(),
              'seller_id'   => $userId,
              'property_link' => $property_link,
              'title'         => $title,
              'service_provided' => $service_provided,
              'complete_address'   => $complete_address, 
              'local_knowledge'    => $local_knowledge,
              'process_expertise'  => $process_expertise,
              'responsiveness'     => $responsiveness,
              'negotiation_skills' => $negotiation_skills, 
              'comment' => $message,
              'rating'  => $overStar,
              'created_at'  => date('Y-m-d h:i:s'),
              'updated_at'  => date('Y-m-d h:i:s'),
              'status' => 1     
            ]);
            $this->session->setFlashdata('alert',successAlert('Your review submitted and we will approve it soon'));
            return redirect()->to('/public-profile/'.$username.'/write-review/success');    
         } 
         return view('frontend/write-review',$data); 
       }else{
         return view('frontend/public-profile',$data); 
       }
            
    }

    public function test() 
    {   
      $u = $this->UserModel->getUserRatings($userType = 'seller',$userId = 23,$status = 1);  
    	print_r($u);  
    }                  
    
}
