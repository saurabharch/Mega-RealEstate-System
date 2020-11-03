<?php 
namespace App\Controllers;
//require APPPATH.'/Libraries/vendor/pusher/pusher-php-server/src/Pusher.php';

class Message extends BaseController 
{ 
   
    function __construct()
	{
        $this->AccountModel   = model('AccountModel');   
        $this->GeographyModel = model('GeographyModel');   
        $this->PropertyModel  = model('PropertyModel');  
        $this->MessageModel   = model('MessageModel');   
	}


	function index()
	{
		
	}   



   function messagePostAjax()
   { 
        echo '<div class="outgoing_msg">
                 <div class="sent_msg">
                 <p>'.$this->request->getPost('message').'</p>
                 <span class="time_date">'.date("F j, Y, g:i a").'</span> </div>
             </div>';
        $this->MessageModel->createMessage(
        $this->request->getPost('property_id'),
        $this->request->getPost('fk_user_id'),
        cUserId(),
        $this->request->getPost('message'));      
   }     


   // function getMessages($propertyId,$fk_user_id)
   // {
   //      $arr = $this->MessageModel->getMessages($property_id,$fk_user_id,cUserId()); 
   //      return $arr;             	
   // } 



   function getMessagesAjax() 
   {
        $arr = $this->MessageModel->getMessages(
    	         $this->request->getPost('property_id'),
    	         $this->request->getPost('fk_user_id'),
    	         cUserId()
    	        );
        	foreach($arr as $r)
        	{ 
	        	  if($r['to_user_id'] == cUserId())
	        	  {
	                echo '<div class="outgoing_msg">
	                        <div class="sent_msg">
	                           <p>'.$r['message'].'</p>
	                           <span class="time_date">'.$r['created_at'].'</span> 
	                        </div>
	                    </div>';
	        	  }
	        	  if($r['from_user_id'] == cUserId())
	        	  { 
	                echo '<div class="incoming_msg">
	                       <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
	                       <div class="received_msg">
	                           <div class="received_withd_msg">
	                              <p>'.$r['message'].'</p>
	                               <span class="time_date">'.$r['created_at'].'</span>
	                            </div>
	                       </div>
	                     </div>';
	        	  }
           }    	
   }           

   

}
