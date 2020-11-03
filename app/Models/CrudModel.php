<?php namespace App\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{  
    


    // ***** Basic CRUD Operation *****
   


    /***** Create*****/ 

    function C($table,$data)
    {
        $builder = $this->db->table($table);
        $builder->insert($data);
        return true;    
    } 
      



     /***** Read*****/

    function R($table,$where) 
    {  
       $builder = $this->db->table($table); 
       $builder->select('*');
       if($where != NULL || $where != ""){  $builder->where($where); };

       $query = $builder->get(); 
        if(!empty($query->getResultArray()))
        {
           foreach($query->getResultArray() as $r)
             $data[]  = $r;

           return $data; 
        }    
    }
    



    /***** Update*****/


    function U($table = NULL,$where = NULL,$data = NULL) 
    {   
        $builder = $this->db->table($table); 
        $builder->where($where);
        $builder->update($data);
        return true;   
    }  



   /***** Delete*****/


    function D($table,$where)
    {
        $builder = $this->db->table($table); 
        $builder->where($where);
        $builder->delete();
        return true;   
    }





  // ***** Advanced CRUD Operation *****  



    /***** Read Once*****/


    function RO($table,$where)
    {  
       $builder = $this->db->table($table); 
       $builder->select('*');
       if($where != NULL || $where != ""){  $builder->where($where); };

       $query = $builder->get(); 
        if(!empty($query->getResultArray()))
        {
           foreach($query->getResultArray() as $r)
             $data  = $r;

           return $data; 
        }    
    }


 }   