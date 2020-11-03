
<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

<?= $this->include('common/header') ?> 

<main role="main">
    <div class="container">
      <h4 class="display-4" style="margin-top: 100px">Agent Profile</h4>
      
      <?php foreach($sAgents as $profile){} ;?>

      <div class="container emp-profile"> 
           
                <div class="row">
                    <div class="col-md-4"> 
                        
                          <?php if($profile['profile_pic']){ ?>  
                            <img src="<?= publicFolder();?>/user-images/thumbnails/<?= $profile['profile_pic'];?>" class="shadow-lg mx-auto d-block rounded" width="80%"/>
                          <?php }else{ ?>
                            <img src="<?= publicFolder();?>/user-images/agent-1.jpeg" class="rounded-circle"/> 
                          <?php } ?>
                      
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5 class="display-4">
                                        <?= ucfirst($profile['firstname']);?> <?= ucfirst($profile['lastname']);?>
                                    </h5>
                                    <h6>
                                        PropertyRaja Premier Agent
                                    </h6>

                                    <h6>
                                      Ratings :
                                      <?php getUserRatings('seller',$profile['user_id'],$status = 1);?>                         
                                      (<?= getUserRatingsNumber('seller',$profile['user_id'],$status = 1);?>) 
                                    </h6>
                                    <h6>Reviews : <span><?= totalUserReviews('seller',$profile['user_id'],1);?></span></h6>
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
                                        Account Status - <label class="<?= $profile['status_badge'];?>"><?= ucfirst($profile['status_name']);?></label>
                                    </h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" class="profile-edit-btn" onclick="window.print();">PRINT <img src="<?= publicFolder();?>/images/print.png" width="20" ></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>SERVICE AREA</p>
                            <?php foreach(json_decode($profile['service_area']) as $r) : ?>
                              <a href="<?= base_url();?>/browse?q=<?= $r;?>" target="__self"><?= $r;?></a><br/>
                            <?php endforeach ?>
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
                            <a href="<?= $profile['facebook'];?>" target="__blank">Facebook</a><br/>
                            <a href="<?= $profile['linkedin'];?>" target="__blank">LinkedIn</a><br/>
                            <a href="<?= $profile['twitter'];?>" target="__blank">Twitter</a><br/>                            
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
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= ucfirst($profile['firstname']);?> <?= ucfirst($profile['lastname']);?></p>
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
                                                <label>Experience</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $profile['experience'];?></p>
                                            </div>
                                        </div>
                                        <?php if($profile['hourly_rate']) : ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Hourly Rate</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $profile['hourly_rate'];?> INR/hr</p> 
                                            </div>
                                        </div>
                                        <?php endif ?>
                                        <?php if($profile['fixed_rate']) : ?>
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <label>Fixed Rate</label> 
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $profile['fixed_rate'];?>INR</p>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Total Sales</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $profile['salesCount'];?></p>
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
                                                <label>RE License No</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $profile['re_license_no'];?></p>
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
                 <hr> 
                 <div class="row">
                   <h4 class="col-md-12">Ratings & Reviews <small><a href="<?= base_url();?>/public-profile/<?= segment(2);?>/write-review" class="btn btn-outline-danger btn-sm float-right">Write a review</a></small></h4> 
                   <br><br>
                   <ul class="list-unstyled">
                     <?php if(is_array($getAllReviews)){ ?> 
                      <?php foreach($getAllReviews as $review){ ?> 
                      <li class="media">
                        <img src="<?= publicFolder();?>/user-images/thumbnails/<?= $review['profile_pic'];?>" width="60" class="mr-3" alt="..."> 
                        <div class="media-body">
                          <h5 class="mt-0 mb-1">
                             <?= $review['title'];?> 
                             <small class="float-right">  
                                <a href="javascript:void(0)" class="reportFlagBtn" data-reviewid="<?= $review['review_id'];?>">   
                                    <img src="<?= publicFolder();?>/images/flag.png" width="14"/>
                                </a>
                             </small>
                          </h5>
                          <small class="form-text text-muted"><?= date('D, d M Y', strtotime($review['created_at']));?> - <?= $review['firstname'];?></small>
                          <div class="row">
                            <div class="col-md-2">Local knowledge: </div>
                            <div class="col-md-4"><?php ratingCalculator($review['local_knowledge']);?></div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">Process expertise: </div>
                            <div class="col-md-4"><?php ratingCalculator($review['process_expertise']);?></div>
                          </div>
                         <div class="row">
                            <div class="col-md-2">Responsiveness: </div>
                            <div class="col-md-4"><?php ratingCalculator($review['responsiveness']);?></div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">Negotiation skills: </div>
                            <div class="col-md-4"><?php ratingCalculator($review['negotiation_skills']);?></div>
                          </div>
                          
                          <br>
                          <?= $review['comment'];?>
                        </div>
                      </li>
                      <?php } ?>
                      <?php }else{ ?>
                      <li class="media">
                        <div class="media-body">
                          <h5 class="mt-0 mb-1">
                             <small class="float-right">  
                               No Review
                             </small>
                          </h5> 
                          <br>
                          <?= $review['comment'];?>
                        </div>
                      </li>
                      <?php } ?>
                    </ul>
                 </div>   
        </div>

    </div> 
</main>

<div class="modal fade" id="reportFlag" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Report a problem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="reviewSubmitAlert"></span> 
       <table class="table table-borderless" id="reviewSubmitForm">
           <tr>
              <td>
              <b>Problem</b><br> 
              <select class="form-control" id="problem">   
                  <option value="Inaccurate review" selected>Inaccurate review</option>
                  <option value="Offensive language">Offensive language</option>
                  <option value="Appears fake">Appears fake</option>
                  <option value="Inappropriate agent response">Inappropriate agent response</option>
              </select>
              </td>
           </tr>
           <tr>
              <td>
              <b>Details</b><br>
              <textarea class="form-control" name="details" id="details" required=""></textarea>
              </td>
           </tr>
           <?php if(! \Config\Services::session()->get('userId')){ ?>
           <tr>
              <td> 
              <b>Your e-mail</b><br> 
              <input type="text" name="email" class="form-control" id="email" required="" /> 
              </td>
           </tr>
           <?php }else{ ?> 
              <input type="hidden" name="email" class="form-control" id="email" value="<?= \Config\Services::session()->get('email');?>" /> 
           <?php } ?> 
           <tr>
               <td><a href="javascript:void(0)" class="btn btn-danger" id="submitReviewFlag">Submit</a></td>  
           </tr> 
       </table> 
       <input type="hidden" name="reviewId" class="form-control" id="reviewId" />   
      </div>
    </div>
  </div>
</div>
<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>