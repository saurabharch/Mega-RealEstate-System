<?= $this->extend('backend/common/layout') ?> 
<?= $this->section('content') ?>   


<div class="container-fluid">
<br>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url();?>/backend/dashboard/index">Home</a></li> 
      <li class="breadcrumb-item"><a href="<?= base_url().'/backend/'.segment(2);?>/index"><?= ucfirst(segment(2));?></a></li>
      </ol>
    </nav> 
    <br>  

    
    <div class="row">
    <?= $this->include('backend/common/sidebar');?> 
    <div class="col-md-9">
        
        <?php if($section == "add") { ?>
        
        <h3 class="display-4">Add Setting </h3>
        <?= \Config\Services::session()->getFlashdata('alert');?>
        <div class="table-responsive">
          <?= form_open('/backend/settings/add') ?>
          <table class="table">
              <tbody>
                
                <tr>  
                  <td>Setting Name</td>
                  <td><input type="text" name="setting_name" class="form-control" placeholder="Setting Name" required/></td>    
                </tr>
                <tr> 
                  <td>JSON</td>
                  <td><textarea class="form-control" name="setting_json" placeholder="Setting JSON" required></textarea></td>
                </tr>
                <tr> 
                  <td></td>
                  <td><input type="submit" name="setting_submit" class="btn btn-primary btn-sm" value="Add Setting" /></td>
                </tr>

              </tbody>
          </table>
          <?= form_close() ?>
        </div>

        <?php }elseif($section == "edit"){ ?>
          
        <h3 class="display-4">Update Setting </h3>
        <?= \Config\Services::session()->getFlashdata('alert');?>
        <div class="table-responsive">
          <?= form_open('/backend/settings/edit/'.segment(4)) ?>
          <?php foreach($settings as $s){} ?>
          <table class="table">
              <tbody>
                <tr>  
                  <td>Setting Name</td>
                  <td><input type="text" name="setting_name" class="form-control" placeholder="Setting Name" value="<?= $s['setting_name'];?>" required/></td>    
                </tr>
                <tr> 
                  <td>JSON</td>
                  <td><textarea class="form-control" name="setting_json" placeholder="Setting JSON" required>
                    <?= removeSpace($s['setting_json']);?>
                    </textarea></td>
                </tr>
                 <tr> 
                  <td>Status</td>
                  <td>
                    <select name="status" class="form-control"> 
                       <?php foreach(statusList() as $status) : ?>  
                          <option value="<?= $status['id']?>" <?= ($status['id']==$s['status']) ? "active" : "";?>>
                            <?= $status['status_name']?>
                          </option>
                       <?php endforeach ?>
                    </select>
                  </td>
                </tr>
                <tr> 
                  <td></td>
                  <td><input type="submit" name="setting_submit" class="btn btn-primary btn-sm" value="Update Setting" /></td>
                </tr>
              </tbody>
          </table>
          <?= form_close() ?>
        </div>

        <?php }else{ ?>  
           

        <h3 class="display-4">Ads Payments <a href="<?= base_url();?>/backend/payment/adsPayments/add" class="btn btn-danger btn-sm float-right">Add New Payment</a></h3>
        <?= \Config\Services::session()->getFlashdata('alert');?>
        <div class="table-responsive">
          <table class="table small">
              <caption>Property Ads Payments</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Property</th> 
                  <th scope="col">Ads Type</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Start Ad/End Ad</th>
                  <th scope="col">Ads Period</th>
                  <th scope="col">Days Left</th>
                  <th scope="col">Created/Updated</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php if(is_array($adsPayments)) : ?>
                     <?php $i=1;foreach($adsPayments as $adsP) : ?>
                       <th scope="col"><?= $i;?></th>
                       <th scope="col">
                         <a href="<?= base_url();?>/backend/properties/edit/<?= $adsP['property_id'];?>" class="text-decoration-none text-dark"><?= $adsP['title'];?></a>
                       </th>
                       <th scope="col">
                        <?php 
                        if($adsP['ads_type'] == 1){ 
                          echo "Featured"; 
                        }elseif($adsP['ads_type'] == 2){
                          echo "Sponsored"; 
                        }elseif($adsP['ads_type'] == 0){
                          echo "No Ads"; 
                        };?>
                       </th>
                       <th scope="col"><?= $adsP['total_amount'];?> (<?= $adsP['currency'];?>)</th>
                       <th scope="col">
                          <span class="text-success"><?= $adsP['start_ad_from'];?></span>
                          <br>
                          <span class="text-danger"><?= $adsP['end_ad_on'];?></span>
                       </th> 
                       <th scope="col">
                        <?php 
                          //$diff = date_diff($adsP['end_ad_on'],$adsP['start_ad_from']);
                          $datetime1 = date_create($adsP['start_ad_from']); 
                          $datetime2 = date_create($adsP['end_ad_on']); 
                          $dateNow   = date_create(date('Y-m-d h:i:s'));  
                          // Calculates the difference between DateTime objects 
                          $interval = date_diff($datetime1, $datetime2); 
                            
                          // Display the result 
                          echo $interval->format('%a days'); 
                        ?>
                       </th>
                       <th scope="col">
                         <?php 
                            $timeUpto  = strtotime($adsP['end_ad_on']); 
                            $timeNow   = strtotime(date('Y-m-d h:i:s'));
                            $diff = ($timeUpto - $timeNow)/60/60/24; 
                            echo ($diff > 0) ? intval($diff).' days' : 'expired';    
                         ;?>
                       </th>
                       <th scope="col"><?= $adsP['created_at'];?><br><?= $adsP['updated_at'];?></th>
                       <th scope="col"><span class="<?= $adsP['status_badge'];?>"><?= $adsP['status_name'];?></span></th>    
                       <th scope="col">
                          <a href="<?= base_url();?>/backend/payment/adsPayments/edit/<?= $adsP['id'];?>"><img src="<?= publicFolder();?>/images/edit.png"  width="20"/></a> |  
                          <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/payment/adsPayments/delete/<?= $adsP['id'];?>" class="deletePop">
                            <img src="<?= publicFolder();?>/images/delete.png" width="20"/> 
                          </a> 
                       </th>    
                     <?php $i++;endforeach ?>
                  <?php endif ?>
                </tr>
              </tbody> 
          </table>
        </div>

        <?php } ?>
        


    </div>
  </div>



</div>


<?= modalPopup("Confirmation","Do you want to delete this payment ads?");?> 
<?= $this->endSection() ?>