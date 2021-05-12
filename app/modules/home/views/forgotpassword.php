<div class="kf_content_wrap" style="background:url(<?php echo base_url();?>themes/frontend/images/scenarioback.jpg) no-repeat; height:750px">
	<section>
		<div class="container">
			<div class="row">
				<div class="kode_wrapper">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="user-box">
								<h2>Forgot Password</h2> 
								<?php
								    if($this->session->flashdata('message')!="" && $this->session->flashdata('message')!=null)
								    {
								    ?>
								    <center><font color="red"><?php echo $this->session->flashdata('message');?></font></center>
								    <br> 
								    <?php
								    } 
							    ?> 
								<div class="form">
									<form method="POST" action="<?php echo base_url();?>home/forgotpassword" id="host_login">
										<div class="input-container">
											<input type="text" name="email_id" id="email_id" class="validate[required,custom[email]]" placeholder="Enter E-mail id">
											<i class="fa fa-envelope-o"></i>
										</div> 
										<div class="input-container">
											<button class="btn-style" name="submit" id="submit">Submit</button>
										</div>
									</form>
								</div>
							</div>
							<div class="user-box-footer">
								<p><a href="<?php echo base_url();?>home/host_login">Sign in as a User</a></p>
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