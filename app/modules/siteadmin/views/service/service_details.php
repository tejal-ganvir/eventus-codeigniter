<section id="horizontal-form-layouts">
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title" id="horz-layout-basic">Service Details</h4>
              </div>
              <div class="card-body">
                  <div class="px-3">
                      <form class="form form-horizontal">
                        <div class="form-body">
                          <h4 class="form-section"><i class="ft-info"></i>Service Info</h4>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Host name: </label>
                              <div class="col-md-9">
                                <h5><?php if($service_details){ echo $service_details['fname']." ".$service_details['lname'];}?></h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Company name: </label>
                              <div class="col-md-9">
                                <h5><?php if($service_details){ echo $service_details['company'];}?></h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Service name: </label>
                              <div class="col-md-9">
                                <h5><?php if($service_details){ echo $service_details['services'] ;}?> </h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Mobile Number: </label>
                              <div class="col-md-9">
                                <h5><?php if($service_details){ echo $service_details['mobileno'] ;}?> </h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Address: </label>
                              <div class="col-md-9">
                                <h5><?php if($service_details){ echo $service_details['address']  ;}?></h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Days: </label>
                              <div class="col-md-9">
                                <h5>
                                  <?php 
                                    $day = '';
                                    $days = $this->service_model->get_dayname($service_details['service_details_id']);
                                    for ($j=0; $j < count($days); $j++) 
                                    { 
                                        $day .= $days[$j]->day.','; 
                                    }
                                    $day = rtrim($day,',');
                                    echo $day;
                                  ?>
                                </h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Timing: </label>
                              <div class="col-md-9">
                                <h5><?php if($service_details){ echo $service_details['from_time']." - ".$service_details['to_time'];}?></h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Min Hours: </label>
                              <div class="col-md-9">
                                <h5><?php if($service_details){ echo $service_details['min_hrs'];}?>&nbsp;hrs</h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Packages: </label>
                              <div class="col-md-9">
                                <table class="table table-bordered table-responsive-sm">
                                  <tr>
                                    <th >Name</th>
                                    <th >Provides</th>
                                    <th >Price</th>
                                  </tr>
                                  <?php 
                                  if($service_package)
                                  { 
                                    for ($l=0; $l < count($service_package); $l++) 
                                    { 
                                        
                                        ?>
                                        <tr>
                                        <td >
                                          <?php echo $service_package[$l]->package_name; ?>
                                        </td>
                                        <td >
                                          <?php echo $service_package[$l]->package_description; ?>
                                        </td>
                                        <td>
                                          <?php echo "₹ ".$service_package[$l]->package_price." /-"; ?>
                                        </td>
                                      </tr>
                                        <?php
                                    }
                                  }
                                ?>
                              </table>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Images: </label>
                              <div class="col-md-9 row">
                                <?php
                                $images = $this->service_model->get_spaceimages($service_details['service_details_id']);
                                  if($images)
                                  { 
                                    for ($j=0; $j < count($images) ; $j++) 
                                    { 
                                      if($j > 2)
                                      {
                                        if($j%4 == 0)
                                        { ?>
                                           <div class="col-md-2 div_form" style = "margin-left:297px;">
                                        <?php
                                        } 
                                        else
                                        {
                                          ?>
                                          <div class="col-md-2 div_form">
                                        <?php 
                                        }
                                      }
                                      else
                                      { ?>
                                        <div class="col-md-2 div_form">
                                      <?php
                                      }
                                      
                                    ?>
                                    
                                    <img src="<?php echo base_url();?>uploads/service_image/<?php echo $images[$j]->name; ?>" width="150px;" height="150px;" class="span_form"></img>
                                    </div> 
                                    <?php
                                    } 
                                  }
                                ?>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">KYC Documents: </label>
                              <div class="col-md-9 row">
                                <?php if(!empty($service_details['id_proof']) && !empty($service_details['service_proof'])) {

                                    $new_file = explode(".", $service_details['id_proof']);
                                    $new_file2 = explode(".", $service_details['service_proof']);
                                    $extention = end($new_file);
                                    $extention2 = end($new_file2);    

                                  ?>
                                <div class="col-md-5 div_form" >
                                    <?php if($extention == 'pdf'){  ?>
                                      <iframe src="<?php echo base_url();?>uploads/service_documents/<?php echo $service_details['id_proof'] ?>" height="300"></iframe>
                                      <a href="<?php echo base_url();?>uploads/service_documents/<?php echo $service_details['id_proof'] ?>" target="_blank">View Documnet</a>
                                    <?php }else { ?>
                                      <img src="<?php echo base_url();?>uploads/service_documents/<?php echo $service_details['id_proof'] ?>" height="300" >
                                      <a href="<?php echo base_url();?>uploads/service_documents/<?php echo $service_details['id_proof'] ?>" target="_blank">View Document</a>
                                    <?php } ?>
                                </div> 
                                <div class="col-md-5 div_form" >
                                   <?php if($extention2 == 'pdf'){  ?>
                                    <iframe src="<?php echo base_url();?>uploads/service_documents/<?php echo $service_details['service_proof'] ?>" height="300"></iframe>
                                    <a href="<?php echo base_url();?>uploads/service_documents/<?php echo $service_details['service_proof'] ?>" target="_blank">View Document</a>
                                  <?php }else { ?>
                                    <img src="<?php echo base_url();?>uploads/service_documents/<?php echo $service_details['service_proof'] ?>" height="300" >
                                    <a href="<?php echo base_url();?>uploads/service_documents/<?php echo $service_details['service_proof'] ?>" target="_blank">View Document</a>
                                  <?php } ?>
                                </div>
                              <?php }else{ ?>
                                 <h5>Documents are yet to be uploaded</h5>
                               <?php } ?>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
<!-- Modal -->
<div class="modal fade text-left" id="default" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <img id="galimg">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
</section>
<script type="text/javascript">
  $(".span_form").on('click',function(){
    var src = $(this).attr('src');
    $('#galimg').attr('src',src);
    $('#default').modal('show');
  });
</script>