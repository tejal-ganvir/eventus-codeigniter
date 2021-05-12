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
          <div class="px-3 pt-3">
            <form class="form " role="form" method="POST" action="<?php echo base_url();?>siteadmin/master/events/<?php if($event_edit){ echo $event_edit['unique_id'];}?>">
              <div class="form-body ">
                <h4 class="form-section"><i class="ft-layers"></i> Event Master</h4>
                <div class="form-group">
                  <label for="eventRegInput1">Event</label>
                  <input type="text" class="form-control"  name="event_name" id="event_name" value="<?php if($event_edit){ echo $event_edit['event_name'];}?>" placeholder="Enter Event Name" required >
                </div>

              <div class="form-actions center">
                <button type="submit" name = "submit" id = "submit" class="btn btn-raised btn-primary">
                  <i class="fa fa-check-square-o"></i> <?php if($event_edit) { echo "Update"; } else { echo "Add New"; } ?>
                </button>
                <button type="button" class="btn btn-raised btn-warning mr-1" onclick="window.location.replace('<?php echo base_url();?>siteadmin/master/events')">
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
                    <h4 class="card-title">List Of Event</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered complex-headers table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Sr no.</th>
                                    <th>Events</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                              if($event_list && count($event_list) > 0)
                              { 
                                $count = 1;$count_min=0;
                                for ($i = 0; $i < count($event_list); $i++) 
                                { 
                                ?>
                                <tr class="gradeU service-cat-tr">
                                  <td><?php echo $count+$i;?></td>
                                  <td><?php echo $event_list[$i]->event_name;?></td>
                                  <td class="text">
                                    <?php if($event_list[$i]->is_active == 1) { ?>
                                    <a class="btn btn-sm btn-success" href="<?php echo base_url();?>siteadmin/master/active_event/1/<?php echo $event_list[$i]->unique_id;?>">&nbsp;&nbsp;Deactive&nbsp;&nbsp;</a>
                                    <?php } else { ?>
                                    <a class="btn btn-sm btn-warning" href="<?php echo base_url();?>siteadmin/master/active_event/2/<?php echo $event_list[$i]->unique_id;?>">&nbsp;&nbsp;Active&nbsp;&nbsp;</a>
                                    <?php }?>
                                    <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>siteadmin/master/events/<?php echo $event_list[$i]->unique_id;?>">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                    <a class="btn btn-sm btn-danger delete_it" href="javascript:;" title="Delete" onclick="DeleteReasons(this,'<?php echo $event_list[$i]->unique_id ?>')">&nbsp;&nbsp;Delete&nbsp;&nbsp;</a> 
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
function DeleteReasons(ctl, id){
  swal({
        title: 'Are you sure?',
        text: "You want to delete this event!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0CC27E',
        cancelButtonColor: '#FF586B',
        confirmButtonText: 'Confirm',
        cancelButtonText: "No, cancel"
      }).then(function (isConfirm) {
          if (isConfirm) {
            var data = { "id": id };
            $.ajax({type: "POST", url: "<?php echo base_url();?>siteadmin/master/delete_event",
                data: data,
                success: function() {
                  $(ctl).parents('tr.service-cat-tr').hide('slow', function(){
                    $(this).remove();
                  });
                }
              });
              swal(
                  'Deleted!',
                  'Event is successfully deleted!!',
                  'success'
                  );
            }
    }).catch(swal.noop);
}
</script>