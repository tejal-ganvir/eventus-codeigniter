        <style>
          .pro_image img{
            max-width:none;
          }
          .modal {
              display:    none;
              position:   fixed;
              z-index:    1000;
              top:        0;
              left:       0;
              height:     100%;
              width:      100%;
              background: rgba( 255, 255, 255, .8 ) 
                          url('http://i.stack.imgur.com/FhHRx.gif') 
                          50% 50% 
                          no-repeat;
          }
          body.loading {
              overflow: hidden;   
          }
          body.loading .modal {
              display: block;
          }
        </style>  
 <?php $this->load->view('frontend/topmenu'); ?>
 <div class="main-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 side-nav" id="leftCol">
                    <div class="hide-side">
                        <ul class="listnone nav" id="sidebar">
                            <li class="active"><a href="<?php echo base_url();?>home/myaccount">My Profile</a></li>
                            <li><a href="<?php echo base_url();?>home/otp">Change Mobile No</a></li>
                            <li><a href="<?php echo base_url();?>home/my_subscription">My Subscriptions</a></li>
                            <li><a href="<?php echo base_url();?>home/my_booking">My Bookings</a></li>
                        </ul>
                    </div>
                </div>
                <?php
                    if($user_details){
                    $CustPhoto = $user_details['profile_image']?'uploads/profile_pic/'.$user_details['profile_image']:"themes/frontend/images/no-image.png";
                }
                ?>
                <div class="col-md-10 content-right profile-dashboard">
                    <div class="row">
                        <div class="col-md-7 dashboard-form">
                            <div class="bg-white pinside40 mb30">
                                <form class="form-horizontal" id="myaccount" method="POST" action="<?php echo base_url();?>home/myaccount/<?php if($user_details){ echo $user_details['unique_id'] ;}?>" enctype="multipart/form-data">
                                    <?php 
                                        if($this->session->flashdata('success'))
                                        {
                                          echo '<div class="alert alert-success errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('success').'</div>';
                                        } 
                                        elseif($this->session->flashdata('error'))
                                        {
                                          echo '<div class="alert alert-danger errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('error').'</div>';
                                        }
                                      ?>
                                    <!-- Form Name -->
                                    <h2 class="form-title">Upload Profile Photo</h2>
                                    <!-- File Button -->
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <div class="photo-upload"><img src="<?php echo base_url().$CustPhoto;?>" class="img-responsive img-circle"></div>
                                        </div>
                                        <div class="col-md-8 upload-file">
                                            <input name="upload_pic" id="upload_pic" class="input-file" type="file">
                                            <input type="hidden" name="url" id="url" value="<?php echo base_url();?>">
                                            <input type="hidden" name="previous_profileimage" class="blah" value="<?php if($user_details) { echo $user_details['profile_image'];}?>" />
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <h2 class="form-title">My Profile</h2>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">First Name<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="fname" id="fsname" value="<?php if($user_details){ echo $user_details['fname'] ;}?>" placeholder="Enter First Name" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Last Name<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="lsname" id="lsname" value="<?php if($user_details){ echo $user_details['lname'] ;}?>" placeholder="Enter Last Name" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Email<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="email_id" id="email_id" value="<?php if($user_details){ echo $user_details['email_id'] ;}?>" readonly placeholder="Enter E-mail Id" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Mobile No<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control input-md" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="mobileno" id="mobileno" value="<?php if($user_details){ echo $user_details['mobileno'] ;}?>" readonly <?php //if($user_details['is_noconfirm']==1){ echo "readonly"; }?> <?php if($user_details){ if($user_details['mobileno'] != ''){ ?> value="<?php echo $user_details['mobileno'];?>" readonly<?php }}?>>
                                        <?php if($user_details){ if($user_details['mobileno'] != ''){ if($user_details['is_noconfirm'] == 1){?><i class="i_span2" style="color: green; text-align: center;">Verified</i><?php } else {?><i class="i_span2"  style="color: red;">Unverified</i> <?php } }} ?> 
                                        </div>
                                    </div>
                                    <!-- Textarea -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="description">About Me</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" name="about_me" id="about_me" placeholder="Tell us tittle about yourself" rows="6" cols="12"><?php if($user_details){ echo $user_details['about_them'] ;}?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Address<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="address" id="address" value="<?php if($user_details){ echo $user_details['address'] ;}?>" placeholder="Enter your address" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Occupation<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="organization" id="organization" value="<?php if($user_details){ echo $user_details['company_name'] ;}?>" placeholder="Company name" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Job title<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text"  name="job_title" id="job_title" value="<?php if($user_details){ echo $user_details['job_title'] ;}?>" placeholder="Job title" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="name">Business Contact<span class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="business_phone" id="business_phone" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php if($user_details){ echo $user_details['business_phone'] ;}?>" placeholder="Business phone" class="form-control input-md" required="">
                                        </div>
                                    </div> -->
                                    <!-- Button -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="submit"></label>
                                        <div class="col-md-4">
                                            <button id="submit" name="submit" type="submit" class="btn btn-primary">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 dashboard-form">
                            <div class="bg-white pinside40 mb30">
                                <form class="form-horizontal" id="changepass" action="" onsubmit="change_loginpassword();return false;" method="POST">
                                    <!-- Form Name -->
                                    <h2 class="form-title">Change Password</h2>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="oldpassword">Old Password</label>
                                        <div class="col-md-8">
                                            <input type="password" name="oldpass" id="oldpass" value="" placeholder="Enter Old Password" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="newpassword">New Password</label>
                                        <div class="col-md-8">
                                            <input type="password" name="newpass" id="newpass" value="" placeholder="Enter New Password" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="ConfirmPassword">Confirm Password</label>
                                        <div class="col-md-8">
                                            <input type="password" name="conpass" id="conpass" placeholder="Enter Confirm Password" class="form-control input-md" required="">
                                            <span id="message"></span>
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="submit"></label>
                                        <div class="col-md-4">
                                            <button name="signup" id="signup" class="btn btn-primary">Save Password</button>
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
//   $(document).ready(function(){

//     $('#newpass, #conpass').on('keyup', function () {
//       if ($('#newpass').val() == $('#conpass').val()) {
//         var msg = 'Password and Confirm password does not match!!';
//         alert_messagedisplay(msg);
//         //$('#message').html('Matching').css('color', 'green');
//       } 
//         //$('#message').html('Not Matching').css('color', 'red');
//     });
// });
</script>
<script type="text/javascript"> 
  $('#myaccount').validationEngine('attach');
  $('#myaccount').find('input, textarea, button, select').css('background-color','#bfc4c8');
  toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>
<script>
$(document).on("change", "#upload_pic", function() {
  url=$("#url").val();
  $body = $("body");
  var file_data = $("#upload_pic").prop("files")[0];   // Getting the properties of file from file field
  var form_data = new FormData();                  // Creating object of FormData class
  form_data.append("file", file_data)              // Appending parameter named file with properties of file_field to form_data
  form_data.append("user_id", 123)                 // Adding extra parameters to form_data
  //alert(form_data);
  $body.addClass("loading");
  $.ajax({
                url: url+ 'home/change_pic/',
                dataType: 'script',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         // Setting the data attribute of ajax with file_data
                type: 'post',
                success:function(data){
                  if(data==2)
                  {
                    //alert();
                    $body.removeClass("loading");
                    toastr["error"]("Please upload images of type jpg,jpeg,png");
                    $('.img-circle').html();
                  }
                  else
                  {
                    name=data.replace(/\"/g, "");
                    $('.img-circle').load(function() {
                         $body.removeClass("loading");                                               
                    }).attr('src',url+'uploads/profile_pic/'+name);       
                    toastr["success"]("Profile picture updated successfully");                  
                  }                
                },
                error: function(data){
                    alert(data);
                }
       })
})
</script>
<script type="text/javascript">
$('#changepass').validationEngine('attach');
function change_loginpassword() {
  var oldp = $('#oldpass').val();
  var newp = $('#newpass').val();
  var conp = $('#conpass').val();

  if(oldp.match(/\s/g) || newp.match(/\s/g) || conp.match(/\s/g)){
    var msg = 'Remove space from password you enter..';
    alert_messagedisplay(msg);
  }
  else{
    if(oldp != '' && newp != '' && conp != ''){
      if(newp == conp){
        check_confirmation();
      }else{
        var msg = 'Password and Confirm password does not match!!';
        alert_messagedisplay(msg);
      }
    } 
  }
}
function check_confirmation(){
    $.confirm({
        title: 'Confirmation Message',
        content: 'Are you sure, you want to change password ?',
        confirmButton: 'Proceed',
        confirmButtonClass: 'btn-info',
        cancelButtonClass: 'btn-danger',
        icon: 'fa fa-question-circle',
        animation: 'scale',
        animationClose: 'top',
        opacity: 1, 
        confirm: function () {
            dataString = $("#changepass").serialize();
            $.ajax({type: "POST", url: "<?php echo base_url();?>home/change_thatpass", data: { dataString : dataString }, 
                success: function(result) { 
                    if(result == 1) {
                      $.alert({
                          title: 'Success!',
                          content: 'Your login password has been sent on your email...',
                          confirmButton: 'Okay',
                          confirmButtonClass: 'btn-warning',
                          icon: 'fa fa-info',
                          animation: 'zoom',
                          opacity: 1,                                    
                          confirm: function () {
                              window.location.href = "<?php echo base_url();?>home/myaccount";
                            }
                        });
                    }
                    else if(result == 2){
                       var msg = 'Please enter correct old password details and try again.';
                      alert_messagedisplay(msg);
                    }
                    else if(result == 3){
                      var msg = 'New Password and confirm password is not matching,Please try again.';
                      alert_messagedisplay(msg);
                    }
                    else if(result == 4){
                      var msg = 'New Password and old password cannot be same,Please try again.';
                      alert_messagedisplay(msg);
                    }
                    else{
                      var msg = 'Unable to change the password,Please try again.';
                      alert_messagedisplay(msg);
                    }
                }
            });
        }
    });
}
function alert_messagedisplay(msg){
    $.alert({
      title: 'Alert Message',
      content: msg,
      confirmButton: 'okay',
      confirmButtonClass: 'btn-danger',
      animation: 'bottom',
      icon: 'fa fa-exclamation-circle',
      opacity: 2,  
      backgroundDismiss: true
    });
}

</script>