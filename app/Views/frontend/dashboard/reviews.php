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
              <div class="card-header"><?= $this->include('frontend/dashboard/tabs') ?></div>
              <div class="card-body">
                
               
                   <h4 class="col-md-12">Ratings & Reviews</h4> 
                   <br><br>
                   <ul class="list-unstyled">
                      <?php foreach($getAllReviews as $review){ ?> 
                      <li class="media">
                        <img src="<?= publicFolder();?>/user-images/thumbnails/<?= $review['profile_pic'];?>" width="60" class="mr-3" alt="..."> 
                        <div class="media-body">
                          <h5 class="mt-0 mb-1">
                             <?= $review['title'];?> 
              
                          </h5>
                          <small class="form-text text-muted"><?= date('D, d M Y', strtotime($review['created_at']));?> - <?= $review['firstname'];?></small>
                          <div class="row">
                            <div class="col-md-2">Local knowledge: </div>
                            <div class="col-md-4"><?php ratingCalculator($review['local_knowledge']);?></div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">Process expertise: </div>
                            <div class="col-md-4"><?php ratingCalculator($review['process_expertise']);?></div>
                          </div>
                         <div class="row">
                            <div class="col-md-2">Responsiveness: </div>
                            <div class="col-md-4"><?php ratingCalculator($review['responsiveness']);?></div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">Negotiation skills: </div>
                            <div class="col-md-4"><?php ratingCalculator($review['negotiation_skills']);?></div>
                          </div>
                          
                          <br>
                          <?= $review['comment'];?>
                        </div>
                      </li>
                      <?php } ?>
                    </ul>
                  

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