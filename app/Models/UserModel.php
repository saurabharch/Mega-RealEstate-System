<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
       protected $users_tb = '_users';
       protected $user_detail_tb = '_user_details';
       protected $users_sess_logs_tb = '_users_session_logs'; 
       protected $countries = '_countries'; 
       protected $states = '_states'; 
       protected $cities = '_cities';    
       protected $property_fav_tb    = '_favourites'; 
       protected $property_interested_tb = '_interested'; 
       protected $properties_tb      = '_properties'; 
       protected $property_ty_tb     = '_property_type';  
       protected $status_tb = '_status';   
       protected $reviews_tb = '_reviews';  
       protected $appointments_tb = '_appointments';  
       protected $lead_source_tb = '_lead_source';   
       protected $roles_tb = '_roles';   
       protected $role_access_tb = '_user_role_access';   
 
    
    function getUserCountry($userId = NULL)
    {
         $builder = $this->db->table($this->users_tb);
         $builder->select('*');
         $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id = '.$this->users_tb.'.id');
         $builder->where($this->users_tb.'.id',$userId); 
         $query = $builder->get();
          foreach($query->getResultArray() as $r){
            if($r){
             return $data[] = $r;
           }  
        }  
    } 



    function getLeads($status = NULL,$id = NULL)        
    {    //echo $id;exit;
         $PropertyModel = model('PropertyModel');    
         $builder = $this->db->table($this->property_interested_tb.' as A');   
         $builder->select('A.*,B.title,D.firstname,D.lastname,E.status_name,E.status_badge,F.source_name');
         $builder->join(
          $this->properties_tb.' as B',
          'B.id = A.property_id'
        );

         $builder->join(
           $this->users_tb.' as C',
          'C.id = A.user_id'
        );

         $builder->join(
          $this->user_detail_tb.' as D',
          'D.user_id = A.user_id'
        );

         $builder->join(
          $this->status_tb.' as E',
          'E.id = A.status'
        );

         $builder->join(
          $this->lead_source_tb.' as F',
          'F.id = A.lead_source_id'
        );
        
        if(isset($status))
         {
             $builder->where('A.status', $status);
         }

         if(isset($id))
         {
             $builder->where('A.id',$id); 
         }

         $query = $builder->get();
         $data = array();
        if(is_array($query->getResultArray()))
        { 
           foreach($query->getResultArray() as $r)
           {
             $r['images'] = $PropertyModel->getPropertyImages($r['property_id']);
             $data[] = $r;
           }  
            return $data;    
        } 
           
    }


    function getAllLeadsbyUserId($status = NULL,$id = NULL,$userId = NULL)         
    {    
         $PropertyModel = model('PropertyModel');    
         $builder = $this->db->table($this->property_interested_tb.' as A');   
         $builder->select('A.*,B.title,D.firstname,D.lastname,E.status_name,E.status_badge,F.source_name');
         $builder->join(
          $this->properties_tb.' as B',
          'B.id = A.property_id'
        );

         $builder->join(
           $this->users_tb.' as C',
          'C.id = A.user_id'
        );

         $builder->join(
          $this->user_detail_tb.' as D',
          'D.user_id = A.user_id'
        );

         $builder->join(
          $this->status_tb.' as E',
          'E.id = A.status'
        );

         $builder->join(
          $this->lead_source_tb.' as F',
          'F.id = A.lead_source_id'
        );
        
        if(isset($status))
         {
             $builder->where('A.status', $status);
         }

         if(isset($id))
         {
             $builder->where('A.id',$id); 
         }

         if($userId)
         {
             $MessageModel = model('MessageModel');
             $userPropertiesIds = $MessageModel->userPropertiesIds($userId);
             //print_r($userPropertiesIds); 
             if(count($userPropertiesIds) >0 && isset($userPropertiesIds))
             {  
               $builder->whereIn('A.property_id',$userPropertiesIds); 
             }
         } 
        

         $query = $builder->get();
         $data = array();
        if(is_array($query->getResultArray()))
        { 
           foreach($query->getResultArray() as $r)
           {
             $r['images'] = $PropertyModel->getPropertyImages($r['property_id']);
             $data[] = $r;
           }  
            return $data;    
        } 
           
    }



    function getAllUsersByRole($role)
    {
         $builder = $this->db->table($this->users_tb);  
         $builder->select([$this->users_tb.'.*',$this->user_detail_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']); 
         $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id ='.$this->users_tb.'.id','left');
         $builder->join($this->status_tb,$this->status_tb.'.id ='.$this->users_tb.'.status','left'); 
         $builder->where($this->users_tb.'.role',$role); 
         //$builder->getCompiledSelect();exit;
         $query = $builder->get();
         $data = array();
          foreach($query->getResultArray() as $r)
          {
              $data[] = $r;
          } 
          return $data;  
    }


    function userSearchFilter($location = NULL,$name = NULL,$service = NULL,$role = NULL,$status = NULL)
    {    
         $PropertyModel = model('PropertyModel');
         $builder = $this->db->table($this->users_tb.' as A');  
         $builder->select(['A.*','B.*','C.status_name','C.status_badge']); 
         $builder->join($this->user_detail_tb.' as B','B.user_id = A.id','left');
         $builder->join($this->status_tb.' as C','C.id = A.status','left'); 
         $builder->join($this->cities.' as D','D.id = B.city','left');
         $builder->groupStart(); 
         if($name)
         {
            $builder->like('B.firstname',$name,'both');
            $builder->orLike('A.username',$name,'both');  
         }
         if($location) 
         {
            $builder->like('D.city_name',$location,'both');
            $builder->orLike('B.zip',$location,'both');
            $builder->orLike('B.address1',$location);
            $builder->orLike('B.address2',$location);
          //$builder->orLike('B.service_area',$location);
         }
         $builder->groupEnd();  
         if($role)
         {
            $builder->where('A.role',$role); 
         }
         if($status)
         {
            $builder->where('A.status',$status); 
         }

         $query = $builder->get();
         $data  = array();       
          foreach($query->getResultArray() as $r)
          {   
              $getAllReviews = $this->getAllReviews($userType = 'seller',$userId = $r['user_id'],$status = 1);
              $getCurrentReview = $this->getCurrentReview($userType = 'seller',$userId = $r['user_id'],$status = 1);
              $totalPropertiesSoldByUser = $PropertyModel->totalPropertiesSoldByUser($userId = $r['user_id']);
              $getPropertiesByUserId = $PropertyModel->getPropertiesByUserId($userId = $r['user_id']);
              $r['reviewsCount'] = is_array($getAllReviews) ? count($getAllReviews) : 0;
              $r['currentReview'] = (count($getCurrentReview) > 0) ? $getCurrentReview : NULL; 
              $r['salesCount'] = is_array($totalPropertiesSoldByUser) ? count($totalPropertiesSoldByUser) : 0;
              $r['listingsCount'] = is_array($getPropertiesByUserId) ? count($getPropertiesByUserId) : 0;
              $data[] = $r; 
          } 
          return $data;  
    }    



    function getUserDetail($userId)  
    {
        $builder = $this->db->table($this->users_tb);  
        $builder->select([$this->users_tb.'.*',$this->user_detail_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']); 
        $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id='.$this->users_tb.'.id'); 
        $builder->join($this->status_tb,$this->status_tb.'.id='.$this->users_tb.'.status'); 
        $builder->where($this->users_tb.'.id',$userId);  
        $query = $builder->get();  
        foreach($query->getResultArray() as $r) 
        {
           return $r;
        }   
    }


    function getAllUsersByRoleType($roleType = NULL) 
    {
         $builder = $this->db->table($this->users_tb);  
         $builder->select([$this->users_tb.'.*',$this->user_detail_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']); 
         $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id ='.$this->users_tb.'.id','left');
         $builder->join($this->status_tb,$this->status_tb.'.id ='.$this->users_tb.'.status','left'); 
         $builder->join($this->roles_tb,$this->roles_tb.'.role_name ='.$this->users_tb.'.role','left');
         if($roleType)
         {
            $builder->where($this->roles_tb.'.role_type',$roleType); 
         } 
         $query = $builder->get();
         $data = array();
          foreach($query->getResultArray() as $r)
          {
              $data[] = $r;
          } 
          return $data;  
    } 


    function getAllRolesByRoleType($roleType = NULL) 
    {
         $builder = $this->db->table($this->roles_tb);  
         $builder->select([$this->roles_tb.'.*']);  
         $builder->where($this->roles_tb.'.role_type',$roleType);
         $query = $builder->get();
         $data = array();
          foreach($query->getResultArray() as $r)
          {
              $data[] = $r;
          }  
          return $data;
    }   


    function searchUser($txt)
    {
        $builder = $this->db->table($this->users_tb);  
        $builder->select([$this->users_tb.'.id',$this->user_detail_tb.'.firstname',$this->user_detail_tb.'.lastname',$this->users_tb.'.mobile',$this->users_tb.'.email']); 
        $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id='.$this->users_tb.'.id'); 
        $builder->like($this->users_tb.'.email', $txt, 'both'); 
        $builder->orLike($this->users_tb.'.mobile', $txt, 'both'); 
        $builder->orLike($this->users_tb.'.username', $txt, 'both');
        $builder->orLike($this->user_detail_tb.'.firstname', $txt, 'both');
        $builder->orLike($this->user_detail_tb.'.lastname', $txt, 'both');
        //echo $builder->getCompiledSelect();  
        $query = $builder->get();  
        foreach($query->getResultArray() as $r)
        {
           $data[] = $r;
        }
        return $data;   
    }


    function isUsernameAvailable($username)
    {
         $builder = $this->db->table($this->users_tb);
         $builder->select('username');
         $builder->where($this->users_tb.'.username',$username); 
         $query = $builder->get();
         $count = count($query->getResultArray());
         if($count > 0)
         {
            return false;
         }else{
            return true;
         } 
    }

    function getUserIdFromUsername($username) 
    {
         $builder = $this->db->table($this->users_tb);
         $builder->select('id');
         $builder->where($this->users_tb.'.username',$username); 
         $query = $builder->get(); 
        foreach($query->getResultArray() as $r)
        {
           $data[] = $r['id'];
        }
        return $data;  
    }


    function isUserSuspendedOrBanned($userId) 
    {
         $builder = $this->db->table($this->users_tb);
         $builder->select([$this->users_tb.'.status',$this->status_tb.'.status_name']);
         $builder->join($this->status_tb,$this->status_tb.'.id='.$this->users_tb.'.status','left');  
         $builder->where($this->users_tb.'.id',$userId); 
         $builder->whereIn($this->status_tb.'.status_name',['Suspended','Banned']); 
         $query = $builder->get();
         $result = $query->getResultArray();  
        foreach($result as $r)
        {
           return $r['status_name'];
        }      
    }



    function getAllReviews($userType = NULL,$userId = NULL,$status = NULL)
    {
        $builder = $this->db->table($this->reviews_tb);  
        $builder->select([$this->reviews_tb.'.*',$this->reviews_tb.'.id as review_id',$this->user_detail_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']); 
        $builder->join($this->status_tb,$this->status_tb.'.id='.$this->reviews_tb.'.status','left'); 
        
         if(isset($userType))  
         {
             if($userType == 'seller')
             {
                $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id='.$this->reviews_tb.'.buyer_id','left'); 
                $builder->where($this->reviews_tb.'.seller_id',$userId);
             }
             if($userType == 'buyer') 
             {  
                $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id='.$this->reviews_tb.'.seller_id'); 
                $builder->where($this->reviews_tb.'.buyer_id',$userId);
             }
         }

         if(isset($status)) 
         {
             $builder->where($this->reviews_tb.'.status', $status);
         }
        $builder->orderBy($this->reviews_tb.'.id','DESC');  
        $query = $builder->get();
        $data = array();  
        foreach($query->getResultArray() as $r)
        {
            $data[] = $r;  
        }  
        return $data;     
    } 

    function getCurrentReview($userType = NULL,$userId = NULL,$status = NULL)
    {
        $builder = $this->db->table($this->reviews_tb);  
        $builder->select([$this->reviews_tb.'.*',$this->user_detail_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']); 
        $builder->join($this->status_tb,$this->status_tb.'.id='.$this->reviews_tb.'.status','left'); 
        
         if(isset($userType)) 
         {
             if($userType == 'seller')
             {
                $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id='.$this->reviews_tb.'.buyer_id','left'); 
                $builder->where($this->reviews_tb.'.seller_id',$userId);
             }
             if($userType == 'buyer') 
             {  
                $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id='.$this->reviews_tb.'.seller_id'); 
                $builder->where($this->reviews_tb.'.buyer_id',$userId);
             }
         }
         if(isset($status))
         {
             $builder->where($this->reviews_tb.'.status', $status);
         }
        $builder->orderBy($this->reviews_tb.'.id','DESC');
        $builder->limit(1);   
        $query = $builder->get();
        $data = array();  
        foreach($query->getResultArray() as $r) 
        {
            $data[] = $r;  
        }   
        return $data;     
    }


    function getUserRatings($userType = NULL,$userId = NULL,$status = NULL)
    {
        $builder = $this->db->table($this->reviews_tb);
        if(isset($userType)) 
         {
             if($userType == 'seller')
             {
                $builder->where($this->reviews_tb.'.seller_id',$userId);
             }
             if($userType == 'buyer') 
             {  
                $builder->where($this->reviews_tb.'.buyer_id',$userId);
             }
         }
         if(isset($status))
         {
             $builder->where($this->reviews_tb.'.status', $status);
         }
        $builder->where($this->reviews_tb.'.rating !=', NULL); 
        $query = $builder->get();
        $data  = $query->getResultArray();
        $count = is_array($data) ? count($data) : 0;
        if(is_array($data)  && count($data) > 0)
        {
           $totalRating = $count * 5;
           foreach($query->getResultArray() as $r) 
            {
                $totalUsersRatingsArray[] = $r['rating'];  
            }   
           $totalUsersRatings = array_sum($totalUsersRatingsArray);
           $rating =   $totalUsersRatings * 5/$totalRating;
           return $rating; 
        }else{
          return 0;
        }
      
    } 



    function getAllUserAppointment($userType = NULL,$userId = NULL,$status = NULL)
    { 
        $builder = $this->db->table($this->appointments_tb);  
        $builder->select([$this->appointments_tb.'.*',$this->appointments_tb.'.id as appointment_id',$this->user_detail_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']); 
        $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id='.$this->appointments_tb.'.buyer_id'); 
        $builder->join($this->status_tb,$this->status_tb.'.id='.$this->appointments_tb.'.status'); 
        if(isset($status))
         {
             $builder->where($this->appointments_tb.'.status', $status);
         }
         if($userType == 'buyer')
         {
            $builder->where($this->appointments_tb.'.buyer_id',$userId);
         } 
         if($userType == 'seller')
         {
            $builder->where($this->appointments_tb.'.seller_id',$userId);
         }  
        //echo $query = $builder->getCompiledSelect(); 
        //exit;
        $query = $builder->get();
        $data = array();
        if(is_array($query->getResultArray()))  
        {
           foreach($query->getResultArray() as $r)
          {
              $data[] = $r;  
          }  
          return $data; 
        }
            
    }


     function getAppointmentDetail($appointmentId)
    { 
        $builder = $this->db->table($this->appointments_tb);  
        $builder->select([$this->appointments_tb.'.*',$this->user_detail_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']); 
        $builder->join($this->user_detail_tb,$this->user_detail_tb.'.user_id='.$this->appointments_tb.'.buyer_id'); 
        $builder->join($this->status_tb,$this->status_tb.'.id='.$this->appointments_tb.'.status'); 
         if($appointmentId)
         {
             $builder->where($this->appointments_tb.'.id', $appointmentId); 
         }
        $query = $builder->get();
        $data = array();
        if(is_array($query->getResultArray()))  
        {
           foreach($query->getResultArray() as $r)
          {
              $data[] = $r;  
          }  
          return $data; 
        }     
    }


    function userActivity($userId)  
    {
         $builder = $this->db->table($this->user_detail_tb);
         $builder->select('activity');
         $builder->where($this->user_detail_tb.'.user_id',$userId); 
         $query = $builder->get();
         $count = count($query->getResultArray());
         if($count > 0)
         {
           foreach($query->getResultArray() as $r)
           {
              $data = $r['activity'];   
           }
           return $data;   
         }
    } 


    function leadSource()     
    { 
        $builder = $this->db->table($this->lead_source_tb);  
        $builder->select([$this->lead_source_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']); 
        $builder->join($this->status_tb,$this->status_tb.'.id ='.$this->lead_source_tb.'.status','left');
        $query = $builder->get();  
        foreach($query->getResultArray() as $r)
        {
            $data[] = $r;  
        }   
        return $data;     
    }

    function roleList($type,$status) 
    {
        $builder = $this->db->table($this->roles_tb);  
        $builder->select([$this->roles_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']); 
        $builder->join($this->status_tb,$this->status_tb.'.id ='.$this->roles_tb.'.status','left'); 
        if($type)
        {
          $builder->where($this->roles_tb.'.role_type',$type); 
        }
        if($status)
        {
          $builder->where($this->roles_tb.'.status',$status);  
        } 
        $query = $builder->get();  
        foreach($query->getResultArray() as $r)
        {
            $data[] = $r;  
        }   
        return $data;    
    }

    
    function userRolePermissions($id = NULL, $role = NULL, $status = NULL) 
    {
       $builder = $this->db->table($this->role_access_tb);
       $builder->select([$this->role_access_tb.'.*',$this->status_tb.'.status_name',$this->status_tb.'.status_badge']); 
       $builder->join($this->status_tb,$this->status_tb.'.id ='.$this->role_access_tb.'.status','left');
       if($id)
       {
         $builder->where($this->role_access_tb.'.id',$id);  
       } 
       if($role)
       {
         $builder->where($this->role_access_tb.'.role',$role);   
       }
       if($status)
       {
         $builder->where($this->role_access_tb.'.status',$status);   
       }    
       $query = $builder->get();
       $data = array();
         if(is_array($query->getResultArray()))
         {
            foreach($query->getResultArray() as $r)
            {
                $data[] = $r;  
            }   
            return $data; 
         }  
    } 

}