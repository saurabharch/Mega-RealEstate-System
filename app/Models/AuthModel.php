<?php namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
       protected $users_tb = '_users';
       protected $user_detail_tb = '_user_details';
       protected $users_sess_logs_tb = '_users_session_logs'; 


    function login($mobile,$password,$role)
    {
        $query = $this->db->query("SELECT * FROM $this->users_tb WHERE mobile = ? AND password= ? AND role = ?",[$mobile,$password,$role]); 
        foreach($query->getResultArray() as $r)
        {
            if($r)
            {
               return $data[] = $r;
            }  
        }   
    } 

    function isLoggedIn()   
    {
       $role = session('role');
       if($role)
       {
         return true; 
       }
    }  


    function backendLogin($username,$password,$access_code,$role)         
    {     
          $builder = $this->db->table($this->users_tb);
          $builder->select('*');
          $builder->where(['username' => $username,'password' => $password,'access_code'=>$access_code,'role'=>$role]);
          $query = $builder->get();
          foreach($query->getResultArray() as $r)
          {
            return $data[] = $r;
          }    
    }       


    function register($data,$data2) 
    {
       $builder = $this->db->table($this->users_tb);
       $builder->insert($data); 
       $data2['user_id'] = $this->db->insertID();
       $this->saveUserDetail($data2);
       return $data2['user_id']; 
    }

    function isMobileOrEmailExists($data)  
    {
          $builder = $this->db->table($this->users_tb);
          $builder->where(['email' => $data['email']]);
          $builder->orWhere(['mobile' => $data['mobile']]);  
          $query = $builder->get();
          if(count($query->getResultArray()) > 0) 
          {
             return true; 
          }
    } 


    function saveUserDetail($data)
    {
        $builder = $this->db->table($this->user_detail_tb);
        $builder->insert($data); 
    } 


    function saveUserSessLog($data)
    {
       $builder = $this->db->table($this->users_sess_logs_tb);
       $builder->insert($data); 
    }     


}

