<?= $this->extend('backend/common/layout') ?> 
<?= $this->section('content') ?>   


<div class="container-fluid">
<br>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="https:/">Home</a></li>
      <li class="breadcrumb-item"><a href="https:/browse-course">Browse</a></li>
      </ol>
    </nav>
    <br>  

    
    <div class="row">
    <?= $this->include('backend/common/sidebar');?>  
    <div class="col-md-9">
        <h3 class="display-4">
          <img src="<?= publicFolder();?>/images/template.png" /> Templates</h3> 
        <hr>
        
        
        <?php if($section == "") : ?>
        <div class="card-deck">
          <div class="card border-dark mb-3" style="max-width: 18rem;">
            <div class="card-header"><img src="<?= publicFolder();?>/images/content.png" width="30"/> Page Content</div>
            <div class="card-body text-dark">
              <h5 class="card-title">Frontend Content</h5>
              <p class="card-text"><h3 class="float-left display-4"><img src="<?= publicFolder();?>/images/content.png" />| <?= $frontCount;?></h3></p>
              <a href="<?= base_url();?>/backend/templates/frontend_content" class="stretched-link"></a>
            </div>
          </div> 
          <div class="card border-dark mb-3" style="max-width: 18rem;">
            <div class="card-header"><img src="<?= publicFolder();?>/images/email.png" width="30"/> Email Templates</div> 
            <div class="card-body text-dark">
              <h5 class="card-title">Email Templates</h5>
              <p class="card-text"><h3 class="float-left display-4"><img src="<?= publicFolder();?>/images/email.png" width="100"/>| <?= $emailCount;?></h3></p>
              <a href="<?= base_url();?>/backend/templates/email_templates" class="stretched-link"></a>
            </div>
          </div>
          <div class="card border-dark mb-3" style="max-width: 18rem;">
            <div class="card-header"><img src="<?= publicFolder();?>/images/sms.png" width="30"/> SMS Templates</div>
            <div class="card-body text-dark">
              <h5 class="card-title">SMS Templates</h5>
              <p class="card-text"><h3 class="float-left display-4"><img src="<?= publicFolder();?>/images/sms.png" width="100"/>| <?= $smsCount;?></h3></p>
              <a href="<?= base_url();?>/backend/templates/sms_templates" class="stretched-link"></a>
            </div>
          </div>  
    </div>
    <?php endif ?>



    <?php if($section == "frontend_content") : ?>

     
      <?= \Config\Services::session()->getFlashdata('alert');?>   
      <div class="table-responsive">
         <?php if(segment(4)=="create"){ ?>
           <h3 class="display-4" style="font-size: 30px">Page Content</h3>
              <?= form_open('/backend/templates/frontend_content/create');?>
                <table class="table small">
                   <tbody>
                       <tr> 
                         <th scope="row">Title</th>    
                         <td><input type="text" name="title" class="form-control" placeholder="Title" required/></td> 
                      </tr>
                      <tr> 
                         <th scope="row">Content</th>
                         <td>
                          <textarea type="text" name="html_txt" class="form-control" style="height:300px"  placeholder="HTML/TXT Content" required /></textarea>
                        </td>
                      </tr>
                       <tr> 
                         <th scope="row">Status</th>
                         <td>
                          <select name="status" class="form-control">
                             <?php foreach(statusList() as $status) : ?>
                               <option value="<?php echo $status['id'];?>" >
                                  <?php echo $status['status_name'];?>
                                </option>
                             <?php endforeach ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                         <th></th>
                         <td><input type="submit" name="create" class="btn btn-danger btn-sm" value="Create Template"></textarea></td>
                      </tr>
                    
                   </tbody>
                </table>
              <?= form_close() ;?>
         <?php }elseif(segment(4)=="edit"){ ?>
           <h3 class="display-4" style="font-size: 30px">Page Content Edit</h3>
               <?php foreach($content_u as $r) : ?>
           <?= form_open('/backend/templates/frontend_content/edit/'.segment(5));?>
                <table class="table small">
                   <tbody>
                       <tr> 
                         <th scope="row">Title</th>    
                         <td><input type="text" name="title" class="form-control" placeholder="Title" value="<?= $r['title'];?>" required/></td> 
                      </tr>
                      <tr> 
                         <th scope="row">Content</th> 
                         <td>
                          <textarea type="text" name="html_txt" class="form-control" style="height:300px"  placeholder="HTML/TXT Content" required /><?= $r['html_txt'];?></textarea>
                        </td>
                      </tr>
                       <tr> 
                         <th scope="row">Status</th>
                         <td>
                          <select name="status" class="form-control">
                             <?php foreach(statusList() as $status) : ?>
                               <option value="<?php echo $status['id'];?>" <?= ($status['id'] == $r['status']) ? "selected" : "";?> >
                                  <?php echo $status['status_name'];?>
                                </option>
                             <?php endforeach ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                         <th></th>
                         <td><input type="submit" name="update" class="btn btn-danger btn-sm" value="Update Template"></textarea></td> 
                      </tr>
                    
                   </tbody>
                </table>
              <?= form_close() ;?>
                <?php endforeach ?>
         <?php }else{ ?>
            <h3 class="display-4" style="font-size: 30px">Page Content List <a href="<?= base_url();?>/backend/templates/frontend_content/create" class="btn btn-danger btn-sm float-right"> + Create Page Template</a></h3>
           <table class="table">
          <caption>List of frontend contents</caption>
          <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">HTML/TXT</th>
              <th scope="col">Created</th>
              <th scope="col">Updated</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($content)) : ?>
            <?php $i=1;foreach($content as $r) : ?>
            <tr>
              <th scope="row"><?= $i;?></th>
              <td><?= $r['title'];?></td>
              <td>
                <button class="btn btn-danger btn-sm" onclick="$('.fcCode<?= $i;?>').toggle()">Preview Code</button>
                <small class="fcCode<?= $i;?>" style="display: none"><br><pre><?= trim(htmlentities($r['html_txt']));?></pre></small>
              </td>
              <td><?= $r['created_at'];?></td>
              <td><?= $r['updated_at'];?></td>
              <td><label class="<?= statusLabel($r['status'])['status_badge'];?>"><?= statusLabel($r['status'])['status_name'];?></label></td>
              <td>
                <a href="<?= base_url();?>/backend/templates/frontend_content/edit/<?= $r['id'];?>"><img src="<?= publicFolder();?>/images/edit.png"  width="20"/></a> |  
                <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/templates/frontend_content/delete/<?= $r['id'];?>" class="deletePop" />  
                  <img src="<?= publicFolder();?>/images/delete.png" width="20"/>
                </a>
              </td>
            </tr>
            <?php $i++;endforeach ?>
            <?php endif ?>
          </tbody>
      </table>
         <?php } ?>
     
      </div>
        

    <?php endif ?> 


   

    <?php if($section == "email_templates") : ?>
   
       <?= \Config\Services::session()->getFlashdata('alert');?>   
      <div class="table-responsive">
         <?php if(segment(4)=="create"){ ?>
           <h3 class="display-4" style="font-size: 30px">Email Template</h3>
              <?= form_open('/backend/templates/email_templates/create');?>
                <table class="table small">
                   <tbody>
                       <tr> 
                         <th scope="row">Title</th>    
                         <td><input type="text" name="title" class="form-control" placeholder="Title" required/></td> 
                      </tr>
                      <tr> 
                         <th scope="row">Content</th>
                         <td>
                          <textarea type="text" name="html_txt" class="form-control" style="height:300px"  placeholder="HTML/TXT Content" required /></textarea>
                        </td>
                      </tr>
                       <tr> 
                         <th scope="row">Status</th>
                         <td>
                          <select name="status" class="form-control">
                             <?php foreach(statusList() as $status) : ?>
                               <option value="<?php echo $status['id'];?>" >
                                  <?php echo $status['status_name'];?>
                                </option>
                             <?php endforeach ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                         <th></th>
                         <td><input type="submit" name="create" class="btn btn-danger btn-sm" value="Create Template"></textarea></td>
                      </tr>
                    
                   </tbody>
                </table>
              <?= form_close() ;?>
         <?php }elseif(segment(4)=="edit"){ ?>
           <h3 class="display-4" style="font-size: 30px">Email Template Edit</h3>
               <?php foreach($content_u as $r) : ?>
           <?= form_open('/backend/templates/email_templates/edit/'.segment(5));?>
                <table class="table small">
                   <tbody>
                       <tr> 
                         <th scope="row">Title</th>     
                         <td><input type="text" name="title" class="form-control" placeholder="Title" value="<?= $r['title'];?>" required/></td> 
                      </tr>
                      <tr> 
                         <th scope="row">Content</th> 
                         <td>
                          <textarea type="text" name="html_txt" class="form-control" style="height:300px"  placeholder="HTML/TXT Content" required /><?= $r['html_txt'];?></textarea>
                        </td>
                      </tr>
                       <tr> 
                         <th scope="row">Status</th>
                         <td>
                          <select name="status" class="form-control">
                             <?php foreach(statusList() as $status) : ?>
                               <option value="<?php echo $status['id'];?>" <?= ($status['id'] == $r['status']) ? "selected" : "";?> >
                                  <?php echo $status['status_name'];?>
                                </option>
                             <?php endforeach ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                         <th></th>
                         <td><input type="submit" name="update" class="btn btn-danger btn-sm" value="Update Template"></textarea></td> 
                      </tr>
                    
                   </tbody>
                </table>
              <?= form_close() ;?>
                <?php endforeach ?>
         <?php }else{ ?>
            <h3 class="display-4" style="font-size: 30px">Email Template List <a href="<?= base_url();?>/backend/templates/email_templates/create" class="btn btn-danger btn-sm float-right"> + Create Email Template</a></h3>
           <table class="table">
          <caption>List of email templates</caption>
          <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">HTML/TXT</th>
              <th scope="col">Created</th>
              <th scope="col">Updated</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($content)) : ?>
            <?php $i=1;foreach($content as $r) : ?>
            <tr>
              <th scope="row"><?= $i;?></th> 
              <td><?= $r['title'];?></td> 
              <td> 
                <button class="btn btn-danger btn-sm" onclick="$('.eTempCode<?= $i;?>').toggle()">Preview Code</button>
                <small class="eTempCode<?= $i;?>" style="display: none"><br><pre><?= trim(htmlentities($r['html_txt']));?></pre></small>
              </td>
              <td><?= $r['created_at'];?></td>
              <td><?= $r['updated_at'];?></td>
              <td><label class="<?= statusLabel($r['status'])['status_badge'];?>"><?= statusLabel($r['status'])['status_name'];?></label></td>
              <td>
                <a href="<?= base_url();?>/backend/templates/email_templates/edit/<?= $r['id'];?>"><img src="<?= publicFolder();?>/images/edit.png"  width="20"/></a> |  
                <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/templates/email_templates/delete/<?= $r['id'];?>" class="deletePop" />  
                  <img src="<?= publicFolder();?>/images/delete.png" width="20"/>
                </a>
              </td>
            </tr>
            <?php $i++;endforeach ?>
            <?php endif ?>
          </tbody>
      </table>
         <?php } ?>
     
      </div>

    <?php endif ?>






    <?php if($section == "sms_templates") : ?> 
     

         <?= \Config\Services::session()->getFlashdata('alert');?>   
      <div class="table-responsive">
         <?php if(segment(4)=="create"){ ?>
           <h3 class="display-4" style="font-size: 30px">SMS Template</h3>
              <?= form_open('/backend/templates/sms_templates/create');?>
                <table class="table small">
                   <tbody>
                       <tr> 
                         <th scope="row">Title</th>    
                         <td><input type="text" name="title" class="form-control" placeholder="Title" required/></td> 
                      </tr>
                      <tr> 
                         <th scope="row">Content</th>
                         <td>
                          <textarea type="text" name="html_txt" class="form-control" style="height:300px"  placeholder="HTML/TXT Content" required /></textarea>
                        </td>
                      </tr>
                      <tr> 
                         <th scope="row">Status</th>
                         <td>
                          <select name="status" class="form-control">
                             <?php foreach(statusList() as $status) : ?>
                               <option value="<?php echo $status['id'];?>"><?php echo $status['status_name'];?></option>
                             <?php endforeach ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                         <th></th>
                         <td><input type="submit" name="create" class="btn btn-danger btn-sm" value="Create Template"></textarea></td>
                      </tr>
                    
                   </tbody>
                </table>
              <?= form_close() ;?>
         <?php }elseif(segment(4)=="edit"){ ?>
           <h3 class="display-4" style="font-size: 30px">SMS Template Edit</h3>
               <?php foreach($content_u as $r) : ?>
           <?= form_open('/backend/templates/sms_templates/edit/'.segment(5));?>
                <table class="table small">
                   <tbody>
                       <tr> 
                         <th scope="row">Title</th>     
                         <td><input type="text" name="title" class="form-control" placeholder="Title" value="<?= $r['title'];?>" required/></td> 
                      </tr>
                      <tr> 
                         <th scope="row">Content</th> 
                         <td>
                          <textarea type="text" name="html_txt" class="form-control" style="height:300px"  placeholder="HTML/TXT Content" required /><?= $r['html_txt'];?></textarea>
                        </td>
                      </tr>
                      <tr> 
                         <th scope="row">Status</th>
                         <td>
                          <select name="status" class="form-control">
                             <?php foreach(statusList() as $status) : ?>
                               <option value="<?php echo $status['id'];?>" <?= ($status['id'] == $r['status']) ? "selected" : "";?> >
                                  <?php echo $status['status_name'];?>
                                </option>
                             <?php endforeach ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                         <th></th>
                         <td><input type="submit" name="update" class="btn btn-danger btn-sm" value="Update Template"></textarea></td> 
                      </tr>
                    
                   </tbody>
                </table>
              <?= form_close() ;?>
                <?php endforeach ?>
         <?php }else{ ?>
            <h3 class="display-4" style="font-size: 30px">SMS Template List <a href="<?= base_url();?>/backend/templates/sms_templates/create" class="btn btn-danger btn-sm float-right"> + Create Email Template</a></h3>
           <table class="table">
          <caption>List of SMS templates</caption>
          <thead>
           <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">HTML/TXT</th>
              <th scope="col">Created</th>
              <th scope="col">Updated</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($content)) : ?>
            <?php $i=1;foreach($content as $r) : ?>
            <tr>
              <th scope="row">1</th>
              <td><?= $r['title'];?></td>
              <td>
                <button class="btn btn-danger btn-sm" onclick="$('.stCode<?= $i;?>').toggle()">Preview Code</button>
                <small class="stCode<?= $i;?>" style="display: none"><br><pre><?= trim(htmlentities($r['html_txt']));?></pre></small>
              </td>
              <td><?= $r['created_at'];?></td>
              <td><?= $r['updated_at'];?></td>
              <td><label class="<?= statusLabel($r['status'])['status_badge'];?>"><?= statusLabel($r['status'])['status_name'];?></label></td>
              <td>
                <a href="<?= base_url();?>/backend/templates/sms_templates/edit/<?= $r['id'];?>"><img src="<?= publicFolder();?>/images/edit.png"  width="20"/></a> |  
                <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/templates/sms_templates/delete/<?= $r['id'];?>" class="deletePop" />  
                  <img src="<?= publicFolder();?>/images/delete.png" width="20"/>
                </a>
              </td>
            </tr>
            <?php $i++;endforeach ?>
            <?php endif ?>
          </tbody>
      </table>
         <?php } ?>
     
      </div>

    <?php endif ?>





  </div>




</div>


<?= modalPopup("Confirmation","Do you want to delete this frontend content ?");?> 
<?= $this->endSection() ?>