<section id="headers">
    <div class="row">
        <div class="col-12">
          <?php 
          if($this->session->flashdata('success'))
          {
            echo '<div class="alert alert-success errormsg" style="margin-bottom:10px;"> <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata ('success').'</div>';
          } 
          elseif($this->session->flashdata('error'))
          {
            echo '<div class="alert alert-danger errormsg" style="margin-bottom:10px;"> <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata ('error').'</div>';
          }
          ?>  
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Of Testimonials</h4>
                    <p class="mb-0">This Section allows you to edit/delete <b style="color: red;">Testimonials</b> .</p>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered no-wrap complex-headers table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>                                       
                                    <th>Testimonial Name</th>
                                    <th>Providers Post</th> 
                                    <th>Description</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                                    if($test_details && count($test_details) > 0)
                                    {
                                      
                                      $type = null; 
                                      $count = 1;$count_min=0;
                                      for ($i = 0; $i < count($test_details); $i++) 
                                      { 
                                      $date_created=$test_details[$i]->created_date;
                                      $newDate_created = date("d-m-Y", strtotime($date_created));
                                      $date_updated=$test_details[$i]->updated_date;
                                      $newDate_updated = date("d-m-Y", strtotime($date_updated));
                                      ?> 
                                  <tr class="gradeU service-cat-tr">
                                  <td><?php echo $count+$i;?></td>
                                  <td><?php echo $test_details[$i]->testimonial_name?></td>
                                  <td><?php echo $test_details[$i]->testimonial_tittle?></td>
                                  <td><?php echo $test_details[$i]->testimonial_description ?></td>
                                  <td><?php echo $newDate_created?></td>
                                  <td><?php echo $newDate_updated?></td>
                                  <td class="text">
                                    <?php  if($test_details[$i]->is_publised == 0) { ?>
                                      <a class="btn btn-sm btn-info" href="<?php  echo base_url();?>siteadmin/master/testimonial_active/<?php echo $test_details[$i]->unique_id;?>">&nbsp;&nbsp;Active&nbsp;&nbsp;</a>
                                              <?php }else {?>
                                      <a class="btn btn-sm btn-warning" href="<?php  echo base_url();?>siteadmin/master/testimonial_deactive/<?php echo $test_details[$i]->unique_id;?>">&nbsp;&nbsp;Deactive&nbsp;&nbsp;</a>                          
                                      <?php }?>
                                     <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>siteadmin/master/add_testimonial/<?php echo $test_details[$i]->unique_id;?>">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                      <a class="btn btn-sm btn-danger get" href="<?php echo base_url();?>siteadmin/master/delete_testimonial/<?php echo $test_details[$i]->unique_id;?>">&nbsp;&nbsp;Delete&nbsp;&nbsp;</a>
                                  </td>
                              </tr>
                              <?php } }
                              else { ?>
                              No Records Founds
                              <?php } ?>                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>