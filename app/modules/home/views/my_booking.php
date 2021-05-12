<?php $this->load->view('frontend/topmenu'); ?>
<!--Model Popup starts-->
			<div class="modal fade" id="urModal" role="dialog">
			            <div class="modal-dialog">
			                <div class="modal-content">
			                    <div class="modal-body">
			                       
									<div class="thank-you-pop">
										<h6>THANK YOU FOR POSTING A REVIEW!</h6>
										<img src="<?php echo base_url();?>themes/frontend/images/like.png" alt="">
										<p>Your review has been sent successfully and now is waiting of our staff to publish it.</p>
										<button type="button" class="btn btn-info" data-dismiss="modal" aria-label="" style="border-radius: 0px;">ITS MY PLEASURE</button>
										
			 						</div>
			                         
			                    </div>
								
			                </div>
			            </div>
			</div>

			<div class="modal fade" id="urModal2" role="dialog">
			            <div class="modal-dialog">
			                <div class="modal-content">
			                    <div class="modal-body">
			                       
									<div class="thank-you-pop">
										<h6>THANK YOU FOR POSTING A REVIEW!</h6>
										<img src="<?php echo base_url();?>themes/frontend/images/like.png" alt="">
										<p>Your review was updated successfully and now is waiting of our staff to publish it.</p>
										<button type="button" class="btn btn-info" data-dismiss="modal" aria-label="" style="border-radius: 0px;">ITS MY PLEASURE</button>
										
			 						</div>
			                         
			                    </div>
								
			                </div>
			            </div>
			</div>
		  <!--Model Popup ends-->
 <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3 side-nav" id="leftCol">
                    <div class="hide-side">
                        <ul class="listnone nav" id="sidebar">
                            <li><a href="<?php echo base_url();?>home/myaccount">My Profile</a></li>
                            <li><a href="<?php echo base_url();?>home/otp">Change Mobile No</a></li>
                            <li><a href="<?php echo base_url();?>home/my_subscription">My Subscriptions</a></li>
                            <li class="active"><a href="<?php echo base_url();?>home/my_booking">My Bookings</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 content-right profile-dashboard">
                    <div class="row">
                        <div class="col-md-12 dashboard-form">
                        	<div class="mypannel">
								<div class="tab">
								  <button class="tablinks active" onclick="openCity(event, 'London')">Service Booking</button>
								  <button class="tablinks" onclick="openCity(event, 'Paris')">Space Booking</button>
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
										                  <img src="<?php echo base_url();?>uploads/service_image/<?php echo $servicelist[$i]->image_name; ?>" width="200px;" height="160px;" alt=""/>
										                </div>
										            </div>
										            <div class="col-md-8 col-sm-8">
										                <p style="margin: 0;">Service Provider: <?php echo $servicelist[$i]->company;?></p>
										                <p style="margin: 0;">Selected Service: <?php echo $servicelist[$i]->title;?></p>
											            <p style="margin: 0;">Booked on: <?php echo date("d F Y", strtotime($servicelist[$i]->startdate)); ?></p>
											            <p>Status: <b>
											            	<?php 
				                                            if ($servicelist[$i]->chk_status == 2) {
				                                              echo "<span style='color:#25a032'>Completed</span>";
				                                            }elseif($servicelist[$i]->chk_status == 1){
				                                              echo "<span style='color:#f7921e'>Confirmed</span>";
				                                            }elseif($servicelist[$i]->chk_status == 0){
				                                              echo "<span style='color:#fa0f2d'>In Review</span>";
				                                            }else{
				                                              echo "<span style='color:#282923'>Canceled</span>";
				                                            } ?>
										                      <?php if(isset($servicelist[$i]->review)){
										                      	$x= $servicelist[$i]->stars*20;
										                      	echo '<span class="stars-container stars-'.$x.'" style="font-size: 22px;float:right;" id="rtser'.$servicelist[$i]->service_booking_id.'">★★★★★</span>';
										                      }?>
										                  	</b>
										                 </p>
										                 <a class="btn btn-info" href ="<?php echo base_url();?>home/view_booked_service/<?php echo $servicelist[$i]->uni_id."/".$servicelist[$i]->service_booking_id;?>" style=" " title="View Booking">View Booking</a>
										                 <?php
										                 	$text2 = "Review";
										                 	$is_disable2 = "";
										                 	if ($servicelist[$i]->chk_status != 2) {
										                 		$is_disable2 = "disabled";
										                 	}
										                 	if($servicelist[$i]->is_reviewed == 1){
										                 		$is_disable2 = "disabled";
										                 		//$text2 = "Edit Review";
										                 		$text2 = "Reviewed";
										                 	}

										                 ?>
										                 <a class="btn btn-danger service_comp" href ="javascript:void(0)" <?php echo $is_disable2; ?>  title="Click when event is completed" id="<?php echo $servicelist[$i]->service_booking_id;?>" ><?php echo $text2; ?></a>
									            	</div>
									            	<div class="col-lg-12 col-sm-12 collapse review-list review-form" style="padding-top:10px;display: none;" id="myserv<?php echo $servicelist[$i]->service_booking_id;?>">
									            		<div class="panel panel-default" style="padding: 20px;">
					                                        <h3>Write Your Review</h3>
					                                        <div class="rating-group">
					                                            <div class="rateit serverateit" data-rateit-resetable="true" data-rateit-value="2.5"  data-rateit-mode="font" my-id="<?php echo $servicelist[$i]->service_booking_id;?>">
					                                            </div>
					                                        </div>
					                                                <!-- Textarea -->
					                                        <div class="form-group">
					                                            <div class="">
					                                                <input type="text" class="form-control" name="review" id="serv_review<?php echo $servicelist[$i]->service_booking_id;?>" value="<?php if(isset($servicelist[$i]->review))echo $servicelist[$i]->review?>" placeholder="Write Your Review">
						              								<span style="color: red; font-size: 12px;"></span>
						              								<input type="hidden" class="serv_rating" id="serv_rating<?php echo $servicelist[$i]->service_booking_id;?>" value="<?php if(isset($servicelist[$i]->review))echo $servicelist[$i]->stars; else{echo 0;}?>">
						            								<input type="hidden" id="serv_id<?php echo $servicelist[$i]->service_booking_id;?>" value="<?php echo $servicelist[$i]->service_details_id;?>">
					                                            </div>
					                                        </div>
					                                                <!-- Button -->
					                                        <div class="form-group">
					                                            <button type="button" class="btn btn-primary btn-lg serv_send <?php if($servicelist[$i]->review){echo 'update_serve'; }?>" id="serv_send<?php echo $servicelist[$i]->service_booking_id;?>" send-id="<?php echo $servicelist[$i]->service_booking_id;?>">Submit Review</button>
					                                        </div>
					                                    </div>
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
										                  <img src="<?php echo base_url();?>uploads/space_image/<?php echo $spacelist[$i]->image_name; ?>" width="200px;" height="160px;" alt=""/>
										                </div>
										            </div>
										            <div class="col-md-8 col-sm-9">
										                <p style="margin: 0;">Space Name: <?php echo $spacelist[$i]->company;?></p>
										                <p style="margin: 0;">Selected Event: <?php echo $spacelist[$i]->event;?></p>
										              	<p style="margin: 0;">Booked on: <?php echo date("d F Y", strtotime($spacelist[$i]->startdate)); ?></p>
										              	<p>Status: <b>
										              		<?php 
				                                            if ($spacelist[$i]->chk_status == 2) {
				                                              echo "<span style='color:#25a032'>Completed</span>";
				                                            }elseif($spacelist[$i]->chk_status == 1){
				                                              echo "<span style='color:#f7921e'>Confirmed</span>";
				                                            }elseif($spacelist[$i]->chk_status == 0){
				                                              echo "<span style='color:#fa0f2d'>In Review</span>";
				                                            }else{
				                                              echo "<span style='color:#282923'>Canceled</span>";
				                                            } ?>
										                      	<?php if(isset($spacelist[$i]->review)){
										                      	$x= $spacelist[$i]->stars*20;
										                      	echo '<span class="stars-container stars-'.$x.'" style="font-size: 22px;float:right;" id="rtspc'.$spacelist[$i]->space_booking_id.'">★★★★★</span>';
										                      }?>
										                  </b>
										                </p>
										                <a class="btn btn-info" href ="<?php echo base_url();?>home/view_booked_space/<?php echo $spacelist[$i]->uni_id."/".$spacelist[$i]->space_booking_id;?>" style=" " title="View Booking">View Booking</a>
										                 <?php
										                 	$text = "Review";
										                 	$is_disable = "";
										                 	if ($spacelist[$i]->chk_status != 2) {
										                 		$is_disable = "disabled";
										                 	}
										                 	if($spacelist[$i]->is_reviewed == 1){
										                 		$is_disable = "disabled";
										                 		//$text = "Edit Review";
										                 		$text = "Reviewed";
										                 	}

										                 ?>
										                <a class="btn btn-danger space_comp" href ="javascript:void(0)" <?php echo $is_disable; ?>   title="Click when event is completed" id="space<?php echo $spacelist[$i]->space_booking_id;?>" data-id="<?php echo $spacelist[$i]->space_booking_id;?>"><?php echo $text; ?></a>
									            	</div>
									            	<div class="col-lg-12 col-sm-12 collapse review-list review-form" style="padding-top:10px;display: none;" id="myspc<?php echo $spacelist[$i]->space_booking_id;?>">
									            		<div class="panel panel-default" style="padding: 20px;">
					                                        <h3>Write Your Review</h3>
					                                        <div class="rating-group">
					                                            <div class="rateit spcrateit" data-rateit-resetable="true" data-rateit-value="2.5"  data-rateit-mode="font" my-id="<?php echo $spacelist[$i]->space_booking_id;?>">
					                                            </div>
					                                        </div>
					                                                <!-- Textarea -->
					                                        <div class="form-group">
					                                            <div class="">
					                                                <input type="text" class="form-control" name="review" id="spc_review<?php echo $spacelist[$i]->space_booking_id;?>" value="<?php if(isset($spacelist[$i]->review))echo $spacelist[$i]->review ?>" placeholder="Write Your Review">
						              								<span style="color: red; font-size: 12px;"></span>
						              								<input type="hidden" class="spc_rating" id="spc_rating<?php echo $spacelist[$i]->space_booking_id;?>" value="<?php if(isset($spacelist[$i]->review))echo $spacelist[$i]->stars; else echo 0; ?>">
						            								<input type="hidden" id="spc_id<?php echo $spacelist[$i]->space_booking_id;?>" value="<?php echo $spacelist[$i]->space_id;?>">
					                                            </div>
					                                        </div>
					                                                <!-- Button -->
					                                        <div class="form-group">
					                                            <button type="button" class="btn btn-primary btn-lg spc_send <?php if(isset($spacelist[$i]->review))echo 'update_spc'; ?>" id="spc_send<?php echo $spacelist[$i]->space_booking_id;?>" send-id="<?php echo $spacelist[$i]->space_booking_id;?>">Submit Review</button>
					                                        </div>
					                                    </div>
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
	$(".rateit").one( "click", function() {
		$(this).find('.rateit-reset').click();
	});
	$(".serverateit").on( "click", function() {
		var rating = $(this).rateit('value');
		var id =$(this).attr('my-id');
		$('#serv_rating'+id).val(rating);
	});
	$(".spcrateit").on( "click", function() {
		var rating = $(this).rateit('value');
		var id =$(this).attr('my-id');
		$('#spc_rating'+id).val(rating);
	});
</script>
<script type="text/javascript">
	$(".service_comp").on('click', function(){
		if ($(this).attr("disabled")) {

      		return false;

      	}else{
			var id = $(this).attr('id');
			$('#myserv'+id).toggle();
		}

	});
	$(".space_comp").on('click', function(){
		if ($(this).attr("disabled")) {

      		return false;

      	}else{
		var id = $(this).attr('data-id');
		$('#myspc'+id).toggle();
		}
	});

</script>
<script type="text/javascript">
	$(".serv_send").on('click', function(){
		var id =$(this).attr('send-id');
		var service_id = $('#serv_id'+id).val();
		var stars = $('#serv_rating'+id).val();
		var review = $('#serv_review'+id).val();
		if ( $.trim(review).length == 0) {
			$('#serv_review'+id).parent().find('span').text('Please Write a Review');
			$('#serv_review'+id).parent().find('span').hide(100);
			$('#serv_review'+id).parent().find('span').show(100);
			return false;
		}

		if ($(this).hasClass("update_serve")) {
				$.ajax({
	            type : "POST",
	            data : {id:id, service_id:service_id, stars:stars, review:review},
	            url : "<?php echo base_url();?>home/update_service_review",
	            success : function(data){
	            	//alert(data);
	            	$('#myserv'+data).hide();
	             	$('#'+data).text('Reviewed');
	             	$('#'+data).attr('disabled', 'disabled');
	             	$('#rtser'+data).attr('class', 'stars-container');
	             	$('#rtser'+data).addClass('stars-'+stars*20);
	              	//$('#'+data).attr('disabled', 'disabled');
	              	//alert_pop('Thank You Your Review Is Been Updated');
	              	$('#urModal2').modal('show');
	              return false;
	            }
          });
		}else{
			 $.ajax({
	            type : "POST",
	            data : {id:id, service_id:service_id, stars:stars, review:review},
	            url : "<?php echo base_url();?>home/service_review",
	            success : function(data){
	            	//alert(data);
	            	$('#myserv'+data).hide();
	             	$('#'+data).text('Reviewed');
	             	$('#'+data).attr('disabled', 'disabled');
	             	$('#rtser'+data).attr('class', 'stars-container');
	             	$('#rtser'+data).addClass('stars-'+stars*20);
	              	//$('#'+data).attr('disabled', 'disabled');
	              	//alert_pop('Thank You For Your Precious Review');
	              	$('#urModal').modal('show');
	              return false;
	            }
	          });
		 }
		});

	$(".spc_send").on('click', function(){
		var id =$(this).attr('send-id');
		var space_id = $('#spc_id'+id).val();
		var stars = $('#spc_rating'+id).val();
		var review = $('#spc_review'+id).val();
		if ( $.trim(review).length == 0) {
			$('#spc_review'+id).parent().find('span').text('Please Write a Review');
			$('#spc_review'+id).parent().find('span').hide(100);
			$('#spc_review'+id).parent().find('span').show(100);
			return false;
		}

		if ($(this).hasClass("update_spc")) {
			$.ajax({
	            type : "POST",
	            data : {id:id, space_id:space_id, stars:stars, review:review},
	            url : "<?php echo base_url();?>home/update_space_review",
	            success : function(data){
	            	//alert(data);
	            	$('#myspc'+data).hide();
	             	$('#space'+data).text('Reviewed');
	             	$('#space'+data).attr('disabled', 'disabled');
	             	$('#rtspc'+data).attr('class', 'stars-container');
	             	$('#rtspc'+data).addClass('stars-'+stars*20);
	              	//$('#space'+data).attr('disabled', 'disabled');
	              	//alert_pop('Thank You Your Review Is Been Updated');
	              	$('#urModal2').modal('show');
	              return false;
	            }
	          });
			 
			}else{
				$.ajax({
	            type : "POST",
	            data : {id:id, space_id:space_id, stars:stars, review:review},
	            url : "<?php echo base_url();?>home/space_review",
	            success : function(data){
	            	//alert(data);
	            	$('#myspc'+data).hide();
	             	$('#space'+data).text('Reviewed');
	             	$('#space'+data).attr('disabled', 'disabled');
	             	$('#rtspc'+data).attr('class', 'stars-container');
	             	$('#rtspc'+data).addClass('stars-'+stars*20);
	              	//$('#space'+data).attr('disabled', 'disabled');
	              	//alert_pop('Thank You For Your Precious Review');
	              	$('#urModal').modal('show');
	              return false;
	            }
	          });
			}
		});

	function alert_pop(msg){
     $.alert({
        title: 'Thank You',
        content: msg,
        confirmButton: 'close',
        confirmButtonClass: 'btn-danger',
        animation: 'bottom',
        icon: 'fa fa-thumbs-up',
        opacity: 2,  
        backgroundDismiss: true
    });
	}
</script>
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