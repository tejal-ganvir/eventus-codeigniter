    <div class="tp-page-head2">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="page-header text-center">
                        <div class="icon-circle">
                            <i class="icon icon-size-60 icon-wedding-location icon-white"></i>
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
                        <li class="active">Venue</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="filter-box">
        <div class="container">
            <div class="row filter-form">
                <div class="col-md-12">
                    <h4>Search Venues</h4>
                </div>
                <form method="post" action="<?php echo base_url();?>home/search">
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
                        <label class="control-label" for="capacity">Select Event</label>
                        <select name="events" id="events"  class="form-control">
                            <option value="" selected="">Select Event</option>
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
                    <div class="col-md-3">
                        <label class="control-label" for="capacity">Select Venue</label>
                        <select name="venue_id" id="venue_id" class="form-control">
                          <option value="0" selected="">Select Venue</option>
                            <?php
                              for ($a = 0; $a < count($venue); $a++) 
                              {                     
                                ?>
                               <option value="<?php echo $venue[$a]->venue_id;?>"><?php echo $venue[$a]->venue_name;?></option>
                                <?php
                              }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" name="search" class="btn btn-primary btn-block">Refine Your Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.top location -->
    <div class="section-space80">
        <!-- top location -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title mb60 text-center">
                        <h1>Top Venues</h1>
                        <p>Locate Your Ideal Venue at Best Prices.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 location-block">
                    <!-- location block -->
                    <div class="vendor-image">
                        <a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m-d-Y')?>/1/0/0"><img src="<?php echo base_url();?>themes/frontend/images/location-pic.jpg" alt="" class="img-responsive"></a> <a href="#" class="venue-lable"><span class="label label-default">Banquet Hall</span></a> </div>
                </div>
                <!-- /.location block -->
                <div class="col-md-4 location-block">
                    <!-- location block -->
                    <div class="vendor-image">
                        <a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m-d-Y')?>/9/0/0"><img src="<?php echo base_url();?>themes/frontend/images/location-pic-2.jpg" alt="" class="img-responsive"></a> <a href="#" class="venue-lable"><span class="label label-default">Resort</span></a> </div>
                </div>
                <!-- /.location block -->
                <div class="col-md-4 location-block">
                    <!-- location block -->
                    <div class="vendor-image">
                        <a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m-d-Y')?>/5/0/0"><img src="<?php echo base_url();?>themes/frontend/images/location-pic-3.jpg" alt="" class="img-responsive"></a> <a href="#" class="venue-lable"><span class="label label-default">Hotel</span></a> </div>
                </div>
                <!-- /.location block -->
                <div class="col-md-8 location-block">
                    <!-- location block -->
                    <div class="vendor-image">
                        <a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m-d-Y')?>/4/0/0"><img src="<?php echo base_url();?>themes/frontend/images/location-pic-4.jpg" alt="" class="img-responsive"></a> <a href="#" class="venue-lable"><span class="label label-default">Wedding Hall</span></a> </div>
                </div>
                <!-- /.location block -->
                <div class="col-md-4 location-block">
                    <!-- location block -->
                    <div class="vendor-image">
                        <a href="<?php echo base_url();?>home/search/0/0/<?php echo date('m-d-Y')?>/8/0/0"><img src="<?php echo base_url();?>themes/frontend/images/location-pic-5.jpg" alt="" class="img-responsive"></a> <a href="#" class="venue-lable"><span class="label label-default">Part Lawn</span></a> </div>
                </div>
                <!-- /.location block -->
            </div>
        </div>
    </div>
    <!-- /.top location -->
