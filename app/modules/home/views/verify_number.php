<script src="https://apis.google.com/js/platform.js" async defer></script>
<div class="tp-page-head1">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="page-header text-center">
                    	<div class="icon-circle"> <i class="icon icon-size-60 icon-telephone-1 icon-white"></i> </div>
                        <!-- <h1>Verify Phone Number</h1> -->
                        <h3 style="color: #fff">Phone number verification provides a stronger level of security. <br><br>
                        User will get all the request related SMS on a verified phone number.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="kf_content_wrap" style="background:url(<?php echo base_url();?>themes/frontend/images/scenarioback.jpg) no-repeat; height:750px">
	<section>
		<div class="container">
			<div class="row">
				<div class="kode_wrapper">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="user-box">
								<?php 
                                    if($this->session->flashdata('message'))
                                        {
                                          echo '<div class="alert alert-danger errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('message').'</div>';
                                        }
                                ?>
								<h2>Verify your number</h2>  
								<div class="form">
									<form id="changepass" action="<?php echo base_url();?>home/otp/<?php echo $user_details['unique_id'] ?>" method="POST">
										<div class="input-container">
											<input type="text" name="mobile"  id="mobile" value="" placeholder="Enter Mobile Number" required="" maxlength="10" onkeypress="return isNum(event)">
											<i class="fa fa-phone"></i>
										</div>
										<div class="input-container">
											<button class="btn btn-default" name="send" id="send">Verify By OTP</button>
										</div>
									</form>
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
$(document).on('submit','#changepass',function(){
   if($('#mobile').val().length < 10){
   	alert_messagedisplay('noee');
   	return false;
   }
});
function alert_messagedisplay(msg){
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