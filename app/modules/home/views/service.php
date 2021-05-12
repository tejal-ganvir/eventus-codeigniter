<div class="tp-page-head3">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="page-header text-center">
                        <div class="icon-circle">
                            <i class="icon icon-size-60 icon-wedding-arch icon-white"></i>
                        </div>
                        <h1>CREATE A MAGICAL EVENT</h1>
                        <p>You plan a beautiful event and we will make your event memorable.</p>
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
                        <li class="active">Service</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="filter-box">
        <div class="container">
            <div class="row filter-form">
                <div class="col-md-12">
                    <h4>Search Services</h4>
                </div>
                <form method="post" action="<?php echo base_url();?>home/search_service">
                  <input type="hidden" name="startdate" value="<?php echo date('m/d/Y') ?>">
                    <div class="col-md-3">
                        <label class="control-label" for="venuetype">Select Place</label>
                        <select name="places" id="places" class="form-control">
                          <option value="" selected="">Select Place</option>
                            <?php 
                              if($event_places)
                              {
                                for ($i=0; $i < count($event_places); $i++) 
                                {   
                                ?>
                                  <option value="<?php echo $event_places[$i]->location_id?>"><?php echo $event_places[$i]->location_name?></option>
                                  <?php
                                }
                              }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="state" value = "0">
                    <input type="hidden" name="startdate" value="<?php echo date('m/d/Y');?>">
                    <div class="col-md-3">
                        <label class="control-label" for="capacity">Select Service</label>
                        <select class="form-control" name="service" id="service">
                          <option value="0" selected="">Select Service</option>
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
                        <label class="control-label" for="capacity">Select Guests</label>
                        <select class="form-control" name="guest" id="guest">
                          <option value="" selected="">Select Guests</option>
                          <option value="1">0-100 Guests</option>
                          <option value="2">100-200 Guests</option>
                          <option value="3">200-300 Guests</option>
                          <option value="4">300-400 Guests</option>
                          <option value="5">400-500 Guests</option>
                          <option value="6">500&Up Guests</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" name="search" class="btn btn-primary btn-block">Refine Your Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Feature Blog End -->
    <div class="section-space80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb60 text-center">
                        <h1>Featured Event Services</h1>
                        <p>Locate Your Ideal Service at Best Prices.</p>
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
                            <a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m-d-Y')?>/6/0/0"><img src="<?php echo base_url();?>themes/frontend/images/catering.jpg" alt="wedding vendor" class="img-responsive"></a>
                            <div class="feature-label"></div>
                        </div>
                        <!-- /.vendor pic -->
                        <div class="vendor-detail">
                            <!-- vendor details -->
                            <div class="caption">
                                <!-- caption -->
                                <h2><a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m-d-Y')?>/6/0/0" class="title">CATERING</a></h2>
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
                        <a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m-d-Y')?>/10/0/0"><img src="<?php echo base_url();?>themes/frontend/images/vendor-7.jpg" alt="wedding vendor" class="img-responsive"></a>
                        <div class="rated-label"></div>
                    </div>
                    <!-- /.vendor pic -->
                    <div class="vendor-detail">
                        <!-- vendor details -->
                        <div class="caption">
                            <!-- caption -->
                            <h2><a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m-d-Y')?>/10/0/0" class="title">DISK JOCKEY</a></h2>
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
                            <a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m-d-Y')?>/8/0/0"><img src="<?php echo base_url();?>themes/frontend/images/vendor-1.jpg" alt="wedding vendor" class="img-responsive"></a>
                            <div class="popular-label"></div>
                        </div>
                        <!-- /.vendor pic -->
                        <div class="vendor-detail">
                            <!-- vendor details -->
                            <div class="caption">
                                <!-- caption -->
                                <h2><a href="<?php echo base_url();?>home/search_service/0/0/<?php echo date('m-d-Y')?>/8/0/0" class="title">DECORATION</a></h2>
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