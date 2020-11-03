<?php

function countries()
{
	$geographyModel = model('GeographyModel');

}


if(!function_exists('get_client_ip'))  
{
  function get_client_ip() 
  {
      $ipaddress = '';
      if (isset($_SERVER['HTTP_CLIENT_IP'])) {
          $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
      } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
          $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
      } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
          $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
      } else if (isset($_SERVER['HTTP_FORWARDED'])) {
          $ipaddress = $_SERVER['HTTP_FORWARDED'];
      } else if (isset($_SERVER['REMOTE_ADDR'])) {
          $ipaddress = $_SERVER['REMOTE_ADDR'];
      } else {
          $ipaddress = 'UNKNOWN';
      }
      return $ipaddress;
  }
}



if(!function_exists('currentLocation')) 
{
  function currentLocation()
  {
  	$public_ip = get_client_ip(); 
  	$json      = file_get_contents("http://ipinfo.io/$public_ip/geo");
  	$arr      = json_decode($json, true);
  	$country   = @$arr['country'] ? $arr['country'] : "unknown"; 
  	$state     = @$arr['region'] ? $arr['region'] : "unknown"; 
  	$city      = @$arr['city'] ? $arr['city'] : "unknown";   
  	return [
  	    'ip'      => $public_ip,   
        'country' => $country,
        'state'   => $state,
        'city'    => $city
  	]; 
  }
}  



if(!function_exists('cityFromCityId'))
{ 
    function cityFromCityId($cityId)
    {
      $GeographyModel = model('GeographyModel');
      return $GeographyModel->cityFromCityId($cityId); 
    }
} 


if(!function_exists('browser_platform'))
{
    function browser_platform()
    {    
        $request = \Config\Services::request();
        $agent = $request->getUserAgent();

        if ($agent->isBrowser())
        {
                $currentAgent = $agent->getBrowser().' '.$agent->getVersion();
        }
        elseif ($agent->isRobot())
        {
                $currentAgent = $this->agent->robot();
        }
        elseif ($agent->isMobile())
        {
                $currentAgent = $agent->getMobile();
        }
        else
        {
                $currentAgent = 'Unidentified User Agent';
        }

        return [ 
           'currentAgent' => $currentAgent,
           'platform'     => getPlatform()
         ];
    }
} 