 <?php $this->load->view('frontend/topmenu'); ?>
<div class="main-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 side-nav" id="leftCol">
                    <div class="">
                        <ul class="listnone nav" id="sidebar">
                            <li class="active"><a href="<?php echo base_url();?>home/servicelist">Listing Services</a></li>
                            <li><a href="<?php echo base_url();?>home/list_ofservice">List My Service</a></li>
                            <li><a href="<?php echo base_url();?>home/favourites_services">Favourite Services</a></li>
                            <li><a href="<?php echo base_url();?>home/service_request">Service Request</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10 content-right profile-dashboard">
                    <div class="row">
                        <div class="col-md-12 dashboard-form">
                          <div class="bg-white pinside40 mb30">
                            <form  id="space_form" method="POST" action="<?php echo base_url();?>home/editservice/<?php if($service_detail){ echo $service_detail['uni_id'];}?>" enctype="multipart/form-data">
                               <?php
                                if($this->session->flashdata('message')!="" && $this->session->flashdata('message')!=null)
                                {
                                ?>
                                <center><font color="green"><?php echo $this->session->flashdata('message');?></font></center>
                                <br>
                                <br>
                                <?php
                                } 
                                if($this->session->flashdata('message1')!="" && $this->session->flashdata('message1')!=null)
                                {
                                ?>
                                <center><font color="red"><?php echo $this->session->flashdata('message1');?></font></center>
                                <br>
                                <br>
                                <?php
                                } 
                              ?>
                              <!-- Form Name -->
                              <h2 class="form-title">Edit Service Details</h2>
                              <div class="row">
                                <div class="col-md-6">
                              <!-- Text input-->
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="title">Service Provider<span class="required">*</span></label>
                                    <div class="col-md-12">
                                      <input type="text" name="company" id="company" value="<?php if($service_detail){  echo $service_detail['company'];}?>" placeholder="Service Provider" class="form-control input-md" required="">
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6"> 
                                      <!-- Select Basic -->
                                      <div class="form-group">
                                        <label class=" control-label" for="categorytype">Select Service Type</label>
                                        <div class=" ">
                                          <select class="form-control" name="service_type" id="service_type">
                                            <option value="" disabled="" >Select Service Type</option>
                                            <?php
                                              for ($i = 0; $i < count($service); $i++) 
                                              {                     
                                                ?>
                                                <option value="<?php echo $service[$i]->service_id;?>"<?php if($service_detail){ if($service_detail['service_id'] != $service[$i]->service_id){ echo "style='display:none;'";}else{ echo "selected"; }}?>><?php echo $service[$i]->service_name;?></option>
                                                <?php
                                              }
                                            ?>
                                        </select>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6"> 
                                      <!-- Select Basic -->
                                      <div class="form-group">
                                        <label class="control-label" for="seatcapacity">Number Of Guests</label>
                                        <div class=" ">
                                          <select  name="guest" id="guest" class="form-control">
                                            <option value="1" <?php if($service_detail){ if($service_detail['guest'] == 1){ echo "Selected";}}?>>0-100 Guests</option>
                                            <option value="2" <?php if($service_detail){ if($service_detail['guest'] == 2){ echo "Selected";}}?>>100-200 Guests</option>
                                            <option value="3" <?php if($service_detail){ if($service_detail['guest'] == 3){ echo "Selected";}}?>>200-300 Guests</option>
                                            <option value="4" <?php if($service_detail){ if($service_detail['guest'] == 4){ echo "Selected";}}?>>300-400 Guests</option>
                                            <option value="5" <?php if($service_detail){ if($service_detail['guest'] == 5){ echo "Selected";}}?>>400-500 Guests</option>
                                            <option value="6" <?php if($service_detail){ if($service_detail['guest'] == 6){ echo "Selected";}}?>>500&Up Guests</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <h2 class="form-title mt30">Service Address</h2>
                                  <div class="row">
                                    <div class="col-md-4"> 
                                      <!-- Text input-->
                                      <div class="form-group">
                                        <label class=" control-label" for="country">Country<span class="required">*</span></label>
                                        <div class="">
                                          <select name="country" id="country" onchange="LoadStates(this.value);" class="form-control">
                                            <option value="" disabled="" selected="">Select Country</option>
                                            <?php
                                            if($country_result)
                                            {
                                              for ($i = 0; $i < count($country_result); $i++) 
                                              {                     
                                                ?>
                                               <option value="<?php echo $country_result[$i]->location_id;?>"<?php if($service_detail){ if($service_detail['country'] == $country_result[$i]->location_id){ echo "Selected";}}?>><?php echo $country_result[$i]->location_name;?></option>
                                                <?php
                                              }
                                            }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4"> 
                                      <!-- Text input-->
                                      <div class="form-group">
                                        <label class="control-label" for="state">State<span class="required">*</span></label>
                                        <div class="">
                                          <select class="form-control" name="state" id="state_id" onchange="LoadCities(this.value);">
                                            <option value="">Select State</option> 
                                            <?php
                                              if($state_list)
                                              {
                                                for ($j = 0; $j < count($state_list); $j++) 
                                                {                     
                                                  ?>
                                                 <option value="<?php echo $state_list[$j]->location_id;?>"<?php if($service_detail){ if($service_detail['state'] == $state_list[$j]->location_id){ echo "Selected";}}?>><?php echo $state_list[$j]->location_name;?></option>
                                                  <?php
                                                }
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4"> 
                                      <!-- Text input-->
                                      <div class="form-group">
                                        <label class="control-label" for="state">City<span class="required">*</span></label>
                                        <div class="">
                                          <select class="form-control" name="city" id="city">
                                            <option value="">Select City</option>
                                            <?php
                                              if($city_list)
                                              {
                                                for ($k = 0; $k < count($city_list); $k++) 
                                                {                     
                                                  ?>
                                                 <option value="<?php echo $city_list[$k]->location_id;?>"<?php if($service_detail){ if($service_detail['city'] == $city_list[$k]->location_id){ echo "Selected";}}?>><?php echo $city_list[$k]->location_name;?></option>
                                                  <?php
                                                }
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="">
                                      <label class="col-md-12 control-label" for="address">Address<span class="required">*</span></label>
                                      <div class="col-md-12">
                                        <input type="text" class="form-control" name="address" id="searchTextField" width="100px" placeholder="Enter your address" value="<?php if($service_detail){ echo $service_detail['address'];}?>" style="direction: ltr;" required="">
                                      </div>
                                        <input name="latitude" class="MapLat" value="<?php if($service_detail){ echo $service_detail['lat'];}?>" type="hidden" placeholder="Latitude" >
                                        <input name="longitude" class="MapLon" value="<?php if($service_detail){ echo $service_detail['lon'];}?>" type="hidden" placeholder="Longitude">
                                        <div id="map_canvas" style="height: 350px;width: 500px;margin: 0.6em; display: none;"></div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Zip Code<span class="required">*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control red-tooltip" name="zip_code" onkeypress="return isNum(event)" data-toggle="tooltip" value="<?php if($service_detail){ echo $service_detail['zip_code'];}?>" data-placement="bottom" title="Use numbers only!!" maxlength="10" placeholder="Enter Zip Code" required="">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Landmark<span class="required">*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" required="" value="<?php if($service_detail){ echo $service_detail['landmark'];}?>" class="form-control" name="landmark"  width="100px" placeholder="Enter Land Mark" >
                                    </div>
                                  </div>
                                  <!-- Textarea -->
                                  <h2 class="form-title mt30">Packages</h2>
                                  <div class="form-group row ">
                                      <div class=" col-md-12 field_wrapper">
                                        <?php
                                          if($service_package)
                                          {
                                            for ($a = 0; $a < count($service_package); $a++) 
                                            { ?>
                                        <div class="new_wrapper">
                                            <input type="text" required="" class="form-control" value="<?php echo $service_package[$a]->package_name ?>"  name="package_name[]" value="" placeholder="Package Name" ><p></p>
                                            <textarea class="form-control" required="" name="package_description[]" id="description"  placeholder="Describe your Package in a few words" rows="3"><?php echo $service_package[$a]->package_description ?></textarea><p></p>
                                            <input type="text" required="" class="form-control" value="<?php echo $service_package[$a]->package_price ?>" name="package_price[]"  width="100px" placeholder="Price for Package" >
                                            <input type="hidden" name="package_id[]" value="<?php echo $service_package[$a]->package_id ?>">
                                        </div>
                                        <p></p>
                                        <?php }
                                          }
                                        ?>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Discount To Offer<span class="required">*</span></label>
                                      <div class="col-md-12">
                                        <input type="text"  name="discount" id="discount" value="<?php echo $service_detail['discount'] ?>" onkeypress='return isNum(event)' placeholder="Discount In Percent" class="form-control input-md" required="" maxlength="2">
                                    </div>
                                  </div>
                                  <?php
                                    $fixed = '';$adapt = ''; 
                                    if($service_detail)
                                    { 
                                      if($service_detail['price_type'] == "fixed")
                                        $fixed = "checked";
                                      else
                                        $adapt = "checked";
                                    }
                                  ?>
                                  <div class="form-group row">
                                    <div class="myinput">
                                      <label class="col-md-12 control-label" for="price">Price Type<span class="required">*</span></label>
                                      <div class="col-md-12 radio-info">
                                        <label class="radio-info"><input type="radio" width="100px" name="price" <?php if($fixed){ echo $fixed ;}?> id="fixed" value="fixed">&nbsp;<span style="font-size: 15px;"> Fixed</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="radio-primary"><input type="radio" width="100px" <?php if($adapt){ echo $adapt ;}?> name="price" id="adapts" value="negotiable" checked>&nbsp;<span style="font-size: 15px;"> Negotiable</span></label>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Booking Hours<span class="required">*</span></label>
                                      <div class="col-md-12">
                                        <input type="text" class="form-control input-md" required="" name="min_hr" id="min_hr" value="<?php if($service_detail){ echo $service_detail['min_hrs'];}?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Minimum hours of booking required">
                                    </div>
                                  </div> -->

                                </div>
                                <!-- Text input2-->
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Service Images<span class="required">*</span></label>
                                    <div class="col-md-12">
                                      <a class="btn btn-danger" href="<?php echo base_url();?>home/editservice_image/<?php if($service_detail){ echo $service_detail['uni_id'];}?>" >Edit Images</a>
                                    </div>
                                  </div>
                                  <div class="row"> 
                                    <div class="form-group ">
                                      <?php
                                        $mon = '';$tue = '';$wed = '';$thur = '';$fri = '';$sat = '';$sun = '';
                                        if($service_days)
                                        {
                                          for ($i=0; $i < count($service_days) ; $i++) 
                                          { 
                                            if($service_days[$i]->day_id == 1)
                                              $mon = "checked";
                                            if($service_days[$i]->day_id == 2)
                                              $tue = "checked";
                                            if($service_days[$i]->day_id == 3)
                                              $wed = "checked";
                                            if($service_days[$i]->day_id == 4)
                                              $thur = "checked";
                                            if($service_days[$i]->day_id == 5)
                                              $fri = "checked";
                                            if($service_days[$i]->day_id == 6)
                                              $sat = "checked";
                                            if($service_days[$i]->day_id == 7)
                                              $sun = "checked"; 
                                          }
                                        }
                                       ?>
                                      <div class="col-lg-12">
                                        <p><b>Availability</b></p>
                                        <input type="checkbox" class="form-control-chk" onclick="toggle(this);" />&nbsp;&nbsp;<span style="" id="change"><b>Select all</b></span>
                                      </div>
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="1" <?php if($mon){ echo $mon;}?> class="form-control-chk">&nbsp;Monday
                                      </div>
                                       <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="2" <?php if($tue){ echo $tue;}?> class="form-control-chk">&nbsp;Tuesday
                                      </div>
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="3" <?php if($wed){ echo $wed;}?> class="form-control-chk">&nbsp;Wednesday
                                      </div>
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="4" <?php if($thur){ echo $thur;}?> class="form-control-chk">&nbsp;Thursday
                                      </div>
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="5" <?php if($fri){ echo $fri;}?> class="form-control-chk">&nbsp;Friday
                                      </div> 
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="6" <?php if($sat){ echo $sat;}?> class="form-control-chk">&nbsp;Saturday
                                      </div>
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="7" <?php if($sun){ echo $sun;}?> class="form-control-chk">&nbsp;Sunday
                                      </div>
                                    </div>
                                  </div>
                                  <br>
                                  <div class="form-group row">
                                    <div class="col-md-6"> 
                                      <!-- Text input-->
                                      <div class="form-group">
                                        <label class=" control-label" for="country">From Time<span class="required">*</span></label>
                                        <div class="">
                                          <select class="form-control" name="from_time" id="from_time">
                                            <option value="">From Time</option>
                                            <option value="12 AM" <?php if($service_detail){ if($service_detail['from_time'] == "12 AM"){ echo "Selected";}}?>>12:00am</option>
                                            <option value="1 AM" <?php if($service_detail){ if($service_detail['from_time'] == "1 AM"){ echo "Selected";}}?>>1:00am</option>
                                            <option value="2 AM" <?php if($service_detail){ if($service_detail['from_time'] == "2 AM"){ echo "Selected";}}?>>2:00am</option>
                                            <option value="3 AM" <?php if($service_detail){ if($service_detail['from_time'] == "3 AM"){ echo "Selected";}}?>>3:00am</option>
                                            <option value="4 AM" <?php if($service_detail){ if($service_detail['from_time'] == "4 AM"){ echo "Selected";}}?>>4:00am</option>
                                            <option value="5 AM" <?php if($service_detail){ if($service_detail['from_time'] == "5 AM"){ echo "Selected";}}?>>5:00am</option>
                                            <option value="6 AM" <?php if($service_detail){ if($service_detail['from_time'] == "6 AM"){ echo "Selected";}}?>>6:00am</option>
                                            <option value="7 AM" <?php if($service_detail){ if($service_detail['from_time'] == "7 AM"){ echo "Selected";}}?>>7:00am</option>
                                            <option value="8 AM" <?php if($service_detail){ if($service_detail['from_time'] == "8 AM"){ echo "Selected";}}?>>8:00am</option>
                                            <option value="9 AM" <?php if($service_detail){ if($service_detail['from_time'] == "9 AM"){ echo "Selected";}}?>>9:00am</option>
                                            <option value="10 AM" <?php if($service_detail){ if($service_detail['from_time'] == "10 AM"){ echo "Selected";}}?>>10:00am</option>
                                            <option value="11 AM" <?php if($service_detail){ if($service_detail['from_time'] == "11 AM"){ echo "Selected";}}?>>11:00am</option>
                                            <option value="12 PM" <?php if($service_detail){ if($service_detail['from_time'] == "12 PM"){ echo "Selected";}}?>>12:00pm</option>
                                            <option value="1 PM" <?php if($service_detail){ if($service_detail['from_time'] == "1 PM"){ echo "Selected";}}?>>1:00pm</option>
                                            <option value="2 PM" <?php if($service_detail){ if($service_detail['from_time'] == "2 PM"){ echo "Selected";}}?>>2:00pm</option>
                                            <option value="3 PM" <?php if($service_detail){ if($service_detail['from_time'] == "3 PM"){ echo "Selected";}}?>>3:00pm</option>
                                            <option value="4 PM" <?php if($service_detail){ if($service_detail['from_time'] == "4 PM"){ echo "Selected";}}?>>4:00pm</option>
                                            <option value="5 PM" <?php if($service_detail){ if($service_detail['from_time'] == "5 PM"){ echo "Selected";}}?>>5:00pm</option>
                                            <option value="6 PM" <?php if($service_detail){ if($service_detail['from_time'] == "6 PM"){ echo "Selected";}}?>>6:00pm</option>
                                            <option value="7 PM" <?php if($service_detail){ if($service_detail['from_time'] == "7 PM"){ echo "Selected";}}?>>7:00pm</option>
                                            <option value="8 PM" <?php if($service_detail){ if($service_detail['from_time'] == "8 PM"){ echo "Selected";}}?>>8:00pm</option>
                                            <option value="9 PM" <?php if($service_detail){ if($service_detail['from_time'] == "9 PM"){ echo "Selected";}}?>>9:00pm</option>
                                            <option value="10 PM" <?php if($service_detail){ if($service_detail['from_time'] == "10 PM"){ echo "Selected";}}?>>10:00pm</option>
                                            <option value="11 PM" <?php if($service_detail){ if($service_detail['from_time'] == "11 PM"){ echo "Selected";}}?>>11:00pm</option> 
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6"> 
                                      <!-- Text input-->
                                      <div class="form-group">
                                        <label class=" control-label" for="country">To Time<span class="required">*</span></label>
                                        <div class="">
                                          <select class="form-control" name="to_time" id="to_time">
                                            <option value="">To Time</option>
                                            <option value="12 AM" <?php if($service_detail){ if($service_detail['to_time'] == "12 AM"){ echo "Selected";}}?>>12:00am</option>
                                            <option value="1 AM" <?php if($service_detail){ if($service_detail['to_time'] == "1 AM"){ echo "Selected";}}?>>1:00am</option>
                                            <option value="2 AM" <?php if($service_detail){ if($service_detail['to_time'] == "2 AM"){ echo "Selected";}}?>>2:00am</option>
                                            <option value="3 AM" <?php if($service_detail){ if($service_detail['to_time'] == "3 AM"){ echo "Selected";}}?>>3:00am</option>
                                            <option value="4 AM" <?php if($service_detail){ if($service_detail['to_time'] == "4 AM"){ echo "Selected";}}?>>4:00am</option>
                                            <option value="5 AM" <?php if($service_detail){ if($service_detail['to_time'] == "5 AM"){ echo "Selected";}}?>>5:00am</option>
                                            <option value="6 AM" <?php if($service_detail){ if($service_detail['to_time'] == "6 AM"){ echo "Selected";}}?>>6:00am</option>
                                            <option value="7 AM" <?php if($service_detail){ if($service_detail['to_time'] == "7 AM"){ echo "Selected";}}?>>7:00am</option>
                                            <option value="8 AM" <?php if($service_detail){ if($service_detail['to_time'] == "8 AM"){ echo "Selected";}}?>>8:00am</option>
                                            <option value="9 AM" <?php if($service_detail){ if($service_detail['to_time'] == "9 AM"){ echo "Selected";}}?>>9:00am</option>
                                            <option value="10 AM" <?php if($service_detail){ if($service_detail['to_time'] == "10 AM"){ echo "Selected";}}?>>10:00am</option>
                                            <option value="11 AM" <?php if($service_detail){ if($service_detail['to_time'] == "11 AM"){ echo "Selected";}}?>>11:00am</option>
                                            <option value="12 PM" <?php if($service_detail){ if($service_detail['to_time'] == "12 PM"){ echo "Selected";}}?>>12:00pm</option>
                                            <option value="1 PM" <?php if($service_detail){ if($service_detail['to_time'] == "1 PM"){ echo "Selected";}}?>>1:00pm</option>
                                            <option value="2 PM" <?php if($service_detail){ if($service_detail['to_time'] == "2 PM"){ echo "Selected";}}?>>2:00pm</option>
                                            <option value="3 PM" <?php if($service_detail){ if($service_detail['to_time'] == "3 PM"){ echo "Selected";}}?>>3:00pm</option>
                                            <option value="4 PM" <?php if($service_detail){ if($service_detail['to_time'] == "4 PM"){ echo "Selected";}}?>>4:00pm</option>
                                            <option value="5 PM" <?php if($service_detail){ if($service_detail['to_time'] == "5 PM"){ echo "Selected";}}?>>5:00pm</option>
                                            <option value="6 PM" <?php if($service_detail){ if($service_detail['to_time'] == "6 PM"){ echo "Selected";}}?>>6:00pm</option>
                                            <option value="7 PM" <?php if($service_detail){ if($service_detail['to_time'] == "7 PM"){ echo "Selected";}}?>>7:00pm</option>
                                            <option value="8 PM" <?php if($service_detail){ if($service_detail['to_time'] == "8 PM"){ echo "Selected";}}?>>8:00pm</option>
                                            <option value="9 PM" <?php if($service_detail){ if($service_detail['to_time'] == "9 PM"){ echo "Selected";}}?>>9:00pm</option>
                                            <option value="10 PM" <?php if($service_detail){ if($service_detail['to_time'] == "10 PM"){ echo "Selected";}}?>>10:00pm</option>
                                            <option value="11 PM" <?php if($service_detail){ if($service_detail['to_time'] == "11 PM"){ echo "Selected";}}?>>11:00pm</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row" style="padding-top: 10px;">
                                    <div class="col-md-12 text-center">
                                       <button class="btn btn-default"  name="commit" type="submit">Send for review</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script type="text/javascript">

  $(document).ready(function() {
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });


$('#service_form').validationEngine('attach'); 
function openfileDialog() {
  $("#fileLoader").click();
}
function LoadStates(id) {
  $.ajax({
      url: "<?php echo base_url();?>home/get_states/" + id, 
      success: function(result) {
        $('#state_id').html(result);
      },
      complete: function(){
        var c = $('#state_id').val();
        LoadCities(c);
      }
    });
}
function LoadCities(id) {
  $.ajax({
      url: "<?php echo base_url();?>home/get_cities/" + id, 
      success: function(result) {
        $('#city').html(result);
      }
    });
}
$("#service_form").submit(function(e) {
    if ($('input[name="days[]"]:checked').length == 0) {
      e.preventDefault();
      alert_pop('Please select days in Availability'); 
      return false;
    }
    else if(document.getElementById("fileLoader").value == ""){
      alert_pop('Please upload at least one image');  
      return false;
    } 
    else if($('#verified').val() == 0){
      alert_pop('Please verify your mobile number first'); 
      return false;
    }
    return true;
}); 
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
<script type="text/javascript">
  
 $("#fileLoader").on('change', function () {
 
     var countFiles = $(this)[0].files.length;
 
     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#preview-image");
     image_holder.empty();
 
     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {
 
             for (var i = 0; i < countFiles; i++) {
 
                 var reader = new FileReader();
                 reader.onload = function (e) {
                  var file = e.target;
                  // $("<span class='pip'>" +
                  //   "<img class='imageThumb' src='" + e.target.result + "' title='" + file.name + "'/>" +
                  //   "<br/><span class='remove'>x</span>" +
                  //   "</span>").appendTo(image_holder);
                  // $(".remove").click(function(){
                  //   $(this).parent(".pip").remove();
                  // });
                     $("<img />", {
                         "src": e.target.result,
                             "class": "thumbimage"
                     }).appendTo(image_holder);
                 }
 
                 image_holder.show();
                 reader.readAsDataURL($(this)[0].files[i]);
             }
 
         } else {
             alert("It doesn't supports");
         }
     } else {
         alert("Select Only images");
     }
 });
 </script>
 <script type="text/javascript">
   function toggle(source) {
    var checkboxes = document.querySelectorAll('input[name="days[]"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }

}

 </script>
 <script>
     $(function () {
         var lat = 44.88623409320778,
             lng = -87.86480712897173,
             latlng = new google.maps.LatLng(lat, lng),
             image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
         //zoomControl: true,
         //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,
         var mapOptions = {
             center: new google.maps.LatLng(lat, lng),
             zoom: 13,
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
                 map: map,
                 icon: image
             });
         var input = document.getElementById('searchTextField');
         var autocomplete = new google.maps.places.Autocomplete(input, {
             types: ["geocode"]
         });
         autocomplete.bindTo('bounds', map);
         var infowindow = new google.maps.InfoWindow();
         google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
             infowindow.close();
             var place = autocomplete.getPlace();
             if (place.geometry.viewport) {
                 map.fitBounds(place.geometry.viewport);
             } else {
                 map.setCenter(place.geometry.location);
                 map.setZoom(17);
             }
             moveMarker(place.name, place.geometry.location);
             $('.MapLat').val(place.geometry.location.lat());
             $('.MapLon').val(place.geometry.location.lng());
         });
         google.maps.event.addListener(map, 'click', function (event) {
             $('.MapLat').val(event.latLng.lat());
             $('.MapLon').val(event.latLng.lng());
             infowindow.close();
                     var geocoder = new google.maps.Geocoder();
                     geocoder.geocode({
                         "latLng":event.latLng
                     }, function (results, status) {
                         console.log(results, status);
                         if (status == google.maps.GeocoderStatus.OK) {
                             console.log(results);
                             var lat = results[0].geometry.location.lat(),
                                 lng = results[0].geometry.location.lng(),
                                 placeName = results[0].address_components[0].long_name,
                                 latlng = new google.maps.LatLng(lat, lng);
                             moveMarker(placeName, latlng);
                             $("#searchTextField").val(results[0].formatted_address);
                         }
                     });
         });
        
         function moveMarker(placeName, latlng) {
             marker.setIcon(image);
             marker.setPosition(latlng);
             infowindow.setContent(placeName);
             //infowindow.open(map, marker);
         }
     });
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
function isNum(evt){

  evt =(evt)? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode<48 || charCode >57)){

    return false;
  }
return true;
}
</script>
<script type="text/javascript">
  $(window).on('load',function(){
        $('#myservice').modal('show');
    });

  $('#closeservice').click(function(){
   window.location.replace("<?php echo base_url();?>home/servicelist");
  });
</script>
<script type="text/javascript">
  $('#price').text('0');
  $('#percent').text('0');

  $('#select_service').change(function() {
     var $option = $(this).find('option:selected');
    //Added with the EDIT
    var service = $option.val();
    //alert(service);
    $.post('<?php echo base_url();?>home/check_service_subscription', {service_id:service}, function(data){
      if (data != 0) {
        var my_arr = data.split("|");
        if(my_arr[0] > 0){
            if (my_arr[1] == 1) { var plan = 'Yearly'; }else{ var plan = 'Pay as Use'; }
              alert_pop('You have already subscribed '+plan+' plan for this service you can continue');
            $('#subscription_id').val(my_arr[2]);
            $("#service_type").children('option').hide();
            $("#service_type").children("option[value=" + service + "]").show();
            $('#myservice').modal('hide');
          }
      }else{
        return false;
      }
    });
    var value = $option.attr('data-price');
    var plan = $option.attr('data-plan');
    $('#price').text(value);
    $('#percent').text(plan);


  });

  function alert_pop(msg){
     $.alert({
        title: 'Thank You',
        content: msg,
        confirmButton: 'continue',
        confirmButtonClass: 'btn-info',
        animation: 'zoom',
        icon: 'fa fa-thumbs-up',
        opacity: 2,  
        backgroundDismiss: true
    });
  }
</script>
<script type="text/javascript">
  $('#yearly').on('click',function(){
      var price = $('#price').text();
      if(price == '0' )
      {
        $('#valid_ser').text('Please Select Service');
        $('#valid_ser').hide(100);
        $('#valid_ser').show(100);
        return false;
      }
      var plan_id = 1;
      var plan_type = 'yearly';
      var service_id = $('#select_service').find(":selected").val();
      var amount = $('#select_service').find(":selected").attr('data-price');

      $.post('<?php echo base_url();?>home/service_subscribe', {service_id:service_id, plan_id:plan_id, plan_type:plan_type, amount:amount}, function(data){
        if (data > 0) {
          $('#subscription_id').val(data);
          $('#myservice').modal('hide');
          $("#service_type").children('option').hide();
          $("#service_type").children("option[value=" + service_id + "]").show();
          alert_pop('Congratulations You Have Successfully Subscribed');
        }else{
          alert('failed');
        }
      });

    });

  $('#pay_use').on('click',function(){
      var price = $('#percent').text();
      if(price == '0' )
      {
        $('#valid_ser').text('Please Select Service');
        $('#valid_ser').hide(100);
        $('#valid_ser').show(100);
        return false;
      }
      var plan_id = 2;
      var plan_type = 'pay_as_use';
      var service_id = $('#select_service').find(":selected").val();
      var amount = $('#select_service').find(":selected").attr('data-plan');

      $.post('<?php echo base_url();?>home/service_subscribe', {service_id:service_id, plan_id:plan_id, plan_type:plan_type, amount:amount}, function(data){
        if (data > 0) {
          $('#subscription_id').val(data);
          $('#myservice').modal('hide');
          $("#service_type").children('option').hide();
          $("#service_type").children("option[value=" + service_id + "]").show();
          alert_pop('Congratulations You Have Successfully Subscribed');
        }else{
          alert('failed');
        }
      });

    });
</script>