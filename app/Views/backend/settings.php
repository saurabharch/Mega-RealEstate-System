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
                  <td>
                    <textarea class="form-control" name="setting_json" placeholder="Setting JSON" rows="5" required><?= removeSpace($s['setting_json']);?></textarea>
                  </td>
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
           

        <h3 class="display-4">Settings <a href="<?= base_url();?>/backend/settings/add" class="btn btn-danger btn-sm float-right">Add New Setting</a></h3>
        <?= \Config\Services::session()->getFlashdata('alert');?>
        <div class="table-responsive">
          <table class="table small">
              <caption>Edit settings</caption>
              
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Setting Name</th> 
                  <th scope="col">Parameters</th>
                  <th scope="col">Created</th>
                  <th scope="col">Updated</th>
                  <th scope="col">Status</th>
                  <th scope="col"></th>
                </tr>
              </thead>

              <tbody>
                <?php if(is_array($settings)) : ?>
                <?php $i=1;foreach($settings as $s) : ?>
                <tr> 
                  <th scope="row"><?= $i;?></th>
                  <td><?= $s['setting_name'];?></td>
                  <td>
                    <?php 
                    $array = json_decode(trim($s['setting_json']),true);
                    if(is_array($array)){ 
                      ?> 
                    <?php foreach(json_decode(trim($s['setting_json']),true) as $key => $val) : ?>
                      <?= strtoupper($key);?> - <?= $val;?> <br>
                    <?php endforeach ?>   
                    <?php }else{  ?>
                      No Data
                    <?php } ?>   
                  </td>
                  <td><?= $s['created_at'];?></td>
                  <td><?= $s['updated_at'];?></td>
                  <td>
                    <label class="<?= $s['status'];?>">
                      <?= $s['status'];?> 
                    </label>
                  </td>
                  <td>
                     <a href="<?= base_url();?>/backend/settings/edit/<?= $s['id'];?>">
                          <img src="<?= publicFolder();?>/images/edit.png"  width="20"/>
                    </a> |  
                    <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/settings/delete/<?= $s['id'];?>" class="deletePop" />  
                      <img src="<?= publicFolder();?>/images/delete.png" width="20"/> 
                    </a>
                  </td>
                </tr>
               <?php $i++;endforeach ?>
               <?php endif ?>
              </tbody>
          </table>
        </div>

        <?php } ?>
        


    </div>
  </div>



</div>


<?= modalPopup("Confirmation","Do you want to delete this setting ?");?> 
<?= $this->endSection() ?>