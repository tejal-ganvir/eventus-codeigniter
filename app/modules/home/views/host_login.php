	<div class="tp-page-head1">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="page-header text-center">
                        <div class="icon-circle">
                            <i class="icon icon-size-60 icon-padlock-1 icon-white"></i>
                        </div>
                        <h1>Welcome back to your account</h1>
						<p>We're happy to have you back.</p>
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
								<h2>Sign In</h2>
								<div class="row">
									<div class="col-md-6">   
										<button scope="public_profile,email" class="loginBtn loginBtn--facebook" onclick="GetLoginState();">
											<!-- <span class="fa fa-facebook"></span> --> Sign in with Facebook
										</button>
									</div>
									<div class="col-md-6">      
										<button class="loginBtn loginBtn--google" onclick="Google_Tab();">
											<!-- <span class="fa fa-google-plus"></span> --> Sign in with Google
										</button>
									</div>
								</div>
								<div class="signup-or-separator">
									<span class="h6 signup-or-separator--text">or</span>
									<hr>
								</div>
								<?php
								    if($this->session->flashdata('message')!="" && $this->session->flashdata('message')!=null)
								    {
								    ?>
								    <center><font color="red"><?php echo $this->session->flashdata('message');?></font></center>
								    <br> 
								    <?php
								    } 
							    ?>
							    <?php
								    if($this->session->flashdata('message1')!="" && $this->session->flashdata('message1')!=null)
								    {
								    ?>
								    <center><font color="green"><?php echo $this->session->flashdata('message1');?></font></center>
								    <br> 
								    <?php
								    } 
							    ?>
								<div class="form">
									<form method="POST" action="<?php echo base_url();?>home/host_login" id="host_login">
										<div class="input-container">
											<input type="text" name="email_id" id="email_id" placeholder="Enter E-mail id" required="">
											<i class="fa fa-envelope-o"></i>
										</div>
										<div class="input-container">
											<input type="password" name="password" id="password" placeholder="Enter Password" required="">
											<i class="fa fa-unlock"></i>
										</div>
										<div class="input-container">
											<label>
												<span class="radio">
													<input type="checkbox" name="foo" value="1" checked style="float: left;position: relative; left:-20px;">
                      								<span style="font-size: 12px;position: relative; left:-15px;">Remember me</span>
												</span>
											</label>
										</div>
										<div class="input-container">
											<button class="btn btn-primary" name="login" id="login" style="float: left">Sign In</button>
											<p></p>
											 <a href="<?php echo base_url();?>home/forgotpassword" style="color:#659e8e;float: right;">Forgot Password ?</a> 
										</div>
									</form>
								</div>
							</div>
							<div class="user-box-footer">
								<p>Don't have an account?<br><a href="<?php echo base_url();?>home/host_register">Sign up as a User</a></p>
							</div> 
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</section> 
<script type="text/javascript"> 
	$('#host_login').validationEngine('attach');
</script>