<div class="kf-home-banner">
  <div id="owl-demo-main" class="owl-carousel owl-theme">
    <?php 
      if($service_image)
      {
        for ($k=0; $k < count($service_image); $k++) 
        {  
    ?>
    <div class="item">
      <figure style="height:500px;">
        <img  height="500px;" src="<?php echo base_url();?>uploads/service_image/<?php echo $service_image[$k]->name; ?>" alt=""/> 
      </figure>
    </div>
    <?php 
        }
      }
    ?> 
  </div>
</div>
<div class="kf_content_wrap"> 
  <section class="kf-gallery-wrap" id="filters" style="padding-bottom: 1px; "> 
    <div class="col-md-12">
      <div class="kf-heading-1 kf-heading-1width">
        <div class="div1">
          <div>
            <h5>About This Listing</h5><br>
            <div>Service Name :&nbsp;&nbsp;<?php if($service_detail){ echo $service_detail['ser_name'];}?><br>
              <?php if($service_detail){ echo $service_detail['description'];}?></div><br>
          </div>
          <hr>
        </div> 
        <div class="div1">
          <div>
            <div>
              <div style="color:#449E8E;">About Host</div><br>
              <div><?php if($service_detail){ echo $service_detail['about_them'];}?></div><br>
            </div>
            <hr>
          </div>
        </div>
        <div class="div1">
          <div>
            <div style="color:#449E8E;">Prices</div><br>
            <div>
              <?php 
                $day = ''; 
                if($service_days)
                { 
                  for ($j=0; $j < count($service_days); $j++) 
                  { 
                      $day .= ' '.$service_days[$j]->day.','; 
                  }
                  $day = rtrim($day,',');
                }
              ?>
              Avaiable  on: <?php echo $day?><br>
              Price per hr: <?php if($service_detail){ echo $service_detail['base_price'];}?><br>
              Price type: <?php if($service_detail){ echo ucfirst($service_detail['price_type']);}?><br>
              Minimum hrs: <?php if($service_detail){ echo $service_detail['min_hrs'];}?>&nbsp;hrs<br>
              <?php
              $min = '';
              if($service_detail) 
              {
                if($service_detail['guest'] == 1)
                  $min = "0-20 Guests";
                else if($service_detail['guest'] == 2)
                  $min = "21-50 Guests";
                else if($service_detail['guest'] == 3)
                  $min = "51-100 Guests";
                else if($service_detail['guest'] == 4)
                  $min = "100 & Up Guests"; 
              }
              ?>
              No of Guest: <?php echo $min?><br> 
            </div><br> 
            <hr>
          </div>
        </div>
      </div>
      <div class="kf-heading-2">
        <div class="form formdiv4">
          <div class="formtittle">Action</div> <br>
          <div class="input-container formInput">
            <a href="<?php echo base_url();?>home/editservice/<?php if($service_detail){ echo $service_detail['uni_id'];}?>" class="btn-style1">Edit</a>
          </div>
          <div class="input-container formInput">
            <button class="btn-style1" onclick="DeleteSpace('<?php if($service_detail){ echo $service_detail['uni_id'];}?>');">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </section>
<script type="text/javascript">
function DeleteSpace(id){
  $.confirm({
    title: 'Confirmation Message',
    content: 'Are you sure, you want to delete the space ?',
    confirmButton: 'Proceed',
    confirmButtonClass: 'btn-info',
    icon: 'fa fa-question-circle',
    animation: 'scale',
    animationClose: 'top',
    opacity: 1, 
    confirm: function () { 
        $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_thatservice/"+id,  
          success: function(result) { 
            if(result == 1) {
              $.alert({
                  title: 'Success!',
                  content: 'Service has been deleted successfully...',
                  confirmButton: 'Okay',
                  confirmButtonClass: 'btn-warning',
                  icon: 'fa fa-info',
                  animation: 'zoom',
                  opacity: 1,                                    
                  confirm: function () {
                      window.location.href = "<?php echo base_url();?>home/serviceist";
                  }
              });
            }  
            else{
              var msg = 'Unable to deleted the service ,Please try again.';
              alert_pop(msg);
            }
          }
        });
      }
  });
}
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
  
  