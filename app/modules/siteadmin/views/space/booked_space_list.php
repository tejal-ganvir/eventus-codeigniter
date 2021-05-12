<section id="headers">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Booked Space List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <p class="card-text">This section allows you to view details of <b style="color: red">Booked Space</b></p>
                        <table class="table table-striped table-bordered complex-headers table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Space Name</th>
                                    <th>Booked By</th>
                                    <th>Amount</th> 
                                    <th>Status</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                  if($space_list && count($space_list) > 0)
                                  {  
                                    for ($i = 0; $i < count($space_list); $i++) 
                                    { 
                                    ?>
                                <tr class="gradeU service-cat-tr">
                                  <td><?php echo $i+1;?></td>
                                  <td><?php echo ucfirst($space_list[$i]->company)?></td>
                                  <td><?php echo ucfirst($space_list[$i]->user_fname)." ".ucfirst($space_list[$i]->user_lname)?></td>
                                  <td><?php echo "₹ ". ucfirst($space_list[$i]->amount)?></td> 
                                  <td>
                                    <?php 
                                      if ($space_list[$i]->chk_status == 2) {
                                              echo "<span style='color:#25a032'>Completed</span>";
                                      }elseif($space_list[$i]->chk_status == 1){
                                              echo "<span style='color:#f7921e'>Confirmed</span>";
                                      }elseif($space_list[$i]->chk_status == 0){
                                              echo "<span style='color:#fa0f2d'>In Review</span>";
                                      }else{
                                              echo "<span style='color:#282923'>Canceled</span>";
                                      } ?>
                                  </td>
                                  <td style="width:200px;">
                                    <a class="btn gradient-purple-bliss white btn-block" href="<?php echo base_url();?>siteadmin/space/view_booked_space/<?php echo $space_list[$i]->uni_id."/".$space_list[$i]->space_booking_id;?>">View</a>
                                  </td>
                                </tr>
                                  <?php 
                                    } } 
                                    else { ?>
                                    Sorry, no records found
                                  <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Scroll - horizontal table -->