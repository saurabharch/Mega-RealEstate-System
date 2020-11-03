<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

 <?= $this->include('common/header') ?>

<main role="main">

  <div class="album py-5 bg-light">
    <div class="container bd-callout bd-callout-danger" >
        <div class="row">
            <h5 class="custom-select-lg mb-4" style="font-size: 21px">&nbsp;&nbsp;&nbsp;&nbsp;Search By</h5>
            <div class="btn-group">
            <select class="custom-select mb-3 listing_type searchDrop" style="width:120px;margin-left:15px">
              <option selected="true" disabled="disabled">Buy</option> 
              <option value="sell" <?php echo (getGet('listing_type') == "sell") ? "selected" : "";?>>Buy</option>  
              <option value="rent" <?php echo (getGet('listing_type') == "rent") ? "selected" : "";?>>Rent</option> 
            </select>
            <div class="input-group-append">
            <select class="custom-select mb-4 property_type searchDrop" style="width:120px">
               <option value="any" selected>Any</option>
                <?php foreach($property_type as $pt) : ?>
                 <option value="<?= $pt['id'];?>"><?= ucfirst($pt['type_name']);?></option>
               <?php endforeach ?> 
            </select>
            </div>
            <div class="input-group-append">
            <select class="custom-select mb-4 total_price searchDrop" style="width:120px">
               <option value="any" selected >Any Price</option>
               <option value="5000000">50 Lakh</option>
               <option value="9000000">90 Lakh</option>
               <option value="10000000">1 Crore</option>
               <option value="20000000">2 Crore</option>
               <option value="50000000">5 Crore</option> 
            </select>
            <select class="custom-select mb-4 rental_price searchDrop" style="width:120px;display: none">
               <option value="any" selected >Any Price</option>
               <option value="0-5000">0-5k INR</option>
               <option value="5000-10000">5k-1k INR</option>
               <option value="10000-20000">1k-20k INR</option>
               <option value="20000-40000">20k-40k INR</option>
               <option value="40000-80000">40k-80k INR</option> 
               <option value="80000-100000">80k-100k INR</option> 
               <option value="100000-200000">100k-200k INR</option> 
               <option value="200000-500000">200k-500k INR</option>  
            </select>
            </div>
            <div class="input-group-append">
            <select class="custom-select mb-4 facing searchDrop" style="width:120px">
              <option selected="true" disabled="disabled">Facing</option>
              <option value="east">East</option>
              <option value="west">West</option>
              <option value="north">North</option>
              <option value="south">South</option>
            </select>
            </div>
            <div class="input-group-append">
            <select class="custom-select mb-4 bhktype searchDrop" style="width:120px">
              <option value="studio">Studio</option>
              <option value="1bhk">1 BHK</option>
              <option value="2bhk">2 BHK</option>
              <option value="3bhk">3 BHK</option>
              <option value="4bhk">4 BHK</option>
              <option value="5bhk">5 BHK</option>
              <option value="5+bhk">5+ BHK</option> 
            </select> 
             </div>
             <div class="input-group-append">
            <select class="custom-select mb-4 availability searchDrop" style="width:120px">
              <option selected="true" disabled="disabled" value="any">Availability</option>
              <option value="ready_to_occupy">Ready to Occupy</option>  
              <option value="under_construction">Under Construction</option>
            </select>
           </div>
        </div>
        </div>
        <div class="row">
          
            <div class="custom-control custom-radio custom-control-inline">
              <h4 style="font-size: 21px">&nbsp;&nbsp;&nbsp;&nbsp;Posted By</h4>
            </div>
             <div class="form-check form-check-inline">
              <input class="form-check-input searchDrop" type="checkbox" id="houseOwner" value="customer" >
              <label class="form-check-label" for="houseOwner">House Owner</label> 
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input searchDrop" type="checkbox" id="realEstateDeveloper" value="developer" >
                <label class="form-check-label" for="realEstateDeveloper">Realestate Developer</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input searchDrop" type="checkbox" id="agent" value="agent" >
                <label class="form-check-label" for="agent">Agent</label> 
              </div>
        </div>
    </div><br>
    
    <div class="container">
         <?php 
           if($listing_type && $city)   
            {
               echo '<h3>'.ucfirst(cityFromCityId($city)['city_name']).' Real Estate & <span id="pt_b">Homes</span> For <span id="lt_b">'.ucfirst($listing_type).'</span></h3>'; 
            }
         ?>  
         
    </div>
    <div class="container ajaxSearchResult">
       <?php 
           echo '<h5>'.(is_array($result) ? count($result) : '0').' results</h5> 
                  <hr>
                  <div class="row">'; 
                    if(is_array($result))
                    {
                        foreach($result as $row)
                        {
                             echo '<div class="card mb-3" style="width:100%;">
                                        <div class="row no-gutters">
                                          <div class="col-md-4">';
                                            if(is_array($row['images'])){
                                            foreach($row['images'] as $key => $image)
                                            {   
                                                if($key == 0)
                                                { 
                                                    if(isImageExists($image['image_name'],'propertyThumbnails') == true) 
                                                    {
                                                        echo '<img src="'.publicFolder().'/property-images/thumbnails/'.$image['image_name'].'" class="card-img" width="150">';     
                                                    }else{
                                                       echo '<img src="'.publicFolder().'/images/empty-image-3.png" class="card-img" width="150">';
                                                    }
                                                    
                                                }
                                            }
                                             echo '<label class="badge badge-dark" style="position: absolute;margin: 5px -70px;">'.count($row['images']).' Photo</label>';  echo '<label class="badge badge-dark" style="position: absolute;margin: 5px -70px;">'.count($row['images']).' Photo</label>'; 
                                          }else{
                                            echo '<img src="'.publicFolder().'/images/empty-image-3.png" class="card-img" width="150">';
                                          }
                                          
                                    echo '</div>
                                          <div class="col-md-8">
                                            <div class="card-body">
                                              <h3 class="card-title">
                                                  <span>'.($row['total_price'] ? number_to_currency($row['total_price'], 'INR').' INR' : number_to_currency($row['rent_per_mon'], 'INR').' per month').'</span>    
                                                   <img src="'.publicFolder().'/images/star-empty.png" width="25" class="float-right favourite" data-star="0"/>
                                              </h3>
                                              <p class="card-text">'.$row['title'].'</p>
                                              <p class="card-text">'.word_limiter($row['description'],25).'..</p>
                                              <p class="card-text"> 
                                                 <h6>New construction <span class="badge badge-success">New</span> | '.($row['builtup_area'] ? $row['builtup_area'].' sft' : "" ).' | '.$row['bhk_type'].' | '.ucfirst($row['facing']).' | '.humanize($row['status_type']).'</h6>
                                                <a href="'.base_url().'/property-detail/'.$row['id'].'" class="btn btn-primary btn-sm float-right">Interested</a>
                                              </p>
                                               <p class="card-text">
                                                <small>Posted By : '.$row['firstname'].' '.$row['lastname'].' ('.$row['role'].')  | Posted At : '.date('D, d M Y', strtotime($row['created_at'])).' | <a href="'.base_url().'/property-detail/'.$row['id'].'" target="__self" class="text-success">Full Detail</a>
                                                </small>
                                              </p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>';
                                      
                        }
                    }  
                  
                  
        echo '</div>';
       ?>
    </div>
  </div>

</main> 



<?= $this->include('common/footer') ?> 



<?= $this->endSection() ?>