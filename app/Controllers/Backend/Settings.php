<?php 
namespace App\Controllers\Backend;

use CodeIgniter\Controller;  

class Settings extends BackendController   
{   
   
   function __construct()
   {
      $this->AccountModel   = model('AccountModel');   
      $this->UserModel      = model('UserModel');   
      $this->CrudModel      = model('CrudModel');    
  }  

   function index()
   {
      $data['title']   = "Settings";
      $data['settings'] = $this->CrudModel->R('_settings',NULL);
      $data['section'] = __FUNCTION__;
      return view('backend/settings',$data);
   }



   function add()
   {
      $data['title']   = "Add Setting";
      if($this->request->getPost('setting_submit'))
      {
         $data = [
           'setting_name' => $this->request->getPost('setting_name'),
           'setting_json' => removeSpace($this->request->getPost('setting_json')),
           'created_at'   => date('Y-m-d h:i:s'),
           'updated_at'   => date('Y-m-d h:i:s'), 
           'status'       => 1 
         ];

        $this->CrudModel->C('_settings',$data);  
        $this->session->setFlashdata('alert','<div class="alert alert-success">New Setting Added!</div>');
		return redirect()->to('/backend/settings/'); 
      } 
      $data['section'] = "add";
      return view('backend/settings',$data);
   }



   function edit()
   { 
      $data['title']   = "Edit Setting";
      if($this->request->getPost('setting_submit')) 
      {
         $data = [
           'setting_name' => $this->request->getPost('setting_name'),
           'setting_json' => removeSpace($this->request->getPost('setting_json')),
           'updated_at'   => date('Y-m-d h:i:s'),
           'status'       => $this->request->getPost('status'),
         ];
         $this->CrudModel->U('_settings',['id' => segment(4)],$data);  
         $this->session->setFlashdata('alert','<div class="alert alert-success">Setting Updated!</div>');
		return redirect()->to('/backend/settings/'); 
      }
      $data['settings'] = $this->CrudModel->R('_settings',['id' => segment(4)]); 
      $data['section']  = __FUNCTION__;
      return view('backend/settings',$data);
   }



   function delete()
   { 
   	  $this->CrudModel->D('_settings',['id' => segment(4)]);
   	  $this->session->setFlashdata('alert','<div class="alert alert-danger">Setting Deleted!</div>');
      return redirect()->to('/backend/settings/index');  
   }


}