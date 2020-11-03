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
        <h3 class="display-4">Dashboard</h3>
         <hr>
         
         <div class="card-deck">
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                  <div class="card-header">Total Properties</div>
                  <div class="card-body">
                    <h5 class="card-title display-4 text-center"><?= $totalProperties;?></h5> 
                    <p></p>
                  </div>
                </div>
                 <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                  <div class="card-header">Total Agents</div>
                  <div class="card-body">
                    <h5 class="card-title display-4 text-center"><?= $totalAgents;?></h5>
                    <!--  <p class="text-center">Active - 56 | Blocked - 6</p> -->
                  </div>
                </div>
                 <div class="card border-dark mb-3" style="max-width: 18rem;">
                  <div class="card-header">Total Developers</div>
                  <div class="card-body">
                    <h5 class="card-title display-4 text-center"><?= $totalDevelopers;?></h5>
                     <!-- <p class="text-center">Active - 56 | Blocked - 6</p> -->
                  </div>
                </div>
                 <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                  <div class="card-header">Total Staff</div>
                  <div class="card-body">
                    <h5 class="card-title display-4 text-center"><?= $totalStaff;?></h5> 
                    <p class="text-center">Admin - <?= $totalAdmin;?> | Sub Admin - <?= $totalSubAdmin;?></p>
                  </div>
                </div>        
         </div>
    

    </div>
  </div>


</div>

<?= $this->endSection() ?>