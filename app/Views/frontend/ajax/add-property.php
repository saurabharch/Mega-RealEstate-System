       <?php if(in_array($property_type_id,[1])) : ?>

            <div class="row">
                <div class="col-md-5 mb-3">
                   <label for="country">Complex Type </label>
                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="complex_type" id="complex_type" value="gated" checked> Gated
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="complex_type" id="complex_type" value="standalone"> Standalone
                      </label>
                    </div>
                </div>
               
               <div class="col-md-5 mb-3" id="div_bhk_type">   
                  <label for="country">BHKs</label>
                  <select class="custom-select d-block w-100" name="bhk_type" id="bhk_type" required >
                      <option selected="true" disabled="disabled" value="">Select BHK</option>
                      <option value="studio">Studio</option>
                      <option value="1bhk">1 BHK</option>   
                      <option value="2bhk">2 BHK</option>  
                      <option value="3bhk">3 BHK</option>  
                      <option value="4bhk">4 BHK</option>  
                      <option value="+5bhk">5+ BHK</option>            
                  </select>
                  <div class="invalid-feedback">
                    Please select BHK type.
                  </div>
                </div>
              </div>  

               <div class="row"> 
                <div class="col-md-5 mb-3">
                  <label for="country">City</label>
                  <select class="custom-select d-block w-100" name="city" id="city" required="">
                    <?php foreach($cities as $cy) : ?> 
                      <option value="<?= $cy['id'];?>" <?= ($cy['id']==$profile['city']) ? "selected" : "" ;?>><?= $cy['city_name'];?></option>
                    <?php endforeach ?> 
                  </select>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="country">Locality</label>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="All areas in" name="locality" required />
                  <div class="invalid-feedback">
                    Please select your locality. 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                   <label for="country">Status </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="status_type" id="status_type" value="ready_to_occupy" checked> Ready to Occupy
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="status_type" id="status_type" value="under_construction"> Under Construction
                      </label>
                    </div>
                </div>

                <?php if($listing_type == "sell") : ?>
                 <div class="col-md-3 mb-3">
                   <label for="country">Condition </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="condition_type" id="condition_type" value="new" checked> New
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="condition_type" id="condition_type" value="resale"> Resale
                      </label>
                    </div>
                </div>
                <?php endif ?>
                

              </div>

             

              <div class="row"> 
                <div class="col-md-5 mb-3">
                    <label for="country">Builtup Area</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" name="builtup_area" placeholder="Please input" required >
                      <div class="input-group-append">
                         <select class="custom-select d-block w-100" name="builtup_area_dm" id="builtup_area_dm" required >
                            <option value="sft" selected>sft</option>
                            <option value="sq-yards">sq yards</option>
                            <option value="sq-meteres">sq meteres</option>
                            <option value="acres">acres</option>
                        </select>
                      </div>
                      <div class="invalid-feedback">
                         Builtup Area required.
                      </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Project Name/Society</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_name" required />
                       <div class="invalid-feedback">
                         Project name required.
                       </div>
                    </div>
                    
                </div>
              </div>
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_unit_price">
                <div class="col-md-5 mb-3">
                    <label for="country">Unit Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" name="unit_price" placeholder="Please input" required />
                      <div class="input-group-append">
                         <button class="btn btn-outline-dark" id="unit_price_dm" type="button">sft</button>   
                      </div>
                       <div class="invalid-feedback">
                         Unit price required.
                       </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3 div_total_price"> 
                    <label for="country">Total Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="total_price" required />
                      <div class="invalid-feedback">
                         Total price required.
                       </div>
                    </div>
                </div>
              </div>
              <?php endif ?>

              <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="country">Floor</label>
                    <div class="input-group">
                      <input type="number" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="floor" required />
                      <div class="invalid-feedback">
                         No of floor required.
                      </div>
                    </div>
                </div>
                <?php if($listing_type == "sell") : ?>
                <div class="col-md-5 mb-3 div_project_total_area">
                    <label for="country">Project Total Area</label> 
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_total_area" required />
                      <div class="input-group-append">
                         <select class="custom-select d-block w-100" name="project_total_area_dm" id="project_total_area_dm" required="">
                            <option value="sft" selected>sft</option>
                            <option value="sq-yards">sq yards</option>
                            <option value="acres">acres</option>
                            <option value="sq-meteres">sq meteres</option> 
                        </select>
                      </div>
                      <div class="invalid-feedback">
                         Project Total Area required.
                       </div>
                    </div>
                </div>
                <?php endif ?>
              </div>
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_launch_date">
                <div class="col-md-5 mb-3">
                    <label for="country">Launch Date</label>
                    <div class="input-group">
                      <input type="date" class="form-control datePicker" aria-label="Text input with dropdown button" placeholder="Please input" name="launch_date" required />
                        <div class="invalid-feedback">
                         Launch Date required.
                       </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Posession Date</label>
                    <div class="input-group">
                      <input type="date" class="form-control datePicker" aria-label="Text input with dropdown button" placeholder="Please input" name="posession_date" required />
                      <div class="invalid-feedback">
                         Posession Date required.
                       </div>
                    </div>
                </div>
              </div>

               <div class="row div_rera_id">
                <div class="col-md-5 mb-3">
                    <label for="country">RERA ID (optional)</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rera_id" />
        
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Approving Authority(optional)</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="approving_authority">
                    </div>
                </div>
              </div>
                <?php endif ?>
                
                <?php if($listing_type == "rent") : ?>
                <div class="row div_rentpermonth">
                <div class="col-md-5 mb-3">
                    <label for="country">Rent Per Month</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rent_per_mon" required />
                      <div class="invalid-feedback">
                         Rent Per Month required!
                       </div>
                    </div>
                </div>
              </div>
              <?php endif ?>


       <?php endif ?>  




        <?php if(in_array($property_type_id,[2])) : ?>     
                  <div class="row">
                <div class="col-md-5 mb-3">
                   <label for="country">Complex Type </label>
                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="complex_type" id="complex_type" value="gated" checked> Gated
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="complex_type" id="complex_type" value="standalone"> Standalone
                      </label>
                    </div>
                </div>
               
               <div class="col-md-5 mb-3" id="div_bhk_type">   
                  <label for="country">BHKs</label>
                  <select class="custom-select d-block w-100" name="bhk_type" id="bhk_type" required="">
                      <option>Select BHK</option>
                      <option value="studio">Studio</option>
                      <option value="1bhk">1 BHK</option>   
                      <option value="2bhk">2 BHK</option>  
                      <option value="3bhk">3 BHK</option>  
                      <option value="4bhk">4 BHK</option>  
                      <option value="+5bhk">5+ BHK</option>     
                  </select>
                </div>
              </div>  

               <div class="row"> 
                <div class="col-md-5 mb-3">
                  <label for="country">City</label>
                  <select class="custom-select d-block w-100" name="city" id="city" required="">
                    <?php foreach($cities as $cy) : ?> 
                      <option value="<?= $cy['id'];?>" <?= ($cy['id']==$profile['city']) ? "selected" : "" ;?>><?= $cy['city_name'];?></option>
                    <?php endforeach ?> 
                  </select>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="country">Locality</label>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="All areas in" name="locality">
                  <div class="invalid-feedback">
                    Please select a valid country. 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                   <label for="country">Status </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="status_type" id="status_type" value="ready_to_occupy" checked> Ready to Occupy
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="status_type" id="status_type" value="under_construction"> Under Construction
                      </label>
                    </div>
                </div>

                <?php if($listing_type == "sell") : ?>
                 <div class="col-md-3 mb-3">
                   <label for="country">Condition </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="condition_type" id="condition_type" value="new" checked> New
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="condition_type" id="condition_type" value="resale"> Resale
                      </label>
                    </div>
                </div>
                <?php endif ?>
              </div>

              <div class="row"> 
                <div class="col-md-5 mb-3">
                    <label for="country">Builtup Area</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" name="builtup_area" placeholder="Please input">
                      <div class="input-group-append">
                         <select class="custom-select d-block w-100" name="builtup_area_dm" id="builtup_area_dm" required="">
                            <option value="sft" selected>sft</option>
                            <option value="sq-yards">sq yards</option>
                            <option value="sq-meteres">sq meteres</option>
                            <option value="acres">acres</option>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Project Name/Society</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_name">
                    </div>
                </div>
              </div>


              <div class="row"> 
                <div class="col-md-5 mb-3">
                    <label for="country">Configuration</label>
                    <div class="input-group">
                       <select class="custom-select d-block w-100" name="configuration" id="configuration" required="">
                            <option value="">Choose or Add Config</option> 
                            <option value="gf">Ground Floor</option>
                            <option value="g+1">G+1</option>
                            <option value="g+2">G+2</option>
                            <option value="g+3">G+3</option>
                            <option value="duplex">Duplex</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Plot size</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="plot_size">
                    </div>
                </div>
              </div>
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_unit_price">
                <div class="col-md-5 mb-3">
                    <label for="country">Unit Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" name="unit_price" placeholder="Please input">
                      <div class="input-group-append">
                         <button class="btn btn-outline-dark" id="unit_price_dm" type="button">sft</button>  
                      </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3 div_total_price"> 
                    <label for="country">Total Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="total_price">
                    </div>
                </div>
              </div>
              <?php endif ?>

              <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="country">Dimension</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Length" name="length">
                           <div class="input-group-append">
                              <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Breath" name="breath">
                          </div>
                    </div>
                    
                </div>
                <?php if($listing_type == "sell") : ?>
                <div class="col-md-5 mb-3 div_project_total_area">
                    <label for="country">Project Total Area</label> 
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_total_area">
                      <div class="input-group-append">
                         <select class="custom-select d-block w-100" name="project_total_area_dm" id="project_total_area_dm" required="">
                            <option value="sft" selected>sft</option>
                            <option value="sq-yards">sq yards</option>
                            <option value="acres">acres</option>
                            <option value="sq-meteres">sq meteres</option>
                        </select>
                      </div>
                    </div>
                </div>
                <?php endif ?>
              </div>
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_launch_date">
                <div class="col-md-5 mb-3">
                    <label for="country">Launch Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="launch_date">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Posession Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="posession_date">
                    </div>
                </div>
              </div>

               <div class="row div_rera_id">
                <div class="col-md-5 mb-3">
                    <label for="country">RERA ID</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rera_id">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Approving Authority</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="approving_authority">
                    </div>
                </div>
              </div>
                <?php endif ?>
                
                <?php if($listing_type == "rent") : ?>
                <div class="row div_rentpermonth">
                <div class="col-md-5 mb-3">
                    <label for="country">Rent Per Month</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rent_per_mon">
                    </div>
                </div>
              </div>
              <?php endif ?>

        <?php endif ?> 
       




       <?php if(in_array($property_type_id,[3])) : ?>     
                          <div class="row">
                <div class="col-md-5 mb-3">
                   <label for="country">Complex Type </label>
                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="complex_type" id="complex_type" value="gated" checked> Gated
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="complex_type" id="complex_type" value="standalone"> Standalone
                      </label>
                    </div>
                </div>
               
               <div class="col-md-5 mb-3" id="div_bhk_type">   
                  <label for="country">BHKs</label>
                  <select class="custom-select d-block w-100" name="bhk_type" id="bhk_type" required="">
                      <option>Select BHK</option>
                      <option value="studio">Studio</option>
                      <option value="1bhk">1 BHK</option>   
                      <option value="2bhk">2 BHK</option>  
                      <option value="3bhk">3 BHK</option>  
                      <option value="4bhk">4 BHK</option>  
                      <option value="+5bhk">5+ BHK</option>     
                  </select>
                </div>
              </div>  

               <div class="row"> 
                <div class="col-md-5 mb-3">
                  <label for="country">City</label>
                  <select class="custom-select d-block w-100" name="city" id="city" required="">
                    <?php foreach($cities as $cy) : ?> 
                      <option value="<?= $cy['id'];?>" <?= ($cy['id']==$profile['city']) ? "selected" : "" ;?>><?= $cy['city_name'];?></option>
                    <?php endforeach ?> 
                  </select>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="country">Locality</label>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="All areas in" name="locality">
                  <div class="invalid-feedback">
                    Please select a valid country. 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                   <label for="country">Status </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="status_type" id="status_type" value="ready_to_occupy" checked> Ready to Occupy
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="status_type" id="status_type" value="under_construction"> Under Construction
                      </label>
                    </div>
                </div>

                <?php if($listing_type == "sell") : ?>
                 <div class="col-md-3 mb-3">
                   <label for="country">Condition </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="condition_type" id="condition_type" value="new" checked> New
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="condition_type" id="condition_type" value="resale"> Resale
                      </label>
                    </div>
                </div>
                <?php endif ?>
              </div>

              <div class="row"> 
                <div class="col-md-5 mb-3">
                    <label for="country">Builtup Area</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" name="builtup_area" placeholder="Please input">
                      <div class="input-group-append">
                         <select class="custom-select d-block w-100" name="builtup_area_dm" id="builtup_area_dm" required="">
                            <option value="sft" selected>sft</option>
                            <option value="sq-yards">sq yards</option>
                            <option value="sq-meteres">sq meteres</option>
                            <option value="acres">acres</option>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Project Name/Society</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_name">
                    </div>
                </div>
              </div>


              <div class="row"> 
                <div class="col-md-5 mb-3">
                    <label for="country">Configuration</label>
                    <div class="input-group">
                       <select class="custom-select d-block w-100" name="configuration" id="configuration" required="">
                            <option value="">Choose or Add Config</option> 
                            <option value="gf">Ground Floor</option>
                            <option value="g+1">G+1</option>
                            <option value="g+2">G+2</option>
                            <option value="g+3">G+3</option>
                            <option value="duplex">Duplex</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Plot size</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="plot_size">
                    </div>
                </div>
              </div>
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_unit_price">
                <div class="col-md-5 mb-3">
                    <label for="country">Unit Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" name="unit_price" placeholder="Please input">
                      <div class="input-group-append">
                         <button class="btn btn-outline-dark" id="unit_price_dm" type="button">sqft</button>  
                      </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3 div_total_price"> 
                    <label for="country">Total Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="total_price">
                    </div>
                </div>
              </div>
              <?php endif ?>

              <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="country">Dimension</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Length" name="length">
                           <div class="input-group-append">
                              <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Breath" name="breath">
                          </div>
                    </div>
                    
                </div>
                <?php if($listing_type == "sell") : ?>
                <div class="col-md-5 mb-3 div_project_total_area">
                    <label for="country">Project Total Area</label> 
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_total_area">
                      <div class="input-group-append">
                         <select class="custom-select d-block w-100" name="project_total_area_dm" id="project_total_area_dm" required="">
                            <option value="sft" selected>sft</option>
                            <option value="sq-yards">sq yards</option>
                            <option value="acres">acres</option>
                             <option value="sq-meteres">sq meteres</option>
                        </select>
                      </div>
                    </div>
                </div>
                <?php endif ?>
              </div>
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_launch_date">
                <div class="col-md-5 mb-3">
                    <label for="country">Launch Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="launch_date">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Posession Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="posession_date">
                    </div>
                </div>
              </div>

               <div class="row div_rera_id">
                <div class="col-md-5 mb-3">
                    <label for="country">RERA ID</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rera_id">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Approving Authority</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="approving_authority">
                    </div>
                </div>
              </div>
                <?php endif ?>
                
                <?php if($listing_type == "rent") : ?>
                <div class="row div_rentpermonth">
                <div class="col-md-5 mb-3">
                    <label for="country">Rent Per Month</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rent_per_mon">
                    </div>
                </div>
              </div>
              <?php endif ?>
       <?php endif ?>
 

      <?php if(in_array($property_type_id,[4])) : ?>     
                           <div class="row">
                <div class="col-md-5 mb-3">
                   <label for="country">Complex Type </label>
                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="complex_type" id="complex_type" value="gated" checked> Gated
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="complex_type" id="complex_type" value="standalone"> Standalone
                      </label>
                    </div>
                </div>
               
               <div class="col-md-5 mb-3" id="div_bhk_type">   
                  <label for="country">BHKs</label>
                  <select class="custom-select d-block w-100" name="bhk_type" id="bhk_type" required="">
                      <option>Select BHK</option>
                      <option value="studio">Studio</option>
                      <option value="1bhk">1 BHK</option>   
                      <option value="2bhk">2 BHK</option>  
                      <option value="3bhk">3 BHK</option>  
                      <option value="4bhk">4 BHK</option>  
                      <option value="+5bhk">5+ BHK</option>     
                  </select>
                </div>
              </div>  

               <div class="row"> 
                <div class="col-md-5 mb-3">
                  <label for="country">City</label>
                  <select class="custom-select d-block w-100" name="city" id="city" required="">
                    <?php foreach($cities as $cy) : ?> 
                      <option value="<?= $cy['id'];?>" <?= ($cy['id']==$profile['city']) ? "selected" : "" ;?>><?= $cy['city_name'];?></option>
                    <?php endforeach ?> 
                  </select>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="country">Locality</label>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="All areas in" name="locality">
                  <div class="invalid-feedback">
                    Please select a valid country. 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                   <label for="country">Status </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="status_type" id="status_type" value="ready_to_occupy" checked> Ready to Occupy
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="status_type" id="status_type" value="under_construction"> Under Construction
                      </label>
                    </div>
                </div>

                <?php if($listing_type == "sell") : ?>
                 <div class="col-md-3 mb-3">
                   <label for="country">Condition </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="condition_type" id="condition_type" value="new" checked> New
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="condition_type" id="condition_type" value="resale"> Resale
                      </label>
                    </div>
                </div>
                <?php endif ?>
              </div>


              <div class="row"> 
                <div class="col-md-5 mb-3">
                    <label for="country">Project Name/Society</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_name">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Plot size</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="plot_size">
                    </div>
                </div>
              </div>
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_unit_price">
                <div class="col-md-5 mb-3">
                    <label for="country">Unit Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" name="unit_price" placeholder="Please input">
                      <div class="input-group-append">
                         <button class="btn btn-outline-dark" id="unit_price_dm" type="button">sft</button>  
                      </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3 div_total_price"> 
                    <label for="country">Total Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="total_price">
                    </div>
                </div>
              </div>
              <?php endif ?>

              <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="country">Dimension</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Length" name="length">
                           <div class="input-group-append">
                              <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Breath" name="breath">
                          </div>
                    </div>
                    
                </div>
                <?php if($listing_type == "sell") : ?>
                <div class="col-md-5 mb-3 div_project_total_area">
                    <label for="country">Project Total Area</label> 
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_total_area">
                      <div class="input-group-append">
                         <select class="custom-select d-block w-100" name="project_total_area_dm" id="project_total_area_dm" required="">
                            <option value="sft" selected>sft</option>
                            <option value="sq-yards">sq yards</option>
                            <option value="acres">acres</option>
                             <option value="sq-meteres">sq meteres</option>
                        </select>
                      </div>
                    </div>
                </div>
                <?php endif ?>
              </div>
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_launch_date">
                <div class="col-md-5 mb-3">
                    <label for="country">Launch Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="launch_date">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Posession Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="posession_date">
                    </div>
                </div>
              </div>

               <div class="row div_rera_id">
                <div class="col-md-5 mb-3">
                    <label for="country">RERA ID</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rera_id">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Approving Authority</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="approving_authority">
                    </div>
                </div>
              </div>
                <?php endif ?>
                
                <?php if($listing_type == "rent") : ?>
                <div class="row div_rentpermonth">
                <div class="col-md-5 mb-3">
                    <label for="country">Rent Per Month</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rent_per_mon">
                    </div>
                </div>
              </div>
              <?php endif ?>    
       <?php endif ?> 




      <?php if(in_array($property_type_id,[5])) : ?>     
              <div class="row">
                <div class="col-md-5 mb-3">
                   <label for="country">Complex Type </label>
                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="complex_type" id="complex_type" value="gated" checked> Gated
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="complex_type" id="complex_type" value="standalone"> Standalone
                      </label>
                    </div>
                </div>
               
               <div class="col-md-5 mb-3" id="div_bhk_type">   
                  <label for="country">BHKs</label>
                  <select class="custom-select d-block w-100" name="bhk_type" id="bhk_type" required="">
                      <option>Select BHK</option>
                      <option value="studio">Studio</option>
                      <option value="1bhk">1 BHK</option>   
                      <option value="2bhk">2 BHK</option>  
                      <option value="3bhk">3 BHK</option>  
                      <option value="4bhk">4 BHK</option>  
                      <option value="+5bhk">5+ BHK</option>     
                  </select>
                </div>
              </div>  

               <div class="row"> 
                <div class="col-md-5 mb-3">
                  <label for="country">City</label>
                  <select class="custom-select d-block w-100" name="city" id="city" required="">
                    <?php foreach($cities as $cy) : ?> 
                      <option value="<?= $cy['id'];?>" <?= ($cy['id']==$profile['city']) ? "selected" : "" ;?>><?= $cy['city_name'];?></option>
                    <?php endforeach ?> 
                  </select>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="country">Locality</label>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="All areas in" name="locality">
                  <div class="invalid-feedback">
                    Please select a valid country. 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                   <label for="country">Status </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="status_type" id="status_type" value="ready_to_occupy" checked> Ready to Occupy
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="status_type" id="status_type" value="under_construction"> Under Construction
                      </label>
                    </div>
                </div>

                <?php if($listing_type == "sell") : ?>
                 <div class="col-md-3 mb-3">
                   <label for="country">Condition </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="condition_type" id="condition_type" value="new" checked> New
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="condition_type" id="condition_type" value="resale"> Resale
                      </label>
                    </div>
                </div>
                <?php endif ?>
              </div>

              <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="country">Project Name/Society</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_name">
                    </div>
                </div>
              </div>


              
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_unit_price">
                <div class="col-md-5 mb-3">
                    <label for="country">Unit Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" name="unit_price" placeholder="Please input">
                      <div class="input-group-append">
                         <button class="btn btn-outline-dark" id="unit_price_dm" type="button">sft</button>  
                      </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3 div_total_price"> 
                    <label for="country">Total Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="total_price">
                    </div>
                </div>
              </div>
              <?php endif ?>

              <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="country">Land size</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="plot_size">
                    </div>
                </div>
                <?php if($listing_type == "sell") : ?>
                <div class="col-md-5 mb-3 div_project_total_area">
                    <label for="country">Project Total Area</label> 
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_total_area">
                      <div class="input-group-append">
                         <select class="custom-select d-block w-100" name="project_total_area_dm" id="project_total_area_dm" required="">
                            <option value="sft" selected>sft</option>
                            <option value="sq-yards">sq yards</option>
                            <option value="acres">acres</option>
                             <option value="sq-meteres">sq meteres</option>
                        </select>
                      </div>
                    </div>
                </div>
                <?php endif ?>
              </div>
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_launch_date">
                <div class="col-md-5 mb-3">
                    <label for="country">Launch Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="launch_date">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Posession Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="posession_date">
                    </div>
                </div>
              </div>

               <div class="row div_rera_id">
                <div class="col-md-5 mb-3">
                    <label for="country">RERA ID</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rera_id">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Approving Authority</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="approving_authority">
                    </div>
                </div>
              </div>
                <?php endif ?>
                
                <?php if($listing_type == "rent") : ?>
                <div class="row div_rentpermonth">
                <div class="col-md-5 mb-3">
                    <label for="country">Rent Per Month</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rent_per_mon">
                    </div>
                </div>
              </div>
              <?php endif ?>
       <?php endif ?>
       


       <?php if(in_array($property_type_id,[6])) : ?>     
                                  <div class="row">
                <div class="col-md-5 mb-3">
                   <label for="country">Complex Type </label>
                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="complex_type" id="complex_type" value="gated" checked> Gated
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="complex_type" id="complex_type" value="standalone"> Standalone
                      </label>
                    </div>
                </div>
               
               <div class="col-md-5 mb-3" id="div_bhk_type">   
                  <label for="country">BHKs</label>
                  <select class="custom-select d-block w-100" name="bhk_type" id="bhk_type" required="">
                      <option>Select BHK</option>
                      <option value="studio">Studio</option>
                      <option value="1bhk">1 BHK</option>   
                      <option value="2bhk">2 BHK</option>  
                      <option value="3bhk">3 BHK</option>  
                      <option value="4bhk">4 BHK</option>  
                      <option value="+5bhk">5+ BHK</option>     
                  </select>
                </div>
              </div>  

               <div class="row"> 
                <div class="col-md-5 mb-3">
                  <label for="country">City</label>
                  <select class="custom-select d-block w-100" name="city" id="city" required="">
                    <?php foreach($cities as $cy) : ?> 
                      <option value="<?= $cy['id'];?>" <?= ($cy['id']==$profile['city']) ? "selected" : "" ;?>><?= $cy['city_name'];?></option>
                    <?php endforeach ?> 
                  </select>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="country">Locality</label>
                  <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="All areas in" name="locality">
                  <div class="invalid-feedback">
                    Please select a valid country. 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                   <label for="country">Status </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="status_type" id="status_type" value="ready_to_occupy" checked> Ready to Occupy
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="status_type" id="status_type" value="under_construction"> Under Construction
                      </label>
                    </div>
                </div>

                <?php if($listing_type == "sell") : ?>
                 <div class="col-md-3 mb-3">
                   <label for="country">Condition </label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label class="btn btn-outline-danger active">
                        <input type="radio" name="condition_type" id="condition_type" value="new" checked> New
                      </label>
                      <label class="btn btn-outline-dark">
                        <input type="radio" name="condition_type" id="condition_type" value="resale"> Resale
                      </label>
                    </div>
                </div>
                <?php endif ?>
              </div>

              <div class="row"> 
                <div class="col-md-5 mb-3">
                    <label for="country">Builtup Area</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" name="builtup_area" placeholder="Please input">
                      <div class="input-group-append">
                         <select class="custom-select d-block w-100" name="builtup_area_dm" id="builtup_area_dm" required="">
                            <option value="sft" selected>sft</option>
                            <option value="sq-yards">sq yards</option>
                            <option value="sq-meteres">sq meteres</option>
                            <option value="acres">acres</option>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Project Name/Society</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_name">
                    </div>
                </div>
              </div>


              <?php if($listing_type == "sell") : ?>
              <div class="row div_unit_price">
                <div class="col-md-5 mb-3">
                    <label for="country">Unit Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" name="unit_price" placeholder="Please input">
                      <div class="input-group-append">
                         <button class="btn btn-outline-dark" id="unit_price_dm" type="button">sqft</button>  
                      </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3 div_total_price"> 
                    <label for="country">Total Price</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="total_price">
                    </div>
                </div>
              </div>
              <?php endif ?>

              <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="country">Configuration</label>
                    <div class="input-group">
                       <select class="custom-select d-block w-100" name="configuration" id="configuration" required="">
                            <option value="">Choose or Add Config</option> 
                            <option value="office-space">Office Space</option>
                            <option value="industrial-space">Industrial Space</option>
                            <option value="shutter">Shutter</option>
                            <option value="floor">Floor</option>
                            <option value="duplex">Duplex</option>
                        </select>
                    </div>
                </div>
                <?php if($listing_type == "sell") : ?>
                <div class="col-md-5 mb-3 div_project_total_area">
                    <label for="country">Project Total Area</label> 
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="project_total_area">
                      <div class="input-group-append">
                         <select class="custom-select d-block w-100" name="project_total_area_dm" id="project_total_area_dm" required="">
                            <option value="sft">sft</option>
                            <option value="sq-yards">sq yards</option>
                            <option value="acres">acres</option>
                             <option value="sq-meteres">sq meteres</option>
                        </select>
                      </div>
                    </div>
                </div>
                <?php endif ?>
              </div>
              
              <?php if($listing_type == "sell") : ?>
              <div class="row div_launch_date">
                <div class="col-md-5 mb-3">
                    <label for="country">Launch Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="launch_date">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Posession Date</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="posession_date">
                    </div>
                </div>
              </div>

               <div class="row div_rera_id">
                <div class="col-md-5 mb-3">
                    <label for="country">RERA ID</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rera_id">
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="country">Approving Authority</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="approving_authority">
                    </div>
                </div> 
              </div>
                <?php endif ?>
                
                <?php if($listing_type == "rent") : ?>
                <div class="row div_rentpermonth">
                <div class="col-md-5 mb-3">
                    <label for="country">Rent Per Month</label>
                    <div class="input-group">
                      <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Please input" name="rent_per_mon">
                    </div>
                </div>
              </div>
              <?php endif ?>
       <?php endif ?>                                                           