 <header> 
  <div class="collapse" id="navbarHeader" style="background-color: #d0bb7d">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About PropertyRaja</h4>
          <p class="text-muted">
            Launched in 2020, PropertyRaja.com, India’s No. 1 property portal, deals with every aspect of the consumers’ needs in the real estate industry. It is an online forum where buyers, sellers and brokers/agents can exchange information about real estate properties quickly, effectively and inexpensively. At PropertyRaja.com, you can advertise a property, search for a property, browse through properties, build your own property microsite, and keep yourself updated with the latest news and trends making headlines in the realty sector.
          </p> 
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          

            <?php if(\Config\Services::session()->get('userId')){ ?>
               <h4 class="text-white">Welcome</h4>
               <ul class="list-unstyled">
                  <li><a href="<?= base_url();?>/login" class="text-white"><?php echo strtoupper(\Config\Services::session()->get('display'));?></a></li>
                  <li><a href="<?= base_url();?>/profile" class="text-white">My Profile</a></li>
                  <li><a href="<?= base_url();?>/messages" class="text-white">Messages</a></li>
                  <li><a href="<?= base_url();?>/notification" class="text-white">Notifications</a></li>
                  <li><a href="<?= base_url();?>/logout" class="text-white">Logout</a></li>
               </ul>    
            <?php }else{ ?>
              <h4 class="text-white">Login</h4>
              <ul class="list-unstyled">
                <li><a href="<?= base_url();?>/login" class="text-white">Customer Login</a></li>
                <li><a href="<?= base_url();?>/login-agent" class="text-white">Agent Login</a></li>
                <li><a href="<?= base_url();?>/login-developer" class="text-white">Developer Login</a></li>  
                <li><a href="<?= base_url();?>/login-staff" class="text-white">Staff Login</a></li>
              </ul>
            <?php } ?>


         
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-light bg-light shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="<?= base_url();?>" class="navbar-brand d-flex align-items-center">
        <img src="<?= publicFolder();?>/images/propertyraja.png" width="200"/>
      </a>

      

      <div class="btn-group">
             <?php if(!\Config\Services::session()->get('userId')){ ?>
               <a href="<?= base_url();?>/login/?redirect=/add-property" class="text-danger text-decoration-none sellPropertyBtn"><b>Sell Property</b></a>
             <?php } ?> 
             
            <?php if(\Config\Services::session()->get('userId')){ ?>  
            <a href="<?= base_url();?>/messages/?status=1" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="All messages sent to owners">
              <img src="<?= publicFolder();?>/images/messages.png" width="22"/> <span class="badge badge-danger"><?= allMessagesReceived();?></span>
              <span class="sr-only">unread messages</span> 
            </a>
            <a href="<?= base_url();?>/favourites/?status=1" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="shortlisted properties">
              <img src="<?= publicFolder();?>/images/star-empty.png" width="22"/> <span class="badge badge-danger"><?= allNotificationsReceived();?></span>
              <span class="sr-only">unread messages</span>
            </a>
            <a class="btn btn-outline-white btn-sm dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <?php echo strtoupper(\Config\Services::session()->get('display'));?>
            </a>
            <div class="dropdown-menu dropdown-menu-right animate slideIn">
                <span class="dropdown-menu-arrow"></span>
                <?php if(\Config\Services::session()->get('role') == "customer"){ ?> 
                <a class="dropdown-item" href="<?= base_url();?>/add-property">Add Property</a>
                <a class="dropdown-item" href="<?= base_url();?>/profile">My Profile</a>
                <a class="dropdown-item" href="<?= base_url();?>/properties">My Properties</a> 
                <a class="dropdown-item" href="<?= base_url();?>/favourites">Favourites</a>
                <a class="dropdown-item" href="<?= base_url();?>/messages">Messages</a> 
                <a class="dropdown-item" href="<?= base_url();?>/notifications">Notifications</a>
                <div class="dropdown-divider"></div> 
                <a class="dropdown-item" href="<?= base_url();?>/logout">Logout</a>
                <?php }elseif(\Config\Services::session()->get('role') == "agent"){ ?>
                <a class="dropdown-item" href="<?= base_url();?>/dashboard/index">Dashboard</a>
                <a class="dropdown-item" href="<?= base_url();?>/add-property">Add Property</a>
                <a class="dropdown-item" href="<?= base_url();?>/profile">My Profile</a>
                <a class="dropdown-item" href="<?= base_url();?>/favourites">Favourites</a>
                <a class="dropdown-item" href="<?= base_url();?>/messages">Messages</a> 
                <a class="dropdown-item" href="<?= base_url();?>/notifications">Notifications</a>
                <div class="dropdown-divider"></div> 
                <a class="dropdown-item" href="<?= base_url();?>/logout">Logout</a>
                <?php }elseif(\Config\Services::session()->get('role') == "developer"){ ?>
                <a class="dropdown-item" href="<?= base_url();?>/dashboard/index">Dashboard</a>
                <a class="dropdown-item" href="<?= base_url();?>/dashboard/projects">Project Panel</a>
                <a class="dropdown-item" href="<?= base_url();?>/add-property">Add Property</a>
                <a class="dropdown-item" href="<?= base_url();?>/profile">My Profile</a>
                <a class="dropdown-item" href="<?= base_url();?>/favourites">Favourites</a>
                <a class="dropdown-item" href="<?= base_url();?>/messages">Messages</a> 
                <a class="dropdown-item" href="<?= base_url();?>/notifications">Notifications</a>
                <div class="dropdown-divider"></div> 
                <a class="dropdown-item" href="<?= base_url();?>/logout">Logout</a>
                <?php }elseif(\Config\Services::session()->get('role') == "admin"){ ?>
                <a class="dropdown-item" href="<?= base_url();?>/backend/dashboard/index">Go To Dashboard</a>
                <a class="dropdown-item" href="<?= base_url();?>/logout">Logout</a>
                <?php } ?>

            </div>
            <?php }else{ ?> 
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <?php } ?>
      </div>
    </div>
  </div>
</header> 