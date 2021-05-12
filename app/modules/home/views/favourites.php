<?php $this->load->view('frontend/topmenu'); ?> 
  <div class="main-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 side-nav" id="leftCol">
                    <div class="hide-side">
                        <ul class="listnone nav" id="sidebar">
                            <li><a href="<?php echo base_url();?>home/spacelist">Listing Spaces</a></li>
                            <li><a href="<?php echo base_url();?>home/list_ofspace">List My Space</a></li>
                            <li class="active"><a href="<?php echo base_url();?>home/favourites">Favourite Spaces</a></li>
                            <li><a href="<?php echo base_url();?>home/space_request">Space Request</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10 content-right profile-dashboard">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 my-listing-dashboard">
                                <?php 
                                    if($this->session->flashdata('success'))
                                    {
                                      echo '<div class="alert alert-success errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('success').'</div>';
                                    } 
                                    elseif($this->session->flashdata('error'))
                                    {
                                        echo '<div class="alert alert-danger errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('error').'</div>';
                                    }
                                ?>
                                <div class="table-head">
                                    <div class="row">
                                        <div class="col-md-2"><span class="th-title">Picture</span></div>
                                        <div class="col-md-2"><span class="th-title">Title</span></div>
                                        <div class="col-md-3"><span class="th-title">Address</span></div>
                                        <div class="col-md-1"><span class="th-title">Zip Code</span></div>
                                        <div class="col-md-2"><span class="th-title">Venue Type</span></div>
                                        <div class="col-md-2"><span class="th-title">Action</span></div>
                                    </div>
                                </div>
                                <?php 
                                  if($spacelist)
                                  {
                                    for ($i=0; $i < count($spacelist) ; $i++) 
                                    {  
                                  ?>  
                                <div class="listing-row" id="row<?php echo $spacelist[$i]->spc_id;?>">
                                    <!-- listing row -->
                                    <div class="row">
                                        <div class="col-md-2 listing-thumb"><img src="<?php echo base_url();?>uploads/space_image/<?php echo $spacelist[$i]->image_name; ?>" alt="" class="img-responsive"></div>
                                        <div class="col-md-2 listing-title">
                                            <h2><?php echo $spacelist[$i]->title;?></h2> 
                                        </div>
                                        <div class="col-md-3 listing-address"><?php echo $spacelist[$i]->address;?></div>
                                        <div class="col-md-1 listing-price"><?php echo $spacelist[$i]->zip_code;?></div>
                                        <div class="col-md-2 listing-price"><?php echo $spacelist[$i]->venue_name;?></div>
                                        <div class="col-md-2 listing-action">
                                          <a href="<?php echo base_url();?>home/space_details/<?php echo $spacelist[$i]->unique_id;?>" class="btn btn-info btn-sm">View</a>
                                          <a href="javascript:;" data-id="<?php echo $spacelist[$i]->spc_id;?>" title="Delete space" class="btn btn-danger btn-sm myspace">Delete</a></div>
                                    </div>
                                </div>
                                <?php
                                    }
                                  }
                                  else
                                  {
                                    ?><p style="color:#000;">Sorry, no records found</p><?php 
                                  }
                                 ?> 
                                <!-- listing row -->
                            </div>
                            <div class="col-md-12 tp-pagination">
                                <ul class="pagination">
                                    <?php echo $links; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script type="text/javascript">

    $(".myspace").click(function(){
       var space_id = $(this).attr('data-id');
      $.confirm({
    title: 'Confirmation Message',
    content: 'Are you sure, you want to remove from favourites ?',
    confirmButton: 'Proceed',
    confirmButtonClass: 'btn-info',
    icon: 'fa fa-question-circle',
    animation: 'scale',
    animationClose: 'top',
    opacity: 1, 
    confirm: function () { 
        $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_myfav_space", data: { space_id: space_id},
        success: function(result) {
            result = parseInt(result);
            if(result > 0) {
                
                  $('#row'+space_id).animate({
                  opacity: 'hide', // animate fadeOut
                  width: 'hide'  // animate slideLeft
                }, 'slow', 'linear', function() {
                  $(this).remove();
                });
            }
          }
        });
      }
    });

  });
</script>
           
 