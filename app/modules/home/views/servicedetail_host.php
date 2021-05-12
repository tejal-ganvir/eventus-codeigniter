    <div class="main-container">
        <div class="container tabbed-page st-tabs">
            <div class="row tab-page-header">
                <div class="col-md-8 title"> <a href="javaScript:Void(0)" class="label-primary"><?php if($service_detail){ echo $service_detail['ser_name'];}?></a>
                    <h1><?php if($service_detail){ echo $service_detail['company'];}?></h1>
                    <p class="location"><i class="fa fa-map-marker"></i><?php echo $service_detail['address'] ?></p>
                    <hr>
                </div>
                <div class="col-md-4 venue-data">
                    <div class="venue-info">
                        <!-- venue-info-->
                        <div class="capacity">
                            <div>Capacity:</div>
                            <span class="cap-people"> 
                              <?php 
                                $min = '';
                                  if($service_detail) 
                                  {
                                    if($service_detail['guest'] == 1)
                                      $min = "0-100";
                                    else if($service_detail['guest'] == 2)
                                      $min = "100-200";
                                    else if($service_detail['guest'] == 3)
                                      $min = "200-300";
                                    else if($service_detail['guest'] == 4)
                                      $min = "300-400"; 
                                    else if($service_detail['guest'] == 5)
                                      $min = "400-500"; 
                                    else if($service_detail['guest'] == 6)
                                      $min = "500 & Up"; 
                                  }
                                  echo $min;
                              ?>
                            </span> </div>
                        <div class="pricebox">
                            <div>City:</div>
                            <span class="price"><?php echo $service_location['city'] ?></span></div>
                    </div> </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#photo" title="Gallery" aria-controls="photo" role="tab" data-toggle="tab"> <i class="fa fa-photo"></i> <span class="tab-title">Photo</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#about" title="about info" aria-controls="about" role="tab" data-toggle="tab">
                                <i class="fa fa-info-circle"></i>
                                <span class="tab-title">Packages</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#onmap" title="Location" aria-controls="onmap" role="tab" data-toggle="tab"> <i class="fa fa-map-marker"></i> <span class="tab-title">On map</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#video" title="Video" aria-controls="video" role="tab" data-toggle="tab"> <i class="fa fa-bell"></i> <span class="tab-title">Availability</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#amenities" title="Amenities" aria-controls="amenities" role="tab" data-toggle="tab"> <i class="fa fa-asterisk"></i> <span class="tab-title">Notes</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#reviews" title="Review" aria-controls="reviews" role="tab" data-toggle="tab"> <i class="fa fa-commenting"></i> <span class="tab-title">Reviews</span></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                  <div class="tab-content">
                        <!-- tab content start-->
                        <div role="tabpanel" class="tab-pane fade in active" id="photo">
                            <div id="sync1" class="owl-carousel">
                                <?php 
                                  if($service_image)
                                  {
                                    for ($k=0; $k < count($service_image); $k++) 
                                    {  
                                ?>
                                <div class="item"> <img src="<?php echo base_url();?>uploads/service_image/<?php echo $service_image[$k]->name; ?>" alt="" class="img-responsive"> </div>
                                <?php 
                                    }
                                  }
                                ?>
                            </div>
                            <div id="sync2" class="owl-carousel">
                                <?php 
                                  if($service_image)
                                  {
                                    for ($k=0; $k < count($service_image); $k++) 
                                    {  
                                ?>
                                <div class="item"> <img src="<?php echo base_url();?>uploads/service_image/<?php echo $service_image[$k]->name; ?>" alt="" class="img-responsive"> </div>
                                <?php 
                                    }
                                  }
                                ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="about">
                            <div class="venue-details">
                                <h2>Packages</h2>
                                <table class="table table-bordered">
                                  <tr>
                                    <th style="color:#449E8E; font:bolder; font-size:28px; font-family: 'Times New Roman', Times, serif;">Name</th>
                                    <th style="color:#449E8E; font:bolder; font-size:28px; font-family: 'Times New Roman', Times, serif;">Provides</th>
                                    <th style="color:#449E8E; font:bolder; font-size:28px; font-family: 'Times New Roman', Times, serif;">Price</th>
                                  </tr>
                                <?php 
                                if($service_package)
                                { 
                                  for ($l=0; $l < count($service_package); $l++) 
                                  { 
                                      
                                      ?>
                                      <tr>
                                      <td style="font:bolder; font-size:22px; font-family: 'Times New Roman', Times, serif;">
                                        <?php echo $service_package[$l]->package_name; ?>
                                      </td>
                                      <td style="font:bolder; font-size:22px; font-family: 'Times New Roman', Times, serif;">
                                        <?php echo $service_package[$l]->package_description; ?>
                                      </td>
                                      <td style="font:bolder; font-size:22px; font-family: 'Times New Roman', Times, serif;">
                                        <?php echo $service_package[$l]->package_price." /-"; ?>
                                      </td>
                                    </tr>
                                      <?php
                                  }
                                }
                              ?>
                              </table>
                                
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="onmap">
                            <div id="map_canvas" style="height: 400px;width: 100%;margin: 0 auto;"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="video">
                            <!-- 16:9 aspect ratio -->
                                <!--<iframe class="embed-responsive-item" src=" Video URL HERE"></iframe>-->
                                <table class="table" style="width: 80%;" align="center">
                                  <thead class="thead-dark">
                                    <tr>
                                      <th>Days</th>
                                      <th>Timing</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    if($service_days)
                                      { 

                                        $event_start= explode(" ", $service_detail['from_time']);
                                        $event_end= explode(" ", $service_detail['to_time']);
                                        $start_time = $event_start[0].":00 ".strtolower($event_start[1]);
                                        $end_time = $event_end[0].":00 ".strtolower($event_end[1]);
                                        for ($j=0; $j < count($service_days); $j++) 
                                        { 
                                            
                                            ?>
                                            <tr>
                                              <td><?php echo $service_days[$j]->day ?></td>
                                              <td><?php echo $start_time." - ".$end_time ?></td>
                                            </tr>
                                            <?php 
                                        }
                                        
                                      }
                                    ?>
                                  </tbody>
                                </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="amenities">
                            <div class="row">
                                <div class="col-md-6 venue-amenities">
                                    <h2>Space Notes</h2>
                                    <ul class="check-circle list-group">
                                        <li class="list-group-item"><font color="red">* </font> Price Type: <b><?php if($service_detail){ echo ucfirst($service_detail['price_type']);}?></b></li><!-- 
                                        <li class="list-group-item"><font color="red">* </font> Provided For Minimum: <b><?php if($service_detail){ echo ucfirst($service_detail['min_hrs']);}?> Hours</b></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="reviews">
                            <!-- comments -->
                            <div class="customer-review">
                                <div class="row">
                                  <?php if($review){ ?>
                                    <div class="col-md-12">
                                        <h1>Customer Review</h1>
                                        <div class="review-list">
                                          <?php
                                            for ($m=0; $m < count($review); $m++) 
                                                { ?>
                                            <!-- First Comment -->
                                            <?php 
                                              $CustPhoto = $review[$m]->profile_image?'uploads/profile_pic/'.$review[$m]->profile_image:"themes/frontend/images/no-image.png";
                                             ?>
                                            <div class="row">
                                                <div class="col-md-2 col-sm-2 hidden-xs">
                                                    <div class="user-pic"> <img class="img-responsive img-circle" src="<?php echo base_url().$CustPhoto;?>" alt=""> </div>
                                                </div>
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="panel panel-default arrow left">
                                                        <div class="panel-body">
                                                            <div class="text-left">
                                                                <h3><?php echo $review[$m]->fname." ".$review[$m]->lname; ?></h3>
                                                                <?php $x= $review[$m]->stars*20; ?>
                                                                <div class="rating"> 
                                                                  <div><span class="stars-container stars-<?php echo $x ?>" style="font-size: 22px;">★★★★★</span></div>
                                                                </div>
                                                            </div>
                                                            <div class="review-post">
                                                                <p><b> <?php echo $review[$m]->review ?> </b></p>
                                                            </div>
                                                            <div class="review-user">Posted on <span class="review-date"></span><a href="javaScript:void(0)"><?php  echo date("d F Y", strtotime($review[$m]->created_at)) ?></a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Second Comment -->
                                            <?php } ?>
                                        </div>
                                    </div>
                                  <?php }else{
                                    echo "Sorry no reviews yet for this service";
                                  } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab content start-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="side-box" id="inquiry">
                        <h2>Perform Action</h2>
                            
                            <div class="form-group text-center">
                                <a href="<?php echo base_url();?>home/editservice/<?php if($service_detail){ echo $service_detail['uni_id'];}?>" class="btn btn-default btn-lg" >Edit</a>
                                <a class="btn btn-primary btn-lg" href="javascript:;" onclick="DeleteSpace('<?php if($service_detail){ echo $service_detail['uni_id'];}?>');">Delete</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-sidebar side-box">
                      <div class="profile-usertitle-name">
                        <h3><b>Hosted By</b></h3>
                      </div>
                        <!-- SIDEBAR USERPIC -->
                        <?php 
                        $CustPhoto = $service_detail['profile_image']?'uploads/profile_pic/'.$service_detail['profile_image']:"themes/frontend/images/no-image.png";
                       ?>
                        <div class="profile-userpic"> <img src="<?php echo base_url().$CustPhoto;?>" class="img-responsive img-circle" alt=""> </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                <h2> <?php echo $service_detail['fname']." ".$service_detail['lname'] ; ?></h2>
                            </div>
                            <div class="profile-address"> <i class="fa fa-phone"></i> <a href="tel:<?php echo $service_detail['mobileno']; ?>"><?php echo $service_detail['mobileno']; ?></a> </div>
                            <div class="profile-website"> <i class="fa fa-link"></i> 
                              <span class="text-muted">
                                Member since | <?php echo date("d F Y", strtotime($service_detail['created_on'])); ?>
                              </span>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
function DeleteSpace(id){
  $.confirm({
    title: 'Confirmation Message',
    content: 'Are you sure, you want to delete the space ?',
    confirmButton: 'Proceed',
    confirmButtonClass: 'btn-info',
    icon: 'fa fa-question-circle',
    animation: 'scale',
    animationClose: 'top',
    opacity: 1, 
    confirm: function () { 
        $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_thatservice/"+id,  
          success: function(result) { 
            if(result == 1) {
              $.alert({
                  title: 'Success!',
                  content: 'Service has been deleted successfully...',
                  confirmButton: 'Okay',
                  confirmButtonClass: 'btn-warning',
                  icon: 'fa fa-info',
                  animation: 'zoom',
                  opacity: 1,                                    
                  confirm: function () {
                      window.location.href = "<?php echo base_url();?>home/servicelist";
                  }
              });
            }  
            else{
              var msg = 'Unable to deleted the service ,Please try again.';
              alert_pop(msg);
            }
          }
        });
      }
  });
}
function alert_pop(msg){
   $.alert({
      title: 'Alert Message',
      content: msg,
      confirmButton: 'okay',
      confirmButtonClass: 'btn-warning',
      animation: 'bottom',
      icon: 'fa fa-check',
      opacity: 2,  
      backgroundDismiss: true
  });
}
</script>
<script>

     $(function () {
         var lat = <?php echo $service_detail['lat'] ?>,
             lng = <?php echo $service_detail['lon'] ?>,
             latlng = new google.maps.LatLng(lat, lng);
             //image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
         //zoomControl: true,
         //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,
         var mapOptions = {
             center: new google.maps.LatLng(lat, lng),
             zoom: 13,
             scrollwheel:  false,
             mapTypeId: google.maps.MapTypeId.ROADMAP,
             panControl: true,
             panControlOptions: {
                 position: google.maps.ControlPosition.TOP_RIGHT
             },
             zoomControl: true,
             zoomControlOptions: {
                 style: google.maps.ZoomControlStyle.LARGE,
                 position: google.maps.ControlPosition.TOP_left
             }
         },
         map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
             marker = new google.maps.Marker({
                 position: latlng,
                 map: map
                 //icon: image
             });

             var infowindow = new google.maps.InfoWindow({
                content:"<div><h2 align='center'><?php echo $service_detail['company'] ?></h2><i><?php echo $service_detail['address'] ?></i></div>"
              });


        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
          });
               
         
        
         
     });
</script>