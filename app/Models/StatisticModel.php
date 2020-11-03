<?php namespace App\Models;

use CodeIgniter\Model;

class StatisticModel extends Model
{   
    protected $properties_tb     = '_properties'; 
    protected $property_sales_tb = '_sales';  
    protected $settings_tb       = '_settings';
    protected $status            = '_status';   
    

    function profitByEachPropertyByUser($userId)    
    {
         $PropertyModel = model('PropertyModel');
         $properties = $PropertyModel->getPropertiesByUserId($userId);
         $data = array();
         if(is_array($properties))
         {
           foreach($properties as $property){
             if($property['listing_type'] == "sell")
             {
                 $profit = $property['total_price'] - $property['old_total_price'];
             }
             if($property['listing_type'] == "rent") 
             {
                 $profit  = $property['rent_per_mon'] - $property['old_total_price'];  
             }
             $property['profit'] = $profit;
             $data[] = $property;
           }
           return $data;
         }
    }

    function targetAmountByEachPropertyByUser($type)  
    {
         // $builder = $this->db->table($this->settings_tb);
         // $builder->select([$this->settings_tb.'.*',$this->status.'.status_name',$this->status.'.status_badge']);
         // $builder->join($this->status,$this->status.'.id='.$this->settings_tb.'.status','left');
         // $builder->whereIn($this->settings_tb.'.setting_type',$type);
         // $query = $builder->get();
         //  foreach($query->getResultArray() as $r) 
         //       $data[] = $r; 
         //  return $data;
         return 10000000;  
    }

    function totalProfitByUser($type)  
    {
         $builder = $this->db->table($this->settings_tb);
         $builder->select([$this->settings_tb.'.*',$this->status.'.status_name',$this->status.'.status_badge']);
         $builder->join($this->status,$this->status.'.id='.$this->settings_tb.'.status','left');
         $builder->whereIn($this->settings_tb.'.setting_type',$type);
         $query = $builder->get();
          foreach($query->getResultArray() as $r) 
               $data[] = $r; 
          return $data;  
    }

   
    function totalActualAmountByUser($userId)      
    {
         $PropertyModel = model('PropertyModel');
         return $PropertyModel->totalSalesAmountByUser($userId);
    }


    function totalTargetAmountByUser($userId)    
    { 
         $PropertyModel = model('PropertyModel');
         $properties = $PropertyModel->getPropertiesByUserId($userId);
         $data = array();
         if(is_array($properties))
         {
           foreach($properties as $property){
             if($property['listing_type'] == "sell")
             {
                 $target = $property['total_price'];
             }
             if($property['listing_type'] == "rent") 
             {
                 $target  = $property['rent_per_mon'];  
             }
             $data[] = $target;
           }
            $total =  array_sum($data);
         }
         return @$total; 
    }

    function actualSalesData()    
    {   
        $last12Months = array();
        $pastMonth =  date('F');
        $pastYear  =  date('Y'); 
        $sales = array();
        for ($i = 1; $i < 12; $i++)
        {
            $builder = $this->db->table($this->property_sales_tb.' as A');
            $builder->select(
                [
                  'MONTHNAME(A.created_at) as month',
                  'YEAR(A.created_at) as year',
                  'C.total_price',
                  'C.listing_type', 
                  'C.rent_per_mon' 
              ]);      
             $builder->join($this->properties_tb.' as C','C.id = A.property_id','left');
             $builder->join($this->status.' as B','B.id = A.status','left');  
             $builder->where('MONTHNAME(A.created_at)',$pastMonth);
             $builder->where('YEAR(A.created_at)',$pastYear);
             $query = $builder->get(); 
             $data  = $query->getResultArray();  
             $total_price  = array();   
             $total_price  = array();   
             if(is_array($data)) 
             {
                 foreach($data as $r)
                 {  
                    if($r['listing_type'] == "sell")
                    {
                       $total_price[] = intval($r['total_price']);
                    }
                    if($r['listing_type'] == "rent") 
                    {
                       $total_price[] = intval($r['rent_per_mon']);
                    }    
                 }
                   $sumOfTotalPrice =  array_sum($total_price);
                   $total_price = NULL;    
             }else{
                   $sumOfTotalPrice = 0;   
             } 

             $sales[] =  [ "y" => $sumOfTotalPrice,"label" => $pastMonth ];
             $pastMonth = date('F', strtotime("-$i month")); 
             $pastYear  = date('Y', strtotime("-$i month")); 
        }
        return json_encode($sales,JSON_NUMERIC_CHECK);            
    }    

   
}