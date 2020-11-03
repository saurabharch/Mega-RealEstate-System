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
              <div class="card-header">
                <?= $this->include('frontend/dashboard/tabs') ?>
              </div>
              <div class="card-body">
                <?php if($section == "all") : ?>
                <h1 class="display-4">
                Appointments
                   <a href="<?= base_url();?>dashboard/appointments/add" target="__blank" class="btn btn-danger btn-sm float-right">
                    <i class="fas fa-plus"></i> Add Appointment Schedule
                   </a> 
                </h1> 
                
                
                <div class="table-responsive"> 
                 <table class="table table-hover small">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">PROJECT/PROPERTY</th>
                          <th scope="col">CLIENT NAME</th>
                          <th scope="col">VISIT DATE</th>
                          <th scope="col">VISIT TIME</th>
                          <th scope="col">POSTED ON</th>
                          <th scope="col">IS APPROVED</th>
                          <th scope="col">STATUS</th>
                          <th scope="col">ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        <?php if(is_array($appointments)){ ?>
                           <?php $i = 1;foreach($appointments as $appointment) : ?>
                              <tr>
                                  <th scope="row"><?= $i;?></th>
                                  <td>
                                     <?php
                                        if($appointment['project_property'] == "project")
                                        {
                                           $detail = getProjectDetail($appointment['project_property_id']); 
                                           foreach($detail as $d){ echo $d['project_name']; };
                                        }  
                                        if($appointment['project_property'] == "property") 
                                        {  
                                           $detail = getPropertyDetail($appointment['project_property_id']);
                                           foreach($detail as $d){ echo $d['title']; };   
                                        }  
                                     ?>
                                  </td>
                                  <td>
                                   <?= ucfirst($appointment['firstname']);?>
                                   <?= ucfirst($appointment['lastname']);?>
                                  </td>
                                  <td><?= date('D, d M Y', strtotime($appointment['visit_date']));?></td>
                                  <td><?= $appointment['visit_time'];?></td>
                                  <td><?= date('D, d M Y', strtotime($appointment['created_at']));?></td>
                                  <td>
                                       <?php if($appointment['is_approved'] == 1){ ?>
                                         Yes <img src="<?= publicFolder();?>/images/correct-1.png" width="25"/>
                                       <?php }else{ ?>
                                         Not Yet
                                       <?php }?>
                                  </td>
                                  <td>
                                      <span class="<?= $appointment['status_badge'];?>"><?= ucfirst($appointment['status_name']);?></span>   
                                  </td>    
                                  <td>
                                      <a href="<?= base_url();?>/dashboard/appointments/edit/<?= $appointment['appointment_id'];?>">
                                        <img src="<?= publicFolder();?>/images/edit.png"  width="20"/>
                                      </a> |   
                                      <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/dashboard/appointments/delete/<?= $appointment['appointment_id'];?>" class="deletePop" />  
                                        <img src="<?= publicFolder();?>/images/delete.png" width="20"/>
                                      </a> 
                                  </td>  
                              </tr>     
                           <?php $i++;endforeach ?> 
                        <?php }else{ ?>
                              <tr>
                                  <th colspan="7">No Record Found</th>
                              </tr>      
                        <?php } ?>
        
                      </tbody>
                </table>
               </div>   
               <?php endif ?>
               

               <?php if($section == "edit") : ?>
                <h1 class="display-4">
                  Edit Appointment
                </h1> 
                <?= \Config\Services::session()->getFlashdata('alert');?> 
                <?= form_open('/dashboard/appointments/edit/'.segment(4));?>
                <div class="table-responsive">
                 <table class="table table-hover small">
                      <tbody>
                        <?php if(is_array($appointmentDetail)){ ?>
                           <?php foreach($appointmentDetail as $appointment){} ?> 
                              <tr>
                                  <td>Name</td>   
                                  <td>
                                     <?php
                                        if($appointment['project_property'] == "project")
                                        {
                                           $detail = getProjectDetail($appointment['project_property_id']); 
                                           foreach($detail as $d){ echo $d['project_name']; };
                                        }  
                                        if($appointment['project_property'] == "property") 
                                        {  
                                           $detail = getPropertyDetail($appointment['project_property_id']);
                                           foreach($detail as $d){ echo $d['title']; };   
                                        }  
                                     ?>
                                  </td> 
                              </tr>
                              <tr>
                                  <td>Project or Property</td>   
                                  <td>
                                     <?php 
                                       echo strtoupper($appointment['project_property']);
                                     ?>
                                  </td> 
                              </tr>
                              <tr>
                                  <td>Client Name</td>   
                                  <td><?= $appointment['firstname'];?> <?= $appointment['lastname'];?></td> 
                              </tr>
                              <tr>
                                  <td>Visit Date*</td>    
                                  <td><input type="text" name="visit_date" class="form-control datePicker" value="<?= $appointment['visit_date'];?>" /></td> 
                              </tr>
                              <tr>
                                  <td>Visit Time*</td>    
                                  <td> 
                                    <select name="visit_time" class="form-control">
                                      <option value="10:00 AM" <?= ($appointment['visit_time'] == "10:00 AM") ? "selected" : "";?>>10:00 AM</option>
                                      <option value="11:00 AM" <?= ($appointment['visit_time'] == "11:00 AM") ? "selected" : "";?>>11:00 AM</option>
                                      <option value="12:00 PM" <?= ($appointment['visit_time'] == "12:00 PM") ? "selected" : "";?>>12:00 PM</option>
                                      <option value="1:00 PM" <?= ($appointment['visit_time'] == "1:00 PM") ? "selected" : "";?>>1:00 PM</option>
                                      <option value="2:00 PM" <?= ($appointment['visit_time'] == "2:00 PM") ? "selected" : "";?>>2:00 PM</option>
                                      <option value="3:00 PM" <?= ($appointment['visit_time'] == "3:00 PM") ? "selected" : "";?>>3:00 PM</option>
                                      <option value="4:00 PM" <?= ($appointment['visit_time'] == "4:00 PM") ? "selected" : "";?>>4:00 PM</option>
                                      <option value="5:00 PM" <?= ($appointment['visit_time'] == "5:00 PM") ? "selected" : "";?>>5:00 PM</option>
                                      <option value="6:00 PM" <?= ($appointment['visit_time'] == "6:00 PM") ? "selected" : "";?>>6:00 PM</option>
                                      <option value="7:00 PM" <?= ($appointment['visit_time'] == "7:00 PM") ? "selected" : "";?>>7:00 PM</option> 
                                    </select>
                                </td> 
                              </tr>   
                              <tr>
                                  <td>Approval*</td>
                                  <td>
                                    <select name="is_approved" class="form-control">    
                                      <option value="1" <?= ($appointment['is_approved'] == 1) ? "selected" : "";?>>Approved</option>
                                      <option value="0" <?= ($appointment['is_approved'] == 0) ? "selected" : "";?>>Not Approved Yet</option>
                                    </select>
                                  </td> 
                              </tr>
                              <tr>
                                  <td>Status*</td>
                                  <td>
                                    <select name="status" class="form-control">          
                                      <option value="1" <?= ($appointment['status'] == 1) ? "selected" : "";?>>Active</option>
                                      <option value="2" <?= ($appointment['status'] == 2) ? "selected" : "";?>>Inactive</option>
                                      <option value="4" <?= ($appointment['status'] == 4) ? "selected" : "";?>>Pending</option>
                                      <option value="8" <?= ($appointment['status'] == 8) ? "selected" : "";?>>Completed</option>
                                      <option value="9" <?= ($appointment['status'] == 9) ? "selected" : "";?>>Expired</option>
                                    </select>  
                                  </td> 
                              </tr>
                              <tr>
                                  <td></td>  
                                  <td>
                                    <input type="submit" name="editAppointment" class="btn btn-danger btn-sm" value="Update Appointment" />
                                  </td> 
                              </tr>      
                        <?php }else{ ?>
                             <tr>
                                  <td colspan="2">No Record Found</td> 
                             </tr>   
                        <?php } ?>
        
                      </tbody>
                </table>
               </div> 
               <?= form_close();?>
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


<?= modalPopup("Confirmation","Do you want to delete this appointment ?");?>
<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>