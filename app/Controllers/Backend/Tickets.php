<?php 
namespace App\Controllers\Backend;

use CodeIgniter\Controller;  

class Tickets extends BackendController   
{   
  

  function __construct()
  {
      $this->AccountModel  = model('AccountModel');   
      $this->UserModel     = model('UserModel');   
      $this->CrudModel     = model('CrudModel');    
      $this->TicketModel   = model('TicketModel');         
  } 

  
  function index()
  {
    $data['title']   = "Tickets";
    $data['tickets'] = $this->TicketModel->getTickets($TicketId = NULL,$parentId = 0,$userId = NULL,$req_res = 'req',$status = NULL); 
    $data['section'] = ""; 
    return view('backend/tickets',$data);  
  }


  function create()
  {  
  	$data['title'] = "Create Ticket";

  	if($this->request->getPost('create'))
  	{
       $this->CrudModel->C('_tickets',array(
         'req_res'     => 'req',
         'parent_ticket_id' => 0,
         'user_id'     => $this->request->getPost('searchedInputid'), 
         'title'       => $this->request->getPost('title'),
         'created_by'  => cUserId(),
         'subject'     => $this->request->getPost('subject'),
         'description' => $this->request->getPost('description'),
         'created_at'  => date('Y-m-d h:i:s'),
         'updated_at'  => date('Y-m-d h:i:s'), 
         'status'      => $this->request->getPost('status'),
       ));
       $this->session->setFlashdata('alert','<div class="alert alert-success">New Ticket Created</div>');
       return redirect()->to('/backend/tickets/index'); 
  	}
  	$data['section'] = 'create';
    return view('backend/tickets',$data);
  } 



  function openTicket() 
  {  
     $data['title']    = "Open Ticket";
     $data['section']  = 'openTicket';
     $data['ticketId'] = segment(4); 
     $data['detail']   = $this->TicketModel->getTickets($data['ticketId'],$parentId = 0,$userId = NULL,$req_res = 'req',$status = NULL)[0];

      if($this->request->getPost('ticketReplyBtn'))
      {  
         $text = $this->request->getPost('ticketReplyText');  
         $this->TicketModel->replyToTicket($data['ticketId'],$text,$data['detail']['created_by'],$staffUserId = cUserId(),1);   
      }    
      
     
     $data['response'] = $this->TicketModel->getTickets($TicketId = NULL,$parentId = $data['ticketId'],$userId = NULL,$req_res = 'res',$status = NULL);
     return view('backend/tickets',$data);  
  }


  function updateTicket()
  {
      set_cookie('userId','asas','3600');
	  set_cookie('display','asas','3600');
	  set_cookie('role','asasas','3600');
	  set_cookie('email','dddd','3600');    
  }


  function deleteTicket() 
  {
      $this->CrudModel->D('_tickets',array(
         'id' => segment(4)
       ));
       $this->session->setFlashdata('alert','<div class="alert alert-danger">Ticket Deleted</div>');
       return redirect()->to('/backend/tickets/index'); 
  }


}  