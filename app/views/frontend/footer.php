<div class="footer">
        <!-- Footer -->
        <div class="container">
            <div class="row">
                <div class="col-md-5 ft-aboutus">
                    <h2>Events Made Simple</h2>
                    <p>We are a team of crazy and insane people who love to organize events overseas and we know how hard it is to find the right place, people and catering services. And what about getting to the place and booking a place to stay at night?</p>
                    <p>That ALL is here - in one place!!! First online scenario is here! We are still upgrading the page; thus we ask for your understanding if something is not working properly yet.</p>
                </div>
                <div class="col-md-3 ft-link">
                    <h2>Useful links</h2>
                    <ul>
                        <li><a href="<?php echo base_url();?>home/home">Home</a></li>
                        <li><a href="<?php echo base_url();?>home/venue">Venue</a></li>
                        <li><a href="<?php echo base_url();?>home/service">Service</a></li>
                        <li><a href="<?php echo base_url();?>home/scenario">Scenario</a></li>
                        <li><a href="<?php echo base_url();?>home/about">About Us</a></li>
                        <li><a href="<?php echo base_url();?>home/view_cart">View Cart</a></li>
                    </ul>
                </div>
                <div class="col-md-4 newsletter">
                    <h2>For Enquiry!!</h2>
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter E-Mail Address" required>
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Submit</button>
                            </span> 
                        </div>
                        <!-- /input-group -->
                        <!-- /.col-lg-6 -->
                    </form>
                    <div class="social-icon text-center">
                        <h2>Be Social &amp; Stay Connected</h2>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                            <!-- <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li> -->
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <!-- <li><a href="#"><i class="fa fa-flickr"></i></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Footer -->
    <div class="tiny-footer">
        <!-- Tiny footer -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">Copyright © 2019. All Rights Reserved</div>
            </div>
        </div>
    </div>
    <!-- /. Tiny Footer -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="<?php echo base_url();?>themes/frontend/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>themes/frontend/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url();?>themes/frontend/js/jquery-ui-1.10.4.custom.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>themes/frontend/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>asset/admin/js/toastr-master/build/toastr.min.js"></script>
    <!-- Flex Nav Script -->
    <script src="<?php echo base_url();?>themes/frontend/js/jquery.flexnav.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>themes/frontend/js/navigation.js"></script>
    <!-- <script src="<?php echo base_url();?>themes/frontend/js/bootstrap-datepicker.js"></script> -->
    <script src="<?php echo base_url();?>themes/frontend/js/date-script.js"></script>
    <script src="<?php echo base_url();?>themes/frontend/js/jquery.validationEngine.js"></script>
    <script src="<?php echo base_url();?>themes/frontend/js/jquery.rateit.js"></script>
    <script src="<?php echo base_url();?>themes/frontend/js/jquery-confirm.js"></script>
    <!-- slider -->
    <script src="<?php echo base_url();?>themes/frontend/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/frontend/js/slider.js"></script>
    <!-- sticky header -->
    <script type="text/javascript" src="<?php echo base_url();?>themes/frontend/js/thumbnail-slider.js"></script>
    <script src="<?php echo base_url();?>themes/frontend/js/jquery.sticky.js"></script>
    <script src="<?php echo base_url();?>themes/frontend/js/header-sticky.js"></script>
    
</body>

</html>
<script type="text/javascript">
function Google_Tab(){
  $.ajax({
    type : "POST",
    url : "<?php echo base_url();?>home/create_google_ajaxurl",
    success : function(result){
      window.location.href = result;
    }
  });
}
function statusChangeToCallback(response) 
{
  if (response.status === 'connected')
  {
    testAPI_ToLogin();
  }
  else if(response.status === 'not_authorized')
  { 
  } 
  else
  {
  }
}
function GetLoginState()
{
  FB.login(function(response) { 
   statusChangeToCallback(response); 
 }, {scope: 'public_profile,email'}); 
}

window.fbAsyncInit = function()
{
  FB.init({
    appId      : '1207536552736345',
    cookie     : true,  //enable cookies to allow the server to access //the session
    xfbml      : true,  //parse social plugins on this page
    version    : 'v2.2' //use version 2.2
  });

  FB.getLoginStatus(function(response)
  {
   // statusChangeCallback(response);
  });
};

(function(d, s, id)
{
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk')
);

function testAPI_ToLogin()
{
   

  FB.api('/me', {fields: 'email,first_name,middle_name,last_name'},function(response)
  {  
    FB.api("/me/permissions", function(response) {
console.log(response);
});
    var msgData = {'email': response.email,'first_name': response.first_name,'last_name': response.last_name}
    $.ajax({
      type: "POST",
      url: "<?php echo base_url();?>home/facebook_signup",
      data: msgData,
      success : function(result){
        if(result == 1){
          window.location.href = "<?php echo base_url();?>home/myaccount";
        }
        else if(result == 2){
          window.location.href = "<?php echo base_url();?>home/host_register";
        }
        else{
          var str = encodeURIComponent(response.email); 
          window.location.href = "<?php echo base_url();?>home/social_profilelogin/"+response.first_name+"/"+response.last_name+"/"+str;
        }
      }, 
    });
  });
}


function footer_form(){
  var name=$('#yourname').val();
  var email=$('#youremail').val();
  var subject=$('#yoursubject').val();
  var message=$('#yourmessage').val();
  $.ajax({
    type : "POST",
    url : "<?php echo base_url();?>home/footer_form",
    data: {name:name,email:email},
    success : function(result){
      window.location.href = result;
    }
  });
}
</script> 
