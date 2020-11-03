<?= $this->extend('backend/common/layout') ?> 
<?= $this->section('content') ?>   


<div class="container-fluid">
<br> 
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url();?>/backend/dashboard/index">Home</a></li> 
      <li class="breadcrumb-item"><a href="<?= base_url();?>"><?= ucfirst(segment(2));?></a></li> 
      </ol>
    </nav>
    <br>  

   <div class="row">
    <?= $this->include('backend/common/sidebar');?> 
    <div class="col-md-9">

        <?php if($section=="edit"){ ?>

                <h3 class="display-4">Property Types Edit</h3>
                <?= \Config\Services::session()->getFlashdata('alert');?>
                 <div class="table-responsive">
                  <?= form_open('/backend/properties/propertyTypes/edit/'.segment(5)); ?>
                  <table class="table small">
                      <caption>Edit property type</caption>
                      <thead>
                      <tbody>
                        <?php if(is_array($getPropertyTypeFromPropertyId)) : ?>
                        <tr>
                          <td>Type Name</td>
                          <td><input type="text" class="form-control" name="type_name" value="<?= $getPropertyTypeFromPropertyId['type_name'];?>" required/></td>
                        </tr>
                        <tr>  
                          <td>Created</td>
                          <td><?= date('F j,Y',strtotime($getPropertyTypeFromPropertyId['created_at']));?></td>
                        </tr>
                        <tr>  
                          <td>Updated</td>
                          <td><?= date('F j,Y',strtotime($getPropertyTypeFromPropertyId['updated_at']));?></td>
                        </tr>
                        <tr>  
                          <td>Status</td>
                          <td>
                            <select name="status" class="form-control">
                              <?php foreach($allStatus as $status) : ?>
                                 <option value="<?= $status['id'];?>" <?php echo ($status['id'] == $getPropertyTypeFromPropertyId['status']) ? "selected" : "";?>>
                                    <?= $status['status_name'];?>
                                  </option> 
                              <?php endforeach ?> 
                            </select>
                          </td>
                        </tr> 
                        <tr> 
                          <td colspan="2">  
                            <input type="submit" name="editPropertyType" value="Save Edit" class="btn btn-primary" />
                            <a href="<?= base_url();?>/backend/properties/propertyTypes/" class="btn btn-danger"/>  
                              Cancel
                            </a>
                          </td> 
                        </tr>
                      <?php endif ?>
                      </tbody>
                  </table>
                  <?= form_close();?>    
                </div>


        <?php }elseif($section == "add"){ ?>
          
              <h3 class="display-4">Add Property Types</h3>
                <?= \Config\Services::session()->getFlashdata('alert');?>
                 <div class="table-responsive">
                  <?= form_open('/backend/properties/propertyTypes/add/'); ?>
                  <table class="table">
                      <caption>Edit property type</caption>
                      <thead>
                      <tbody>
                        <tr>
                          <td>Type Name</td>
                          <td><input type="text" class="form-control" name="type_name" placeholder="Property Type Name" required/></td>
                        </tr>
                        <tr>  
                          <td>Status</td>
                          <td>
                            <select name="status" class="form-control">
                              <?php foreach($allStatus as $status) : ?>
                                 <option value="<?= $status['id'];?>">
                                    <?= $status['status_name'];?>
                                  </option> 
                              <?php endforeach ?> 
                            </select>
                          </td>
                        </tr> 
                        <tr> 
                          <td colspan="2"> 
                            <input type="submit" name="addPropertyType" value="Add Property Type" class="btn btn-danger" />
                            <a href="<?= base_url();?>/backend/properties/propertyTypes/" class="btn btn-white"/>  
                              Cancel
                            </a>
                          </td> 
                        </tr>
                     
                      </tbody>
                  </table>
                  <?= form_close();?>    
                </div>


        <?php }else{ ?>

                <h3 class="display-4">
                  Property Types |  
                  <a href="<?= base_url();?>/backend/properties/propertyTypeAccessMap" class="btn btn-danger btn-sm">Property Type Map</a>
                  <a href="<?= base_url();?>/backend/properties/propertyTypes/add" class="btn btn-danger btn-sm ">Add Property Type</a>
                </h3>
                <?= \Config\Services::session()->getFlashdata('alert');?>
                <div class="table-responsive">
                  <table class="table small">
                      <caption>List of property type</caption>
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Type name</th>
                          <th scope="col">Created At</th>
                          <th scope="col">Updated At</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>  
                        </tr>
                      </thead> 
                      <tbody>
                        <?php if(is_array($getPropertyType)) : ?>
                          <?php $i = 1;foreach($getPropertyType as $type) : ?> 
                        <tr>
                          <th scope="row"><?= $i;?></th>
                          <td><?= $type['type_name'];?></td>
                          <td><?= date('F j,Y',strtotime($type['created_at']));?></td>
                          <td><?= date('F j,Y',strtotime($type['updated_at']));?></td>
                          <td><label class="<?= $type['status_badge'];?>"><?= $type['status_name'];?></label></td> 
                          <td>
                            <a href="<?= base_url();?>/backend/properties/propertyTypes/edit/<?= $type['id'];?>"><img src="<?= publicFolder();?>/images/edit.png"  width="20"/></a> |  
                            <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/properties/propertyTypes/delete/<?= $type['id'];?>" class="deletePop" />  
                              <img src="<?= publicFolder();?>/images/delete.png" width="20"/>
                            </a>
                          </td> 
                        </tr>
                      <?php $i++;endforeach ?>
                      <?php endif ?>
                      </tbody>
                  </table>
                </div>

        <?php }  ?>   
       

    </div>
  </div>

</div>


<?= modalPopup("Confirmation","Do you want to delete this property type ?");?> 
<?= $this->endSection() ?>