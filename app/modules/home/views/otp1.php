<script src="https://apis.google.com/js/platform.js" async defer></script> 

<?php $this->load->view('frontend/topmenu'); ?>
	<div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3 side-nav" id="leftCol">
                    <div class="hide-side">
                        <ul class="listnone nav" id="sidebar">
                            <li><a href="<?php echo base_url();?>home/myaccount">My Profile</a></li>
                            <li class="active"><a href="<?php echo base_url();?>home/otp">Change Mobile No</a></li>
                            <li><a href="<?php echo base_url();?>home/my_subscription">My Subscriptions</a></li>
                            <li><a href="<?php echo base_url();?>home/my_booking">My Bookings</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 content-right profile-dashboard">
                    <div class="row">
                        <div class="col-md-12 dashboard-form">
                        	<div class="modal-dialog">
								<div class="modal-content">
									<div class="user-box">
										<h2>Verify Your Mobile Number</h2> 
										<?php
										    if($this->session->flashdata('message')!="" && $this->session->flashdata('message')!=null)
										    {
										    ?>
										    <center><font color="red"><?php echo $this->session->flashdata('message');?></font></center>
										    <br>
										    <br>
										    <?php
										    }
										    if(isset($error_message))
										    {
										        echo '<div class="error">'.$error_message.'</div>';
										    } 
										    echo '<div class="error">'.$this->session->flashdata('error_message').'</div>';
									    ?>
										<div class="form" >
										<?php if($user_details['is_noconfirm'] ==1 && !$unique_id){ ?> 

											<div class="col-lg-offset-2 col-lg-8 col-lg-offset-2">
											<p><?php echo 'Your number '.$user_details['con_code'].'-'.$user_details['mobileno'].' is already' ?>						
											<span style="color: red;">VERIFIED</span></p>

											<a href="<?php echo base_url();?>home/otp/<?php echo $user_details['unique_id'];?>" style="color:gray"><i class="fa fa-edit">Change</i></a>
											</div>

										 <?php }elseif(isset($unique_id)){ ?>
										 	<form id="changepass" action="<?php echo base_url();?>home/otp/<?php echo $user_details['unique_id'];?>" method="POST">
												<div class="inout-container" name="addCnt" id="addCnt">
													<i class="fa fa-link"></i>&nbsp;&nbsp;<a href="javascript:;" style="color:#f22f09">Change Your Contact Number</a>
												</div>
												<div class="input-container" name="newFrm" id="newFrm" style="display:none">
													<div class="col-lg-12" style=" color:#000; " >
														<select onchange="loadcountrycode(this.value)" style="height:36px" name="places" id="places">
															<option value="">Choose Country</option>
		                    								<?php 
		                      								if($otp_places)
		                      								{
		                        								for ($i=0; $i < count($otp_places); $i++) 
		                       									 {   
		                        							?>
		                          								<option <?php if($user_details['country_id']==$otp_places[$i]->location_id){echo 'selected';}?> value="<?php echo $otp_places[$i]->location_id?>"><?php echo $otp_places[$i]->location_name?>
		                          								</option>
		                         							<?php
		                        								}
										                    }
										                    ?>
														</select>
													</div>
													<div class="col-lg-12 col-xs-12 text-center">
														<label id="ph_label">Add Your Phone Number</label></div>
														<div class="col-lg-3 col-md-3  col-sm-3 col-xs-3">
														<input type="text" name="countrycode" required="" id="countrycode" <?php if($user_details){ if($user_details['con_code'] != ''){ ?> value="<?php echo $user_details['con_code'];?>"<?php }}?> ></div>
														<div class="col-lg-9 col-md-9  col-sm-9 col-xs-9">
														<input type="text" name="mobile" maxlength="10" onkeypress="return isNum(event)" required="" id="phno" <?php if($user_details){ if($user_details['mobileno'] != ''){ ?> value="<?php echo $user_details['mobileno'];?>"<?php }}?>>
													</div>
													<div class="user-box" >												
														<button class="btn btn-default" name="send" id="send" value="">VERIFY BY OTP
														</button>												
													</div>
												</div>
											</form>

										<?php }else{?>
											<form id="changepass" action="<?php echo base_url();?>home/otp" method="POST">
												<div class="inout-container" name="addCnt" id="addCnt">
													<i class="fa fa-link"></i>&nbsp;&nbsp;<a href="javascript:;" style="color:#f22f09">Add Your Contact Number</a>
												</div>
												<div class="input-container" name="newFrm" id="newFrm" style="display:none">
													<div class="col-lg-12" style=" color:#000; " >
														<select onchange="loadcountrycode(this.value)" style="height:36px" name="places" id="places">
															<option value="">Choose Country</option>
		                    								<?php 
		                      								if($otp_places)
		                      								{
		                        								for ($i=0; $i < count($otp_places); $i++) 
		                       									 {   
		                        							?>
		                          								<option value="<?php echo $otp_places[$i]->location_id?>"><?php echo $otp_places[$i]->location_name?>
		                          								</option>
		                         							<?php
		                        								}
										                    }
										                    ?>
														</select>
													</div>
													<div class="col-lg-12 col-xs-12 text-center">
														<label id="ph_label">Add Your Phone Number</label></div>
														<div class="col-lg-3 col-md-3  col-sm-3 col-xs-3">
														<input type="text" name="countrycode" required="" id="countrycode" <?php if($user_details){ if($user_details['con_code'] != ''){ ?> value="<?php echo $user_details['con_code'];?>"<?php }}?>></div>
														<div class="col-lg-9 col-md-9  col-sm-9 col-xs-9">
														<input type="text" name="mobile" required="" onkeypress="return isNum(event)" maxlength="10" id="phno" <?php if($user_details){ if($user_details['mobileno'] != ''){ ?> value="<?php echo $user_details['mobileno'];?>"<?php }}?>>
													</div>
													<div class="user-box" >												
															<button class=" btn-stylenew" name="send" id="send" value="">VERIFY BY OTP
														</button>												
													</div>
												</div>
											</form>
											<?php }?>
										</div> 
									</div> 
									<div class="clearfix"></div>
								</div> 
								<div class="clearfix"></div>
							</div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
function isNum(evt){

  evt =(evt)? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode<48 || charCode >57)){

    return false;
  }
return true;
}
$(function(){
    //$("#newFrm").delay(1000).hide();
    $("#addCnt").on("click", function(){
        $("#newFrm").toggle();
        $("#addCnt").hide();
    });
});	

</script>
	<script>
	$(document).ready(function(){
		var id=$('#places').val();
		switch(id) {
	    case '1':
	        $('#countrycode').val('+91');
	        break;
	    case '7':
	        $('#countrycode').val('+371');
	        break;
        case '8':
	        $('#countrycode').val('+370');
	        break;
        case '6':
	        $('#countrycode').val('+1');
	        break;
	    case '9':
	        $('#countrycode').val('+372');
	        break;
	    }
	    $('#changepass').on('submit',function(){
	    	var phno=<?php echo $user_details['mobileno'];?>;
	    	var is_noconfirm=<?php echo $user_details['is_noconfirm'];?>;
	    	//alert(is_noconfirm);
		    if($('#phno').val()==phno && is_noconfirm==1)
		    {
		    	alert('Same phone number');
		    	return false;
		    }
	    });	    
	})
	</script>

<script type="text/javascript">
$('#changepass').validationEngine('attach');
</script>
<script type="text/javascript">
 function loadcountrycode(id)
 {
 	//alert(id);
 	switch(id) {
	    case '1':
	        $('#countrycode').val('+91');
	        break;
	    case '7':
	        $('#countrycode').val('+371');
	        break;
        case '8':
	        $('#countrycode').val('+370');
	        break;
        case '6':
	        $('#countrycode').val('+1');
	        break;
	    case '9':
	        $('#countrycode').val('+372');
	        break;
	}
 }	

</script>

<style type="text/css">
	#countrycode,#phno{
		padding: 10px;
	}
	.btn-stylenew{
	width:163px;
	height:36px;
	color:#fff;
	border-radius:10px;
	background-color:#449e8e;
	}
	#ph_label{
		padding:10px;
		margin-top: 5px;
	}
	select{
		font-size: 15px;
		color:gray;
		font-weight: normal;
	}	
</style>
 
