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
<div class="kf_content_wrap" >
	<section>
		<div class="container">
			<div class="row">
				<div class="kode_wrapper">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="user-box">
								<h2>Sign Up</h2>
								<div class="social-buttons">
									<div class="row">
										<div class="col-md-6">   
											<button scope="public_profile,email" class="loginBtn loginBtn--facebook" onclick="GetLoginState();">
												<!-- <span class="fa fa-facebook"></span> --> Sign up with Facebook
											</button>
										</div>
										<div class="col-md-6">      
											<button class="loginBtn loginBtn--google"  onclick="Google_Tab();">
												<!-- <span class="fa fa-google-plus"></span> --> Sign up with Google
											</button>
										</div>
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
									<form id="host_register" action="<?php echo base_url();?>home/host_register" method="POST">
										<div class="input-container">
											<input type="text" name="fname" id="fname2" placeholder="Enter First Name" required="">
											<i class="fa fa-user"></i>
										</div>
										<div class="input-container">
											<input type="text" name="lname" id="lname2" placeholder="Enter Last Name" required="">
											<i class="fa fa-user"></i>
										</div>
										<div class="input-container">
											<input type="email" name="email_id" id="email_id2" placeholder="Enter E-mail" required="">
											<i class="fa fa-envelope-o"></i>
										</div>
										<div class="input-container">
											<input type="password" name="password" id="password2" placeholder="Enter Password" required="">
											<i class="fa fa-unlock"></i>
										</div>
										<div class="input-container">
											<input type="password" name="conpassword" id="confirm2" placeholder="Confirm Password" required="">
											<i class="fa fa-unlock"></i>
											<span id="message2"></span>
										</div>
										<div class="input-container">
											<label> 
												<span style="color:#777777;font-size: 14px;">By signing up, I agree to Settle’s Terms of Service, Payments Terms of Service, Privacy Policy.</span>
											</label>
										</div>
										<div class="input-container">
											<button class="btn btn-primary" name="signup" id="signup2">Sign Up</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    // $('#password2, #confirm2').on('keyup', function () {
    //   if ($('#password2').val() == $('#confirm2').val()) {
    //     $('#message2').html('Matching').css('color', 'green');
    //   } else 
    //     $('#message2').html('Not Matching').css('color', 'red');
    // });
});
</script>
<script type="text/javascript"> 
	//toastr["error"]("Please upload images of type jpg,jpeg,png");

$('#signup').click(function() {
	var fname = $('#fname2').val();
	var lname = $('#lname2').val();
	var email = $('#email_id2').val();
	var password = $('#password2').val();
	var confirm = $('#confirm2').val();
	if(password != confirm){
        $('#message').html("Password and Confirm password does not matching").css('color', 'red');
        return false;
      }
	
});
</script>

 