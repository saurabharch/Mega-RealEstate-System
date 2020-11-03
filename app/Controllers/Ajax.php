<?php namespace App\Controllers;

class Ajax extends BaseController
{   
	
	function __construct()
	{
        $this->AccountModel   = model('AccountModel');   
        $this->GeographyModel = model('GeographyModel');   
        $this->PropertyModel  = model('PropertyModel');      
        $this->UserModel      = model('UserModel');        
        $this->CrudModel      = model('CrudModel');          
	} 

   function addPropertyPageLoad()
   {
   	    $data['property_type'] = $this->PropertyModel->getPropertyType();
		    $data['profile']       = $this->AccountModel->getProfileDetail(24);
        $data['cities']        = $this->GeographyModel->cities(); 

         $data['property_type_id']     = $this->request->getPost('property_type');  
         $data['listing_type']         = $this->request->getPost('listing_type'); 
         echo view('frontend/ajax/add-property',$data,['saveData' => true]);  
   }

   function searchPropertyCount_Ajax()  
   {    
        
        if($this->request->getPost('listingType') != "any")
        {
           $array['listing_type'] = $this->request->getPost('listingType');
        }
        if($this->request->getPost('propertyType') != "any")
        {
           $array['property_type'] = $this->request->getPost('propertyType');
        }
        if($this->request->getPost('priceType') != "any")
        {
           $array['total_price <='] = $this->request->getPost('priceType');
        }
        if($this->request->getPost('cityType') != "any")
        {
           $array['city'] = $this->request->getPost('cityType');
        }
        $result = $this->PropertyModel->searchProperty($array);
        $queryString = http_build_query($array);
        if(count($result) > 0 )
        {
           echo '<a href="'.base_url().'/browse/?'.$queryString.'" class="btn btn-success btn-block" style="margin-top:10px">'.count($result).' matching properties <img src="'.publicFolder().'/images/smiley.png" /></a>';  
        }else{
           echo '<a href="#" class="btn btn-success btn-block disabled" style="margin-top:10px">No matching properties found <img src="'.publicFolder().'/images/smiley-1.png" /></a>'; 
        }   
   } 
    

    function searchPropertyAjax()
    {     $array = NULL;
          $role  = NULL;
          $array['_properties.listing_type'] = $this->request->getPost('listing_type');
         if($this->request->getPost('property_type') != "any")
         {
           $array['_properties.property_type'] = $this->request->getPost('property_type');
         }
         if($this->request->getPost('facing') != "any")
         {
           $array['_properties.facing'] = $this->request->getPost('facing');
         }
         if($this->request->getPost('bhk_type') != "any") 
         {
           $array['_properties.bhk_type'] = $this->request->getPost('bhk_type'); 
         }
         if($this->request->getPost('availability') != "any")
         {
           $array['_properties.status_type'] = $this->request->getPost('availability'); 
         }

         //$myNewArray = array_combine(array_map(function($key){ return '_properties.'.$key; }, array_keys($array)),$array);

         if($this->request->getPost('houseOwner') != "any")
         {
           $role[] = 'customer'; 
         }
         if($this->request->getPost('realEstateDeveloper') != "any")
         {
           $role[] = 'developer'; 
         }
         if($this->request->getPost('agent') != "any") 
         {
           $role[] = 'agent'; 
         }
         if($this->request->getPost('price') != "any")
         {
            if($array['_properties.listing_type'] == "rent"){ 
                $price = explode('-',$this->request->getPost('price'));
                $array['_properties.rent_per_mon >='] = intval($price[0]);
                $array['_properties.rent_per_mon <='] = intval($price[1]);   
            }else{
                $array['_properties.total_price <='] = $this->request->getPost('price'); 
            }
         }
        $result = $this->PropertyModel->searchPropertyAjax($array,$role);
        
  
        echo '<h5>'.(is_array($result) ? count($result) : '0').' results</h5> 
                  <hr>
                  <div class="row">'; 
                    if(is_array($result))
                    {
                        foreach($result as $row)
                        {
                             echo '<div class="card mb-3" style="width:100%;">
                                        <div class="row no-gutters">
                                          <div class="col-md-4">';
                                            foreach($row['images'] as $key => $image)
                                            {   
                                                if($key == 0)
                                                {
                                                    echo '<img src="'.publicFolder().'/property-images/'.$image['image_name'].'" class="card-img" width="150">';
                                                }
                                            } 
                                    echo '<label class="badge badge-dark" style="position: absolute;margin: 5px -70px;">'.count($row['images']).' Photo</label>';        
                                    echo '</div>
                                          <div class="col-md-8">
                                            <div class="card-body">
                                              <h3 class="card-title">
                                                  <span>'.($row['total_price'] ? number_to_currency($row['total_price'], 'INR').' INR' : number_to_currency($row['rent_per_mon'], 'INR').' per month').'</span>    
                                                   <img src="'.publicFolder().'/images/star-empty.png" width="25" class="float-right favourite" data-star="0"/>
                                              </h3>
                                              <p class="card-text">'.$row['title'].'</p>
                                              <p class="card-text">'.word_limiter($row['description'],25).'..</p>
                                              <p class="card-text"> 
                                                 <h6>New construction <span class="badge badge-success">New</span> | '.($row['builtup_area'] ? $row['builtup_area'].' sft' : "" ).' | '.$row['bhk_type'].' | '.$row['facing'].' | '.$row['status_type'].'</h6>
                                                <a href="" class="btn btn-primary btn-sm float-right">Interested</a>
                                              </p>
                                               <p class="card-text">
                                                Posted By : '.$row['firstname'].' '.$row['lastname'].' ('.$row['role'].')  | Posted At : '.date('D, d M Y', strtotime($row['created_at'])).' | <a href="'.base_url().'/property-detail/'.$row['id'].'" target="__self" class="text-success">Full Detail</a>
                                              </p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>';
                                      
                        }
                    }  
                  
                  
        echo '</div>'; 

    }


    function checkUsernameAvailabilityAjax() 
    {
       $username = $this->request->getPost('username');
       $isUsernameAvailable = $this->UserModel->isUsernameAvailable($username);
       if($isUsernameAvailable == true)
       { 
         echo '<span class="text-success float-right">&nbsp;&nbsp;| '.$username.' is available!</span>';
       }else{
         echo '<span class="text-danger float-right">&nbsp;&nbsp;| '.$username.' already taken!</span>'; 
       }
    }


    function submitReviewFlag()
    {
        $problem = $this->request->getPost('problem');  
        $details = $this->request->getPost('details');  
        $email   = $this->request->getPost('email');
        $reviewId   = $this->request->getPost('reviewId');
        //print_r($_POST); 
        $this->CrudModel->C('_report',[
         'report_type' => 'review_report', 
         'review_id' => $reviewId,   
         'problem' => $problem,
         'details' => $details, 
         'email'   => $email, 
         'created_at'  => date('Y-m-d h:i:s'),
         'updated_at'  => date('Y-m-d h:i:s'),
         'status' => 4 
        ]); 
    } 




}	