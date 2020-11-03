<?= $this->extend('backend/common/layout') ?> 
<?= $this->section('content') ?>   


<div class="container-fluid">
<br>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url();?>/backend/dashboard/index">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>/backend/user/rolePermissions/">Role Permissions</a></li>
      </ol>
    </nav>
    <br>   
 
    <div class="row">
    <?= $this->include('backend/common/sidebar');?> 
    <div class="col-md-9">
      

      <?php if($section == "add") : ?>
          <h3 class="display-4">
          Add Role Permissions  
          <a href="<?= base_url();?>/backend/user/rolePermissions/" class="btn btn-danger btn-sm float-right"><i class="fas fa-unlock-alt"></i> Role Permissions</a>
        </h3> 
        <?= \Config\Services::session()->getFlashdata('alert');?>
        <div class="table-responsive">
          <?= form_open('/backend/user/rolePermissions/add');?>
          <table class="table small">
              <tbody>
                <tr>
                  <td>Role Name</td>
                  <td>
                    <select name="role" class="form-control">
                       <option value="customer">Customer</option>
                       <option value="developer">Developer</option>
                       <option value="agent">Agent</option>  
                    </select>
                  </td>
                </tr>
                 <tr>
                  <td>Access</td>
                  <td><textarea class="form-control" name="access" placeholder="Name access separated by commas - eg : property-edit,user-delete,..etc" required=""></textarea></td>
                </tr>
                 <tr>
                  <td>Status</td>
                  <td>
                    <select class="form-control" name="status">
                       <option value="1" selected="">Active</option>
                       <option value="2">Inactive</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                   <input type="submit" name="addRolePermission" class="btn btn-danger btn-sm" />
                  </td>
                </tr>
              </tbody>
          </table>
          <?= form_close();?>
        </div>
      <?php endif ?>

      <?php if($section == "edit") : ?>
         <h3 class="display-4">
          Edit Role Permissions  
          <a href="<?= base_url();?>/backend/user/rolePermissions/" class="btn btn-danger btn-sm float-right"><i class="fas fa-unlock-alt"></i> Role Permissions</a>
        </h3> 
        <?= \Config\Services::session()->getFlashdata('alert');?>
        <?php foreach($rolePermissions as $permission){} ?>
        <div class="table-responsive">
          <?= form_open('/backend/user/rolePermissions/edit/'.segment(5));?>
          <table class="table small">
              <tbody>
                <tr>
                  <td>Role Name</td>
                  <td>
                    <select name="role" class="form-control">
                       <option value="customer" <?= ($permission['role'] == "customer") ? "selected" : "";?> >Customer</option>
                       <option value="developer" <?= ($permission['role'] == "developer") ? "selected" : "";?>>Developer</option>
                       <option value="agent" <?= ($permission['role'] == "agent") ? "selected" : "";?>>Agent</option>   
                    </select>
                  </td>
                </tr>
                 <tr>
                  <td>Access</td>
                  <td>
                    <?php 
                       $array = json_decode($permission['access'],true);
                       $access =  implode(',',$array);  
                    ?>
                    <?php foreach($array as $a) : ?>
                      <button class="btn btn-outline-danger btn-sm"><?= humanize(ucfirst($a));?></button>
                    <?php endforeach ?>
                    <br><br>
                    <textarea class="form-control" name="access" placeholder="Name access separated by commas - eg : property-edit,user-delete,..etc" required=""><?= $access;?></textarea>
                  </td>
                </tr>
                 <tr>
                  <td>Status</td>
                  <td>
                    <select class="form-control" name="status"> 
                       <option value="1" <?= ($permission['status'] == 1) ? "selected" : "";?>>Active</option>
                       <option value="2" <?= ($permission['status'] == 2) ? "selected" : "";?>>Inactive</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <input type="submit" name="editRolePermission" class="btn btn-danger btn-sm" />
                  </td>  
                </tr>
              </tbody>
          </table>
          <?= form_close();?>
        </div>
      <?php endif ?>




      <?php if($section == ""  || $section == NULL) : ?>
         <h3 class="display-4">
          Role Permissions  
          <a href="<?= base_url();?>/backend/user/rolePermissions/add" class="btn btn-danger btn-sm float-right"><i class="fas fa-plus"></i> Add Role Permission</a>
        </h3> 
        <?= \Config\Services::session()->getFlashdata('alert');?>
        <div class="table-responsive">
          <table class="table">
              <caption>List of Role Permissions</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col"><i class="fas fa-user-tag"></i> Role</th>
                  <th scope="col"><i class="fas fa-unlock-alt"></i> Access</th>
                  <th scope="col"><i class="far fa-clock"></i> Created/Updated</th>
                  <th scope="col">Status</th> 
                  <th scope="col"><i class="fas fa-tools"></i> Action</th> 
                </tr>
              </thead>
              <tbody>
                <?php if(is_array($rolePermissions)){ ?>
                     <?php foreach($rolePermissions as $permission) { ?>
                      <tr>
                        <th scope="row">1</th>
                        <td><?= ucfirst($permission['role']);?></td>
                        <td>
                          <small>
                          <?php 
                             $array = json_decode($permission['access'],true);
                             echo humanize(implode(',<br>',$array)); 
                          ?>
                          </small> 
                        </td>
                        <td><?= date('D, d M Y', strtotime($permission['created_at']));?><br><?= date('D, d M Y', strtotime($permission['updated_at']));?></td>
                        <td><?= $permission['status_name'];?></td>
                        <td>
                          <a href="<?= base_url();?>/backend/user/rolePermissions/edit/<?= $permission['id'];?>">
                            <img src="<?= publicFolder();?>/images/edit.png"  width="20"/>
                          </a> |  
                          <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/user/rolePermissions/delete/<?= $permission['id'];?>" class="deletePop" />  
                            <img src="<?= publicFolder();?>/images/delete.png" width="20"/>
                          </a>
                        </td>
                      </tr>
                      <?php } ?>
                <?php }else{ ?>
                   <tr>
                        <th colspan="6">No Record</th>
                  </tr>
                <?php } ?>

               

              </tbody>
          </table>
        </div>
      <?php endif ?>  
        
   
    </div>
  </div>


</div>


<?= modalPopup("Confirmation","Delete this role permissions ?");?>
<?= $this->endSection() ?>