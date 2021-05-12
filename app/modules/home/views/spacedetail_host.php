    <div class="main-container">
        <div class="container tabbed-page st-tabs">
            <div class="row tab-page-header">
                <div class="col-md-8 title"> <a href="javaScript:Void(0)" class="label-primary"><?php if($venue){ echo $venue['venue_name'];}?></a>
                    <h1><?php if($space_detail){ echo $space_detail['title'];}?></h1>
                    <p class="location"><i class="fa fa-map-marker"></i><?php echo $space_detail['my_add'] ?></p>
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
                                  if($space_detail) 
                                  {
                                    if($space_detail['guest'] == 1)
                                      $min = "0-100";
                                    else if($space_detail['guest'] == 2)
                                      $min = "100-200";
                                    else if($space_detail['guest'] == 3)
                                      $min = "200-300";
                                    else if($space_detail['guest'] == 4)
                                      $min = "300-400"; 
                                    else if($space_detail['guest'] == 5)
                                      $min = "400-500"; 
                                    else if($space_detail['guest'] == 6)
                                      $min = "500 & Up"; 
                                  }
                                  echo $min;
                              ?>
                            </span> </div>
                        <div class="pricebox">
                            <div>City:</div>
                            <span class="price"><?php echo $space_location['city'] ?></span></div>
                    </div>
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
                                <span class="tab-title">About</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#onmap" title="Location" aria-controls="onmap" role="tab" data-toggle="tab"> <i class="fa fa-map-marker"></i> <span class="tab-title">On map</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#video" title="Video" aria-controls="video" role="tab" data-toggle="tab"> <i class="fa fa-bell"></i> <span class="tab-title">Availability</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#notes" title="Notes" aria-controls="notes" role="tab" data-toggle="tab"> <i class="fa fa-asterisk"></i> <span class="tab-title">Notes</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#amenities" title="Amenities" aria-controls="amenities" role="tab" data-toggle="tab"> <i class="fa fa-hotel"></i> <span class="tab-title">Amenities</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#rules" title="Rules" aria-controls="rules" role="tab" data-toggle="tab"> <i class="fa fa-exclamation"></i> <span class="tab-title">Rules</span></a>
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
                                  if($space_image)
                                  {
                                    for ($k=0; $k < count($space_image); $k++) 
                                    {  
                                ?>
                                <div class="item"> <img src="<?php echo base_url();?>uploads/space_image/<?php echo $space_image[$k]->name; ?>" alt="" class="img-responsive"> </div>
                                <?php 
                                    }
                                  }
                                ?>
                            </div>
                            <div id="sync2" class="owl-carousel">
                                <?php 
                                  if($space_image)
                                  {
                                    for ($k=0; $k < count($space_image); $k++) 
                                    {  
                                ?>
                                <div class="item"> <img src="<?php echo base_url();?>uploads/space_image/<?php echo $space_image[$k]->name; ?>" alt="" class="img-responsive"> </div>
                                <?php 
                                    }
                                  }
                                ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="about">
                            <div class="venue-details">
                              <p style="color:#000; font:bolder; font-size:32px; font-family: 'Times New Roman', Times, serif;">About <?php if($space_detail){ echo $space_detail['title'];}?>:</p>
                              <p class="text-muted" style="font:bolder; font-size:22px; font-family: 'Times New Roman', Times, serif;"><?php if($space_detail){ echo $space_detail['description'];}?></p>
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
                                    if($space_days)
                                      { 

                                        $event_start= explode(" ", $space_detail['from_time']);
                                        $event_end= explode(" ", $space_detail['to_time']);
                                        $start_time = $event_start[0].":00 ".strtolower($event_start[1]);
                                        $end_time = $event_end[0].":00 ".strtolower($event_end[1]);
                                        for ($j=0; $j < count($space_days); $j++) 
                                        { 
                                            
                                            ?>
                                            <tr>
                                              <td><?php echo $space_days[$j]->day ?></td>
                                              <td><?php echo $start_time." - ".$end_time ?></td>
                                            </tr>
                                            <?php 
                                        }
                                        
                                      }
                                    ?>
                                  </tbody>
                                </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="notes">
                            <div class="row">
                                <div class="col-md-6 venue-amenities">
                                    <h2>Space Notes</h2>
                                    <ul class="check-circle list-group">
                                        <li class="list-group-item"><font color="red">* </font> Price Type: <b><?php if($space_detail){ echo ucfirst($space_detail['price_type']);}?></b></li>
                                        <li class="list-group-item"><font color="red">* </font> Accomodates: <b><?php if($space_detail){ echo ucfirst($space_detail['accomodates']); }?></b></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="amenities">
                            <div class="row">
                                <div class="col-md-6 venue-amenities">
                                  <?php $amenities = explode(",", $space_detail['amenities']); ?>
                                    <h2>Space Facilities</h2>
                                    <ul class="check-circle list-group">
                                        <li class="list-group-item <?php if (!in_array(1, $amenities)) { echo 'sr-only'; } ?>">Air Conditioning</li>
                                        <li class="list-group-item <?php if (!in_array(2, $amenities)) { echo 'sr-only'; } ?>">Bathrooms </li>
                                        <li class="list-group-item <?php if (!in_array(3, $amenities)) { echo 'sr-only'; } ?>">Private Entrance </li>
                                        <li class="list-group-item <?php if (!in_array(4, $amenities)) { echo 'sr-only'; } ?>">Projector</li>
                                        <li class="list-group-item <?php if (!in_array(5, $amenities)) { echo 'sr-only'; } ?>">Kitchen </li>
                                        <li class="list-group-item <?php if (!in_array(6, $amenities)) { echo 'sr-only'; } ?>">Sink Facilities </li>
                                        <li class="list-group-item <?php if (!in_array(7, $amenities)) { echo 'sr-only'; } ?>">Stage </li>
                                        <li class="list-group-item <?php if (!in_array(8, $amenities)) { echo 'sr-only'; } ?>">Whiteboard</li>
                                        <li class="list-group-item <?php if (!in_array(9, $amenities)) { echo 'sr-only'; } ?>">Photography Lighting</li>
                                        <li class="list-group-item <?php if (!in_array(10, $amenities)) { echo 'sr-only'; } ?>">Sound System</li>
                                        <li class="list-group-item <?php if (!in_array(11, $amenities)) { echo 'sr-only'; } ?>">Wifi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="rules">
                            <div class="row">
                                <div class="col-md-6 venue-amenities">
                                  <?php $rules = explode(",", $space_detail['rules']); ?>
                                    <h2>Space Rules</h2>
                                    <ul class="check-circle list-group">
                                        <li class="list-group-item <?php if (!in_array(1, $rules)) { echo 'sr-only'; } ?>">No Smoking</li>
                                        <li class="list-group-item <?php if (!in_array(2, $rules)) { echo 'sr-only'; } ?>">No Cooking</li>
                                        <li class="list-group-item <?php if (!in_array(3, $rules)) { echo 'sr-only'; } ?>">No Ticket Sale</li>
                                        <li class="list-group-item <?php if (!in_array(4, $rules)) { echo 'sr-only'; } ?>">No Music</li>
                                        <li class="list-group-item <?php if (!in_array(5, $rules)) { echo 'sr-only'; } ?>">No Under-Age (18-21)</li>
                                        <li class="list-group-item <?php if (!in_array(6, $rules)) { echo 'sr-only'; } ?>">No Teenagers (10-18)</li>
                                        <li class="list-group-item <?php if (!in_array(7, $rules)) { echo 'sr-only'; } ?>">No Children (0-10)</li>
                                        <li class="list-group-item <?php if (!in_array(8, $rules)) { echo 'sr-only'; } ?>">No Outside Catering/Food</li>
                                        <li class="list-group-item <?php if (!in_array(9, $rules)) { echo 'sr-only'; } ?>">No Loud Music/Dancing</li>
                                        <li class="list-group-item <?php if (!in_array(10, $rules)) { echo 'sr-only'; } ?>">No Alcohol (Serving)</li>
                                        <li class="list-group-item <?php if (!in_array(11, $rules)) { echo 'sr-only'; } ?>">No  Alcohol (Selling)</li>
                                        <li class="list-group-item <?php if (!in_array(11, $rules)) { echo 'sr-only'; } ?>">No Late Nights Parties</li>
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
                                    echo "Sorry no reviews yet for this space";
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
                                <a href="<?php echo base_url();?>home/editspace/<?php if($space_detail){ echo $space_detail['uni_id'];}?>" class="btn btn-default btn-lg" >Edit</a>
                                <a class="btn btn-primary btn-lg" href="javascript:;" onclick="DeleteSpace('<?php if($space_detail){ echo $space_detail['uni_id'];}?>');">Delete</a>
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
                        $CustPhoto = $space_detail['profile_image']?'uploads/profile_pic/'.$space_detail['profile_image']:"themes/frontend/images/no-image.png";
                       ?>
                        <div class="profile-userpic"> <img src="<?php echo base_url().$CustPhoto;?>" class="img-responsive img-circle" alt=""> </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                <h2> <?php echo $space_detail['fname']." ".$space_detail['lname'] ; ?></h2>
                            </div>
                            <div class="profile-address"> <i class="fa fa-phone"></i> <a href="tel:<?php echo $space_detail['mobileno']; ?>"><?php echo $space_detail['mobileno']; ?></a> </div>
                            <div class="profile-website"> <i class="fa fa-link"></i> 
                              <span class="text-muted">
                                Member since | <?php echo date("d F Y", strtotime($space_detail['created_on'])); ?>
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
        $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_thatspace/"+id,  
          success: function(result) { 
            if(result == 1) {
              $.alert({
                  title: 'Success!',
                  content: 'Space has been deleted successfully...',
                  confirmButton: 'Okay',
                  confirmButtonClass: 'btn-warning',
                  icon: 'fa fa-info',
                  animation: 'zoom',
                  opacity: 1,                                    
                  confirm: function () {
                      window.location.href = "<?php echo base_url();?>home/spacelist";
                  }
              });
            }  
            else{
              var msg = 'Unable to deleted the space ,Please try again.';
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
         var lat = <?php echo $space_detail['lat'] ?>,
             lng = <?php echo $space_detail['lon'] ?>,
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
                content:"<div><h2 align='center'><?php echo $space_detail['title'] ?></h2><i><?php echo $space_detail['my_add'] ?></i></div>"
              });


        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
          });
               
         
        
         
     });
</script>