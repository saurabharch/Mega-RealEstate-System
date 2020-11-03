<?= $this->extend('common/layout') ?>
<?= $this->section('content') ?>

<style type="text/css">
  select,option {
    font-size: 15px !important;
  }

</style>


<div class="corner-ribbon right">
  <a href="https://github.com/algobasket/RealEstate" class="stretched-link text-white" target="__self">
    <b>Github</b>
  </a> 
</div> 

<?= $this->include('common/header');?>

<main role="main">

  <section class="jumbotron text-center" style="background-color: rgba(0,0,0,.1);">
    <div class="container">
      <!-- <center>
       <a href="<?= base_url();?>"> 
        <img src="<?= publicFolder();?>/images/propertyraja.png" width="300"/> 
       </a>
      </center> -->
      <h1>Welcome back, continue your home search</h1>
      <p class="lead text-muted">India's No 1 Property Site</p>
      <p>

        <center>
      	<div class="input-group">
        
			      <select class="form-control form-control-lg col-3 searchByListingType">  
	             <option value="sell">Buy</option>
	             <option value="rent">Rent</option>
            </select>
			      <select class="form-control form-control-lg col-7 searchByPropertyType" style="width: 100px">
                <option value="any" selected>Any</option>
	              <?php foreach($property_type as $pt) : ?>
                 <option value="<?= $pt['id'];?>"><?= ucfirst($pt['type_name']);?></option>
               <?php endforeach ?> 
            </select>
             <div class="input-group-append">
              <span class="input-group-text">Under</span>
            </div>
            <select class="form-control form-control-lg col-3 searchByPriceType" style="width: 60px">
	             <option value="any" selected >Any</option>
	             <option value="5000000">50 Lakh</option>
	             <option value="9000000">90 Lakh</option>
	             <option value="10000000">1 Crore</option>
	             <option value="20000000">2 Crore</option>
	             <option value="50000000">5 Crore</option> 
            </select>
            <div class="input-group-append"> 
              <span class="input-group-text">in</span>
            </div>
			     <select class="form-control form-control-lg col-7 searchByCity" style="width: 90px">
	             <?php foreach($cities as $city) : ?>
                 <option value="<?= $city['id'];?>"><?= $city['city_name'];?></option>
               <?php endforeach ?> 
            </select> 

		</div>
		<br>
		<div class="input-group">
          <input type="text" class="form-control form-control-lg searchArea" placeholder="All areas in <?php echo currentLocation()['city'];?>">
		</div>
    <div class="input-group" id="searchResult">
          
    </div>  	
    </center>
     
         
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      
      <!------------START IF-------------> 
      <?php if(is_array($featured)) : ?>
          <h1 class="display-4" style="font-size: 2.5rem">Featured New Properties</h1>
              <hr>
              <div class="row">  
                 <!------------START FOREACH-------------> 
                <?php foreach($featured as $fp) : ?>
                
                <div class="col-md-4">
                  <div class="card mb-4 shadow-sm">
                    
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                         <!------------START FOREACH-------------> 
                        <?php 
                        if(is_array($fp['images'])){
                        foreach($fp['images'] as $key => $img) : ?>
                        <?php $active = ($key == 1) ? "active": "" ;?> 
                        <div class="carousel-item <?= $active;?>"> 
                            
                            <?php if(isImageExists($img['image_name'],'propertyThumbnails') == true){ ?>  

                               <img src="<?= publicFolder().'/property-images/thumbnails/'.$img['image_name'];?>" class="d-block w-100 imgp" alt="...">

                            <?php }else{ ?>  

                               <img src="<?= publicFolder().'/images/empty-image-3.png';?>" class="d-block w-100 imgp" alt="..."> 

                            <?php } ?>

                        </div>
                        <?php endforeach ?>
                        <?php }else{ ?>
                         <div class="carousel-item active"> 
                            <img src="<?= publicFolder().'/images/empty-image-3.png';?>" class="d-block w-100 imgp" style="width:80%" alt="...">
                        </div>
                        <?php } ?>  
                         <!------------END FOREACH-------------> 
                      </div>
                    </div>

                    <div class="card-body"> 
                                    <!------------START IF-------------> 
                                  <?php if($fp['listing_type'] == "sell") : ?>
                                  <a href="<?= base_url().'/property-detail/'.$fp['id'];?>" class="stretched-link text-dark text-decoration-none">
                                    <h5><?= number_to_currency($fp['total_price'], 'INR');?> INR</h5>
                                  </a>
                                  <?php endif ?>
                                   <!------------END IF-------------> 
                                    <!------------START IF-------------> 
                                   <?php if($fp['listing_type'] == "rent") : ?>
                                  <a href="<?= base_url().'/property-detail/'.$fp['id'];?>" class="stretched-link text-dark text-decoration-none">
                                    <h5><?= number_to_currency($fp['rent_per_mon'], 'INR');?> per month</h5>
                                  </a> 
                                  <?php endif ?> 
                                   <!------------END IF-------------> 
                      <p class="card-text"><b><?= ucfirst($fp['title']);?></b></p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                                   <!------------START IF-------------> 
                                  <?php if($fp['listing_type'] == "sell") : ?>
                                  <button type="button" class="btn btn-sm btn-outline-success">Available for <?= ucfirst($fp['listing_type']);?></button>
                                  <?php endif ?>
                                   <!------------END IF-------------> 
                                   <?php if($fp['listing_type'] == "rent") : ?>
                                  <button type="button" class="btn btn-sm btn-warning">Available for <?= ucfirst($fp['listing_type']);?></button>
                                  <?php endif ?> 
                                    <!------------END IF-------------> 
                        </div>
                        <small class="text-muted">Posted : <?= date('D, d M Y', strtotime($fp['created_at']));?></small>
                      </div>
                    </div> 

                  </div>
                </div>
              <?php endforeach ?>
               <!------------END FOREACH-------------> 
              </div>
      <?php endif ?>    
       <!------------END IF-------------> 
        
        <h1 class="display-4" style="font-size: 2.5rem">Browse By Property Type</h1> 

    </div>
  </div></main>

<div class="container">
<footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <img class="mb-2" src="<?= publicFolder();?>/images/propertyraja.png" alt="" width="150">
         <small class="d-block mb-3 text-muted">
            &copy; 2017-2020 | Developed by Algobasket
         </small> 
         <img class="mb-2" src="<?= publicFolder();?>/images/app.png" alt="" width="200">
      </div>
      <div class="col-6 col-md">
        <h5>Quick links</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Mobile Apps</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/browse?q=residential+property">Residential Property</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/browse?q=commercial+property">Commercial Property</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/browse?q=new+projects">New Projects</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/browse?q=price+trends">Price Trends</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/find-agent">Find Agent</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>COMPANY</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="<?= base_url();?>/about">About Us</a></li> 
          <li><a class="text-muted" href="<?= base_url();?>/contact">Contact Us</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/careers">Careers with Us</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/terms-and-conditions">Terms & Conditions</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/testimonials">Testimonials</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/policy">Privacy Policy</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/report">Report a problem</a></li>
          <li><a class="text-muted" href="<?= base_url();?>/safety">Safety Guide</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Our Partners</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">EasyBHK.com</a></li>
          <li><a class="text-muted" href="#">MagicBricks.com</a></li>
          <li><a class="text-muted" href="#">99Acres.com</a></li>
          <li><a class="text-muted" href="#">Makaan.com</a></li>
        </ul>
      </div>
    </div>
</footer>
</div>



 
<?= $this->endSection() ?>