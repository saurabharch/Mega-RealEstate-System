<?= $this->extend('backend/common/layout') ?> 
<?= $this->section('content') ?>   
<style type="text/css">
  .cancelBadge{
    margin: 5px 5px 0 -30px;
    position: absolute;
  } 
</style>

<div class="container-fluid">
<br>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url();?>/backend/dashboard/index">Home</a></li> 
        <li class="breadcrumb-item"><a href="<?= base_url().'/backend/'.segment(2);?>/index"><?= ucfirst(segment(2));?></a></li> 
      </ol>
    </nav>
    <br>  

   <div class="row"> 
    <?= $this->include('backend/common/sidebar');?> 
    <div class="col-md-9">


        <?php if(@$section == "editProperty") { ?>
           <h3>Edit Property</h3> 
           <?= \Config\Services::session()->getFlashdata('alert');?>
           <div class="table">
           
           <table class="table small">
              <tbody>
                <tr>
                    <th scope="row">Pictures</th>
                    <td>  
                      <?php
                        if(is_array($propertyDetail['images']))
                        {    
                            foreach($propertyDetail['images'] as $tg)
                            { 
                               $tgd[] = $tg['image_name'];
                            }   
                            $implode =  json_encode($tgd,true);
                       
                        foreach($propertyDetail['images'] as $img) : ?> 
                        <a href="javascript:void(0)" class="text-decoration-none " id="removeImage<?= $img['id'];?>" >  
                          <img src="<?= publicFolder() .'/property-images/thumbnails/'.$img['image_name'];?>" class="rounded imagesS" data-images='<?= $implode;?>' style="width:200px;height:150px"/> 
                          <img src="<?= publicFolder() .'/images/cancel-1.png';?>" class="cancelBadge removeImage" data-image-id="<?= $img['id'];?>" data-image-file="<?= $img['image_name'];?>" style="width:25px;" data-toggle="tooltip" data-placement="bottom" title="Delete this image"/>
                        </a> 
                      <?php endforeach ?>
                      <?php }else{ ?>
                       No IMAGE
                      <?php } ?>     
                    </td>
                 </tr> 
                  <tr>
                    <th scope="row">Add Images</th>   
                    <td>
                      <?= form_open('/backend/properties/edit/'.segment(4),'enctype="multipart/form-data"');?> 
                       <input type="file" name="images[]" class="form-control form-control-sm float-left" placeholder="Add Pictures..." style="width:300px;height: 37px;" /> 
                       <input type="submit" name="submitImageBtn" class="btn btn-danger btn-sm float-left" value="Add Image" style="margin:3px" />
                      <?= form_close();?> 
                    </td>
                 </tr>

               <?= form_open('/backend/properties/edit/'.segment(4));?>  
               <?php if(in_array('title',$propertyTypeMap)) : ?> 
                 <tr>
                    <th scope="row">Title</th>
                    <td><input type="text" name="title" class="form-control" placeholder="Title" value="<?= $propertyDetail['title'];?>" /></td>
                 </tr>
               <?php endif ?>  

                <?php if(in_array('description',$propertyTypeMap)) : ?> 
                  <tr>
                    <th scope="row">Description</th>
                    <td><textarea type="text" name="description" class="form-control" placeholder="Description"><?= $propertyDetail['description'];?></textarea></td>
                 </tr>
                 <?php endif ?> 
                 
                 <?php if(in_array('about',$propertyTypeMap)) : ?> 
                 <tr>
                    <th scope="row">About</th>
                    <td><textarea type="text" name="about" class="form-control" placeholder="About"><?= $propertyDetail['about'];?></textarea></td>
                 </tr>
                 <?php endif ?>

                 <?php if(in_array('specification',$propertyTypeMap)) : ?> 
                 <tr>
                    <th scope="row">Specification</th>
                    <td><textarea type="text" name="specification" class="form-control" placeholder="Specification"/><?= $propertyDetail['specification'];?></textarea></td>
                 </tr>
                 <?php endif ?>
                 
                 <tr>
                    <th scope="row">Choose Options</th>
                    <td >
                       <table class="table-borderless">
                          <tr>
                            <?php if(in_array('listing_type',$propertyTypeMap)) : ?>
                            <td>
                               <b style="line-height:31px;">Listing Type &nbsp;&nbsp;</b>
                               <select name="listing_type" class="form-control form-control-sm" style="width: 180px">
                                 <option value="sell" <?= ($propertyDetail['listing_type'] == 'sell') ? "selected":"";?>>Sell</option>
                                 <option value="rent" <?= ($propertyDetail['listing_type'] == 'rent') ? "selected":"";?>>Rent</option>
                               </select>  
                            </td>
                             <?php endif ?>
                             <?php if(in_array('property_type',$propertyTypeMap)) : ?>
                            <td>
                               <b style="line-height:31px;">Property Type &nbsp;</b> 
                               <select name="property_type" class="form-control form-control-sm" style="width: 180px" required > 
                                      <option selected="true" disabled="disabled" value="">Select property type</option>
                                     <?php foreach ($property_type as $ptype) : ?>
                                      <option value="<?= $ptype['id'];?>" <?= ($propertyDetail['property_type'] == $ptype['id']) ? "selected":"";?>> 
                                            <?= $ptype['type_name'];?>    
                                      </option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            <?php endif ?> 
                            <?php if(in_array('complex_type',$propertyTypeMap)) : ?>
                            <td>
                               <b style="line-height:31px;">Complex Type &nbsp;&nbsp;</b>
                               <select class="form-control form-control-sm" name="complex_type" style="width: 180px">
                                 <option value="gated" <?= ($propertyDetail['property_type'] == "gated") ? "selected":"";?>>Gated</option>
                                 <option value="standalone" <?= ($propertyDetail['property_type'] == "standalone") ? "selected":"";?>>Standalone</option>
                               </select> 
                            </td>
                             <?php endif ?>
                              <?php if(in_array('bhk_type',$propertyTypeMap)) : ?>
                            <td>
                               <b style="line-height:31px;">BHK Type &nbsp;&nbsp;</b>
                               <select class="form-control form-control-sm" style="width: 180px" name="bhk_type" id="bhk_type" required>
                                  <option selected="true" disabled="disabled" value="">Select BHK</option>
                                  <option value="studio" <?= ($propertyDetail['bhk_type'] == 'studio') ? "selected":"";?>>Studio</option>
                                  <option value="1bhk" <?= ($propertyDetail['bhk_type'] == '1bhk') ? "selected":"";?>>1 BHK</option>    
                                  <option value="2bhk" <?= ($propertyDetail['bhk_type'] == '2bhk') ? "selected":"";?>>2 BHK</option>  
                                  <option value="3bhk" <?= ($propertyDetail['bhk_type'] == '3bhk') ? "selected":"";?>>3 BHK</option>   
                                  <option value="4bhk" <?= ($propertyDetail['bhk_type'] == '4bhk') ? "selected":"";?>>4 BHK</option>  
                                  <option value="+5bhk" <?= ($propertyDetail['bhk_type'] == '+5bhk') ? "selected":"";?>>5+ BHK</option>    
                               </select> 
                            </td>
                             <?php endif ?>
                              <?php if(in_array('status_type',$propertyTypeMap)) : ?>
                            <td>
                               <b style="line-height:31px;">Status Type &nbsp;&nbsp;</b>
                               <select class="form-control form-control-sm" name="status_type" style="width: 180px">
                                 <option value="ready_to_occupy" <?= ($propertyDetail['status_type'] == "ready_to_occupy") ? "selected":"";?>>Ready to Occupy</option>
                                 <option value="under_construction" <?= ($propertyDetail['status_type'] == "under_construction") ? "selected":"";?>>Under Construction</option> 
                               </select> 
                            </td>
                             <?php endif ?>
                          </tr>
                          

                           <tr> 
                             <?php if(in_array('city',$propertyTypeMap)) : ?> 
                              <td>
                                <b style="line-height:31px;">City &nbsp;&nbsp;</b>
                                  <select class="form-control form-control-sm" style="width: 180px" name="city" id="city" required="">
                                     <?php foreach($cities as $cy) : ?> 
                                     <option value="<?= $cy['id'];?>" <?= ($cy['id']==$propertyDetail['city']) ? "selected" : "" ;?>><?= $cy['city_name'];?></option>
                                   <?php endforeach ?> 
                                 </select> 
                              </td>
                             <?php endif ?>
                             
                              <?php if(in_array('condition_type',$propertyTypeMap)) : ?>  
                              <td>
                                 <b style="line-height:31px;">Condition Type &nbsp;&nbsp;</b>
                                  <select class="form-control form-control-sm" style="width: 180px" name="condition_type" id="condition_type">
                                     <option value="new" <?= ($propertyDetail['condition_type'] == "new") ? "selected":"";?>>New</option>
                                     <option value="resale" <?= ($propertyDetail['condition_type'] == "resale") ? "selected":"";?>>Resale</option>   
                                 </select> 
                              </td> 
                             <?php endif ?>

                            <?php if(in_array('facing',$propertyTypeMap)) : ?>
                            <td>
                               <b style="line-height:31px;">Direction Facing &nbsp;&nbsp;</b>
                               <select class="form-control form-control-sm" style="width: 180px" name="facing" id="facing">
                                 <option value="north" <?= ($propertyDetail['facing'] == "north") ? "selected":"";?>>North</option>
                                 <option value="south" <?= ($propertyDetail['facing'] == "south") ? "selected":"";?>>South</option>
                                 <option value="east" <?= ($propertyDetail['facing'] == "east") ? "selected":"";?>>East</option>
                                 <option value="west" <?= ($propertyDetail['facing'] == "west") ? "selected":"";?>>West</option> 
                               </select> 
                            </td>
                             <?php endif ?>
                          </tr>
                       </table>
                      
                    </td>
                 </tr> 

                <?php if(in_array('specification',$propertyTypeMap)) : ?> 
                 <tr>
                    <th scope="row">Specification</th>
                    <td><textarea type="text" name="specification" class="form-control" placeholder="Specification"><?= $propertyDetail['specification'];?></textarea></td>
                 </tr>
                 <?php endif ?>

                
                 <tr>
                    <th scope="row">Measurements</th>
                    <td>
                    <div class="row">
                            <div class="col-md-2">
                                <?php if(in_array('scale',$propertyTypeMap)) : ?> 
                                     <b style="line-height:31px;">Scale &nbsp;&nbsp;</b>
                                       <select class="form-control form-control-sm" style="width: 180px" name="scale" id="scale">
                                          <option value="sft" <?= ($propertyDetail['scale'] == "sft") ? "selected":"";?>>sft</option>
                                          <option value="sq-yards" <?= ($propertyDetail['scale'] == "sq-yards") ? "selected":"";?>>sq yards</option>
                                          <option value="sq-meteres" <?= ($propertyDetail['scale'] == "sq-meteres") ? "selected":"";?>>sq meteres</option>
                                          <option value="acres" <?= ($propertyDetail['scale'] == "acres") ? "selected":"";?>>acres</option>
                                       </select> 
                                 <?php endif ?>
                            </div>
                             <div class="col-md-2">
                         
                                  <?php if(in_array('builtup_area',$propertyTypeMap)) : ?> 
                                     <b style="line-height:31px;">Builtup Area (in <?= $propertyDetail['scale'];?>)&nbsp;&nbsp;</b>
                                    <input type="text" class="form-control form-control-sm" name="builtup_area" value="<?= $propertyDetail['builtup_area'];?>" placeholder="Builtup Area" style="width: 180px" required >
                                 <?php endif ?>  
                             </div> 
                             <div class="col-md-2">
                                 <?php if(in_array('project_total_area',$propertyTypeMap)) : ?>         
                                        <b style="line-height:31px;">Project Total Area (in <?= $propertyDetail['scale'];?>)</b> 
                                        <input type="text" class="form-control form-control-sm" value="<?= $propertyDetail['project_total_area'];?>" placeholder="Project Total Area" name="project_total_area" style="width: 180px" required />
                                 <?php endif ?>
                          </div> 
                          <div class="col-md-2">
                                 <?php if(in_array('floor',$propertyTypeMap)) : ?>         
                                        <b style="line-height:31px;">Floor</b> 
                                        <input type="text" class="form-control form-control-sm" value="<?= $propertyDetail['floor'];?>" placeholder="Floor" name="floor" style="width: 180px" required />
                                 <?php endif ?>
                          </div>   
                    </div>  
                    </td>
                 </tr>

                  <tr>
                    <th scope="row">Pricing</th>
                    <td>
                    <div class="row">
                            <div class="col-md-2">
                                <?php if(in_array('unit_price',$propertyTypeMap)) : ?> 
                                      <b style="line-height:31px;">Unit Price &nbsp;&nbsp;</b>
                                      <input type="text" class="form-control form-control-sm" name="unit_price" value="<?= $propertyDetail['unit_price'];?>" placeholder="Enter Unit Price" style="width: 180px" required />
                                 <?php endif ?>
                            </div>
                             <div class="col-md-2">
                         
                                  <?php if(in_array('renovation_cost',$propertyTypeMap)) : ?> 
                                     <b style="line-height:31px;">Renovation Cost &nbsp;&nbsp;</b> 
                                    <input type="text" class="form-control form-control-sm" name="renovation_cost" value="<?= $propertyDetail['renovation_cost'];?>" placeholder="Renovation Cost" style="width: 180px" required />
                                 <?php endif ?>  
                             </div> 
                             <div class="col-md-2">
                                 <?php if(in_array('old_total_price',$propertyTypeMap)) : ?>         
                                        <b style="line-height:31px;">Previous Sold Price</b> 
                                        <input type="text" class="form-control form-control-sm" name="old_total_price" value="<?= $propertyDetail['old_total_price'];?>" placeholder="Previous Sold Price" style="width: 180px" required />
                                 <?php endif ?>
                            </div> 
                            <div class="col-md-2">
                                 <?php if(in_array('total_price',$propertyTypeMap)) : ?>         
                                        <b style="line-height:31px;">Total Price</b> 
                                        <input type="text" class="form-control form-control-sm" name="total_price" value="<?= $propertyDetail['total_price'];?>" placeholder="Total Price" style="width: 180px" required />
                                 <?php endif ?>
                           </div>  
                           <div class="col-md-2">
                                 <?php if(in_array('rent_per_mon',$propertyTypeMap)) : ?>         
                                        <b style="line-height:31px;">Rent Per Month</b> 
                                        <input type="text" class="form-control form-control-sm" name="rent_per_month" value="<?= $propertyDetail['rent_per_mon'];?>" placeholder="Rent Price" style="width: 180px" required />
                                 <?php endif ?>
                           </div>      
                    </div>  
                    </td>
                 </tr>

                 <tr>
                    <th scope="row">Project Name</th>
                    <td>
                       <?php if(in_array('project_name',$propertyTypeMap)) : ?> 
                            <input type="text" class="form-control form-control-sm" name="project_name" value="<?= $propertyDetail['project_name'];?>" placeholder="Project Name" required />
                       <?php endif ?>                          
                    </td>
                 </tr>

                 <tr>
                    <th scope="row">Date</th>
                    <td>
                       <div class="row">
                            <div class="col-md-2">
                               <?php if(in_array('launch_date',$propertyTypeMap)) : ?> 
                                    <b style="line-height:31px;">Launch Date</b> 
                                    <input type="text" class="form-control form-control-sm" name="launch_date" value="<?= $propertyDetail['launch_date'];?>" placeholder="Launch Date" required />
                               <?php endif ?> 
                            </div>
                             <div class="col-md-2">
                                 <?php if(in_array('posession_date',$propertyTypeMap)) : ?> 
                                      <b style="line-height:31px;">Posession Date</b> 
                                      <input type="text" class="form-control form-control-sm" value="<?= $propertyDetail['posession_date'];?>" name="posession_date" placeholder="Posession Date" required />
                                 <?php endif ?>  
                             </div> 
                             <div class="col-md-2">
                                 <?php if(in_array('created_at',$propertyTypeMap)) : ?>         
                                        <b style="line-height:31px;">Created At</b> 
                                        <input type="text" class="form-control form-control-sm" value="<?= $propertyDetail['created_at'];?>" name="created_at" placeholder="Created At" style="width: 180px" required />
                                 <?php endif ?>
                            </div> 
                            <div class="col-md-2">
                                 <?php if(in_array('updated_at',$propertyTypeMap)) : ?>         
                                        <b style="line-height:31px;">Updated At</b> 
                                        <input type="text" class="form-control form-control-sm" value="<?= $propertyDetail['updated_at'];?>" name="updated_at" placeholder="Updated At" style="width: 180px" required />
                                 <?php endif ?>
                           </div>     
                     </div>                         
                    </td> 
                 </tr>

                  <tr>
                    <th scope="row">More Detail</th>
                    <td>
                       <div class="row">
                            <div class="col-md-2">
                               <?php if(in_array('rera_id',$propertyTypeMap)) : ?> 
                                    <b style="line-height:31px;">RERA ID</b> 
                                    <input type="text" class="form-control form-control-sm" value="<?= $propertyDetail['rera_id'];?>" name="rera_id" placeholder="RERA ID" />
                               <?php endif ?> 
                            </div>
                             <div class="col-md-2">
                                 <?php if(in_array('approving_authority',$propertyTypeMap)) : ?> 
                                      <b style="line-height:31px;">Approving Authority</b> 
                                      <input type="text" class="form-control form-control-sm" value="<?= $propertyDetail['approving_authority'];?>" name="approving_authority" placeholder="Approving Authority"  />
                                 <?php endif ?>  
                             </div> 
                             <div class="col-md-2">
                                 <?php if(in_array('has_ads',$propertyTypeMap)) : ?>         
                                        <b style="line-height:31px;">Has Ads</b>  
                                        <select class="form-control form-control-sm" name="has_ads"> 
                                          <option value="1" <?= ($propertyDetail['has_ads'] == 1) ? "selected" : "";?> class="bg-warning">Make it Featured</option>
                                          <option value="2" <?= ($propertyDetail['has_ads'] == 2) ? "selected" : "";?> class="bg-info">Sponsored Ad</option> 
                                        </select>
                                 <?php endif ?>
                            </div>
                            <div class="col-md-2">
                                 <?php if(in_array('public_or_private',$propertyTypeMap)) : ?>         
                                        <b style="line-height:31px;">Public or Private</b>  
                                        <select class="form-control form-control-sm" name="public_or_private"> 
                                          <option value="private" <?= ($propertyDetail['public_or_private'] == 'private') ? "selected" : "";?> class="bg-danger">Private</option>
                                          <option value="public" <?= ($propertyDetail['public_or_private'] == 'public') ? "selected" : "";?> class="bg-success">Public</option> 
                                        </select>
                                 <?php endif ?> 
                            </div>  
                               
                     </div>                         
                    </td>
                 </tr> 

                 <?php if(in_array('status',$propertyTypeMap)) : ?>    
                 <tr> 
                    <th scope="row">Status</th>
                    <td> 
                               
                      <select name="status" class="form-control form-control-sm">
                        <?php foreach(statusList() as $status) : ?>
                           <option value="<?= $status['id'];?>"> 
                              <?= $status['status_name'];?>
                            </option> 
                        <?php endforeach ?> 
                      </select>
                               
                    </td>
                 </tr> 
                 <?php endif ?> 

                 <tr> 
                    <th scope="row"></th>
                    <td>
                       <input type="submit" name="editPropertyDetail" class="btn btn-outline-danger btn-block" value="Update Detail" />           
                    </td>
                 </tr>


             <?= form_close();?> 
             

           </tbody> 
           </table>
           
           </div>

        <?php }elseif(@$section == "viewProperty"){ ?>  



          <div class="container">
        <h3 class="display-4" style="font-size: 30px"> 
          <a href="<?= base_url().'/';?>"><img src="<?= publicFolder();?>/images/back.png" width="50"/></a> 
          Back | Details of Property
        </h3>
       <hr>  
       <?= \Config\Services::session()->getFlashdata('alert');?>    
       <?php if(is_array($propertyDetail)) : ?>
      
       
       <div class="row">
            <?php if($propertyDetail['listing_type'] == "sell") : ?>
                
                     <div class="col-8"><h4><?= displayPrice($propertyDetail['total_price']);?> | <?= $propertyDetail['title'];?></h4></div>

               
           <?php endif ?>
           <?php if($propertyDetail['listing_type'] == "rent") : ?>
                
                     <div class="col-8"><h4><?= displayPrice($propertyDetail['rent_per_mon']);?> | <?= $propertyDetail['title'];?></h4></div>
               
           <?php endif ?>  
                  


       </div>
       <div class="row"> 
          <div id="carouselExampleFade" class="shadow carousel slide carousel-fade" data-ride="carousel">
          <div class="carousel-inner">
            
              <?php foreach($propertyDetail['images'] as $key => $img) : ?>
                <?php $active = ($key == 1) ? "active": "" ;?> 
                <div class="carousel-item <?= $active;?>"> 
                    <img src="<?= base_url().'/property-images/'.$img['image_name'];?>" class="d-block w-100 img-lg" /> 
                </div>
                <?php endforeach ?>
           
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
        

        <hr> 

        <div class="row">
                <div class="col-md-8"><h3>Property Overview</h3></div>
                <div class="col-md-4">
                    <?php if($propertyDetail['listing_type'] == "sell") : ?>
                        <div class="col-8"><h4><?= displayPrice($propertyDetail['total_price']);?></h4></div>
                     <?php endif ?>
                     <?php if($propertyDetail['listing_type'] == "rent") : ?>
                        <div class="col-8"><h4><?= displayPrice($propertyDetail['rent_per_mon']);?> / Month</h4></div>                         
                     <?php endif ?>
                </div>
        </div>

        <br>


         <div class="row">
             <?php if($propertyDetail['listing_type'] == "sell") : ?>
                
                <div class="col-md-12">
                    <?php if($propertyDetail['bhk_type']) : ?>
                      <div class="d-inline p-2 bg-danger text-white"><?= ucfirst($propertyDetail['bhk_type']);?></div>
                  <?php endif ?>
                   <?php if($propertyDetail['status_type']) : ?>
                      <div class="d-inline p-2 bg-danger text-white"><?= str_replace('_',' ',strtoupper($propertyDetail['status_type']));?></div>
                  <?php endif ?>  
                   <?php if($propertyDetail['condition_type']) : ?>
                      <div class="d-inline p-2 bg-danger text-white"><?= strtoupper($propertyDetail['condition_type']);?></div>
                   <?php endif ?>
                   <?php if($propertyDetail['facing']) : ?>
                      <div class="d-inline p-2 bg-danger text-white"><?= strtoupper($propertyDetail['facing']);?></div>
                   <?php endif ?>
                   <?php if($propertyDetail['complex_type']) : ?>
                      <div class="d-inline p-2 bg-danger text-white"><?= strtoupper($propertyDetail['complex_type']);?></div>
                   <?php endif ?>
                </div>
               
           <?php endif ?>

           <?php if($propertyDetail['listing_type'] == "rent") : ?>
                
                <div class="col-md-12">
                
                  <?php if($propertyDetail['bhk_type']) : ?>
                      <div class="shadow d-inline p-2 bg-danger text-white"><?= strtoupper($propertyDetail['bhk_type']);?></div>
                  <?php endif ?>
                   <?php if($propertyDetail['status_type']) : ?>
                      <div class="shadow d-inline p-2 bg-danger text-white"><?= str_replace('_',' ',strtoupper($propertyDetail['status_type']));?></div>
                  <?php endif ?>  
                   <?php if($propertyDetail['condition_type']) : ?>
                      <div class="shadow d-inline p-2 bg-danger text-white"><?= strtoupper($propertyDetail['condition_type']);?></div>
                   <?php endif ?>
                   <?php if($propertyDetail['facing']) : ?>
                      <div class="shadow d-inline p-2 bg-danger text-white"><?= strtoupper($propertyDetail['facing']);?></div>
                   <?php endif ?>
                   <?php if($propertyDetail['complex_type']) : ?>
                      <div class="shadow d-inline p-2 bg-danger text-white"><?= strtoupper($propertyDetail['complex_type']);?></div>
                   <?php endif ?>
                      
                </div>
               
           <?php endif ?>
             
         </div>



         <br>

         

         <div class="row">
            <div class="col-md-12">
              <h3>Description</h3> 
              <div class="text-break font-weight-normal"><?php echo $propertyDetail['description'];?></div>
            </div>
         </div>


         <div class="row">
              <div class="col-md-8">
                <h3>Amenities</h3>
                     <?php foreach($propertyDetail['amenitiesName'] as $am) : ?>
                           <div class="shadow d-inline p-2 bg-danger text-white"><?= $am['name'];?></div>
                     <?php endforeach ?> 
              </div>
               <div class="col-6 col-md-4">
                  Posted On : <?php echo $propertyDetail['created_at'];?>
               </div>
              
         </div>
        
         <br>
         <hr>

         <div class="row">
            <div class="col-md-12">
                <h3>Contact</h3>
                  <div class="shadow media position-relative">
                    <img src="http://localhost:8080/user-images/agent-1.jpeg" class="mr-3" alt="..." width="200">
                    <div class="media-body"><br>
                      <h5 class="mt-0"><?php echo ucfirst($propertyDetail['contact']['firstname']) . ' ' . ucfirst($propertyDetail['contact']['lastname']);?></h5>
                      <?php if($propertyDetail['contact']['is_verified'] == 1) : ?>
                      <b class="mt-0">Verified <?php echo ucfirst($propertyDetail['contact']['role']);?>
                         <img src="<?= publicFolder();?>/images/verified-blue.png" class="mr-3" alt="..." width="25">
                      </b>
                    <?php endif ?>
                    
                    <?php if($propertyDetail['contact']['role'] != "customer") : ?>
                      <h5>
                        Rating <img src="<?= publicFolder();?>/images/star.png" width="20">
                        <img src="<?= publicFolder();?>/images/star.png" width="20" >
                        <img src="<?= publicFolder();?>/images/star.png" width="20">
                        <img src="<?= publicFolder();?>/images/star.png" width="20">
                        <img src="<?= publicFolder();?>/images/star-empty.png" width="20">
                      </h5>
                    <?php endif ?>
                    
                    <?php if($propertyDetail['contact']['user_id'] != cUserId()) : ?>
                      <a href="javascript:void(0)" class="btn btn-danger">
                         <img src="<?= publicFolder();?>/images/contact-phone2.png" class="mr-3" alt="..." width="25">
                         Contact <?php echo ucfirst($propertyDetail['contact']['role']);?> 
                      </a>
                  

                   <?php endif ?>

                      <br>
                      <?php if($propertyDetail['contact']['role'] != "customer") : ?>
                        <b>3 Reviews | 6 Recent Sales</b>
                      <?php endif ?>
                    </div>
                  </div>
              </div>
          
         </div>
     <?php endif ?>
    </div>
          


        
      


        <?php }else{ ?>

        <h3 class="display-4">Properties</h3>
        <div class="table-responsive">
          <table class="table small">
              <caption>List of properties</caption>
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Images</th>
                  <th scope="col">Property Type</th>
                  <th scope="col">Listing Type</th>
                  <th scope="col">User</th>
                  <th scope="col">Created</th>
                  <th scope="col">Updated</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(is_array($properties)) : ?>
                <?php $i=1;foreach($properties as $r) : ?>
                <tr>
                  <th scope="row"><?= $i;?></th>
                  <td>
                     <a href="<?= base_url();?>/backend/properties/view/<?= $r['id'];?>" class="text-decoration-none text-dark">
                         <?= ucfirst($r['title']);?> 
                     </a>
                  </td>
                  <td>
                       <?php  
                       if(is_array($r['images']))
                       {
                            foreach($r['images'] as $tg)
                            { 
                               $tgd[] = $tg['image_name'];
                            }  
                            $implode =  json_encode($tgd,true);
                       ?>
                       <a href="javascript:void(0)" class="imagesS" data-images='<?= $implode;?>'>  
                          <?php foreach($r['images'] as $key => $img) : ?>
                             <?php if($key < 3) : ?>
                             <img src="<?= publicFolder().'/property-images/thumbnails/'.$img['image_name'];?>" alt="..." class="rounded-circle" width="50" height="50" style="margin-left:-30px;border:2px solid #fff" />
                             <?php endif ?>
                          <?php endforeach ?>  
                       </a>
                       <?= (count($r['images']) > 0) ? "<label class='badge badge-success' style='margin-left:-30px'>".count($r['images'])." images</label>" : "<label class='badge badge-success' style='margin-left:-30px'>".count($r['images'])." image</label>";?>     
                       <?php }else{ ?>
                       
                         No IMAGES

                       <?php } ?>     
                      
                  </td>
                  <td><?= ucfirst($r['propertyType']['type_name']);?></td>
                  <td><?= ucfirst($r['listing_type']);?></td>
                  <td><?= ucfirst($r['contact']['firstname']." ".$r['contact']['lastname']);?></td>
                  <td><?= date('F j, Y',strtotime($r['created_at']));?></td>
                  <td><?= date('F j, Y',strtotime($r['updated_at']));?></td>
                  <td>
                      <label class="badge badge-<?= $r['statusName']['status_badge'];?>">
                        <?= ucfirst($r['statusName']['status_name']);?>
                      </label> 
                  </td>  
                  <td>
                    <a href="<?= base_url();?>/backend/properties/edit/<?= $r['id'];?>"><img src="<?= publicFolder();?>/images/edit.png"  width="20"/></a> |  
                    <a href="javascript:void(0)" data-confirmedUrl="<?= base_url();?>/backend/properties/delete/<?= $r['id'];?>" class="deletePop">
                      <img src="<?= publicFolder();?>/images/delete.png" width="20"/> 
                    </a> 
                  </td> 
                </tr>
               <?php $i++;unset($tgd);endforeach ?>
               <?php endif ?>
              </tbody>
          </table>
        </div>

        <?php } ?>   
        

    </div>
  </div> 





</div>

<div class="modal propertyImagesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner propertyImagesShow"></div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
          </div>
      </div>
    </div>
  </div>
</div>


<?= modalPopup("Confirmation","Do you want to delete this property ?");?> 

<?= $this->endSection() ?>