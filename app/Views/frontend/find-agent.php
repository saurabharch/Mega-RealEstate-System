
<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

<?= $this->include('common/header') ?> 

<main role="main">
    <div class="container">
        <?php if(isset($_GET['location']) || isset($_GET['name']) || isset($_GET['service'])){ ?>
         
           <?php if(isset($_GET['location']) && $_GET['location'] != NULL){ ?>  
             <h4 class="display-4" style="margin-top: 100px">Real Estate Agents in <?= ucfirst($_GET['location']);?></h4>
           <?php }else{ ?>  
             <h4 class="display-4" style="margin-top: 100px">Find Your Agent : <?= ucfirst($_GET['name']);?></h4>
           <?php } ?>  
          <hr>
        <?= form_open('/find-agent/','id="agentSForm" method="GET"');?>  
        <table class="table table-borderless" style="background-color: lavenderblush;">
          <tr>
            <td style="padding: 10px">
               <b style="font-size: 13px">LOCATION</b>

               <?php $location = isset($_GET['location']) ? $_GET['location'] : "";?> 

               <input type="text" name="location" id="agentLocation" class="form-control" placeholder="Neighborhood/City/Zip" value="<?= $location;?>"/>
            </td>
            <td style="padding: 10px">
              <b style="font-size: 13px">NAME</b> 

              <?php $name = isset($_GET['name']) ? $_GET['name'] : "";?> 

              <input type="text" name="name" id="agentName" class="form-control" placeholder="Agent Name" value="<?= $name;?>" />
            </td>
            <td style="padding: 10px">
              <b style="font-size: 13px">SERVICE NEEDED</b> 

              <?php $service = isset($_GET['service']) ? $_GET['service'] : "";?> 

              <select class="form-control hide" name="service" id="agentService">   
                <option value="buy" <?= ($service == 'buy') ? "selected" : "";?>>Buying a home</option> 
                <option value="sell" <?= ($service == 'sell') ? "selected" : "";?>>Selling a home</option> 
                <option value="buy_sell" <?= ($service == 'buy_sell') ? "selected" : "";?>>Buying or Selling</option>
              </select>
            </td>
          </tr>
        </table>
        <?= form_close();?>
          <div class="container">
            <center><i style="font-size: 13px;">SORT BY: MOST ACTIVE</i></center>
          </div>
        <hr>
           <?php if(is_array($sAgents) && count($sAgents) > 0){ ?> 
                <?php foreach($sAgents as $agent){ ?> 
                     <div class="row mb-3" onclick="window.location.href='<?= base_url();?>/public-profile/<?= $agent['username'];?>'"> 
                        <div class="col-md-4">
                               <div class="media">
                                  <img src="<?= publicFolder();?>/user-images/thumbnails/<?= $agent['profile_pic'];?>" class="align-self-center mr-3 rounded-circle" style="width: 120px">
                                  <div class="media-body"> 
                                    <h5 class="mt-0">
                                      <?php 
                                        if($agent['firstname']){
                                          echo $agent['firstname'] .' '. $agent['lastname'];
                                        }elseif($agent['display_name']){
                                           echo $agent['display_name'];
                                        }elseif($agent['username']){
                                           echo $agent['username'];  
                                        }
                                        ?>            
                                    </h5>
                                    <span><?= $agent['mobile'];?></span><br>
                                    <span> 
                                          <?php getUserRatings('seller',$agent['user_id'],$status = 1);?>                         
                                          (<?= getUserRatingsNumber('seller',$agent['user_id'],$status = 1);?>)                         
                                    </span> 
                                    <p class="mb-0"><?= $agent['reviewsCount'];?> reviews</p>
                                  </div> 
                                </div>    
                        </div>
                        <div class="col-md-4">
                              <div class="media">
                                  <div class="media-body">
                                    <h6 class="mt-0"><?= $agent['reviewsCount'];?> Reviews</h6>
                                    <h6 class="mt-0"><?= $agent['salesCount'];?> Recent Sales</h6>
                                    <h6 class="mt-0"><?= $agent['listingsCount'];?> Listings</h6>
                                  </div>
                                </div>  
                        </div>
                        <div class="col-md-4">
                              <div class="media">
                                  <div class="media-body text-center">
                                    <h6 class="mt-0">CLIENT REVIEW</h6>
                                    <p>
                                      <?php 
                                      if(is_array($agent['currentReview']))
                                      {
                                        foreach($agent['currentReview'] as $rw)
                                        { 
                                          echo '<i>"'.word_limiter($rw['comment'],20).'"</i>';
                                        }   
                                      }else{
                                        echo "No Review Yet";
                                      } ?>
                                    </p>
                                  </div>
                                </div>  
                        </div>
                      </div>
                <?php } ?>
           <?php }else{ ?>
             <center><i style="font-size: 13px;">No Agent Found</i></center>
           <?php } ?>
           
       


        <?php }else{ ?>
         
        <h4 class="display-4" style="margin-top: 100px">Find Your Agent Today!</h4> 
        <hr>
        <?= form_open('/find-agent/','id="agentSForm" method="GET"');?>  
        <table class="table table-borderless " style="background-color: lavenderblush;">
          <tr>
            <td style="padding: 10px">
               <b style="font-size: 13px">LOCATION</b>

               <?php $location = isset($_GET['location']) ? $_GET['location'] : currentLocation()['city'];?> 

               <input type="text" name="location" id="agentLocation" class="form-control" placeholder="Neighborhood/City/Zip" value="<?= $location;?>" />
            </td>
            <td style="padding: 10px">
              <b style="font-size: 13px">NAME</b> 

              <?php $name = isset($_GET['name']) ? $_GET['name'] : "";?> 

              <input type="text" name="name" id="agentName" class="form-control" placeholder="Agent Name" value="<?= $name;?>" />
            </td>
            <td style="padding: 10px">
              <b style="font-size: 13px">SERVICE NEEDED</b> 

              <?php $service = isset($_GET['service']) ? $_GET['service'] : "";?> 

              <select class="form-control" name="service" id="agentService"> 
                <option value="buy" <?= ($service == 'buy') ? "selected" : "";?>>Buying a home</option> 
                <option value="sell" <?= ($service == 'sell') ? "selected" : "";?>>Selling a home</option> 
                <option value="buy_sell" <?= ($service == 'buy_sell') ? "selected" : "";?>>Buying or Selling</option>
              </select>
            </td>
          </tr>
          <tr><td colspan="2"><small>To get started, enter your location or search for a specific agent by name.</small></td></tr>
        </table>
        <?= form_close();?>

        <div class="container">
          
          <b style="font-size: 18px">
           Location Auto Detected - <img src="<?= publicFolder();?>/images/location5.png" width="25"  /> 
          <?php echo currentLocation()['city'];?>,<?php echo currentLocation()['state'];?>,<?php echo currentLocation()['country'];?> 
          </b>
          <span style="float: right"><i style="font-size: 13px;">SORT BY: MOST ACTIVE</i></span>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12"> 
            <center><img src="<?= publicFolder();?>/images/realestatess.png" class=""/></center>
          </div> 
        </div>

        <!--  <p class="font-weight-light" style="font-size: 20px;">
          Loading Agents ..
          <span class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading ...</span>
          </span>
        </p> -->
        <hr>
        <p class="font-weight-light">Whether you are looking to rent, buy or sell your home, PropertyRaja directory of local real estate agents and brokers connects you with professionals who can help meet your needs. Because the real estate market is unique, it's important to choose a real estate agent or broker with local expertise to guide you through the process of renting, buying or selling your next home. Our directory helps you find real estate professionals who specialize in buying, selling, foreclosures, or relocation - among many other options. Alternatively, you could work with a local agent or real estate broker who provides an entire suite of buying and selling services.
        No matter what type of real estate needs you have, finding the local real estate professional you want to work with is the first step. The real estate directory lets you view and compare real estate agents, read reviews, see an agent's current listings and past sales, and contact agents directly from their profile pages on our system. PropertyRaja is the leading real estate and rental marketplace dedicated to empowering consumers with data, inspiration and knowledge around the place they call home, and connecting them with the best local professionals who can help.</p>

        <?php } ?>  
        
        
        
   </div>
</main>

<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>