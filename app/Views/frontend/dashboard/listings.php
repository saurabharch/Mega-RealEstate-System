<?= $this->extend('common/layout') ?>
<?= $this->section('content') ?>
<?= $this->include('common/header') ?>



<main role="main"> 
  <div class="album py-5 bg-light">
         
          <div class="container<?= \Config\Services::session()->get('fluid') ? '-fluid' : '';?>"> 
          
            <h1 class="display-4" style="font-size: 30px"> 
            Welcome <?php echo ucfirst(\Config\Services::session()->get('role'));?>
            <?php if(\Config\Services::session()->get('fluid')){ ?>
                <a href="<?= base_url();?>/dashboard/removeFluid" class="text-decoration-none text-dark float-right">
                  <i class="fas fa-compress-arrows-alt" style="font-size: 15px"></i>
                </a>
            <?php }else{ ?>
                <a href="<?= base_url();?>/dashboard/applyFluid" class="text-decoration-none text-dark float-right">
                  <i class="fas fa-expand-arrows-alt" style="font-size: 15px"></i>
                </a> 
            <?php } ?>  
            </h1>


            <div class="card"> 
                <div class="card-header">
                  <?= $this->include('frontend/dashboard/tabs') ?>   
                </div>
              <div class="card-body">
                <h1 class="display-4">
                My Listings 
                 <a href="<?= base_url();?>/add-property" target="__blank" class="btn btn-danger btn-sm float-right"><i class="fas fa-plus"></i> Add Property</a> 
              </h1> 
                
                
                <div class="table-responsive">
                 <table class="table table-hover small">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">PROPERTY</th>
                          <th scope="col"></th>
                          <th scope="col">LEADS</th>
                          <th scope="col">STATS</th>
                          <th scope="col">POSTED ON</th>
                          <th scope="col">STATUS</th>
                          <th scope="col">ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($listings)) : ?>
                        <?php $i = 1;foreach($listings as $property) : ?>
                        <tr>
                          <th scope="row"><?= $i;?></th>
                          <td style="width: 200px">  
                              
                              <?php if(is_array($property['images'])){ ?>
                                   
                                   <?php foreach($property['images'] as $key => $img) : ?>
                                       <?php if($key == 1){ ?>
                                           <?php if(isImageExist($img['image_name'],'propertyThumbnails') == true){ ?>
                                               <img src="<?= publicFolder().'/property-images/thumbnails/'.$img['image_name'];?>" class="rounded imgp" />
                                           <?php }else{ ?> 
                                               <img src="<?= publicFolder().'/images/empty-image-3.png';?>" class="d-block w-100 imgp" alt="..."> 
                                           <?php } ?> 
                                          
                                       <?php } ?> 
                                   <?php endforeach ?>

                              <?php }else{ ?>
                                  <img src="<?= publicFolder().'/images/empty-image-3.png';?>" class="d-block w-100 imgp" alt="...">
                              <?php } ?>
                               
                              

                               <?php if($property['has_ads'] == "1") : ?>
                                  <label class="badge badge-warning" style="position: absolute;margin:10px 0 0 -70px">Featured</label> 
                               <?php endif ?>
                               <?php if($property['has_ads'] == "2") : ?>
                                  <label class="badge badge-warning" style="position: absolute;margin:10px 0 0 -70px">Sponsored</label> 
                               <?php endif ?>  
                                     
                           </td>
                           <td>   
                             <h5><?= $property['title'];?></h5>
                             <h6> 
                                <?php if($property['bhk_type']) : ?>
                                <label class="badge badge-dark"><?= strtoupper($property['bhk_type']);?></label>
                                <?php endif ?> 
                                <?php if($property['status_type']) : ?>
                                <label class="badge badge-dark"><?= str_replace('_',' ',strtoupper($property['status_type']));?></label>
                                <?php endif ?> 
                                <?php if($property['condition_type']) : ?>
                                <label class="badge badge-dark"><?= strtoupper($property['condition_type']);?></label>
                                 <?php endif ?> 
                                 <?php if($property['facing']) : ?>
                                  <label class="badge badge-dark"><?= strtoupper($property['facing']);?></label>
                                 <?php endif ?> 
                                 <?php if($property['complex_type']) : ?> 
                                  <label class="badge badge-dark"><?= strtoupper($property['complex_type']);?></label>
                                 <?php endif ?>    
                              </h6>       
                                         
                              <?php if($property['listing_type'] =="sell") : ?> 
                                  <h3>Listed Price - <?= number_to_currency($property['total_price'], 'INR');?></h3>
                              <?php endif ?>  

                              <?php if($property['listing_type'] =="rent") : ?>
                                   <h3><?= number_to_currency($property['rent_per_mon'], 'INR') . ' - Monthly';?></h3>
                              <?php endif ?> 
                               
                              <label class="badge badge-success">Available for <?= ucfirst($property['listing_type']);?></label> 
                                  
                        
                          </td>
                          <td>
                            <p>45 till now . 5 hot</p>
                            <a href="">
                            <img src="<?= publicFolder();?>/images/default.jpg" alt="..." class="rounded-circle " width="53" height="53" style="margin-left: -25px;border:3px solid #fff">
                            <img src="<?= publicFolder();?>/images/default.jpg" alt="..." class="rounded-circle " width="53" height="53" style="margin-left: -25px;border:3px solid #fff">
                            <img src="<?= publicFolder();?>/images/default.jpg" alt="..." class="rounded-circle" width="53" height="53" style="margin-left: -25px;border:3px solid #fff">
                            <img src="<?= publicFolder();?>/images/default.jpg" alt="..." class="rounded-circle" width="53" height="53" style="margin-left: -25px;border:3px solid #fff">
                            <svg style="margin-left: -25px;border:3px solid #fff" class="bd-placeholder-img rounded-circle text-sm" width="53" height="53" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Completely round image: 75x75"><title>Completely round image</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">56+</text></svg>
                            </a>
                          </td>
                          <td><b>345+<span class="text-success">06</span></b><br>Total Views</td>
                          <td><?= date('D, d M Y', strtotime($property['created_at']));?><br><?= time_stamp(strtotime($property['created_at']));?></td>
                          <td>
                            <h5>
                              <span class="badge badge-success">Active</span>
                              <?= $property['status'];?>
                            </h5>
                          </td>
                          <td>
                            <img src="<?= publicFolder();?>/images/edit.png" data-toggle="tooltip" data-placement="bottom" title="Edit this property"><br> <br>
                            <img src="<?= publicFolder();?>/images/delete.png" data-toggle="tooltip" data-placement="bottom" title="Delete this property" width="28px">
                          </td>
                        </tr>
                        <?php $i++;endforeach ?> 
                        <?php endif ?>
                    
                      </tbody>
                </table>
               </div>

              </div>
              <div class="card-footer">
                  <nav aria-label="Page navigation text-center">
                    <ul class="pagination">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
              </div>
            </div>
     
    </div>
  </div>   
</main> 



<?= $this->include('common/footer') ?>
<?= $this->endSection() ?>