<?= $this->extend('backend/common/layout') ?> 
<?= $this->section('content') ?>   


<div class="container-fluid">
<br>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url();?>/backend/dashboard/index">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>/backend/analytics/seo_analytics">SEO & Analytics</a></li>
      </ol>
    </nav>
    <br>  

    
    <div class="row">
    <?= $this->include('backend/common/sidebar');?> 
    <div class="col-md-9">
        <h3 class="display-4">
          SEO & Analytics |  
          <a href="<?= base_url();?>/backend/analytics/seo_analytics/addScript" class="btn btn-outline-danger btn-sm ">Add Script</a>
          <a href="<?= base_url();?>/backend/analytics/seo_analytics/addMetaTags" class="btn btn-outline-danger btn-sm">Add MetaTags</a>
        </h3> 
        <div class="table-fluid">
          <?php if(segment(4) ==  "") : ?>
            <?= \Config\Services::session()->getFlashdata('alert');?>  
          <div class="row">
              <div class="table-responsive">
                  <table class="table small">
                      <caption>SEO Scripts & MetaTags</caption>
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">SEO Type</th>
                          <th scope="col">SEO Name</th>
                          <th scope="col">Content</th>
                          <th scope="col">Created/Updated</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th> 
                        </tr>
                      </thead> 
                      <tbody>
                        <?php if(is_array($getSeoSettings)) : ?>
                          <?php $i = 1;foreach($getSeoSettings as $seo) : ?> 
                        <tr>
                          <th scope="row"><?= $i;?></th>
                          <td><?= humanize($seo['setting_type']);?></td>
                          <td><?= $seo['setting_name'];?></td>
                          <td><?= htmlentities($seo['setting_content']);?></td>
                          <td><?= date('F j,Y',strtotime($seo['created_at']));?>/<?= date('F j,Y',strtotime($seo['updated_at']));?></td>
                          <td><label class="<?= $seo['status_badge'];?>"><?= $seo['status_name'];?></label></td> 
                          <td>
                            <a href="<?= base_url();?>/backend/analytics/seo_analytics/edit/<?= $seo['id'];?>"><img src="<?= publicFolder();?>/images/edit.png"  width="20"/></a> |  
                            <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/analytics/seo_analytics/delete/<?= $seo['id'];?>" class="deletePop" />  
                              <img src="<?= publicFolder();?>/images/delete.png" width="20"/>
                            </a>
                          </td> 
                        </tr>
                      <?php $i++;endforeach ?>
                      <?php endif ?>
                     
                      </tbody>
                  </table>
                </div>
          </div>
          <hr>  
          <div class="row">
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Customer/Lead Generated</h5>
                  <canvas id="myChart" style="width: 300px !important"></canvas>
                  <script>    
                  var ctx = document.getElementById('myChart');
                  var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: ['Jan', 'Feb', 'March', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                          datasets: [{
                              label: 'Customer/Lead Generated', 
                              data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                              backgroundColor: [
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(54, 162, 235, 0.2)',
                                  'rgba(255, 206, 86, 0.2)',
                                  'rgba(75, 192, 192, 0.2)',
                                  'rgba(153, 102, 255, 0.2)',
                                  'rgba(255, 159, 64, 0.2)',
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(54, 162, 235, 0.2)',
                                  'rgba(255, 206, 86, 0.2)',
                                  'rgba(75, 192, 192, 0.2)',
                                  'rgba(153, 102, 255, 0.2)',
                                  'rgba(255, 159, 64, 0.2)'
                              ],
                              borderColor: [
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(54, 162, 235, 1)',
                                  'rgba(255, 206, 86, 1)',
                                  'rgba(75, 192, 192, 1)',
                                  'rgba(153, 102, 255, 1)',
                                  'rgba(255, 159, 64, 1)',
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(54, 162, 235, 1)',
                                  'rgba(255, 206, 86, 1)',
                                  'rgba(75, 192, 192, 1)',
                                  'rgba(153, 102, 255, 1)',
                                  'rgba(255, 159, 64, 1)'
                              ],
                              borderWidth: 1
                          }]
                      },
                      options: {
                          scales: {
                              yAxes: [{
                                  ticks: {
                                      beginAtZero: true
                                  }
                              }]
                          }
                      }
                  });
                  </script>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Registered Agent</h5>
                  <canvas id="myChart2" style="width: 300px !important"></canvas>
                  <script>    
                  var ctx = document.getElementById('myChart2'); 
                  var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: ['Jan', 'Feb', 'March', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                          datasets: [{ 
                              label: 'Registered Agent', 
                              data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                              backgroundColor: [
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(54, 162, 235, 0.2)',
                                  'rgba(255, 206, 86, 0.2)',
                                  'rgba(75, 192, 192, 0.2)',
                                  'rgba(153, 102, 255, 0.2)',
                                  'rgba(255, 159, 64, 0.2)',
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(54, 162, 235, 0.2)',
                                  'rgba(255, 206, 86, 0.2)',
                                  'rgba(75, 192, 192, 0.2)',
                                  'rgba(153, 102, 255, 0.2)',
                                  'rgba(255, 159, 64, 0.2)'
                              ],
                              borderColor: [
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(54, 162, 235, 1)',
                                  'rgba(255, 206, 86, 1)',
                                  'rgba(75, 192, 192, 1)',
                                  'rgba(153, 102, 255, 1)',
                                  'rgba(255, 159, 64, 1)',
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(54, 162, 235, 1)',
                                  'rgba(255, 206, 86, 1)',
                                  'rgba(75, 192, 192, 1)',
                                  'rgba(153, 102, 255, 1)',
                                  'rgba(255, 159, 64, 1)'
                              ],
                              borderWidth: 1
                          }]
                      },
                      options: {
                          scales: {
                              yAxes: [{
                                  ticks: {
                                      beginAtZero: true
                                  }
                              }]
                          }
                      }
                  });
                  </script>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Realestate Developers</h5>
                  <canvas id="myChart5" style="width: 300px !important"></canvas>
                  <script>    
                  var ctx = document.getElementById('myChart5');
                  var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: ['Jan', 'Feb', 'March', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                          datasets: [{
                              label: 'Realestate Developers', 
                              data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                              backgroundColor: [
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(54, 162, 235, 0.2)',
                                  'rgba(255, 206, 86, 0.2)',
                                  'rgba(75, 192, 192, 0.2)',
                                  'rgba(153, 102, 255, 0.2)',
                                  'rgba(255, 159, 64, 0.2)',
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(54, 162, 235, 0.2)',
                                  'rgba(255, 206, 86, 0.2)',
                                  'rgba(75, 192, 192, 0.2)',
                                  'rgba(153, 102, 255, 0.2)',
                                  'rgba(255, 159, 64, 0.2)'
                              ],
                              borderColor: [
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(54, 162, 235, 1)',
                                  'rgba(255, 206, 86, 1)',
                                  'rgba(75, 192, 192, 1)',
                                  'rgba(153, 102, 255, 1)',
                                  'rgba(255, 159, 64, 1)',
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(54, 162, 235, 1)',
                                  'rgba(255, 206, 86, 1)',
                                  'rgba(75, 192, 192, 1)',
                                  'rgba(153, 102, 255, 1)',
                                  'rgba(255, 159, 64, 1)'
                              ],
                              borderWidth: 1
                          }]
                      },
                      options: {
                          scales: {
                              yAxes: [{
                                  ticks: {
                                      beginAtZero: true
                                  }
                              }]
                          }
                      }
                  });
                  </script>
                </div>
              </div>
            </div>
          </div>
           <br>
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Registered Property</h5>
                    <canvas id="myChart3" style="width: 300px !important"></canvas>
                  <script>    
                  var ctx = document.getElementById('myChart3');
                  var myChart = new Chart(ctx, {
                      type: 'doughnut',
                      data: {
                          labels: ['Flat','Individual-House','Villa','Plot','Agricultural Land','Commercial'],
                          datasets: [{
                              label: 'Customer/Lead Generated', 
                              data: [12, 19, 3, 5, 2, 3],
                              backgroundColor: [
                              "rgb(255, 99, 132)",
                              "rgb(54, 162, 235)",
                              "rgb(255, 205, 86)",
                              "rgba(75, 192, 192, 1)",
                              "rgba(153, 102, 255, 1)",
                              "rgba(255, 159, 64, 1)"
                              ]
                          }] 
                      }
                  });
                  </script>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>   
              </div>
            </div>
          </div>
          <?php endif ?>
          <?php if(segment(4) ==  "addScript") : ?>
                <br>
                <h3 class="display-4" style="font-size: 20px">Add Script</h3>
                 <br>
                <?= \Config\Services::session()->getFlashdata('alert');?>
                 <div class="table-responsive">
                  <?= form_open('/backend/analytics/seo_analytics/addScript'); ?> 
                  <table class="table">
                      <caption>SEO & Analytics - Script</caption> 
                      <thead>
                      <tbody>
                        <tr>
                          <td style="width:200px">Script Name</td>
                          <td><input type="text" class="form-control" name="script_name" placeholder="Script Name" required/></td>
                        </tr>
                        <tr>  
                          <td style="width:200px">Script Code</td>
                          <td>
                            <textarea class="form-control" name="script_code" placeholder="Place Script Code Here" required=""></textarea>
                          </td>
                        </tr> 
                         <tr>  
                          <td style="width:200px">Status</td>
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
                            <input type="submit" name="addScript" value="Add Script" class="btn btn-danger btn-sm" />
                            <a href="<?= base_url();?>/backend/analytics/seo_analytics" class="btn btn-light btn-sm"/>  
                              Cancel
                            </a>
                          </td> 
                        </tr>
                     
                      </tbody>
                  </table>
                  <?= form_close();?>    
                </div>
          <?php endif ?>
           <?php if(segment(4) ==  "addMetaTags") : ?>
            <br>
                <h3 class="display-4" style="font-size: 20px">Add MetaTag</h3>
                 <br>
                <?= \Config\Services::session()->getFlashdata('alert');?>
                 <div class="table-responsive">
                  <?= form_open('/backend/analytics/seo_analytics/addMetaTags'); ?> 
                  <table class="table">
                      <caption>SEO & Analytics - MetaTag</caption>  
                      <thead>
                      <tbody>
                        <tr>
                          <td style="width:200px">MetaTag Name</td>
                          <td><input type="text" class="form-control" name="metatag_name" placeholder="MetaTag Name" required/></td>
                        </tr>
                        <tr>  
                          <td style="width:200px">MetaTag Content</td> 
                          <td>
                            <textarea class="form-control" name="metatag_content" placeholder="Place MetaTag Content Here" required=""></textarea>
                          </td>
                        </tr> 
                         <tr>  
                          <td style="width:200px">Status</td>
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
                            <input type="submit" name="addMetaTag" value="Add MetaTag" class="btn btn-danger btn-sm" />
                            <a href="<?= base_url();?>/backend/analytics/seo_analytics" class="btn btn-light btn-sm"/>  
                              Cancel
                            </a>
                          </td> 
                        </tr>
                     
                      </tbody>
                  </table>
                  <?= form_close();?>    
                </div>
          <?php endif ?>   
        </div>
    </div>
  </div>


</div>


<?= modalPopup("Confirmation","Do you want to delete SEO option ?");?> 
<?= $this->endSection() ?>