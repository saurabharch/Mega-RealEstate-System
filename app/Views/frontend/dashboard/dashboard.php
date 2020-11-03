<?= $this->extend('common/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('common/header') ?>

<style type="text/css">
  .card-title{
    font-size: 20px;
    font-weight: bold;
  }
</style>
<script>
       window.onload = function() {
 
        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          title:{
            text: "Sales Data"
          },
          axisY: {
            title: "Property Price (in INR)",
            includeZero: true,
            prefix: "₹"
          },
          data: [{
            type: "bar",
            yValueFormatString: "₹#,##0",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo actualSalesData(); ?>
          }]
        });
        chart.render();
         
        }
   </script>
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
                <h1 class="display-4">Dashboard</h1>
                <div class="card-deck text-center">
                  <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">#Listings</div>
                    <div class="card-body">
                      <h5 class="display-4 card-title"><?= tabNotificationCount()['listings'];?></h5>
                    </div>
                  </div>

                   <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">#Sales</div> 
                    <div class="card-body">
                      <h5 class="display-4 card-title"><?= tabNotificationCount()['sales'];?></h5>
                    </div>
                  </div>

                   <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Σ(Sales Amount)</div>
                    <div class="card-body">
                      <h5 class="display-4 card-title"><?= number_to_currency($totalSalesAmount, 'INR');?></h5>  
                    </div>
                  </div>

                  <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Σ(Target Amount)</div> 
                    <div class="card-body">
                      <h5 class="display-4 card-title"><?= number_to_currency($totalTarget, 'INR');?></h5>
                    </div>
                  </div>

                  <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header"> Σ(Target Vs Actual)%</div>
                    <div class="card-body">
                      <h5 class="display-4 card-title">
                        <?php
                          if($totalTarget == 0)
                          {
                            echo 0;
                          }else{
                            echo ($totalActual/$totalTarget)*100;
                          } 
                        ?>%
                      </h5> 
                    </div>
                  </div>
                </div> 

                <h3 class="display-4" style="font-size: 24px">Calculation</h3>
                <div class="shadow d-flex p-2 bd-highlight">
                   <b>&nbsp;&nbsp;Actual Amount</b> = Σ (Total Price Of All Sales) |
                   <b>&nbsp;&nbsp;Target Amount</b> = Σ (Total Price Of All Listings)
                </div>
                
                 <br>
                <h3 class="display-4" style="font-size: 24px">Target vs Actual </h3>

                 <div class="row">
                    <div class="col-md-12">
                         <div class="card">
                            <div class="card-body">
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                            </div>   
                          </div> 
                    </div>
                  </div>



                <br>
                <h3 class="display-4" style="font-size: 24px">Stats</h3>

                 <div class="row">
                    <div class="col-sm-4">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Listings Views</h5>
                          <canvas id="myChart" style="width: 300px !important"></canvas>
                          <script>    
                          var ctx = document.getElementById('myChart');
                          var myChart = new Chart(ctx, {
                              type: 'bar',
                              data: {
                                  labels: ['Jan', 'Feb', 'March', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                                  datasets: [{
                                      label: 'My Listings Views', 
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
                          <h5 class="card-title">Total Earning</h5>
                          <canvas id="myChart2" style="width: 300px !important"></canvas>
                          <script>    
                          var ctx = document.getElementById('myChart2'); 
                          var myChart = new Chart(ctx, {
                              type: 'bar',
                              data: {
                                  labels: ['Jan', 'Feb', 'March', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                                  datasets: [{ 
                                      label: 'Total Earning', 
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


              </div>
            </div>
            <hr>
            
    </div>
  </div> 
</main> 



<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>