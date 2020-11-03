
<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

<?= $this->include('common/header') ?>

<main role="main">
         
          <div class="container contact">
                <div class="row">
                  <h1 class="display-4">Contact Us</h1>
                </div>
                 <hr> 
                  
                <div class="row"> 
                  <div class="col-md-3">

                    <div class="contact-info">
                      <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
                      <h2>Any Query</h2>
                      
                      <h4>We would love to hear from you !</h4>
                      <p>support@PropertyRaja.com</p>
                      <p>Phone - (316)-90987</p> 
                    </div>
                  </div>
                  <div class="col-md-9"> 
                    <div class="contact-form">
                    <?php if(\Config\Services::session()->getFlashdata('alert')){ ?>
                         <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Thank You!</h4>
                            <p>For contacting us about your query we will get back to you as soon!</p>
                            <hr>
                            <p class="mb-0">For immediate support you can dial our given toll-free number.</p>
                          </div>
                          <h4 class="display-4">Download Our App</h4> 
                          <img class="mb-2" src="<?= publicFolder();?>/images/app.png" alt="" width="200">   
                    <?php }else{ ?>
                           <?= form_open('contact');?> 
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="fname">First Name:</label> 
                              <div class="col-sm-10">          
                              <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required="" />
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="lname">Last Name:</label>
                              <div class="col-sm-10">          
                              <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required=""/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="email">Email:</label>
                              <div class="col-sm-10">
                              <input type="email" class="form-control" name="email" placeholder="Enter email" required=""/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="comment">Comment:</label>
                              <div class="col-sm-10">
                              <textarea class="form-control" rows="5" name="comment" required="" placeholder="Enter your query.."></textarea>
                              </div>
                            </div>
                            <div class="form-group">        
                              <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-warning" value="Submit Without Login" name="submitContactUs" /> 
                                <a href="<?= base_url();?>/login/?redirect=/contact" class="btn btn-warning float-right" name="submitContactUs">Login Then Submit</a>   
                              </div> 
                            </div> 
                            <?= form_close();?>
                    <?php } ?>   
                     
                    </div>
                  </div>
              </div>
          </div>
  
</main>


<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>