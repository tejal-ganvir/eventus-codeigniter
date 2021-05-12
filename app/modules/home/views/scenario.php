<link href="<?php echo base_url();?>themes/frontend/css/jquery.multiselect.css" rel="stylesheet">
    <div class="tp-page-head4">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="page-header text-center">
                        <div class="icon-circle">
                            <i class="icon icon-size-60 icon-wedding-bells icon-white"></i>
                        </div>
                        <h1>What Do You Need For Your Event?</h1>
                        <p>Any space and services your event needs at any place.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tp-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li class="active">Scenario</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="filter-box">
        <div class="container">
            <div class="row filter-form">
                <div class="col-md-12">
                    <h4>Create Scenario</h4>
                </div>
                <form method="post" action="<?php echo base_url();?>home/search_scenario" id="space_form">
                    <div class="col-md-3 scene">
                        <label class="control-label" for="venuetype">Enter Location</label>
                        <input class="form-control" list="browsers" id="location" name="location" placeholder="Location" style="height: 38px; border-radius: 5px;border-color: #999999; background-color: #fff;">
                          <datalist id="browsers">
                            <?php 
                                      if($services_list)
                                      {
                                        for ($i=0; $i < count($services_list); $i++) 
                                        {   
                                        ?>
                                          <option value="<?php echo $services_list[$i]->address?>">
                                          <?php
                                        }
                                      }
                                    ?>
                          </datalist>
                    </div>
                    <div class="col-md-3 scene">
                        <label class="control-label" for="capacity">Select Service</label>
                        <select class="form-control" name="events" id="events" style="height: 38px; border-radius: 5px;border-color: #999999; background-color: #fff;">
                          <option value="">Event</option>
                           <?php 
                            if($events)
                            {
                              for ($i=0; $i < count($events); $i++) 
                              {   
                              ?>
                                <option value="<?php echo $events[$i]->event_id?>"><?php echo $events[$i]->event_name?></option>
                                <?php
                              }
                            }
                          ?>
                        </select>
                    </div>
                    <div class="col-md-3 scene">
                        <label class="control-label" for="capacity">Select Service</label>
                        <select class="form-control" name="service[]" multiple id="service" >
                                  <?php 
                                    if($service)
                                    {
                                      for ($i=0; $i < count($service); $i++) 
                                      {   
                                      ?>
                                        <option value="<?php echo $service[$i]->service_id?>"><?php echo $service[$i]->service_name?></option>
                                        <?php
                                      }
                                    }
                                  ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" name="search" class="btn btn-primary btn-block" style="height: 38px; border-radius: 5px;">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.top location -->
    <!-- /.top location -->
    <div class="section-space80">
        <!-- top location -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb60 text-center">
                        <h1>Top Venues</h1>
                        <p>You plan a beautiful event and we will make your event memorable.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 location-block">
                    <!-- location block -->
                    <div class="vendor-image">
                        <a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m%d%Y')?>/1/0/0"><img src="<?php echo base_url();?>themes/frontend/images/location-pic.jpg" alt="" class="img-responsive"></a> <a href="#" class="venue-lable"><span class="label label-default">Banquet Hall</span></a> </div>
                </div>
                <!-- /.location block -->
                <div class="col-md-4 location-block">
                    <!-- location block -->
                    <div class="vendor-image">
                        <a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m%d%Y')?>/9/0/0"><img src="<?php echo base_url();?>themes/frontend/images/location-pic-2.jpg" alt="" class="img-responsive"></a> <a href="#" class="venue-lable"><span class="label label-default">Resort</span></a> </div>
                </div>
                <!-- /.location block -->
                <div class="col-md-4 location-block">
                    <!-- location block -->
                    <div class="vendor-image">
                        <a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m%d%Y')?>/5/0/0"><img src="<?php echo base_url();?>themes/frontend/images/location-pic-3.jpg" alt="" class="img-responsive"></a> <a href="#" class="venue-lable"><span class="label label-default">Hotel</span></a> </div>
                </div>
                <!-- /.location block -->
                <div class="col-md-8 location-block">
                    <!-- location block -->
                    <div class="vendor-image">
                        <a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m%d%Y')?>/4/0/0"><img src="<?php echo base_url();?>themes/frontend/images/location-pic-4.jpg" alt="" class="img-responsive"></a> <a href="#" class="venue-lable"><span class="label label-default">Wedding Hall</span></a> </div>
                </div>
                <!-- /.location block -->
                <div class="col-md-4 location-block">
                    <!-- location block -->
                    <div class="vendor-image">
                        <a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m%d%Y')?>/8/0/0"><img src="<?php echo base_url();?>themes/frontend/images/location-pic-5.jpg" alt="" class="img-responsive"></a> <a href="#" class="venue-lable"><span class="label label-default">Part Lawn</span></a> </div>
                </div>
                <!-- /.location block -->
            </div>
        </div>
    </div>
    <!-- /.top location -->
    <!-- Feature Blog End -->
    <div class="section-space80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb60 text-center">
                        <h1>Featured Event Services</h1>
                        <p>Locate Your Ideal Services for your Events at Best Prices</p>
                    </div>
                </div>
            </div>
            <div class="row ">
                <!-- /.vendor box start-->
                <div class="col-md-4">
                    <!-- vendor box start-->
                    <div class="vendor-box">
                        <div class="vendor-image">
                            <!-- vendor pic -->
                            <a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m%d%Y')?>/6/0/0"><img src="<?php echo base_url();?>themes/frontend/images/catering.jpg" alt="wedding vendor" class="img-responsive"></a>
                            <div class="feature-label"></div>
                        </div>
                        <!-- /.vendor pic -->
                        <div class="vendor-detail">
                            <!-- vendor details -->
                            <div class="caption">
                                <!-- caption -->
                                <h2><a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m%d%Y')?>/15/0/0" class="title">CATERING</a></h2>
                                <!-- <p class="location"><i class="fa fa-map-marker"></i> Street Address, Name of Town, 12345, Country.</p>
                                <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="rating-count">(3)</span> </div> -->
                            </div>
                            <!-- /.caption -->
                            <div class="vendor-price">
                                <div class="price">Include Packages</div>
                            </div>
                        </div>
                    </div>
                    <!-- vendor details -->
                </div>
                <!-- /.vendor box start-->
                <div class="col-md-4 vendor-box">
                    <!-- vendor box start-->
                    <div class="vendor-image">
                        <!-- vendor pic -->
                        <a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m%d%Y')?>/10/0/0"><img src="<?php echo base_url();?>themes/frontend/images/vendor-7.jpg" alt="wedding vendor" class="img-responsive"></a>
                        <div class="rated-label"></div>
                    </div>
                    <!-- /.vendor pic -->
                    <div class="vendor-detail">
                        <!-- vendor details -->
                        <div class="caption">
                            <!-- caption -->
                            <h2><a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m%d%Y')?>/13/0/0" class="title">DISK JOCKEY</a></h2>
                            <!-- <p class="location"><i class="fa fa-map-marker"></i> Street Address, Name of Town, 12345, Country.</p>
                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="rating-count">(5)</span> </div> -->
                        </div>
                        <!-- /.caption -->
                        <div class="vendor-price">
                            <div class="price">Include Packages</div>
                        </div>
                    </div>
                    <!-- vendor details -->
                </div>
                <!-- /.vendor box start-->
                <div class="col-md-4">
                    <!-- vendor box start-->
                    <div class="vendor-box">
                        <div class="vendor-image">
                            <!-- vendor pic -->
                            <a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m%d%Y')?>/8/0/0"><img src="<?php echo base_url();?>themes/frontend/images/vendor-1.jpg" alt="wedding vendor" class="img-responsive"></a>
                            <div class="popular-label"></div>
                        </div>
                        <!-- /.vendor pic -->
                        <div class="vendor-detail">
                            <!-- vendor details -->
                            <div class="caption">
                                <!-- caption -->
                                <h2><a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m%d%Y')?>/8/0/0" class="title">DECORATION</a></h2>
                                <!-- <p class="location"><i class="fa fa-map-marker"></i> Street Address, Name of Town, 12345, Country.</p>
                                <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <span class="rating-count">(2)</span> </div> -->
                            </div>
                            <!-- /.caption -->
                            <div class="vendor-price">
                                <div class="price">Include Packages</div>
                            </div>
                        </div>
                        <!-- vendor details -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="<?php echo base_url();?>themes/frontend/js/jquery.multiselect.js"></script> 
<script>
  $('#service').multiselect({
    columns: 1,
    placeholder: 'Select Services'
});
</script>