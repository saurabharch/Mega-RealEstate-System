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
         <div class="col-10"><h3 class="display-4">My Added Properties</h3></div> 
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
                    </h4>
                    <h3 class="card-title">
                      <?php if($property['listing_type'] == "sell") : ?> 
                         <span>
                          <?= number_to_currency($property['total_price'], 'INR');?> INR
                        </span>  
                      <?php endif ?>  

                      <?php if($property['listing_type'] == "rent") : ?>    
                         <span>
                          <?= number_to_currency($property['rent_per_mon'], 'INR');?>per month
                        </span> 
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
                          <?= $property['propertyType']['type_name'];?> For <?= ucfirst($property['listing_type']);?> 
                           <?php if(isAdsRunning($property['id']) == true){ ?>

                           <?php if($property['has_ads'] == 1){ ?>
                               | <label class="badge badge-warning">Your Ad will be featured for 23 days</label>  
                           <?php }elseif($property['has_ads'] == 2){ ?>
                               | <label class="badge badge-warning">Your Ad will be sponsored for 23 days</label>   
                            <?php } ?>
                            
                            <?php }else{ ?>
                               <?php if($property['has_ads'] == 1){ ?>
                               | <label class="badge badge-warning">Your featured ad has expired</label>  
                               <?php }elseif($property['has_ads'] == 2){ ?>
                                   | <label class="badge badge-warning">Your sponsored ad has expired</label>   
                                <?php } ?>
                            <?php } ?>
                        </h6>   

                    </p>
                    <p class="card-text small">
                       Posted By : <?= ucfirst($property['contact']['firstname']).' '.ucfirst($property['contact']['lastname']);?>
                     | Posted At : <?= date('D, d M Y', strtotime($property['created_at']));?>  
                     | <a href="<?= base_url();?>/property-detail/<?= $property['id'];?>" class="text-success">Full Detail</a>
                     <?php if(isAdsRunning($property['id']) == false) : ?> 
                     <a href="javascript:void(0)" class="btn btn-success btn-sm float-right calcAdsPrice" data-adstype="<?= $property['has_ads'];?>" data-pid="<?= $property['id'];?>">
                      Ads Campaign
                     </a>
                     <?php endif ?>
                    </p>

                    <?php if($property['has_ads'] == 1){ ?>
                        <label class="badge badge-warning" style="position: absolute;margin:-5px -120px;padding:5px">
                          FEATURED <i class="fas fa-ad" style="font-size: 14px"></i>
                        </label>
                    <?php }elseif($property['has_ads'] == 2){ ?>
                        <label class="badge badge-info" style="position: absolute;margin:0 -120px;padding:5px">
                          SPONSORED <i class="fas fa-ad" style="font-size: 14px"></i> 
                        </label>  
                    <?php } ?>

                  </div>
                </div>
              </div>
           </div>  
       
      <?php endforeach ?>
      
      <?php }else{ ?> 
         <div class="col-md-12 text-center">No Added Properties</div>
      <?php } ?>
      
     

       
      </div>
    </div>
  </div>

</main> 



<div class="modal fade" id="adsPaymentPopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ads Campaigne</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <?= form_open('/payment/createAdsPayment');?>
          <table class="table table-borderless dateAds">
            <tr>
              <td>
                <label for="recipient-name" class="col-form-label">Feature From:</label>
                <input type="text" class="form-control datePicker" name="featured_from" id="featured_from" placeholder="Start Feature Date" required="">
              </td> 
              <td>
                <label for="recipient-name" class="col-form-label">Feature Upto:</label>
                <input type="text" class="form-control datePicker" name="featured_upto" id="featured_upto" placeholder="End Feature Date"placeholder="Feature this property From" required=""> 
              </td>
            </tr>
          </table>  
          
          <span id="resultCalcAdsPrice"></span>
          <input type="hidden" id="adsPricePerDay" name="adsPricePerDay" value="<?= adsPricePerDay();?>">
          <input type="hidden" id="sPropertyId" name="sPropertyId" > 
          <input type="hidden" id="sAdsType" name="sAdsType" > 
          <?= form_close();?>
      </div>
      
    </div>
  </div>
</div>

<?= $this->include('common/footer') ?> 
<?= $this->endSection() ?>