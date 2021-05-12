<style type="text/css">
  .caption{
    padding-left: 20px;
  }
</style>
    <div class="tp-page-head">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Items Added In Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tp-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>">Home</a></li>
                        <li class="active">View Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<input type="hidden" id="user_id" value="<?php if($user_id){ echo $user_id; }?>">
<?php
$total_service=0;
$total_space =0;
?>
<section class="main-container">
  <div class="container" >
          <div class="row">
            <?php 
                    if($spacelist)
                    {
                      for ($i=0; $i < count($spacelist) ; $i++) 
                      {  
                    ?>
                    <div class="col-lg-10 col-lg-offset-1" id="space<?php echo $spacelist[$i]->space_cart_id ;?>">
                      <div class="vendor-box-list" >
                          <!-- vendor list -->
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="vendor-image">
                                      <!-- venue pic -->
                                      <a href="javascript:void(0)"><img src="<?php echo base_url();?>uploads/space_image/<?php echo $spacelist[$i]->image_name; ?>" alt="wedding venue" class="img-responsive" style="max-height: 210px; width: 100%;"></a>
                                      <div class="favourite-bg2 remove-space" data-id="<?php echo $spacelist[$i]->space_cart_id ;?>" data-price="<?php echo $spacelist[$i]->amount;?>" title="Remove From Cart"><a href="#" class=""><i class="fa fa-trash" style="color: red;"></i></a></div>
                                  </div>
                              </div>
                              <!-- /.venue pic -->
                              <div class=" col-md-8 no-left-pd">
                                  <!-- venue details -->
                                  <div class="vendor-list-details">
                                      <div class="caption" style="padding: 10px 10px 10px 30px;">
                                          <!-- caption -->
                                          <h2><a href="<?php echo base_url();?>home/space_details/<?php echo $spacelist[$i]->uni_id."/".$spacelist[$i]->space_id?>" class="title"><?php echo $spacelist[$i]->company;?></a></h2>
                                          <p class="location"><i class="fa fa-map-marker"></i> <?php echo $spacelist[$i]->address;?></p>
                                          <p style="margin: 0px;">Selected Event: <?php echo $spacelist[$i]->event_name;?></p>
                                          <p style="margin: 0px;">Hosted By: <?php echo $spacelist[$i]->fname." ".$spacelist[$i]->lname;?></p>
                                          <p style="margin: 0px;">No of Guests: <?php 
                                            $min = '';
                                            if($spacelist) 
                                            {
                                              if($spacelist[$i]->guest == 1)
                                                $min = "0-100 Guests";
                                              else if($spacelist[$i]->guest == 2)
                                                $min = "100-200 Guests";
                                              else if($spacelist[$i]->guest == 3)
                                                $min = "200-300 Guests";
                                              else if($spacelist[$i]->guest == 4)
                                                $min = "300-400 Guests"; 
                                              else if($spacelist[$i]->guest == 5)
                                                $min = "400-500 Guests"; 
                                              else if($spacelist[$i]->guest == 6)
                                                $min = "500 & Up Guests"; 
                                            }
                                            echo $min;
                                          ?></p>
                                      </div>
                                      <!-- /.caption -->
                                      <div class="vendor-price">
                                          <div class="price">₹ <?php echo $spacelist[$i]->amount;?></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    <!------------FORM START------------------->
                      <form class="coli_form" action="<?php echo base_url();?>home/book_cart_space">
                        <input type="hidden" name="space_id" id="space_id" value="<?php echo $spacelist[$i]->space_id ?>">
                        <input type="hidden" name="event_id" id="event_id" value="<?php echo $spacelist[$i]->event_id ?>">
                        <input type="hidden" name="guest_id" id="guest_id" value="<?php echo $spacelist[$i]->guest_id ?>">
                        <input type="hidden" name="startdate" id="startdate" value="<?php echo $spacelist[$i]->startdate ?>">
                        <input type="hidden" name="enddate" id="enddate" value="<?php echo $spacelist[$i]->enddate ?>">
                        <input type="hidden" name="start_time" id="start_time" value="<?php echo $spacelist[$i]->start_time ?>">
                        <input type="hidden" name="end_time" id="end_time" value="<?php echo $spacelist[$i]->end_time ?>">
                        <input type="hidden" name="amount" id="amount" value="<?php echo $spacelist[$i]->amount ?>">
                      </form>
                    <!------------FORM END------------------->
                    <?php
                    $total_space= $total_space + $spacelist[$i]->amount;
                      }
                    }
                    else
                    {
                      ?><!-- <p style="color:#ffffff;">Sorry no records are found....</p> --><?php 
                    }
                   ?>
          </div>
        </div>




    <div class="container">
          <div class="row">
            <?php 
                    if($servicelist)
                    {
                      
                      for ($i=0; $i < count($servicelist) ; $i++) 
                      {  
                    ?>
                    <div class="col-lg-10 col-lg-offset-1" id="service<?php echo $servicelist[$i]->service_cart_id ;?>">
                      <div class="vendor-box-list" >
                          <!-- vendor list -->
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="vendor-image">
                                      <!-- venue pic -->
                                      <a href="javascript:void(0)"><img src="<?php echo base_url();?>uploads/service_image/<?php echo $servicelist[$i]->image_name; ?>" alt="wedding venue" class="img-responsive" style="max-height: 210px; width: 100%;"></a>
                                      <div class="favourite-bg2 remove-service" data-id="<?php echo $servicelist[$i]->service_cart_id ;?>" data-price="<?php echo $servicelist[$i]->amount;?>"  title="Remove From Cart"><a href="#" class=""><i class="fa fa-trash" style="color: red;"></i></a></div>
                                  </div>
                              </div>
                              <!-- /.venue pic -->
                              <div class=" col-md-8 no-left-pd">
                                  <!-- venue details -->
                                  <div class="vendor-list-details">
                                      <div class="caption" style="padding: 10px;">
                                          <!-- caption -->
                                          <h2><a href="<?php echo base_url();?>home/service_details/<?php echo $servicelist[$i]->uni_id."/".$servicelist[$i]->service_details_id?>" class="title"><?php echo $servicelist[$i]->company;?></a></h2>
                                          <p class="location"><i class="fa fa-map-marker"></i> <?php echo $servicelist[$i]->address;?></p>
                                          <p style="margin: 0px;">Selected Service: <?php echo $servicelist[$i]->title;?></p>
                                          <p style="margin: 0px;">Hosted By: <?php echo $servicelist[$i]->fname." ".$servicelist[$i]->lname;?></p>
                                          <p style="margin: 0px;">No of Guests: <?php 
                                            $min = '';
                                            if($servicelist) 
                                            {
                                              if($servicelist[$i]->guest == 1)
                                                $min = "0-100 Guests";
                                              else if($servicelist[$i]->guest == 2)
                                                $min = "100-200 Guests";
                                              else if($servicelist[$i]->guest == 3)
                                                $min = "200-300 Guests";
                                              else if($servicelist[$i]->guest == 4)
                                                $min = "300-400 Guests"; 
                                              else if($servicelist[$i]->guest == 5)
                                                $min = "400-500 Guests"; 
                                              else if($servicelist[$i]->guest == 6)
                                                $min = "500 & Up Guests"; 
                                            }
                                            echo $min;
                                          ?></p>
                                      </div>
                                      <!-- /.caption -->
                                      <div class="vendor-price">
                                          <div class="price">₹ <?php echo $servicelist[$i]->amount;?></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    <!------------FORM START------------------->
                      <form class="coli_form" action="<?php echo base_url();?>home/book_cart_service">
                        <input type="hidden" name="service_id" id="service_id" value="<?php echo $servicelist[$i]->service_details_id ?>">
                        <input type="hidden" name="package_id" id="package_id" value="<?php echo $servicelist[$i]->package_id ?>">
                        <input type="hidden" name="guest_id" id="guest_id" value="<?php echo $servicelist[$i]->guest_id ?>">
                        <input type="hidden" name="startdate" id="startdate" value="<?php echo $servicelist[$i]->startdate ?>">
                        <input type="hidden" name="enddate" id="enddate" value="<?php echo $servicelist[$i]->enddate ?>">
                        <input type="hidden" name="start_time" id="start_time" value="<?php echo $servicelist[$i]->start_time ?>">
                        <input type="hidden" name="end_time" id="end_time" value="<?php echo $servicelist[$i]->end_time ?>">
                        <input type="hidden" name="amount" id="amount" value="<?php echo $servicelist[$i]->amount ?>">
                      </form>
                    <!------------FORM END------------------->
                    <?php
                       $total_service = $total_service + $servicelist[$i]->amount;
                      }
                    }
                    else
                    {
                      ?><!-- <p style="color:#ffffff;">Sorry no records are found....</p> --><?php 
                    }
                   ?> 
                   <p></p>
                   <?php
                    if($total_service + $total_space == 0)
                    {
                      ?><p style="color:#000;">Sorry, no records found</p><?php
                      exit;
                    }
                   ?>


                      <div class="col-lg-10 col-lg-offset-1 col-sm-12 well-box" style="background-color:#ccc; padding: 10px;">
                        <div class="col-lg-10" style="background-color: #FFF; padding: 10px; font-size:28px;font-weight: 400px ; color: red;">
                          Checkout Price
                        </div>
                        <div class="col-lg-2 text-center" style="color: #000;padding-top: 15px;">
                          <p style="font-size:25px;font-weight: 400px ;">₹ <b id="total_price"><?php echo  $total_service + $total_space; ?></b></p>
                        </div>
                      </div>
                      <div class="col-lg-10 col-lg-offset-1 col-sm-12" >
                        <center>
                          <button class="btn btn-style3" name="submit" id="send_button" style="padding-left: 30px; padding-right: 30px;">Proceed to Checkout</button>
                        </center>
                      </div>
          </div>
        </div>
</section>


<section class="image_footer_bg" style="margin-bottom: 0px; padding-bottom: 0px;">
  <div class="container-fluid" style="padding-top: 20px;">
          <div class="row">
            
          </div>
  </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
  $("#send_button").click(function () {
    var count = $('.coli_form').length;
    //alert('hie');
      $.confirm({
    title: 'Confirmation Message',
    content: 'Are you sure, you want to checkout ?',
    confirmButton: 'Proceed',
    confirmButtonClass: 'btn-info',
    icon: 'fa fa-question-circle',
    animation: 'scale',
    animationClose: 'top',
    opacity: 1, 
    confirm: function () { 
      $('.coli_form').each(function () {
              var $form = $(this);
              //alert($(this).attr('action'));
              $.post($form.attr("action"), $form.serialize(), function (data) {
                  //alert(data);
                  if (!--count){
                    window.location.replace('<?php echo base_url();?>home/my_booking');
                  }
              });

          });
        }
      });
  });
</script>
<script type="text/javascript">
  $(".my-rating").starRating({
  readOnly: true,
  strokeColor: '#894A00',
  strokeWidth: 10,
  starSize: 25
});
</script>
<script type="text/javascript">

  $(".remove-service").click(function(){
      var cart_id = $(this).attr('data-id');
      var price = $(this).attr('data-price');
      var total = $('#total_price').text();

      $.confirm({
    title: 'Confirmation Message',
    content: 'Are you sure, you want to remove from cart ?',
    confirmButton: 'Proceed',
    confirmButtonClass: 'btn-info',
    icon: 'fa fa-question-circle',
    animation: 'scale',
    animationClose: 'top',
    opacity: 1, 
    confirm: function () { 
        $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_mycart_service", data: { cart_id: cart_id},
        success: function(result) {
            result = parseInt(result);
            if(result > 0) {
                
                  $('#service'+cart_id).fadeTo(1000, 0.01, function(){ 
                      $(this).slideUp(150, function() {
                          $(this).remove(); 
                      }); 
                  });
                  $('#total_price').text(total-price);
            }
          }
        });
      }
    });

  });

  $(".remove-space").click(function(){
      var cart_id = $(this).attr('data-id');
      var price = $(this).attr('data-price');
      var total = $('#total_price').text();

      $.confirm({
    title: 'Confirmation Message',
    content: 'Are you sure, you want to remove from cart ?',
    confirmButton: 'Proceed',
    confirmButtonClass: 'btn-info',
    icon: 'fa fa-question-circle',
    animation: 'scale',
    animationClose: 'top',
    opacity: 1, 
    confirm: function () { 
        $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_mycart_space", data: { cart_id: cart_id},
        success: function(result) {
            result = parseInt(result);
            if(result > 0) {
              alert_pop('Successfully Removed from Cart');
                $('#space'+cart_id).remove();
                //   $('#space'+cart_id).fadeTo(1000, 0.01, function(){ 
                //     $(this).slideUp(150, function() {
                //         $(this).remove(); 
                //     }); 
                // });
                $('#total_price').text(total-price);
            }
          }
        });
      }
    });

 });
   function alert_pop(msg){
   $.alert({
      title: 'Alert Message',
      content: msg,
      confirmButton: 'okay',
      confirmButtonClass: 'btn-warning',
      animation: 'bottom',
      icon: 'fa fa-check',
      opacity: 2,  
      backgroundDismiss: true
  });
}
</script>