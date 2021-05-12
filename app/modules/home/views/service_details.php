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
                    </div>
                    <a href="#inquiry" class="btn btn-default btn-lg btn-block">Book Service</a> </div>
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
                                <table class="table table-bordered table-sm-responsive">
                                  <tr>
                                    <th>Name</th>
                                    <th>Provides</th>
                                    <th>Price</th>
                                  </tr>
                                <?php 
                                if($service_package)
                                { 
                                  for ($l=0; $l < count($service_package); $l++) 
                                  { 
                                      
                                      ?>
                                      <tr>
                                      <td>
                                        <?php echo $service_package[$l]->package_name; ?>
                                      </td>
                                      <td>
                                        <?php echo $service_package[$l]->package_description; ?>
                                      </td>
                                      <td>
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
                                        <li class="list-group-item"><font color="red">* </font> Price Type: <b><?php if($service_detail){ echo ucfirst($service_detail['price_type']);}?></b></li>
                                        <!-- <li class="list-group-item"><font color="red">* </font> Provided For Minimum: <b><?php if($service_detail){ echo ucfirst($service_detail['min_hrs']);}?> Hours</b></li> -->
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
                        <h2>Book Now</h2>
                        <p>Fill in your details and a Service Specialist will get back to you shortly.</p>
                        <div class="alert alert-danger sr-only" role="alert" id="already">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="$('#already').addClass('sr-only')">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Please select another time!</strong> This service has other event at this time. 
                        </div>
                      <form method="post" action="<?php echo base_url();?>home/booked_service/<?php echo $service_detail['uni_id']; ?>" id="submit_form">
                          <input type="hidden" id="time_array" value="<?php if($current_date) { echo implode(',', $time_array); }  ?>">
                          <input type="hidden" name="service_id" value="<?php echo $service_detail['service_details_id'] ?>">
                            <!-- Text input-->
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <label class="control-label" for="name-one">Packages:<font class="required">*</font></label>
                                <div class="">
                                    <select class="form-control"   name="package_id" id="package" required="">
                                       <!-- <option value="0"><b>Select Package</b></option> -->
                                       <?php

                                           if($service_detail['description'] == "")
                                              { 
                                                for ($m=0; $m < count($service_package); $m++) 
                                                {  
                                              ?>
                                                <option value="<?php echo $service_package[$m]->package_id;?>" data-price="<?php echo $service_package[$m]->package_price;?>" <?php if($m == 0){ echo "selected"; }?>><?php echo  $service_package[$m]->package_name;?></option>
                                                <?php
                                              }
                                            }
                                            else
                                            {
                                              //var_dump($service_detail); die();
                                              for ($i=0; $i < count($services); $i++) 
                                              {   
                                              ?>
                                                <option <?php if($services[$i]->service_id==$service_detail['service_id']) echo "";else echo "style='display:none'";?> value="<?php echo $services[$i]->service_id;?>"><?php echo $services[$i]->service_name;?></option>
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
                                    <option value="1" <?php if($service_detail['guest']){ if($service_detail['guest']!=1){ echo "style='display:none'";}}?>>0-100 Guests</option>
                                    <option value="2" <?php if($service_detail['guest']){ if($service_detail['guest']!=2){ echo "style='display:none'";}}?>>100-200 Guests</option>
                                    <option value="3" <?php if($service_detail['guest']){ if($service_detail['guest']!=3){ echo "style='display:none'";}}?>>200-300 Guests</option>
                                    <option value="4" <?php if($service_detail['guest']){ if($service_detail['guest']!=4){ echo "style='display:none'";}}?>>300-400 Guests</option>
                                    <option value="5" <?php if($service_detail['guest']){ if($service_detail['guest']!=5){ echo "style='display:none'";}}?>>400-500 Guests</option>
                                    <option value="6" <?php if($service_detail['guest']){ if($service_detail['guest']!=6){ echo "style='display:none'";}}?>>500&Up Guests</option>
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
                                  <span style="float: left;">Service Price: ₹ <b id="base_price1">0</b></span>
                                  <span style="float: right;">₹ <b id="base_price">0</b></span>
                                </div>
                                <br>
                                <?php if($service_detail['discount'] > 0){ ?>
                                <div >
                                  <span style="float: left;">Discount Offered:</span>
                                  <span style="float: right;"><b><?php echo $service_detail['discount'] ?> %</b></span>
                                </div>
                                <br>
                                <div >
                                  <span style="float: left;">Estimated Price:</b></span>
                                  <span style="float: right;">₹ <strike><b id="estimated">0</b></strike></span>
                                </div>
                                <br>
                                <div >
                                  <span style="float: left;">Final Price:</b></span>
                                  <span style="float: right;">₹ <b id="total_price">0</b></span>
                                </div>
                                <?php }else{ ?>
                                <div >
                                  <span style="float: left;">Estimated Price:</b></span>
                                  <span style="float: right;">₹ <strike><b id="estimated">0</b></strike></span>
                                </div>
                                <?php } ?>
                              </div>
                              <input type="hidden" name="amount" id="total_amount">
                              <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
                            </div>
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-default btn-lg" id="send_button" style="margin: 0 10px;">Send Booking Request</button>
                                <button class="btn btn-primary btn-lg" style="margin: 0 10px;" onclick="window.history.go(-1); return false;">Back</button>
                                <button type="submit" class="sr-only" name="submit" id="send_button2">Book My space Now</button>
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
    <?php
    $newdate='';
    if ($booked_date) {
        for ($m=0; $m < count($booked_date); $m++) 
            { 
                $from_date = new DateTime(date('d-m-Y',strtotime($booked_date[$m]->startdate)));
                $to_date = new DateTime(date('d-m-Y',strtotime($booked_date[$m]->enddate)));

                for($i = $from_date; $i <= $to_date; $i->modify('+1 day')){
                     $dates[] = $i->format("j-n-Y");
                }

            }
            for($n=0; $n < count($dates); $n++){
                $newdate .= '"'.$dates[$n].'", ';
            }
        }
        //print_r($dates);
        $qdate = rtrim($newdate,', ');
         $newdate = "[".$qdate."]";
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    $('#send_button').click(function(e) {
      var time_array = $('#time_array').val();
      var package = $('#package option:selected').val();
      var guests = $('#guests option:selected').val();
      var startdate = $('#my-datepicker').val();
      var enddate = $('#my-datepicker2').val();
      var start_time = $('#start_time option:selected').val();
      var end_time = $('#end_time option:selected').val();
      var user_id = $('#user_id').val();
      var uni_id = '<?php echo $service_detail['uni_id']; ?>';
      var table = 'service';
        if (user_id == 0 ) {
        $('#signin-box').modal('show');
        return false;
      }

      if (package == null) {alert_pop('Please select an event!'); window.scrollBy(0, -200); return false;}
      if (guests == 0) {$('#guests').css('border-color', 'red'); window.scrollBy(0, -200); return false;}else{ $('#guests').css('border-color', ''); }
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
            else if(data == 0){
              
              $.ajax({
                  type : "POST",
                  data : {startdate:startdate , enddate:enddate , start_time:start_time , table:table},
                  url : "<?php echo base_url();?>home/check_booking/"+uni_id,
                  success : function(data){
                    if (data == 1) {
                      $('#already').removeClass("sr-only");
                       window.scrollBy(0, -200);
                      return false;
                    }else if(data == 0){
                        $('#send_button2').click();
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
  var conceptName = $('#package').find(":selected").attr('data-price');
  $("#base_price1").text(conceptName);
  $("#base_price").text(conceptName);
  $("#estimated").text(conceptName);
  //$("#total_amount").val(conceptName);
  var discount = 100-<?php echo $service_detail['discount']; ?>;
  var final = (discount/100) * conceptName;
  $("#total_amount").val(final);
  $("#total_price").text(final);

  $('#package').change(function() {
     var $option = $(this).find('option:selected');
    //Added with the EDIT
    var value = $option.attr('data-price');//to get content of "value" attrib
    $("#base_price1").text(value);
  $("#base_price").text(value);
  $("#estimated").text(value);
  //$("#total_amount").val(value);
  var discount = 100-<?php echo $service_detail['discount']; ?>;
  var final = (discount/100) * value;
  $("#total_amount").val(final);
  $("#total_price").text(final);


  $("#my-datepicker").datepicker( "option" , {
    minDate: 0,
    maxDate: null} ).val('');
  $("#my-datepicker2").datepicker( "option" , {
    minDate: 0,
    maxDate: null} ).val('');
});

</script>
  <script type="text/javascript">
    $(document).ready(function() {
            $('body').on('focus', ".dpicker", function () {
            $(this).datepicker();
        });
    });
    var unavailableDates = <?php echo $newdate; ?>;

    // function unavailable(date) {
    //     dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
    //     if ($.inArray(dmy, unavailableDates) == -1) {
    //         return [true, ""];
    //     } else {
    //         return [false, "", "Unavailable"];
    //     }
    // }

$(function () {
    $("#my-datepicker").datepicker({
        minDate: 0,
        //beforeShowDay: unavailable,
        changeMonth: true,
        dateFormat: 'mm/dd/yy',
        onClose: function (selectedDate, instance) {
            if (selectedDate != '') {
                $("#my-datepicker2").datepicker("option", "minDate", selectedDate);
                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                date.setMonth(date.getMonth() + 3);
               var minDate2 = new Date(selectedDate);
                minDate2.setDate(minDate2.getDate()); //minDate2.getDate() + 1 will give next date
                
                $("#my-datepicker2").datepicker("option", "minDate", minDate2);
                $("#my-datepicker2").datepicker("option", "maxDate", date);
            }
        }
    });
    $("#my-datepicker2").datepicker({
        minDate: 0,
        //beforeShowDay: unavailable,
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
           var mytotal = $("#total_amount").val();
            var show = $("#base_price").text();
            //////////// DECIDE AMOUNT //////////////
            $("#base_price1").text(show +' x '+days+' days');
            $("#base_price").text(show * days);
            $("#estimated").text(show * days);
            //$("#total_amount").val(mytotal * days);
            var discount = 100-<?php echo $service_detail['discount']; ?>;
            var final = parseInt((discount/100) * (show * days));
            $("#total_amount").val(final);
            $("#total_price").text(final);
          }
        }
    });

    
});
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