<?php namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
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
       protected $property_sales_tb = '_sales';   
       protected $projects_tb = '_project';    
       protected $status_tb = '_status';   
        

    function addProperty($data)  
    {
       $builder = $this->db->table($this->properties_tb); 
       $builder->insert($data);
       return $this->db->insertID();
    }



    function addPropertyImages($data)  
    {
       $builder = $this->db->table($this->property_imgs_tb); 
       $builder->insert($data);
       return true; 
    }



    function getPropertyImages($id)  
    {    
         $data = array();
         $builder = $this->db->table($this->property_imgs_tb); 
         $builder->select('*');
         $builder->where('property_id',$id);
         $query = $builder->get(); 
         if(!empty($query->getResultArray()))
          {
             foreach($query->getResultArray() as $r)
               $data[] = $r;
             return $data;  
          } 
    }   



    function getPropertyType() 
    {
       $builder = $this->db->table($this->property_ty_tb);
       $select = implode(',',[
           $this->property_ty_tb.'.*',
           $this->status_tb.'.status_name', 
           $this->status_tb.'.status_badge'   
       ]); 
       $builder->select($select);  
       $builder->join($this->status_tb,$this->status_tb.'.id = '.$this->property_ty_tb.'.status','LEFT');   
       $query = $builder->get();
       $data = array();      
        foreach($query->getResultArray() as $r)
        {
            $data[] = $r;
        }
        return $data;  
    }


    function getPropertyFields()  
    { 
         $fields  = $this->db->getFieldNames($this->properties_tb); 
         $data = array(); 
         if(!empty($fields))
          {
             foreach($fields as $f)
             {
               $data[] = $f; 
             }
             return $data;  
          } 
    }   

    function propertyTypeFieldMap($id = NULL,$propertyTypeId = NULL) 
    {
         $builder = $this->db->table($this->property_ty_mp_tb.' a');
         $builder->select('a.*,b.type_name,c.status_name,c.status_badge');
         $builder->join($this->property_ty_tb.' b','b.id = a.property_type');
         $builder->join($this->status_tb.' c','c.id = a.status','LEFT');
         if($id)
         {
           $builder->where(['a.id' => $id]); 
         }
         if($propertyTypeId)
         {
           $builder->where(['a.property_type' => $propertyTypeId]);  
         }
         $query = $builder->get();
         $data = array();     
          foreach($query->getResultArray() as $r)
          {
              $data[] = $r;
          }
          return $data;  
    } 

    

   function getPropertyAmeneties()  
    {   
        $builder = $this->db->table($this->amenities_tb);
        $select = implode(',',[
           $this->amenities_tb.'.*',
           $this->status_tb.'.status_name', 
           $this->status_tb.'.status_badge'   
       ]); 
       $builder->select($select);
        $builder->join($this->status_tb,$this->status_tb.'.id='.$this->amenities_tb.'.status','LEFT'); 
         $query = $builder->get();
          $data = array();     
          foreach($query->getResultArray() as $r)
          {
              $data[] = $r;
          }
          return $data; 
    }



    function getAmenitiesByPropertyId($propertyId)  
    {
         $builder = $this->db->table($this->properties_tb);
         $builder->select('amenities');  
         $builder->where(['id' => $propertyId]);
         $query = $builder->get();

          foreach($query->getResultArray() as $r)
               $amenities = json_decode($r['amenities'],true);

          if(is_array($amenities))
          {
               $builder2 = $this->db->table($this->amenities_tb);
               $builder2->select('id,name');  
               $builder2->whereIn('id',$amenities); 
               $query2 = $builder2->get();
               foreach($query2->getResultArray() as $r2)
                     $data2[] = $r2;
                return $data2;   
          }     
    }



    function checkPropertyAccess($propertyId,$userId)
    {   
        $builder = $this->db->table($this->properties_tb);
        $builder->where([]); 
        $query = $builder->get(); 
        return $builder->countAll();
    }



   function getAllFeaturedProperties($status = NULL) 
   {      
         $builder = $this->db->table($this->properties_tb); 
         if($status)
         {
            $builder->where(['status' =>1,'has_ads' => 1]);
         }else{
            $builder->where(['has_ads' => 1]);
         }
        
         $query = $builder->get();
          if(!empty($query->getResultArray()))
          {
             foreach($query->getResultArray() as $r)
             {
               $r['images'] = $this->getPropertyImages($r['id']);
               $data[] = $r;
             }          
             return $data;  
          }
          
   }  

   

   function getAllSponsoredProperties($status = NULL)  
   {
         $builder = $this->db->table($this->properties_tb); 
          if($status) 
         {
            $builder->where(['status' =>1,'has_ads' => 2]);
         }else{
            $builder->where(['has_ads' => 2]);
         } 
         $query = $builder->get();
          if(!empty($query->getResultArray()))
          {
             foreach($query->getResultArray() as $r)
             {
               $r['images'] = $this->getPropertyImages($r['id']); 
               $r['propertyType']  = $this->getPropertyTypeFromPropertyId($r['property_type']);
               $r['propertyCity']  = $this->getPropertyCity($r['city']);  
               $data[] = $r; 
             }
             return $data;  
          } 
   }
   

   function getPropertyCity($cityId) 
   {
        $builder = $this->db->table($this->cities);
        $builder->where(['id' => $cityId]); 
        $query = $builder->get(); 
        return $query->getRowArray(); 
   }

   function getPropertyDetail($propertyId) 
   {
         $builder = $this->db->table($this->properties_tb); 
         $builder->where(['id' => $propertyId]);   
         $query = $builder->get();
          if(!empty($query->getResultArray()))
          {
             foreach($query->getResultArray() as $r){
                $r['isFavourited'] = $this->isFavourited($r['user_id'],$propertyId);   
                $r['isInterested'] = $this->isInterested($r['user_id'],$propertyId);
                $r['contact']  = $this->getPropertyContact($r['user_id']); 
                $r['images']   = $this->getPropertyImages($r['id']);
                $r['amenitiesName'] = $this->getAmenitiesByPropertyId($r['id']); 
                $r['propertyType']  = $this->getPropertyTypeFromPropertyId($r['property_type']);
                $data = $r; 
             } 
             return $data;   
          } 
   }

   function getProjectDetail($projectId) 
   {
         $builder = $this->db->table($this->projects_tb); 
         $builder->where(['id' => $projectId]);   
         $query = $builder->get();
         $data = array();
        if(is_array($query->getResultArray()))
        { 
           foreach($query->getResultArray() as $r)
           { 
              $data[]  = $r;      
           }
           return $data;   
        }       
   }  



    function getProperties()   
    {
         $builder = $this->db->table($this->properties_tb); 
         $query = $builder->get();
         $data = array(); 
          if(is_array($query->getResultArray()))
          {
             foreach($query->getResultArray() as $r){
                $r['contact']  = $this->getPropertyContact($r['user_id']); 
                $r['images']   = $this->getPropertyImages($r['id']);
                $r['statusName']   = $this->getStatusNameFromStatusId($r['status']);
                $r['amenitiesName'] = $this->getAmenitiesByPropertyId($r['id']); 
                $r['propertyType']  = $this->getPropertyTypeFromPropertyId($r['property_type']);
                $data[] = $r; 
             } 
             return $data;   
          } 
    }



   function getPropertyContact($userId) 
   {
         $builder = $this->db->table($this->users_tb);
         $builder->select('*');
         $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id = '.$this->users_tb.'.id');
         $builder->where($this->users_tb.'.id',$userId); 
         $query = $builder->get();
          foreach($query->getResultArray() as $r){
            if($r){
             return $data = $r;
           }  
        }  
   }


   function searchProperty($array)
   {     
         $data = array();
         $builder = $this->db->table($this->properties_tb); 
         $builder->where($array);   
         $builder->where($this->properties_tb.'.status',1);     
         $query = $builder->get();

         if( null !== $query->getResultArray())
          {   $i = 0;
             foreach($query->getResultArray() as $r)
             {
                $r['images'] = $this->getPropertyImages($r['id']);
                $data[] = $r;
             }
             return $data;  
          } 
   } 


    function searchPropertyAjax($array,$role)
   {     
         $builder = $this->db->table($this->properties_tb);
         $builder->select([$this->properties_tb.'.*',$this->user_detail_tb.'.firstname',$this->user_detail_tb.'.lastname',$this->users_tb.'.role']);
         $builder->join($this->users_tb,$this->users_tb.'.id='.$this->properties_tb.'.user_id','left');
         $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id = '.$this->users_tb.'.id');  
         if($role)
          {
             $builder->whereIn($this->users_tb.'.role',$role);
          }  
         $builder->where($array); 
         //print_r($array);
         //print_r($role);  
         //return $builder->getCompiledSelect();    
         $query = $builder->get();

         if($query->getResultArray())
          {   
             foreach($query->getResultArray() as $r)
             {
                $r['isFavourited'] = $this->isFavourited($r['user_id'],$r['id']);   
                $r['isInterested'] = $this->isInterested($r['user_id'],$r['id']);
                $r['images'] = $this->getPropertyImages($r['id']);
                $r['amenitiesName'] = $this->getAmenitiesByPropertyId($r['id']);
                $data[] = $r;
             }
             return $data;   
          } 
   }


   function getPropertiesByLocation()   
   {  
         $builder = $this->db->table($this->properties_tb);
         $builder->select([$this->properties_tb.'.*',$this->user_detail_tb.'.firstname',$this->user_detail_tb.'.lastname',$this->users_tb.'.role']);
         $builder->join($this->users_tb,$this->users_tb.'.id='.$this->properties_tb.'.user_id','left');
         $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id = '.$this->properties_tb.'.user_id');    
         $builder->where($this->properties_tb.'.status',1);     
      
         //return $builder->getCompiledSelect();    
         $query = $builder->get();

         if($query->getResultArray())
          {   
             foreach($query->getResultArray() as $r)
             {
                $r['isFavourited'] = $this->isFavourited($r['user_id'],$r['id']);   
                $r['isInterested'] = $this->isInterested($r['user_id'],$r['id']);
                $r['images'] = $this->getPropertyImages($r['id']);
                $r['amenitiesName'] = $this->getAmenitiesByPropertyId($r['id']);
                $data[] = $r;
             }
             return $data;   
          } 
   }    


   function getPropertiesByUserId($userId)   
   {  
       $builder = $this->db->table($this->properties_tb);
       $builder->select([$this->properties_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']);
       $builder->join($this->status_tb,$this->status_tb.'.id='.$this->properties_tb.'.status','LEFT'); 
       $builder->where([$this->properties_tb.'.user_id' => $userId,$this->properties_tb.'.status' => 1]);   
       $query = $builder->get();
       $data = array(); 
        if(is_array($query->getResultArray()))
        {
           foreach($query->getResultArray() as $r)
           { 
             $r['images'] = $this->getPropertyImages($r['id']);
             $r['amenitiesName'] = $this->getAmenitiesByPropertyId($r['id']);
             $r['propertyType']  = $this->getPropertyTypeFromPropertyId($r['property_type']);
             $r['contact']  = $this->getPropertyContact($r['user_id']);
             $data[] = $r;
           } 
           return $data;   
        } 
   }

   function getProjectsByUserId($userId)   
   {       
       $builder = $this->db->table($this->properties_tb);
       $builder->select([$this->properties_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']);
       $builder->join($this->status_tb,$this->status_tb.'.id='.$this->properties_tb.'.status','LEFT'); 
       $builder->where([$this->properties_tb.'.user_id' => $userId,$this->properties_tb.'.status' => 1]);   
       $query = $builder->get();
       $data = array(); 
        if(is_array($query->getResultArray()))
        {
           foreach($query->getResultArray() as $r)
           { 
             $r['images'] = $this->getPropertyImages($r['id']);
             $r['amenitiesName'] = $this->getAmenitiesByPropertyId($r['id']);
             $r['propertyType']  = $this->getPropertyTypeFromPropertyId($r['property_type']);
             $r['contact']  = $this->getPropertyContact($r['user_id']);
             $data[] = $r;
           } 
           return $data;   
        } 
   }    


   function getPropertiesByUserFavourite($userId) 
   {  
       $builder = $this->db->table($this->property_fav_tb); 
       $builder->select('property_id');  
       $builder->where(['user_id' => $userId]);  
       $query = $builder->get();  
       //print_r($query->getResultArray());exit; 
        $data = NULL;   
        if(is_array($query->getResultArray()))   
        {
           foreach($query->getResultArray() as $r){ 
            
             $data[] = $this->getPropertyDetail($r['property_id']);    
           } 
           return $data;            
        }
   }      


   function interestedProperty($data) 
   {    
       $builder = $this->db->table($this->property_interested_tb);
       $builder->where(['user_id' => $data['user_id'],'property_id' => $data['property_id']]);  
       $query = $builder->get();
        if(empty($query->getResultArray()))
        {
           $builder->insert($data);
        }else{
           $builder->where(['user_id' => $data['user_id'],'property_id' => $data['property_id']]);  
           $builder->update([
              'updated_at'  => date('Y-m-d h:i:s'),
              'status'      => 1
            ]);
        } 
       return true; 
   } 


   function isInterested($user_id,$property_id)
   {
       $builder = $this->db->table($this->property_interested_tb);
       $builder->where(['user_id' => $user_id,'property_id' => $property_id]);  
       $query = $builder->get();
        if(!empty($query->getResultArray()))
        {
           return true;
        }
   }   


   function upsertFavouriteProperty($data)  
   {
       $builder = $this->db->table($this->property_fav_tb);  
       $builder->where(['user_id' => $data['user_id'],'property_id' => $data['property_id']]);  
       $query = $builder->get();
        if(empty($query->getResultArray()))
        {
           $builder->insert($data);
           return 1;
        }else{
           $builder->where(['user_id' => $data['user_id'],'property_id' => $data['property_id']]);  
           $builder->delete();
           return 0;
        }  
   }


   function isFavourited($user_id,$property_id)
   {
       $builder = $this->db->table($this->property_fav_tb);
       $builder->where(['user_id' => $user_id,'property_id' => $property_id]);  
       $query = $builder->get();
        if(!empty($query->getResultArray()))
        {
           return true;
        }
   } 


   function getPropertyTypeFromPropertyId($propertyId)
   {
       $builder = $this->db->table($this->property_ty_tb); 
       $select = implode(',',[
           $this->property_ty_tb.'.*',
           $this->status_tb.'.status_name', 
           $this->status_tb.'.status_badge'   
       ]); 
       $builder->select($select);
       $builder->where([$this->property_ty_tb.'.id' => $propertyId]); 
       $builder->join($this->status_tb,$this->status_tb.'.id='.$this->property_ty_tb.'.status','LEFT'); 
        
       $query = $builder->get(); 

        if(!empty($query->getResultArray()))
        {
           foreach($query->getResultArray() as $r)
             $data  = $r;
           return $data; 
        }  
   }

    function getAmenityFromAmenityId($AmenityId)
   {
       $builder = $this->db->table($this->amenities_tb); 
       $select = implode(',',[
           $this->amenities_tb.'.*',
           $this->status_tb.'.status_name', 
           $this->status_tb.'.status_badge'    
       ]); 
       $builder->select($select);
       $builder->where([$this->amenities_tb.'.id' => $AmenityId]); 
       $builder->join($this->status_tb,$this->status_tb.'.id='.$this->amenities_tb.'.status','LEFT'); 
        
       $query = $builder->get(); 

        if(!empty($query->getResultArray()))
        {
           foreach($query->getResultArray() as $r)
             $data  = $r;
           return $data; 
        }  
   }  
    
   function addPropertyType($data) 
   { 
       $builder = $this->db->table($this->property_ty_tb); 
       $builder->insert($data);
       return true;     
   }    

   function updatePropertyType($id,$data)
   { 
       $builder = $this->db->table($this->property_ty_tb);  
       $builder->where(['id' => $id]);   
       $builder->update($data);
       return true;    
   }

   function deletePropertyType($id)
   { 
       $builder = $this->db->table($this->property_ty_tb);  
       $builder->where(['id' => $id]);   
       $builder->delete();
       return true;    
   }  

   

   function getStatusNameFromStatusId($statusId)
   {
       $builder = $this->db->table($this->status_tb); 
       $builder->where(['id' => $statusId]);  
       $query = $builder->get(); 
        if(!empty($query->getResultArray()))
        {
           foreach($query->getResultArray() as $r){ 
              $data  = $r;  
           
           return $data;   
          }
        }  
   }

   function totalPropertiesSoldByUser($userId) 
   {
        $builder = $this->db->table($this->property_sales_tb);
        $builder->where(['seller_id' => $userId]);    
        $query = $builder->get(); 
        $data = array(); 
        if(is_array($query->getResultArray()))
        { 
           foreach($query->getResultArray() as $r)
           { 
              $data[]  = $this->getPropertyDetail($r['property_id']);     
           }
           return $data;   
        }       
   }


    function salesByUser($userId)  
   {
        $builder = $this->db->table($this->property_sales_tb);
        $builder->select(
          [
            $this->property_sales_tb.'.*',
            $this->user_detail_tb.'.firstname',
            $this->user_detail_tb.'.lastname',
            $this->status_tb.'.status_name',
            $this->status_tb.'.status_badge'
          ] 
        );  
        $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id = '.$this->property_sales_tb.'.buyer_id','left'); 
        $builder->join($this->status_tb,$this->status_tb.'.id ='.$this->property_sales_tb.'.status','left'); 
        $builder->where([$this->property_sales_tb.'.seller_id' => $userId]); 
        //echo $builder->getCompiledSelect();     
        $query = $builder->get(); 
        $data = array();
        if(is_array($query->getResultArray()))
        { 
           foreach($query->getResultArray() as $r)
           { 
              $r['propertyDetail']  = $this->getPropertyDetail($r['property_id']);     
              $data[]  = $r;      
           }
           return $data;   
        }       
   }

   function totalSalesAmountByUser($userId) 
   {
      $sales = $this->totalPropertiesSoldByUser($userId);
      $total = 0; 
      if(count($sales) > 0) 
      {    
          foreach($sales as $s)
           { 
              if($s['listing_type'] == "sell")
              {
                 $amount = $s['total_price'];
              }
              if($s['listing_type'] == "rent")
              {
                 $amount = $s['rent_per_mon'];
              }
              $data[] = $amount;     
           }
        $total =  array_sum($data);
      }
      return $total;
   }

   function updateProperty($pid,$data)
   {
       $builder = $this->db->table($this->properties_tb); 
       $builder->where(['id'=>$pid]); 
       $builder->update($data);
       return true;   
   } 

   function deleteProperty($pid)
   {
       $builder = $this->db->table($this->properties_tb); 
       $builder->where(['id'=>$pid]);
       $builder->update(['status'=>5]);
       return true;       
   }

   
    function saveUserSessLog($data)
    {
       $builder = $this->db->table($this->users_sess_logs_tb); 
       $builder->insert($data);
       return true; 
    } 

    function getProjects($projectId = NULL,$userId = NULL,$status = NULL) 
    {
       $builder = $this->db->table($this->projects_tb);
       $builder->select([$this->projects_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']);
       $builder->join($this->status_tb,$this->status_tb.'.id='.$this->projects_tb.'.status','LEFT'); 
       if($projectId)
       {
          $builder->where([$this->projects_tb.'.id' => $projectId]);
       }
       if($status)
       {
          $builder->where([$this->projects_tb.'.status' => $status]); 
       }
       if($userId)
       {
          $builder->where([$this->projects_tb.'.user_id' => $userId]);  
       }
       $query = $builder->get();
       $data = array();
        if(is_array($query->getResultArray()))
        { 
           foreach($query->getResultArray() as $r)
           { 
              $data[]  = $r;     
           }
           return $data;   
        }          
    }    



}