    <div class="tp-breadcrumb">
        <!-- breadcrumb start-->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li class="active">Activity</li>
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
                                <form id="search_form" method="post" action="<?php echo base_url();?>home/search">
                                    <div class="col-md-3">
                                        <label class="control-label" for="venuetype">Select Guests</label>
                                        <select class="form-control"  name="guest" id="guest" onchange="$('#search_form').submit()">
                                          <option value="" disabled="" selected="">Select Guests</option>
                                          <option value="1" >0-100 Guests</option>
                                          <option value="2" >100-200 Guests</option>
                                          <option value="3" >200-300 Guests</option>
                                          <option value="4" >300-400 Guests</option>
                                          <option value="5" >400-500 Guests</option>
                                          <option value="6" >500&Up Guests</option>
                                        </select>
                                            </div>
                                    <div class="col-md-3">
                                        <input  type="text" id="my-datepicker" name="startdate" class="form-control dpicker" placeholder="Start Date" value="<?php echo date('m/d/Y'); ?>" >
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label" for="capacity">Budget</label>
                                        <select class="form-control" name="budget" id="budget" onchange="$('#search_form').submit()">
                                          <option value="" disabled="" selected="">Budget</option>
                                          <option value="1-1000" >>₹1000</option>
                                          <option value="1000-3000" >₹1000-₹3000</option>
                                          <option value="3000-6000" >₹3000-₹6000</option>
                                          <option value="6000-10000" >₹6000-₹10000</option>
                                          <option value="10000" >₹10000 +</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label" for="capacity">Select Event</label>
                                        <select class="form-control" onchange="$('#search_form').submit()" name="events" id="events">
                                        <option value="" disabled="" selected="">Select Event</option>
                                         <?php 
                                            if($events)
                                            {
                                              for ($i=0; $i < count($events); $i++) 
                                              {   
                                              ?>
                                                <option value="<?php echo $events[$i]->event_id?>" ><?php echo $events[$i]->event_name?></option>
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
                        <h2>Space Listing</h2>
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
                            $store[]=$current_fav[$z]->space_id;
                          }
                      if($space_list)
                        {
                          for ($i=0; $i < count($space_list); $i++) 
                          {  
                            $page_srno = intval($page_sr);
                          ?>

                    <div class="col-md-4 vendor-box mylocation" data-lat="<?php echo $space_list[$i]->lat ?>" data-lon="<?php echo $space_list[$i]->lon ?>" data-id="<?php echo $space_list[$i]->uni ?>" data-space="<?php echo $space_list[$i]->space_id; ?>" >
                      <?php if($user_id)
                        $favclass ="";
                        else
                          $favclass="favclass";

                        if (in_array($space_list[$i]->space_id, $store))
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
                            <a href="<?php echo base_url();?>home/space_details/<?php echo $space_list[$i]->uni."/".$space_list[$i]->space_id ?>"><img src="<?php echo base_url();?>uploads/space_image/<?php echo $space_list[$i]->name;?>" alt="wedding venue" class="img-responsive" style="width: 100%; height: 200px;"></a>
                            <div class="options">
                              <div class="<?php echo $fav.' '.$favclass?> " type="submit" data-toggle="tooltip" data-placement="top" title="<?php echo $spoke?>" data-id="<?php echo $space_list[$i]->space_id?>" onclick="return false;">
                              <i class="fa fa-heart" <?php echo $red?> id="heart<?php echo $space_list[$i]->space_id?>"></i>
                            </div>
                            </div>
                        </div>
                        <!-- /.venue pic -->
                        <div class="vendor-detail">
                            <!-- venue details -->
                            <div class="caption">
                                <!-- caption -->
                                <h2><a href="<?php echo base_url();?>home/space_details/<?php echo $space_list[$i]->uni."/".$space_list[$i]->space_id ?>" class="title" target="_blank"><?php echo $space_list[$i]->title?></a></h2>
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
                        $page_srno = $page_srno + 1;
         
                        if (!empty($space_list[$i]->lat) && !empty($space_list[$i]->lon)) {
                          $lat .= "['<div style=".$style3." ><a style=".$style."  href=".base_url()."home/space_details/".$space_list[$i]->uni." > <img src=".base_url()."uploads/space_image/".$space_list[$i]->name." style=".$style2."> <br> <h2>".$space_list[$i]->title."</h2><small><i>".$space_list[$i]->my_add."</i></small></a></div>',".$space_list[$i]->lat.",".$space_list[$i]->lon."],";
                        }
                        
                        }
                      }
                      else{
                        ?>
                          <p>Sorry no records are found........</p>
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
    return false;

} else{

  var space_id = $(this).attr('data-id');
  var user_id =$('#user_id').val();


  $.ajax({type: "POST", url: "<?php echo base_url();?>home/fav_space", data: { space_id: space_id,user_id: user_id},
      success: function(result) {
        result = parseInt(result);
        if(result > 0) {

          $('#heart'+space_id).css("color", "red");
        }
      }

 });

}

  
}, function(ev) {

      var space_id = $(this).attr('data-id');
      var user_id =$('#user_id').val();

       $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_fav_space", data: { space_id: space_id,user_id: user_id},
      success: function(result) {
        result = parseInt(result);
        if(result > 0) {
          $('#heart'+space_id).css("color", "#00aeaf");
        }
      }

     });

});
  
  $(".del-fav").click(function(){
     var space_id = $(this).attr('data-id');
      var user_id =$('#user_id').val();

       $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_fav_space", data: { space_id: space_id,user_id: user_id},
      success: function(result) {
        result = parseInt(result);
        if(result > 0) {
          $('#heart'+space_id).css("color", "#00aeaf");
          $("[data-id="+space_id+"]").removeClass('del-fav');
          $("[data-id="+space_id+"]").addClass('add-fav');
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
