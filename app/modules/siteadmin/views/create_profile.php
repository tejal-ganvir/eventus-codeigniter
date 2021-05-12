<section id="basic-form-layouts">
  <div class="row">
        <div class="col-sm-12">
            <div class="content-header">Create Profile</div>
        </div>
    </div>
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title" id="bordered-layout-basic-form">Ceate A Profile</h4> 
                  <p class="mb-0">This section allows you to create a profile either <b style="color: red;">Admin</b> or <b style="color: red;"> Editor</b>. <br> Editor will have limited authorities as compared to admin.</p>
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

            <form class="form" method="post" action="<?php echo base_url();?>siteadmin/createmy_profile">

              <div class="form-body jumbotron shadow">

                <div class="form-group">
                  <label for="eventRegInput1">Full Name</label>
                  <input type="text" id="eventRegInput1" class="form-control"  name="firstname">
                </div>

                <div class="form-group">
                  <label for="eventRegInput2">Login ID</label>
                  <input type="text" id="eventRegInput2" class="form-control"  name="username">
                </div>

                <div class="form-group">
                  <label>Role</label>
                  <div class="input-group">
                    <div class="custom-control custom-radio display-inline-block">
                      <input type="radio" id="customRadioInline3" checked name="role" class="custom-control-input" value="admin">
                      <label class="custom-control-label" for="customRadioInline3">Admin</label>
                    </div>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="custom-control custom-radio display-inline-block">
                      <input type="radio" id="customRadioInline4" name="role" class="custom-control-input" value="editor">
                      <label class="custom-control-label" for="customRadioInline4">Editor</label>
                    </div>
                  </div>

                <div class="form-group">
                  <label for="eventRegInput3">Create Password</label>
                  <input type="password" class="form-control"  name="password" id="password">
                </div>

                <div class="form-group">
                  <label for="eventRegInput4">Confirm Password</label>
                  <input type="password"  class="form-control"  name="confirm_password" id="confirm_password">
                  <span id="message"></span>
                </div>

                
                </div>
              </div>

              <div class="form-actions center">
                <button type="submit" class="btn btn-raised btn-primary" name="submit" id="submit">
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


<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users Profile Details</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <p class="card-text"></p>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Login Id</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                                if($admin){
                                  for($i=0 ; $i < count($admin); $i++)
                                  {

                              ?>
                                <tr id="row<?php echo $admin[$i]->user_id?>">
                                    <td><?php echo $admin[$i]->firstname?></td>
                                    <td><?php echo $admin[$i]->username?></td>
                                    <td><?php echo $admin[$i]->password?></td>
                                    <td><?php echo $admin[$i]->role?></td>
                                    <td>
                                        <a class="danger p-0" data-id="<?php echo $admin[$i]->user_id?>">
                                          <i class="ft-trash-2 font-medium-3 mr-2"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php  
                                  }
                                }?>
                                
                                                                    
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Login Id</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
      
    
    });

    });

  $(".danger").on('click',function(){
        var id = $(this).attr('data-id');
        swal({
                    title: 'Are you sure?',
                    text: "You want to delete this user!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Confirm',
                    cancelButtonText: "No, cancel"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({type: "POST", url: "<?php echo base_url();?>siteadmin/delete_admin", data: { id:id},
                              success: function(result) {
                                result = parseInt(result);
                                if(result > 0) {
                                  $("#row"+result).hide('2000');
                                }
                              }

                             });
                        swal(
                            'Deleted!',
                            'User is successfully deleted!!',
                            'success'
                        );
                    }
                }).catch(swal.noop);
      });
</script>