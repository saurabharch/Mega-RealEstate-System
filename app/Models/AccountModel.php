<?php namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{
       protected $users_tb = '_users';
       protected $user_detail_tb = '_user_details';
       protected $users_sess_logs_tb = '_users_session_logs'; 
       protected $countries = '_countries'; 
       protected $states = '_states'; 
       protected $cities = '_cities'; 
       protected $notifications = '_notifications'; 
       protected $status_tb = '_status';  

    
    function getProfileDetail($userId)
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

    function removeUserProfilePic($userId) 
    {    
         helper('filesystem');
         $getProfileDetail = $this->getProfileDetail($userId);
         $fileName = $getProfileDetail['profile_pic'];
         $path = FCPATH.'./user-images/'.$fileName;   
         //echo $path;exit;
         if(file_exists($path) &&  $fileName !=NULL) 
         { 
           unlink(FCPATH.'user-images/'.$fileName); 
           unlink(FCPATH.'user-images/thumbnails/'.$fileName);
           $builder  = $this->db->table($this->user_detail_tb); 
           $builder->where('user_id',$userId);   
           $builder->update(['profile_pic' => '']);
           return true;    
         }     
    } 

    function saveProfileDetail($data)
    {
        $builder = $this->db->table($this->user_detail_tb);
        $builder->insert($data); 
    }
    
    function allStatus()   
    {
         $builder = $this->db->table($this->status_tb);
         $builder->select('*');
         $query = $builder->get();
          foreach($query->getResultArray() as $r)
              $data[] = $r;

           return $data;     
    }

    function getStatusFromStatusId($status)
    {
        $builder = $this->db->table($this->status_tb);
        $builder->select('*');
        $builder->where('id',$status);
        $query = $builder->get();
          foreach($query->getResultArray() as $r)
          {
              $data[] = $r;
          } 
           return $data; 
    }


    function notifications($userId) 
    {   
        $builder = $this->db->table($this->notifications); 
        $builder->select('*');
        $builder->where(['user_id' => $userId]); 
        $query = $builder->get(); 
        if(count($query->getResultArray()) > 0 ) 
        {
            foreach($query->getResultArray() as $r)
            {
              $data[] = $r;
            }
            return $data;   
        }    
    }


    function allNotificationsReceived($userId = NULL,$status = NULL)    
    {
       $builder = $this->db->table($this->notifications);
       if($status == 0)
       {
         // Get all my unread notifications
           $builder->where(['user_id' => $userId,'status' => 0]);
       }elseif($status == 1){
         // Get all my received read notifications
           $builder->where(['user_id' => $userId,'status' => 1]);
       }else{
          // Get all my received notifications
           $builder->where(['user_id' => $userId]); 
       } 
         
       $query = $builder->get(); 
        if(!empty($query->getResultArray()))
        {
           return count($query->getResultArray());  
        }else{
           return 0;
        }  
    }  


    function saveUserSessLog($data)
    {
       $builder = $this->db->table($this->users_sess_logs_tb);
       $builder->insert($data); 
    }   


}