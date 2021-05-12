<style type="text/css">
  .request{
    padding-left: 24px;
  }
  input.form-control2 { height: 28px; background-color: #fdfdfb; -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; border: 1px solid #e9e6e0; -webkit-box-shadow: inset 0 0px 0px rgba(0, 0, 0, .075); box-shadow: inset 0 0px 0px rgba(0, 0, 0, .075); font-family: 'Montserrat', sans-serif; padding-left: 10px; font-size: 14px;}
  input.form-control2::placeholder { 
    font-size: 12px;
    color: #999eb9;
    opacity: 1; /* Firefox */
  }
  @media (max-width:991px) {
  .request{
    padding-left: 0px;
  }
}
</style>
<link href="<?php echo base_url();?>themes/frontend/css/jquery.multiselect.css" rel="stylesheet">
 <?php $this->load->view('frontend/topmenu'); ?>
 <div class="modal fade" id="myservice" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 0px;">
        <div class="modal-header" style="background-color: #f865b0;">
          <a  id="closeservice" class="close" data-dismiss="modal">&times;</a>
          <h4 class="modal-title" style=" color: #FFF;text-align: center;">Space Subscription</h4>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                      <label for="email" style="font-size: 16px;">Select Venue:</label>
                        <select class="form-control" id="select_service">
                          <option selected="">Select Venue</option>
                            <?php
                              for ($b = 0; $b < count($venue); $b++) 
                              {                     
                                ?>
                               <option value="<?php echo $venue[$b]->venue_id;?>" data-price="<?php echo $venue[$b]->amount;?>" data-plan="<?php echo $venue[$b]->halfly;?>"><?php echo $venue[$b]->venue_name;?></option>
                                <?php
                              }
                            ?>
                        </select>
                        <span style="color: red; font-size: 12px;" id="valid_ser"></span>
                    </div>
                    <p>&nbsp;</p>
                  <div class="col-md-6 pricing-box pricing-box-regualr">
                      <div class="well-box">
                          <h2 class="price-title">Yearly</h2>
                          <h1 class="price-plan" ><span class="dollor-sign">₹</span><span id="price">75000</span><br><span class="permonth">/12 months</span></h1>
                          <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="yearly">Select Plan</a> </div>
                      <ul class="check-circle list-group">
                          <li class="list-group-item">Online Advertisement</li>
                          <li class="list-group-item">Location On Map</li>
                          <li class="list-group-item">E-mail & SMS on Every <span class="request">Request.</span></li>
                          <li class="list-group-item">Online Support</li>
                      </ul>
                  </div>
                    <div class="col-md-6 pricing-box pricing-box-regualr">
                      <div class="well-box">
                          <h2 class="price-title">Half-Yearly</h2>
                          <h1 class="price-plan"><span class="dollor-sign">₹</span><span id="percent">65</span><br><span class="permonth">/6 months</span></h1>
                          <a href="javascript:void(0)" class="btn btn-default btn-sm" id="pay_use">Select Plan</a> </div>
                      <ul class="check-circle list-group">
                          <li class="list-group-item">Online Advertisement</li>
                          <li class="list-group-item">Location On Map</li>
                          <li class="list-group-item">E-mail & SMS on Every <span class="request">Request.</span></li>
                          <li class="list-group-item">Online Support</li>
                      </ul>
                  </div>
                </div>      
                  
        </div>
      </div>
      
    </div>
  </div>
<div class="main-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 side-nav" id="leftCol">
                    <div class="hide-side">
                        <ul class="listnone nav" id="sidebar">
                            <li><a href="<?php echo base_url();?>home/spacelist">Listing Spaces</a></li>
                            <li class="active"><a href="<?php echo base_url();?>home/list_ofspace">List My Space</a></li>
                            <li><a href="<?php echo base_url();?>home/favourites">Favourite Spaces</a></li>
                            <li><a href="<?php echo base_url();?>home/space_request">Space Request</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10 content-right profile-dashboard">
                    <div class="row">
                        <div class="col-md-12 dashboard-form">
                          <div class="bg-white pinside40 mb30">
                            <form  id="space_form" method="POST" action="<?php echo base_url();?>home/list_ofspace" enctype="multipart/form-data">
                              <input type="hidden" name="subscription_id" id="subscription_id">
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
                              <h2 class="form-title">Add Space Details</h2>
                              <div class="row">
                                <div class="col-md-6">
                              <!-- Text input-->
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="title">Space Title<span class="required">*</span></label>
                                    <div class="col-md-12">
                                      <input type="text" name="space_title" id="space_title" value="" placeholder="Space Title" class="form-control input-md" required="">
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6"> 
                                      <!-- Select Basic -->
                                      <div class="form-group">
                                        <label class=" control-label" for="categorytype">Venue Type</label>
                                        <div class=" ">
                                          <select name="venue_id" id="venue_id" class="form-control" required="">
                                            <option disabled="" selected="">Select Venue</option>
                                              <?php
                                                for ($a = 0; $a < count($venue); $a++) 
                                                {                     
                                                  ?>
                                                 <option value="<?php echo $venue[$a]->venue_id;?>"><?php echo $venue[$a]->venue_name;?></option>
                                                  <?php
                                                }
                                              ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6"> 
                                      <!-- Select Basic -->
                                      <div class="form-group">
                                        <label class="control-label" for="seatcapacity">Number Of Guests</label>
                                        <div class=" ">
                                          <select  name="guest" id="guest" class="form-control" required="">
                                            <option value="1">0-100 Guests</option>
                                            <option value="2">100-200 Guests</option>
                                            <option value="3">200-300 Guests</option>
                                            <option value="4">300-400 Guests</option>
                                            <option value="5">400-500 Guests</option>
                                            <option value="6">500&Up Guests</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <h2 class="form-title mt30">Space Address</h2>
                                  <div class="row">
                                    <div class="col-md-4"> 
                                      <!-- Text input-->
                                      <div class="form-group">
                                        <label class=" control-label" for="country">Country<span class="required">*</span></label>
                                        <div class="">
                                          <select name="country" id="country" onchange="LoadStates(this.value);" class="form-control" required="">
                                            <option value="" disabled="" selected="">Select Country</option>
                                            <?php
                                              for ($i = 0; $i < count($country_result); $i++) 
                                              {                     
                                                ?>
                                               <option value="<?php echo $country_result[$i]->location_id;?>"><?php echo $country_result[$i]->location_name;?></option>
                                                <?php
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
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="">
                                      <label class="col-md-12 control-label" for="address">Address<span class="required">*</span></label>
                                      <div class="col-md-12">
                                        <input type="text" class="form-control" name="address" id="searchTextField" width="100px" placeholder="Enter your address" style="direction: ltr;" required="">
                                      </div>
                                        <input name="latitude" class="MapLat" value="" type="hidden" placeholder="Latitude" >
                                        <input name="longitude" class="MapLon" value="" type="hidden" placeholder="Longitude">
                                        <div id="map_canvas" style="height: 350px;width: 500px;margin: 0.6em; display: none;"></div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Zip Code<span class="required">*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control red-tooltip" name="zip_code" onkeypress="return isNum(event)" data-toggle="tooltip" data-placement="bottom" title="Use numbers only!!" maxlength="10" placeholder="Enter Zip Code" required="">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Landmark<span class="required">*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" required="" class="form-control" name="landmark"  width="100px" placeholder="Enter Land Mark" >
                                    </div>
                                  </div>
                                  <!-- Textarea -->
                                  <h2 class="form-title mt30">Description</h2>
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Accommodates<span class="required">*</span></label>
                                    <div class="col-md-12">
                                        <input type="text" required="" class="form-control" name="accommodate" id="accommodate" value="" placeholder="Accommodates" >
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label class="control-label" for="description">Description<span class="required">*</span></label>
                                        <div class="">
                                          <textarea class="form-control" name="description" id="description"  placeholder="Describe your space in a few words" rows="5" required=""></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Booking Price<span class="required">*</span></label>
                                      <div class="col-md-12">
                                        <input type="text"  name="base_price" id="base_price" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Price Per Booking" class="form-control input-md" required="">
                                    </div>
                                  </div> -->
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Discount To Offer<span class="required">*</span></label>
                                      <div class="col-md-12">
                                        <input type="text"  name="discount" id="discount" value="" onkeypress='return isNum(event)' placeholder="Discount In Percent" class="form-control input-md" required="" maxlength="2">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="myinput">
                                      <label class="col-md-12 control-label" for="price">Price Type<span class="required">*</span></label>
                                      <div class="col-md-12 radio-info">
                                        <label class="radio-info"><input type="radio" width="100px" name="price" id="fixed" value="fixed">&nbsp;<span style="font-size: 15px;"> Fixed</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label class="radio-primary"><input type="radio" width="100px" name="price" id="adapts" value="negotiable" checked>&nbsp;<span style="font-size: 15px;"> Negotiable</span></label>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Booking Hours<span class="required">*</span></label>
                                      <div class="col-md-12">
                                        <input type="text" class="form-control input-md" required="" name="min_hr" id="min_hr" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Minimum hours of booking required" maxlength="2">
                                    </div>
                                  </div> -->

                                </div>
                                <!-- Text input2-->
                                <div class="col-md-6">
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Space Images<span class="required">*</span></label>
                                    <div class="col-md-12">
                                      <p>Please upload 3-5 pictures of your space. Once we reviewed your application our photography and listing team will contact you. Our team will assist you with uploading and editing your listing and images. Uploaded image size should be greater than 200KB</p>
                                      <span id="valid_msg" style="color: red; font-size: 18px; font-weight: bolder;"></span>
                                      <div id="filediv"><input name="images[]" type="file" id="file" class="file" required=""/></div>
                                      <div style="padding: 20px 0px;">
                                        <button type="button" id="add_more" class="btn btn-info btn-sm" >Add More Images</button>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6"> 
                                      <!-- Text input-->
                                      <div class="form-group">
                                        <p><b>Amenities</b></p>
                                        <div class="myinput">
                                          <input type="checkbox" name="amenities[]" value="1" class="form-control-chk">&nbsp;Air Conditioning <br>
                                          <input type="checkbox" name="amenities[]" value="2" class="form-control-chk">&nbsp;Bathrooms<br>
                                          <input type="checkbox" name="amenities[]" value="3" class="form-control-chk">&nbsp;Private Entrance<br>
                                          <input type="checkbox" name="amenities[]" value="4" class="form-control-chk">&nbsp;Projector/Screen TV<br>
                                          <input type="checkbox" name="amenities[]" value="5" class="form-control-chk">&nbsp;Kitchen<br>
                                          <input type="checkbox" name="amenities[]" value="6" class="form-control-chk">&nbsp;Sink<br>
                                          <input type="checkbox" name="amenities[]" value="7" class="form-control-chk">&nbsp;Stage<br>
                                          <input type="checkbox" name="amenities[]" value="8" class="form-control-chk">&nbsp;Whiteboard<br>
                                          <input type="checkbox" name="amenities[]" value="9" class="form-control-chk">&nbsp;Photography Lighting<br>
                                          <input type="checkbox" name="amenities[]" value="10" class="form-control-chk">&nbsp;Sound System<br>
                                          <input type="checkbox" name="amenities[]" value="11" class="form-control-chk">&nbsp;Wifi
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6"> 
                                      <!-- Text input-->
                                      <div class="form-group">
                                        <p><b>Rules</b></p>
                                        <div class="myinput">
                                          <input type="checkbox" name="rules[]" value="1" class="form-control-chk">&nbsp;No Smoking<br>
                                          <input type="checkbox" name="rules[]" value="2" class="form-control-chk">&nbsp;No Cooking<br>
                                          <input type="checkbox" name="rules[]" value="3" class="form-control-chk">&nbsp;No Ticket Sales <br>
                                          <input type="checkbox" name="rules[]" value="4" class="form-control-chk">&nbsp;No Music <br>
                                          <input type="checkbox" name="rules[]" value="5" class="form-control-chk">&nbsp;No Under-Age (18-21) <br>
                                          <input type="checkbox" name="rules[]" value="6" class="form-control-chk">&nbsp;No Teenagers (10-18) <br>
                                          <input type="checkbox" name="rules[]" value="7" class="form-control-chk">&nbsp;No Children (0-10) <br>
                                          <input type="checkbox" name="rules[]" value="8" class="form-control-chk">&nbsp;No Outside Catering <br>
                                          <input type="checkbox" name="rules[]" value="9" class="form-control-chk">&nbsp;No Loud Music/Dancing <br>
                                          <input type="checkbox" name="rules[]" value="10" class="form-control-chk">&nbsp;No Alcohol (Serving) <br>
                                          <input type="checkbox" name="rules[]" value="11" class="form-control-chk">&nbsp;No Alcohol (Selling) <br>
                                          <input type="checkbox" name="rules[]" value="12" class="form-control-chk">&nbsp;No Late Nights Parties <br>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row"> 
                                    <div class="form-group ">
                                      <div class="col-lg-12">
                                        <p><b>Availability</b></p>
                                        <input type="checkbox" class="form-control-chk" onclick="toggle(this);" />&nbsp;&nbsp;<span style="" id="change"><b>Select all</b></span>
                                      </div>
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="1" class="form-control-chk">&nbsp;Monday
                                      </div>
                                       <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="2" class="form-control-chk">&nbsp;Tuesday
                                      </div>
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="3" class="form-control-chk">&nbsp;Wednesday
                                      </div>
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="4" class="form-control-chk">&nbsp;Thursday
                                      </div>
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="5" class="form-control-chk">&nbsp;Friday
                                      </div> 
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="6" class="form-control-chk">&nbsp;Saturday
                                      </div>
                                      <div class="col-lg-3"> 
                                        <input type="checkbox" name="days[]" value="7" class="form-control-chk">&nbsp;Sunday
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
                                          <select class="form-control" name="from_time" id="from_time" required="">
                                            <option value="">From Time</option>
                                            <option value="12 AM">12:00am</option>
                                            <option value="1 AM">1:00am</option>
                                            <option value="2 AM">2:00am</option>
                                            <option value="3 AM">3:00am</option>
                                            <option value="4 AM">4:00am</option>
                                            <option value="5 AM">5:00am</option>
                                            <option value="6 AM">6:00am</option>
                                            <option value="7 AM">7:00am</option>
                                            <option value="8 AM">8:00am</option>
                                            <option value="9 AM">9:00am</option>
                                            <option value="10 AM">10:00am</option>
                                            <option value="11 AM">11:00am</option>
                                            <option value="12 PM">12:00pm</option>
                                            <option value="1 PM">1:00pm</option>
                                            <option value="2 PM">2:00pm</option>
                                            <option value="3 PM">3:00pm</option>
                                            <option value="4 PM">4:00pm</option>
                                            <option value="5 PM">5:00pm</option>
                                            <option value="6 PM">6:00pm</option>
                                            <option value="7 PM">7:00pm</option>
                                            <option value="8 PM">8:00pm</option>
                                            <option value="9 PM">9:00pm</option>
                                            <option value="10 PM">10:00pm</option>
                                            <option value="11 PM">11:00pm</option> 
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6"> 
                                      <!-- Text input-->
                                      <div class="form-group">
                                        <label class=" control-label" for="country">To Time<span class="required">*</span></label>
                                        <div class="">
                                          <select class="form-control" name="to_time" id="to_time" required="">
                                            <option value="">To Time</option>
                                            <option value="12 AM">12:00am</option>
                                            <option value="1 AM">1:00am</option>
                                            <option value="2 AM">2:00am</option>
                                            <option value="3 AM">3:00am</option>
                                            <option value="4 AM">4:00am</option>
                                            <option value="5 AM">5:00am</option>
                                            <option value="6 AM">6:00am</option>
                                            <option value="7 AM">7:00am</option>
                                            <option value="8 AM">8:00am</option>
                                            <option value="9 AM">9:00am</option>
                                            <option value="10 AM">10:00am</option>
                                            <option value="11 AM">11:00am</option>
                                            <option value="12 PM">12:00pm</option>
                                            <option value="1 PM">1:00pm</option>
                                            <option value="2 PM">2:00pm</option>
                                            <option value="3 PM">3:00pm</option>
                                            <option value="4 PM">4:00pm</option>
                                            <option value="5 PM">5:00pm</option>
                                            <option value="6 PM">6:00pm</option>
                                            <option value="7 PM">7:00pm</option>
                                            <option value="8 PM">8:00pm</option>
                                            <option value="9 PM">9:00pm</option>
                                            <option value="10 PM">10:00pm</option>
                                            <option value="11 PM">11:00pm</option> 
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Events<span class="required">*</span></label>
                                      <div class="col-md-12">
                                        <div class="row">
                                          <?php
                                            for ($i = 0; $i < count($events); $i++) 
                                            {                     
                                              ?>
                                          <div class="col-sm-12 " style="padding: 5px;">
                                            <div class="col-md-6" style="padding-top: 6px;"> 
                                              <input type="checkbox" name="event[]" value="<?php echo $events[$i]->event_id;?>" class="form-control-chk checkit">&nbsp;<?php echo $events[$i]->event_name;?>
                                            </div>
                                            <div class="col-md-6 eventprice "> 
                                              <!-- <input type="text"  name="event_price[]" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Price For Event" required=""> -->
                                            </div>
                                          </div>
                                          <?php
                                            }
                                          ?>
                                        </div>
                                        <!-- <select id="event" multiple="multiple" name="event[]" class="form-control">
                                        <?php
                                            for ($i = 0; $i < count($events); $i++) 
                                            {                     
                                              ?>
                                              <option value="<?php echo $events[$i]->event_id;?>"><?php echo $events[$i]->event_name;?></option>
                                              <?php
                                            }
                                          ?>
                                        </select> -->
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
 <script src="<?php echo base_url();?>themes/frontend/js/jquery.multiselect.js"></script> 
 <script type="text/javascript">
  $('#event').multiselect({
    columns: 1,
    placeholder: 'Select Events'
});

  var abc = 0;
        $('#add_more').click(function ()
            {
                $(this).before($("<div/>",{id: 'filediv'}).fadeIn('slow').append($("<input/>",
                            {
                                name: 'images[]',
                                type: 'file',
                                style: 'display:none',
                                id: 'file',
                                class: 'file'
                            }).click(),
                            $("<br/>")
                        ));
            });

        $('body').on('change', '.file', function ()
            {
              size = event.target.files[0].size;
              if(size < 200000 ){
                    $('#valid_msg').text('Uploaded image should be greater than 200KB').fadeIn('slow').delay(5000).hide(1);;
                    $(this).val('');
                    $(this).remove();
                    return false;
                  }else{
                    $('#valid_msg').text('');
                  }

                if (this.files && this.files[0])
                {
                    abc += 1; //increementing global variable by 1
                    var z = abc - 1;
                    var x = $(this)
                        .parent()
                        .find('#previewimg' + z).remove();
                    $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' class='thumbimage' src='' data-toggle='modal' data-target='#myModal"+ abc +"'/>  <div class='modal fade' id='myModal"+ abc +"' role='dialog'><div class='modal-dialog'><div class='modal-content'><div class='modal-body'><img id='bigimg" + abc + "' src='' width='100%' /></div></div></div> </div>");
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                    $(this)
                        .hide();
                    $("#abcd" + abc).append($("<img/>",{
                                class: 'img',
                                src: '<?php echo base_url();?>themes/frontend/images/minus.png', //the remove icon
                                style: 'height:45px; width:45px; padding:10px;',
                                alt: 'delete'
                            }) .click(function ()
                            {
                                $(this)
                                    .parent()
                                    .parent()
                                    .remove();
                            }));
                }
            });
        //image preview
        function imageIsLoaded(e)
        {
            $('#bigimg' + abc)
                .attr('src', e.target.result);
            $('#previewimg' + abc)
                .attr('src', e.target.result);
        };
</script>
 
<script type="text/javascript">

$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});


  
$('#space_form').validationEngine('attach'); 
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
$("#space_form").submit(function(e) {
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
   window.location.replace("<?php echo base_url();?>home/spacelist");
  });
</script>
<script type="text/javascript">
  $('#price').text('0');
  $('#percent').text('0');

  $('#select_service').change(function() {
     var $option = $(this).find('option:selected');
     $('#valid_ser').text('');
    //Added with the EDIT
    var venue = $option.val();
    //alert(service);
    $.post('<?php echo base_url();?>home/check_space_subscription', {venue_id:venue}, function(data){
      if (data != 0) {
        var my_arr = data.split("|");
        if(my_arr[0] > 0){
            if (my_arr[1] == 1) { var plan = 'Yearly'; }else{ var plan = 'Half-Yearly'; }
              alert_pop('You have already subscribed '+plan+' plan for this space you can continue');
            $('#subscription_id').val(my_arr[2]);
            $("#venue_id").children('option').hide();
            $("#venue_id").children("option[value=" + venue + "]").show();
            $("#venue_id").children("option[value=" + venue + "]").attr('selected', true);
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
        $('#valid_ser').text('Please Select Venue');
        $('#valid_ser').hide(100);
        $('#valid_ser').show(100);
        return false;
      }
      var plan_id = 1;
      var plan_type = 'yearly';
      var venue_id = $('#select_service').find(":selected").val();
      var venue_name = $('#select_service').find(":selected").text();
      var amount = $('#select_service').find(":selected").attr('data-price');

      $.post('<?php echo base_url();?>home/space_subscribe', {venue_id:venue_id, plan_id:plan_id, plan_type:plan_type, amount:amount, venue_name:venue_name}, function(data){
        if (data > 0) {
          $('#subscription_id').val(data);
          $('#myservice').modal('hide');
          $("#venue_id").children('option').hide();
          $("#venue_id").children("option[value=" + venue_id + "]").show();
          $("#venue_id").children("option[value=" + venue_id + "]").attr('selected', true);
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
        $('#valid_ser').text('Please Select Venue');
        $('#valid_ser').hide(100);
        $('#valid_ser').show(100);
        return false;
      }
      var plan_id = 2;
      var plan_type = 'halfly';
      var venue_id = $('#select_service').find(":selected").val();
      var venue_name = $('#select_service').find(":selected").text();
      var amount = $('#select_service').find(":selected").attr('data-plan');

      $.post('<?php echo base_url();?>home/space_subscribe', {venue_id:venue_id, plan_id:plan_id, plan_type:plan_type, amount:amount, venue_name:venue_name}, function(data){
        if (data > 0) {
          $('#subscription_id').val(data);
          $('#myservice').modal('hide');
          $("#venue_id").children('option').hide();
          $("#venue_id").children("option[value=" + venue_id + "]").show();
          $("#venue_id").children("option[value=" + venue_id + "]").attr('selected', true);
          alert_pop('Congratulations You Have Successfully Subscribed');
        }else{
          alert('failed');
        }
      });

    });
</script>
<script type="text/javascript">
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

$("#space_form").submit(function(e) {
    if ($('input[name="days[]"]:checked').length == 0) {
      e.preventDefault();
      alert_pop('Please select days in Availability'); 
      return false;
    }
    if ($('input[name="event[]"]:checked').length == 0) {
      e.preventDefault();
      alert_pop('Please select atleast one event!!'); 
      return false;
    }
    var numItems = $('.file').length;

    if(numItems < 3){
      e.preventDefault();
      alert_pop('Please upload atleast three images'); 
      return false;
    }

    });
</script>
<script type="text/javascript">
  $(".checkit").click(function() {
    // this function will get executed every time the #home element is clicked (or tab-spacebar changed)
    if($(this).is(":checked")) // "this" refers to the element that fired the event
    {
        $(this).parent().parent().find('.eventprice').append('<input type="text"  name="event_price[]" class="form-control2 input-md" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Price For Event" required="">')
    }else{
        $(this).parent().parent().find('.eventprice').empty();
    }
});
</script>