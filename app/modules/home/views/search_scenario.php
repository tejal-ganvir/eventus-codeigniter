<link href="<?php echo base_url();?>themes/frontend/css/jquery.multiselect.css" rel="stylesheet">
<div class="tp-page-head">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="page-header text-center">
                        <div class="icon-circle">
                            <i class="icon icon-size-60 icon-star icon-white"></i>
                        </div>
                        <h1>What Do You Need For Your Event?</h1>
                        <p>Any services and space your event needs in any place.</p>
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
                        <li><a href="#">Home</a></li>
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
                    <div class="col-md-3">
                        <label class="control-label" for="venuetype">Enter Location</label>
                        <input class="form-control" list="browsers" id="location" name="location" placeholder="Location" style="height: 38px; border-radius: 5px;border-color: #999999; background-color: #fff;" value="<?php echo $mylocation; ?>">
                          <datalist id="browsers">
                            <?php 
                                if($space_add)
                                {
                                  for ($i=0; $i < count($space_add); $i++) 
                                  {   
                                  ?>
                                    <option value="<?php echo $space_add[$i]->address?>">
                                    <?php
                                  }
                                }
                            ?>
                          </datalist>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="capacity">Select Service</label>
                        <select class="form-control" name="events" id="events" style="height: 38px; border-radius: 5px;border-color: #999999; background-color: #fff;">
                          <option value="">Event</option>
                           <?php 
                            if($events)
                              {
                                for ($i=0; $i < count($events); $i++) 
                                {   
                                ?>
                                  <option value="<?php echo $events[$i]->event_id?>" <?php if ($events[$i]->event_id == $myevent) { echo "selected"; }?>><?php echo $events[$i]->event_name?></option>
                                  <?php
                                }
                              }
                          ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="capacity">Select Service</label>
                        <select class="form-control" name="service[]" multiple id="service" >
                                  <?php 
                                    if($service)
                                    {
                                      $lockevent= explode(",", $myservices);
                                      
                                      for ($i=0; $i < count($service); $i++) 
                                      {   
                                      ?>
                                        <option value="<?php echo $service[$i]->service_id?>" <?php if (in_array($service[$i]->service_id, $lockevent)) { echo "selected"; } ?>><?php echo $service[$i]->service_name?></option>
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

    <!-- Feature Blog End -->
    <div class="main-container">
        <div class="container">
          <h1>Popular Spaces</h1>
          <br>
            <div class="row">
                        <?php 
                         if($space_list)
                          {
                          for ($i=0; $i < count($space_list); $i++) 
                          {  
                          ?>

                    <div class="col-md-3 vendor-box ">
                        <!-- venue box start-->
                        <div class="vendor-image">
                            <!-- venue pic -->
                            <a href="<?php echo base_url();?>home/view_space_details/<?php echo $space_list[$i]->uni."/".$space_list[$i]->space_id ?>"><img src="<?php echo base_url();?>uploads/space_image/<?php echo $space_list[$i]->name;?>" alt="wedding venue" class="img-responsive" style="width: 100%; height: 200px;"></a>
                        </div>
                        <!-- /.venue pic -->
                        <div class="vendor-detail">
                            <!-- venue details -->
                            <div class="caption">
                                <!-- caption -->
                                <h2><a href="<?php echo base_url();?>home/view_space_details/<?php echo $space_list[$i]->uni."/".$space_list[$i]->space_id ?>" class="title" target="_blank"><?php echo $space_list[$i]->title?></a></h2>
                                <p class="location"><i class="fa fa-map-marker"></i> <?php echo $space_list[$i]->my_add?></p>
                                <?php 
                                  if ($space_list[$i]->no_review > 0) {
                                   $x = floor($space_list[$i]->stars * 2) / 2;
                                ?>
                                <div class="rating"> 
                                  <div class="rateit" data-rateit-value="<?php echo $x; ?>" data-rateit-ispreset="true" data-rateit-readonly="true" data-rateit-mode="font"></div> 
                                  <span class="rating-count">(<?php echo $space_list[$i]->no_review ?>)</span> 
                                </div>
                                <?php } else{
                                        echo "<div style='padding:4px'></div>";
                                      }
                                    ?>
                            </div>
                            <!-- /.caption -->
                            <div class="vendor-price">
                              <span style="color: #00aeaf;font-weight: bolder;">
                                <?php echo $space_list[$i]->venue_name; ?>
                              </span>
                                <!-- <div class="price">₹ <?php echo $space_list[$i]->base_price?></div> -->
                            </div>
                        </div>
                        <!-- venue details -->
                    </div>

                    <?php 
                        
                        }
                      }
                      else{
                        ?>
                          <p>Sorry, no records found</p>
                        <?php 
                      } ?>
                <!-- /.venue box start-->
            </div>
            <?php if(count($space_list) > 3){ ?>
              <div class="row">
                  <div class="col-md-12 tp-pagination">
                      <button type="submit" name="search" class="btn btn-primary" onclick="window.location.replace('<?php echo base_url();?>home/scenario_space')">See All >> </button>
                  </div>
              </div>
            <?php } ?>
        </div>
    </div>
    <!-- Feature Blog End -->
    <div class="main-container">
        <div class="container">
          <h1>Explore Services</h1>
          <br>
            <div class="row">
                        <?php 
                         if($service_list)
                            {
                              for ($i=0; $i < count($service_list); $i++) 
                              {    
                          ?>

                    <div class="col-md-3 vendor-box" >
                        <!-- venue box start-->
                        <div class="vendor-image">
                            <!-- venue pic -->
                           <a href="<?php echo base_url();?>home/view_service_details/<?php echo $service_list[$i]->uni."/".$service_list[$i]->service_details_id ?>"><img src="<?php echo base_url();?>uploads/service_image/<?php echo $service_list[$i]->name;?>" alt="wedding venue" class="img-responsive" style="width: 100%; height: 200px;"></a>
                        </div>
                        <!-- /.venue pic -->
                        <div class="vendor-detail">
                            <!-- venue details -->
                            <div class="caption">
                                <!-- caption -->
                                <h2><a href="<?php echo base_url();?>home/view_service_details/<?php echo $service_list[$i]->uni."/".$service_list[$i]->service_details_id ?>" class="title"><?php echo $service_list[$i]->company ?></a></h2>
                                <p class="location"><i class="fa fa-map-marker"></i> <?php echo $service_list[$i]->my_add?></p>
                                <?php 
                                  if ($service_list[$i]->no_review > 0) {
                                   $x = floor($service_list[$i]->stars * 2) / 2;
                                ?>
                                <div class="rating"> 
                                  <div class="rateit" data-rateit-value="<?php echo $x; ?>" data-rateit-ispreset="true" data-rateit-readonly="true" data-rateit-mode="font"></div> 
                                  <span class="rating-count">(<?php echo $service_list[$i]->no_review ?>)</span> 
                                </div>
                                <?php } else{
                                        echo "<div style='padding:4px'></div>";
                                      }
                                    ?>
                            </div>
                            <!-- /.caption -->
                            <div class="vendor-price">
                                <p class="">Service: <span style="color: #00aeaf;font-weight: bolder;"><?php

                                    for ($m=0; $m < count($service); $m++) 
                                      {

                                        if ($service_list[$i]->service_id == $service[$m]->service_id) {
                                          echo $service[$m]->service_name;
                                        }

                                      }
                                ?></span></p>
                            </div>
                        </div>
                        <!-- venue details -->
                    </div>

                    <?php 
                        
                        }
                      }
                      else{
                        ?>
                          <p>Sorry, no records found</p>
                        <?php 
                      } ?>
                <!-- /.venue box start-->
            </div>
            <?php if(count($service_list) > 3){ ?>
              <div class="row">
                  <div class="col-md-12 tp-pagination">
                      <button type="submit" name="search" class="btn btn-primary" onclick="window.location.replace('<?php echo base_url();?>home/scenario_service')">See All >> </button>
                  </div>
              </div>
            <?php } ?>
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