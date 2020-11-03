<?php

if(!function_exists('segment'))
{ 
    
	    function segment($param) 
	    {
	      $request = \Config\Services::request();
		  return $request->uri->getSegment($param);
	    }  
}  


if(!function_exists('getGet'))
{  
    
	    function getGet($param) 
	    {
	      $request = \Config\Services::request();
		  return $request->getGet($param);
	    }  

}

if(!function_exists('isLoggedIn'))
{
	
	function isLoggedIn()   
	{
            $role = session('role');
            $arr  = explode('/',current_url());
            if($role)     
            {  
                if(in_array($role,['agent','customer','developer']))
                {  
                   if(in_array('login',$arr) || in_array('login-agent',$arr) || in_array('login-developer',$arr))  
                   {
                      return redirect()->to('/');       
                   }
                }  
                if(in_array($role,['admin','sub_admin','content_writer','marketing_manager']))
                {  
                   if(in_array('login-staff',$arr))    
                   {
                      return redirect()->to('/backend/dashboard/index');   
                   }
                }
            }
	}

}

if(!function_exists('cUserId'))
{  

	    function cUserId() 
	    {
	    	return \Config\Services::session()->get('userId');
	    }

   }

if(!function_exists('count_digit'))
{   

	    function count_digit($number)
	    {
	       return strlen($number);
	    }
	}
	


if(!function_exists('divider'))
{

	    function divider($number_of_digits)
	    {
		       $tens="1";

			  if($number_of_digits>8)
			    return 10000000;

			  while(($number_of_digits-1)>0)
			  {
			    $tens.="0";
			    $number_of_digits--;
			  }
			  return $tens;
		}
    }



if(!function_exists('displayPrice'))
{

	function displayPrice($num)
	{
		//$num = "789";
		$ext="";//thousand,lac, crore
		$number_of_digits = count_digit($num); //this is call :)
		    if($number_of_digits>3)
		{
		    if($number_of_digits%2!=0)
		        $divider=divider($number_of_digits-1);
		    else
		        $divider=divider($number_of_digits);
		}
		else
		    $divider=1;

		$fraction=$num/$divider;
		$fraction=number_format($fraction,2);
		if($number_of_digits==4 ||$number_of_digits==5)
		    $ext="k";
		if($number_of_digits==6 ||$number_of_digits==7)
		    $ext="Lac";
		if($number_of_digits==8 ||$number_of_digits==9)
		    $ext="Cr";
		return $fraction." ".$ext;
	}
  }


if(!function_exists('convertCurrency'))
{

	function convertCurrency($number)
	{
	    // Convert Price to Crores or Lakhs or Thousands
	    $length = strlen($number);
	    $currency = '';

	    if($length == 4 || $length == 5)
	    {
	        // Thousand
	        $number = $number / 1000;
	        $number = round($number,2);
	        $ext = "Thousand";
	        $currency = $number." ".$ext;
	    }
	    elseif($length == 6 || $length == 7)
	    {
	        // Lakhs
	        $number = $number / 100000;
	        $number = round($number,2);
	        $ext = "Lac";
	        $currency = $number." ".$ext;

	    }
	    elseif($length == 8 || $length == 9)
	    {
	        // Crores
	        $number = $number / 10000000;
	        $number = round($number,2);
	        $ext = "Cr";
	        $currency = $number.' '.$ext;
	    }

	    return $currency;
	}
  }


if(!function_exists('isTabActive'))
{

	function isTabActive($tabname,$segment) 
	{
       return ($tabname == segment($segment)) ? "active" : "";
	}

  }


 if(!function_exists('time_stamp'))
 {

 	    function time_stamp($session_time)
		{
			$time_difference = time() - $session_time ;

			$seconds = $time_difference ;
			$minutes = round($time_difference / 60 );
			$hours = round($time_difference / 3600 );
			$days = round($time_difference / 86400 );
			$weeks = round($time_difference / 604800 );
			$months = round($time_difference / 2419200 );
			$years = round($time_difference / 29030400 );
				// Seconds
				if($seconds <= 60)
				{
				return "$seconds seconds ago";
				}
				//Minutes
				else if($minutes <=60)
				{

				   if($minutes==1)
				  {
				   return "one minute ago";
				   }
				   else
				   {
				    return "$minutes minutes ago";
				   }

				}
				//Hours
				else if($hours <=24)
				{

				   if($hours==1)
				  {
				   return "one hour ago";
				  }
				  else
				  {
				   return "$hours hours ago";
				  }

				}
				//Days
				else if($days <= 7)
				{

				  if($days==1)
				  {
				   return "one day ago";
				  }
				  else
				  {
				   return "$days days ago";
				   }

				}
				//Weeks
				else if($weeks <= 4)
				{

				   if($weeks==1)
				  {
				   return "one week ago";
				   }
				  else
				  {
				   return "$weeks weeks ago";
				  }

				}
				//Months
				else if($months <=12)
				{

				   if($months==1)
				  {
				   return "one month ago";
				   }
				  else
				  {
				   return "$months months ago";
				   }

				}
				//Years
				else
				{

				   if($years==1)
				   {
				    return "one year ago";
				   }
				   else
				  {
				    return "$years years ago";
				   }

				}

		}

    }   



 if(!function_exists('warningAlert')) 
 {
      function warningAlert($text)
      {
      	return '<div class="alert alert-warning alert-dismissible fade show">
      	    '.$text.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      	          <span aria-hidden="true">&times;</span>
                 </button>
               </div>';
      }
 }

 if(!function_exists('redAlert')) 
 {
      function redAlert($text) 
      {
      	return '<div class="alert alert-danger alert-dismissible fade show">
      	    '.$text.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      	          <span aria-hidden="true">&times;</span>
                 </button>
               </div>';
      }
 }


  if(!function_exists('successAlert'))
  {
      function successAlert($text)
      {
      	return '<div class="alert alert-success alert-dismissible fade show">
      	    '.$text.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      	          <span aria-hidden="true">&times;</span>
                 </button>
               </div>';
      }
 }


 if(!function_exists('isTabActive'))
 { 

      function isTabActive($name,$name2)
      {
      	 if((segment(2) == '$name') && (segment(3) == '$name2'))
      	 {
           return "active";
         }
      }
 }

if(!function_exists('modalPopup'))
{
  function modalPopup($title,$body) 
  {
     return '<div class="modal showModalPopup" tabindex="-1" role="dialog">
			  <div class="modal-dialog modal-dialog-centered">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title">'.$title.'</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			         <h4>'.$body.'</h4>
			      </div>
			      <div class="modal-footer">
			        <center>
			           <a href="#" class="btn btn-dark confirmedUrl">Yes</a>  
			           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			        </center>
			      </div>
			    </div>
			  </div>
			</div>';
  }
}

if(!function_exists('statusLabel'))
{
    function statusLabel($status)
    {
       return model('AccountModel')->getStatusFromStatusId($status); 
    }
}

if(!function_exists('statusList'))
{
    function statusList()
    {
       return model('AccountModel')->allStatus(); 
    }
}

if(!function_exists('roleList')) 
{
    function roleList($type,$status)
    {
       return model('UserModel')->roleList($type,$status);  
    }
}

if(!function_exists('removeSpace'))
{ 
	function removeSpace($json)  
	{
      return str_replace(" ","",trim($json));
	}
}

if(!function_exists('userDetail'))
{
	function userDetail($userId){
       $userModel = model('userModel');  
       return $userModel->getUserDetail($userId); 
	}
}

if(!function_exists('getSettings'))
{
	function getSettings($name) 
	{
       $CrudModel = model('CrudModel');   
       return $CrudModel->R('_settings',['setting_name' => $name]);
	}
}


if(!function_exists('allMessagesReceived'))
{
	function allMessagesReceived(){ 
		$MessageModel = model('MessageModel');
		return $MessageModel->allMessagesReceived(cUserId(),0);
	}
}

if(!function_exists('allNotificationsReceived'))
{
	function allNotificationsReceived(){ 
		$AccountModel = model('AccountModel');
		return $AccountModel->allNotificationsReceived(cUserId(),0);
	}
}

if(!function_exists('tabNotificationCount'))
{
   function tabNotificationCount()    
   {
   	 if(session('userId'))
   	 {  
   	 	$PropertyModel  = model('PropertyModel');
   	 	$UserModel      = model('UserModel');
   	 	$StatisticModel = model('StatisticModel');
   	 	$MessageModel   = model('MessageModel');  

        $listings     = $PropertyModel->getPropertiesByUserId(cUserId());
        $properties   = $PropertyModel->getProperties();
        $appointments = $UserModel->getAllUserAppointment('seller',cUserId(),NULL);
        $leads        = $MessageModel->getChatUsers(cUserId());    
        $sales        = $PropertyModel->totalPropertiesSoldByUser(cUserId());
        $profit       = $StatisticModel->profitByEachPropertyByUser(cUserId());
        $contacts     = $MessageModel->getAllUserContacts(cUserId());
        $messages     = $MessageModel->allMessagesReceived(cUserId(),$status = NULL);  
        $reviews      = $UserModel->getAllReviews('seller',cUserId(),$status = NULL);
        $projects     = $PropertyModel->getProjects($projectId = NULL,$userId = cUserId(),$status = NULL);
        
        return [
         'listings' => count($listings),
         'properties' => count($properties),
         'appointments' => count($appointments),
         'leads' => count($leads), 
         'sales' => count($sales),
         'profit' => count($profit),
         'contacts' => count($contacts),
         'messages' => $messages,
         'reviews' => count($reviews),
         'projects' => count($projects) 
        ];
   	 }  
   }
}


if(!function_exists('adminSCounter'))
{   
   function adminSCounter()    
   {
   	 if(session('userId'))
   	 {  
   	 	$PropertyModel  = model('PropertyModel');
   	 	$UserModel      = model('UserModel');
   	 	$StatisticModel = model('StatisticModel');
   	 	$MessageModel   = model('MessageModel');  

        $properties = $PropertyModel->getProperties();
        $propertyTypes = $PropertyModel->getPropertyType();
        $propertyAmenities = $PropertyModel->getPropertyAmeneties();
        $leads = $UserModel->getLeads();
        $agents = $UserModel->getAllUsersByRole('agent');
        $developers = $UserModel->getAllUsersByRole('developer');
        $customers = $UserModel->getAllUsersByRole('customer');
        $staffs = $UserModel->getAllUsersByRoleType('staff');
        
        return [
         'properties'    => count($properties),
         'propertyTypes' => count($propertyTypes),
         'propertyAmenities' => count($propertyAmenities),
         'leads' => count($leads), 
         'agents' => count($agents), 
         'developers' => count($developers), 
         'customers'  => count($customers), 
         'staffs'     => count($staffs)  
        ];
   	 }  
   }
}


if(!function_exists('publicFolder'))
{    
   function publicFolder()  
   {
   	  if($_SERVER['HTTP_HOST'] != "localhost:8080") 
   	  {
         return base_url().'/public';    
   	  }else{
   	  	return base_url(); 
   	  }  
   }
}


if(!function_exists('publicLiveFolder'))
{    
   function publicLiveFolder()  
   {
   	  if($_SERVER['HTTP_HOST'] != "localhost:8080") 
   	  {
         return $_SERVER['DOCUMENT_ROOT'].'/public';    
   	  }else{
   	  	 return $_SERVER['DOCUMENT_ROOT']; 
   	  }  
   }
}


if(!function_exists('allowedImageExt'))
{
	function allowedImageExt() 
	{
		return json_encode(['jpg','png','webp','jpeg','JPG','PNG','WEBP','JPEG']);  
	}
}


if(!function_exists('nowCurrency'))
{
   function nowCurrency() 
   {
   	 return 'INR';
   }
}

if(!function_exists('getUserStarRatings'))
{
	function getUserRatings($userType,$userId,$status)
	{
		$UserModel = model('UserModel');
		$getUserRatings = $UserModel->getUserRatings($userType,$userId,$status);
		$intval   = intval($getUserRatings); 
		$fraction = $getUserRatings - $intval;
		$rem = 5 - $intval;
		if($getUserRatings > 0)
		{
           for($i = 0;$i < $intval;$i++)
           {
              echo '<img src="'.publicFolder().'/images/star.png" width="20" >';
           }
           if($fraction != 0)
           {
              echo '<img src="'.publicFolder().'/images/half-star.png" width="20" >';
              $rem = $rem - 1 ;
           }
           for($j = 0;$j < $rem;$j++)
           {
              echo '<img src="'.publicFolder().'/images/star-empty.png" width="20" >';
           }
		}else{
		   for($i = 0;$i < 5;$i++)
           {
               echo '<img src="'.publicFolder().'/images/star-empty.png" width="20" >';
           } 
		}
	}
}


if(!function_exists('ratingCalculator'))
{ 
	function ratingCalculator($getUserRatings){
		$intval = intval($getUserRatings);
		$fraction = $getUserRatings - $intval;
		$rem = 5 - $intval;
		if($getUserRatings > 0)
		{
           for($i = 0;$i < $intval;$i++)
           {
              echo '<img src="'.publicFolder().'/images/star.png" width="20" >';
           }
           if($fraction != 0)
           {
              echo '<img src="'.publicFolder().'/images/half-star.png" width="20" >';
              $rem = $rem - 1 ;
           }
           for($j = 0;$j < $rem;$j++)
           {
              echo '<img src="'.publicFolder().'/images/star-empty.png" width="20" >';
           }
		}else{
		   for($i = 0;$i < 5;$i++)
           {
               echo '<img src="'.publicFolder().'/images/star-empty.png" width="20" >';
           } 
		}
	}
}

if(!function_exists('getUserRatingsNumber'))
{ 
	function getUserRatingsNumber($userType,$userId,$status)
	{
		$UserModel = model('UserModel');
		$getUserRatings = $UserModel->getUserRatings($userType,$userId,$status);
		return round($getUserRatings,1); 
	}
} 

if(!function_exists('isImageExists'))
{
	function isImageExists($imageName = NULL,$type = NULL)    
	{  
		if($imageName && $type)
		{
            if($type == 'propertyThumbnails') 
			{
	          $filePath = publicLiveFolder().'/property-images/thumbnails/'.$imageName;
			}
			if($type == 'propertyImages') 
			{
	          $filePath = publicLiveFolder().'/property-images/'.$imageName;
			}
			if($type == 'profileThumbnails')
			{
	          $filePath = publicLiveFolder().'/user-images/thumbnails/'.$imageName;
			}   
		    $file_exists = file_exists($filePath);
			if($file_exists)    
			{
			    $status = true;
			}else{
			    $status = false;
			}     
		    return $status;
		}		
	}  
}

if(!function_exists('roleAccess')) 
{ 
	function roleAccess($role = NULL)
	{
       $UserModel = model('UserModel');
       $UserRolePermissions = $UserModel->userRolePermissions($id = NULL, $role, $status = 1); 
       foreach($UserRolePermissions as $perm)
       {
          $access = json_decode($perm['access'],true);
       }
       return $access; 
	}
}

if(!function_exists('createPageViewLog')) 
{ 
  function createPageViewLog($id = NULL,$userId = NULL,$type = NULL)  
  {    
     if($type == "property" && $id != NULL)
     {   
         helper('geography');
          $userId    = $userId ? $userId : NULL;
          $CrudModel = model('CrudModel');
          $CrudModel->C('_property_view_logs',[
             'property_id' => $id,  
             'user_id'     => $userId,  
             'ip'          => $_SERVER['REMOTE_ADDR'],
             'location'    => json_encode(currentLocation(),true),
             'created_at'  => date('Y-m-d h:i:s'),
	         'updated_at'  => date('Y-m-d h:i:s'),
	         'status'      => 1  
         ]);
     }
  }
}


// if(!function_exists('setJsFooter'))
// {
// 	function setJsFooter($jsLinks)
// 	{  
// 	   $jsSession = array();
//        $session = \Config\Services::session();
  
//        $jsSession[] = $jsLinks;  
    
//        $jsSession = array_unique($jsSession); 
//        $session->set('jsSession',$jsSession); 
// 	} 
// } 

// if(!function_exists('getJsFooter'))
// {
// 	function getJsFooter() 
// 	{  
//        $session = \Config\Services::session();
//        $jsSession = $session->get('jsSession');
//        if(is_array($jsSession))
//        {
//           foreach ($jsSession as $value)
//           {  
//           	//echo '<script src="'.$value.'"></script>';
//           	echo $value;
//           	echo '<br>';
//           }
//        } 
//        $session->set('jsSession',array());  
// 	}
// }
