<?= $this->extend('common/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('common/header') ?> 

<main role="main">
    <div class="container">
      
      <?php foreach($sAgents as $profile){} ;?>
      <?php
       $stars = ['Never','Unlikely','Maybe','Likely','Highly Likely'] ;   
       ?>

      <div class="container"> 
              
              <?= form_open('/public-profile/'.segment(2).'/write-review');?>
                  <h4 class="display-4" style="margin-top: 100px">Write Review</h4>
                  <?= \Config\Services::session()->getFlashdata('alert');?>
                  <p>How likely are you to recommend <?= ucfirst($profile['firstname']);?> <?= ucfirst($profile['lastname']);?></p>
                  <p> Your Overall Rating : &nbsp;&nbsp;  
                       
                       <?php foreach($stars as $key => $val){ ?> 
                           <a href="#" data-title="<?= $val;?>" class="text-decoration-none starHover" data-starid="<?= $key + 1;?>"> 
                             <img src="<?= publicFolder();?>/images/star.png" width="20" class="str star<?= $key + 1 ;?>" style="display: none" />

                             <img src="<?= publicFolder();?>/images/star-empty.png" width="20" class="estr star-empty<?= $key + 1;?>" > 
                           </a>
                       <?php } ?>
                       <input type="hidden" id="selectedStar" name="selectedStar" value="0"/>   
                       <span id="starRemark"></span> 
                  </p>       
                  <div class="row">
                    <div class="col-md-2">Local knowledge: </div>
                    <div class="col-md-10"> 
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="local_knowledge" id="inlineRadio1" value="1">
                          <label class="form-check-label" for="inlineRadio1">Poor</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="local_knowledge" id="inlineRadio2" value="2">
                          <label class="form-check-label" for="inlineRadio2">Spotty</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="local_knowledge" id="inlineRadio3" value="3">
                          <label class="form-check-label" for="inlineRadio3">Average</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="local_knowledge" id="inlineRadio3" value="4">
                          <label class="form-check-label" for="inlineRadio3">Extensive</label>
                        </div>   
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="local_knowledge" id="inlineRadio3" value="5" checked>
                          <label class="form-check-label" for="inlineRadio3">Very Impressive</label>
                        </div>          
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-2">Process expertise: </div>
                    <div class="col-md-10">
                          <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="process_expertise" id="inlineRadio1" value="1">
                          <label class="form-check-label" for="inlineRadio1">Poor</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="process_expertise" id="inlineRadio2" value="2">
                          <label class="form-check-label" for="inlineRadio2">Lacking</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="process_expertise" id="inlineRadio3" value="3">
                          <label class="form-check-label" for="inlineRadio3">Adequate</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="process_expertise" id="inlineRadio3" value="4">
                          <label class="form-check-label" for="inlineRadio3">Good</label>
                        </div>   
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="process_expertise" id="inlineRadio3" value="5" checked>
                          <label class="form-check-label" for="inlineRadio3">Masterful</label>
                        </div>     
                    </div>
                  </div>
                  <br>
                 <div class="row">
                    <div class="col-md-2">Responsiveness: </div>
                    <div class="col-md-10">
                          <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="responsiveness" id="inlineRadio1" value="1">
                          <label class="form-check-label" for="inlineRadio1">Poor</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="responsiveness" id="inlineRadio2" value="2">
                          <label class="form-check-label" for="inlineRadio2">Slow</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="responsiveness" id="inlineRadio3" value="3">
                          <label class="form-check-label" for="inlineRadio3">Average</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="responsiveness" id="inlineRadio3" value="4">
                          <label class="form-check-label" for="inlineRadio3">Good</label>
                        </div>   
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="responsiveness" id="inlineRadio3" value="5" checked>
                          <label class="form-check-label" for="inlineRadio3">Immediate</label>
                        </div>     
                    </div>
                  </div>
                  <br>

                  <div class="row">
                    <div class="col-md-2">Negotiation skills: </div>
                    <div class="col-md-10">
                          <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="negotiation_skills" id="inlineRadio1" value="1">
                          <label class="form-check-label" for="inlineRadio1">Inadequate</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="negotiation_skills" id="inlineRadio2" value="2">
                          <label class="form-check-label" for="inlineRadio2">Fair</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="negotiation_skills" id="inlineRadio3" value="3">
                          <label class="form-check-label" for="inlineRadio3">Adequate</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="negotiation_skills" id="inlineRadio3" value="4">
                          <label class="form-check-label" for="inlineRadio3">Smooth</label>
                        </div>   
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="negotiation_skills" id="inlineRadio3" value="5" checked>
                          <label class="form-check-label" for="inlineRadio3">Excellent</label> 
                        </div>     
                    </div>
                  </div>
                  <br> 
                  <b>Feedback Title*</b>
                  <input type="text" name="title" class="form-control" placeholder="Your feedback title" value="Highly likely to recommend"/>
                  <br>
                   <p>Describe in detail your experience with <?= ucfirst($profile['firstname']);?> <?= ucfirst($profile['lastname']);?></p>
                   <br>
                   <textarea class="form-control" name="message" id="review_message" rows="10" tabindex="1" required="required" maxlength="5000" title="Specific examples are very helpful, but be aware that this review will be public." errortext="Reviews must be at least 150 characters long. Specific examples are very helpful!" placeholder="Include details to help others decide if they should contact this pro..."></textarea>
                  
                   <table class="table table-borderless">
                    <tr>
                        <th>Service provided*</th> 
                        <td>
                            <select name="service_provided" class="form-control">
                                <option disabled="" selected>(Choose one)</option>  
                                <option value="Listed and sold a home or lot/land">Listed and sold a home or lot/land</option>
                                <option value="Listed home or lot/land, but didn't sell">Listed home or lot/land, but didn't sell</option>
                                <option value="Helped me buy a home or lot/land">Helped me buy a home or lot/land</option>
                                <option value="Showed me homes or lots">Showed me homes or lots</option>
                                <option value="Helped me buy and sell homes">Helped me buy and sell homes</option>
                                <option value="Helped me find tenant for rental">Helped me find tenant for rental</option>
                                <option value="Helped me find a home to rent">Helped me find a home to rent</option>
                                <option value="Never responded to my inquiry">Never responded to my inquiry</option>
                                <option value="None. We connected, but it did not work out">None. We connected, but it did not work out</option>
                                <option value="Property manage a home I own">Property manage a home I own</option>
                                <option value="Consulted me on buying or selling a home">Consulted me on buying or selling a home</option>
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <th>Complete Address*</th>
                        <td>
                           <input type="text" name="complete_address" placeholder="Full Address Of Property" class="form-control" required="" />
                           <small class="form-text text-muted">Will not be published. Please include city, state and ZIP.</small>
                        </td>
                    </tr>
                    <tr>  
                        <th>Property Link<br>(If uploaded)</th>
                        <td>
                          <input type="text" name="property_link" placeholder="Property Link" class="form-control" />
                        </td>
                    </tr>
                    <?php if(! \Config\Services::session()->get('userId')){ ?>
                    <tr>
                        <th>PropertyRaja Account</th>
                        <td>
                            <p>We require accounts to prevent fraud (no private info will be shared).</p>
                            <p>
                                <input type="radio" name="hasAccount"> I need to create a PropertyRaja account<br>
                                <input type="radio" name="hasAccount" checked=""> I already have a PropertyRaja account
                            </p>
                        </td>
                    </tr>
                    <?php } ?> 
                    <tr>
                        <td colspan="2"> 
                            <p><input type="checkbox" name="iAgree" id="iAgree" value="1" />  
                                I promise this review is honest and respectful. I understand 
                                <a href="<?= base_url();?>/review-guidelines" target="__blank"title="Review Guidelines">PropertyRaja's Review Guidelines</a>. </p>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                           <?php if(! \Config\Services::session()->get('userId')){ ?>
                             <a href="<?= base_url();?>/login/?redirect=/public-profile/<?= segment(2);?>/write-review" class="btn btn-danger">Submit Review After Login</a>
                           <?php }else{ ?>
                             <input type="submit" class="btn btn-danger" name="submitReview" id="submitReview" value="Submit Review" disabled/>
                           <?php } ?>  
                           
                        </td>
                    </tr>
                   </table>
                   <?= form_close();?> 

                 <hr> 
                 <div class="row">
                   <h4 class="col-md-12">Ratings & Reviews </h4> 
                   <br><br>
                   <ul class="list-unstyled">
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
                          <small class="form-text text-muted">
                               <?= date('D, d M Y', strtotime($review['created_at']));?> - <?= $review['firstname'];?>
                          </small> 
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