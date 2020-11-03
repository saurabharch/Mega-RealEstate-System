
<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

<?= $this->include('common/header') ?>

<main role="main">
    <div class="container">
        <h4 class="display-4" style="margin-top: 100px">Account Status</h4>
        
        <span class="d-block p-2 bg-danger text-white">Reason - Account <?= $status;?> due to violation of Terms & Conditions</span>
        <p class="font-weight-light" style="font-size: 20px;">
         <br>
         More information regarding your <?= strtolower($status);?> email us at - 
         AccountSupport@PropertyRaja.com 
        </p>
               
   </div>
</main>  

<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>  