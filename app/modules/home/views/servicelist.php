<?php $this->load->view('frontend/topmenu'); ?> 
<div class="main-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 side-nav" id="leftCol">
                    <div class="hide-side">
                        <ul class="listnone nav" id="sidebar">
                            <li  class="active"><a href="<?php echo base_url();?>home/servicelist">Listing Services</a></li>
                            <li><a href="<?php echo base_url();?>home/list_ofservice">List My Service</a></li>
                            <li><a href="<?php echo base_url();?>home/favourites_services">Favourite Services</a></li>
                            <li><a href="<?php echo base_url();?>home/service_request">Service Request</a></li>
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
                                        <div class="col-md-2"><span class="th-title">Provider</span></div>
                                        <div class="col-md-2"><span class="th-title">Service</span></div>
                                        <div class="col-md-3"><span class="th-title">Address</span></div>
                                        <div class="col-md-1"><span class="th-title">Status</span></div>
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
                                            <h2><?php echo $servicelist[$i]->company_name;?></h2> 
                                        </div>
                                        <div class="col-md-2 listing-price"><?php echo $servicelist[$i]->title;?></div>
                                        <div class="col-md-3 listing-address"><?php echo $servicelist[$i]->address;?></div>
                                        <div class="col-md-1 listing-price">
                                          <?php 
                                            if ($servicelist[$i]->status == 0) {
                                              echo "<font color='red'>Pending</font>";
                                            }else{
                                              echo "<font color='green'>Approved</font>";
                                            }
                                          ?>
                                        </div>
                                        <div class="col-md-2 listing-action">
                                          <a href="<?php echo base_url();?>home/editservice/<?php echo $servicelist[$i]->unique_id;?>" class="btn btn-primary  btn-xs">EdIT</a> 
                                          <a href="<?php echo base_url();?>home/servicedetail_host/<?php echo $servicelist[$i]->unique_id;?>" class="btn btn-danger btn-xs">View</a>
                                          <a href="<?php echo base_url();?>home/kyc_ofservice/<?php echo $servicelist[$i]->service_details_id;?>" class="btn btn-warning btn-xs">Documents</a></div>
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