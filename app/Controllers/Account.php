<?php namespace App\Controllers;

class Account extends BaseController
{
    function __construct()
	{ 
        $this->AccountModel   = model('AccountModel');   
        $this->GeographyModel = model('GeographyModel');   
        $this->PropertyModel  = model('PropertyModel');     
        $this->MessageModel   = model('MessageModel');      
        $this->CrudModel      = model('CrudModel'); 
        helper('inflector');
        helper('number');       
        helper('property');       
	}

   public function index() 
	{
		$data['title'] = "My Account | PropertyRaja.com";
	    return view('frontend/sell-property',$data);    
	}


	public function profile()
	{
		$data['title'] = "Profile | PropertyRaja.com"; 

        $data['profile']   = $this->AccountModel->getProfileDetail(cUserId('id'));
        $data['countries'] = $this->GeographyModel->countries();
        $data['states']    = $this->GeographyModel->states();
        $data['cities']    = $this->GeographyModel->cities(); 

        if($this->request->getPost('uploadProfilePic'))
        {
        	    $exts = ['jpg','png','webp','jpeg','JPG','PNG','JPEG','WEBP']; 
        	     if($imagefile = $this->request->getFiles()) 
					{  $i = 0;
					   foreach($imagefile['images'] as $img) 
					   {
					      if ($img->isValid() && ! $img->hasMoved())
					      {      
					      	     if(in_array($img->getClientExtension(),$exts))
					      	     {          
					      	     	       if($img->getSizeByUnit('mb') > 4) 
					      	     	       {
                                              $invalid_size =  "Please upload image between 1MB-4MB"; 
					      	     	       }else{
                                                   $newName = $img->getRandomName();
										           if($img->move(WRITEPATH.'../public/user-images', $newName))
										           { 
										           	      $this->AccountModel->removeUserProfilePic(cUserId()); 

										           	      $insert = [
						                                      'profile_pic' => $newName,    
							                                  'updated_at'  => date('Y-m-d h:i:s')							                           
										           	      ];  
										           	   $this->CrudModel->U('_user_details',['user_id' => cUserId()],$insert); 
										           	   
                                                      $image = \Config\Services::image()
											        ->withFile(WRITEPATH.'../public/user-images/'.$newName)  
											        ->fit(200, 200, 'center')
											        ->save(WRITEPATH.'../public/user-images/thumbnails/'.$newName);   

										           	   $i++;  
										             } 
										             
					      	     	      }
                                           
					      	     }else{
                                   $invalid_ext = $img->getClientExtension() . " - Invalid image extension";
					      	     }
					           
					      }
					   }
					}

				   if($i > 0)
				   { 
                      $this->session->setFlashdata('alert',successAlert('Your Profile image uploaded!'));
				   }      	  
		      	   if(@$invalid_ext)
		      	   {
		      	   	  $this->session->setFlashdata('alert',redAlert($invalid_ext));  
		      	   }
		      	   if(@$invalid_size)
		      	   {
		      	   	  $this->session->setFlashdata('alert',redAlert($invalid_size));  
		      	   }
          	      return redirect()->to('/profile');
        }	
        
        if($this->request->getPost('update_profile'))
        {
           if(! $this->validate([
              'firstname'    => 'required|min_length[1]|max_length[20]|alpha',  
              'lastname'     => 'required|min_length[1]|max_length[20]|alpha',
              'display_name' => 'required|min_length[2]|max_length[20]|alpha',
              'username'    => 'min_length[0]|max_length[15]|alpha_numeric',
              'mobile'      => 'min_length[10]|max_length[15]|numeric',
              'email'       => 'min_length[5]|max_length[40]|valid_email', 
              'address1'    => 'min_length[5]|max_length[100]',
              'address2'    => 'min_length[0]|max_length[100]'  
           ])){
                 $this->session->setFlashdata('alert','<div class="alert alert-danger">'.\Config\Services::validation()->listErrors().'</div>');
        
           }else{
             $toUpdate = [ 
	                'display_name' => $this->request->getPost('display_name'),
	                'username'     => $this->request->getPost('username'),
	                'mobile'       => $this->request->getPost('mobile'),
	                'email'        => $this->request->getPost('email') 
             ];
             $toUpdate2 = [
	               'firstname' => $this->request->getPost('firstname'),
	               'lastname'  => $this->request->getPost('lastname'),
	               'address1'  => $this->request->getPost('address1'),  
	               'address2'  => $this->request->getPost('address2'),
	               'country'   => $this->request->getPost('country'),
	               'state'     => $this->request->getPost('state'), 
	               'city'      => $this->request->getPost('city'),   
	               'activity'  => $this->request->getPost('myActivity')   
             ];  
             $this->CrudModel->U('_users',['id' => cUserId()],$toUpdate); 
             $this->CrudModel->U('_user_details',['user_id' => cUserId()],$toUpdate2);
             $this->session->setFlashdata('alert',successAlert('Your profile updated!'));
		     return redirect()->to('/profile'); 
           }
        }
        $data['sponsoredPropertiesAds'] = $this->PropertyModel->getAllSponsoredProperties(1);
	    return view('frontend/profile',$data);    
	}
    

	public function my_properties() 
	{
		$data['title'] = "My Added Properties | PropertyRaja.com";
		$properties = $this->PropertyModel->getPropertiesByUserId(cUserId()); 
	     if($properties != NULL) 
	     {  
           $data['properties'] = $properties; 
	     }else{
	     	$data['properties'] = NULL;
	     }   
	    return view('frontend/my-properties',$data);    
	} 


	public function favourites()  
	{
		$data['title'] = "My Favourites | PropertyRaja.com";
		$propertyId = segment(2);
        $data['isInterested'] = $this->PropertyModel->isInterested(cUserId(),$propertyId);
        $data['isFavourited'] = $this->PropertyModel->isFavourited(cUserId(),$propertyId);
        
            if($this->request->uri->getTotalSegments() >= 3 && segment(3) == "interested")
		    {
		       $this->PropertyModel->interestedProperty([
		        'user_id'     => cUserId(),
		        'property_id' => $propertyId,
		        'created_at'  => date('Y-m-d h:i:s'),
		        'updated_at'  => date('Y-m-d h:i:s'),
		        'status'      => 1
		      ]); 
		       $this->session->setFlashdata('alert','<div class="alert alert-success">Your contact details forwarded!</div>');
		       return redirect()->to('/favourites/');

		    }elseif($this->request->uri->getTotalSegments() >= 3 && segment(3) == "favourite"){  

		       $this->PropertyModel->upsertFavouriteProperty([
		        'user_id'     => cUserId(), 
		        'property_id' => $propertyId,
		        'created_at'  => date('Y-m-d h:i:s'),
		        'updated_at'  => date('Y-m-d h:i:s'),
		        'status'      => 1
		      ]); 
		       if($data['isFavourited'] == true){
		           $this->session->setFlashdata('alert',warningAlert('Property removed from your favourites!'));
		       }else{
		           $this->session->setFlashdata('alert',successAlert('Property added to your favourites!'));
		       }
		       
		       return redirect()->to('/favourites/');
		    }  
         
              $properties = $this->PropertyModel->getPropertiesByUserFavourite(cUserId());
		     if($properties != NULL) 
		     {  
                $data['properties'] = $properties;  
		     }else{
		     	$data['properties'] = NULL;
		     }   
	    return view('frontend/favourites',$data);   
	}  


	public function messages()
	{ 
		$data['title'] = "Messages | PropertyRaja.com"; 
		$data['users'] = $this->MessageModel->getChatUsers(cUserId());
		//print_r($data['users']);exit; 
		$data['pid']   = $this->request->getGet('pid');
		$data['fk_user_id'] = $this->request->getGet('uid'); 

		if($data['pid'] && $data['fk_user_id'])   
		{  
            $data['getPropertyDetail'] = $this->PropertyModel->getPropertyDetail($data['pid']);
            $data['getMessages'] = $this->MessageModel->getMessages($data['pid'],$data['fk_user_id'],cUserId()); 
		}

		if(isset($_GET['pid']) && isset($_GET['uid']))
		{ 
	      $pid  = $_GET['pid'];		
	      $fuid = $_GET['uid']; 		
          $this->MessageModel->markMessagesAsRead(cUserId(),$fuid,$pid);  
		}  
	    return view('frontend/messages',$data);    
	}


	public function notifications()
	{
		$data['title'] = "Notifications | PropertyRaja.com";  
		$data['notifications'] = $this->AccountModel->notifications($userId = cUserId());
	    return view('frontend/notifications',$data);     
	}

	public function test()
	{
		echo allMessagesReceived();
	}


}