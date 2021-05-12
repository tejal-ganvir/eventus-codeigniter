<style type="text/css">
  .request{
    padding-left: 24px;
  }
  @media (max-width:991px) {
  .request{
    padding-left: 0px;
  }
}
</style>
 <?php $this->load->view('frontend/topmenu'); ?>
 <div class="modal fade" id="myservice" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 0px;">
        <div class="modal-header" style="background-color: #f865b0;">
          <a  id="closeservice" class="close" data-dismiss="modal">&times;</a>
          <h4 class="modal-title" style=" color: #FFF;text-align: center;">Service Subscription</h4>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                      <label for="email" style="font-size: 16px;">Select Service:</label>
                        <select class="form-control" id="select_service">
                          <option disabled="" selected="">Select Service</option>
                            <?php
                              for ($b = 0; $b < count($services_list); $b++) 
                              {                     
                                ?>
                                <option value="<?php echo $services_list[$b]->service_id;?>" data-price="<?php echo $services_list[$b]->amount;?>" data-plan="<?php echo $services_list[$b]->halfly;?>"><?php echo $services_list[$b]->service_name;?></option>
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
                    <div class="">
                        <ul class="listnone nav" id="sidebar">
                            <li><a href="<?php echo base_url();?>home/servicelist">Listing Services</a></li>
                            <li class="active"><a href="<?php echo base_url();?>home/list_ofservice">List My Service</a></li>
                            <li><a href="<?php echo base_url();?>home/favourites_services">Favourite Services</a></li>
                            <li><a href="<?php echo base_url();?>home/service_request">Service Request</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10 content-right profile-dashboard">
                    <div class="row">
                        <div class="col-md-12 dashboard-form">
                          <div class="bg-white pinside40 mb30">
                            <form  id="service_form" method="POST" action="<?php echo base_url();?>home/list_ofservice" enctype="multipart/form-data">
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
                              <h2 class="form-title">Add Service Details</h2>
                              <div class="row">
                                <div class="col-md-6">
                              <!-- Text input-->
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="title">Service Provider<span class="required">*</span></label>
                                    <div class="col-md-12">
                                      <input type="text" name="company" id="company" placeholder="Service Provider" class="form-control input-md" required="">
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6"> 
                                      <!-- Select Basic -->
                                      <div class="form-group">
                                        <label class=" control-label" for="categorytype">Select Service Type</label>
                                        <div class=" ">
                                          <select class="form-control" name="service_type" id="service_type" required="">
                                            <option disabled="" selected="">Select Service</option>
                                            <?php
                                              for ($i = 0; $i < count($services_list); $i++) 
                                              {                     
                                                ?>
                                                <option value="<?php echo $services_list[$i]->service_id;?>"><?php echo $services_list[$i]->service_name;?></option>
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
                                  <h2 class="form-title mt30">Service Address</h2>
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
                                  <h2 class="form-title mt30">Packages</h2>
                                  <div class="form-group row ">
                                      <div class=" col-md-12 field_wrapper">
                                        <div class="new_wrapper">
                                            <input type="text" required="" class="form-control"  name="package_name[]" value="" placeholder="Package Name" required=""><p></p>
                                            <textarea class="form-control" required="" name="package_description[]" id="description"  placeholder="Describe your Package in a few words" rows="3" required=""></textarea><p></p>
                                            <input type="text" required="" class="form-control"  name="package_price[]"  width="100px" placeholder="Price for Package" onkeypress="return isNum(event)" required="">
                                        </div>
                                      </div>
                                  </div>
                                  <div class="form-group row ">
                                      <div class="col-md-12">
                                          <center><a href="javascript:void(0);" class="btn btn-primary btn-sm text-center add_button" title="Add field" >Add Package</a></center>
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
                                  <div class="form-group row">
                                    <label class="col-md-12 control-label" for="price">Discount To Offer<span class="required">*</span></label>
                                      <div class="col-md-12">
                                        <input type="text"  name="discount" id="discount" value="" onkeypress='return isNum(event)' placeholder="Discount In Percent" class="form-control input-md" required="" maxlength="2">
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
                                    <label class="col-md-12 control-label" for="price">Service images<span class="required">*</span></label>
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
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<p></p><div class="new_wrapper"><input type="text" required="" class="form-control"  name="package_name[]" value="" placeholder="Package Name" ><p></p><textarea class="form-control" required="" name="package_description[]" id="description"  placeholder="Describe your Package in a few words" rows="3"></textarea><p></p><input type="text" required="" class="form-control"  name="package_price[]" onkeypress="return isNum(event)" width="100px" placeholder="Price for Package" ><p></p><center><a href="javascript:void(0);" class="btn btn-danger btn-sm text-center remove_button" >Remove Package</a></center></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent().parent().remove(); //Remove field html
        x--; //Decrement field counter
    });
});
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
     $('#valid_ser').text('');
    //Added with the EDIT
    var service = $option.val();
    //alert(service);
    $.post('<?php echo base_url();?>home/check_service_subscription', {service_id:service}, function(data){
      if (data != 0) {
        var my_arr = data.split("|");
        if(my_arr[0] > 0){
            if (my_arr[1] == 1) { var plan = 'Yearly'; }else{ var plan = 'Half-Yearly'; }
              alert_pop('You have already subscribed '+plan+' plan for this service you can continue');
            $('#subscription_id').val(my_arr[2]);
            $("#service_type").children('option').hide();
            $("#service_type").children("option[value=" + service + "]").show();
            $("#service_type").children("option[value=" + service + "]").attr('selected', true);
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
      var service_name = $('#select_service').find(":selected").text();
      var amount = $('#select_service').find(":selected").attr('data-price');

      $.post('<?php echo base_url();?>home/service_subscribe', {service_id:service_id, plan_id:plan_id, plan_type:plan_type, amount:amount, service_name:service_name}, function(data){
        if (data > 0) {
          $('#subscription_id').val(data);
          $('#myservice').modal('hide');
          $("#service_type").children('option').hide();
          $("#service_type").children("option[value=" + service_id + "]").show();
          $("#service_type").children("option[value=" + service_id + "]").attr('selected', true);
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
      var plan_type = 'halfly';
      var service_id = $('#select_service').find(":selected").val();
      var service_name = $('#select_service').find(":selected").text();
      var amount = $('#select_service').find(":selected").attr('data-plan');

      $.post('<?php echo base_url();?>home/service_subscribe', {service_id:service_id, plan_id:plan_id, plan_type:plan_type, amount:amount, service_name:service_name }, function(data){
        if (data > 0) {
          $('#subscription_id').val(data);
          $('#myservice').modal('hide');
          $("#service_type").children('option').hide();
          $("#service_type").children("option[value=" + service_id + "]").show();
          $("#service_type").children("option[value=" + service_id + "]").attr('selected', true);
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

$("#service_form").submit(function(e) {
    if ($('input[name="days[]"]:checked').length == 0) {
      e.preventDefault();
      alert_pop('Please select days in Availability'); 
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