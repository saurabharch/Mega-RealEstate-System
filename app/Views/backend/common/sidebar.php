<div class="col-md-2">
    <ul class="list-group">   
        
        <li class="list-group-item openMenu alert-info <?php echo ((segment(2) == "dashboard") && (segment(3) == "index")) ? "active" : "" ;?>">
          <h4>Dashboard</h4>
          <a href="<?= base_url();?>/backend/dashboard/index" class="stretched-link"></a> 
         </li>
     
         <li class="list-group-item openMenu <?php echo ((segment(2) == "properties" && segment(3) == "index") || segment(3) == "view") ? "active" : "" ;?>"> 
          Browse All Properties<br><small><span class="badge badge-info">3+</span> Property added recently</small>
          <span class="badge badge-info float-right"><?php echo adminSCounter()['properties'];?></span>
          <a href="<?= base_url();?>/backend/properties/index" class="stretched-link"></a> 
         </li> 

        <li class="list-group-item openMenu <?php echo (segment(2) == "properties" && segment(3) == "propertyTypes") ? "active" : "" ;?>">
        Property Type <br><small> Property listing types</small> 
        <span class="badge badge-info float-right"><?php echo adminSCounter()['propertyTypes'];?></span>
        <a href="<?= base_url();?>/backend/properties/propertyTypes" class="stretched-link"></a> 
        </li> 
      
        <li class="list-group-item openMenu <?php echo (segment(2) == "properties" && segment(3) == "amenities") ? "active" : "" ;?>">
        Amenities<br><small> All facilities available</small>
        <span class="badge badge-info float-right"><?php echo adminSCounter()['propertyAmenities'];?></span>
        <a href="<?= base_url();?>/backend/properties/amenities" class="stretched-link"></a>
        </li>
       
       <li class="list-group-item openMenu <?php echo (segment(2) == "user" && segment(3) == "leads") ? "active" : "" ;?>">
      Leads<br> <small> Buyers interested in properties</small>
      <span class="badge badge-info float-right"><?php echo adminSCounter()['leads'];?></span>
      <a href="<?= base_url();?>/backend/user/leads" class="stretched-link"></a>
       </li>
    
      <li class="list-group-item openMenu <?php echo (segment(2) == "user" && segment(3) == "agents") ? "active" : "" ;?>" >
         Agents <br><small>Brokers or Dealers</small>
        <span class="badge badge-info float-right"><?php echo adminSCounter()['agents'];?></span>
        <a href="<?= base_url();?>/backend/user/agents" class="stretched-link"></a>
      </li>
    
     <li class="list-group-item openMenu <?php echo (segment(2) == "user" && segment(3) == "developers") ? "active" : "" ;?>">
        Realestate Developers      <br> 
        <small> Realestate developers or Builders</small> 
        <span class="badge badge-info float-right"><?php echo adminSCounter()['developers'];?></span>
        <a href="<?= base_url();?>/backend/user/developers" class="stretched-link"></a>
     </li> 
    
    <li class="list-group-item openMenu <?php echo (segment(2) == "user" && segment(3) == "customers") ? "active" : "" ;?>">
      Customers/Owners<br> 
    <small> Customers/Owners</small> 
      <span class="badge badge-info float-right"><?php echo adminSCounter()['customers'];?></span>
      <a href="<?= base_url();?>/backend/user/customers" class="stretched-link"></a>
    </li>

    <li class="list-group-item openMenu <?php echo (segment(2) == "user" && segment(3) == "staff") ? "active" : "" ;?>">
      Staff Members<br> 
    <small> Backend staff members</small>
      <span class="badge badge-info float-right"><?php echo adminSCounter()['staffs'];?></span>
      <a href="<?= base_url();?>/backend/user/staff" class="stretched-link"></a>
    </li>

    <li class="list-group-item openMenu <?php echo (segment(2) == "user" && segment(3) == "rolePermissions") ? "active" : "" ;?>">
      Role Permissions<br>  
    <small>Role Permissions</small>
      <span class="badge badge-info float-right"><?php echo adminSCounter()['staffs'];?></span>
      <a href="<?= base_url();?>/backend/user/rolePermissions" class="stretched-link"></a>
    </li>

    <li class="list-group-item openMenu <?php echo (segment(2) == "payment" && segment(3) == "adsPayments") ? "active" : "" ;?>">
      Payments<br> 
    <small> Sponsored/Featured Ads Payments</small>
      <span class="badge badge-info float-right"><?php echo adminSCounter()['staffs'];?></span>
      <a href="<?= base_url();?>/backend/payment/adsPayments" class="stretched-link"></a>
    </li>

    <li class="list-group-item openMenu <?php echo (segment(2) == "user" && segment(3) == "tickets") ? "active" : "" ;?>">
      Tickets<br>
      <small> All support tickets</small>
      <span class="badge badge-info float-right">0</span>
      <a href="<?= base_url();?>/backend/tickets/index" class="stretched-link"></a>
    </li>
    
    <li class="list-group-item openMenu <?php echo (segment(2) == "user" && segment(3) == "reviews") ? "active" : "" ;?>" >
      Reviews<br><small> All user reviews & ratings</small>
      <span class="badge badge-info float-right">0</span>
      <a href="<?= base_url();?>/backend/user/reviews" class="stretched-link"></a>
    </li> 


    <li class="list-group-item openMenu <?php echo (segment(2) == "analytics" && segment(3) == "seo_analytics") ? "active" : "" ;?>">
      SEO & Analytics<br>
      <small> Site and page optimisation</small>
      <span class="badge badge-info float-right">1</span>
      <a href="<?= base_url();?>/backend/analytics/seo_analytics" class="stretched-link"></a>
    </li>

    <li class="list-group-item openMenu <?php echo (segment(2) == "analytics" && segment(3) == "country_city_state") ? "active" : "" ;?>">
      Country City State<br>
      <small>All locations</small>
      <span class="badge badge-info float-right">1</span>
      <a href="<?= base_url();?>/backend/analytics/country_city_state" class="stretched-link"></a>
    </li>

    <li class="list-group-item openMenu <?php echo (segment(2) == "templates") ? "active" : "" ;?>">
      Templates<br>
      <small>Page templates</small>
      <span class="badge badge-info float-right">0</span> 
      <a href="<?= base_url();?>/backend/templates/" class="stretched-link"></a>
    </li>
    
    <li class="list-group-item openMenu <?php echo (segment(2) == "analytics" && segment(3) == "statistics") ? "active" : "" ;?>">
      Statistics<br>
      <small>All stats</small>
      <a href="<?= base_url();?>/backend/analytics/statistics" class="stretched-link"></a>
    </li>
    
    <li class="list-group-item openMenu <?php echo (segment(2) == "settings") ? "active" : "" ;?>" > 
      Settings<br>
      <small> All settings</small>
       <a href="<?= base_url();?>/backend/settings/index" class="stretched-link"></a> 
    </li>

       </ul>
    <br><br> 
  </div>