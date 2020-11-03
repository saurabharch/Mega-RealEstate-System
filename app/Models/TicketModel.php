<?php namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
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
       protected $tickets_tb = '_tickets';   
 
    
    function getTickets($ticketId = NULL,$parentId = NULL,$userId = NULL,$req_res = NULL,$status = 1)   
    { 
        $builder = $this->db->table($this->tickets_tb.' a');   
        $builder->select([
            'a.*',
            'b.firstname as fname_res',
            'b.lastname as lname_res',
            'c.firstname as fname_req', 
            'c.lastname as lname_req',
            'd.status_name',
            'd.status_badge' 
        ]); 
        $builder->join($this->user_detail_tb.' b','b.user_id = a.staff_user_id','left');    
        $builder->join($this->user_detail_tb.' c','c.user_id = a.created_by','left');    
        $builder->join($this->status_tb.' d','d.id = a.status','left'); 
        if($ticketId)
        { 
          $builder->where('a.id',$ticketId);   
        }    
        if($parentId)
        { 
          $builder->where('a.parent_ticket_id',$parentId); 
        }
         if($userId) 
        {
          $builder->where('a.user_id',$userId); 
        }
         if($req_res)
        {
          $builder->where('a.req_res',$req_res);  
        }
        if($status)
        {
          $builder->where('a.status',$status);  
        } 
        $query = $builder->get(); 
        $data = array();  
        foreach($query->getResultArray() as $r)
        {
            $data[] = $r;  
        }    
        return $data;    
    } 


    function replyToTicket($ticketId,$text,$creatorId,$staffUserId,$status)  
    {
        $builder = $this->db->table($this->tickets_tb);
        $insert = [
          'req_res' => 'res', 
          'parent_ticket_id' => $ticketId,
          'staff_user_id'    => $staffUserId,  
          'created_by' => $creatorId,  
          'response'   => $text,
          'created_at' => date('Y-m-d h:i:s'), 
          'updated_at' => date('Y-m-d h:i:s'),
          'status'     => $status  
        ]; 
        $builder->insert($insert);  
        return true;   
    }



    



}