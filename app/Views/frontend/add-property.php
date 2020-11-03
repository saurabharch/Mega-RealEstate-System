<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

<?= $this->include('common/header') ?>
 
 
<main role="main"> 

  <div class="album py-5 bg-light"> 
   
    <div class="container"> 
       <h3 class="display-4">Add Property <a href="<?= base_url();?>/properties" class="btn btn-outline-danger float-right"> See My Listings</a></h3>
       <hr> 
       <div class="row">


      <?php if($activity == 'sell'){ ?>  
        
         <div class="col-md-8 order-md-1">  

            <!---- Flat Section -----> 

             <?= \Config\Services::session()->getFlashdata('alert');?>
            
             <?= form_open('add-property','class="needs-validation" novalidate') ?>
             <?php //foreach ($profile as $info){} ?>
              <div class="row"> 
                <div class="col-md-5 mb-3">
                   <label for="country">Listing Type </label><br>
                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                      <label class="btn btn-outline-danger active" data-listingtype="sell" id="listing_type_lb">   
                        <input type="radio" name="listing_type" class="listing_type" id="listing_type" value="sell" checked> Selling
                      </label>
                      <label class="btn btn-outline-dark" data-listingtype="rent" id="listing_type_lb">  
                        <input type="radio" name="listing_type" class="listing_type" id="listing_type" value="rent"> Renting 
                      </label>
                    </div>
                </div>  
                <div class="col-md-5 mb-3">
                  <label for="country">Property Type</label> 
                  <select class="custom-select d-block w-100" name="property_type" id="property_type" required > 
                       <option selected="true" disabled="disabled" value="">Select property type</option>
                      <?php foreach ($property_type as $ptype) : ?>
                        <option value="<?= $ptype['id'];?>" > 
                          <?= $ptype['type_name'];?>  
                        </option>
                      <?php endforeach ?>
                  </select>
                  <div class="invalid-feedback">
                    Please select property type.
                  </div>
                </div>
                <input type="hidden" id="listing_type_hide" name="listing_type_hide" value="sell"/> 
              </div>



            <div id="dynamicPageLoad"></div> 



             <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="country">Amenities</label><br>
                        <?php foreach($amenities as $am) : ?>
                        <div class="form-check form-check-inline"> 
                          <input class="form-check-input" type="checkbox" id="amenities" name="amenities[]" value="<?= $am['id'];?>">
                          <label class="form-check-label" for="amenities"><?= $am['name'];?></label>
                        </div>
                      <?php endforeach ?>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 mb-3">
                   <label for="country">Facing </label>
                    <div class="btn-group btn-block btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="facing" id="facing" value="north" checked> North
                      </label>
                      <label class="btn btn-outline-danger">
                        <input type="radio" name="facing" id="facing" value="south"> South 
                      </label>
                      <label class="btn btn-outline-danger">
                        <input type="radio" name="facing" id="facing" value="east"> East 
                      </label>
                      <label class="btn btn-outline-danger">
                        <input type="radio" name="facing" id="facing" value="west"> West 
                      </label>
                    </div>
                </div>
              </div>


              <hr class="mb-4"> 

              <h4 class="mb-3">Property Detail</h4>

               <div class="row">
                <div class="col-md-10 mb-3">
                    <label for="title">Title</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="title" required />
                      <div class="invalid-feedback">
                         Title required!
                       </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="title">Description</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" placeholder="Please input" name="description" required></textarea>
                      <div class="invalid-feedback">
                         A little description required!
                       </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="title">Specification(optional)</label>
                    <div class="input-group">
                      <textarea type="text" class="form-control" placeholder="Please input" name="specification"></textarea>
                    </div>
                </div>
              </div>
             
              <hr class="mb-4"> 

              <div class="row">
                <div class="col-md-8 mb-3">
                   <label for="country">Do you want to make it public ? </label>
                    <div class="btn-group btn-block btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="pub_pri" id="pub_pri" value="1" checked> Make it public
                      </label>
                      <label class="btn btn-outline-danger">
                        <input type="radio" name="pub_pri" id="pub_pri" value="0"> Make it private 
                      </label>
                    </div>
                    <small class="form-text text-muted">
                       Making it private your property won't be visible. 
                   </small>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 mb-3">
                   <label for="country">Do you need a helping hand? (Premium Ads)</label>  
                    <div class="btn-group btn-block btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="ads" id="ads" value="0" checked> Skip for later
                      </label>
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="ads" id="ads" value="1" > Make it Featured
                      </label>
                      <label class="btn btn-outline-danger">
                        <input type="radio" name="ads" id="ads" value="2"> Sponsored Ads  
                      </label>
                    </div>
                    <small class="form-text text-muted">
                      Get featured or sponsored badge to reach your property to more buyers! 
                   </small>
                </div>
              </div>
              
              <hr class="mb-4">

              <a href="<?= base_url().'/add-property';?>" class="btn btn-outline-dark btn-lg">Cancel</a> 
              <input class="btn btn-outline-danger btn-lg " type="submit" name="add_property" value="Save and add photos"/> 

            <?= form_close();?></div>
      <?php }else{ ?>
         <div class="col-md-8 order-md-1 text-center">
           <!-- <h3 class="display-4" style="font-size: 25px;">To add property change your activity to seller mode</h3> -->
              <div class="alert alert-danger" role="alert"> 
                <h4 class="alert-heading">To add property change your activity to seller mode!</h4>
                <p>Only seller can upload, advertise, features and sponsored properties</p>
                <hr>
                <p class="mb-0"><a href="<?= base_url();?>/profile" class="btn btn-danger btn-sm">Click here to update activity</a></p>
              </div>
         </div>
      <?php } ?>  

      <div class="col-md-4 order-md-2">
        <h3 class="text-left">Sponsored Ads</h3>
          <?php if(is_array($sponsoredPropertiesAds)) : ?>
          <?php $i = 1;foreach($sponsoredPropertiesAds as $property) : ?>
              <?php if($i < 3) : ?>
                <div class="card" style="width: 18rem;"> 
                  <?php foreach($property['images'] as $r) : ?>
                    <?php if($r['is_thumbnail'] == 1) : ?> 
                      <img src="<?= publicFolder().'/property-images/'.$r['image_name'];?>" class="card-img-top" alt="...">
                    <?php endif ?> 
                  <?php endforeach ?>
                 
                    <?php if($property['listing_type'] == "sell") : ?>
                       <label class="btn btn-outline-warning btn-sm" style="position: absolute;margin:5px"><?= $property['total_price'];?> INR</label>
                    <?php endif ?>

                    <?php if($property['listing_type'] == "rent") : ?>
                       <label class="btn btn-outline-warning btn-sm" style="position: absolute;margin:5px">Rs <?= $property['rent_per_mon'];?> /Month</label>
                    <?php endif ?>
                    
                   <?php if($property['propertyCity']) : ?>
                       <label class="badge badge-success" style="position: absolute;margin:157px 0  0 199px">
                         <small><img src="<?= publicFolder();?>/images/location.png" width="15"/> <?= $property['propertyCity']['city_name'];?></small>
                        </label>
                    <?php endif ?>

                  <label class="badge badge-warning">For <?= ucfirst($property['listing_type']);?></label> 
                      <div class="card-body" style="margin-top: -16px"> 
                        <a href="<?= base_url();?>/property-detail/<?= $property['id'];?>" target="__self" class="stretched-link text-decoration-none text-dark">
                          <p class="card-text"><b><?= word_limiter($property['title'],5);?></b>
                          <br>
                          <?= ucfirst($property['propertyType']['type_name']);?> |
                          <?php if($property['status_type']) : ?>
                            <small><?php echo humanize($property['status_type']);?></small>
                          <?php endif ?>
                          <?php if($property['bhk_type']) : ?>
                            | <small><?php echo humanize($property['bhk_type']);?></small>
                          <?php endif ?>
                          <?php if($property['condition_type']) : ?>
                            | <small><?php echo humanize($property['condition_type']);?></small>
                          <?php endif ?>
                           <br> 
                           <small>Posted : <?= date('D, d M Y', strtotime($property['created_at']));?></small> 
                          </p> 

                        </a>
                      </div>
                </div> 
                <br> 
                  <?php if($i > 3) : ?>
                  <div class="card" style="width: 18rem;">   
                  <a href="<?= base_url();?>/browse/?q=sponsored" target="__self" class="btn btn-outline-danger btn-block btn-sm">See All</a>
                  </div>
                  <?php endif ?>  
            <?php endif ?>  
          <?php $i++;endforeach ?>
          <?php endif ?>
      </div>



  </div>

    </div>
  </div>

</main>

<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>