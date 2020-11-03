
<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

<?= $this->include('common/header') ?> 

<main role="main">
  <section class="jumbotron">
    <div class="container">

            <h1>Sign-In</h1>
            <p class="lead text-muted">India's No 1 Property Site</p>
            <hr>  
            <?= \Config\Services::validation()->listErrors() ? "<div class='alert-danger'>".\Config\Services::validation()->listErrors()."</div>" : ""; ?>  
            <?= \Config\Services::session()->getFlashdata('alert');?>  
            <?= form_open('Auth/verify') ?>
            <?= csrf_field() ?>
            <div class="form-group"> 
               <label for="inputAddress2">Enter OTP Pin</label>
               <input type="text" name="inputOtp" class="form-control" placeholder="OTP PIN" value="<?= old('inputOtp');?>" required />   
            </div>
            <input type="submit" class="btn btn-primary" name="submitOtp" value="Sign In" />
            <hr>

            <?= form_close() ?> 

  
 
   </div>
</section> 
</main>


<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>