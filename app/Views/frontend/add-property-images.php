<?= $this->extend('common/layout') ?>

<?= $this->section('content') ?>

<link href="https://getbootstrap.com/docs/4.5/examples/album/album.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/4.5/assets/css/docs.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
  .star {
  position: relative;
  
  display: inline-block;
  width: 0;
  height: 0;
  
  margin-left: .9em;
  margin-right: .9em;
  margin-bottom: 1.2em;
  
  border-right:  .3em solid transparent;
  border-bottom: .7em  solid #FC0;
  border-left:   .3em solid transparent;

  /* Controlls the size of the stars. */
  font-size: 24px;
  
  &:before, &:after {
    content: '';
    
    display: block;
    width: 0;
    height: 0;
    
    position: absolute;
    top: .6em;
    left: -1em;
  
    border-right:  1em solid transparent;
    border-bottom: .7em  solid #FC0;
    border-left:   1em solid transparent;
  
    transform: rotate(-35deg);
  }
  
  &:after {  
    transform: rotate(35deg);
  }
}
.toast {
    position: absolute; 
    top: 0; 
    right: 0;
    margin: 6em;
    z-index: 99;
}

.toast .logo {
    height: 2em;
}
.imgp {
  width:200px;
  height:200px;
  object-fit:cover;
}
.imgpl {
  width:400px;
  height:700px;
  object-fit:cover;
}
</style>
<?= $this->include('common/header') ?> 

<main role="main"> 

  <div class="album py-5 bg-light">
   
    <div class="container">
        <h3 class="display-4">Add Photos <a href="<?= base_url();?>/my-listings" class="btn btn-outline-danger float-right"> All Property</a></h3>
       <hr>
       
       <?php if (session('msg')) : ?>
          <div class="alert alert-info alert-dismissible">
            <?= session('msg') ?>
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
          </div> 
       <?php endif ?>
        <?= \Config\Services::session()->getFlashdata('alert');?> 
        <div class="bd-callout bd-callout-danger">
          <div class="row">
            <div class="col-md-9">
              <form action="<?php echo base_url('add-property-images') .'/'. segment(2);?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
       
                <div class="form-group">
                  <label for="formGroupExampleInput">Select Photos</label>
                  <input type="file" name="images[]" multiple class="class="form-control form-control-lg" />  
                </div>  
       
                <div class="form-group">
                 <input type="submit" id="send_form" class="btn btn-outline-danger" name="add-images" value="Add Photos"/>
                </div>
                <small id="emailHelp" class="form-text text-muted">Upload images less than 10MB. Accepted image extensions jpg and png only!</small>
              </form>
            </div>
          </div> 
        </div>
       
           <?php if(is_array($propertyImages)) : ?>
           
             <hr>
             
             <div class="row" id="my-list">
                 <?php $i = 1;foreach($propertyImages as $img) : ?>
            
                <div class="card shadow " style="width:200px">
                  <img class="card-img-top imgp" src="<?php echo  base_url(). '/property-images/' . $img['image_name'];?>" alt="Card image cap" />
                  <a href="#" data-img="<?php echo  base_url(). '/property-images/' . $img['image_name'];?>" class="stretched-link propertyImgModalBtn2"></a>
                </div>

          
             <?php $i++;endforeach ?>

               <div class="card shadow text-center" style="width:200px">
                  <div class="card-body">
                    <a href="#" class="stretched-link" id="propertyImgModalBtn">See All</a>
                  </div>
                </div>
             </div>
            
         <?php endif ?>
        

    </div>
  </div>

</main>


<?php if(is_array($propertyImages)) : ?>

<div class="modal fade" id="propertyImgModalView">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-body">
               <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                  <?php $k = 1;foreach($propertyImages as $img2) : ?>
                  <div class="carousel-item <?php echo ($k==1) ? 'active':'';?>">
                    <img src="<?php echo base_url(). '/property-images/' . $img2['image_name'];?>" class="d-block w-100 imgpl" alt="...">
                  </div>
                  <?php $k++;endforeach ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
      </div>
    </div>
  </div>
</div>

<?php endif ?>

<div class="modal fade" id="propertyImgModalView2">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-body">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="" class="d-block w-100 imgpl propertyImgModalSrc" alt="...">
                </div>
              </div>
            </div>    
        </div>
    </div>
  </div>
</div>



<?= $this->include('common/footer') ?>



<?= $this->endSection() ?>