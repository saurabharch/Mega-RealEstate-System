<?= $this->extend('backend/common/layout') ?> 
<?= $this->section('content') ?>   
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

<div class="container-fluid">
<br>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url();?>/backend/dashboard/index">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>">Agent</a></li>  
      <li class="breadcrumb-item"><a href="<?= base_url();?>">Edit</a></li>   
    </ol> 
    </nav>
    <br>  

    
    <div class="row">
    <?= $this->include('backend/common/sidebar');?> 
    <div class="col-md-9">
       
       <?php if($section =="profile"){ ?>
        <?php //print_r($profile);?> 
        <h3 class="display-4" style="margin-left:100px">Customer Profile</h3>
        <div class="container-fluid emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4"> 
                        
                          <?php if($profile['profile_pic']){ ?>
                            <img src="<?= publicFolder();?>/user-images/thumbnails/<?= $profile['profile_pic'];?>" class="shadow-lg mx-auto d-block rounded" width="80%"/>
                          <?php }else{ ?>
                            <img src="<?= publicFolder();?>/images/customer-2.png" class="shadow-lg mx-auto d-block rounded" width="50%"/> 
                          <?php } ?>
                      
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5 class="display-4">
                                        <?php 
                                        if($profile['firstname'] && $profile['lastname'])
                                         {
                                           echo ucfirst($profile['firstname']) .' '.ucfirst($profile['lastname']); 
                                         }elseif($profile['display_name']){
                                           echo ucfirst($profile['display_name']);
                                         }else{
                                           echo 'No Name'; 
                                         }
                                         ?>
                                    </h5>
                                    <h6>
                                        PropertyRaja Customer
                                    </h6>
                                    <h6>
                                        Activity - <?= strtoupper((str_replace('_', ' / ', $profile['activity'])));?>
                                    </h6>
                                    <h6>
                                        Verified Email - <?= ($profile['is_email_verified'] ==1) ? "Yes" : "No";?>
                                     </h6>
                                     <h6>
                                        Verified Account - <?= ($profile['is_verified'] ==1) ? "Yes" : "No";?> 
                                     </h6>
                                     <h6>
                                        Role - <?= ucfirst($profile['role']);?>
                                    </h6>
                                    <h6>
                                        Acccount Status - <label class="<?= $profile['status_badge'];?>"><?= ucfirst($profile['status_name']);?></label>
                                    </h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Properties Info</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Interested</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Favourites</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= base_url();?>/backend/user/customers/edit/<?= $profile['user_id'];?>" class="profile-edit-btn" name="btnAddMore">Edit Profile</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
            

                            <p>WEBSITE</p> 
                            <?php if($profile['website']){ ?>
                                <a href="<?= $profile['website'];?>" target="__self">
                                   <?= $profile['website'];?>
                                </a>
                            <?php }else{ ?>
                               No Website
                            <?php } ?>
                              
                              <br/>
          
                            <p>SOCIAL MEDIA</p>                           
                            <a href="<?= $profile['facebook'];?>" target="__self">Facebook</a><br/>
                            <a href="<?= $profile['linkedin'];?>" target="__self">LinkedIn</a><br/>
                            <a href="<?= $profile['twitter'];?>" target="__self">Twitter</a><br/>                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>UserID</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $profile['username'];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Real Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                  <?= $profile['firstname'] ? ucfirst($profile['firstname']).' '.ucfirst($profile['lastname']) : 'No Name';?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $profile['email'];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $profile['mobile'];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>English Level</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $profile['english_level'];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Specialities</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $profile['specialities'];?></p>  
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Property Sold</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= @$total_sold;?></p>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-12"> 
                                                <label>Your Bio</label><br/>
                                                <p><small><?= $profile['description'];?></small></p>
                                            </div>
                                        </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div> 

       <?php }elseif($section =="edit"){ ?>
         
        <div class="container">  
                <h3 class="display-4">Edit Customer</h3>
                <div class="row">
                 <div class="col-md-3">

                  <?php if($profile['profile_pic']){ ?>
                    <img src="<?= publicFolder();?>/user-images/thumbnails/<?= $profile['profile_pic'];?>" class="shadow-lg bg-white" width="200">
                  <?php }else{ ?>
                    <img src="<?= publicFolder();?>/images/agent-c.png" class="shadow-lg" width="200"/>    
                  <?php } ?>
                 </div> 
                
                   <div class="col-md-6" style="margin-top: 30px;">
                        <?= form_open('backend/user/staff/edit/'.segment(5),'accept-charset="utf-8" enctype="multipart/form-data"') ?>
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
                   </div>  </div>  
             <hr>
             <?= \Config\Services::session()->getFlashdata('alert');?>
             <?= form_open('backend/user/staff/edit/'.segment(5)) ?>
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

              <h4 class="mb-3">Skills & Experience</h4>

              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="english_level">English Level</label>
                  <input type="text" class="form-control" id="english_level" name="english_level" value="<?= $profile['english_level'] ? $profile['english_level'] : "" ;?>" placeholder="">
                  <div class="invalid-feedback">
                    Please select your English level.
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                   <label for="facebook">Experience</label>
                  <input type="text" class="form-control" id="experience" name="experience" value="<?= $profile['experience'] ? $profile['experience'] : "" ;?>" placeholder="Years of experience">
                  <div class="invalid-feedback">
                    Please enter your years of experience.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="specialities">Specialities</label>
                 <input type="text" class="form-control" id="specialities" name="specialities" value="<?= $profile['specialities'] ? $profile['specialities'] : "" ;?>" placeholder="Your specialities">
                  <div class="invalid-feedback">
                    Please enter your specialities.
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

              <h4 class="mb-3">Account Status</h4>

              <div class="d-block"> 
                   <select class="custom-select d-block w-100 <?= statusLabel($profile['status'])[0]['status_bg_color'];?>" name="status" id="status">
                    <?php foreach(statusList() as $s) : ?>
                      <option value="<?= $s['id'];?>" class="<?= $s['status_badge'];?>" <?= ($s['id']==$profile['status']) ? "selected" : "" ;?>>
                        <?= $s['status_name'];?>
                      </option> 
                    <?php endforeach ?> 
                  </select>
              </div>

             <hr class="mb-4">

              <h4 class="mb-3">Social Media</h4>

              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="twitter">Twitter</label>
                  <input type="text" class="form-control" id="twitter" name="twitter" value="<?= $profile['twitter'] ? $profile['twitter'] : "" ;?>" placeholder="eg- @username">
                  <div class="invalid-feedback">
                    Please select your Twitter @username.
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                   <label for="facebook">Facebook</label>
                  <input type="text" class="form-control" id="facebook" name="facebook" value="<?= $profile['facebook'] ? $profile['facebook'] : "" ;?>" placeholder="eg- facebook.com/username">
                  <div class="invalid-feedback">
                    Please select your Facebook username.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="linkedin">Linkedin</label>
                 <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?= $profile['linkedin'] ? $profile['linkedin'] : "" ;?>" placeholder="eg- linkedin.com/username">
                  <div class="invalid-feedback">
                    Please select your Linkedin profile link.
                  </div>
                </div>
              </div>
               <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="instagram">Instagram</label>
                  <input type="text" class="form-control" id="instagram" name="instagram" value="<?= $profile['instagram'] ? $profile['instagram'] : "" ;?>" placeholder="eg- instagram.com/username">
                  <div class="invalid-feedback">
                    Please select your Instagram profile link.
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                   <label for="blog">Blog</label>
                  <input type="text" class="form-control" id="blog" name="blog" value="<?= $profile['blog'] ? $profile['blog'] : "" ;?>" placeholder="eg- blogger.com/username">
                  <div class="invalid-feedback">
                    Please select your blog link.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="website">Website</label>
                 <input type="text" class="form-control" id="website" name="website" value="<?= $profile['website'] ? $profile['website'] : "" ;?>" placeholder="Website link">
                  <div class="invalid-feedback">
                    Please select your Website link.
                  </div>
                </div>
              </div>

              <hr class="mb-4">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="update_profile" value="Update Profile"/> 
            <?= form_close();?> 
         </div>

       <?php }elseif($section =="add"){ ?> 
         
         <div class="container">  
                <h3 class="display-4">Add Staff</h3>
             <hr>
             <?= \Config\Services::session()->getFlashdata('alert');?>
             <?= form_open('backend/user/staff/add') ?>  
        
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" class="form-control" id="firstName" name="firstname" placeholder="First Name"  required=""> 
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Last name</label>
                  <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Last Name" required="">
                  <div class="invalid-feedback">
                    Valid last name is required.
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="username">Display Name</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name" required="">
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
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" >
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
                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required="">
                  <div class="invalid-feedback" style="width: 100%;">
                    Your username is required.
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                <div class="invalid-feedback">
                  Please enter a valid email address for shipping updates.
                </div>
              </div>

              <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address1" placeholder="1234 Main St" required="">
                <div class="invalid-feedback">
                  Please enter your shipping address.
                </div>
              </div>

              <div class="mb-3">
                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" name="address2" id="address2" placeholder="Apartment or suite">
              </div>

              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="country">Country</label>
                  <select class="custom-select d-block w-100" name="country" id="country" required="">
                      <option value="">Choose...</option>
                    <?php foreach($countries as $c) : ?>
                      <option value="<?= $c['id'];?>" ><?= $c['country_name'];?></option>
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
                      <option value="<?= $s['id'];?>"><?= $s['state_name'];?></option>
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
                      <option value="<?= $cy['id'];?>"><?= $cy['city_name'];?></option>
                    <?php endforeach ?> 
                  </select>
                  <div class="invalid-feedback">
                    Country name required.
                  </div>
                </div>
              </div>
             
              <hr class="mb-4">

              <h4 class="mb-3">Skills & Experience</h4>

              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="english_level">English Level</label>
                  <input type="text" class="form-control" id="english_level" name="english_level" placeholder="">
                  <div class="invalid-feedback">
                    Please select your English level.
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                   <label for="facebook">Experience</label>
                  <input type="text" class="form-control" id="experience" name="experience" placeholder="Years of experience">
                  <div class="invalid-feedback">
                    Please enter your years of experience.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="specialities">Specialities</label>
                 <input type="text" class="form-control" id="specialities" name="specialities" placeholder="Your specialities">
                  <div class="invalid-feedback">
                    Please enter your specialities.
                  </div>
                </div>
              </div> 

             
              <hr class="mb-4">

              <h4 class="mb-3">My Activity</h4>

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="credit" name="myActivity" type="radio" class="custom-control-input" required value="buy_rent" />
                  <label class="custom-control-label" for="credit">Searching for Home</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="debit" name="myActivity" type="radio" class="custom-control-input" required value="sell">
                  <label class="custom-control-label" for="debit">Selling Property</label>
                </div>
              </div>

               <hr class="mb-4">

              <h4 class="mb-3">Account Status</h4>

              <div class="d-block"> 
                   <select class="custom-select d-block w-100" name="status" id="status">
                    <?php foreach(statusList() as $s) : ?>
                      <option value="<?= $s['id'];?>" class="<?= $s['status_badge'];?>">
                        <?= $s['status_name'];?>
                      </option> 
                    <?php endforeach ?> 
                  </select>
              </div>

             <hr class="mb-4">

              <h4 class="mb-3">Social Media</h4>

              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="twitter">Twitter</label>
                  <input type="text" class="form-control" id="twitter" name="twitter" placeholder="eg- @username">
                  <div class="invalid-feedback">
                    Please select your Twitter @username.
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                   <label for="facebook">Facebook</label>
                  <input type="text" class="form-control" id="facebook" name="facebook" placeholder="eg- facebook.com/username">
                  <div class="invalid-feedback">
                    Please select your Facebook username.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="linkedin">Linkedin</label>
                 <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="eg- linkedin.com/username">
                  <div class="invalid-feedback">
                    Please select your Linkedin profile link.
                  </div>
                </div>
              </div>
               <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="instagram">Instagram</label>
                  <input type="text" class="form-control" id="instagram" name="instagram" placeholder="eg- instagram.com/username">
                  <div class="invalid-feedback">
                    Please select your Instagram profile link.
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                   <label for="blog">Blog</label>
                  <input type="text" class="form-control" id="blog" name="blog" placeholder="eg- blogger.com/username">
                  <div class="invalid-feedback">
                    Please select your blog link.
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="website">Website</label>
                 <input type="text" class="form-control" id="website" name="website" placeholder="Website link">
                  <div class="invalid-feedback">
                    Please select your Website link.
                  </div>
                </div>
              </div>

              <hr class="mb-4">
                <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="addStaff" value="Add Staff"/> 
            <?= form_close();?> 
         </div>

       <?php }else{ ?>
        

        <h3 class="display-4"> 
        Staff Member
         <select class="btn btn-light btn-sm" name="role" id="role" onchange="window.location.href='<?= base_url();?>/backend/user/staff/?role='+this.value">
          <?php foreach(roleList('staff',NULL) as $role) : ?>
            <option value="developer" <?= ($role['role_name'] == $cRole) ? "selected" : "";?> >  
              <?= strtoupper($role['role_name']);?>
            </option> 
          <?php endforeach ?>  
        </select>
        <a href="<?= base_url();?>/backend/user/staff/add" class="btn btn-danger btn-sm">Add Staff</a> 
       </h3> 

        <div class="table-responsive">

          <table class="table small">
              <caption>List of Staff</caption> 
              <thead>
                <tr>
                  <th scope="col">#</th> 
                  <th scope="col">Profile</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th> 
                  <th scope="col">Role</th>
                  <th scope="col">Joined</th>    
                  <th scope="col">Updated</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
               <?php if(is_array($staff)) : ?>
                <?php $i = 1;foreach($staff as $sm) : ?>
                <tr style="line-height: 57px">
                  <th scope="row"><?= $i;?></th>
                  <td>
                    <?php if($sm['profile_pic']){ ?>
                       <img src="<?= publicFolder().'/user-images/thumbnails/'.$sm['profile_pic'];?>" class="shadow-lg mx-auto d-block rounded" width="100"/>
                    <?php }else{ ?>
                       <img src="<?= publicFolder().'/images/customer-2.png';?>" class="shadow-lg mx-auto d-block rounded" width="100"/>
                    <?php } ?>
                    
                  </td>
                  <td><?= $sm['firstname'] ? $sm['firstname'].' '.$sm['lastname'] : 'No Name';?></td>
                  <td><?= $sm['email'];?></td>
                  <td><?= $sm['mobile'];?></td>
                  <td><?= strtoupper($sm['role']);?></td> 
                  <td><?= date('D, d M Y', strtotime($sm['created_at']));?></td>
                  <td><?= date('D, d M Y', strtotime($sm['updated_at']));?></td>
                  <td><label class="<?= $sm['status_badge'];?>"><?= $sm['status_name'];?></label></td>
                  <td>
                     <a href="<?= base_url();?>/backend/user/staff/profile/<?= $sm['user_id'];?>">
                      <img src="<?= publicFolder();?>/images/view.png"  width="20"/>
                     </a>  |
                     <a href="<?= base_url();?>/backend/user/staff/edit/<?= $sm['user_id'];?>">
                      <img src="<?= publicFolder();?>/images/edit.png"  width="20"/> 
                    </a>  |   
                    <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/user/staff/delete/<?= $sm['user_id'];?>" class="deletePop" />  
                      <img src="<?= publicFolder();?>/images/delete.png" width="20"/>
                    </a> 
                  </td>
                </tr>
               <?php $i++;endforeach ?> 
               <?php endif ?>
              </tbody>
          </table>
        </div>

       <?php } ?>

       

    </div>
  </div>
</div>


<?= modalPopup("Confirmation","Do you want to delete this user ?");?> 
<?= $this->endSection() ?>