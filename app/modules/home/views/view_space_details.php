    <div class="main-container">
        <div class="container tabbed-page st-tabs">
            <div class="row tab-page-header">
                <div class="col-md-8 title"> <a href="javaScript:Void(0)" class="label-primary"><?php if($space_detail){ echo $space_detail['accomodates'];}?></a>
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
                    <a href="#inquiry" class="btn btn-default btn-lg btn-block">Book Venue</a> </div>
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
                                        <li class="list-group-item"><font color="red">* </font> Provided For Minimum: <b><?php if($space_detail){ echo ucfirst($space_detail['min_hr']);}?> Hours</b></li>
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
                                                                <p>  <?php echo $review[$m]->review ?> </p>
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
            <?php
                      if ($current_date) {

                        $time_array=array();
                      for ($o=0; $o < count($current_date); $o++) 
                            { 
                                 $current_event_start= explode(" ", $current_date[$o]->start_time);
                                 $current_event_end= explode(" ", $current_date[$o]->end_time);
                                 $current_start_time = $current_event_start[0].":00 ".strtolower($current_event_start[1]);
                                 $current_end_time = $current_event_end[0].":00 ".strtolower($current_event_end[1]);
                                 $current_date2 = date('H:i',strtotime($current_start_time));
                                 $current_date3 = date('H:i',strtotime($current_end_time));

                              for ($z=0; $z < count($timings); $z++) 
                              {   
                                $cur1= explode(" ", $timings[$z]->value);
                                $cur2 = $cur1[0].":00 ".strtolower($cur1[1]);
                                $date11 = date('H:i', strtotime($cur2));

                                if ($date11 >= $current_date2 && $date11 <= $current_date3) {
                                  array_push($time_array, $date11);
                                }


                              }

                            }

                            //print_r($time_array);
                    }

                ?>
                
            <div class="row">
                <div class="col-md-8">
                    <div class="side-box" id="inquiry">
                        <h2>Add To Cart</h2>
                        <p>Fill in your details and add this space to your cart.</p>
                        <div class="alert alert-danger sr-only" role="alert" id="already">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Please select another time!</strong> This space has another event at this time. 
                        </div>
                      <form method="post" action="<?php echo base_url();?>home/booked_space/<?php echo $space_detail['uni_id']; ?>" id="submit_form">
                          <input type="hidden" id="time_array" value="<?php if($current_date) { echo implode(',', $time_array); }  ?>">
                          <input type="hidden" name="space_id" id="space_id" value="<?php echo $space_detail['space_id'] ?>">
                            <!-- Text input-->
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <label class="control-label" for="name-one">Events:<font class="required">*</font></label>
                                <div class="">
                                    <select class="form-control"   name="event_id" id="events">
                                      <?php 
                                      if($events)
                                      {
                                        for ($i=0; $i < count($events); $i++) 
                                        {   
                                          $is_checked = 0;
                                          if($space_event)
                                          {
                                            for ($m=0; $m < count($space_event); $m++) 
                                            { 
                                              if($space_event[$m]->event_id == $events[$i]->event_id)
                                              {
                                                $is_checked = 1;
                                              }
                                            }
                                          } 
                                        ?>
                                          <option <?php if($is_checked == 0){ echo "style='display:none;'" ;}?> value="<?php echo $events[$i]->event_id?>"><?php echo $events[$i]->event_name?></option>
                                          <?php
                                        }
                                      }
                                    ?>
                                  </select> 
                                </div>
                                <span style="color: red; font-size: 12px; float: left;"></span>
                            </div>
                            <!-- Text input-->
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <label class="control-label" for="phone">Guests:<font class="required">*</font></label>
                                <div class="">
                                  <select name="guest_id" id="guests" class="form-control">
                                    <option value="0"><b>No Of Guests</b></option>
                                    <option value="1" <?php if($space_detail['guest']){ if($space_detail['guest']!=1){ echo "style='display:none'";}}?>>0-100 Guests</option>
                                    <option value="2" <?php if($space_detail['guest']){ if($space_detail['guest']!=2){ echo "style='display:none'";}}?>>100-200 Guests</option>
                                    <option value="3" <?php if($space_detail['guest']){ if($space_detail['guest']!=3){ echo "style='display:none'";}}?>>200-300 Guests</option>
                                    <option value="4" <?php if($space_detail['guest']){ if($space_detail['guest']!=4){ echo "style='display:none'";}}?>>300-400 Guests</option>
                                    <option value="5" <?php if($space_detail['guest']){ if($space_detail['guest']!=5){ echo "style='display:none'";}}?>>400-500 Guests</option>
                                    <option value="6" <?php if($space_detail['guest']){ if($space_detail['guest']!=6){ echo "style='display:none'";}}?>>500&Up Guests</option>
                                  </select>
                                </div>
                                <span style="color: red; font-size: 12px; float: left;"></span>
                            </div>
                            <!-- Text input-->
                            <div class="default-calender">
                                <div class="col-md-6" style="margin-bottom: 20px;">
                                    <label class="control-label" for="weddingdate">Start Date<font class="required">*</font></label>
                                    <div class="">
                                        <div class="input-group">
                                            <input type="text" class="form-control dpicker" name="startdate" placeholder="Start Date" autocomplete="off" id="my-datepicker" placeholder="Wedding Date">
                                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span> </div>
                                    </div>
                                    <span style="color: red; font-size: 12px; float: left;" id="startspan"></span>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 20px;">
                                <label class="control-label" for="phone">Start Time:<font class="required">*</font></label>
                                <div class="">
                                  <select name="start_time" id="start_time"  class="form-control">
                                    <option disabled="" selected="" value="0">Start Time</option>
                                      <?php
                                      $event_start= explode(" ", $space_detail['from_time']);
                                      $event_end= explode(" ", $space_detail['to_time']);
                                      $start_time = $event_start[0].":00 ".strtolower($event_start[1]);
                                      $end_time = $event_end[0].":00 ".strtolower($event_end[1]);

                                      $date2 = date('H:i',strtotime($start_time));
                                      $date3 = date('H:i',strtotime($end_time));
                                      for ($l=0; $l < count($timings); $l++) 
                                          {   
                                            $cur1= explode(" ", $timings[$l]->value);
                                            $cur2 = $cur1[0].":00 ".strtolower($cur1[1]);
                                            $date1 = date('H:i', strtotime($cur2));
                                            $is_disable = "disabled";
                                            $style = "style='color:#cccccc;'";
                                            
                                            if ($date2 >= $date3) {
                                              if ($date1 >= $date2 ) {
                                                $is_disable = "";
                                                $style = "";
                                              }
                                            if ($date1 <= $date3 ) {
                                                $is_disable = "";
                                                $style = "";
                                              }
                                            }else{
                                              if ($date1 >= $date2 && $date1 <= $date3) {
                                                $is_disable = "";
                                                $style = "";
                                              }
                                            }
                                            
                                          ?>
                                            <option value="<?php echo $timings[$l]->value?>" <?php echo $is_disable." ".$style; ?> 
                                            <?php
                                              if ($current_date) {
                                                if (in_array($date1, $time_array)) {
                                                  echo "disabled ";
                                                  echo " style='color:#cccccc;'";
                                                }
                                              }
                                            ?>>
                                            <?php echo date('h:i a', strtotime($cur2)); ?>
                                              
                                            </option>

                                            <?php
                                          }
                                        ?>
                                  </select>
                                </div>
                                <span style="color: red; font-size: 12px; float: left;"></span>
                            </div>
                            <!-- Multiple Radios -->
                            <!-- Text input-->
                            <div class="default-calender">
                                <div class="col-md-6" style="margin-bottom: 20px;">
                                    <label class="control-label" for="weddingdate">End Date<font class="required">*</font></label>
                                    <div class="">
                                        <div class="input-group">
                                            <input type="text" class="form-control dpicker" name="enddate" placeholder="End Date" autocomplete="off" id="my-datepicker2" placeholder="Wedding Date">
                                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span> </div>
                                    </div>
                                    <span style="color: red; font-size: 12px; float: left;"  id="endspan"></span>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 20px;">
                                <label class="control-label" for="phone">End Time:<font class="required">*</font></label>
                                <div class="">
                                  <select  name="end_time" id="end_time"  class="form-control">
                                    <option disabled="" selected="" value="0">End Time</option>
                                      <?php
                                        for ($l=0; $l < count($timings); $l++) 
                                            {   
                                              $cur1= explode(" ", $timings[$l]->value);
                                              $cur2 = $cur1[0].":00 ".strtolower($cur1[1]);
                                              $date1 = date('H:i', strtotime($cur2));
                                              $is_disable = "disabled";
                                              $style = "style='color:#cccccc;'";
                                              if ($date2 >= $date3) {
                                                if ($date1 >= $date2 ) {
                                                  $is_disable = "";
                                                  $style = "";
                                                }
                                              if ($date1 <= $date3 ) {
                                                  $is_disable = "";
                                                  $style = "";
                                                }
                                              }else{
                                                if ($date1 >= $date2 && $date1 <= $date3) {
                                                  $is_disable = "";
                                                  $style = "";
                                                }
                                              }
                                              
                                            ?>
                                              <option value="<?php echo $timings[$l]->value?>" <?php echo $is_disable." ".$style; ?>
                                              <?php
                                                if ($current_date) {
                                                  if (in_array($date1, $time_array)) {
                                                    echo "disabled ";
                                                    echo " style='color:#cccccc;'";
                                                  }
                                                }
                                              ?>><?php echo date('h:i a', strtotime($cur2)); ?></option>

                                              <?php
                                            }
                                      ?>
                                    </select>
                                </div>
                                <span style="color: red; font-size: 12px; float: left;"></span>
                            </div>
                            <!-- Multiple Radios -->
                            <div class="col-md-12">
                              <div class="input-container" style="border-bottom: 1px solid #ccc; border-top: 1px solid #ccc; padding: 10px 0; margin-top: 15px; font-style: italic;">
                                <div >
                                  <span style="float: left;">Space Price: ₹ <b id="base_price1"><?php echo $space_detail['base_price']; ?></b></span>
                                  <span style="float: right;">₹ <b id="base_price"><?php echo $space_detail['base_price']; ?></b></span>
                                </div>
                                <br>
                                <div >
                                  <span style="float: left;">Service Tax:</span>
                                  <span style="float: right;"><b>₹ 0</b></span>
                                </div>
                                <br>
                                <div >
                                  <span style="float: left;">Estimated Price:</b></span>
                                  <span style="float: right;">₹ <b id="estimated"><?php echo $space_detail['base_price']; ?></b></span>
                                </div>
                              </div>
                              <input type="hidden" name="amount" id="total_amount">
                              <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
                            </div>
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary btn-lg " id="send_button">Add To Cart</button>
                                <button type="button" class="btn btn-default btn-lg " onclick="window.location.replace('<?php echo base_url();?>home/scenario_space');">Back to search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
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
    $('#send_button').click(function() {
      //e.preventDefault();
      var time_array = $('#time_array').val();
      var events = $('#events option:selected').val();
      var guests = $('#guests option:selected').val();
      var startdate = $('#my-datepicker').val();
      var enddate = $('#my-datepicker2').val();
      var start_time = $('#start_time option:selected').val();
      var end_time = $('#end_time option:selected').val();
      var user_id = $('#user_id').val();
      var space_id = $('#space_id').val();
      var total_amount = $('#total_amount').val();
      
        if (user_id == 0 ) {
        $('#signin-box').modal('show');
        return false;
      }

      if (events == null) {alert_pop('Please select an event!'); return false;}
      if (guests == 0) {$('#guests').css('border-color', 'red'); return false;}else{ $('#guests').css('border-color', ''); }
      if (startdate == '') {$('#my-datepicker').css('border-color', 'red'); return false;}else{ $('#my-datepicker').css('border-color', ''); }
      if (enddate == '') {$('#my-datepicker2').css('border-color', 'red'); return false;}else{ $('#my-datepicker2').css('border-color', ''); }
      if (start_time == 0) {$('#start_time').css('border-color', 'red'); return false;}else{ $('#start_time').css('border-color', ''); }
      if (end_time == 0) {$('#end_time').css('border-color', 'red'); return false;}else{ $('#end_time').css('border-color', ''); }
      

      if (time_array != null) {

          $.ajax({
          type : "POST",
          data : {time_array:time_array, start_time:start_time, end_time:end_time},
          url : "<?php echo base_url();?>home/between_dates",
          success : function(data){
            if (data == 1) {
              $('#already').removeClass("sr-only");
               window.scrollBy(0, -200);
              return false;
            }
            else{
              $.ajax({
                      type: "POST",
                      url: "<?php echo base_url();?>home/cart_space",
                      data: { space_id: space_id,user_id: user_id, event_id:events, guest_id:guests, startdate:startdate, enddate:enddate, start_time:start_time, end_time:end_time, amount:total_amount},
                      success: function(result) {
                        result = parseInt(result);
                        //alert(result);
                        if(result > 0) {

                          $('#send_button').text('Added Successfully');
                          $('#send_button').addClass('disabled');
                          $('#submit_form')[0].reset();
                          $("#base_price1").text('<?php echo $space_detail['base_price']; ?>');
                          $("#base_price").text('<?php echo $space_detail['base_price']; ?>');
                          $("#estimated").text('0');
                          return false;
                        }
                      }


                    });    
            }
          }
        });

      }

    });

    function alert_pop(msg){
     $.alert({
        title: 'Already Booked',
        content: msg,
        confirmButton: 'okay',
        confirmButtonClass: 'btn-info',
        animation: 'bottom',
        icon: 'fa fa-check',
        opacity: 2,  
        backgroundDismiss: true
    });
  }
</script>
 <script type="text/javascript">
    $('body').on('focus', ".dpicker", function () {
    $(this).datepicker();
});

$(function () {
    $("#my-datepicker").datepicker({
        minDate: 0,
        changeMonth: true,
        dateFormat: 'mm/dd/yy',
        onClose: function (selectedDate, instance) {
            if (selectedDate != '') {
                $("#my-datepicker2").datepicker("option", "minDate", selectedDate);
                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                date.setMonth(date.getMonth() + 3);
               var minDate2 = new Date(selectedDate);
               minDate2.setDate(minDate2.getDate());
                // minDate2.setDate(minDate2.getDate() + 1); will give next date
                
                $("#my-datepicker2").datepicker("option", "minDate", minDate2);
                $("#my-datepicker2").datepicker("option", "maxDate", date);
            }
        }
    });
    $("#my-datepicker2").datepicker({
        minDate: 0,
        changeMonth: true,
        dateFormat: 'mm/dd/yy',
        onClose: function (selectedDate) {
            //$("#my-datepicker").datepicker("option", "maxDate", null);
            var start = $("#my-datepicker").datepicker("getDate");
            if(start != null){
            var end = $("#my-datepicker2").datepicker("getDate");
            var days = (end - start) / (1000 * 60 * 60 * 24);
            if (days == 0) {
              days = 1;
            }
            //$("#TextBox3").val(days);
            //////////// DECIDE AMOUNT //////////////
            $("#base_price1").text('<?php echo $space_detail['base_price']; ?> x '+days);
            $("#base_price").text(<?php echo $space_detail['base_price']; ?> * days);
            $("#estimated").text(<?php echo $space_detail['base_price']; ?> * days);
            $("#total_amount").val(<?php echo $space_detail['base_price']; ?> * days);
          }
        }
    });

    
});
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