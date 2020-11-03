<?= $this->extend('common/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('common/header') ?>



<main role="main"> 
  <div class="album py-5 bg-light">
    <div class="container<?= \Config\Services::session()->get('fluid') ? '-fluid' : '';?>"> 
          
            <h1 class="display-4" style="font-size: 30px"> 
            Welcome <?php echo ucfirst(\Config\Services::session()->get('role'));?>
            <?php if(\Config\Services::session()->get('fluid')){ ?>
                <a href="<?= base_url();?>/dashboard/removeFluid" class="text-decoration-none text-dark float-right">
                  <i class="fas fa-compress-arrows-alt" style="font-size: 15px"></i>
                </a>
            <?php }else{ ?>
                <a href="<?= base_url();?>/dashboard/applyFluid" class="text-decoration-none text-dark float-right">
                  <i class="fas fa-expand-arrows-alt" style="font-size: 15px"></i>
                </a> 
            <?php } ?>  
            </h1>


            <div class="card">  
              <div class="card-header"><?= $this->include('frontend/dashboard/tabs') ?></div>
              <div class="card-body"> 
                
                <?php if($section == "all") : ?>
                <h1 class="display-4">
                Projects 
                 <a href="<?= base_url();?>/dashboard/projects/add" class="btn btn-danger btn-sm float-right"><i class="fas fa-plus"></i> Add Project</a> 
                 <a href="<?= base_url();?>/dashboard/projects/link_property" class="btn btn-danger btn-sm float-right" style="margin-right:5px"><i class="fas fa-plus"></i>Link Property</a>
               </h1> 
                <?= \Config\Services::session()->getFlashdata('alert');?>
                <div class="table-responsive">
                 <table class="table table-hover small"> 
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">PROJECT NAME</th>
                          <th scope="col">PROPERTIES</th>
                          <th scope="col">CREATED/UPDATED</th>
                          <th scope="col">STATUS</th>
                          <th scope="col">ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;foreach($projects as $project) : ?>
                        <tr>
                          <td><?= $i;?></td>
                          <td><?= $project['project_name'];?></td>
                          <td>0</td>
                          <td><?= date('D, d M Y', strtotime($project['created_at']));?><br><?= date('D, d M Y', strtotime($project['updated_at']));?></td>
                          <td><?= $project['status_name'];?></td>
                          <td>
                          <a href="<?= base_url();?>/dashboard/projects/edit/<?= $project['id'];?>">
                            <img src="<?= publicFolder();?>/images/edit.png"  width="20"/>
                          </a> |   
                          <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/dashboard/projects/delete/<?= $project['id'];?>" class="deletePop" />  
                            <img src="<?= publicFolder();?>/images/delete.png" width="20"/>
                          </a>
                          </td>
                        </tr>
                      <?php $i++;endforeach ?>
                      </tbody>
                </table>
               </div>
              <?php endif ?> 
              

              <?php if($section == "add") : ?>
                 <h1 class="display-4"> Add Project</h1> 
                 <?= \Config\Services::session()->getFlashdata('alert');?>
                <div class="table-responsive">
                  <?= form_open('/dashboard/projects/add');?>
                 <table class="table table-hover">
                      <tbody>
                        <tr>
                          <td>PROJECT NAME</td>
                          <td><input type="text" name="project_name" class="form-control" placeholder="Project Name" required="" /></td>
                        </tr>
                        <tr>
                          <td>STATUS</td>
                          <td>
                            <select name="status" class="form-control">
                              <option value="1">Active</option>
                              <option value="2">Inactive</option>
                            </select>
                          </td>
                        </tr>
                         <tr>
                          <td></td>
                          <td>
                            <input type="submit" name="addProject" class="btn btn-danger btn-sm" value="Add Project" />
                          </td>
                        </tr>
                      </tbody>
                </table>
                <?= form_close();?>
               </div>
              <?php endif ?>

              <?php if($section == "link_property") : ?>
                 <h1 class="display-4"> Link Property</h1> 
                 <?= \Config\Services::session()->getFlashdata('alert');?>
                <div class="table-responsive">
                  <?= form_open('/dashboard/projects/link_property');?>
                 <table class="table table-hover">
                      <tbody>
                        <tr>
                          <td>SELECT PROJECT</td>
                          <td>
                            <select name="project_id" class="form-control" >
                              <?php foreach($projects as $project) : ?>
                                 <option value="<?= $project['id'];?>"><?= $project['project_name'];?></option>
                              <?php endforeach ?>
                            </select>
                        </td>
                        </tr>
                        <tr>
                          <td>SELECT PROPERTIES</td>
                          <td>
                             <select name="property_id" class="form-control" >
                              <?php foreach($properties as $property) : ?> 
                                 <option value="<?= $property['id'];?>"><?= $project['title'];?></option>  
                              <?php endforeach ?>
                            </select> 
                          </td>
                        </tr>
                        <tr>
                          <td>STATUS</td>
                          <td>
                            <select name="status" class="form-control">
                              <option value="1">Active</option>
                              <option value="2">Inactive</option>
                            </select>
                          </td>
                        </tr>
                         <tr>
                          <td></td>
                          <td>
                            <input type="submit" name="addProject" class="btn btn-danger btn-sm" value="Add Project" />
                          </td>
                        </tr>
                      </tbody>
                </table>
                <?= form_close();?>
               </div>
              <?php endif ?>  

              <?php if($section == "edit") : ?>
                <h1 class="display-4"> Edit Project</h1> 
                <?= \Config\Services::session()->getFlashdata('alert');?>
                <div class="table-responsive">
                  <?= form_open('/dashboard/projects/edit/'.segment(4));?>
                  <?php foreach($projects as $project){} ?>
                   <table class="table table-hover">
                      <tbody>
                        <tr>
                          <td>PROJECT NAME</td>
                          <td>
                            <input type="text" name="project_name" class="form-control" placeholder="Project Name" value="<?= $project['project_name'];?>" required="" />
                          </td>
                        </tr>
                        <tr>
                          <td>STATUS</td>
                          <td>
                            <select name="status" class="form-control">
                              <option value="1" <?= ($project['status'] == 1) ? "selected" : "";?>>Active</option>
                              <option value="2" <?= ($project['status'] == 2) ? "selected" : "";?>>Inactive</option>
                            </select>
                          </td>
                        </tr>
                         <tr>
                          <td></td> 
                          <td>
                            <input type="submit" name="editProject" class="btn btn-danger btn-sm" value="Edit Project" />
                          </td>
                        </tr>
                      </tbody>
                </table>
                 <?= form_close();?>
               </div>
              <?php endif ?>



              </div>
              <div class="card-footer">
                  <nav aria-label="Page navigation text-center">
                    <ul class="pagination">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
              </div>
            </div>
     
    </div>
  </div>   
</main> 


<?= modalPopup("Confirmation","Do you want to delete this project ?");?>
<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>