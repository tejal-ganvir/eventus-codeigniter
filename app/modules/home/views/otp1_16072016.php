<script src="https://apis.google.com/js/platform.js" async defer></script> 
<script type="text/javascript">
$(function(){
    $("#newFrm").delay(1000).hide();
    $("#addCnt").on("click", function(){
        $("#newFrm").toggle();
        $("#addCnt").hide();
    });
});	

</script>
<div class="kf_content_wrap" style="background:url(<?php echo base_url();?>themes/frontend/images/scenarioback.jpg) no-repeat; height:750px">
	<section>
		<div class="container">
			<div class="row">
				<div class="kode_wrapper">
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
								<?php if($user_details['is_noconfirm'] ==1){ ?> 

									<div class="col-lg-offset-3 col-lg-6 col-lg-offset-3">
									<p><?php echo 'Your number '.$user_details['con_code'].'-'.$user_details['mobileno'].' is already' ?>
									<span style="color: red;">VERIFIED</span></p>
									</div>

								 <?php }else{?>
									<form id="changepass" action="<?php echo base_url();?>home/otp" method="POST">
										<div class="inout-container" name="addCnt" id="addCnt">
											<span>+</span><span style="color:#f22f09">Add Your Contact Number</span>
										</div>
										<div class="input-container" name="newFrm" id="newFrm">
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
												<input type="text" name="countrycode" id="countrycode" <?php if($user_details){ if($user_details['con_code'] != ''){ ?> value="<?php echo $user_details['con_code'];?>"<?php }}?>></div>
												<div class="col-lg-9 col-md-9  col-sm-9 col-xs-9">
												<input type="text" name="mobile" id="phno" <?php if($user_details){ if($user_details['mobileno'] != ''){ ?> value="<?php echo $user_details['mobileno'];?>"<?php }}?>>
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
	</section>   
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
</style>
 
