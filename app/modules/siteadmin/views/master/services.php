<section id="basic-form-layouts">  
  <div class="row justify-content-md-center">
    <div class="col-md-8">
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
      <div class="card shadow">
        <div class="card-body">
          <div class="px-3 pt-3"><form class="form " role="form" method="POST" action="<?php echo base_url();?>siteadmin/master/services/<?php if($service_edit){ echo $service_edit['unique_id'];}?>">
              <div class="form-body ">
                <h4 class="form-section"><i class="ft-layers"></i> Services Master</h4>
                <div class="form-group">
                  <label for="eventRegInput1">Services</label>
                  <input type="text" class="form-control" name="service_name" id="service_name" value="<?php if($service_edit){ echo $service_edit['service_name'];}?>" placeholder="Enter Services"  required >
                </div>

                <div class="form-group">
                  <label for="eventRegInput2">Yearly Price</label>
                  <input type="text" class="form-control" name="amount" id="service_name" value="<?php if($service_edit){ echo $service_edit['amount'];}?>" placeholder="Enter Amount" onkeypress="return isNumber(event)" maxlength="10" required >
                </div>

                <div class="form-group">
                  <label for="eventRegInput3">Halfly Price</label>
                  <input type="text" class="form-control" name="halfly" id="service_name" value="<?php if($service_edit){ echo $service_edit['halfly'];}?>" placeholder="Enter Amount" onkeypress="return isNumber(event)" maxlength="10" required >
                </div>

              <div class="form-actions center">
                <button type="submit" name = "submit" id = "submit" class="btn btn-raised btn-primary">
                  <i class="fa fa-check-square-o"></i> <?php if($service_edit) { echo "Update"; } else { echo "Add New"; } ?>
                </button>
                <button type="button" class="btn btn-raised btn-warning mr-1" onclick="window.location.replace('<?php echo base_url();?>siteadmin/master/services')">
                  <i class="ft-x"></i> Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="headers">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Of Services</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered complex-headers table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Sr no.</th>
                                    <th>Services</th>
                                    <th>Yearly Price</th>
                                    <th>Halfly Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                              if($service_list && count($service_list) > 0)
                              { 
                                $count = 1;$count_min=0;
                                for ($i = 0; $i < count($service_list); $i++) 
                                { 
                                ?>
                                <tr class="gradeU service-cat-tr">
                                  <td><?php echo $count+$i;?></td>
                                  <td><?php echo $service_list[$i]->service_name;?></td>
                                  <td>₹ <?php echo $service_list[$i]->amount;?></td>
                                  <td>₹ <?php echo $service_list[$i]->halfly;?></td>
                                  <td class="text">
                                    <?php if($service_list[$i]->is_active == 1) { ?>
                                    <a class="btn btn-sm btn-success" href="<?php echo base_url();?>siteadmin/master/active_services/1/<?php echo $service_list[$i]->unique_id;?>">&nbsp;&nbsp;Deactive&nbsp;&nbsp;</a>
                                    <?php } else { ?>
                                    <a class="btn btn-sm btn-warning" href="<?php echo base_url();?>siteadmin/master/active_services/2/<?php echo $service_list[$i]->unique_id;?>">&nbsp;&nbsp;Active&nbsp;&nbsp;</a>
                                    <?php }?>
                                    <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>siteadmin/master/services/<?php echo $service_list[$i]->unique_id;?>">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                    <a class="btn btn-sm btn-danger delete_it" href="javascript:;" title="Delete" onclick="DeleteReasons(this,'<?php echo $service_list[$i]->unique_id ?>')">&nbsp;&nbsp;Delete&nbsp;&nbsp;</a> 
                                  </td>
                                </tr>
                              <?php } }
                                  else { ?>
                                  No Records Founds....
                              <?php } ?>                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script> 
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function DeleteReasons(ctl, id){
  swal({
        title: 'Are you sure?',
        text: "You want to delete this service!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Confirm',
        cancelButtonText: "No, cancel"
      }).then(function (isConfirm) {
          if (isConfirm) {
            var data = { "id": id };
            $.ajax({type: "POST", url: "<?php echo base_url();?>siteadmin/master/delete_service",
                data: data,
                success: function() {
                  $(ctl).parents('tr.service-cat-tr').hide('slow', function(){
                    $(this).remove();
                  });
                }
              });
              swal(
                  'Deleted!',
                  'Service is successfully deleted!!',
                  'success'
                  );
            }
    }).catch(swal.noop);
}
</script>