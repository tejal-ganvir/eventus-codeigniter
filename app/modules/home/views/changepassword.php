<script src="https://apis.google.com/js/platform.js" async defer></script>
<div class="kf_content_wrap" style="background:url(<?php echo base_url();?>themes/frontend/images/scenarioback.jpg) no-repeat; height:750px">
	<section>
		<div class="container">
			<div class="row">
				<div class="kode_wrapper">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="user-box">
								<h2>Change Password</h2>  
								<div class="form">
									<form id="changepass" action="" onsubmit="change_loginpassword();return false;" method="POST">
										<div class="input-container">
											<input type="password" name="oldpass" class="validate[required] validate[optional,minSize[6],maxSize[20]]" id="oldpass" value="" placeholder="Enter Old Password">
											<i class="fa fa-user"></i>
										</div>
										<div class="input-container">
											<input type="password" name="newpass" class="validate[required] validate[optional,minSize[6],maxSize[20]]" id="newpass" value="" placeholder="Enter New Password">
											<i class="fa fa-user"></i>
										</div> 
										<div class="input-container">
											<input type="password" name="conpass" class="validate[,equals[newpass]]" id="conpass" placeholder="Enter Confirm Password">
											<i class="fa fa-unlock"></i>
										</div>
										<div class="input-container">
											<button class="btn-style" name="signup" id="signup">Submit</button>
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
<script type="text/javascript">
$('#changepass').validationEngine('attach');
function change_loginpassword() {
  var oldp = $('#oldpass').val();
  var newp = $('#newpass').val();
  var conp = $('#conpass').val();
  if(oldp.match(/\s/g) || newp.match(/\s/g) || conp.match(/\s/g)){
    var msg = 'Remove space from password you enter..';
    alert_messagedisplay(msg);
  }
  else{
    if(oldp != '' && newp != '' && conp != ''){
      if(newp == conp){
        check_confirmation();
      }
    } 
  }
}
function check_confirmation(){
  	$.confirm({
        title: 'Confirmation Message',
        content: 'Are you sure, you want to change password ?',
        confirmButton: 'Proceed',
        confirmButtonClass: 'btn-info',
        icon: 'fa fa-question-circle',
        animation: 'scale',
        animationClose: 'top',
        opacity: 1, 
        confirm: function () {
            dataString = $("#changepass").serialize();
            $.ajax({type: "POST", url: "<?php echo base_url();?>home/change_thatpass", data: { dataString : dataString }, 
	            success: function(result) { 
	                if(result == 1) {
	                  $.alert({
	                      title: 'Success!',
	                      content: 'Your login password has been changed successfully...',
	                      confirmButton: 'Okay',
	                      confirmButtonClass: 'btn-warning',
	                      icon: 'fa fa-info',
	                      animation: 'zoom',
	                      opacity: 1,                                    
	                      confirm: function () {
	                          window.location.href = "<?php echo base_url();?>home/changepassword";
	                      	}
	                  	});
	                }
	                else if(result == 2){
	                   var msg = 'Please enter correct old password details and try again.';
	                  alert_messagedisplay(msg);
	                }
	                else if(result == 3){
	                  var msg = 'New Password and confirm password is not matching,Please try again.';
	                  alert_messagedisplay(msg);
	                }
	                else if(result == 4){
	                  var msg = 'New Password and old password cannot be same,Please try again.';
	                  alert_messagedisplay(msg);
	                }
	                else{
	                  var msg = 'Unable to change the password,Please try again.';
	                  alert_messagedisplay(msg);
	                }
	            }
            });
        }
    });
}
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