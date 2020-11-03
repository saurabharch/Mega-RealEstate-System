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
       
        <div class="table-responsive">
         
          <?php if($section == "countries") : ?>
          <h3 class="display-4">Countries <a href="<?= base_url();?>/backend/analytics/country_city_state/addCountry" class="btn btn-danger btn-sm float-right"> + Add New Country</a></h3>
          <?= \Config\Services::session()->getFlashdata('alert');?>  
          <table class="table small shadow">
              <caption>List of countries</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Symbol</th>
                  <th scope="col">Code</th>
                  <th scope="col">Created</th> 
                  <th scope="col">Updated</th> 
                  <th scope="col">Status</th> 
                  <th scope="col">Action</th> 
                </tr>
              </thead>
              <tbody>
                <?php $i=1;foreach($countries as $country) : ?>
                <tr>
                  <th scope="row"><?= $i;?></th>
                  <td><?= $country['country_name'];?></td>
                  <td><?= $country['symbol'];?></td>
                  <td><?= $country['code'];?></td>
                  <td><?= date('F j,Y',strtotime($country['created_at']));?></td>
                  <td><?= date('F j,Y',strtotime($country['updated_at']));?></td>
                  <td><label class="<?= $country['status_badge'];?>"><?= $country['status_name'];?></label></td>
                  <td>
                    <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/analytics/country_city_state/countries/delete/<?= $country['id'];?>" class="deletePop">
                      <img src="<?= publicFolder();?>/images/delete.png" width="20"> 
                    </a> 
                  </td>
                </tr>
                <?php $i++;endforeach ?>
              </tbody>
          </table>
          <?php endif ?>

          <?php if($section == "cities") : ?>
          <h3 class="display-4">Cities <a href="<?= base_url();?>/backend/analytics/country_city_state/addCity" class="btn btn-danger btn-sm float-right"> + Add New City</a></h3> 
          <?= \Config\Services::session()->getFlashdata('alert');?> 
          <table class="table small shadow">
              <caption>List of cities</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">City Name</th>
                  <th scope="col">Country Id</th>
                  <th scope="col">State</th>
                  <th scope="col">Created</th> 
                  <th scope="col">Updated</th> 
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;foreach($cities as $city) : ?>
                <tr>
                  <th scope="row"><?= $i;?></th>
                  <td><?= $city['city_name'];?></td>
                  <td><?= $city['country_name'];?></td>
                  <td><?= $city['state_name'];?></td>
                  <td><?= date('F j,Y',strtotime($city['created_at']));?></td>
                  <td><?= date('F j,Y',strtotime($city['updated_at']));?></td>
                  <td><label class="<?= $city['status_badge'];?>"><?= $city['status_name'];?></label></td>
                  <td>
                    <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/analytics/country_city_state/cities/delete/<?= $city['id'];?>" class="deletePop">
                      <img src="<?= publicFolder();?>/images/delete.png" width="20"> 
                    </a> 
                  </td>
                </tr>
                 <?php $i++;endforeach ?>
              </tbody>
          </table>
          <?php endif ?>

          <?php if($section == "states") : ?>
          <h3 class="display-4">States <a href="<?= base_url();?>/backend/analytics/country_city_state/addState" class="btn btn-danger btn-sm float-right"> + Add New State</a></h3> 
          <?= \Config\Services::session()->getFlashdata('alert');?> 
          <table class="table small shadow">
              <caption>List of states</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">State Name</th>
                  <th scope="col">Country Id</th>
                  <th scope="col">Created</th>
                  <th scope="col">Updated</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
               <?php $i=1;foreach($states as $state) : ?>
                <tr>
                  <th scope="row"><?= $i;?></th>
                  <td><?= $state['state_name'];?></td>
                  <td><?= $state['country_name'];?></td>
                  <td><?= date('F j,Y',strtotime($state['created_at']));?></td>
                  <td><?= date('F j,Y',strtotime($state['updated_at']));?></td>
                  <td><label class="<?= $state['status_badge'];?>"><?= $state['status_name'];?></label></td>
                  <td> 
                    <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/analytics/country_city_state/states/delete/<?= $state['id'];?>" class="deletePop">
                      <img src="<?= publicFolder();?>/images/delete.png" width="20"> 
                    </a>  
                  </td>
                </tr>
                 <?php $i++;endforeach ?>
              </tbody>
          </table>
          <?php endif ?>


           <?php if($section == "") : ?>
          
          <h3 class="display-4">All Countries, States & Cities</h3> 
          <div class="shadow card">
            <h5 class="card-header">Countries</h5>
            <div class="card-body">
              <table class="table small">
              <caption>List of countries</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Symbol</th>
                  <th scope="col">Code</th>
                  <th scope="col">Created</th> 
                  <th scope="col">Updated</th> 
                  <th scope="col">Status</th> 
                </tr>
              </thead>
              <tbody>
                <?php $i=1;foreach($countries as $country) : ?>
                <tr>
                  <th scope="row"><?= $i;?></th>
                  <td><?= $country['country_name'];?></td>
                  <td><?= $country['symbol'];?></td>
                  <td><?= $country['code'];?></td>
                  <td><?= date('F j,Y',strtotime($country['created_at']));?></td>
                  <td><?= date('F j,Y',strtotime($country['updated_at']));?></td>
                  <td><label class="<?= $country['status_badge'];?>"><?= $country['status_name'];?></label></td>
                </tr>
                <?php $i++;endforeach ?>
              </tbody>
          </table>
               <a href="<?= base_url();?>/backend/analytics/country_city_state/addCountry" class="btn btn-danger btn-sm">Add Country</a>
               <a href="<?= base_url();?>/backend/analytics/country_city_state/countries" class="btn btn-dark btn-sm float-right">See All</a>
            </div>
          </div>

            <br>

           <div class="shadow card">
            <h5 class="card-header">States</h5>
            <div class="card-body">
               <table class="table small">
              <caption>List of states</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">State Name</th>
                  <th scope="col">Country Id</th>
                  <th scope="col">Created</th>
                  <th scope="col">Updated</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
               <?php $i=1;foreach($states as $state) : ?>
                <tr>
                  <th scope="row"><?= $i;?></th>
                  <td><?= $state['state_name'];?></td>
                  <td><?= $state['country_name'];?></td>
                  <td><?= date('F j,Y',strtotime($state['created_at']));?></td>
                  <td><?= date('F j,Y',strtotime($state['updated_at']));?></td>
                  <td><label class="<?= $state['status_badge'];?>"><?= $state['status_name'];?></label></td>
                </tr>
                 <?php $i++;endforeach ?>
              </tbody>
          </table>
              <a href="<?= base_url();?>/backend/analytics/country_city_state/addState" class="btn btn-danger btn-sm">Add State</a>
              <a href="<?= base_url();?>/backend/analytics/country_city_state/states" class="btn btn-dark btn-sm float-right">See All</a>
            </div>
          </div>

          <br>


           <div class="shadow card">
            <h5 class="card-header">Cities</h5>
            <div class="card-body">
                <table class="table small">
              <caption>List of states</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">City Name</th>
                  <th scope="col">Country Id</th>
                  <th scope="col">State</th>
                  <th scope="col">Created</th> 
                  <th scope="col">Updated</th> 
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;foreach($cities as $city) : ?>
                <tr>
                  <th scope="row"><?= $i;?></th>
                  <td><?= $city['city_name'];?></td>
                  <td><?= $city['country_name'];?></td>
                  <td><?= $city['state_name'];?></td>
                  <td><?= date('F j,Y',strtotime($city['created_at']));?></td>
                  <td><?= date('F j,Y',strtotime($city['updated_at']));?></td>
                  <td><label class="<?= $city['status_badge'];?>"><?= $city['status_name'];?></label></td>
                </tr>
                 <?php $i++;endforeach ?>
              </tbody>
          </table>
               <a href="<?= base_url();?>/backend/analytics/country_city_state/addCity" class="btn btn-danger btn-sm">Add City</a>
               <a href="<?= base_url();?>/backend/analytics/country_city_state/cities" class="btn btn-dark btn-sm float-right">See All</a>
            </div>
          </div>
          
          <?php endif ?>
           
          
          <?php if($section == "addCountry") : ?> 
            
             <div class="shadow card">
            <h5 class="card-header">Add New Country</h5> 
            <div class="card-body">
              <?= form_open('backend/analytics/country_city_state');?>  
                <table class="table small">
                  <tbody>
                  
                    <tr>
                      <td>Country Name</td>
                      <td><input type="text" class="form-control" name="country_name" required="" placeholder="Country Name" /></td>
                    </tr>
                    <tr>
                      <td>Symbol</td>
                      <td><input type="text" class="form-control" name="symbol" required="" placeholder="Country Symbol"/></td>
                    </tr>
                    <tr>
                      <td>Code</td>
                      <td><input type="text" class="form-control" name="code" required="" placeholder="Country Code"/></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>
                        <select class="form-control" name="status"> 
                          <?php  foreach(statusList() as $status) : ?>
                            <option value="<?= $status['id'];?>"><?= $status['status_name'];?></option>
                          <?php endforeach ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                        <input type="submit" name="addCountry" class="btn btn-danger btn-sm" value="Add Country" />
                      </td>
                    </tr>
                  </tbody>
                </table>
                <?= form_close();?>
            </div>
          </div>

          <?php endif ?>
          <?php if($section == "addState") : ?> 
          
          <div class="shadow card">
            <h5 class="card-header">Add New State</h5> 
            <div class="card-body">
              <?= form_open('backend/analytics/country_city_state');?>  
                <table class="table small">
                  <tbody>
                  
                    <tr>
                      <td>State Name</td>
                      <td><input type="text" class="form-control" name="state_name" required="" placeholder="State Name" /></td>
                    </tr>
                    <tr>
                      <td>Country</td>
                      <td>
                        <select name="country_id" class="form-control">
                          <?php foreach($countries as $country) : ?>
                          <option value="<?= $country['id'];?>"><?= $country['country_name'];?></option>
                          <?php endforeach ?>   
                       </select>
                    </td>
                    </tr>    
                    <tr>
                      <td>Status</td>
                      <td>
                        <select class="form-control" name="status">  
                          <?php  foreach(statusList() as $status) : ?>
                            <option value="<?= $status['id'];?>"><?= $status['status_name'];?></option>
                          <?php endforeach ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                        <input type="submit" name="addState" class="btn btn-danger btn-sm" value="Add State" />
                      </td>
                    </tr>
                  </tbody>
                </table>
                <?= form_close();?>
            </div>
          </div>

          <?php endif ?>
          <?php if($section == "addCity") : ?> 
          
           <div class="shadow card">
            <h5 class="card-header">Add New City</h5> 
            <div class="card-body">
              <?= form_open('backend/analytics/country_city_state');?>  
                <table class="table small">
                  <tbody>
                  
                    <tr>
                      <td>City Name</td>
                      <td><input type="text" class="form-control" name="city_name" required="" placeholder="City Name" /></td>
                    </tr>
                    <tr>
                      <td>Country</td>
                      <td>
                        <select name="country_id" class="form-control">
                          <?php foreach($countries as $country) : ?>
                            <option value="<?= $country['id'];?>"><?= $country['country_name'];?></option>
                          <?php endforeach ?>    
                       </select>
                    </td>
                    </tr>
                     <tr>
                      <td>State</td>
                      <td>
                        <select name="state_id" class="form-control">
                          <?php foreach($states as $state) : ?>
                            <option value="<?= $state['id'];?>"><?= $state['state_name'];?></option>
                          <?php endforeach ?>     
                       </select>
                    </td>
                    </tr>    
                    <tr>
                      <td>Status</td> 
                      <td>
                        <select class="form-control" name="status">  
                          <?php  foreach(statusList() as $status) : ?>
                            <option value="<?= $status['id'];?>"><?= $status['status_name'];?></option>
                          <?php endforeach ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                        <input type="submit" name="addCity" class="btn btn-danger btn-sm" value="Add City" />
                      </td>
                    </tr>
                  </tbody>
                </table>
                <?= form_close();?>
            </div>
          </div>

          <?php endif ?>









        </div>
    </div>
  </div>



</div>


<?= modalPopup("Confirmation","Do you want to delete this ".singular(segment(4))."?");?> 
<?= $this->endSection() ?>