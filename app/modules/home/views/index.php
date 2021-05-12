<style type="text/css">
  .feature-icon img{
    height: 60px;
    width: 68px;
  } 
  .feature-block{

  } 
  .couple-pic img{
    width: 150px;
    height: 150px;
  }
  .vendor-total-thumb img{
    width: 100%;
    height: 300px;
  }
</style>
    <div class="slider-bg">
        <!-- slider start-->
        <div id="slider" class="owl-carousel owl-theme slider">
            <div class="item slider-shade"><img src="<?php echo base_url();?>themes/frontend/images/slider/4.jpg" alt="event couple just married"></div>
            <div class="item slider-shade"><img src="<?php echo base_url();?>themes/frontend/images/slider/1.jpg" alt="event couple just married"></div>
            <div class="item slider-shade"><img src="<?php echo base_url();?>themes/frontend/images/slider/3.jpg" alt="event couple just married"></div>
        </div>
        <div class="find-section">
            <!-- Find search section-->
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-1 col-md-10 finder-block">
                        <div class="finder-caption">
                            <h1>CREATE A MAGICAL EVENT</h1>
                            <p> Book your event with <strong>Settle</strong> and make it memorable</p>
                        </div>
                        <div class="finder-form-transparent">
                            <form method="post" action="<?php echo base_url();?>home/activity" id="myform">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <input class="form-control validate[required]" list="browsers" id="location" name="location" placeholder="Choose Your Location" style="border: 1px solid #ccc; ">
                                          <datalist id="browsers">
                                            <?php 
                                              if($address)
                                              {
                                                for ($i=0; $i < count($address); $i++) 
                                                {   
                                                ?>
                                                  <option value="<?php echo $address[$i]->address; ?>">
                                                  <?php
                                                }
                                              }
                                            ?>
                                          </datalist>
                                    </div>
                                    <input type="hidden" name="state" value = "0">
                                    <input type="hidden" name="startdate" value="<?php echo date('m/d/Y');?>">
                                    <div class="form-group col-md-4">
                                        <input class="form-control validate[required]" list="events" id="event_list" name="event_list" placeholder="Choose Your Event" style="border: 1px solid #ccc;">
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
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button class="btn btn-primary btn-lg btn-block" id="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.Find search section-->
    </div>
    <!-- slider end-->
    <div class="section-space80">
        <!-- Feature Blog Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb60 text-center">
                        <h1>Plan your event one step at a time</h1>
                        <p>Simple event planning steps to help you stay on track. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- feature center -->
                <div class="col-md-3">
                    <div class="feature-block feature-center mb30">
                        <!-- feature block -->
                        <div class="feature-icon">
                            <img src="<?php echo base_url();?>themes/frontend/images/icons/step-1.png">
                        </div>
                        <h2>Locate the ideal Venues &amp; Services</h2>
                        <p>Search the venues &amp; services from our vendors. Find unique venue &amp; services in the cities
                            across over the India.</p>
                    </div>
                </div>
                <!-- /.feature block -->
                <div class="col-md-3">
                    <div class="feature-block feature-center mb30">
                        <!-- feature block -->
                        <div class="feature-icon">
                            <img src="<?php echo base_url();?>themes/frontend/images/icons/step-2.png">
                        </div>
                        <h2>Compare and connect effortlessly</h2>
                        <p>Find the perfect venue &amp; services for your event, compare and get confirmation with a few clicks.</p>
                    </div>
                </div>
                <!-- /.feature block -->
                <div class="col-md-3">
                    <div class="feature-block feature-center mb30">
                        <!-- feature block -->
                        <div class="feature-icon">
                            <img src="<?php echo base_url();?>themes/frontend/images/icons/step-3.png">
                        </div>
                        <h2>Customize your Scenario</h2>
                        <p>Easily customise your Event Scenario by adding or deleting venue &amp; services at anytime</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-block feature-center mb30">
                        <!-- feature block -->
                        <div class="feature-icon">
                            <img src="<?php echo base_url();?>themes/frontend/images/icons/step-4.png">
                        </div>
                        <h2>Create event and get experience</h2>
                        <p>Make your event with us, get memorable experience in memorable venue, and enjoy!</p>
                    </div>
                </div>
                <!-- /.feature block -->
            </div>
            <!-- /.feature center -->
            <!-- <div class="row">
                <div class="col-md-12 text-center"> <a href="" class="btn btn-primary">Get Started</a> </div>
            </div> -->
        </div>
    </div>
    <!-- Feature Blog End -->
    <div class="section-space80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb60 text-center">
                        <h1>Top Spaces For Your Events</h1>
                        <p>No need to run around for your event's venue - Book our trusted spaces under one roof.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if($space_list)
                    {
                    for ($i=0; $i < count($space_list); $i++) 
                        {  
                        ?>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="vendor-total-list mb30">
                                <!-- vendor-total-list -->
                                <div class="vendor-total-thumb">
                                    <!-- vendor-total-thumb -->
                                    <a href="<?php echo base_url();?>home/space_details/<?php echo $space_list[$i]->unique_id."/".$space_list[$i]->space_id ?>"><img src="<?php echo base_url();?>uploads/space_image/<?php echo $space_list[$i]->image_name; ?>" class="img-responsive" alt=""></a>
                                    <div class="feature-label"></div>
                                </div>
                                <!-- /.vendor-total-thumb -->
                                <a href="<?php echo base_url();?>home/space_details/<?php echo $space_list[$i]->unique_id."/".$space_list[$i]->space_id ?>">
                                    <div class="well-box vendor-total-info">
                                        <!-- vendor-total-info -->
                                        <h2 class="vendor-total-title"><a href="<?php echo base_url();?>home/space_details/<?php echo $space_list[$i]->unique_id."/".$space_list[$i]->space_id ?>" class="title"><b><?php echo $space_list[$i]->title;?></b> </a> </h2>
                                    </div>
                                </a>
                                <!-- /.vendor-total-info -->
                            </div>
                            <!-- /.vendor-total-list -->
                        </div>
                    <?php } 
                    }?>
            </div>
            <div class="row">
                <div class="col-md-12 text-center"><a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m%d%Y')?>/0/0/0" class="btn btn-default btn-lg">View All Spaces</a></div>
            </div>
        </div>
    </div>
    <!-- Real events -->
    <div class="section-space80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb60 text-center">
                        <h1>Top Services For Your Events</h1>
                        <p> Our team ensures that all the services are delivered as committed to ensure a hassle-free experience for you. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if($service_list)
                    {
                    for ($i=0; $i < count($service_list); $i++) 
                        {  
                        ?>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="vendor-total-list mb30">
                                <!-- vendor-total-list -->
                                <div class="vendor-total-thumb">
                                    <!-- vendor-total-thumb -->
                                    <a href="<?php echo base_url();?>home/service_details/<?php echo $service_list[$i]->unique_id."/".$service_list[$i]->service_details_id ?>"><img src="<?php echo base_url();?>uploads/service_image/<?php echo $service_list[$i]->image_name; ?>" class="img-responsive" alt=""></a>
                                    <div class="popular-label"></div>
                                </div>
                                <!-- /.vendor-total-thumb -->
                                <a href="<?php echo base_url();?>home/service_details/<?php echo $service_list[$i]->unique_id."/".$service_list[$i]->service_details_id ?>">
                                    <div class="well-box vendor-total-info">
                                        <!-- vendor-total-info -->
                                        <h2 class="vendor-total-title"><a href="<?php echo base_url();?>home/service_details/<?php echo $service_list[$i]->unique_id."/".$service_list[$i]->service_details_id ?>" class="title"><b><?php echo $service_list[$i]->company_name;?> </b></a> </h2>
                                    </div>
                                </a>
                                <!-- /.vendor-total-info -->
                            </div>
                            <!-- /.vendor-total-list -->
                        </div>
                    <?php } 
                    }?>
            </div>
            <div class="row">
                <div class="col-md-12 text-center"><a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m%d%Y')?>/0/0/0" class="btn btn-default btn-lg">View All Services</a></div>
            </div>
        </div>
    </div>
    <!-- -->
    <!-- /.Real events -->
    <section class="module parallax parallax-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 parallax-caption">
                        <h3><strong>Testimonials</strong></h3>
                        <div class="seprator"></div>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <!-- Wrapper for slides -->
                              <div class="carousel-inner">
                                <?php 
                                    if($data_testimonial)
                                    {
                                        for ($i=0; $i < count($data_testimonial) ; $i++) 
                                        { 
                                ?>
                                <div class="item <?php if($i == 0){echo 'active';} ?>">
                                  <div class="row" style="padding: 20px">
                                    <button style="border: none;"><i class="fa fa-quote-left testimonial_fa" aria-hidden="true"></i></button>
                                    <p class="testimonial_para">"<?php echo $data_testimonial[$i]->testimonial_description;?>"</p><br>
                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6">
                                            <img src="<?php echo base_url();?>uploads/testimonial_image/<?php echo $data_testimonial[$i]->testimonial_image;?>" class="img-responsive img-circle" style="width: 100px;height: 100px;">
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                            <h4><strong><?php echo $data_testimonial[$i]->testimonial_name;?></strong></h4>
                                            <p class="testimonial_subtitle"><span><?php echo $data_testimonial[$i]->testimonial_tittle;?></span>
                                            </p>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <?php 
                                    }
                                }
                                ?>
                              </div>
                            </div>
                            <div class="controls testimonial_control pull-right">
                                <a class="left fa fa-chevron-left btn btn-primary testimonial_btn" href="#carousel-example-generic"
                                  data-slide="prev"></a>

                                <a class="right fa fa-chevron-right btn btn-primary testimonial_btn" href="#carousel-example-generic"
                                  data-slide="next"></a>
                            </div>
                </div>
            </div>
        </div>
    </section>
    <div class="section-space80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb60 text-center">
                        <h1>Why Book with Settle</h1>
                        <p>Our prime goal is Easy, Secure &amp; Reliable experience of booking events that too at Unbelievable Rates!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="well-box feature-block text-center">
                        <div class="feature-icon" align="center">
                            <img src="<?php echo base_url();?>themes/frontend/images/icons/next-1.png" class="img-responsive" alt="" class="img-responsive">
                        </div>
                        <div class="feature-info">
                            <h3>Conveyance of Commitments</h3>
                            <p>Our team guarantees that all the services are conveyed as committed to ensuring a hassle-free experience for you.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well-box feature-block text-center">
                        <div class="feature-icon" align="center">
                            <img src="<?php echo base_url();?>themes/frontend/images/icons/next-2.png" class="img-responsive" alt="" class="img-responsive">
                        </div>
                        <div class="feature-info">
                            <h3>Time is money, save both</h3>
                            <p>No need to run around for your event&#39;s perfect venue &amp; services - Book with our trusted vendors under one roof.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well-box feature-block text-center">
                        <div class="feature-icon" align="center">
                            <img src="<?php echo base_url();?>themes/frontend/images/icons/next-3.png" class="img-responsive" alt="" class="img-responsive">
                        </div>
                        <div class="feature-info">
                            <h3>Ensured Best Prices with Us</h3>
                            <p> We ensure our best prices for venues and services. You can get final quotes for venues and services and book your venue. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="well-box feature-block text-center">
                        <div class="feature-icon" align="center">
                            <img src="<?php echo base_url();?>themes/frontend/images/icons/next-4.png" class="img-responsive" alt="" class="img-responsive">
                        </div>
                        <div class="feature-info">
                            <h3>Customized Touch for Perfect Execution</h3>
                            <p> You get exactly what you choose. No worries, no compromises, we deliver exactly what you need with extreme love and care. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
    $(window).scroll(function() {
        if ($(".header-v2").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
        }
    });
</script>
<script type="text/javascript" src="<?php echo base_url();?>themes/frontend/js/testimonial.js"></script>
<script type="text/javascript">
        $("#event_list").change(function() {
            var event_name = $('#event_list').val();
              var id = $('option[value="'+event_name+'"]').attr("id");
              $('#put_event').val(id);
              //alert(id);
            });

        // $("#submit").on('click', function(){
        //     var location = $('#location').val();
        //     var event = $('#event_list').val();

        //     if (location == '') {$('#location').focus(); return false;}
        //     if (event == '') {$('#event_list').focus(); return false;}

        //     $('#myform').submit();

        //     });
    </script>