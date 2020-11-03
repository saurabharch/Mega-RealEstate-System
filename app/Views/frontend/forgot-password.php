
<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>
  
<?= $this->include('common/header') ?>

<main role="main">

  <section class="jumbotron">
    <div class="container">
     
      <h1>Forgot-Password</h1>
      <p class="lead text-muted">India's No 1 Property Site</p>
       <hr>  
  
  <?= \Config\Services::session()->getFlashdata('alert');?> 

  
  <?php if($section == 'hash'){ ?>
  <?= form_open('forgot-password/?id='.$_GET['id']) ?>
  <?= csrf_field() ?> 
   <div class="form-group"> 
    <label for="inputAddress">Enter OTP Pin</label> 
    <input type="text" class="form-control" id="inputOtp" name="inputOtp" placeholder="OTP Pin" value="<?= old('display-name');?>" autocomplete="false"/>
  </div>
  <input type="submit" class="btn btn-primary" name="submitOtp" value="Submit OTP"/>    
  <span class="text-success"> OTP Pin is sent to your mobile and email ID</span>  
  <hr> 
  <?= form_close() ?>
  <?php }elseif($section == 'changePasswordForm'){ ?>
  <?= form_open('forgot-password/?id='.$_GET['id']) ?> 
  <?= csrf_field() ?> 
   <div class="form-group">
    <label for="inputAddress">Enter New Password</label>    
    <input type="text" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" autocomplete="false" required/>
  </div>
   <div class="form-group">  
    <label for="inputAddress">RE-Enter Password</label>  
    <input type="text" class="form-control" id="newPassword2" name="newPassword2" placeholder="Re-enter Password" autocomplete="false" required/> 
  </div>
  <input type="submit" class="btn btn-primary" name="saveNewPassword" value="Change Password"/>  
  <hr> 
  <?= form_close() ?>
  <?php }elseif($section == 'success'){ ?> 
  <div class="card">
        <div class="card-body">
           <center class="text-success">Thanks for changing your password and making it more secured.</center>
           <br>  
          <a href="<?= base_url();?>/login" class="btn btn-danger btn-block">
            <img src="<?= publicFolder();?>/images/login.png" width="20"/> Login Now 
          </a>
        </div>
   </div>
  <?php }else{ ?>
  <?= form_open('forgot-password/') ?>
  <?= csrf_field() ?> 



  <!--  <div class="form-group">
        <label for="inputAddress">Enter Mobile Number</label>
        <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="radio" name="option" value="mobile" id="optionMob">
        </div>
      </div>
      <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" autocomplete="false" onclick="$('#optionMob').click()" />
    </div>
  </div> 

  <b>OR</b>  -->

  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      Email ID
    </div>
  </div> 
  <input type="text" class="form-control" id="email" name="email" placeholder="Registered Email Address" onclick="$('#optionEmail').click()"/>
</div> 

  <button type="submit" class="btn btn-light">Cancel</button>  
  <input type="submit" class="btn btn-primary" name="submitEmailAndMobile" value="Next"/>

  <hr> 
   <?= form_close() ?> 
  <?php } ?> 
 


  
    </div>
  </section>
</main> 


<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>