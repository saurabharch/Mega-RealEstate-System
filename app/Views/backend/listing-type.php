<?= $this->extend('backend/common/layout') ?> 
<?= $this->section('content') ?>   


<div class="container-fluid">
<br> 
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="https:/">Home</a></li>
      <li class="breadcrumb-item"><a href="https:/browse-course">Browse</a></li>
      </ol>
    </nav>
    <br>  

  <div class="row">
   <?= $this->include('backend/common/sidebar');?> 
  
  <div class="col-md-9">
   <div class="form-group">
    <div class="input-group input-group-lg">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-lg">Browse Course</span>
      </div>
      <input type="text" placeholder="Search your course.." class="form-control searchCourse2" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
    </div>
    <ul class="list-group searchCourseDisplay" style="display:none;position:absolute;z-index:999;width:60%;margin-left:170px"></ul>
   </div>

    <div class="table-responsive">
      <table class="table">
          <caption>List of users</caption>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Photo</th>
              <th scope="col">First</th>
              <th scope="col">Last</th>
              <th scope="col">Last</th>
              <th scope="col">Handle</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
          </tbody>
      </table>
    </div>
       
   

  </div>
</div>

</div>



<?= $this->endSection() ?>