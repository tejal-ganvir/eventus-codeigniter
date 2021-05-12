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
                    <h4 class="card-title">Service List Master</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <p class="card-text">This section allows you to view,activate/deactivate and delete <b style="color: red">Services</b></p>
                        <table class="table display nowrap table-striped table-bordered scroll-horizontal table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Service Name</th>
                                    <th>Host Name</th>
                                    <th>Company Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php  
                                if($service_list && count($service_list) > 0)
                                { 
                                  for ($i = 0; $i < count($service_list); $i++) 
                                  { 
                                  ?>
                                  <tr class="gradeU service-cat-tr">
                                    <td><?php echo $i+1;?></td>
                                    <td><?php echo ucfirst($service_list[$i]->services)?></td>
                                    <td><?php echo ucfirst($service_list[$i]->fname)." ".ucfirst($service_list[$i]->lname)?></td>
                                    <td><?php echo ucfirst($service_list[$i]->my_company)?></td>
                                    <td><?php echo $service_list[$i]->mobileno?></td>
                                    <td><?php echo ucfirst($service_list[$i]->address)?></td> 
                                    <td style="width:200px;">
                                    <a class="btn btn-sm btn-success" href="<?php echo base_url();?>siteadmin/service/service_details/<?php echo $service_list[$i]->my_serv_id;?>">View</a>
                                    <?php if($service_list[$i]->status == 0) { ?>
                                    <a class="btn btn-sm btn-danger" href="<?php echo base_url();?>siteadmin/service/service_activate/<?php echo $service_list[$i]->my_serv_id;?>">&nbsp;&nbsp;Active&nbsp;&nbsp;</a>
                                    <?php } else { ?>
                                    <a class="btn btn-sm btn-warning" href="<?php echo base_url();?>siteadmin/service/service_deactiviate/<?php echo $service_list[$i]->my_serv_id;?>">&nbsp;&nbsp;Deactive&nbsp;&nbsp;</a>
                                    <?php }?>  
                                    <a class="btn btn-sm btn-primary get" style="background-color: #754579;" onclick="return confirm('Are you sure? Do you want to delete ?');" href="<?php echo base_url();?>siteadmin/service/delete_service/<?php echo $service_list[$i]->my_serv_id;?>">&nbsp;&nbsp;Delete&nbsp;&nbsp;</a></td>
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