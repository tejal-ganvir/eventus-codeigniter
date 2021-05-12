<!DOCTYPE html>
<html lang="en">

<!-- AIzaSyDm6GCA-bHvV1MB0s2kJdRkE_ImXzFqyKk -->
<head>
  <meta name="google-signin-client_id" content="25429090654-6qhbmjm7fftu7mefcsmg2ehs3fdohvcn.apps.googleusercontent.com">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#9de0e0">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#9de0e0">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#9de0e0">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- <meta name="google-signin-client_id" content="82253963139-jgml7809heqp0b5ail9kij4s63e8rfnh.apps.googleusercontent.com"> -->
    <title>Settle | Events Made Simple</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>themes/frontend/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/frontend/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/frontend/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/frontend/css/owl.theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/frontend/css/owl.transitions.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/frontend/css/fontello.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/frontend/css/datepicker.css"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/frontend/css/validationEngine.jquery.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/frontend/css/rateit.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/frontend/css/jquery-ui-1.10.4.custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>themes/frontend/css/jquery-confirm.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/admin/js/toastr-master/build/toastr.min.css">
    <!-- Font used in template -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,300italic,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- favicon icon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>themes/frontend/images/favicon.png" type="image/x-icon">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmVGINf7pdZm1WrWKpL3z8Fgm4y2_Y97k&libraries=places"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <style type="text/css">
      .logo img{
        height: 55px;
        width: 140px;
      }
      /*.listnone{padding-right: 21px;}
      @media (max-width:991px) { .listnone{padding-right: 0px;} }
      */
    </style>
</head>

<body>
    <div class="collapse" id="searcharea">
        <!-- top search -->
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
    <button class="btn btn-primary" type="button">Search</button>
    </span> </div>
    </div>
    <div id="reg-box" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="user-box">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2>Sign up as a User</h2>
            <div class="social-buttons">
              <div class="row">
                <div class="col-md-6">
                    <button class="loginBtn loginBtn--facebook"  onclick="GetLoginState();">
                      Sign up with Facebook
                    </button>
                </div>
                <div class="col-md-6">
                  <button class="loginBtn loginBtn--google" onclick="Google_Tab();">
                    Sign up with Google
                  </button>
                </div>
              </div>
            </div>
            <div class="signup-or-separator">
              <h3 >or</h3>
              <hr>
            </div>
            <span id="message"></span>
            <div class="alert-msg text-center"></div>
            <div class="form">
              <form id="users_signup" action="javascript:;" method="POST" onsubmit="User_Signup();return false;">
                <div class="input-container">
                  <input type="text" name="fname" id="fname" placeholder="Enter First Name" required="">
                  <i class="fa fa-user"></i>
                </div>
                <div class="input-container">
                  <input type="text" name="lname" id="lname" placeholder="Enter Last Name" required="">
                  <i class="fa fa-user"></i>
                </div>
                <div class="input-container">
                  <input type="email" name="email_id" id="email_id"  placeholder="Enter E-mail Id" required="">
                  <i class="fa fa-envelope-o"></i>
                </div>
                <div class="input-container">
                  <input type="password" name="password" id="password" placeholder="Enter Password" required="">
                  <i class="fa fa-unlock"></i>
                </div>
                <div class="input-container">
                  <input type="password" name="conpassword" id="confirm" placeholder="Confirm Password" required="">
                  <i class="fa fa-unlock"></i>
                </div>
                <div class="input-container">
                  <label> 
                    <span style="color:#777777;font-size: 14px;">By signing up, I agree to Settle’s Terms of Service, Payments Terms of Service, Privacy Policy.</span>
                  </label>
                </div>
                <div class="text-left">
                  <button type="submit" name="signup" id="signup" class="btn btn-default" >Sign Up</button>
                </div>
              </form>
            </div>
          </div>
          <div class="user-box-footer">
            Already have an account? <a href="#" onclick="LoginAfterRegistration();">Sign In</a>
          </div>
        </div>

      </div>
    </div>
    <div id="signin-box" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="user-box">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2>Sign In</h2>
            <div class="row">
              <div class="col-md-6">
                    <button class="loginBtn loginBtn--facebook"  onclick="GetLoginState();">
                      Sign in with Facebook
                    </button>
                </div>
                <div class="col-md-6">
                  <button class="loginBtn loginBtn--google" onclick="Google_Tab();">
                    Sign in with Google
                  </button>
                </div>
            </div>
            <div class="signup-or-separator">
              <h3 >or</h3>
              <hr>
            </div>
            <div class="alert-msg text-center"></div>
            <div class="form">
              <form id="users_signin" action="javascript:;" method="POST" onsubmit="User_Signin();return false;">
                <div class="input-container">
                  <input type="email" name="email" id="email" placeholder="Enter E-mail Id" required="">
                  <i class="fa fa-envelope-o"></i>
                </div>
                <div class="input-container">
                  <input type="password" name="pass" id="pass" placeholder="Enter Password" required="">
                  <i class="fa fa-unlock"></i>
                </div>
                <div class="input-container" style="padding-left: 0px;">
                  <label>
                    <span class="radio">
                      <input type="checkbox" name="foo" value="1" checked style="float: left;position: relative; left:-20px;">
                      <span style="font-size: 12px;position: relative; left:-15px;">Remember me</span>
                    </span>
                    
                  </label>
                </div>
                <div class="input-container text-left">
                  <button class="btn btn-default" name="signin" id="signin">Sign In</button>
                </div>
                <a href="<?php echo base_url();?>home/forgotpassword" style="color:#659e8e;">Forgot Password ?</a> 
              </form>
            </div>
          </div>
          <div class="user-box-footer">
            <p>Don't have an account?<br><a href="#" onclick="RegistrationAfterLogin();">Sign up as a User</a></p>
          </div>
        </div>
      </div>
    </div>
  <?php 
    $page = $this->uri->segment(2);
    $page_menu = ''; if(isset($selected_menu)) { if(strlen($selected_menu) > 0) { $page_menu = trim($selected_menu); } }
    if($page==""){
  ?>
    <!-- /.top search -->

    <div class="header-v2 navbar-fixed-top">
        <div class="top-bar-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 top-message">
                        <p style="padding-left: 10px;">Welcome to Settle</p>
                    </div>
                    <div class="col-md-6 top-links">
                        <ul class="listnone" style="padding-right: 20px;">
                            <?php $user_id = $this->home_model->isloggeduserIn();
                              if(empty($user_id))
                              {
                                ?>
                                <li class="hidden-xs"><a href="<?php echo base_url();?>home/host_register" >Offer a Service</a></li>
                                <!-- <li class="hidden-xs"><a href="#" >Help</a></li> -->
                                <li><a href="#" data-toggle="modal" data-target="#reg-box"><i class="fa fa-user"></i>&nbsp;Sign Up</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#signin-box"><i class="fa fa-user"></i>&nbsp;Log In</a></li>
                            <?php } 
                            else{ 
                                $name = '';
                                $name = $this->session->userdata('fname'); 
                                ?>
                                <li class="hidden-xs"><a href="#">Welcome <?php echo $name ;?></a> </li>  
                                <li><a href="<?php echo base_url();?>home/myaccount"><i class="fa fa-user"></i>&nbsp; My account</a></li>
                                <!-- <li class="hidden-xs"><a href="<?php echo base_url();?>home/changepassword"><i class="fa fa-unlock"></i>&nbsp; Change Password </a></li>   -->
                                <li><a href="<?php echo base_url();?>home/view_cart"><i class="fa fa-shopping-cart"></i>&nbsp; View Cart </a></li>
                                <li><a href="<?php echo base_url();?>home/user_logout"><i class="fa fa-sign-out"></i>&nbsp; LogOut </a></li>  
                              <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 logo">
                    <div class="navbar-brand">
                        <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>themes/frontend/images/logo-2.png" alt="Wedding Vendors" class="img-responsive"></a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="navigation" id="navigation">
                        <ul>
                            <li <?php if($page==""){?> class="active" <?php }?>><a href="<?php echo base_url();?>">HOME</a></li>
                            <li <?php if($page=="about"){?> class="active" <?php }?>><a href="<?php echo base_url();?>home/about">ABOUT US</a></li>
                            <li <?php if($page=="venue"){?> class="active" <?php }?>><a href="<?php echo base_url();?>home/venue">VENUE</a></li>
                            <li <?php if($page=="service"){?> class="active" <?php }?>><a href="<?php echo base_url();?>home/service">SERVICES</a></li>
                            <li <?php if($page=="scenario"){?> class="active" <?php }?>><a href="<?php echo base_url();?>home/scenario">SCENARIO</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php }else{ ?>
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6 top-message">
                    <p style="padding-left: 10px;">Welcome to Settle</p>
                </div>
                <div class="col-md-6 top-links">
                    <ul class="listnone" style="padding-right: 20px;">
                        <?php $user_id = $this->home_model->isloggeduserIn();
                              if(empty($user_id))
                              {
                                ?>
                                <li class="hidden-xs"><a href="<?php echo base_url();?>home/host_register" >Offer a Service</a></li>
                                <!-- <li class="hidden-xs"><a href="#" >Help</a></li> -->
                                <li><a href="#" data-toggle="modal" data-target="#reg-box"><i class="fa fa-user"></i>&nbsp;Sign Up</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#signin-box"><i class="fa fa-user"></i>&nbsp;Log In</a></li>
                            <?php } 
                            else{ 
                                $name = '';
                                $name = $this->session->userdata('fname'); 
                                ?>
                                <li class="hidden-xs"><a href="#">Welcome <?php echo $name ;?></a> </li>  
                                <li><a href="<?php echo base_url();?>home/myaccount"><i class="fa fa-user"></i>&nbsp; My account</a></li>
                                <!-- <li class="hidden-xs"><a href="<?php echo base_url();?>home/changepassword"><i class="fa fa-unlock"></i>&nbsp; Change Password </a></li>  --> 
                                <li><a href="<?php echo base_url();?>home/view_cart"><i class="fa fa-shopping-cart"></i>&nbsp; View Cart </a></li>
                                <li><a href="<?php echo base_url();?>home/user_logout"><i class="fa fa-sign-out"></i>&nbsp; LogOut </a></li>
                              <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 logo">
                    <div class="navbar-brand">
                        <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>themes/frontend/images/logo-2.png" alt="Wedding Vendors" class="img-responsive"></a>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="navigation" id="navigation">
                        <ul>
                            <li <?php if($page==""){?> class="active" <?php }?>><a href="<?php echo base_url();?>">HOME</a></li>
                            <li <?php if($page=="about"){?> class="active" <?php }?>><a href="<?php echo base_url();?>home/about">ABOUT US</a></li>
                            <li <?php if($page=="venue"){?> class="active" <?php }?>><a href="<?php echo base_url();?>home/venue">VENUE</a></li>
                            <li <?php if($page=="service"){?> class="active" <?php }?>><a href="<?php echo base_url();?>home/service">SERVICES</a></li>
                            <li <?php if($page=="scenario"){?> class="active" <?php }?>><a href="<?php echo base_url();?>home/scenario">SCENARIO</a></li>
                        </ul>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
  <?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    // $('#password, #confirm').on('keyup', function () {
    //   if ($('#password').val() == $('#confirm').val()) {
    //     $('#message').html('Matching').css('color', 'green');
    //   } else 
    //     $('#message').html('Not Matching').css('color', 'red');
    // });
});
</script>
<script type="text/javascript">
    $('#users_signup').validationEngine('attach');
    $('#users_signin').validationEngine('attach');

    function UserSignupClear() {
      $('#users_signup input#fname').val('');
      $('#users_signup input#lname').val('');
      $('#users_signup input#email_id').val('');
      $('#users_signup input#password').val('');
      return false;
    }

    function User_Signup(){
    // $('#users_signup button[type="submit"]').text("Please Wait..."); $('#users_signup button[type="submit"]').attr('disabled', 'disabled');
    // $('#signup').text("Please Wait..."); 
    // $('#signup').addClass('mydisabled');
      var fname = $('#fname').val();
      var lname = $('#lname').val();
      var email_id = $('#email_id').val();
      var password = $('#password').val(); 
      var confirm = $('#confirm').val(); 
      if(password != confirm){
        $('#message').html("Password and Confirm password does not match!!").css('color', 'red');
        return false;
      }

        if(fname != '' && lname != '' && email_id != '' && password != ''){
          $.ajax({type: "POST", url: "<?php echo base_url();?>home/users_signup", data: { fname: fname, lname: lname, email_id: email_id,password: password},
            success: function(result) {
              result = parseInt(result);
              
              if(result > 0) {
                LoginAfterRegistration();
                UserSignupClear();
                $('#signin-box div.alert-msg').html('<div class="alert" style="padding:10px 15px;margin-bottom:0px;"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button><p style="color:green;">Registration has been done successfully, Please check your email. We’ve sent you a verification link...</p></div>');
              } 
              else if(result == -1){
                $('#reg-box div.alert-msg').html('<div class="alert" style="padding:10px 15px;margin-bottom:0px;"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button><p style="color:red;">Email id is already present. Please use another email id for registration..</p></div>');
              }
              else {
                $('#reg-box div.alert-msg').html('<div class="alert" style="padding:10px 15px;margin-bottom:0px;"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button><p style="color:red;">Unable to create new user. Please try again..</p></div>');
              }
            },
            complete: function() {
              $('#users_signup button[type="submit"]').text("SignUp"); $('#users_signup button[type="submit"]').removeAttr('disabled');
            }
         });
        }
        else{
          $('#users_signup button[type="submit"]').text("SignUp"); $('#users_signup button[type="submit"]').removeAttr('disabled');
        } 
    }

    function RegistrationAfterLogin(){
      HideShowModal('signin-box', 'reg-box');
    }

    function LoginAfterRegistration(){      
      HideShowModal('reg-box', 'signin-box');
    }

    function HideShowModal(h, s){
      $('#'+h).modal('hide');
      $('#'+h).on('hidden.bs.modal', function () {
        $('#'+s).modal('show');
        $('#'+h).unbind('hidden.bs.modal');
      });
    }

    function User_Signin(){
    $('#users_signin button[type="submit"]').text("Please Wait..."); $('#users_signin button[type="submit"]').attr('disabled', 'disabled');
      var email_id = $('#email').val();
      var password = $('#pass').val(); 
      if(email_id != '' && password != ''){
        $.ajax({type: "POST", url: "<?php echo base_url();?>home/users_signin", data: { email_id: email_id,password: password},
          success: function(result) {
            result = parseInt(result); 
            if(result == 1) {
              window.location.href = "<?php echo base_url();?>home/myaccount";
              UserSigninClear();
            }else if(result == 3){
              window.location.href = "<?php echo base_url();?>home/blocked";
              UserSigninClear();
            }  
            else {
              $('#signin-box div.alert-msg').html('<div class="alert" style="padding:10px 15px;margin-bottom:0px;"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button><p style="color:red;">Invalid email id or password. Please try again..</p></div>');
            }
          },
          complete: function() {
            $('#users_signin button[type="submit"]').text("SignUp"); $('#users_signin button[type="submit"]').removeAttr('disabled');
          }
       });
      }
      else{
        $('#users_signin button[type="submit"]').text("SignUp"); $('#users_signin button[type="submit"]').removeAttr('disabled');
      }
    } 

    function UserSigninClear(){ 
      $('#users_signin input#email').val('');
      $('#users_signin input#pass').val('');
      return false;
    }
</script>