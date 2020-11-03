<?php namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Auth extends BaseController
{   
	
	 function __construct()
	 {
        $this->AuthModel    = model('AuthModel');   
        $this->MessageModel = model('MessageModel'); 
        $this->CrudModel    = model('CrudModel');  
        $this->UserModel    = model('UserModel');   
        helper('cookie');     
        helper('geography');
        helper('common');        
	 }      


	 public function index() 
	 { 
		  $data['title'] = "Welcome to PropertyRaja";
		  return view('landing',$data);        
	 } 

    
	 public function login()   
	 {  
      if(session('role')) 
      {
         return isLoggedIn();
      } 

      $user = array();
		  $data['title'] = "Login to PropertyRaja";
		  $data['role']  = "customer";            
       
      if($this->request->getGet('redirect')) 
      {
         $this->session->set('sessRedirect',$this->request->getGet('redirect')); 
      } 

		   if($this->request->getPost('sign-in'))
       {
           if(! $this->validate([
              'mobile-number' => 'required|min_length[10]|max_length[12]|numeric',  
              'password'      => 'required|min_length[6]|max_length[20]',
           ])){
               $this->session->setFlashdata('alert',redAlert(\Config\Services::validation()->listErrors()));
               return redirect()->back()->withInput(); 
           }else{
                  $isLoggedIn = $this->AuthModel->login(
                	    $this->request->getPost('mobile-number'),
                	    $this->request->getPost('password'),$data['role']);   
                  $user = [  
                           'userId'  => $isLoggedIn['id'],
                           'display' => $isLoggedIn['display_name'],
                           'role'    => $isLoggedIn['role'],
                           'email'   => $isLoggedIn['email'] 
                          ];       
                       
                $remember = $this->request->getPost('remember_me'); 
               
                if($isLoggedIn)  
                {     
                      
                      $otpNumber = time();

                     $this->sendSms(['otp' => $otpNumber],$isLoggedIn['mobile'],'otp');
                     $this->session->setFlashdata('alert',successAlert('OTP sent to your number '.$isLoggedIn['mobile'].' and registered email!'));
                      
                      $this->sendEmail($isLoggedIn['id'],
                        ['publicFolder' => publicFolder(),'otp' => $otpNumber],
                        $isLoggedIn['email'],
                        'Login OTP - PropertyRaja',
                        'otp');    

                      $this->CrudModel->U('_users',['mobile' => $isLoggedIn['mobile']],['otp' => $otpNumber]);
                      if($remember == 1)
                      {
                         $user['remember'] = 1; 
                      }
                      if($this->session->get('sessRedirect'))
                      {
                         $user['redirect'] = $this->session->get('sessRedirect');  
                      }

                      $this->session->set('sessTemp',$user);
                      $this->session->remove('sessRedirect'); 

                      return redirect()->to('/Auth/verify');            
                }else{
                 $this->session->setFlashdata('alert',redAlert('User Not Found'));
                 return redirect()->back()->withInput();
               } 
           }
		   }          
		  return view('frontend/login-auth',$data);      
	}




	public function login_agent()   
	{
    if(session('role')) 
    {
         return isLoggedIn();
    } 
		$data['title'] = "Agent Login to PropertyRaja";
		$data['role']  = "agent";
		if($this->request->getGet('redirect')) 
      {
         $this->session->set('sessRedirect',$this->request->getGet('redirect')); 
      } 

       if($this->request->getPost('sign-in'))
       {
           if(! $this->validate([
              'mobile-number' => 'required|min_length[10]|max_length[12]|numeric',  
              'password'      => 'required|min_length[6]|max_length[20]',
           ])){
               $this->session->setFlashdata('alert',redAlert(\Config\Services::validation()->listErrors()));
               return redirect()->back()->withInput();
           }else{
                  $isLoggedIn = $this->AuthModel->login(
                      $this->request->getPost('mobile-number'),
                      $this->request->getPost('password'),$data['role']);   
                  $user = [  
                           'userId'  => $isLoggedIn['id'],
                           'display' => $isLoggedIn['display_name'],
                           'role'    => $isLoggedIn['role'],
                           'email'   => $isLoggedIn['email'] 
                          ];       
                       
                $remember = $this->request->getPost('remember_me'); 
               
                if($isLoggedIn)  
                {     
                      
                      $otpNumber = time();    
                     $this->sendSms(['otp' => $otpNumber],$isLoggedIn['mobile'],'otp');
                     $this->session->setFlashdata('alert',successAlert('OTP sent to your number '.$isLoggedIn['mobile'].' and registered email!'));
                     
                     $this->sendEmail($isLoggedIn['id'],
                        ['publicFolder' => publicFolder(),'otp' => $otpNumber],
                        $isLoggedIn['email'],
                        'Login OTP - PropertyRaja',
                        'otp');   

                      $this->CrudModel->U('_users',['mobile' => $isLoggedIn['mobile']],['otp' => $otpNumber]);
                      if($remember == 1)
                      {
                         $user['remember'] = 1; 
                      }
                      if($this->session->get('sessRedirect'))
                      {
                         $user['redirect'] = $this->session->get('sessRedirect');  
                      }

                      $this->session->set('sessTemp',$user);
                      $this->session->remove('sessRedirect'); 

                      return redirect()->to('/Auth/verify');            
                }else{
                 $this->session->setFlashdata('alert',redAlert('User Not Found'));
                 return redirect()->back()->withInput();
               } 
           }
       }          
		return view('frontend/login-auth',$data);      
	}



	public function login_developer()       
	{
    if(session('role')) 
    {
      return isLoggedIn();
    } 
		$data['title'] = "Developer Login to PropertyRaja";
		$data['role']  = "developer";
	  if($this->request->getGet('redirect')) 
      {
         $this->session->set('sessRedirect',$this->request->getGet('redirect')); 
      } 

       if($this->request->getPost('sign-in'))
       {
           if(! $this->validate([
              'mobile-number' => 'required|min_length[10]|max_length[12]|numeric',  
              'password'      => 'required|min_length[6]|max_length[20]',
           ])){
               $this->session->setFlashdata('alert',redAlert(\Config\Services::validation()->listErrors()));
               return redirect()->back()->withInput();
           }else{
                  $isLoggedIn = $this->AuthModel->login(
                      $this->request->getPost('mobile-number'),
                      $this->request->getPost('password'),$data['role']);   
                  $user = [  
                           'userId'  => $isLoggedIn['id'],
                           'display' => $isLoggedIn['display_name'],
                           'role'    => $isLoggedIn['role'],
                           'email'   => $isLoggedIn['email'] 
                          ];       
                       
                $remember = $this->request->getPost('remember_me'); 
               
                if($isLoggedIn)  
                {     
                      
                       $otpNumber = time();    
                       $this->sendSms(['otp' => $otpNumber],$isLoggedIn['mobile'],'otp');
                       $this->session->setFlashdata('alert',successAlert('OTP sent to your number '.$isLoggedIn['mobile'].' and registered email!'));
      
                     $this->sendEmail($isLoggedIn['id'],
                        ['publicFolder' => publicFolder(),'otp' => $otpNumber],
                        $isLoggedIn['email'],
                        'Login OTP - PropertyRaja',
                        'otp');   

                      $this->CrudModel->U('_users',['mobile' => $isLoggedIn['mobile']],['otp' => $otpNumber]);
                      if($remember == 1)
                      {
                         $user['remember'] = 1; 
                      }
                      if($this->session->get('sessRedirect'))
                      {
                         $user['redirect'] = $this->session->get('sessRedirect');  
                      }  

                      $this->session->set('sessTemp',$user);
                      $this->session->remove('sessRedirect'); 

                      return redirect()->to('/Auth/verify');            
                }else{
                 $this->session->setFlashdata('alert',redAlert('User Not Found'));
                 return redirect()->back()->withInput();
               } 
           }
       }           
		return view('frontend/login-auth',$data);       
	}   




	public function login_staff()
	{

    if(session('role')) 
    {
         return isLoggedIn();
    }  
		$data['title'] = "Staff Login to PropertyRaja";
		$data['role']  = "staff"; 
		if($this->request->getPost('sign-in')){
           if(! $this->validate([
              'username'    => 'required|min_length[5]|max_length[15]',  
              'password'    => 'required|min_length[6]|max_length[20]',
              'access_code' => 'required|min_length[5]|max_length[20]|alpha_numeric',
           ])){
               
           }else{
                $status = $this->AuthModel->backendLogin( 
                	$this->request->getPost('username'),  
                	$this->request->getPost('password'), 
                	$this->request->getPost('access_code'),     
                	$this->request->getPost('role'));  

                if($status){
                   $this->session->set([
                     'userId'  => $status['id'],   
                     'display' => $status['display_name'],    
                     'role'    => $status['role'],
                     'email'   => $status['email']
                   ]);
                   return redirect()->to('/backend/dashboard/index');  
                }else{
                 $this->session->setFlashdata('alert',redAlert('Staff Not Found'));
                 //return redirect()->to('/login-staff');
                  return redirect()->back()->withInput();  
               } 
           }
		} 
    $data['staffRoles'] = $this->UserModel->getAllRolesByRoleType('staff');    
		return view('frontend/login-auth',$data);      
	} 





	public function register()    
	{ 
		   $data['title'] = "Register to PropertyRaja";    

        if($this->request->getPost('sign-up')){  

           if( ! $this->validate([   
              'display-name'  => 'required|max_length[15]', 
              'email'         => 'required|min_length[10]|max_length[30]|valid_email',        
              'mobile-number' => 'required|min_length[10]|max_length[12]|numeric',    
              'password'      => 'required|min_length[6]|max_length[20]'     
           ])){ 
               $this->session->setFlashdata('alert',redAlert(\Config\Services::validation()->listErrors()));
                return redirect()->back()->withInput(); 
           }else{
           	    //     $rolename = $this->request->getPost('rolename');
	              // if($rolename == "developer" || $rolename == "agent"){
	              //    $access_code = strtoupper(uniqid());
	              //   }else{
	              // 	 $access_code = 0;    
	              //   }          
               $uid = $this->AuthModel->register([
          			      'display_name' => $this->request->getPost('display-name'),
                      'username'     => $this->request->getPost('display-name').'.'.time(), 
          			      'email'        => $this->request->getPost('email'),  
          			      'mobile'       => $this->request->getPost('mobile-number'),  
          			      'password'     => $this->request->getPost('password'),
          			      'ip'           => $this->request->getIPAddress(),
          			      //'access_code'  => $access_code,
          			      'role'         => $this->request->getPost('rolename'),
          			      'created_at'  => date('Y-m-d h:i:s'),
                      'updated_at'  => date('Y-m-d h:i:s'),
		                ],[ 
                      'firstname' => "",
                      'lastname'  => "",  
                      'activity'  => $this->request->getPost('purpose'),
                      'created_at'   => date_format(date_create('2020-01-01'), 'Y-m-d h:i:s'), 
    			            'updated_at'   => date_format(date_create('2020-01-01'), 'Y-m-d h:i:s')
		             ]);

                 if($uid)
                 {
                   $agent = $this->request->getUserAgent(); 
                   $this->AuthModel->saveUserSessLog([ 
                          'user_id'    => $uid, 
                          'ip'         => $this->request->getIPAddress(),
                          'user_agent' => $agent->getAgentString(), 
                          'operation'  => "register",  
                          'created_at'  => date('Y-m-d h:i:s'),
                          'updated_at'  => date('Y-m-d h:i:s'),
                   ]);

                   $this->sendEmail(
                    $uid,
                    ['publicFolder' => publicFolder(),'base_url' => base_url()],
                    $this->request->getPost('email'),
                    'Thanks for joining - PropertyRaja','register'
                  );  
                   $this->session->setFlashdata('success',1);    
                 }else{
                   $this->session->setFlashdata('alert',redAlert('Some Error Occurs. Please try later'));
                 } 
		             return redirect()->to('/register'); 
           }
		    }     
		     return view('frontend/register',$data);         
	 }  



   public function forgot_password()  
   { 
       $data['title'] = "Forgot Password | PropertyRaja"; 
       $data['section'] = NULL;
       if($this->request->getPost('submitEmailAndMobile'))
       {
            if( ! $this->validate([        
              'email'  => 'required|min_length[10]|max_length[30]|valid_email',  
           ])){  
               $this->session->setFlashdata('alert','<div class="alert alert-danger">'.\Config\Services::validation()->listErrors().'</div>');
                return redirect()->back()->withInput(); 
           }else{   
                   $array = [
                     'email'  => $this->request->getPost('email')  
                   ];
                   $result = $this->CrudModel->R('_users',['email' => $array['email']]);
                   if(is_array($result) && count($result) == 1)
                   {   
                       $otpNumber = strtoupper(uniqid()); 
                        
                      if($this->sendSms(['otp' => $otpNumber],$result[0]['mobile'],'otp') == TRUE)
                      {
                         $this->session->setFlashdata('alert',successAlert('OTP sent to your number '.$result[0]['mobile'].'</div>'));
                      }else{
                        $this->session->setFlashdata('alert',redAlert('OTP sending failed but you can check on your registered email!'));
                        //return redirect()->back()->withInput(); 
                      }
                      $link = base_url().'/forgot-password/?id='.$result[0]['id']; 
                      $emailData = ['otp' => $otpNumber,'link' => $link,'publicFolder' => publicFolder()]; 

                      $this->sendEmail($uid = $result[0]['id'],$emailData,$to = $result[0]['email'],'OTP Pin | Forgot Password','forgot-password');

                      $this->CrudModel->U('_users',['mobile' => $result[0]['mobile']],['otp' => $otpNumber]);
                      return redirect()->to('/forgot-password/?id='.$result[0]['id']);            
                   } 
           } 
       } 

       if(isset($_GET['id']))       
       {  
          $id = $_GET['id'];    
          $data['section'] = 'hash';         
          if($this->request->getPost('submitOtp'))  
          { 
              $inputOtp = trim($this->request->getPost('inputOtp'));  
              if($this->MessageModel->isOtpValid($id,$inputOtp) ==TRUE)
              {  
                 $this->session->set('section','changePasswordForm'); 
              }else{ 
                $this->session->setFlashdata('alert',redAlert('Wrong Otp Code'));
                return redirect()->back()->withInput();  
              }     
          }
          if(session('section') == 'changePasswordForm') 
          { 
             $data['section'] = 'changePasswordForm';
             if($this->request->getPost('saveNewPassword'))  
             { 
                $newPassword = $this->request->getPost('newPassword');
                $reenterPassword = $this->request->getPost('newPassword2');
                if($newPassword == $reenterPassword)
                {  
                  $this->CrudModel->U('_users',['id' => $id],['password' => $newPassword]);
                  $this->session->setFlashdata('alert',successAlert('Password Changed!'));
                  $this->session->remove('section');
                  $data['section'] = "success";         
                }else{
                  $this->session->setFlashdata('alert',redAlert('Password and Re-enter Password mismatch!'));
                  return redirect()->back()->withInput(); 
                }
             }   
          }    
       }  
      return view('frontend/forgot-password',$data);       
   }      



    public function logout() 
    { 
        delete_cookie('userCookie');       
    	  $array_items = ['userId', 'email','display','role'];
        $this->session->remove($array_items);
        $this->session->setFlashdata('alert','<div class="alert alert-success">Logged out from all devices</div>'); 
        echo "<script>window.location.href='".base_url()."/login'</script>";   
    } 


    public function verify() 
    {   
        $data['title'] = "Enter OTP | PropertyRaja";
        $sessTemp = $this->session->get('sessTemp'); 
        // if(session('userId'))
        // {
        //    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 
        // }  
        if($this->request->getPost('submitOtp'))
        {   
            $inputOtp = trim($this->request->getPost('inputOtp'));  
            if($this->MessageModel->isOtpValid($sessTemp['userId'],$inputOtp) ==TRUE)
            {     
                   $array = array( 
                           'userId'  => $sessTemp['userId'],
                           'display' => $sessTemp['display'],
                           'role'    => $sessTemp['role'],
                           'email'   => $sessTemp['email']
                        );

                    $this->session->set($array);
                    
                   if(array_key_exists('remember', $sessTemp))
                    {   
                        $userCookie = json_encode($array,true);   
                        $userCookie = (string)$userCookie;        
                        set_cookie('userCookie',$userCookie,'3600');        
                    } 
                     
                    $redirect = array_key_exists('redirect', $sessTemp) ? $sessTemp['redirect'] : NULL;   
                    
                    if($sessTemp['role'] == "customer"){ 
                       $link =  ($redirect != NULL) ? base_url() . $redirect : base_url().'/browse';   
                    }elseif($sessTemp['role'] == "agent"){ 
                       $link =  ($redirect != NULL) ? base_url() . $redirect : base_url().'/dashboard';
                    }elseif($sessTemp['role'] == "developer"){ 
                       $link =  ($redirect != NULL) ? base_url() . $redirect : base_url().'/dashboard';
                    } 
                    
                    $this->session->remove('sessTemp'); 
                    echo '<script>window.location.href="'.$link.'"</script>';    

            }else{
                $this->session->setFlashdata('alert','<div class="alert alert-danger">Invalid OTP pin!</div>');
                return redirect()->back()->withInput();
            } 
        } 
      return view('frontend/otp-verify',$data); 
    } 



    public function sendSms($replaceData,$to,$template)       
    {  
       $to  = trim($to); 
       $TemplatesModel = model('TemplatesModel');  
       $template   = $TemplatesModel->getSmsTemplate($template);
       
       $parser = \Config\Services::parser();

       $msg = $parser->setData($replaceData)->renderString($template, ['cascadeData'=>true]);
       
       $status = $this->MessageModel->localTextApi($to,$msg);
       if($status == "success") 
       {
          return true;  
       }    
    }

    

    public function sendEmail($userId = null,$replaceData = null,$to = null,$subject = null,$template = null)      
    {   
       $data['title'] = "PropertyRaja";  
       
       $userDetail = $this->UserModel->getUserDetail($userId);  
       $TemplatesModel = model('TemplatesModel'); 
       $template   = $TemplatesModel->getEmailTemplate($template);    
      
       $parser = \Config\Services::parser();
       $fullname = ucfirst($userDetail['firstname']).' '.ucfirst($userDetail['lastname']);  
       $parse  = [ 
         'name'       => $userDetail['firstname'] ? $fullname : ucfirst($userDetail['display_name']), 
         'os'         => "gg",   
         'browser'    => "gg", 
         'ip'         => get_client_ip(),
         'city'       => currentLocation()['city'],
         'state'      => currentLocation()['state'],
         'country'    => currentLocation()['country'],
         'link'       => base_url() .'/change-password/',  
         'base_url'   => base_url()         
       ];  
       $parse = array_merge($parse,$replaceData);  
       $html  = $parser->setData($parse)->renderString($template, ['cascadeData'=>true]);
       $data['template'] = $html; 
       $msg  = view('email-template/login',$data,['saveData' => true]);
       
       $from = json_decode(getSettings('NoReplyEmail')[0]['setting_json'],true); 
       
       $MessageModel = model('MessageModel'); 
       $status = $MessageModel->sendEmail($from,$userDetail['email'],"","",$subject,$msg);     
       return true;  
    } 

   

   function test() 
   {
        require_once APPPATH . '/Libraries/sendgrid-php/sendgrid-php.php';
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("nishantwp@gmail.com", "PropertyRaja");
        $email->setSubject("Sending with Twilio SendGrid is Fun");
        $email->addTo("algobasket@gmail.com", "algobasket");
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
        );
        $sendgrid = new \SendGrid('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');  
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
   }

   function test2()
   {
        $email = \Config\Services::email(); 
        echo "start";
        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'mail.propertyraja.com'; 
        $config['SMTPUser'] = '_mainaccount@propertyraja.com';
        $config['SMTPPass'] = '*_0#2!9NxWyW'; 
        $config['SMTPPort'] = '587';
        $config['mailType'] = 'html';             
    
        $email->initialize($config);    

        $email->setFrom($config['SMTPUser'],'PropertyRaja'); 
        $email->setTo('algobasket@gmail.com');  
        // if(isset($cc))
        // { 
        //   $email->setCC($cc);   
        // }
        // if(isset($bcc))
        // {
        //   $email->setBCC($bcc); 
        // }
        $email->setSubject("test");
        $email->setMessage("test");
        $status = $email->send(); 
        print_r($status);
   } 

}    	