<style type="text/css">

.kf-home-video {
  position: relative;
  background-color: black;
  height: 75vh;
  min-height: 25rem;
  width: 100%;
  overflow: hidden;
  background-size: contain;
  transition: 1s opacity;
}

.kf-home-video video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: 0;
  -ms-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
  
}

.kf-home-video .container {
  position: relative;
  z-index: 2;
}

.kf-home-video .overlay {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: black;
  opacity: 0.5;
  z-index: 1;
}
@keyframes moveClouds {
    to {
        background-position: 0 100%;
    }
}
@-moz-keyframes moveClouds {
    to {
        background-position:0 100%;
    }
}
@-webkit-keyframes moveClouds {
    to {
        background-position:0 100%;
    }
}
#clouds {
    height:100%;
    width:100%;
    position: absolute;
    background:  url(<?php echo base_url();?>themes/frontend/images/2.jpg) repeat-y;
    
    animation: moveClouds 55s linear infinite;
    -ms-animation: moveClouds 55s linear infinite;
    -moz-animation: moveClouds 55s linear infinite;
    -webkit-animation: moveClouds 55s linear infinite;
}


@media (pointer: coarse) and (hover: none) {
  .kf-home-video {
    /*background: url('https://source.unsplash.com/XT5OInaElMw/1600x900') black no-repeat center center scroll;*/
    max-height: 55vh;
  }
  .kf-home-video .kf-booking-shdule{
  	top: -100px;
  	background-color: transparent;
  }
  .kf-home-video h2 {
  	display: none;
  }
  .kf-booking-shdule ul li{
	padding: 10px;
}
  /*.kf-home-video video {
    display: none;
  }*/
}
</style>
<div class="kf-home-video">
	<div class="overlay"></div>
	  <!-- <video playsinline="playsinline"  autoplay="autoplay" muted="muted" loop="loop">
	    <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">
	  </video> -->
	  <div id="clouds"></div>
	  <div class="container h-100">
	<section>
      <div class="kf-booking-shdule"  style="margin-top:45px;">
        <h2 align="center" style="color:#FFF;">CREATE A MAGICAL EVENT </h2>
        <br>
        <br>
        <br>
        <br>
        <div class="container " >
          <div class="container">
            <form method="post" action="<?php echo base_url();?>home/activity">
              <ul style="border-radius: 0px;background-color:transparent; padding: 0px" >
                <li class="col-md-5 col-sm-4 col-xs-12" style="padding-right: 20px">
                  <input class="basic validate[required]" list="browsers" id="location" name="location" placeholder="Choose Your Location" style="border: 1px solid #ccc; ">
					  <datalist id="browsers">
					    <?php 
	                      if($services_list)
	                      {
	                        for ($i=0; $i < count($services_list); $i++) 
	                        {   
	                        ?>
	                          <option value="<?php echo $services_list[$i]->address; ?>">
	                          <?php
	                        }
	                      }
	                    ?>
					  </datalist>
                </li>
                <input type="hidden" name="state" value = "0">
                <input type="hidden" name="startdate" value="<?php echo date('m/d/Y');?>">
                <!-- <li class="col-md-2 col-sm-6">
                  <div class="date-picker-des" data-provide="datepicker">
                    <input type="text" id="my-datepicker" name="startdate" value="<?php echo date('m/d/Y');?>" class="basic" placeholder="Event Date">
                    <span class="add-on"><i class="fa fa-calendar" id="cal2"></i></span> </div>
                </li>  -->
                <li class="col-md-5 col-sm-4 col-xs-12" style="padding-right: 20px">
                  <input class="basic validate[required]" list="events" id="event_list" name="event_list" placeholder="Choose Your Event" style="border: 1px solid #ccc;">
                    <datalist id="events">
                     <?php 
                      if($events)
                      {
                        for ($i=0; $i < count($events); $i++) 
                        {   
                        ?>
                          <option id="<?php echo $events[$i]->event_id?>" value="<?php echo $events[$i]->event_name?>"></option>
                          <?php
                        }
                      }
                    ?>
                  </datalist>
                  <input type="hidden" id="put_event" name="events" value="0">
                </li>
                <li class="col-md-2 col-sm-4 col-xs-12" style="top: -5px;">
                  <button class="medium-btn btn btn-success" name="search" id="search" ><i class="fa fa-search"></i>Search<!--<i class="fa fa-arrow-right"></i>--></button>
                </li>
              </ul>
            </form>
          </div>
         <!-- Modal --> 
       </div>
     </div>
   		</div>
 	</section>
	  </div>
	<!-- <div id="owl-demo-main" class="owl-carousel owl-theme">
		<div class="item">
			<figure>
				<img src="<?php echo base_url();?>themes/frontend/images/slider-1.jpg" alt=""/>
				<figcaption>
					<h2> Book your event with <span>EventUs</span> and make it memorable</h2>
				</figcaption>
			</figure>
		</div>
		<div class="item">
			<figure>
				<img src="<?php echo base_url();?>themes/frontend/images/slider-2.jpg" alt=""/>
					<figcaption>
						<h2> Find an unique space with <span>EventUs</span> for your event</h2>
					</figcaption>
			</figure>
		</div> -->
		<!-- <div class="item">
			<figure>
				<img src="<?php// echo base_url();?>themes/frontend/images/slider-3.jpg" alt=""/>
					<figcaption>
						<h2>Offer Your Service With <span> EventUs </span></h2>
					</figcaption>
			</figure>
		</div> -->
		<!-- <div class="item">
			<figure>
				<img src="<?php echo base_url();?>themes/frontend/images/slider-4.jpg" alt=""/>
					<figcaption>
						<h2>Offer your space and services with <span>EventUs</span></h2>
					</figcaption>
			</figure>
		</div>
	</div> -->
</div>

	<section>
		<div class="container">
			<h2 align="center">How it works</h2>
			<br>
			<br>
			<div class="row">
				<div class="col-lg-4 text-center" >
					<img src="<?php echo base_url();?>themes/frontend/images/FindSpace.png" style="height: 100px;">
					<br>
					<br>
					<h4 style="color: #666; ">Locate the ideal <br>space</h4><br>
						<!-- Browse the marketplace and tailor your search to your activity needs. -->
						<p style="color: #000">Search the space from our venues. Find unique space in the cities across over the India.</p>
					<br>
					<br>
				</div>
				<div class="col-lg-4 text-center">
					<img src="<?php echo base_url();?>themes/frontend/images/calendar.png" style="height: 100px;">
					<br>
					<br>
					<h4 style="color: #666">Compare and connect effortlessly</h4><br>
						<!-- Once you find a perfect match, book the space and pay online through our easy-to-use payment system. -->
						<p style="color: #000">Find the perfect space & services for your event, compare and get confirmation with a few clicks.</p>
					<br>
					<br>
				</div>
				<div class="col-lg-4 text-center">
					<img src="<?php echo base_url();?>themes/frontend/images/event.png" style="height: 100px;">
					<br>
					<br>
					<h4 style="color: #666">Create event and get experience</h4><br>
						<!-- Create a memorable experience in a memorable space, and enjoy! -->
						<p style="color: #000">Make your event with us, get memorable experience in memorable space, and enjoy!</p>
					<br>
					<br>
				</div>
			</div>
				
		</div>
	</section>

<!-- <div class="kf_content_wrap"> -->
<div class="">
	<section class="kf-gallery-wrap" id="filters" style="padding-bottom: 1px;">
		<div class="col-md-12">
			<div class="kf-heading-1">
				<h3>Where will be your event?</h3>
				<span><i class="icon-hotel"></i></span>
			</div>
		</div>
		<div class="isotope"> 
			<div class="col-md-3 col-sm-3 color-shape wide Spa Cafe">
				<div class="filterable-thumb">
					<img src="<?php echo base_url();?>themes/frontend/images/pune.jpg" alt=""/>
					<div style="position:absolute;top:134px; left:130px;  font-size:210%; color:#FFF">
						<span><b><a href="<?php echo base_url();?>home/search_bycity/56"> Pune </a></b></span>
					</div> 
				</div>
			</div>
			<div class="col-md-3 col-sm-3 color-shape wide Spa Cafe">
				<div class="filterable-thumb">
					<img src="<?php echo base_url();?>themes/frontend/images/nagpur.jpg" alt=""/>
					<div style="position:absolute;top:124px; left:108px;  font-size:210%; color:#FFF">
						<span><b><a href="<?php echo base_url();?>home/search_bycity/5"> Nagpur </a></b></span>
					</div> 
				</div>
			</div>
			<div class="col-md-3 col-sm-3 color-shape wide Spa Cafe">
				<div class="filterable-thumb">
					<img src="<?php echo base_url();?>themes/frontend/images/mumbai.jpg" alt=""/>
					<div style="position:absolute;top:124px; left:100px;  font-size:210%; color:#FFF">
						<span><b><a href="<?php echo base_url();?>home/search_bycity/58"> Mumbai </a></b></span>
					</div> 
				</div>
			</div>
			<div class="col-md-3 col-sm-3 color-shape wide Spa Cafe">
				<div class="filterable-thumb">
					<img src="<?php echo base_url();?>themes/frontend/images/nashik.jpg" alt=""/>
					<div style="position:absolute;top:124px; left:108px;  font-size:210%; color:#FFF">
						<span><b><a href="<?php echo base_url();?>home/search_bycity/68"> Nashik </a></b></span>
					</div> 
				</div>
			</div>
		</div>
	</section>
	<section class="kf-testimonial-bg">
		<div class="container-fluid" style="position: relative; margin: -60px 0px -90px 0px;">
				<!-- <div class="kf-heading-1">
					<h3>Our Testimonial</h3>
					 <span><i class="icon-hotel"></i></span> 
				</div> -->
			<div id="owl-demo-3" class="owl-carousel owl-theme">
				<?php 
						if($data_testimonial)
						{
							for ($i=0; $i < count($data_testimonial) ; $i++) 
							{ 
								# code...
							
						?>
				<div class="item">
					<div class="kf-testimonial-des">
						<figure><img src="<?php echo base_url();?>uploads/testimonial_image/<?php echo $data_testimonial[$i]->testimonial_image;?>" alt="" height="130px"></figure> 
							<div class="text">

							<p class="client-slider-txt" style="margin-bottom:10px; color:#449E8E; font-size:30px">
                            <?php echo $data_testimonial[$i]->testimonial_name;?>
                            </p>
                            <p class="client-slider-txt" style="margin-bottom:10px">
                             <?php echo $data_testimonial[$i]->testimonial_tittle;?>
                            </p>
                            <p class="client-slider-txt">
                             <?php echo $data_testimonial[$i]->testimonial_description;?>
                            </p>
							<!-- <div class="rating">
								<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
							</div> -->
							
						</div>
					</div>
				</div>
				<?php 
						}
							}
				?>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="col-md-12">
				<div class="kf-heading-1">
					<h3>Services</h3>
					<span><i class="icon-hotel"></i></span>
				</div>
			</div>
			<div class="row">
				<div id="owl-demo-2" class="owl-carousel owl-theme">
					<div class="item">
						<div class="kf-hotel-room">
							<figure>
								<img src="<?php echo base_url();?>themes/frontend/extra-images/catering.jpg" alt="">
							</figure>
							<h6><a href="#">Catering</a></h6>
						</div>
					</div>
					<div class="item">
						<div class="kf-hotel-room">
							<figure>
								<img src="<?php echo base_url();?>themes/frontend/extra-images/ballon.jpg" alt="">
							</figure>
							<h6><a href="#">Balloon Decoration</a></h6>
						</div>
					</div>
					<div class="item">
						<div class="kf-hotel-room">
							<figure>
								<img src="<?php echo base_url();?>themes/frontend/extra-images/flowers.jpg" alt="">
							</figure>
							<h6><a href="#">Flowers Decoration</a></h6>
						</div>
					</div>
					<div class="item">
						<div class="kf-hotel-room">
							<figure>
								<img src="<?php echo base_url();?>themes/frontend/extra-images/dancers.jpg" alt="">
							</figure>
							<h6><a href="#">Dancers</a></h6>
						</div>
					</div>
					<div class="item">
						<div class="kf-hotel-room">
							<figure>
								<img src="<?php echo base_url();?>themes/frontend/extra-images/singers.jpg" alt="">
							</figure>
							<h6><a href="#">Singers</a></h6>
						</div>
					</div>
					<div class="item">
						<div class="kf-hotel-room">
							<figure>
								<img src="<?php echo base_url();?>themes/frontend/extra-images/dj2.jpg" alt="">
							</figure>
							<h6><a href="#">Disk Jockey</a></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		$("#event_list").change(function() {
			var event_name = $('#event_list').val();
			  var id = $('option[value="'+event_name+'"]').attr("id");
			  $('#put_event').val(id);
			  //alert(id);
			})
	</script>