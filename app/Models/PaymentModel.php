<?php namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model 
{
   
       protected $users_tb           = '_users';
       protected $user_detail_tb     = '_user_details';
       protected $users_sess_logs_tb = '_users_session_logs'; 
       protected $countries          = '_countries'; 
       protected $states             = '_states'; 
       protected $cities             = '_cities';  
       protected $properties_tb      = '_properties'; 
       protected $property_ty_tb     = '_property_type'; 
       protected $amenities_tb       = '_amenities'; 
       protected $property_ty_mp_tb  = '_property_type_map'; 
       protected $property_imgs_tb   = '_property_images'; 
       protected $property_fav_tb    = '_favourites'; 
       protected $property_interested_tb = '_interested';  
       protected $property_sales_tb  = '_sales';    
       protected $property_ads_payment_tb = '_property_ads_payment';     
       protected $status_tb = '_status';  
    

    function getAllPropertyAdsPayments($status = NULL)   
    {
        $builder = $this->db->table($this->property_ads_payment_tb.' as A');
        $builder->select(['A.*','B.title','C.status_name','C.status_badge']);
        $builder->join($this->properties_tb.' as B','B.id = A.property_id');
        $builder->join($this->status_tb.' as C','C.id = A.status'); 
        if($status)
        {
            $builder->where('status',$status); 
        }
         $query = $builder->get(); 
         $data = array(); 
          foreach($query->getResultArray() as $r)
          {
              $data[] = $r;
          } 
          return $data; 
    }


    function isAdsRunning($propertyId = NULL)      
    {
        $builder = $this->db->table($this->property_ads_payment_tb.' as A');
        $builder->select(['A.*']);
        $builder->where('A.property_id',$propertyId);   
        $builder->where('A.status',1);   
     
        $query = $builder->get(); 
        $data  = $query->getRowArray();
        if(is_array($data))
        {
            $dateUpto  = strtotime($data['end_ad_on']); 
            $dateNow   = strtotime(date('Y-m-d h:i:s'));
            $diff = ($dateUpto - $dateNow)/60/60/24;   
            if($diff > 0)
            {
               return true;
            } 
        } 
    }

    function propertyAdsPeriod($propertyId)
    {
        $builder = $this->db->table($this->property_ads_payment_tb.' as A');
        $builder->select(['A.*','B.title','C.status_name','C.status_badge']);
        $builder->join($this->properties_tb.' as B','B.id = A.property_id');
        $builder->join($this->status_tb.' as C','C.id = A.status'); 
        $builder->where('A.property_id',$propertyId);
         $query = $builder->get(); 
         $data = array(); 
          foreach($query->getResultArray() as $r)
          {
              $data[] = $r;
          } 
          return $data; 
    }   

   
}   