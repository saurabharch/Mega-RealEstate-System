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

                <h3 class="display-4">Edit PropertyTypeAccess</h3>
                <?= \Config\Services::session()->getFlashdata('alert');?>
                 <div class="table-responsive">
                  <?= form_open('/backend/properties/propertyTypeAccessMap/edit/'.segment(5)); ?>

                  <table class="table">
                      <caption>Edit PropertyTypeAccess</caption> 
                      
                      <tbody>
                        <tr>
                          <td>Type Name</td>  
                          <td>
                            <select name="property_type" class="form-control">
                              <?php foreach($getPropertyType as $type) : ?>
                                 <option value="<?= $type['id'];?>" <?= ($editPropertyTypeMap['property_type'] == $type['id']) ? "selected":"";?> >
                                    <?= $type['type_name'];?>  
                                  </option> 
                              <?php endforeach ?>   
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>Access</td>
                          <td>
                            <?php foreach ($propertyFields as $field ){ ?>
                              <label class="btn btn-outline-danger btn-sm">
                                 <input type="checkbox" name="access[]" value="<?= $field;?>" <?= in_array($field,json_decode($editPropertyTypeMap['access'],true)) ? "checked":"";?>/>
                                 <?= humanize($field);?>  
                              </label> 
                            <?php } ?> 
                          </td>
                        </tr>
                        <tr>  
                          <td>Status</td> 
                          <td>
                            <select name="status" class="form-control">
                              <?php foreach(statusList() as $status) : ?> 
                                 <option value="<?= $status['id'];?>" <?= ($editPropertyTypeMap['status'] == $status['id']) ? "selected":"";?>>
                                    <?= $status['status_name'];?>
                                  </option> 
                              <?php endforeach ?> 
                            </select>
                          </td>
                        </tr>  
                        <tr> 
                          <td colspan="2">  
                            <input type="submit" name="editPropertyTypeAccess" value="Update PropertyTypeAccess" class="btn btn-danger" />
                            <a href="<?= base_url();?>/backend/properties/propertyTypeAccessMap/" class="btn btn-white"/>  
                              Cancel
                            </a>
                          </td> 
                        </tr>
                     
                      </tbody>
                  </table>
                  <?= form_close();?>    
                </div>


        <?php }elseif($section == "add"){ ?>
          
              <h3 class="display-4">Add PropertyTypeAccess</h3>
                <?= \Config\Services::session()->getFlashdata('alert');?>
                 <div class="table-responsive">
                  <?= form_open('/backend/properties/propertyTypeAccessMap/add/'); ?>
                  <table class="table">
                      <caption>Add PropertyTypeAccess</caption>
                      
                      <tbody>
                        <tr>
                          <td>Type Name</td>
                          <td>
                            <select name="property_type" class="form-control">
                              <?php foreach($getPropertyType as $type) : ?>
                                 <option value="<?= $type['id'];?>">
                                    <?= $type['type_name'];?>
                                  </option> 
                              <?php endforeach ?>   
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>Access</td>
                          <td>
                            <?php foreach ($propertyFields as $field ){ ?>
                              <label class="btn btn-outline-danger btn-sm">
                                 <input type="checkbox" name="access[]" value="<?= $field;?>" />
                                 <?= humanize($field);?>  
                              </label> 
                            <?php } ?> 
                          </td>
                        </tr>
                        <tr>  
                          <td>Status</td> 
                          <td>
                            <select name="status" class="form-control">
                              <?php foreach(statusList() as $status) : ?> 
                                 <option value="<?= $status['id'];?>">
                                    <?= $status['status_name'];?>
                                  </option> 
                              <?php endforeach ?> 
                            </select>
                          </td>
                        </tr>  
                        <tr> 
                          <td colspan="2"> 
                            <input type="submit" name="addPropertyTypeAccess" value="Add PropertyTypeAccess" class="btn btn-danger" />
                            <a href="<?= base_url();?>/backend/properties/propertyTypeAccessMap/" class="btn btn-white"/>  
                              Cancel
                            </a>
                          </td> 
                        </tr>
                     
                      </tbody>
                  </table>
                  <?= form_close();?>    
                </div>


        <?php }else{ ?>

                <h3 class="display-4">Property Type Access Map <a href="<?= base_url();?>/backend/properties/propertyTypeAccessMap/add" class="btn btn-danger btn-sm float-right">Add PropertyTypeAccess</a></h3>
                <?= \Config\Services::session()->getFlashdata('alert');?>
                <div class="table-responsive">
                  <table class="table small">
                      <caption>List Of Property Type Access</caption>   
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Type Name</th>   
                          <th scope="col">Access</th>   
                          <th scope="col">Created/Updated</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th> 
                        </tr>
                      </thead> 
                      <tbody>
                        <?php if(is_array($propertyTypeMap)) : ?>
                          <?php $i = 1;foreach($propertyTypeMap as $typeMap) : ?>  
                        <tr>
                          <th scope="row"><?= $i;?></th>
                          <td><?= $typeMap['type_name'];?></td>
                          <td style="width: 500px;font-size: 16px"> 
                             <?php 
                             $array = json_decode($typeMap['access'],true);
                             foreach($array as $field ){ ?>
                              <span  class="badge badge-pill badge-danger">
                                 <?= humanize($field);?>    
                              </span>   
                            <?php } ?>  
                          </td>
                          <td><?= date('F j,Y',strtotime($typeMap['created_at']));?><br><?= date('F j,Y',strtotime($typeMap['updated_at']));?></td> 
                          <td><label class="<?= $typeMap['status_badge'];?>"><?= $typeMap['status_name'];?></label></td> 
                          <td>
                            <a href="<?= base_url();?>/backend/properties/propertyTypeAccessMap/edit/<?= $typeMap['id'];?>"><img src="<?= publicFolder();?>/images/edit.png"  width="20"/></a> |  
                            <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/properties/propertyTypeAccessMap/delete/<?= $typeMap['id'];?>" class="deletePop" />  
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


<?= modalPopup("Confirmation","Do you want to delete this property type access map ?");?> 
<?= $this->endSection() ?>