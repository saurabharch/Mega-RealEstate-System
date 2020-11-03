<?php


if(!function_exists('propertyTypeArray')){
    
    function propertyTypeArray($pt){
	if($pt == 1){
        return ['bhk_type','complex_type','status_type']; 
	}elseif($pt == 2){

	}elseif($pt == 3){

	}elseif($pt == 4){

	}elseif($pt == 5){
        return ['complex_type','status_type'];
	}elseif($pt == 6){

	}else{
		return false;
	}
  }

}


if(!function_exists('propertyTypeAccess')){ 
    
    function propertyTypeAccess($access,$array){
	 if(in_array($access,$array)){
        return true;
	 }else{
	 	return false;
	 }
  }

}

if(! function_exists('fullUrl'))
{
  function fullUrl(){  
  	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  	return $actual_link;
  }
}

if(! function_exists('totalPropertiesSoldByUser'))
{
  function totalPropertiesSoldByUser($userId){
     $PropertyModel  = model('PropertyModel');  
  	 $total_sold = count($PropertyModel->totalPropertiesSoldByUser($userId));
     return $total_sold;      
  }
}

// if(! function_exists('totalPropertiesSoldByUser'))
// {
//   function totalPropertiesSoldByUser($userId){
//      $PropertyModel  = model('PropertyModel');  
//   	 $total_sold = $PropertyModel->totalPropertiesSoldByUser($userId);
//      return $total_sold;      
//   }
// }  


if(! function_exists('totalUserReviews'))  
{
  function totalUserReviews($userType,$userId,$status)  
  {
     $UserModel  = model('UserModel');  
  	 $getAllReviews = $UserModel->getAllReviews($userType,$userId,$status); 
     return $getAllReviews ? count($getAllReviews) : 0;         
  }   
}

if(! function_exists('isAdsRunning'))
{
   function isAdsRunning($propertyId)
   {  
       $PaymentModel  = model('PaymentModel');  
       $return = $PaymentModel->isAdsRunning($propertyId);
       return $return;   
   }
} 


if(! function_exists('adsPricePerDay'))
{
   function adsPricePerDay()
   {  
       $price = 5;
       return $price; 
   }
}    


if(! function_exists('getPropertyDetail'))
{
   function getPropertyDetail($propertyId) 
   {  
       $PropertyModel  = model('PropertyModel');  
       $return = $PropertyModel->getPropertyDetail($propertyId);
       return $return;  
   }
} 

if(! function_exists('getProjectDetail'))
{
   function getProjectDetail($projectId)
   {  
       $PropertyModel  = model('PropertyModel');  
       $return = $PropertyModel->getProjectDetail($projectId); 
       return $return;  
   }
} 

if(!function_exists('actualSalesData'))
{ 
    function actualSalesData()    
    {
      $StatisticModel = model('StatisticModel');
      return $StatisticModel->actualSalesData();  
    }
}  
