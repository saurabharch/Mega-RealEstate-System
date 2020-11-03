<?= $this->extend('common/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('common/header') ?>
<script type="text/javascript">
  function uploadProfilePic()
  {
    var uploadFile = $('#myfile').val();
    if(uploadFile == null || uploadFile == "")
    {
      alert("Upload Your Profile Image"); 
    }else{
      var x = uploadFile.split('.');
      var ext = '<?= allowedImageExt();?>'; 
      if(ext.includes(x[1]))
      {
            const fi = document.getElementById('myfile'); 
        // Check if any file is selected. 
        if (fi.files.length > 0) { 
            for (const i = 0; i <= fi.files.length - 1; i++) { 
  
                const fsize = fi.files.item(i).size; 
                const file = Math.round((fsize / 1024)); 
                // The size of the file.
                $('#profileUploadStatus').html(""); 
                if (file >= 4096) { 
                    $('#profileUploadStatus').html("<p class='text-danger'>File too Big, please select a file less than 4MB</p>"); 
                } else if (file < 1024) { 
                    $('#profileUploadStatus').html("<p class='text-danger'>File too small, please select a file greater than 1MB</p>"); 
                } else { 
                    $('#uploadProfilePic').click();
                } 
            } 
        } 
      }else{
        $('#profileUploadStatus').html("<p class='text-danger'>Invalid Image extension | Valid ext - JPG,PNG & WEBP!</p>"); 
      }  
    }  
  }
</script>
<main role="main"> 
  <div class="album py-5 bg-light">
    <div class="container">
       <h3 class="display-4">Profile Summary <a href="<?= base_url();?>/add-property" class="btn btn-outline-danger float-right"> + Add Property</a></h3>
       <hr>
       <div class="row"> 
         <div class="col-md-8 order-md-1">
               <div class="row">
                 <div class="col-md-3">
                  <?php if($profile['profile_pic']){ ?>
                    <img src="<?= publicFolder();?>/user-images/thumbnails/<?= $profile['profile_pic'];?>" class="img-circled" width="150">
                  <?php }else{ ?>
                    <img src="<?= publicFolder();?>/images/agent-c.png" class="img-circled" width="150"/>    
                  <?php } ?>
                 </div> 
                   <div class="col-md-6" style="margin-top: 30px;">
                        <?= form_open('profile','accept-charset="utf-8" enctype="multipart/form-data"') ?>
                      <form id="file-form" action="fileUpload.php" method="post" enctype="multipart/form-data">
                      <div class="input-group mb-3">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="myfile" name="images[]" multiple />  
                            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"><i class="fas fa-search"></i> Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text bg-danger text-white" onclick="uploadProfilePic()"> 
                              <i class="fas fa-cloud-upload-alt"></i> 
                               &nbsp;Upload 
                            </span>
                            <input type="submit" name="uploadProfilePic" id="uploadProfilePic" style="display: none;" />
                          </div>
                      </div>
                      <small>Allowed size 1MB-4MB | Extensions - jpg,png & webp</small>
                      <span id="profileUploadStatus"></span>
                      <?= form_close();?>
                   </div>  
             </div> 
             <hr>
             <?= \Config\Services::session()->getFlashdata('alert');?>
             <?= form_open('profile') ?>
             <?php //foreach ($profile as $info){} ?>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" class="form-control" id="firstName" name="firstname" placeholder="First Name" value="<?= $profile['firstname'] ? $profile['firstname'] : "" ;?>" required=""> 
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Last name</label>
                  <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Last Name" value="<?= $profile['lastname'] ? $profile['lastname'] : "" ;?>" required="">
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="username">Display Name</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name" value="<?= $profile['display_name'] ? $profile['display_name'] : "" ;?>" required="">
                  <div class="invalid-feedback" style="width: 100%;">
                    Your username is required.
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="username">Username <span class="text-muted">(Optional)</span> <span id="isUsernameAvailable"></span></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><?= base_url();?>/@</span>
                  </div>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $profile['username'] ? $profile['username'] : "" ;?>" >
                  <div class="input-group-append">
                    <a href="javascript:void(0)" class="input-group-text" type="button" id="checkUsernameAvailability">Check Availability</a>
                  </div>
                  <div class="invalid-feedback" style="width: 100%;">
                    Your username is required.
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="username">Mobile</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" value="<?= $profile['mobile'] ? $profile['mobile'] : "" ;?>" required="">
                  <div class="invalid-feedback" style="width: 100%;">
                    Your username is required.
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $profile['email'] ? $profile['email'] : "" ;?>" placeholder="you@example.com">
                <div class="invalid-feedback">
                  Please enter a valid email address for shipping updates.
                </div>
              </div>
              <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address1" value="<?= $profile['address1'] ? $profile['address1'] : "" ;?>" placeholder="1234 Main St" required="">
                <div class="invalid-feedback">
                  Please enter your shipping address.
                </div>
              </div>
              <div class="mb-3">
                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" name="address2" value="<?= $profile['address2'] ? $profile['address2'] : "" ;?>" id="address2" placeholder="Apartment or suite">
              </div>
              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="country">Country</label>
                  <select class="custom-select d-block w-100" name="country" id="country" required="">
                      <option value="">Choose...</option>
                    <?php foreach($countries as $c) : ?>
                      <option value="<?= $c['id'];?>" <?= ($c['id']==$profile['country']) ? "selected" : "" ;?> ><?= $c['country_name'];?></option>
                    <?php endforeach ?>  
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid country.
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="state">State</label>
                  <select class="custom-select d-block w-100" name="state" id="state" required="">
                    <option value="">Choose...</option>
                    <?php foreach($states as $s) : ?>
                      <option value="<?= $s['id'];?>" <?= ($s['id']==$profile['state']) ? "selected" : "" ;?>><?= $s['state_name'];?></option>
                    <?php endforeach ?> 
                  </select>
                  <div class="invalid-feedback"> 
                    Country name required.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="zip">City</label>
                  <select class="custom-select d-block w-100" name="city" id="city" required="">
                    <option value="">Choose...</option>
                    <?php foreach($cities as $cy) : ?>
                      <option value="<?= $cy['id'];?>" <?= ($cy['id']==$profile['city']) ? "selected" : "" ;?>><?= $cy['city_name'];?></option>
                    <?php endforeach ?> 
                  </select>
                  <div class="invalid-feedback">
                    Country name required.
                  </div>
                </div>
              </div>
              <hr class="mb-4">
              <h4 class="mb-3">My Activity</h4>
              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="credit" name="myActivity" type="radio" class="custom-control-input" <?= ($profile['activity']=="buy_rent") ? "checked" : "";?> required value="buy_rent" />
                  <label class="custom-control-label" for="credit">Searching for Home</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="debit" name="myActivity" type="radio" class="custom-control-input" <?= ($profile['activity']=="sell") ? "checked" : "";?> required value="sell">
                  <label class="custom-control-label" for="debit">Selling Property</label>
                </div>
              </div>
              <hr class="mb-4">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="update_profile" value="Update Profile"/> 
              <?= form_close();?> 
      </div>
      
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