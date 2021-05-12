        <?php $this->load->view('frontend/leftsidebar'); ?> 
        <form id="myaccount" method="POST" action="<?php echo base_url();?>home/myaccount/<?php if($user_details){ echo $user_details['unique_id'] ;}?>" enctype="multipart/form-data">
          <div class="col-md-6 col-md-offset-2">
          <div class="row">
            <div class="col-md-6"><h3 style="color:#78F7E0">My Account</h3></div>
            <div class="col-md-6" ><a href="javascript:;" style="float:right; color: #65D0BD; font-size: 31px;" name="edit" value="edit" onclick="enableInput()" class="fa fa-edit">Edit</a></div>
            </div>
            <br>
            <?php 
            if($this->session->flashdata('success'))
            {
              echo '<div class="alert alert-success errormsg" style="margin-bottom:10px;"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('success').'</div>';
            } 
            elseif($this->session->flashdata('error'))
            {
              echo '<div class="alert alert-danger errormsg" style="margin-bottom:10px;"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('error').'</div>';
            }
            ?>
            <p><b style="color:#FFF"><i></i></b></p>
            <div class="form">
              <div class="input-container">
                <input type="text" class="validate[required] text-input validate[optional,maxSize[50],minSize[1]]" name="fname" id="fsname" value="<?php if($user_details){ echo $user_details['fname'] ;}?>" placeholder="Enter First Name" disabled="disabled">
              </div>
              <div class="input-container">
                <input type="text" class="validate[required] text-input validate[optional,maxSize[50],minSize[1]]" name="lsname" id="lsname" value="<?php if($user_details){ echo $user_details['lname'] ;}?>" placeholder="Enter Last Name" disabled="disabled">
              </div>
              <div class="input-container">
                <input type="text" class="validate[required,custom[email]]" name="email_id" id="email_id" value="<?php if($user_details){ echo $user_details['email_id'] ;}?>" readonly placeholder="Enter E-mail Id" disabled="disabled">
              </div>
              <!-- <div class="input-container">
                <input type="text" class="validate[required] validate[maxSize[10],minSize[10]]" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="mobileno" id="mobileno" value="<?php if($user_details){ echo $user_details['mobileno'] ;}?>" <?php if($user_details['is_noconfirm']==1){ echo "readonly"; }?> placeholder="Enter Phone Number" disabled="disabled">
              </div> -->
              <div class="input-container">
                <input type="text" class="validate[required] validate[maxSize[10],minSize[10]]" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="mobileno" id="mobileno" value="<?php if($user_details){ echo $user_details['mobileno'] ;}?>" readonly <?php //if($user_details['is_noconfirm']==1){ echo "readonly"; }?> <?php if($user_details){ if($user_details['mobileno'] != ''){ ?> value="<?php echo $user_details['mobileno'];?>" readonly<?php }}?>>
                      <?php if($user_details){ if($user_details['mobileno'] != ''){ if($user_details['is_noconfirm'] == 1){?><i class="i_span2" style="color: green;">Verified</i><?php } else {?><i class="i_span2"  style="color: red;">Unverified</i><i class="i_span1 fa fa-edit" onclick="redirect()" ></i> <?php } }} ?> 
              </div>
            </div>
          </div> 
          <div class="col-md-4 col-md-offset-2" style="padding-top: 20px;">
            <p><b style="color:#FFF">About me:</b></p>
            <div class="input-container">
              <textarea class="validate[required] validate[optional,maxSize[250]" name="about_me" id="about_me" disabled="disabled" placeholder="Tell us tittle about yourself"  style="height:158px"><?php if($user_details){ echo $user_details['about_them'] ;}?></textarea>
            </div>
          </div>
          <div class="col-md-2" style="padding-top: 20px;">
            <p><b style="color:#FFF;">Profile Picture</b></p>
            <div class="input-container">
              <input type="file" name="profile_pic" id="profile_pic" accept="image/png, image/jpeg, image/gif" style="color: white;" disabled="disabled" onchange="readURL(this);"/>
              <input type="hidden" name="previous_profileimage" disabled="disabled" class="blah" value="<?php if($user_details) { echo $user_details['profile_image'];}?>" />
               <?php
               if($user_details){
                $CustPhoto = $user_details['profile_image']?'uploads/profile_pic/'.$user_details['profile_image']:"themes/frontend/images/no-image.png";
               ?>
              <img src="<?php echo base_url().$CustPhoto;?>" class="blah" width="300" height="135" /><?php } ?>                          
            </div>
          </div> 
          <div class="col-md-6 col-md-offset-4">
            <p><b style="color:#FFF">Your Address:</b></p>
            <div class="input-container">
              <input type="text" class="validate[required] validate[optional,maxSize[250]" name="address" id="address" value="<?php if($user_details){ echo $user_details['address'] ;}?>" placeholder="Enter your address" disabled="disabled">
            </div>
          </div> 
          <div class="col-md-6 col-md-offset-4">
            <p><b style="color:#FFF">Organization:</b></p>
            <div class="input-container">
              <input type="text" class="validate[required] validate[optional,maxSize[50],minSize[2]]" name="organization" id="organization" value="<?php if($user_details){ echo $user_details['company_name'] ;}?>" placeholder="Company name" disabled="disabled">
            </div>
            <div class="input-container">
              <input type="text" class="validate[required] validate[optional,maxSize[50],minSize[2]]" name="job_title" id="job_title" value="<?php if($user_details){ echo $user_details['job_title'] ;}?>" placeholder="Job title" disabled="disabled">
            </div>
            <div class="input-container">
              <input type="text" class="validate[required] validate[maxSize[10],minSize[10]]" name="business_phone" id="business_phone" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php if($user_details){ echo $user_details['business_phone'] ;}?>" placeholder="Business phone" disabled="disabled">
            </div>
          </div> 
          <div class="col-md-6 col-md-offset-4"> 
            <div align="center" > 
            <!-- <input class="btn-style" name="edit" type="button" value="edit" onclick="enableInput()" style="margin:40px;"> -->
              <input class="btn-style" disabled name="submit" type="submit" value="Save" style="margin:40px;">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</section> 
<script type="text/javascript"> 
  $('#myaccount').validationEngine('attach');
  $('#myaccount').find('input, textarea, button, select').css('background-color','grey');
</script>
<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script type="text/javascript">
      function enableInput(){
       $('#myaccount').find('input, textarea, button, select').prop('disabled',false);
       $('#myaccount').find('input, textarea, button, select').css('background-color','#fff');
       $("input[name='submit']").css('background-color','#449e8e');
       $("input[name='submit']").hover(function(e) { 
            $(this).css("background-color",e.type === "mouseenter"?"#fff":"#449e8e") 
        });
       $('#fsname').focus();
       }
    </script>
