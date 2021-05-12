<?php $this->load->view('frontend/topmenu'); ?> 
  <div class="main-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 side-nav" id="leftCol">
                    <div class="hide-side">
                        <ul class="listnone nav" id="sidebar">
                            <li><a href="<?php echo base_url();?>home/spacelist">Listing Spaces</a></li>
                            <li><a href="<?php echo base_url();?>home/list_ofspace">List My Space</a></li>
                            <li><a href="<?php echo base_url();?>home/favourites">Favourite Spaces</a></li>
                            <li class="active"><a href="<?php echo base_url();?>home/space_request">Space Request</a></li>
                        </ul> 
                    </div>
                </div>
                <div class="col-md-10 content-right profile-dashboard">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3 col-xs-8" style="float: right;"> 
                                <!-- Select Basic -->
                                <form id="myform" action="<?php echo base_url();?>home/space_request" method="post">
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
                                        <div class="col-md-2"><span class="th-title">Title</span></div>
                                        <div class="col-md-2"><span class="th-title">Booked By</span></div>
                                        <div class="col-md-2"><span class="th-title">Booked On</span></div>
                                        <div class="col-md-2"><span class="th-title">Status</span></div>
                                        <div class="col-md-2"><span class="th-title">Action</span></div>
                                    </div>
                                </div>
                                <?php 
                                  if($spacelist)
                                  {
                                    for ($i=0; $i < count($spacelist) ; $i++) 
                                    {  
                                  ?>  
                                <div class="listing-row">
                                    <!-- listing row -->
                                    <div class="row">
                                        <div class="col-md-2 listing-thumb"><img src="<?php echo base_url();?>uploads/space_image/<?php echo $spacelist[$i]->image_name; ?>" alt="" class="img-responsive"></div>
                                        <div class="col-md-2 listing-title">
                                            <h2><?php echo $spacelist[$i]->title;?></h2> 
                                        </div>
                                        <div class="col-md-2 listing-title"><?php echo $spacelist[$i]->fname." ".$spacelist[$i]->lname;?></div>
                                        <div class="col-md-2 listing-price"><?php echo date("d F Y", strtotime($spacelist[$i]->startdate)); ?></div>
                                        <div class="col-md-2 listing-price">
                                          <?php 
                                            if ($spacelist[$i]->chk_status == 2) {
                                              echo "<span style='color:#25a032'>Completed</span>";
                                            }elseif($spacelist[$i]->chk_status == 1){
                                              echo "<span style='color:#f7921e'>Confirmed</span>";
                                            }elseif($spacelist[$i]->chk_status == 0){
                                              echo "<span style='color:#fa0f2d'>New Request</span>";
                                            }else{
                                              echo "<span style='color:#282923'>Canceled</span>";
                                            } ?>
                                        </div>
                                        <div class="col-md-2 listing-action">
                                          <a href="<?php echo base_url();?>home/view_booked_space_host/<?php echo $spacelist[$i]->uni_id."/".$spacelist[$i]->space_booking_id;?>" class="btn btn-info btn-sm">View Booking</a>
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
        
           