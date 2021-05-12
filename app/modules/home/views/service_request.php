<?php $this->load->view('frontend/topmenu'); ?> 
  <div class="main-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 side-nav" id="leftCol">
                    <div class="hide-side">
                        <ul class="listnone nav" id="sidebar">
                            <li><a href="<?php echo base_url();?>home/servicelist">Listing Services</a></li>
                            <li><a href="<?php echo base_url();?>home/list_ofservice">List My Service</a></li>
                            <li><a href="<?php echo base_url();?>home/favourites_services">Favourite Services</a></li>
                            <li class="active"><a href="<?php echo base_url();?>home/service_request">Service Request</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10 content-right profile-dashboard">
                    <div class="container-fluid">
                      <div class="row">
                            <div class="col-md-3 col-xs-8" style="float: right;"> 
                                <!-- Select Basic -->
                                <form id="myform" action="<?php echo base_url();?>home/service_request" method="post">
                                    <div class="form-group">
                                        <div class=" ">
                                            <select name="filter" id="filter" class="form-control" style="background-color: #fff;" onchange="$('#myform').submit();">
                                                <option value="">All Requests</option>
                                                <option value="4" <?php if($filter){ if($filter == 4){ echo "selected";} } ?> >New Request</option>
                                                <option value="1" <?php if($filter){ if($filter == 1){ echo "selected";} } ?>>Confirmed</option>
                                                <option value="2" <?php if($filter){ if($filter == 2){ echo "selected";} } ?>>Completed</option>
                                                <option value="3" <?php if($filter){ if($filter == 3){ echo "selected";} } ?>>Canceled</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                                        <div class="col-md-2"><span class="th-title">Company</span></div>
                                        <!-- <div class="col-md-1"><span class="th-title">Service</span></div> -->
                                        <div class="col-md-2"><span class="th-title">Booked By</span></div>
                                        <div class="col-md-2"><span class="th-title">Booked On</span></div>
                                        <div class="col-md-2"><span class="th-title">Status</span></div>
                                        <div class="col-md-2"><span class="th-title">Action</span></div>
                                    </div>
                                </div>
                                <?php 
                                  if($servicelist)
                                  {
                                    for ($i=0; $i < count($servicelist) ; $i++) 
                                    {  
                                  ?>  
                                <div class="listing-row">
                                    <!-- listing row -->
                                    <div class="row">
                                        <div class="col-md-2 listing-thumb"><img src="<?php echo base_url();?>uploads/service_image/<?php echo $servicelist[$i]->image_name; ?>" alt="" class="img-responsive"></div>
                                        <div class="col-md-2 listing-title">
                                            <h2><?php echo $servicelist[$i]->company;?></h2> 
                                        </div>
                                        <!-- <div class="col-md-1 listing-price"><?php echo $servicelist[$i]->title;?></div> -->
                                        <div class="col-md-2 listing-title"><?php echo $servicelist[$i]->fname." ".$servicelist[$i]->lname;?></div>
                                        <div class="col-md-2 listing-price"><?php echo date("d F Y", strtotime($servicelist[$i]->startdate)); ?></div>
                                        <div class="col-md-2 listing-price">
                                          <?php 
                                            if ($servicelist[$i]->chk_status == 2) {
                                              echo "<span style='color:#25a032'>Completed</span>";
                                            }elseif($servicelist[$i]->chk_status == 1){
                                              echo "<span style='color:#f7921e'>Confirmed</span>";
                                            }elseif($servicelist[$i]->chk_status == 0){
                                              echo "<span style='color:#fa0f2d'>New Request</span>";
                                            }else{
                                              echo "<span style='color:#282923'>Canceled</span>";
                                            } ?>
                                        </div>
                                        <div class="col-md-2 listing-action">
                                          <a href="<?php echo base_url();?>home/view_booked_service_host/<?php echo $servicelist[$i]->uni_id."/".$servicelist[$i]->service_booking_id;?>" class="btn btn-info btn-sm">View Booking</a>
                                          <?php
                                            // $today = date("m/d/Y H:i");
                                            // $enddate = date("m/d/Y", strtotime($servicelist[$i]->enddate));
                                            // $event_end= explode(" ", $servicelist[$i]->end_time);
                                            // $end_time = $event_end[0].":00 ".strtolower($event_end[1]);
                                            // $combinedDT = date('m/d/Y H:i', strtotime("$enddate $end_time"));
                                            // //echo $combinedDT;
                                            // $text = "Completed";
                                            // $is_disable = "";
                                            // if ($today <=  $combinedDT) {
                                            //   $is_disable = "disabled";
                                            // }
                                            // if($servicelist[$i]->chk_status == '2'){
                                            //   $is_disable = "disabled";
                                            //   $text = "Is Completed";
                                            // }

                                           ?>
                                          <!-- <a href="javascript:;" <?php echo $is_disable; ?>  class="btn btn-danger btn-sm completed" title="Click when event is completed" id="comp<?php echo $servicelist[$i]->service_booking_id;?>" data-id="<?php echo $servicelist[$i]->service_booking_id;?>"><?php echo $text; ?></a> -->
                                        </div>
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
   $('.completed').on('click', function(){
    if ($(this).attr("disabled")) {

      return false;

     }else{
      var id = $(this).attr('data-id');
      var table = 'service';
       $.ajax({
            type : "POST",
            data : {id:id, table:table},
            url : "<?php echo base_url();?>home/update_booked_status",
            success : function(data){
              //alert(data);
             $('#comp'+data).text('Is Completed');
              $('#comp'+data).attr('disabled', 'disabled');
            }
          });
    }

   });
 </script>         
           