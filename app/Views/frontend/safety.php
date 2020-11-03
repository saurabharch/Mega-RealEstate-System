
<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

<link href="https://getbootstrap.com/docs/4.5/examples/album/album.css" rel="stylesheet">    
 <header> 
  <div class="collapse bg-warning" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About PropertyRaja</h4>
          <p class="text-muted">
            Launched in 2020, PropertyRaja.com, India’s No. 1 property portal, deals with every aspect of the consumers’ needs in the real estate industry. It is an online forum where buyers, sellers and brokers/agents can exchange information about real estate properties quickly, effectively and inexpensively. At PropertyRaja.com, you can advertise a property, search for a property, browse through properties, build your own property microsite, and keep yourself updated with the latest news and trends making headlines in the realty sector.
          </p>
        </div> 
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Login</h4>
          <ul class="list-unstyled">
             <li><a href="<?= base_url();?>/login" class="text-white">Customer Login</a></li>
            <li><a href="<?= base_url();?>/login-agent" class="text-white">Agent Login</a></li>
            <li><a href="<?= base_url();?>/login-developer" class="text-white">Developer Login</a></li>  
            <li><a href="<?= base_url();?>/login-staff" class="text-white">Staff Login</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-light bg-light shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="<?= base_url();?>" class="navbar-brand d-flex align-items-center">
        <img src="<?= publicFolder();?>/images/propertyraja.png" width="200"/>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main role="main">
    <div class="container">
        <h4 class="display-4" style="margin-top: 100px">Safety</h4>
        
        <span class="d-block p-2 bg-dark text-white">Contract</span>
        <p class="font-weight-light" style="font-size: 20px;">PropertyRaja is the leading real estate and rental marketplace dedicated to empowering consumers with data, inspiration and knowledge around the place they call home, and connecting them with the best local professionals who can help.

        PropertyRaja serves the full lifecycle of owning and living in a home: buying, selling, renting, financing, remodeling and more. It starts with PropertyRaja's living database of more than 110 million Indian homes - including homes for sale, homes for rent and homes not currently on the market, as well as Zestimate home values, Rent Zestimates and other home-related information. PropertyRaja operates the most popular suite of mobile real estate apps, with more than two dozen apps across all major platforms.

        PropertyRaja launched in 2020 and is headquartered in New Delhi.

       </p>
        
        
   </div>
</main>


<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>