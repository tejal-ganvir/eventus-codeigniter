<style type="text/css">
  

  #slider {
  position: relative;
  overflow: hidden;
  margin: 20px auto 0 auto;
  border-radius: 4px;
}

#slider ul {
  position: relative;
  margin: 0;
  padding: 0;
  height: 300px;
  list-style: none;
}

#slider ul li {
  position: relative;
  display: block;
  float: left;
  margin: 0;
  padding: 0;
  width: 350px;
  height: 220px;
  background: #ccc;
  text-align: center;
  line-height: 200px;
}

#slider ul li img{
  
  }

a.control_prev, a.control_next {
  position: absolute;
  top: 40%;
  z-index: 999;
  display: block;
  padding: 4% 3%;
  width: auto;
  height: auto;
  background: #2a2a2a;
  color: #fff;
  text-decoration: none;
  font-weight: 600;
  font-size: 18px;
  opacity: 0.8;
  cursor: pointer;
}

a.control_prev:hover, a.control_next:hover {
  opacity: 1;
  -webkit-transition: all 0.2s ease;
}

a.control_prev {
  display: none;
  border-radius: 0 2px 2px 0;
}

a.control_next {
  display: none;
  right: 0;
  border-radius: 2px 0 0 2px;
}

@media screen and (max-width: 500px) {

#slider {
padding-top: 50px;
}
/*#slider ul li {
  position: relative;
  display: block;
  float: left;
  margin: 0;
  padding: 0;
  width: 250px;
  height: 150px;
  background: #ccc;
  text-align: center;
  line-height: 100px;
}*/

#slider ul li img{
  width: 100%;
  }
 
}
</style>
<div id="wrapper" class="kf_content_wrap" style="background:url(<?php echo base_url();?>themes/frontend/images/myscenario.jpg) no-repeat; background-size: cover;">
	<br></br>
	<div class="row">
		<div class="container">
			<div class="text-center"><h3  style="color:#FFF">Payment</h3></div>
		</div>
	</div>
	<br>

		<?php

		if (isset($_POST['startdate'])) 
			$startdate=$_POST['startdate'];
		else
			$startdate='';


		if (isset($_POST['enddate'])) 
			$enddate=$_POST['enddate'];
		else
			$enddate='';
		

		?>
		<div class="container">
		  <div class="row well">
		  	<!-- <h4>Request To Book</h4> --><br>
			<div class="col-lg-8">
			<h5 style="color:#66727f">When is your activity taking place?</h5><br> 
				<div class="row">
					<div class="col-lg-6">
						<p><b>Start:</b></p>
						<div class="myinput">
			              <input type="text" class="validate[required] text-input" name="startdate" value="<?php echo $startdate; ?>" placeholder="Start Date" readonly>
			            </div>
					</div>
					<div class="col-lg-6">
						<p><b>End:</b></p>
						<div class="myinput">
			              <input type="text" class="validate[required] text-input" name="enddate" value="<?php echo $enddate; ?>" placeholder="End Date" readonly>
			            </div>
					</div>
					<!-- <div class="col-lg-6">
						<div class="myinput">
			              <select class="select-css select_css_time validate[required]" name="from_time" id="from_time">
			                <option value="">Start Time</option> 
			                <option value="12 AM">12:00am</option>
			                <option value="1 AM">1:00am</option>
			                <option value="2 AM">2:00am</option>
			                <option value="3 AM">3:00am</option>
			                <option value="4 AM">4:00am</option>
			                <option value="5 AM">5:00am</option>
			                <option value="6 AM">6:00am</option>
			                <option value="7 AM">7:00am</option>
			                <option value="8 AM">8:00am</option>
			                <option value="9 AM">9:00am</option>
			                <option value="10 AM">10:00am</option>
			                <option value="11 AM">11:00am</option>
			                <option value="12 PM">12:00am</option>
			                <option value="1 PM">1:00pm</option>
			                <option value="2 PM">2:00pm</option>
			                <option value="3 PM">3:00pm</option>
			                <option value="4 PM">4:00pm</option>
			                <option value="5 PM">5:00pm</option>
			                <option value="6 PM">6:00pm</option>
			                <option value="7 PM">7:00pm</option>
			                <option value="8 PM">8:00pm</option>
			                <option value="9 PM">9:00pm</option>
			                <option value="10 PM">10:00pm</option>
			                <option value="11 PM">11:00pm</option>
			              </select> 
			            </div>
					</div>
 -->

				</div>
				<!-- <div class="row">
					<div class="container">
						<p><b>End:</b></p>
					</div>
					<div class="col-lg-12">
						<div class="myinput">
			              <input type="text" class="validate[required] text-input" name="enddate" value="<?php echo $enddate; ?>" placeholder="End Date" readonly>
			            </div>
					</div>
					<div class="col-lg-6">
						<div class="myinput">
			              <select class="select-css select_css_time validate[required]" name="end_time" id="end_time">
			                <option value="">End Time</option> 
			                <option value="12 AM">12:00am</option>
			                <option value="1 AM">1:00am</option>
			                <option value="2 AM">2:00am</option>
			                <option value="3 AM">3:00am</option>
			                <option value="4 AM">4:00am</option>
			                <option value="5 AM">5:00am</option>
			                <option value="6 AM">6:00am</option>
			                <option value="7 AM">7:00am</option>
			                <option value="8 AM">8:00am</option>
			                <option value="9 AM">9:00am</option>
			                <option value="10 AM">10:00am</option>
			                <option value="11 AM">11:00am</option>
			                <option value="12 PM">12:00am</option>
			                <option value="1 PM">1:00pm</option>
			                <option value="2 PM">2:00pm</option>
			                <option value="3 PM">3:00pm</option>
			                <option value="4 PM">4:00pm</option>
			                <option value="5 PM">5:00pm</option>
			                <option value="6 PM">6:00pm</option>
			                <option value="7 PM">7:00pm</option>
			                <option value="8 PM">8:00pm</option>
			                <option value="9 PM">9:00pm</option>
			                <option value="10 PM">10:00pm</option>
			                <option value="11 PM">11:00pm</option>
			              </select> 
			            </div>
					</div>
				</div> -->

				<br>
				<div class="myinput">
					<h5 style="color:#66727f">Message Your Host</h5><br> 
		             <textarea class="validate[required] text-input validate[optional]" name="message" id="description"  placeholder="Message For Host"></textarea>
		        </div>


		        <div class="form">
		        	
		        	<h5 style="color:#66727f">How Would You Like To Pay?</h5><br>
		        	<div class="myinput">
		        		<div class="row">
		        			<div class="col-md-8">
								<p><b>Name On Card:</b></p> 
			             		<input type="text" class="validate[required] text-input" name="name" value="" placeholder="Full Name">
					         </div>
					     </div>
					     <div class="row">
		        			<div class="col-md-8">
								<p><b>Card Number:</b></p> 
			             		<input type="text" class="validate[required] text-input" name="card_number" value="" placeholder="1234-1234-1234-1234">
					         </div>
					         <div class="col-md-4">
					         	<p>&nbsp;</p> 
					         	<img src="<?php echo base_url();?>themes/frontend/images/master.png">
					         	<img src="<?php echo base_url();?>themes/frontend/images/rupay.png">
					         	<img src="<?php echo base_url();?>themes/frontend/images/visa.png">
					         </div>
					     </div>

					     <div class="row">
		        			<div class="col-md-4">
								<p><b>Expiry Month:</b></p> 
			             		<select class="select-css select_css_time validate[required]" name="exp_month" >
			             			<option value="">Select Month</option>
			             			<option value="january">January</option>
			             			<option value="february">February</option>
			             			<option value="march">March</option>
			             			<option value="april">April</option>
			             			<option value="may">May</option>
			             			<option value="june">June</option>
			             			<option value="july">July</option>
			             			<option value="august">August</option>
			             			<option value="september">September</option>
			             			<option value="october">October</option>
			             			<option value="november">November</option>
			             			<option value="december">December</option>
			             		</select>
					        </div>
					        <div class="col-md-4">
								<p><b>Expiry Year:</b></p> 
			             		<select class="select-css select_css_time validate[required]" name="exp_year" >
			             			<option value="">Select Year</option>
			             			<option value="2019">2019</option>
			             			<option value="2020">2020</option>
			             			<option value="2021">2021</option>
			             			<option value="2023">2023</option>
			             			<option value="2024">2024</option>
			             			<option value="2025">2025</option>
			             			<option value="2026">2026</option>
			             			<option value="2027">2027</option>
			             			<option value="2028">2028</option>
			             			<option value="2029">2029</option>
			             			<option value="2030">2030</option>
			             			<option value="2031">2031</option>
			             		</select>
					        </div>

					        <div class="col-md-4">
								<p><b>Security Code:</b></p> 
			             		<input type="text" class="validate[required] text-input" name="cvc" placeholder="CVC">
					        </div>
					     </div>

					     <div class="row">
		        			<div class="col-md-8">
								<p><b>Contact Number:</b></p> 
			             		<input type="text" class="validate[required] text-input" maxlength="10" name="contact_number" value="" placeholder="+91**********">
					        </div>
					    </div>
		        	</div>
		        </div>
			</div>
			<div class="col-lg-4"> 
				<div id="slider">
				  <a href="#" class="control_next">></a>
				  <a href="#" class="control_prev"><</a>
				  <ul>
				    <?php 
				      if($service_image)
				      {
				        for ($k=0; $k < count($service_image); $k++) 
				        {  

				    ?>

				    <li><img  src="<?php echo base_url();?>uploads/service_image/<?php echo $service_image[$k]->name; ?>" class="img-fluid" alt=""width="100%"/> </li>
				    <?php 
				        }
				      }
				    ?>
				  </ul>  
				</div>
				<br>
				<div style="padding: 10px 10px 10px 20px; border: 1px solid #449E8E; border-radius: 20px; ">
					<p style="color:#000; font:bolder; font-size:22px; font-family: 'Times New Roman', Times, serif;"><?php if($service_detail){ echo $service_detail['company'];}?></p>
					<p style="color:#000; font:bolder; font-size:18px; font-family: 'Times New Roman', Times, serif;"><?php if($service_detail){ echo $service_detail['landmark']." ".$service_detail['my_add'];}?> &nbsp; </p>
				</div>

				<table>
					<caption>Pricing</caption>
					<tr>
						<td>service Price:</td>
						<td>₹ <?php echo $service_detail['base_price']; ?></td>
					</tr>
					<tr>
						<td>Service Fee:</td>
						<td>₹ 500</td>
					</tr>
					<tr>
						<td>Discount:</td>
						<td>₹ 100</td>
					</tr>
					<tr>
						<td>Payable Amount:</td>
						<td>₹ <?php echo $service_detail['base_price']+400; ?></td>
					</tr>
				</table>
				<br>
				<h6>What's Next?</h6>
				<p>
					The service owner has 2 business days to confirm or decline your request, if the owner declines or dosent respond, and you will not charged. Your booking is subject to the cancellation and refund policy set by the service provider.
				</p>
				<br>
				<div class="input-container">
	              <button type="submit" class="btn btn-block btn-lg" style=" margin-top:10px; margin-bottom:15px;background-color:#449E8E; color: #FFF;">Send Booking Request</button>
	            </div>
			</div>
		</div>
	</div>
</div>

      <script type="text/javascript">
    jQuery(document).ready(function ($) {

    setInterval(function () {
        moveRight();
    }, 3000);
  

  
  var slideCount = $('#slider ul li').length;
  var slideWidth = $('#slider ul li').width();
  var slideHeight = $('#slider ul li').height();
  var sliderUlWidth = slideCount * slideWidth;
  
  $('#slider').css({ width: slideWidth, height: slideHeight });
  
  $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
  
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });


     $("#slider").mouseenter(function(){
        $('a.control_next,a.control_prev').fadeIn(1000,function(){
            $('#slider').mouseleave(function(){
                $('a.control_next,a.control_prev').fadeOut(1000);
            });
        });
    });

});    

  </script>