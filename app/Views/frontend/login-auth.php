
<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

<?= $this->include('common/header') ?>

<main role="main">
  <section class="jumbotron">
    <div class="container">  
  


      <?php if($role == "customer") : ?> 
      <h1>Sign-In</h1>
        <p class="lead text-muted">India's No 1 Property Site</p>
      <hr>  
      <?= \Config\Services::session()->getFlashdata('alert');?>  
      <?= form_open('login') ?>
      <?= csrf_field() ?>
      <div class="form-group">
           <label for="inputAddress2">Mobile Number</label>
           <input type="text" name="mobile-number" class="form-control" id="mobile-number" placeholder="Mobile Number" value="<?= old('mobile-number');?>" />
      </div>
      <div class="form-group">
           <label for="inputCity">Choose Password</label>
           <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?= old('password');?>"/>
      </div>
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck" name="remember_me" value="1"/>  
          <label class="form-check-label" for="gridCheck">
            Remember me
          </label> 
        </div>
      </div>

      <button type="submit" class="btn btn-light">Cancel</button>
      <input type="submit" class="btn btn-primary" name="sign-in" value="Sign In" />
      <a href="<?= base_url();?>/forgot-password" class="float-right">Forgot Login?</a>
      <hr>
      <div class="form-group">
        <label for="inputAddress">
        	Not a member?
        	<a href="<?= base_url();?>/register">Sign-up</a>
        </label> | 
      </div>

<?= form_close() ?>
<?php endif ?>
 



 <?php if($role == "agent") : ?> 
 
 <h1>Sign-In | Agent</h1>
  <p class="lead text-muted">India's No 1 Property Site</p>
  <hr>     
  <?= \Config\Services::session()->getFlashdata('alert');?>      
  <?= form_open('login-agent') ?>
  <?= csrf_field() ?> 
  <div class="form-group">
    <label for="inputAddress2">Mobile Number</label>
   <input type="text" name="mobile-number" class="form-control" id="mobile-number" placeholder="Mobile Number" value="<?= old('mobile-number');?>" />
  </div>
  <div class="form-group">
    <label for="inputCity">Choose Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?= old('password');?>"/>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" name="remember_me" value="1"/>
      <label class="form-check-label" for="gridCheck">
        Remember me
      </label> 
    </div></div>
  <button type="submit" class="btn btn-light">Cancel</button>
  <input type="submit" class="btn btn-primary" name="sign-in" value="Sign In" />
  <hr>
   <div class="form-group">
    <label for="inputAddress">
      Not a member?
      <a href="<?= base_url();?>/register">Sign-up</a>
    </label>
  </div>
<?= form_close() ?>  
<?php endif ?>

<?php if($role == "developer") : ?>  
 
 <h1>Sign-In | RealEstate Developer</h1>
  <p class="lead text-muted">India's No 1 Property Site</p>
  <hr>      
  <?= \Config\Services::session()->getFlashdata('alert');?>  
  <?= form_open('login-developer') ?>
  <?= csrf_field() ?> 
  <div class="form-group">
    <label for="inputAddress2">Mobile Number</label>
    <input type="text" name="mobile-number" class="form-control" id="mobile-number" placeholder="Mobile Number" value="<?= old('mobile-number');?>" />
  </div>
  <div class="form-group">
    <label for="inputCity">Choose Password</label>
     <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?= old('password');?>"/>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" name="remember_me" value="1"/>
      <label class="form-check-label" for="gridCheck">
        Remember me
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-light">Cancel</button>
  <input type="submit" class="btn btn-primary" name="sign-in" value="Sign In" /> 
  <hr>
   <div class="form-group">
    <label for="inputAddress">
      Not a member?
      <a href="<?= base_url();?>/register">Sign-up</a>
    </label>
  </div>
</form>
<?php endif ?>




 <?php if($role == "staff") : ?>  
      
  <h1>Sign-In | Staff</h1>
  <p class="lead text-muted">India's No 1 Property Site</p>
  <hr>     
  <?= \Config\Services::session()->getFlashdata('alert');?>  
  <?= form_open('login-staff') ?>
  <?= csrf_field() ?> 
  <div class="form-group">
    <label for="inputAddress2">Username</label>
    <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?= old('username');?>" /> 
  </div>
  <div class="form-group"> 
    <label for="inputCity">Choose Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password" /> 
  </div>
  <div class="form-group">
    <label for="inputCity">Staff Role</label>
    <select name="role" class="form-control">
      <?php if(is_array($staffRoles)){ ?> 

           <?php foreach($staffRoles as $roles){ ?>
              <option value="<?= $roles['role_name'];?>"><?= ucfirst($roles['role_name']);?></option> 
           <?php } ?>

       <?php }else{ ?>
              <option value="">No Roles</option> 
       <?php } ?>

    </select>
  </div>
  <div class="form-group">
    <label for="inputCity">Staff Access Code</label>
    <input type="text" class="form-control" id="access_code" placeholder="Access Code" name="access_code" />
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Remember me
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-light">Cancel</button>
  <input type="submit" class="btn btn-primary" name="sign-in" value="Sign In" /> 
    <hr>
   <div class="form-group">
    <label for="inputAddress">
      Not a member?
      <a href="<?= base_url();?>/register">Sign-up</a>
    </label>
  </div>
</form>
<?php endif ?>

  </div>
  </section> 

</main>

<?= $this->include('common/footer') ?>


<?= $this->endSection() ?>