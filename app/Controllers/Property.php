<?php namespace App\Controllers;

class Property extends BaseController
{
   
  function __construct()
	{
        $this->AccountModel   = model('AccountModel');   
        $this->GeographyModel = model('GeographyModel');   
        $this->PropertyModel  = model('PropertyModel'); 
        $this->UserModel      = model('UserModel');  
        helper('inflector'); 
        helper('number');  
        helper('property');  
	} 



  public function index()
	{
		  $data['title'] = "Property Detail | PropertyRaja.com"; 
		  $propertyId = segment(2);
      createPageViewLog($id = $propertyId,$userId = cUserId() ? cUserId() : NULL,$type = 'property');
      $data['propertyDetail'] = $this->PropertyModel->getPropertyDetail($propertyId);
      $data['isInterested']   = $this->PropertyModel->isInterested(cUserId(),$propertyId);
      $data['isFavourited']   = $this->PropertyModel->isFavourited(cUserId(),$propertyId);

      if(segment(3) == "interested")
      {
          $this->PropertyModel->interestedProperty([
            'user_id'     => cUserId(),
            'property_id' => $propertyId,
            'created_at'  => date('Y-m-d h:i:s'),
            'updated_at'  => date('Y-m-d h:i:s'),
            'status'      => 1
          ]); 
          $this->session->setFlashdata('alert','<div class="alert alert-success">Your contact details forwarded!</div>');
           return redirect()->to('/property-detail/'.$propertyId);

      }elseif(segment(3) == "favourite"){  

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
       return redirect()->to('/property-detail/'.$propertyId);
    }
	    return view('frontend/property',$data);            
	}




	public function addProperty() 
	{   
	      helper('property');
    		$data['title'] = "Add Property | PropertyRaja.com";
    		$data['property_type'] = $this->PropertyModel->getPropertyType();
    		$data['profile']   = $this->AccountModel->getProfileDetail(cUserId());
        $data['cities']    = $this->GeographyModel->cities(); 
        $data['amenities'] = $this->PropertyModel->getPropertyAmeneties();
        $data['activity']  = $this->UserModel->userActivity(cUserId()); 
        $data['pt'] = "";  
       
        if($this->request->uri->getTotalSegments() >= 3)
        {
           $data['pt'] = segment(3);
        }  

    		if($this->request->getPost('add_property'))
    		{
                if($this->request->getPost('property_type') == 1)
                {
                     if($this->request->getPost('listing_type_hide') == "sell")
                     {  
                           $array = [ 
                              'user_id'        => cUserId(), 
                              'listing_type'   => "sell",  
                              'property_type'  => $this->request->getPost('property_type'),  
                              'complex_type'   => $this->request->getPost('complex_type'),
                              'bhk_type'       => $this->request->getPost('bhk_type'),      
                              'status_type'    => $this->request->getPost('status_type'), 
                              'condition_type' => $this->request->getPost('condition_type'),     
                              'title'          => $this->request->getPost('title'),  
                              'description'    => $this->request->getPost('description'),  
                              'specification'  => $this->request->getPost('specification'), 
                              'facing'         => $this->request->getPost('facing'),
                              'amenities'      => json_encode($this->request->getPost('amenities'),true),         
                              'city'           => $this->request->getPost('city'),      
                              'locality'       => $this->request->getPost('locality'),
                              'scale'          => $this->request->getPost('builtup_area_dm'),               
                              'builtup_area'   => $this->request->getPost('builtup_area').' '.$this->request->getPost('builtup_area_dm'),      
                              'project_name'   => $this->request->getPost('project_name'),      
                              'floor'          => $this->request->getPost('floor'),        
                              'unit_price'     => $this->request->getPost('unit_price'),      
                              'total_price'    => $this->request->getPost('total_price'),      
                              'project_total_area'    => $this->request->getPost('project_total_area').' '.$this->request->getPost('builtup_area_dm'),       
                              'launch_date'    => $this->request->getPost('launch_date'),      
                              'posession_date' => $this->request->getPost('posession_date'),      
                              'rera_id'        => $this->request->getPost('rera_id'),      
                              'approving_authority' => $this->request->getPost('approving_authority'),       
                              'has_ads'        => $this->request->getPost('ads'),           
                              'created_at'   => date('Y-m-d h:i:s'), 
    			              'updated_at'   => date('Y-m-d h:i:s'), 
    			              'status'       => $this->request->getPost('pub_pri')
                          ];

                     }
                     if($this->request->getPost('listing_type_hide') == "rent")
                     {
                           $array = [
                              'user_id'        => cUserId(), 
                              'listing_type'   => "rent", 
                              'city'           => $this->request->getPost('city'), 
                              'locality'       => $this->request->getPost('locality'), 
                              'property_type'  => $this->request->getPost('property_type'),
                              'bhk_type'       => $this->request->getPost('bhk_type'),  
                              'complex_type'   => $this->request->getPost('complex_type'), 
                              'status_type'    => $this->request->getPost('status_type'),
                              'scale'          => $this->request->getPost('builtup_area_dm'), 
                              'builtup_area'   => $this->request->getPost('builtup_area').' '.$this->request->getPost('builtup_area_dm'), 
                              'rent_per_mon'   => $this->request->getPost('rent_per_mon'),  
                              'title'          => $this->request->getPost('title'),  
                              'description'    => $this->request->getPost('description'),  
                              'specification'  => $this->request->getPost('specification'),
                              'facing'         => $this->request->getPost('facing'),
                              'amenities'      => json_encode($this->request->getPost('amenities'),true),           
                              'project_name'   => $this->request->getPost('project_name'),
                              'floor'          => $this->request->getPost('floor'),
                              'has_ads'        => $this->request->getPost('ads'),      
                              'created_at'   => date('Y-m-d h:i:s'), 
    			              'updated_at'   => date('Y-m-d h:i:s'),
    			              'status'         => $this->request->getPost('pub_pri') 
                          ];       
                     }
                          $propertyId = $this->PropertyModel->addProperty($array);
                          $this->session->setFlashdata('alert','<div class="alert alert-success">Property Uploaded</div>');
                          return redirect()->to('/add-property-images/'.$propertyId);
                }
                if($this->request->getPost('property_type') == 2)
                {
                     if($this->request->getPost('listing_type_hide') == "sell")
                     {
                           
                     }
                     if($this->request->getPost('listing_type_hide') == "rent")
                     {

                     }
                }
                if($this->request->getPost('property_type') == 3)
                {
                     if($this->request->getPost('listing_type_hide') == "sell")
                     {
                           
                     }
                     if($this->request->getPost('listing_type_hide') == "rent")
                     {

                     }
                }
                if($this->request->getPost('property_type') == 4)
                {
                     if($this->request->getPost('listing_type_hide') == "sell")
                     {
                           
                     }
                     if($this->request->getPost('listing_type_hide') == "rent")
                     {

                     }
                }
                if($this->request->getPost('property_type') == 5)
                {
                     if($this->request->getPost('listing_type_hide') == "sell")
                     {
                           
                     }
                     if($this->request->getPost('listing_type_hide') == "rent")
                     {

                     }
                }
                if($this->request->getPost('property_type') == 6)
                {
                     if($this->request->getPost('listing_type_hide') == "sell")
                     {
                           
                     }
                     if($this->request->getPost('listing_type_hide') == "rent")
                     {

                     }
                }
    		}
       $data['sponsoredPropertiesAds'] = $this->PropertyModel->getAllSponsoredProperties(1);    
	     return view('frontend/add-property',$data);      
	}




	public function addPropertyImages()
	{      
		     $data['title'] = "Add Photos | PropertyRaja.com"; 
         $exts = ['jpg','png','JPG','PNG','JPEG'];    

         if($this->request->getPost('add-images'))
          {     
	           if($imagefile = $this->request->getFiles())
						{  $i = 0;
						   foreach($imagefile['images'] as $img)
						   {
						      if ($img->isValid() && ! $img->hasMoved())
						      {      
						      	     if(in_array($img->getClientExtension(),$exts))
						      	     {         
						      	     	       if($img->getSizeByUnit('mb') > 10)
						      	     	       {
                                      $invalid_size =  "Please upload image less than 10MB";
						      	     	       }else{
                                                       $newName = $img->getRandomName();
											           if($img->move(WRITEPATH.'../public/property-images', $newName)){ 
											           	      $insert = [
							                                      'image_name'  => $newName,
							                                      'property_id' => $this->request->uri->getSegment(2),
							                                      'user_id'     => cUserId(),
							                                      'mime_type'   => $img->getClientMimeType(),
							                                      'created_at'  => date('Y-m-d h:i:s'), 
									                                  'updated_at'  => date('Y-m-d h:i:s'),
									                                  'status'      => 1
											           	      ];  
											           	    $this->PropertyModel->addPropertyImages($insert);
											           	   
                                      $image = \Config\Services::image();
                                      $image->withFile(WRITEPATH.'../public/property-images/'.$newName);  
                                      $image->fit(348, 232, 'center'); 
                                      $image->save(WRITEPATH.'../public/property-images/thumbnails/'.$newName);

                                      $image->withFile(WRITEPATH.'../public/property-images/'.$newName);   
                                      $image->fit(1106, 737, 'center'); 
                                      $image->save(WRITEPATH.'../public/property-images/'.$newName); 

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
                $this->session->setFlashdata('alert','<div class="alert alert-success">Your property image uploaded!</div>');
				   }      	  
      	   if(@$invalid_ext)
      	   {
      	   	  $this->session->setFlashdata('alert','<div class="alert alert-danger">'.$invalid_ext.'</div>');
      	   }
      	   if(@$invalid_size)
      	   {
      	   	  $this->session->setFlashdata('alert','<div class="alert alert-danger">'.$invalid_size.'</div>');
      	   }
          	return redirect()->to('/add-property-images/'.segment(2));  
         }
         $data['propertyImages'] = $this->getPropertyImages(segment(2));   
		 return view('frontend/add-property-images',$data); 
	}



	function getPropertyImages($id)
	{   
		if(is_array($array = $this->PropertyModel->getPropertyImages($id)))
		{
        return $array;
		} 
	}




	function watermarkPropertyImages($filename)
	{
       \Config\Services::image('imagick')
        ->withFile(WRITEPATH.'uploads/'.$filename)
        ->text('Copyright 2020 - PropertyRaja.com', [
            'color'      => '#fff',
            'opacity'    => 0.5,
            'withShadow' => true,
            'hAlign'     => 'center',
            'vAlign'     => 'bottom',
            'fontSize'   => 20
        ]) 
        ->save(WRITEPATH.'uploads/watermarked/'.$filename);
        return true;
	} 


	function test() 
  { 
     
		 print_r($this->PropertyModel->getAmenetiesByPropertyId(20));  
	}

}