<?php $this->load->view('backend/leftsidebar'); ?>  
<div class="page-content-wrapper">
		<div class="page-content">
			<div id="wrapper">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">CHANGE PASSWORD</h1>
			</div>
			</div>
			<?php 
			if($this->session->flashdata('success'))
			{
				echo '<div class="alert alert-success errormsg" style="margin-bottom:10px;"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('success').'</div>';
			} 
			?>
			<div class="row">
				<div class="col-lg-11">
					<div class="panel-body">
						<div class="row">
							<form class="cmxform form-horizontal " id="signin-form-data" method="POST" action="<?php echo base_url();?>siteadmin/changepassword" enctype="multipart/form-data">
								<div class="row">
									<div class="col-xs-3">
										<label style=" #2d3e52;">Old Password</label>
									</div>
									<div class="col-xs-6">
										<input type="text" class="form-control input-inline input-medium" placeholder="Old Password" id="oldpass" list="demoList" value="" name="oldpass"/>
									</div>
								</div><br />
								<div class="row">
									<div class="col-xs-3">
										<label style=" #2d3e52;">New Password</label>
									</div>
									<div class="col-xs-6">
										<input type="text" class="form-control input-inline input-medium" placeholder="New Password" id="newpass" list="demoList" value="" name="newpass" required minlength="6"/>
									</div>
								</div><br />
								<div class="row">
									<div class="col-xs-3">
										<label style=" #2d3e52;">Confirm Password</label>
									</div>
									<div class="col-xs-6">
										<input type="text" class="form-control input-inline input-medium" placeholder="Confirm Password" id="conpass" list="demoList" value="" name="conpass" required minlength="6"/>
									</div>
								</div><br />
								<div class="col-xs-3">
									<label style=" #2d3e52;"></label>
								</div>
								<div class="col-xs-6">
									<input type="submit" class="btn btn-success" name = "submit" value="Submit">
									<input type="reset" class="btn btn-primary" value="Cancel">
								</div>
							</div><br />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		
	</div>

	