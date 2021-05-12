<section id="horizontal-form-layouts">
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title" id="horz-layout-basic">Space Details</h4>
              </div>
              <div class="card-body">
                  <div class="px-3">
                      <form class="form form-horizontal">
                        <div class="form-body">
                          <h4 class="form-section"><i class="ft-info"></i>Space Info</h4>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Host name: </label>
                              <div class="col-md-9">
                                <h5><?php echo ucfirst($space_details['my_fname'])." ".ucfirst($space_details['my_lname'])?></h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Space name: </label>
                              <div class="col-md-9">
                                <h5><?php if($space_details){ echo $space_details['title'] ;}?></h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Mobile Number: </label>
                              <div class="col-md-9">
                                <h5><?php if($space_details){ echo $space_details['mobile'] ;}?></h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Address: </label>
                              <div class="col-md-9">
                                <h5><?php if($space_details){ echo $space_details['address']." ".$space_details['city_name']." ".$space_details['state_name']." ".$space_details['cou_name'] ;}?> </h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Description: </label>
                              <div class="col-md-9">
                                <h5><?php if($space_details){ echo $space_details['description'] ;}?></h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Events Provided: </label>
                              <div class="col-md-9">
                                <h5>
                                  <?php 
                                    if($events)
                                    {
                                      $myevents="";
                                      for ($i=0; $i < count($events); $i++) 
                                      {   
                                        
                                        if($space_event)
                                        {
                                          for ($m=0; $m < count($space_event); $m++) 
                                          { 
                                            if($space_event[$m]->event_id == $events[$i]->event_id)
                                            {
                                              $myevents .= ' '.$events[$i]->event_name.','; 
                                            }
                                          }
                                        } 
                                      }
                                      $myevents = rtrim($myevents,',');
                                      echo $myevents;
                                    }
                                  ?>
                                </h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Accomodates: </label>
                              <div class="col-md-9">
                                <h5><?php if($space_details){ echo $space_details['accomodates'] ;}?></h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Days: </label>
                              <div class="col-md-9">
                                <h5>
                                  <?php 
                                    $day = '';
                                    $days = $this->space_model->get_dayname($space_details['space_id']);
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
                                <h5><?php if($space_details){ echo $space_details['from_time']." - ".$space_details['to_time'];}?></h5>
                              </div>
                          </div>
                          <?php
                            $amenities = explode(",", $space_details['amenities']);
                            $rules = explode(",", $space_details['rules']);
                          ?>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Base Price: </label>
                              <div class="col-md-9">
                                <h5><?php if($space_details){ echo "₹ ".$space_details['base_price'];}?>(<?php if($space_details){ echo $space_details['price_type'];} ?>)</h5>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Amenities: </label>
                              <div class="col-md-9">
                                <p class="span_form <?php if (!in_array(1, $amenities)) { echo 'sr-only'; } ?>"><i class="fa fa-check"></i> Air Conditioning </p>
                                <p class="span_form <?php if (!in_array(2, $amenities)) { echo 'sr-only'; } ?>" ><i class="fa fa-check"></i>  Bathrooms </p>
                                <p class="span_form <?php if (!in_array(3, $amenities)) { echo 'sr-only'; } ?>"><i class="fa fa-check"></i>  Private Entrance </p>
                                <p class="span_form <?php if (!in_array(4, $amenities)) { echo 'sr-only'; } ?>" ><i class="fa fa-check"></i>  Projector/Screen TV </p>
                                <p class="span_form <?php if (!in_array(5, $amenities)) { echo 'sr-only'; } ?>"><i class="fa fa-check"></i>  Kitchen </p>
                                <p class="span_form <?php if (!in_array(6, $amenities)) { echo 'sr-only'; } ?>" ><i class="fa fa-check"></i>  Sink </p>
                                <p class="span_form <?php if (!in_array(7, $amenities)) { echo 'sr-only'; } ?>" ><i class="fa fa-check"></i>  Stage </p>
                                <p class="span_form <?php if (!in_array(8, $amenities)) { echo 'sr-only'; } ?>" ><i class="fa fa-check"></i>  Whiteboard </p>
                                <p class="span_form <?php if (!in_array(9, $amenities)) { echo 'sr-only'; } ?>" ><i class="fa fa-check"></i>  Photography Lighting </p>
                                <p class="span_form <?php if (!in_array(10, $amenities)) { echo 'sr-only'; } ?>" ><i class="fa fa-check"></i>  Sound System </p>
                                <p class="span_form <?php if (!in_array(11, $amenities)) { echo 'sr-only'; } ?>" ><i class="fa fa-check"></i>  Wifi </p>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Rules: </label>
                              <div class="col-md-9">
                                <p class="span_form <?php if (!in_array(1, $rules)) { echo 'sr-only'; } ?>"><i class="fa fa-ban"> </i> No Smoking </p>
                                <p class="span_form <?php if (!in_array(2, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Cooking </p>
                                <p class="span_form <?php if (!in_array(3, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Ticket Sales </p>
                                <p class="span_form <?php if (!in_array(4, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Music </p>
                                <p class="span_form <?php if (!in_array(5, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Under-Age (18-21)  </p>
                                <p class="span_form <?php if (!in_array(6, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Teenagers (10-18) </p>
                                <p class="span_form <?php if (!in_array(7, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Children (0-10) </p>
                                <p class="span_form <?php if (!in_array(8, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Outside Catering/Food </p>
                                <p class="span_form <?php if (!in_array(9, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Loud Music/Dancing </p>
                                <p class="span_form <?php if (!in_array(10, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Alcohol (Serving) </p>
                                <p class="span_form <?php if (!in_array(11, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Alcohol (Selling) </p>
                                <p class="span_form <?php if (!in_array(12, $rules)) { echo 'sr-only'; } ?>" ><i class="fa fa-ban"> </i> No Late Nights Parties </p>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Images: </label>
                              <div class="col-md-9 row">
                                <?php 
                                  $images = $this->space_model->get_spaceimages($space_details['space_id']);
                                  if($images)
                                  { 
                                    ?>
                                    <?php
                                    for ($j=0; $j < count($images) ; $j++) 
                                    { 
                                      if($j > 2)
                                      {
                                        if($j%4 == 0)
                                        { ?>
                                           <div class="col-md-2 div_form">
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
                                    
                                    <img src="<?php echo base_url();?>uploads/space_image/<?php echo $images[$j]->name; ?>" width="150px;" height="150px;" class="span_form"></img>
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
                                <?php if(!empty($space_details['id_proof']) && !empty($space_details['space_proof'])) {

                                $new_file = explode(".", $space_details['id_proof']);
                                $new_file2 = explode(".", $space_details['space_proof']);
                                $extention = end($new_file);
                                $extention2 = end($new_file2);    

                              ?>
                                <div class="col-md-5 div_form" >
                                    <?php if($extention == 'pdf'){  ?>
                                      <iframe src="<?php echo base_url();?>uploads/space_documents/<?php echo $space_details['id_proof'] ?>" height="300"></iframe>
                                      <a href="<?php echo base_url();?>uploads/space_documents/<?php echo $space_details['id_proof'] ?>" target="_blank">View Documnet</a>
                                    <?php }else { ?>
                                      <img src="<?php echo base_url();?>uploads/space_documents/<?php echo $space_details['id_proof'] ?>" height="300" >
                                      <a href="<?php echo base_url();?>uploads/space_documents/<?php echo $space_details['id_proof'] ?>" target="_blank">View Document</a>
                                    <?php } ?>
                                </div> 
                                <div class="col-md-5 div_form" >
                                   <?php if($extention2 == 'pdf'){  ?>
                                      <iframe src="<?php echo base_url();?>uploads/space_documents/<?php echo $space_details['space_proof'] ?>" height="300"></iframe>
                                      <a href="<?php echo base_url();?>uploads/space_documents/<?php echo $space_details['space_proof'] ?>" target="_blank">View Document</a>
                                    <?php }else { ?>
                                      <img src="<?php echo base_url();?>uploads/space_documents/<?php echo $space_details['space_proof'] ?>" height="300" >
                                      <a href="<?php echo base_url();?>uploads/space_documents/<?php echo $space_details['space_proof'] ?>" target="_blank">View Document</a>
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