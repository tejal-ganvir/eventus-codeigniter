 <div class="tp-breadcrumb">
        <!-- breadcrumb start-->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li><a href="<?php echo base_url();?>home/service">Sevice</a></li>
                        <li class="active">Search List</li>
                    </ol>
                </div>
                <div class="col-md-4 text-right"> </div>
            </div>
        </div>
    </div>
    <!-- /.breadcrumb start-->
    <input type="hidden" value="<?php if($user_id){ echo $user_id; }?>" id="user_id">
    <!-- /.breadcrumb start-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 listing-wrap">
                <!-- listing wrap -->
                <div class="row">
                    <div class="filter-box" id="searchform">
                        <div class="container-fluid">
                            <div class="row filter-form">
                                <div class="col-md-12">
                                    <h2>Refine Your Search</h2>
                                </div>
                                <form id="search_form" method="post" action="<?php echo base_url();?>home/search_service">
                                  <input type="hidden" name="budget" value="0">
                                    <div class="col-md-3">
                                        <label class="control-label" for="venuetype">Select Place</label>
                                        <select class="form-control" name="places" id="places" onchange="$('#search_form').submit()">
                                          <option value="" selected="">Select Place</option>
                                          <?php 
                                            if($event_places)
                                            {
                                              for ($i=0; $i < count($event_places); $i++) 
                                              {   
                                              ?>
                                                <option value="<?php echo $event_places[$i]->location_id?>"<?php if($place){ if($place == $event_places[$i]->location_id){ echo "Selected" ;}}?>><?php echo $event_places[$i]->location_name?></option>
                                                <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                            </div>
                                    <div class="col-md-3">
                                      <input type="text" class="form-control dpicker" name="startdate" placeholder="Start Date" autocomplete="off" id="my-datepicker"  value="<?php if($startdate){ echo $startdate ;}else{ echo date('m/d/Y') ;}?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label" for="capacity">Select Guests</label>
                                         <select class="form-control"  name="guest" id="guest" onchange="$('#search_form').submit()">
                                          <option value="0" selected="">Select Guests</option>
                                          <option value="1" <?php if($guest){ if($guest == 1){ echo "Selected" ;}}?>>0-100 Guests</option>
                                          <option value="2" <?php if($guest){ if($guest == 2){ echo "Selected" ;}}?>>100-200 Guests</option>
                                          <option value="3" <?php if($guest){ if($guest == 3){ echo "Selected" ;}}?>>200-300 Guests</option>
                                          <option value="4" <?php if($guest){ if($guest == 4){ echo "Selected" ;}}?>>300-400 Guests</option>
                                          <option value="5" <?php if($guest){ if($guest == 5){ echo "Selected" ;}}?>>400-500 Guests</option>
                                          <option value="6" <?php if($guest){ if($guest == 6){ echo "Selected" ;}}?>>500&Up Guests</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label" for="capacity">Select Service</label>
                                        <select class="form-control" onchange="$('#search_form').submit()" name="service" id="service"> 
                                          <option value="0" selected="">Select Service</option>
                                          <?php 
                                            if($service_alllist)
                                            {
                                              for ($i=0; $i < count($service_alllist); $i++) 
                                              {   
                                              ?>
                                                <option value="<?php echo $service_alllist[$i]->service_id?>"<?php if($service){ if($service == $service_alllist[$i]->service_id){ echo "Selected" ;}}?>><?php echo $service_alllist[$i]->service_name?></option>
                                                <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="search">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 vendor-listing">
                        <h2>Service Listing</h2>
                    </div>
                    <?php
                      $above="font-size:22px";
                      $style="color:black";
                      $style2="height:200px";
                      $style3="width:200px";
                        $store=array();
                        $lat="";
                        for ($z=0; $z < count($current_fav); $z++) 
                          {
                            $store[]=$current_fav[$z]->service_id;
                          }
                          if($service_list)
                            {
                              for ($i=0; $i < count($service_list); $i++) 
                              {  
                                $page_srno = intval($page_sr);
                          ?>
        
                    <div class="col-md-4 vendor-box mylocation" data-lat="<?php echo $service_list[$i]->lat ?>" data-lon="<?php echo $service_list[$i]->lon ?>">
                      <?php if($user_id)
                        $favclass ="";
                        else
                          $favclass="favclass";

                        if (in_array($service_list[$i]->service_details_id, $store))
                          {
                            $red="style='color:red'";
                            $spoke="Is Your Favourite";
                            $fav="del-fav";
                          }
                          else{
                              $red="";
                              $spoke="Add to Favourites";
                              $fav="add-fav";
                            }

                          ?>
                        <!-- venue box start-->
                        <div class="vendor-image">
                            <!-- venue pic -->
                           <a href="<?php echo base_url();?>home/service_details/<?php echo $service_list[$i]->uni."/".$service_list[$i]->service_details_id ?>"><img src="<?php echo base_url();?>uploads/service_image/<?php echo $service_list[$i]->name;?>" alt="wedding venue" class="img-responsive" style="width: 100%; height: 200px;" ></a>
                           <div class="options">
                              <div class="btn btn-default <?php echo $fav.' '.$favclass?> " type="submit" data-toggle="tooltip" data-placement="top" title="<?php echo $spoke?>" data-id="<?php echo $service_list[$i]->service_details_id?>" onclick="return false;">
                              <i class="fa fa-heart" <?php echo $red?> id="heart<?php echo $service_list[$i]->service_details_id?>"></i>
                            </div>
                          </div>
                        </div>
                        <!-- /.venue pic -->
                        <div class="vendor-detail">
                            <!-- venue details -->
                            <div class="caption">
                                <!-- caption -->
                                <h2><a href="<?php echo base_url();?>home/service_details/<?php echo $service_list[$i]->uni."/".$service_list[$i]->service_details_id ?>" class="title" target="_blank"><?php echo $service_list[$i]->company ?></a></h2>
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
                                  for ($m=0; $m < count($all_service); $m++) 
                                    {

                                      if ($service_list[$i]->service_id == $all_service[$m]->service_id) {
                                        echo $all_service[$m]->service_name;
                                      }

                                    }
                                ?></span></p>
                            </div>
                        </div>
                        <!-- venue details -->
                    </div>

                    <?php 
                        $page_srno = $page_srno + 1;
         
                        if (!empty($service_list[$i]->lat) && !empty($service_list[$i]->lon)) {
                          $lat .= "['<div style=".$style3." ><a style=".$style."  href=".base_url()."home/service_details/".$service_list[$i]->uni." > <img src=".base_url()."uploads/service_image/".$service_list[$i]->name." style=".$style2."> <br> <h2>".$service_list[$i]->company."</h2><small><i>".$service_list[$i]->my_add."</i></small></a></div>',".$service_list[$i]->lat.",".$service_list[$i]->lon."],";
                        }
                        
                        }
                      }
                      else{
                        ?>
                          <p style="margin-left:15px;">Sorry, no records found.....</p>
                        <?php 
                      }
                      
                      $location = rtrim($lat,',');
                      //echo $location;
                    ?>
                    <!-- /.venue box start-->
                    <div class="col-md-12 tp-pagination">
                        <!-- Pagination -->
                        <ul class="pagination">
                            <?php echo $links; ?>
                        </ul>
                    </div>
                    <!-- /.Pagination -->
                </div>
            </div>
            <!-- /.Listing wrap -->
            <div class="col-md-5 map-wrap">
                <!-- map wrap-->
                <div id="mymap" style="width:100%; height:110vh;"></div>
                <!-- <div id="googleMap"></div> -->
            </div>
            <!-- map wrap-->
        </div>
    </div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script type="text/javascript">
  $('body').on('focus', ".dpicker", function () {
    $(this).datepicker();
});
  $(".favourite-bg").click(function(){
    
    alert('service_id');
  });
</script>
<script type="text/javascript"> 
   $(document).ready(function() {
            $('body').on('focus', ".dpicker", function () {
            $(this).datepicker();
        });
    });


  $(function() {
    $('#my-datepicker').datepicker({
      minDate: 0,
      changeMonth: true,
      autoSize: false,
      onSelect: function (dateText, inst) {
        $('#search_form').submit();
      }
    });
  }); 
</script>
 <script type="text/javascript">
    
jQuery.fn.clickToggle = function(a, b) {
  return this.on("click", function(ev) { [b, a][this.$_io ^= 1].call(this, ev) })
};

// TEST:
$('.add-fav').clickToggle(function(ev) {


    if($(this).hasClass('favclass')) {
    // clicked element does not have the class
    $('#signin-box').modal('show');

} else{

  var service_id = $(this).attr('data-id');
  var user_id =$('#user_id').val();

  $.ajax({type: "POST", url: "<?php echo base_url();?>home/fav_service", data: { service_id: service_id,user_id: user_id},
      success: function(result) {
        result = parseInt(result);
        if(result > 0) {

          $('#heart'+service_id).css("color", "red");
        }
      }

 });

}

  
}, function(ev) {

      var service_id = $(this).attr('data-id');
      var user_id =$('#user_id').val();

       $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_fav_service", data: { service_id: service_id,user_id: user_id},
      success: function(result) {
        result = parseInt(result);
        if(result > 0) {
          $('#heart'+service_id).css("color", "#00aeaf");
        }
      }

     });

});


$(".del-fav").click(function(){

  var service_id = $(this).attr('data-id');
      var user_id =$('#user_id').val();

       $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_fav_service", data: { service_id: service_id,user_id: user_id},
      success: function(result) {
        result = parseInt(result);
        if(result > 0) {
          $('#heart'+service_id).css("color", "#00aeaf");
        }
      }

     });

  });
    

  </script>
<script type="text/javascript">
  var locations = [
  <?php echo $location; ?>
  ];

    var map = new google.maps.Map(document.getElementById('mymap'), {
        //scrollwheel:  false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();
    var bounds = new google.maps.LatLngBounds();

    var marker, i;

    ///////////////First Function/////////////////////////////

    for (i = 0; i < locations.length; i++) {  

       
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: "http://maps.google.com/mapfiles/ms/micons/red-dot.png" 
      });

      bounds.extend(marker.position);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }

    map.fitBounds(bounds);


    ///////////////Second Function/////////////////////////////

    $(".mylocation").on('mouseenter',function(){

      mylat=$(this).attr('data-lat');
      mylon=$(this).attr('data-lon');

        for (i = 0; i < locations.length; i++) {  

        if (mylat == locations[i][1] && mylon == locations[i][2]) {

          var myicon = "http://maps.google.com/mapfiles/ms/micons/blue-dot.png";
          
        }else{
          var myicon ="http://maps.google.com/mapfiles/ms/micons/red-dot.png";
        }

       
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: myicon
        //icon: "http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png" 
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }

 });


    $(".mylocation").on('mouseleave',function(){
        for (i = 0; i < locations.length; i++) {  

       
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            icon: "http://maps.google.com/mapfiles/ms/micons/red-dot.png" 
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }

      });
      
</script>