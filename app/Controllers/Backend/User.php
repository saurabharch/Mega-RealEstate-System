<?php 
namespace App\Controllers\Backend;

use CodeIgniter\Controller;  

class User extends BackendController   
{   
  

  
  function __construct()
  {
      $this->AccountModel   = model('AccountModel');   
      $this->UserModel      = model('UserModel');   
      $this->CrudModel      = model('CrudModel');    
      $this->PropertyModel  = model('PropertyModel');     
      $this->GeographyModel  = model('GeographyModel');
      helper('property');       
      helper('inflector');            
  }   


  function index() 
  {
    $data['title'] = "User";
    return view('backend/user',$data);
  }



  function leads() 
  {
    $data['title'] = "Leads";

       if($this->request->getPost('editLead')) 
        {   
            $data = [
              'user_id'           => $this->request->getPost('user_id'), 
              'property_id'       => $this->request->getPost('property_id'),
              'lead_source_id'    => $this->request->getPost('lead_source_id'),
              'lead_source_link'  => $this->request->getPost('lead_source_link'),
              'updated_at' => date('Y-m-d h:i:s'), 
              'status'     => $this->request->getPost('status')
            ];
            $result = $this->CrudModel->U('_interested',['id' => Segment(5)],$data);
            if($result == true)
            {  
               $this->session->setFlashdata('alert',successAlert('Lead Updated'));
               return redirect()->to('/backend/user/leads');
            }
        } 
       if($this->request->getPost('addLead')) 
       {    
            $data = [ 
                  'user_id'           => $this->request->getPost('user_id'), 
                  'property_id'       => $this->request->getPost('property_id'),
                  'lead_source_id'    => $this->request->getPost('lead_source_id'),
                  'lead_source_link'  => $this->request->getPost('lead_source_link'),
                  'created_at' => date('Y-m-d h:i:s'), 
                  'updated_at' => date('Y-m-d h:i:s'),
                  'status'     => $this->request->getPost('status') 
                ]; 
            $result = $this->CrudModel->C('_interested',$data);    
            if($result == true) 
            {  
               $this->session->setFlashdata('alert',successAlert('Lead Added'));
               return redirect()->to('/backend/user/leads');
            } 
       } 
       $data['section']    = segment(4);
       if($data['section'] == "edit")
       {  
           $data['lead'] = $this->UserModel->getLeads(null,segment(5))[0]; 
       }
       if($data['section'] == "delete")
       {   
           $this->CrudModel->D('_interested',['id' => Segment(5)]);
           $this->session->setFlashdata('alert',redAlert('Lead Deleted'));
           return redirect()->to('/backend/user/leads'); 
       }  
       $data['getLeads']   = $this->UserModel->getLeads(null,null); 
       $data['allStatus']  = $this->AccountModel->allStatus(); 
       $data['leadSource'] = $this->UserModel->leadSource();     
       return view('backend/leads',$data);    
  }



  function agents()  
  {
     $data['title'] = "Agent"; 
     $data['section'] = segment(4);

    if($data['section'] == "profile"){ 
     
      $data['profile'] = $this->UserModel->getUserDetail(segment(5)); 
      $total_sold = $this->PropertyModel->totalPropertiesSoldByUser(segment(5));
      $data['total_sold'] = $total_sold ? $total_sold : 0;

    }elseif($data['section'] == "edit"){
        
        if($this->request->getPost('uploadProfilePic'))
        {
              $exts = ['jpg','png','webp','jpeg','JPG','PNG','JPEG','WEBP']; 
               if($imagefile = $this->request->getFiles()) 
          {  $i = 0;
             foreach($imagefile['images'] as $img) 
             {
                if ($img->isValid() && ! $img->hasMoved())
                {      
                       if(in_array($img->getClientExtension(),$exts))
                       {          
                               if($img->getSizeByUnit('mb') > 4)  
                               {
                                     $invalid_size =  "Please upload image between 1MB-4MB"; 
                               }else{
                                                   $newName = $img->getRandomName();
                               if($img->move(WRITEPATH.'../public/user-images', $newName))
                               { 
                                      $this->AccountModel->removeUserProfilePic(segment(5)); 

                                      $insert = [
                                                  'profile_pic' => $newName,     
                                                  'updated_at'  => date('Y-m-d h:i:s')                                         
                                      ];  
                                   $this->CrudModel->U('_user_details',['user_id' => segment(5)],$insert); 
                                   
                                                      $image = \Config\Services::image()
                              ->withFile(WRITEPATH.'../public/user-images/'.$newName)  
                              ->fit(200, 200, 'center')
                              ->save(WRITEPATH.'../public/user-images/thumbnails/'.$newName);   

                                   $i++;   
                                 } 
                                 
                              }
                                           
                       }else{
                              $invalid_ext = $img->getClientExtension() . " - Invalid image extension";
                       }
                     
                }
             }
          }

           if($i > 0) 
           { 
              $this->session->setFlashdata('alert',successAlert('Your Profile image uploaded!'));
           }            
           if(@$invalid_ext)
           {
              $this->session->setFlashdata('alert',redAlert($invalid_ext));  
           }
           if(@$invalid_size)
           {
              $this->session->setFlashdata('alert',redAlert($invalid_size));   
           }
              return redirect()->to('/backend/user/agents/edit/'.segment(5));
        } //Upload End

        if($this->request->getPost('update_profile'))
        {
             if(! $this->validate([
              'firstname'    => 'required|min_length[1]|max_length[20]|alpha',  
              'lastname'     => 'required|min_length[1]|max_length[20]|alpha',
              'display_name' => 'required|min_length[2]|max_length[20]',
              'username'    => 'required|min_length[0]|max_length[15]',
              'mobile'      => 'min_length[10]|max_length[15]|numeric',
              'email'       => 'min_length[5]|max_length[40]|valid_email', 
              'address1'    => 'min_length[5]|max_length[100]',
              'address2'    => 'min_length[0]|max_length[100]'  
           ])){
                 $this->session->setFlashdata('alert','<div class="alert alert-danger">'.\Config\Services::validation()->listErrors().'</div>');
        
           }else{
             $toUpdate = [ 
                  'display_name' => $this->request->getPost('display_name'),
                  'username'     => $this->request->getPost('username'),
                  'mobile'       => $this->request->getPost('mobile'),
                  'email'        => $this->request->getPost('email'),
                  'status'       => $this->request->getPost('status')  
             ];
             $toUpdate2 = [
                 'firstname' => $this->request->getPost('firstname'),
                 'lastname'  => $this->request->getPost('lastname'),
                 'address1'  => $this->request->getPost('address1'),  
                 'address2'  => $this->request->getPost('address2'),
                 'country'   => $this->request->getPost('country'),
                 'state'     => $this->request->getPost('state'), 
                 'city'      => $this->request->getPost('city'),   
                 'activity'  => $this->request->getPost('myActivity'),
                 'specialities'  => $this->request->getPost('specialities'),  
                 'experience'  => $this->request->getPost('experience'),  
                 'website'  => $this->request->getPost('website'),  
                 'linkedin'  => $this->request->getPost('linkedin'),  
                 'twitter'  => $this->request->getPost('twitter'),  
                 'facebook'  => $this->request->getPost('facebook'),  
                 'instagram'  => $this->request->getPost('instagram'),  
                 'blog'  => $this->request->getPost('blog'),  
                 'english_level'  => $this->request->getPost('english_level'),  
                 're_license_no'  => $this->request->getPost('re_license_no'),   
                 'service_area'  => json_encode($this->request->getPost('service_area'),true),
                 'updated_at' => date('Y-m-d h:i:s')    
             ];  
             $this->CrudModel->U('_users',['id' => segment(5)],$toUpdate); 
             $this->CrudModel->U('_user_details',['user_id' => segment(5)],$toUpdate2);
             $this->session->setFlashdata('alert',successAlert('Agent profile updated!'));
             return redirect()->to('/backend/user/agents/edit/'.segment(5));  
           } 
        } 
            $data['profile']   = $this->AccountModel->getProfileDetail(segment(5)); 
            $data['countries'] = $this->GeographyModel->countries();
            $data['states']    = $this->GeographyModel->states();
            $data['cities']    = $this->GeographyModel->cities();
            $total_sold = $this->PropertyModel->totalPropertiesSoldByUser(segment(5));
            $data['total_sold'] = $total_sold ? $total_sold : 0 ;  
    }else{

      $data['agents'] = $this->UserModel->getAllUsersByRole('agent');  

    }
    return view('backend/agents',$data);
  }



  function developers()   
  {
    $data['title'] = "Developer";
    $data['section'] = segment(4); 
    
    if($data['section'] == "profile"){   
     
      $data['profile'] = $this->UserModel->getUserDetail(segment(5));  

    }elseif($data['section'] == "edit"){
        
        if($this->request->getPost('uploadProfilePic'))
        {
              $exts = ['jpg','png','webp','jpeg','JPG','PNG','JPEG','WEBP']; 
               if($imagefile = $this->request->getFiles()) 
          {  $i = 0;
             foreach($imagefile['images'] as $img) 
             {
                if ($img->isValid() && ! $img->hasMoved())
                {      
                       if(in_array($img->getClientExtension(),$exts))
                       {          
                               if($img->getSizeByUnit('mb') > 4) 
                               {
                                              $invalid_size =  "Please upload image between 1MB-4MB"; 
                               }else{
                                                   $newName = $img->getRandomName();
                               if($img->move(WRITEPATH.'../public/user-images', $newName))
                               { 
                                      $this->AccountModel->removeUserProfilePic(segment(5)); 

                                      $insert = [
                                                  'profile_pic' => $newName,     
                                                  'updated_at'  => date('Y-m-d h:i:s')                                         
                                      ];  
                                   $this->CrudModel->U('_user_details',['user_id' => segment(5)],$insert); 
                                   
                                                      $image = \Config\Services::image()
                              ->withFile(WRITEPATH.'../public/user-images/'.$newName)  
                              ->fit(200, 200, 'center')
                              ->save(WRITEPATH.'../public/user-images/thumbnails/'.$newName);   

                                   $i++;  
                                 } 
                                 
                              }
                                           
                       }else{
                              $invalid_ext = $img->getClientExtension() . " - Invalid image extension";
                       }  
                }
             }
          }

           if($i > 0) 
           { 
              $this->session->setFlashdata('alert',successAlert('Your Profile image uploaded!'));
           }            
           if(@$invalid_ext)
           {
              $this->session->setFlashdata('alert',redAlert($invalid_ext));  
           }
           if(@$invalid_size)
           {
              $this->session->setFlashdata('alert',redAlert($invalid_size));   
           }
              return redirect()->to('/backend/user/customers/edit/'.segment(5));
        }

        if($this->request->getPost('update_profile'))
        {
             if(! $this->validate([
              'firstname'    => 'required|min_length[1]|max_length[20]|alpha',  
              'lastname'     => 'required|min_length[1]|max_length[20]|alpha',
              'display_name' => 'required|min_length[2]|max_length[30]',
              'username'    => 'required|min_length[0]|max_length[50]',
              'mobile'      => 'min_length[10]|max_length[15]|numeric',
              'email'       => 'min_length[5]|max_length[40]|valid_email', 
              'address1'    => 'min_length[5]|max_length[100]',
              'address2'    => 'min_length[0]|max_length[100]'  
           ])){
                 $this->session->setFlashdata('alert','<div class="alert alert-danger">'.\Config\Services::validation()->listErrors().'</div>');
        
           }else{
             $toUpdate = [ 
                  'display_name' => $this->request->getPost('display_name'),
                  'username'     => $this->request->getPost('username'),
                  'mobile'       => $this->request->getPost('mobile'),
                  'email'        => $this->request->getPost('email'), 
                  'status'       => $this->request->getPost('status')   
             ];
             $toUpdate2 = [
                 'firstname' => $this->request->getPost('firstname'),
                 'lastname'  => $this->request->getPost('lastname'),
                 'address1'  => $this->request->getPost('address1'),  
                 'address2'  => $this->request->getPost('address2'),
                 'country'   => $this->request->getPost('country'),
                 'state'     => $this->request->getPost('state'), 
                 'city'      => $this->request->getPost('city'),   
                 'activity'  => $this->request->getPost('myActivity'),
                 'specialities'  => $this->request->getPost('specialities'),  
                 'experience'  => $this->request->getPost('experience'),  
                 'website'  => $this->request->getPost('website'),  
                 'linkedin'  => $this->request->getPost('linkedin'),  
                 'twitter'  => $this->request->getPost('twitter'),  
                 'facebook'  => $this->request->getPost('facebook'),  
                 'instagram'  => $this->request->getPost('instagram'),  
                 'blog'  => $this->request->getPost('blog'),  
                 'english_level'  => $this->request->getPost('english_level'),  
                 're_license_no'  => $this->request->getPost('re_license_no'),   
                 'service_area'  => json_encode($this->request->getPost('service_area'),true),
                 'updated_at' => date('Y-m-d h:i:s')     
             ];  
             $this->CrudModel->U('_users',['id' => segment(5)],$toUpdate); 
             $this->CrudModel->U('_user_details',['user_id' => segment(5)],$toUpdate2);
             $this->session->setFlashdata('alert',successAlert('Agent profile updated!'));
             return redirect()->to('/backend/user/customers/edit/'.segment(5));  
           } 
        } 
            $data['profile']   = $this->AccountModel->getProfileDetail(segment(5));  
            $data['countries'] = $this->GeographyModel->countries();
            $data['states']    = $this->GeographyModel->states();
            $data['cities']    = $this->GeographyModel->cities();
            $total_sold = $this->PropertyModel->totalPropertiesSoldByUser(segment(5));
            $data['total_sold'] = $total_sold ? $total_sold : 0 ;   
    }else{ 

      $data['cRole'] = $this->request->getGet('role') ? $this->request->getGet('role') : "developer"; 
      $data['rs_developers'] = $this->UserModel->getAllUsersByRole($data['cRole']);       
    } 
    return view('backend/developers',$data);  
  }


  function customers()
  {
     $data['title'] = "Buyers/Owners"; 
     $data['section'] = segment(4); 

    if($data['section'] == "profile"){ 
     
      $data['profile'] = $this->UserModel->getUserDetail(segment(5));  

    }elseif($data['section'] == "edit"){
        
        if($this->request->getPost('uploadProfilePic'))
        {
              $exts = ['jpg','png','webp','jpeg','JPG','PNG','JPEG','WEBP']; 
               if($imagefile = $this->request->getFiles()) 
          {  $i = 0;
             foreach($imagefile['images'] as $img) 
             {
                if ($img->isValid() && ! $img->hasMoved())
                {      
                       if(in_array($img->getClientExtension(),$exts))
                       {          
                               if($img->getSizeByUnit('mb') > 4) 
                               {
                                              $invalid_size =  "Please upload image between 1MB-4MB"; 
                               }else{
                                                   $newName = $img->getRandomName();
                               if($img->move(WRITEPATH.'../public/user-images', $newName))
                               { 
                                      $this->AccountModel->removeUserProfilePic(segment(5)); 

                                      $insert = [
                                                  'profile_pic' => $newName,     
                                                  'updated_at'  => date('Y-m-d h:i:s')                                         
                                      ];  
                                   $this->CrudModel->U('_user_details',['user_id' => segment(5)],$insert); 
                                   
                                                      $image = \Config\Services::image()
                              ->withFile(WRITEPATH.'../public/user-images/'.$newName)  
                              ->fit(200, 200, 'center')
                              ->save(WRITEPATH.'../public/user-images/thumbnails/'.$newName);   

                                   $i++;  
                                 } 
                                 
                              }
                                           
                       }else{
                              $invalid_ext = $img->getClientExtension() . " - Invalid image extension";
                       }  
                }
             }
          }

           if($i > 0) 
           { 
              $this->session->setFlashdata('alert',successAlert('Your Profile image uploaded!'));
           }            
           if(@$invalid_ext)
           {
              $this->session->setFlashdata('alert',redAlert($invalid_ext));  
           }
           if(@$invalid_size)
           {
              $this->session->setFlashdata('alert',redAlert($invalid_size));   
           }
              return redirect()->to('/backend/user/customers/edit/'.segment(5));
        }

        if($this->request->getPost('update_profile'))
        {
             if(! $this->validate([
              'firstname'    => 'required|min_length[1]|max_length[20]|alpha',  
              'lastname'     => 'required|min_length[1]|max_length[20]|alpha',
              'display_name' => 'required|min_length[2]|max_length[30]',   
              'username'    => 'required|min_length[0]|max_length[50]',
              'mobile'      => 'min_length[10]|max_length[15]|numeric',
              'email'       => 'min_length[5]|max_length[40]|valid_email', 
              'address1'    => 'min_length[5]|max_length[100]',
              'address2'    => 'min_length[0]|max_length[100]'  
           ])){
                 $this->session->setFlashdata('alert','<div class="alert alert-danger">'.\Config\Services::validation()->listErrors().'</div>');
        
           }else{
             $toUpdate = [ 
                  'display_name' => $this->request->getPost('display_name'),
                  'username'     => $this->request->getPost('username'),
                  'mobile'       => $this->request->getPost('mobile'),
                  'email'        => $this->request->getPost('email'), 
                  'status'       => $this->request->getPost('status')   
             ];
             $toUpdate2 = [
                 'firstname' => $this->request->getPost('firstname'),
                 'lastname'  => $this->request->getPost('lastname'),
                 'address1'  => $this->request->getPost('address1'),  
                 'address2'  => $this->request->getPost('address2'),
                 'country'   => $this->request->getPost('country'),
                 'state'     => $this->request->getPost('state'), 
                 'city'      => $this->request->getPost('city'),   
                 'activity'  => $this->request->getPost('myActivity'),
                 'specialities'  => $this->request->getPost('specialities'),  
                 'experience'  => $this->request->getPost('experience'),  
                 'website'  => $this->request->getPost('website'),  
                 'linkedin'  => $this->request->getPost('linkedin'),  
                 'twitter'  => $this->request->getPost('twitter'),  
                 'facebook'  => $this->request->getPost('facebook'),  
                 'instagram'  => $this->request->getPost('instagram'),  
                 'blog'  => $this->request->getPost('blog'),  
                 'english_level'  => $this->request->getPost('english_level'),  
                 're_license_no'  => $this->request->getPost('re_license_no'),   
                 'service_area'  => json_encode($this->request->getPost('service_area'),true),
                 'updated_at' => date('Y-m-d h:i:s')     
             ];  
             $this->CrudModel->U('_users',['id' => segment(5)],$toUpdate); 
             $this->CrudModel->U('_user_details',['user_id' => segment(5)],$toUpdate2);
             $this->session->setFlashdata('alert',successAlert('Agent profile updated!'));
             return redirect()->to('/backend/user/customers/edit/'.segment(5));  
           } 
        } 
            $data['profile']   = $this->AccountModel->getProfileDetail(segment(5)); 
            $data['countries'] = $this->GeographyModel->countries();
            $data['states']    = $this->GeographyModel->states();
            $data['cities']    = $this->GeographyModel->cities();
            $total_sold = $this->PropertyModel->totalPropertiesSoldByUser(segment(5));
            $data['total_sold'] = $total_sold ? $total_sold : 0 ;   
    }elseif($data['section'] == "add"){ 
      if($this->request->getPost('addCustomer'))  
        { 
             if(! $this->validate([
              'firstname'    => 'required|min_length[1]|max_length[20]|alpha',  
              'lastname'     => 'required|min_length[1]|max_length[20]|alpha',
              'mobile'      => 'min_length[10]|max_length[15]|numeric',
              'email'       => 'min_length[5]|max_length[40]|valid_email', 
              'address1'    => 'min_length[5]|max_length[100]',
              'address2'    => 'min_length[0]|max_length[100]'  
           ])){
                 $this->session->setFlashdata('alert','<div class="alert alert-danger">'.\Config\Services::validation()->listErrors().'</div>'); 
           }else{
             $toUpdate = [ 
                  'display_name' => $this->request->getPost('display_name'),
                  'username'     => $this->request->getPost('username'),
                  'mobile'       => $this->request->getPost('mobile'),
                  'email'        => $this->request->getPost('email'), 
                  'status'       => $this->request->getPost('status')   
             ];
             $toUpdate2 = [
                 'firstname' => $this->request->getPost('firstname'),
                 'lastname'  => $this->request->getPost('lastname'),
                 'address1'  => $this->request->getPost('address1'),  
                 'address2'  => $this->request->getPost('address2'),
                 'country'   => $this->request->getPost('country'),
                 'state'     => $this->request->getPost('state'), 
                 'city'      => $this->request->getPost('city'),   
                 'activity'  => $this->request->getPost('myActivity'),
                 'specialities'  => $this->request->getPost('specialities'),  
                 'experience'  => $this->request->getPost('experience'),  
                 'website'  => $this->request->getPost('website'),  
                 'linkedin'  => $this->request->getPost('linkedin'),  
                 'twitter'  => $this->request->getPost('twitter'),  
                 'facebook'  => $this->request->getPost('facebook'),  
                 'instagram'  => $this->request->getPost('instagram'),  
                 'blog'  => $this->request->getPost('blog'),  
                 'english_level'  => $this->request->getPost('english_level'),  
                 're_license_no'  => $this->request->getPost('re_license_no'),   
                 'service_area'  => json_encode($this->request->getPost('service_area'),true),
                 'updated_at' => date('Y-m-d h:i:s')     
             ];  
             $userId = $this->AuthModel->register($toUpdate,$toUpdate2); 
             $this->session->setFlashdata('alert',successAlert('Staff Account Created!'));
             return redirect()->to('/backend/user/staff/edit/'.$userId);     
           } 
        } 
    }elseif($data['section'] == "delete"){
       $this->CrudModel->D('_users',['id' => segment(5)]); 
       $this->session->setFlashdata('alert',redAlert("Customer's Record Deleted!"));
       return redirect()->to('/backend/user/customers');  
    }else{ 

      $data['customers'] = $this->UserModel->getAllUsersByRole('customer');  

    }
     return view('backend/customers',$data);  
  }



  function staff()   
  {
    $data['title'] = "Staff";

     $data['section'] = segment(4); 

    if($data['section'] == "profile"){ 
     
      $data['profile'] = $this->UserModel->getUserDetail(segment(5));  

    }elseif($data['section'] == "edit"){
        
        if($this->request->getPost('uploadProfilePic'))
        {
              $exts = ['jpg','png','webp','jpeg','JPG','PNG','JPEG','WEBP']; 
               if($imagefile = $this->request->getFiles()) 
          {  $i = 0;
             foreach($imagefile['images'] as $img) 
             {
                if ($img->isValid() && ! $img->hasMoved())
                {      
                       if(in_array($img->getClientExtension(),$exts))
                       {          
                               if($img->getSizeByUnit('mb') > 4) 
                               {
                                              $invalid_size =  "Please upload image between 1MB-4MB"; 
                               }else{
                                                   $newName = $img->getRandomName();
                               if($img->move(WRITEPATH.'../public/user-images', $newName))
                               { 
                                      $this->AccountModel->removeUserProfilePic(segment(5)); 

                                      $insert = [
                                                  'profile_pic' => $newName,     
                                                  'updated_at'  => date('Y-m-d h:i:s')                                         
                                      ];  
                                   $this->CrudModel->U('_user_details',['user_id' => segment(5)],$insert); 
                                   
                                                      $image = \Config\Services::image()
                              ->withFile(WRITEPATH.'../public/user-images/'.$newName)  
                              ->fit(200, 200, 'center')
                              ->save(WRITEPATH.'../public/user-images/thumbnails/'.$newName);   

                                   $i++;  
                                 } 
                                 
                              }
                                           
                       }else{
                              $invalid_ext = $img->getClientExtension() . " - Invalid image extension";
                       }  
                }
             }
          }

           if($i > 0) 
           { 
              $this->session->setFlashdata('alert',successAlert('Your Profile image uploaded!'));
           }            
           if(@$invalid_ext)
           {
              $this->session->setFlashdata('alert',redAlert($invalid_ext));  
           }
           if(@$invalid_size)
           {
              $this->session->setFlashdata('alert',redAlert($invalid_size));   
           }
              return redirect()->to('/backend/user/staff/edit/'.segment(5));
        }

        if($this->request->getPost('update_profile'))
        {
             if(! $this->validate([
              'firstname'    => 'required|min_length[1]|max_length[20]|alpha',  
              'lastname'     => 'required|min_length[1]|max_length[20]|alpha',
              'display_name' => 'required|min_length[2]|max_length[30]',
              'username'    => 'required|min_length[0]|max_length[50]',
              'mobile'      => 'min_length[10]|max_length[15]|numeric',
              'email'       => 'min_length[5]|max_length[40]|valid_email', 
              'address1'    => 'min_length[5]|max_length[100]',
              'address2'    => 'min_length[0]|max_length[100]'  
           ])){
                 $this->session->setFlashdata('alert','<div class="alert alert-danger">'.\Config\Services::validation()->listErrors().'</div>');
        
           }else{
             $toUpdate = [ 
                  'display_name' => $this->request->getPost('display_name'),
                  'username'     => $this->request->getPost('username'),
                  'mobile'       => $this->request->getPost('mobile'),
                  'email'        => $this->request->getPost('email'), 
                  'status'       => $this->request->getPost('status')   
             ];
             $toUpdate2 = [
                 'firstname' => $this->request->getPost('firstname'),
                 'lastname'  => $this->request->getPost('lastname'),
                 'address1'  => $this->request->getPost('address1'),  
                 'address2'  => $this->request->getPost('address2'),
                 'country'   => $this->request->getPost('country'),
                 'state'     => $this->request->getPost('state'), 
                 'city'      => $this->request->getPost('city'),   
                 'activity'  => $this->request->getPost('myActivity'),
                 'specialities'  => $this->request->getPost('specialities'),  
                 'experience'  => $this->request->getPost('experience'),  
                 'website'  => $this->request->getPost('website'),  
                 'linkedin'  => $this->request->getPost('linkedin'),  
                 'twitter'  => $this->request->getPost('twitter'),  
                 'facebook'  => $this->request->getPost('facebook'),  
                 'instagram'  => $this->request->getPost('instagram'),  
                 'blog'  => $this->request->getPost('blog'),  
                 'english_level'  => $this->request->getPost('english_level'),  
                 're_license_no'  => $this->request->getPost('re_license_no'),   
                 'service_area'  => json_encode($this->request->getPost('service_area'),true),
                 'updated_at' => date('Y-m-d h:i:s')     
             ];  
             $this->CrudModel->U('_users',['id' => segment(5)],$toUpdate); 
             $this->CrudModel->U('_user_details',['user_id' => segment(5)],$toUpdate2);
             $this->session->setFlashdata('alert',successAlert('Agent profile updated!'));
             return redirect()->to('/backend/user/staff/edit/'.segment(5));  
           } 
        } 
            $data['profile']   = $this->AccountModel->getProfileDetail(segment(5)); 
            $total_sold = $this->PropertyModel->totalPropertiesSoldByUser(segment(5));
            $data['total_sold'] = $total_sold ? $total_sold : 0 ;     
    }elseif($data['section'] == "add"){ 
      if($this->request->getPost('addStaff'))  
        { 
             if(! $this->validate([
              'firstname'    => 'required|min_length[1]|max_length[20]|alpha',  
              'lastname'     => 'required|min_length[1]|max_length[20]|alpha',
              'display_name' => 'required|min_length[2]|max_length[30]',
              'username'    => 'required|min_length[0]|max_length[50]',
              'mobile'      => 'min_length[10]|max_length[15]|numeric',
              'email'       => 'min_length[5]|max_length[40]|valid_email', 
              'address1'    => 'min_length[5]|max_length[100]',
              'address2'    => 'min_length[0]|max_length[100]'  
           ])){
                 $this->session->setFlashdata('alert','<div class="alert alert-danger">'.\Config\Services::validation()->listErrors().'</div>');
        
           }else{
             $toUpdate = [ 
                  'display_name' => $this->request->getPost('display_name'),
                  'username'     => $this->request->getPost('username'),
                  'mobile'       => $this->request->getPost('mobile'),
                  'email'        => $this->request->getPost('email'), 
                  'status'       => $this->request->getPost('status')   
             ];
             $toUpdate2 = [
                 'firstname' => $this->request->getPost('firstname'),
                 'lastname'  => $this->request->getPost('lastname'),
                 'address1'  => $this->request->getPost('address1'),  
                 'address2'  => $this->request->getPost('address2'),
                 'country'   => $this->request->getPost('country'),
                 'state'     => $this->request->getPost('state'), 
                 'city'      => $this->request->getPost('city'),   
                 'activity'  => $this->request->getPost('myActivity'),
                 'specialities'  => $this->request->getPost('specialities'),  
                 'experience'  => $this->request->getPost('experience'),  
                 'website'  => $this->request->getPost('website'),  
                 'linkedin'  => $this->request->getPost('linkedin'),  
                 'twitter'  => $this->request->getPost('twitter'),  
                 'facebook'  => $this->request->getPost('facebook'),  
                 'instagram'  => $this->request->getPost('instagram'),  
                 'blog'  => $this->request->getPost('blog'),  
                 'english_level'  => $this->request->getPost('english_level'),  
                 're_license_no'  => $this->request->getPost('re_license_no'),   
                 'service_area'  => json_encode($this->request->getPost('service_area'),true),
                 'updated_at' => date('Y-m-d h:i:s')     
             ];  
             $userId = $this->AuthModel->register($toUpdate,$toUpdate2); 
             $this->session->setFlashdata('alert',successAlert('Staff Account Created!'));
             return redirect()->to('/backend/user/staff/edit/'.$userId);     
           } 
        } 
    }else{  
      $data['cRole'] = $this->request->getGet('role') ? $this->request->getGet('role') : "admin";
      $data['staff'] = $this->UserModel->getAllUsersByRole($data['cRole']);   
    }
    $data['countries'] = $this->GeographyModel->countries();
    $data['states']    = $this->GeographyModel->states();
    $data['cities']    = $this->GeographyModel->cities();  
    return view('backend/staff-members',$data);  
  } 



   function tickets()   
   {
    $data['title'] = "Tickets";
    $data['allTickets'] = $this->TicketModel->allTickets(); 
    return view('backend/tickets',$data);  
   }



   function reviews()   
   {
     $data['title'] = "Reviews";  
     return view('backend/reviews',$data);  
   } 
   

   function userDropdownList()
   {  
      $txt = $this->request->getPost('txt');
      $result = $this->UserModel->searchUser($txt); 
      
          echo '<ul class="list-unstyled">';
          foreach($result as $r)
         {
          echo '<li class="media hover" onClick="searchedUser('.$r['id'].')">
                  <img src="'.base_url().'/images/user.png" class="mr-3" alt="...">
                  <div class="media-body">
                    <h5 class="mt-0 mb-1">'.$r['firstname'].'</h5>
                    '.$r['mobile'].'
                  </div>
                </li>'; 
          }          
          echo '</ul>';                                                                       
   }


   function rolePermissions()    
   { 
      
      $data['title'] = "Role Permissions";
      $section = segment(4);
     
     if($section == "add")
     {  
        if($this->request->getPost('addRolePermission'))
        {
           $access = trim($this->request->getPost('access'));
           $array  = explode(',',$access);
           $json   = json_encode($array,true);
           $this->CrudModel->C('_user_role_access',[
            'role'   => $this->request->getPost('role'),
            'access' => $json,
            'status' => $this->request->getPost('status'),
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s') 
           ]);
           $this->session->setFlashdata('alert',successAlert('New Role Permission Added!'));
           return redirect()->to('/backend/user/rolePermissions/add');    
        }
        $data['section'] = "add";
     }

     if($section == "edit")
     {  
        $data['section'] = "edit";
        if($this->request->getPost('editRolePermission'))
        {
           $access = trim($this->request->getPost('access'));
           $array  = explode(',',$access);
           $json   = json_encode($array,true);
           $this->CrudModel->U(
            '_user_role_access',
            ['id' => segment(5)],
            [
              'role'   => $this->request->getPost('role'),
              'access' => $json,
              'status' => $this->request->getPost('status'),
              'updated_at' => date('Y-m-d h:i:s') 
           ]);   
           $this->session->setFlashdata('alert',successAlert('Role Permission Updated!'));
           return redirect()->to('/backend/user/rolePermissions/edit/'.segment(5));     
        }
        $data['rolePermissions'] = $this->UserModel->userRolePermissions(segment(5));
     }

     if($section == "")
     {  
        $data['section'] = NULL; 
        $data['rolePermissions'] = $this->UserModel->userRolePermissions(); 
     }

     if($section == "delete")
     {
        $this->CrudModel->D('_user_role_access',['id' => segment(5)]);
        $this->session->setFlashdata('alert',redAlert('Role Permission Deleted!'));
        return redirect()->to('/backend/user/rolePermissions');    
     }    
     return view('backend/role-permissions',$data);   
   }


}