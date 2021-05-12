<script src="https://apis.google.com/js/platform.js" async defer></script> 
<div class="kf_content_wrap" style="background:url(<?php echo base_url();?>themes/frontend/images/scenarioback.jpg) no-repeat; height:750px">
	<section>
		<div class="container">
			<div class="row">
				<div class="kode_wrapper">
					<div class="modal-dialog">
						<div class="modal-content" id="otp">
							<div class="user-box">
								<h2>Enter the otp</h2> 
								<?php
								    if($this->session->flashdata('message')!="" && $this->session->flashdata('message')!=null)
								    {
								    ?>
								    <center id="error"><font color="green"><?php echo $this->session->flashdata('message');?></font></center>
								    <br>
								    <br>
								    <?php
								    } 
							    ?>
								<div class="form" >
									<div class="input-container" id="msg">
										Haven't receive yet.&nbsp;&nbsp;<a href="<?php echo base_url();?>home/resend_otp" style="color: #ff3f33;">Resend OTP</a>
									</div>
									<form id="changepass" action="<?php echo base_url();?>home/otp_verify" method="POST">
										<div class="input-container">
											<input type="text" name="otp" class="validate[required]" id="otp" required="" maxlength="4" onkeypress="return isNum(event)">
											<i class="fa fa-user" ></i>
										</div> 
										<div class="input-container">
											<button class="btn-style" name="send" id="send">Verify</button>
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

$('#changepass').validationEngine('attach');

$('document').ready(function(){ 
    $('#msg').hide(); 
    window.setTimeout(
        function(){ 
            $('#msg').show();
            setInterval(function(){ $('#msg').toggle(); }, 4000);
        }        
    ,4000);
}); 
</script>
 