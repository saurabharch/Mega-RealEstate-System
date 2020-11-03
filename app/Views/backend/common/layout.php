
 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= publicFolder();?>/assets/css/style.css" /> 
    <link rel="stylesheet" href="<?= publicFolder();?>/assets/css/backend.css" />   
    
    <link href="https://getbootstrap.com/docs/4.5/examples/album/album.css" rel="stylesheet">    
    <link href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.5/assets/css/docs.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    
   <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" /> -->

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" integrity="sha512-SUJFImtiT87gVCOXl3aGC00zfDl6ggYAw5+oheJvRJ8KBXZrr/TMISSdVJ5bBarbQDRC2pR5Kto3xTR0kpZInA==" crossorigin="anonymous" /> 
    <script src="https://kit.fontawesome.com/6fd02afa84.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha512-QEiC894KVkN9Tsoi6+mKf8HaCLJvyA6QIRzY5KrfINXYuP9NxdIkRQhGq3BZi0J4I7V5SidGM3XUQ5wFiMDuWg==" crossorigin="anonymous"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js" integrity=" sha512-G8JE1Xbr0egZE5gNGyUm1fF764iHVfRXshIoUWCTPAbKkkItp/6qal5YAHXrxEu4HNfPTQs6HOu3D5vCGS1j3w==" crossorigin="anonymous"></script>  
   <script>
        window.onload = function () {

        var options = {
          animationEnabled: true,
          theme: "light2",
          title: {
            text: "Monthly Sales Data"
          },
          axisX: {
            valueFormatString: "MMM"
          },
          axisY: {
            prefix: "Lac-",
            labelFormatter: addSymbols
          },
          toolTip: {
            shared: true
          },
          legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
          },
          data: [
            {
              type: "column",
              name: "Actual Sales",
              showInLegend: true,
              xValueFormatString: "MMMM YYYY",
              yValueFormatString: "Lac-#,##0",
              dataPoints: [
                { x: new Date(2020, 0), y: 20000 },
                { x: new Date(2020, 1), y: 25000 },
                { x: new Date(2020, 2), y: 30000 },
                { x: new Date(2020, 3), y: 70000, indexLabel: "High Renewals" },
                { x: new Date(2020, 4), y: 40000 },
                { x: new Date(2020, 5), y: 60000 },
                { x: new Date(2020, 6), y: 55000 },
                { x: new Date(2020, 7), y: 33000 },
                { x: new Date(2020, 8), y: 45000 },
                { x: new Date(2020, 9), y: 30000 },
                { x: new Date(2020, 10), y: 50000 },
                { x: new Date(2020, 11), y: 35000 }
              ]
            },
            {
              type: "line",
              name: "Expected Sales",
              showInLegend: true,
              yValueFormatString: "Lac-#,##0",
              dataPoints: [
                { x: new Date(2020, 0), y: 32000 },
                { x: new Date(2020, 1), y: 37000 },
                { x: new Date(2020, 2), y: 40000 },
                { x: new Date(2020, 3), y: 52000 },
                { x: new Date(2020, 4), y: 45000 },
                { x: new Date(2020, 5), y: 47000 },
                { x: new Date(2020, 6), y: 42000 },
                { x: new Date(2020, 7), y: 43000 },
                { x: new Date(2020, 8), y: 41000 },
                { x: new Date(2020, 9), y: 42000 },
                { x: new Date(2020, 10), y: 50000 },
                { x: new Date(2020, 11), y: 45000 }
              ]
            },
            {
              type: "area",
              name: "Profit",
              markerBorderColor: "white",
              markerBorderThickness: 2,
              showInLegend: true,
              yValueFormatString: "Lac-#,##0",
              dataPoints: [
                { x: new Date(2020, 0), y: 4000 },
                { x: new Date(2020, 1), y: 7000 },
                { x: new Date(2020, 2), y: 12000 },
                { x: new Date(2020, 3), y: 40000 },
                { x: new Date(2020, 4), y: 20000 },
                { x: new Date(2020, 5), y: 35000 },
                { x: new Date(2020, 6), y: 33000 },
                { x: new Date(2020, 7), y: 20000 },
                { x: new Date(2020, 8), y: 25000 },
                { x: new Date(2020, 9), y: 16000 },
                { x: new Date(2020, 10), y: 29000 },
                { x: new Date(2020, 11), y: 20000 }
              ]
            }]
        };
        $("#chartContainer").CanvasJSChart(options);

        function addSymbols(e) {
          var suffixes = ["", "K", "M", "B"];
          var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

          if (order > suffixes.length - 1)
            order = suffixes.length - 1;

          var suffix = suffixes[order];
          return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }

        function toggleDataSeries(e) {
          if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
          } else {
            e.dataSeries.visible = true;
          }
          e.chart.render();
        }


        }
</script>
<style type="text/css">
  .list-group-item.active{
    background-color: #253961;
  }
</style>    
    
    <title><?= $title ? $title : "Site" ?></title>    
  </head>
  <body> 

 <header>
      <div class="navbar navbar-dark box-shadow" style="background-color: #14264a"> 
        <div class="container-fluid d-flex justify-content-between">
            <a href="<?= base_url();?>/backend/dashboard/index" class="navbar-brand d-flex align-items-center">
              <strong><img src="<?= publicFolder();?>/images/propertyraja.png" width="200"></strong>
            </a>

            <button class="navbar-toggler dropdown-toggle small" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Welcome <?php echo ucfirst(\Config\Services::session()->get('display'));?> <span class="navbar-toggler-icon"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-right animate slideIn">
                <span class="dropdown-menu-arrow"></span> 

                <?php if(\Config\Services::session()->get('role') == "admin"){ ?>
                <a class="dropdown-item" href="<?= base_url();?>/backend/dashboard/index">Go To Dashboard</a>
                <a class="dropdown-item" href="<?= base_url();?>/logout">Logout</a>
                <?php } ?> 
        </div>
      </div>
  </header>   

    
  <?= $this->renderSection('content') ?>  

        
<footer class="text-muted" style="background-color: #14264a">
  <div class="container">
    <p class="float-right">
      <p >
        Made With <i class="fa fa-heart" style="font-size:20px;color:#af4456;"></i> - Algobasket Production
         <a href="" style="text-decoration:none;color:#aaa;margin-left:10px" class="float-right"><i class="fa fa-facebook-square fa-2x"></i></a>
         <a href="" style="text-decoration:none;color:#aaa;margin-left:10px" class="float-right"><i class="fa fa-twitter-square fa-2x"></i></a>
         <a href="" style="text-decoration:none;color:#aaa" class="float-right"><i class="fa fa-youtube fa-2x"></i></a>
      </p>
    </p>
    <p>PropertyRaja is &copy; Algobasket's product, all right reserved to the owner!</p>
    <p>
     <center>

         <a href="https:/license" style="text-decoration:none;color:#aaa">Licence</a> |
         <a href="https:/subscription" style="text-decoration:none;color:#aaa">Subscription</a> |
         <a href="https:/legal-notice" style="text-decoration:none;color:#aaa">Legal Notice</a> |
         <a href="https:/privacy-policy" style="text-decoration:none;color:#aaa">Privacy Policy</a> |
         <a href="https:/about" style="text-decoration:none;color:#aaa">About</a> |
         <a href="https:/contact" style="text-decoration:none;color:#aaa">Contact</a> |
         <a href="https:/faq" style="text-decoration:none;color:#aaa">FAQ</a>


     </center>
    </p>
  </div>
</footer> 

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= publicFolder();?>/assets/js/script.js"></script>

   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous"></script> -->
   <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

    

    <script type="text/javascript">
      $('document').ready(function(){
           
          $('.openMenu').click(function(){
              window.location.href=  $(this).attr('data-href'); 
          });
          $('.imagesS').click(function(){
            var json = $(this).attr('data-images');
            json = JSON.parse(json);
            var html = "";
            for(var i = 0;i < json.length;i++)
              {  
                 var isActive  = (i == 0) ? "active" : "";

                 html += '<div class="carousel-item '+isActive+'">';
                 html += '<img src="<?= publicFolder();?>/property-images/'+json[i]+'" class="d-block w-100" alt="..."/>';
                 html += '</div>';
              }
              $('.propertyImagesShow').html(html);
              $('.propertyImagesModal').modal('show'); 
          });

          $('.deletePop').click(function(){ 
              var link = $(this).attr('data-confirmedUrl'); 
              $('.confirmedUrl').attr('href',link);   
              $('.showModalPopup').modal('show'); 
          });
          $('#searchUser').keyup(function(){
             var txt = $(this).val();
             var data = {
               txt : txt
             }
             $('.listUser').html('');
             if(txt)
             {
                 $.ajax({
                    type : 'POST',
                    data : data,
                    url : '/backend/user/userDropdownList',
                    success:function(html){  
                      $('.listUser').html(html); 
                     }
                  });
             } 
          });
        
           
      });
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      });
      function searchedUser(i){
        $('#searchedInputid').val(i);
        $('.listUser').hide();
      }
    </script> 
    <script type="text/javascript">
  $('document').ready(function(){
     $('.removeImage').click(function(){

      var r = confirm("Do you want to delete this image ?");
      if (r == true) {
           var imageId   = $(this).attr('data-image-id');
           var imageFile = $(this).attr('data-image-file');
           var data = {
             imageId : imageId,
             imageFile : imageFile
           }
           $.ajax({
              type : 'POST',
              data : data,
              url  : '/backend/properties/removePropertyImage',
              success:function(html){
               $('#removeImage'+imageId).hide();  
              } 
           });
      } else {
        alert('Cannot delete this item');
      }

      

     });
  });
</script>
</body>
</html>