<?php namespace App\Models;

use CodeIgniter\Model;

class GeographyModel extends Model
{
       protected $users_tb = '_users';
       protected $user_detail_tb = '_user_details';
       protected $users_sess_logs_tb = '_users_session_logs';
       protected $countries = '_countries'; 
       protected $states = '_states'; 
       protected $cities = '_cities';  
       protected $status = '_status';  


    function countries()  
    {
         $builder = $this->db->table($this->countries);
         $builder->select([$this->countries.'.*',$this->status.'.status_name',$this->status.'.status_badge']);
         $builder->join($this->status,$this->status.'.id='.$this->countries.'.status','left');
         $query = $builder->get();
          foreach($query->getResultArray() as $r)
               $data[] = $r; 
          return $data;  
    }   

    function states()  
    {
         $builder = $this->db->table($this->states);
         $builder->select([$this->states.'.*',$this->countries.'.country_name',$this->status.'.status_name',$this->status.'.status_badge']);
         $builder->join($this->countries,$this->countries.'.id='.$this->states.'.country_id','left');
         $builder->join($this->status,$this->status.'.id='.$this->states.'.status','left');
         $query = $builder->get(); 
          foreach($query->getResultArray() as $r)
               $data[] = $r;
          return $data;   
    }   

    function cities()   
    {
         $builder = $this->db->table($this->cities);
         $builder->select([$this->cities.'.*',$this->countries.'.country_name',$this->states.'.state_name',$this->status.'.status_name',$this->status.'.status_badge']);
         $builder->join($this->countries,$this->countries.'.id='.$this->cities.'.country_id','left');
         $builder->join($this->states,$this->states.'.id='.$this->cities.'.state_id','left');
         $builder->join($this->status,$this->status.'.id='.$this->cities.'.status','left');
         $query = $builder->get();
          foreach($query->getResultArray() as $r)
               $data[] = $r;
          return $data;  
    }

    function cityFromCityId($cityId)   
    {
        $builder = $this->db->table($this->cities);
         $builder->where($this->cities.'.id',$cityId);
         $query = $builder->get();
          foreach($query->getResultArray() as $r)
               $data = $r;
          return $data;    
    }  

    function countryCities($countryId)      
    {
         $builder = $this->db->table($this->cities);
         $builder->where($this->cities.'.country_id',$countryId);
         $query = $builder->get();
          foreach($query->getResultArray() as $r)
               $data[] = $r;
          return $data;   
    }     


}

