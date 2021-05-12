<section id="basic-form-layouts">
  <div class="row">
        <div class="col-sm-12">
            <div class="content-header">Update Profile</div>
        </div>
    </div>
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title" id="bordered-layout-basic-form">Update A Profile</h4> 
                  <p class="mb-0">This section allows you to update your <b style="color: red;">Admin</b> profile . </p>
              </div>
              <div class="row justify-content-md-center">
    <div class="col-md-6">
      <div class="card">
              <?php 
                if($this->session->flashdata('success'))
              {
                echo '<div class="alert alert-success errormsg" style="margin-bottom:10px;">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('success').'
                  </div>';
                  } 
                  elseif($this->session->flashdata('error'))
                {
                  echo '<div class="alert alert-danger errormsg" style="margin-bottom:10px;">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('error').'
                  </div>';
                }
                ?> 
        <div class="card-body">
          <div class="px-3">

            <form class="form" method="post" action="<?php echo base_url();?>siteadmin/update_profile">

              <div class="form-body jumbotron shadow">
                 <input type="hidden" name="user_id" value="<?php echo $admin['user_id']?>">
                <input type="hidden" id="user_pass" value="<?php echo $admin['password']?>">

                <div class="form-group">
                  <label for="eventRegInput1">User Name</label>
                  <input type="text" id="eventRegInput1" class="form-control"  name="username" value="<?php echo $admin['username']?>">
                </div>

                <div class="form-group">
                  <label for="eventRegInput2">Mobile No</label>
                  <input type="text" id="eventRegInput2" class="form-control"  name="mobile" value="<?php echo $admin['mobile']?>">
                </div>

                <div class="form-group">
                  <label for="eventRegInput2">Email Id</label>
                  <input type="text" id="eventRegInput2" class="form-control"  name="email_id" value="<?php echo $admin['email_id']?>">
                </div>

                <div class="form-group">
                  <label for="eventRegInput3">Old Password</label>
                  <input type="password" class="form-control"  name="old_password" id="old_password">
                </div>

                <div class="form-group">
                  <label for="eventRegInput3">New Password</label>
                  <input type="password" class="form-control"  name="password" id="password">
                </div>

                <div class="form-group">
                  <label for="eventRegInput4">Confirm Password</label>
                  <input type="password"  class="form-control"  name="confirm_password" id="confirm_password">
                  <span id="message"></span>
                </div>

                
                </div>
              

              <div class="form-actions center">
                <button type="submit" class="btn btn-raised btn-primary" name="update" id="submit">
                  <i class="fa fa-check-square-o"></i> Save
                </button>
                <button type="reset" class="btn btn-raised btn-warning mr-1">
                  <i class="ft-x"></i> Cancel
                </button>
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});

     $('#submit').click(function(){

      if ($('#password').val() == '') { swal('Warning','Password feilds should not be empty'); return false; }
      if ($('#confirm_password').val() == '') { swal('Warning','Password feilds should not be empty'); return false; }

      if ($('#password').val() != $('#confirm_password').val()) {

        swal('Warning','Password and Confirm Password Must be same!');
        return false;

      }

      if ($('#old_password').val() != $('#user_pass').val()) {

        swal('Warning','Old Password is inccorect!');
        return false;

      }
      
    
    });

    });
</script>