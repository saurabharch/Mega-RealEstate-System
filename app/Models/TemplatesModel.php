<?php namespace App\Models;

use CodeIgniter\Model;

class TemplatesModel extends Model
{
    protected $template_tb = '_templates';
    

    function templateTypeCount($type)
    {
        $builder = $this->db->table($this->template_tb);
        $builder->select(['template_type','COUNT(template_type) AS template_count']);
        $builder->where('template_type',$type);
        $builder->groupBy('template_type');
        $query = $builder->get();
        return $query->getRowArray()['template_count'];
    }

    function getTemplate($where)
    {
        $builder = $this->db->table($this->template_tb);
        $builder->select('*');      
        $builder->where($where); 
        $builder->groupBy('template_type');
        $query = $builder->get();
        return $query->getRowArray(); 
    }

    function getEmailTemplate($name)    
    {
        $builder = $this->db->table($this->template_tb);
        $builder->select('html_txt');       
        $builder->where(['template_type' => 'email_templates','title' => $name]);
        $query = $builder->get(); 
        return $query->getRowArray()['html_txt'];
    }

    function getSmsTemplate($name)    
    {
        $builder = $this->db->table($this->template_tb);
        $builder->select('html_txt');       
        $builder->where(['template_type' => 'sms_templates','title' => $name]);
        $query = $builder->get();  
        return $query->getRowArray()['html_txt'];
    }


} 