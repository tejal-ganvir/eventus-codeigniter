<script src="https://apis.google.com/js/platform.js" async defer></script>
	<div class="tp-page-head1">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="page-header text-center">
                        <div class="icon-circle">
                            <i class="icon icon-size-60 icon-padlock-1 icon-white"></i>
                        </div>
                        <h1>Sign up as a User</h1>
						<p>We're happy to have you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="kf_content_wrap">
	<section>
		<div class="container">
			<div class="row">
				<div class="kode_wrapper">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="user-box">
								<h2>Sign up as a User</h2> 
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
								<div class="form">
									<form id="host_socialregister" action="<?php echo base_url();?>home/social_register" method="POST">
										<div class="input-container">
											<input type="text" name="fname" id="fname" value="<?php echo $fname?>" placeholder="Enter First Name" required="">
											<i class="fa fa-user"></i>
										</div>
										<div class="input-container">
											<input type="text" name="lname" id="lname" value="<?php echo $lname?>" placeholder="Enter Last Name" required="">
											<i class="fa fa-user"></i>
										</div>
										<div class="input-container">
											<input type="text" name="email_id" id="email_id" data-prompt-position="topLeft:280" placeholder="Enter E-mail" required="">
											<i class="fa fa-envelope-o"></i>
										</div>
										<div class="input-container">
											<input type="text" name="mobile" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="mobile" placeholder="Enter Mobile Number" required="">
											<i class="fa fa-unlock"></i>
										</div>
										<input type="hidden" name="picture" id="picture" value="<?php echo $picture;?>"> 
										<div class="input-container">
											<label> 
												<span style="color:#777777;font-size: 14px;">By signing up, I agree to eventus’s Terms of Service, Payments Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.</span>
											</label>
										</div>
										<div class="input-container">
											<button class="btn btn-primary" name="signup" id="signup">Sign Up</button>
										</div>
									</form>
								</div>
							</div>
							<div class="user-box-footer">
								Already have an account? <a href="<?php echo base_url();?>home/host_login">Sign In</a>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</section>  
</div> 
<script type="text/javascript"> 
	$('#host_socialregister').validationEngine('attach'); 
</script>

 