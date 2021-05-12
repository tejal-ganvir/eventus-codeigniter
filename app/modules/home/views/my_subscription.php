
<?php $this->load->view('frontend/topmenu'); ?> 
 <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3 side-nav" id="leftCol">
                    <div class="hide-side">
                        <ul class="listnone nav" id="sidebar">
                            <li><a href="<?php echo base_url();?>home/myaccount">My Profile</a></li>
                            <li><a href="<?php echo base_url();?>home/otp">Change Mobile No</a></li>
                            <li class="active"><a href="<?php echo base_url();?>home/my_subscription">My Subscriptions</a></li>
                            <li><a href="<?php echo base_url();?>home/my_booking">My Bookings</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 content-right profile-dashboard">
                    <div class="row">
                        <div class="col-md-12 dashboard-form">
                        	<div class="mypannel">
								<div class="tab">
								  <button class="tablinks active" onclick="openCity(event, 'London')">Service Subscription</button>
								  <button class="tablinks" onclick="openCity(event, 'Paris')">Space Subscription</button>
								</div>

								<div id="London" class="tabcontent">
								    <div class="container-fluid" style="padding-top: 20px;">
										<div class="row">
											<?php 
									            if($servicelist)
									            {
									              for ($i=0; $i < count($servicelist) ; $i++) 
									              {  
									            ?>
									            <div class="col-lg-12 col-sm-12 well">
										            <div class="col-md-4 col-sm-4">
										            	<div class="" style="border-radius: 20px;">
										                  <img src="<?php echo base_url();?>uploads/service_image/<?php echo $servicelist[$i]->image_name; ?>" width="190px;" height="150px;" alt=""/>
										                </div>
										            </div>
										            <div class="col-md-8 col-sm-8">
										                <p style="margin: 0;">Service Provider: <?php echo $servicelist[$i]->company;?></p>
										                <p style="margin: 0;">Selected Service: <?php echo $servicelist[$i]->title;?></p>
											            <p style="margin: 0;">Subscribed On: <?php echo date("d F Y", strtotime($servicelist[$i]->starts_on)); ?></p>
											            <p>Selected Plan: <span style='color:#25a032;font-weight: bolder;'>
										              		<?php
										              			if ($servicelist[$i]->plan_id == 1) {
										              				echo "Yearly Plan";
										              			}else{
										              				echo "Half Yearly Plan";
										              			}
										              		?>
										              		</span>
										              	</p>
										                 <a class="btn btn-info btn-sm" href ="<?php echo base_url();?>home/service_details/<?php echo $servicelist[$i]->uni_id."/".$servicelist[$i]->service_details_id;?>"  title="View Booking">View Service</a>
										                 <a class="btn btn-danger btn-sm service_comp" href ="<?php echo base_url();?>home/editservice/<?php echo $servicelist[$i]->uni_id ?>" >Edit Service</a>
										                 <a class="btn btn-warning btn-sm" href ="<?php echo base_url();?>home/renew_service_subscription/<?php echo $servicelist[$i]->uni_id ?>" >Renew</a>
									            	</div>
									            </div>
									            <hr>
									            <?php
									              }
									            }
									            else
									            {
									              ?><p style="color:#000;">Sorry, no records found</p><?php 
									            }
									           ?> 
										</div>
									</div>
								</div>

								<div id="Paris" class="tabcontent">
									<div class="container-fluid" style="padding-top: 20px;">
										<div class="row">
											<?php 
									            if($spacelist)
									            {
									              for ($i=0; $i < count($spacelist) ; $i++) 
									              {  
									            ?>
									            <div class="col-lg-12 col-sm-12  well">
										            <div class="col-md-4 col-sm-3">
										            	<div class="" style="border-radius: 20px;">
										                  <img src="<?php echo base_url();?>uploads/space_image/<?php echo $spacelist[$i]->image_name; ?>" width="190px;" height="150px;" alt=""/>
										                </div>
										            </div>
										            <div class="col-md-8 col-sm-9">
										                <p style="margin: 0;">Space Name: <?php echo $spacelist[$i]->company;?></p>
										                <p style="margin: 0;">Selected Venue: <?php echo $spacelist[$i]->title;?></p>
										              	<p style="margin: 0;">Subscribed On: <?php echo date("d F Y", strtotime($spacelist[$i]->starts_on)); ?></p>
										              	<p>Selected Plan: <span style='color:#25a032; font-weight: bolder;'>
										              		<?php
										              			if ($spacelist[$i]->plan_id == 1) {
										              				echo "Yearly Plan";
										              			}else{
										              				echo "Half Yearly Plan";
										              			}
										              		?>
										              		</span>
										              	</p>
										                <a class="btn btn-info btn-sm" href ="<?php echo base_url();?>home/space_details/<?php echo $spacelist[$i]->uni_id."/".$spacelist[$i]->space_id;?>" style=" " title="View Booking">View Space</a>
										                <a class="btn btn-danger btn-sm space_comp" href ="<?php echo base_url();?>home/editspace/<?php echo $spacelist[$i]->uni_id ?>">Edit Space</a>
										                <a class="btn btn-warning btn-sm" href ="<?php echo base_url();?>home/renew_space_subscription/<?php echo $spacelist[$i]->uni_id ?>">Renew</a>
									            	</div>
									            </div>
									            <hr>
									            <?php
									              }
									            }
									            else
									            {
									              ?><p style="color:#000;">Sorry, no records found</p><?php 
									            }
									           ?>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
// $(window).load(function() {
//  openCity(event, 'London');
// });

$('#London').show();

	function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>