
<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

<link href="https://getbootstrap.com/docs/4.5/examples/album/album.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/4.5/assets/css/docs.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <?= $this->include('common/header') ?>

<main role="main"> 

  <div class="album py-5 bg-light">
    
    <div class="container">
       <div class="row">
         <div class="col-10"><h3 class="display-4">My Notifications</h3></div>
         <div class="col-2">
            <!-- <select class="custom-select btn-sm custom-select-lg mb-4" style="width:120px">
              <option selected>Filter</option>
            </select> -->
         </div> 
       </div>
       
       <hr>
      <div class="row">  
        
       <ul class="list-unstyled">
		  <?php if(is_array($notifications) && isset($notifications)){ ?>
             <?php foreach($notifications as $notification) : ?>
                 <li class="media">
				    <img src="..." class="mr-3" alt="...">
				    <div class="media-body">
				      <h5 class="mt-0 mb-1">List-based media object</h5>
				      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
				    </div>
				  </li>
             <?php endforeach ?>
             <?php }else{ ?>
                  <li class="media">
				    <img src="<?= publicFolder();?>/images/notifications.png" class="mr-3" alt="...">
				    <div class="media-body">
				      <h5 class="mt-0 mb-1">No Notifications Available For You</h5>
				      <p>All notifications will be available soon</p> 
				    </div>
				  </li>
          <?php } ?>
		</ul>

       
      


       
      </div>
    </div>
  </div>

</main> 



<?= $this->include('common/footer') ?> 



<?= $this->endSection() ?>