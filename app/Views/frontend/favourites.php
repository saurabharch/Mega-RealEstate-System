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
         <div class="col-10"><h3 class="display-4">My Favourite Properties</h3></div>
         <div class="col-2">
            <!-- <select class="custom-select btn-sm custom-select-lg mb-4" style="width:120px">
              <option selected>Filter</option>
            </select> -->
         </div>
       </div>
       
       <hr>
      <div class="row">  
        
       <?php if(is_array($properties) && isset($properties)){ ?>
       <?php foreach($properties as $property) : ?>

       <div class="shadow card mb-3" style="width:100%;" >
        <div class="row no-gutters">
          <div class="col-md-4">
           <!--  <img src="https://cdn.pixabay.com/photo/2018/03/31/06/31/dog-3277416_960_720.jpg" class="card-img" width="150"> -->
             
             <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner"> 
                <?php if(is_array($property['images'])) : ?>
                <?php foreach($property['images'] as $key => $img) : ?> 
                <?php $active = ($key == 1) ? "active": "" ;?> 
                <div class="carousel-item <?= $active;?>"> 
                    <img src="<?= base_url().'/property-images/'.$img['image_name'];?>" class="d-block w-100 imgp">
                </div>
                <?php endforeach ?>
                <?php endif ?>
                
               </div>
             </div>

          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h4 class="card-title">
                   <span><?= @word_limiter($property['title'],10);?></span> 

                   <!-- <img src="<?= publicFolder();?>/images/star-empty.png" width="25" class="float-right favourite" data-star="0"/> -->

                   <a href="<?= base_url();?>/favourites/<?= $property['id'];?>/favourite">
                        <?php if($property['isFavourited'] == true){ ?> 
                            <img src="<?= publicFolder();?>/images/star.png" width="25" class="float-right favourite">
                        <?php }else{ ?>
                            <img src="<?= publicFolder();?>/images/star-empty.png" width="25" class="float-right favourite">
                        <?php } ?>  
                    </a>

              </h4>
              <h3 class="card-title">
                <?php if($property['listing_type'] == "sell") : ?> 
                   <span><?= displayPrice($property['total_price']);?></span>  
                <?php endif ?>  

                <?php if($property['listing_type'] == "rent") : ?>    
                   <span><?= displayPrice($property['rent_per_mon']);?>/mon</span> 
                <?php endif ?>
                 
                   <?php if($property['condition_type']) : ?>  
                        <button class="btn btn-success btn-sm text-white"><?= ucfirst($property['condition_type']);?></button>
                    <?php endif?>
                       | 
                    <?php if($property['bhk_type']) : ?>
                        <button class="btn btn-outline-danger btn-sm"><?= ucfirst($property['bhk_type']);?></button>
                    <?php endif ?>
                    <?php if($property['status_type']) : ?>
                        <button class="btn btn-outline-danger btn-sm"><?= str_replace('_',' ',ucfirst($property['status_type']));?></button>
                    <?php endif ?>  
                    <?php if($property['condition_type']) : ?>
                        <button class="btn btn-outline-danger btn-sm"><?= ucfirst($property['condition_type']);?></button>
                    <?php endif ?>
                    <?php if($property['facing']) : ?>
                        <button class="btn btn-outline-danger btn-sm"><?= ucfirst($property['facing']);?></button>
                    <?php endif ?>
                    <?php if($property['complex_type']) : ?>
                        <button class="btn btn-outline-danger btn-sm"><?= ucfirst($property['complex_type']);?></button>
                    <?php endif ?> 


              </h3>
              <p class="card-text"><?= word_limiter($property['description'],20);?></p>
              <p class="card-text">
                  <h6>
                    <?= $property['propertyType']['type_name'];?> For <?= ucfirst($property['listing_type']);?> |  
                      <?php if($property['isInterested'] == true){ ?> 
                       
                            <div class="btn-group float-right"> 
                            <button class="btn btn-outline-danger btn-sm">
                              <b><img src="<?= publicFolder();?>/images/correct-1.png" width="20"/> Contacted</b>
                            </button>
                            <button class="btn btn-danger btn-sm">
                              <img src="<?= publicFolder();?>/images/contact-phone.png" width="15"/>

                              <b><?php echo $property['contact']['mobile'];?></b> 
                            </button>
                            </div>
                        <?php }else{ ?>
                           <a href="<?= base_url();?>/property-detail/<?= $property['id'];?>/interested" class="btn btn-outline-danger btn-sm">
                            I'm Interested
                          </a>
                    <?php } ?>  
                   
                  </h6>   

              </p>
              <p class="card-text small">
                 Posted By : <?= ucfirst($property['contact']['firstname']).' '.ucfirst($property['contact']['lastname']);?>  | Posted At : <?= time_stamp(strtotime($property['created_at']));?> | <a href="<?= base_url();?>/property-detail/<?= $property['id'];?>" class="text-success">Full Detail</a>
              </p>
            </div>
          </div>
        </div>
      </div> 
      
      <?php endforeach ?>
      
      <?php }else{ ?> 
         <div class="col-md-12 text-center">No Favourite Properties</div>
      <?php } ?>
      


       
      </div>
    </div>
  </div>

</main> 



<?= $this->include('common/footer') ?> 



<?= $this->endSection() ?>