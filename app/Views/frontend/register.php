
<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>
  
<?= $this->include('common/header') ?>

<main role="main">

  <section class="jumbotron">
    <div class="container">
     
      <h1>Sign-Up</h1>
      <p class="lead text-muted">India's No 1 Property Site</p>
       <hr>  
  
  <?= \Config\Services::session()->getFlashdata('alert');?> 

  <?= form_open('register','onsubmit="return validateForm(this)"') ?>
  <?= csrf_field() ?> 
  <?php if(\Config\Services::session()->getFlashdata('success') == 1){ ?> 
 
   <div class="card">
        <div class="card-body">
           <center class="text-success">A verification link is sent to your email address to verify your email.</center>
           <br> 
          <a href="<?= base_url();?>/login" class="btn btn-danger btn-block">
            <img src="<?= publicFolder();?>/images/login.png" width="20"/> Login Now 
          </a>
        </div>
   </div>


 
  <?php }else{ ?>
      <div class="form-group">
    <div class="form-check"> 
      <input type="checkbox" name="agree" id="agree" class="form-check-input" value="yes" />
      <label class="form-check-label" for="agree">  
        &nbsp;I accept terms and condtions to use services of propertyraja.com &nbsp;
      </label>
    </div>
  </div>
  <div class="form-group">
      <div class="btn-group" role="group" aria-label="Basic example" style="width:100%">
        <button type="button" class="btn btn-primary active" 
        onclick="searchingForHome()">Searching for Home</button>
        <button type="button" class="btn btn-primary" onclick="sellingProperty()">Selling Property</button>
      </div>
  </div>
  <input type="hidden" name="purpose" value="buy_rent" id="purpose" /> 
  <div class="collapse" id="collapseExample">
      <div class="card card-body">
          <div class="form-group"> 
            <label class="badge badge-success">I'm</label><br> 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rolename" id="inlineRadio1" value="customer" checked >
                <label class="form-check-label" for="inlineRadio1">House Owner</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rolename" id="inlineRadio2" value="developer">
              <label class="form-check-label" for="inlineRadio2">Real Estate Developer</label>
            </div> 
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rolename" id="inlineRadio3" value="agent">
              <label class="form-check-label" for="inlineRadio3">Agent</label>
            </div>
          </div>
      </div>
  </div>
 
  <div class="form-group">
    <label for="inputAddress">Display Name</label>
    <input type="text" class="form-control" id="display-name" name="display-name" placeholder="Display Name" value="<?= old('display-name');?>" autocomplete="false"/>
  </div>
  <div class="form-group">
    <label for="inputAddress2">Mobile Number</label>
    <input type="text" class="form-control" id="mobile-number" name="mobile-number" placeholder="Mobile Number" value="<?= old('mobile-number');?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Choose Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= old('password');?>" autocomplete="false"/>
    </div>
    <div class="form-group col-md-6"> 
      <label for="inputState">Email</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= old('email');?>">
    </div>
  </div>
  <button type="submit" class="btn btn-light">Cancel</button>  
  <input type="submit" class="btn btn-primary" name="sign-up" value="Sign up"/>  
  <hr>
   <div class="form-group">
    <label for="inputAddress"> 
      Already a member ? 
      <a href="<?= base_url();?>/Auth/login">SignIn</a>
    </label>
  </div>
  
  <?php } ?> 
  <?= form_close() ?>


  
    </div>
  </section>
</main> 




 <script>
   function searchingForHome(){
    $('#collapseExample').collapse('hide');
    $('#purpose').val('buy_rent');
    $('input[value="customer"]').click();
   }
   function sellingProperty(){
     $('#collapseExample').collapse('show');
     $('#purpose').val('sell');
   }
   
   function validateForm(form) 
   {
      console.log("checkbox checked is ", form.agree.checked);
      if(!form.agree.checked)
      {
          $('.form-check-label').addClass('badge-danger');
          return false;
      }
      else
      {
          $('.form-check-label').removeClass('badge-danger'); 
          return true;
      }
   } 
  

 </script>
<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>