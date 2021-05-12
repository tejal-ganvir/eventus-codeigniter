<section id="horizontal">
    <div class="row">
        <div class="col-12">
          <?php 
          if($this->session->flashdata('success'))
          {
            echo '<div class="alert alert-success errormsg" style="margin-bottom:10px;">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('success').'
              </div>';
          } 
          elseif($this->session->flashdata('error'))
          {
              echo '<div class="alert alert-danger errormsg" style="margin-bottom:10px;">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('error').'
              </div>';
          }
          ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Space List Master</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <p class="card-text">This section allows you to view,activate/deactivate and delete <b style="color: red">Spaces</b></p>
                        <table class="table display nowrap table-striped table-bordered scroll-horizontal table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Space Name</th>
                                    <th>Host Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th> 
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
                                  <td><?php echo ucfirst($space_list[$i]->title)?></td>
                                  <td><?php echo ucfirst($space_list[$i]->my_fname)." ".ucfirst($space_list[$i]->my_lname)?></td>
                                  <td><?php echo $space_list[$i]->mobile?></td>
                                  <td><?php echo ucfirst($space_list[$i]->address).", ".ucfirst($space_list[$i]->city_name).", ".ucfirst($space_list[$i]->state_name).", ".ucfirst($space_list[$i]->cou_name)?></td> 
                                  <td style="width:200px;">
                                  <a class="btn btn-sm btn-success" href="<?php echo base_url();?>siteadmin/space/space_details/<?php echo $space_list[$i]->my_spc_id;?>">View</a>
                                  <?php if($space_list[$i]->status == 0) { ?>
                                  <a class="btn btn-sm btn-danger" href="<?php echo base_url();?>siteadmin/space/space_activate/<?php echo $space_list[$i]->my_spc_id;?>">&nbsp;&nbsp;Active&nbsp;&nbsp;</a>
                                  <?php } else { ?>
                                  <a class="btn btn-sm btn-warning" href="<?php echo base_url();?>siteadmin/space/space_deactiviate/<?php echo $space_list[$i]->my_spc_id;?>">&nbsp;&nbsp;Deactive&nbsp;&nbsp;</a>
                                  <?php }?>  
                                  <a class="btn btn-sm btn-primary get" style="background-color: #754579;" onclick="return confirm('Are you sure? Do you want to delete ?');" href="<?php echo base_url();?>siteadmin/space/delete_space/<?php echo $space_list[$i]->my_spc_id;?>">&nbsp;&nbsp;Delete&nbsp;&nbsp;</a></td>
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