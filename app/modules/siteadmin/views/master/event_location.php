<?php $this->load->view('backend/leftsidebar'); ?>   
<div class="page-content-wrapper">
  <div class="page-content">
    <div id="wrapper">
      <div id="page-wrapper">
        <div class="row">
          <div class="col-xs-10 ">
            <h3 class="page-title">EVENT PLACE MASTER</h3>
          </div>
        </div>
        <div class="page-bar">
          <ul class="page-breadcrumb">
            <li>
              <i class="fa fa-home"></i>
              <a href="<?php echo base_url();?>siteadmin/changepassword">Home</a>
              <i class="fa fa-angle-right"></i>
            </li> 
            <li>
              <a href="#">Masters</a>
              <i class="fa fa-angle-right"></i>
            </li>
            <li>
              <a href="#">Event Place Master</a>
            </li>
          </ul>
        </div>
      </div>
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
      <div class="row">
        <div class="col-lg-12">
          <div class="portlet box green">
            <div class="portlet-title">
              <div class="caption">
                <i class="fa fa-gift"></i>
                <span class="caption-subject font-white-hoki bold uppercase">Event Place Master</span>
                <span class="caption-helper">Enter Event Place...</span>
              </div>
              <div class="tools">
                <a href="" class="collapse"></a> 
                <a href="" class="remove"></a>
              </div>
            </div>
            <div class="portlet-body form">
              <div class="row">
                <form method="POST" action="<?php echo base_url();?>siteadmin/master/event_location/<?php if($event_location_edit){ echo $event_location_edit['unique_id'];}?>" class="form-horizontal">
                  <div class="form-body">
                    <div class="form-group"> 
                      <label class="col-md-3 control-label">Event location</label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="location_name" id="location_name" value="<?php if($event_location_edit){ echo $event_location_edit['location_name'];}?>" placeholder="Enter event location" required>
                        <span class="help-block"></span>
                      </div>
                      <div class="col-md-5">
                        <button type="submit" name = "submit" id = "submit" class="btn btn-primary blue"><?php if($event_location_edit) { echo "Update"; } else { echo "Add New"; } ?></button>
                        <a href="<?php echo base_url();?>siteadmin/master/event_location" class="btn btn-primary default">Cancel</a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <!-- BEGIN EXAMPLE TABLE PORTLET-->
              <div class="portlet box green">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-edit"></i>Event Place List
                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse"></a> 
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                  </div>
                </div>
                <div class="portlet-body">
                  <div class="table-toolbar"></div>
                  <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                    <thead>
                      <tr>
                        <th>Sr no.</th>
                        <th>Event Location</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                    <?php  
                    if($event_location_list && count($event_location_list) > 0)
                    { 
                      $count = 1;$count_min=0;
                      for ($i = 0; $i < count($event_location_list); $i++) 
                      { 
                      ?>
                      <tr class="gradeU service-cat-tr">
                        <td><?php echo $count+$i;?></td>
                        <td><?php echo $event_location_list[$i]->location_name;?></td>
                        <td class="text">
                          <?php if($event_location_list[$i]->is_active == 1) { ?>
                          <a class="btn btn-xs btn-success" href="<?php echo base_url();?>siteadmin/master/active_eventlocation/1/<?php echo $event_location_list[$i]->unique_id;?>">&nbsp;&nbsp;Deactive&nbsp;&nbsp;</a>
                          <?php } else { ?>
                          <a class="btn btn-xs btn-warning" href="<?php echo base_url();?>siteadmin/master/active_eventlocation/2/<?php echo $event_location_list[$i]->unique_id;?>">&nbsp;&nbsp;Active&nbsp;&nbsp;</a>
                          <?php }?>
                          <a class="btn btn-xs btn-primary" href="<?php echo base_url();?>siteadmin/master/event_location/<?php echo $event_location_list[$i]->unique_id;?>">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                          <a class="btn btn-xs btn-danger delete_it" href="javascript:;" title="Delete" onclick="DeleteReasons(this,'<?php echo $event_location_list[$i]->unique_id ?>')">&nbsp;&nbsp;Delete&nbsp;&nbsp;</a> 
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
      </div>
    </div>
  </div>
</div>
<script> 
function DeleteReasons(ctl, id){
  if(confirm("Are you sure you want to delete this?")) {
    var data = { "id": id };
    $.ajax({type: "POST", url: "<?php echo base_url();?>siteadmin/master/delete_eventlocation",
      data: data,
      success: function() {
        $(ctl).parents('tr.service-cat-tr').hide('slow', function(){
          $(this).remove();
        });
      }
    });
  }
}
</script>
