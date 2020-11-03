 
 <ul class="nav nav-tabs card-header-tabs">
   
    
    <?php if(in_array('dashboard',roleAccess(\Config\Services::session()->get('role')))) : ?>
      <li class="nav-item"> 
        <a class="nav-link <?= isTabActive("index",2);?>" href="<?= base_url();?>/dashboard/index">Dashboard</a>
      </li> 
     <?php endif ?>
     
     <?php if(in_array('projects',roleAccess(\Config\Services::session()->get('role')))) : ?> 
     <li class="nav-item">
        <a class="nav-link <?= isTabActive("projects",2);?>" href="<?= base_url();?>/dashboard/projects">
         Projects <span class="badge badge-danger"><?= tabNotificationCount()['projects'];?></span>
          <span class="sr-only">unread messages</span>
      </a> 
    </li>
     <?php endif ?>

     <?php if(in_array('listings',roleAccess(\Config\Services::session()->get('role')))) : ?>
     <li class="nav-item">
        <a class="nav-link <?= isTabActive("listings",2);?>" href="<?= base_url();?>/dashboard/listings">
         My Listings <span class="badge badge-danger"><?= tabNotificationCount()['listings'];?></span>
          <span class="sr-only">unread messages</span>
      </a>
    </li>
     <?php endif ?>

    <?php if(in_array('properties',roleAccess(\Config\Services::session()->get('role')))) : ?>
    <li class="nav-item">
      <a class="btn btn-outline-dark nav-link" href="<?= base_url();?>/browse" target="__blank">
          Properties <span class="badge badge-danger"><?= tabNotificationCount()['properties'];?></span>
          <span class="sr-only">unread messages</span>
      </a>
    </li>
    <?php endif ?>
    
    <?php if(in_array('appointments',roleAccess(\Config\Services::session()->get('role')))) : ?>
    <li class="nav-item">
        <a class="nav-link <?= isTabActive("appointments",2);?>" href="<?= base_url();?>/dashboard/appointments">
         Appointments <span class="badge badge-danger"><?= tabNotificationCount()['appointments'];?></span>
          <span class="sr-only">unread messages</span> 
        </a>
    </li>
    <?php endif ?>

    <?php if(in_array('leads',roleAccess(\Config\Services::session()->get('role')))) : ?>
    <li class="nav-item">
        <a class="nav-link <?= isTabActive("leads",2);?>" href="<?= base_url();?>/dashboard/leads">
         Leads <span class="badge badge-danger"><?= tabNotificationCount()['leads'];?></span>
          <span class="sr-only">unread messages</span> 
        </a>
    </li>  
    <?php endif ?>
   
    <?php if(in_array('sales',roleAccess(\Config\Services::session()->get('role')))) : ?>
    <li class="nav-item">
       <a class="nav-link <?= isTabActive("sales",2);?>" href="<?= base_url();?>/dashboard/sales">
         Sales <span class="badge badge-danger"><?= tabNotificationCount()['sales'];?></span>
          <span class="sr-only">unread messages</span> 
        </a>
    </li>
     <?php endif ?>
     
     <?php if(in_array('profit_target',roleAccess(\Config\Services::session()->get('role')))) : ?>
     <li class="nav-item">
        <a class="nav-link <?= isTabActive("profit_target",2);?>" href="<?= base_url();?>/dashboard/profit_target">
         Profit/Target <span class="badge badge-danger"><?= tabNotificationCount()['profit'];?></span>
          <span class="sr-only">unread messages</span> 
        </a>
    </li>
    <?php endif ?>
    
    <?php if(in_array('contacts',roleAccess(\Config\Services::session()->get('role')))) : ?>
    <li class="nav-item">
       <a class="nav-link <?= isTabActive("contacts",2);?>" href="<?= base_url();?>/dashboard/contacts">
         Contacts <span class="badge badge-danger"><?= tabNotificationCount()['contacts'];?></span>
          <span class="sr-only">unread messages</span> 
        </a> 
    </li>
    <?php endif ?>
    
    <?php if(in_array('messages',roleAccess(\Config\Services::session()->get('role')))) : ?>
    <li class="nav-item">
       <a class="nav-link <?= isTabActive("messages",2);?>" href="<?= base_url();?>/dashboard/messages">
         Messages <span class="badge badge-danger"><?= tabNotificationCount()['messages'];?></span>
          <span class="sr-only">unread messages</span> 
        </a>   
    </li>
   <?php endif ?>
   
   <?php if(in_array('reviews',roleAccess(\Config\Services::session()->get('role')))) : ?> 
    <li class="nav-item">
       <a class="nav-link <?= isTabActive("reviews",2);?>" href="<?= base_url();?>/dashboard/reviews">
         Reviews <span class="badge badge-danger"><?= tabNotificationCount()['reviews'];?></span>
          <span class="sr-only">unread messages</span> 
        </a>   
    </li>
    <?php endif ?>


   <?php if(in_array('credits',roleAccess(\Config\Services::session()->get('role')))) : ?> 
    <li class="nav-item">
       <a class="nav-link <?= isTabActive("credits",2);?>" href="<?= base_url();?>/dashboard/credits">
        Credits <!-- <span class="badge badge-danger">9</span> -->
          <span class="sr-only">unread messages</span> 
        </a>   
    </li>
    <?php endif ?>
     
     <?php if(in_array('notifications',roleAccess(\Config\Services::session()->get('role')))) : ?> 
     <li class="nav-item">
        <a class="nav-link <?= isTabActive("notifications",2);?>" href="<?= base_url();?>/dashboard/notifications">
         Notifications <!-- <span class="badge badge-danger">9</span> -->
          <span class="sr-only">unread messages</span> 
        </a>   
    </li> 
    <?php endif ?>  
</ul>