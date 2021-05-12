<style type="text/css">
  .vendor-image img{
    width: 100%;
    height: 300px;
  }
</style>
    <div class="filter-box">
        <div class="container">
            <div class="row filter-form">
                <div class="col-md-12">
                    <h4>Add Images</h4>
                </div>
                <form id="search_form" method="post" action="<?php echo base_url();?>home/editservice_image/<?php if($uni_id){ echo $uni_id;}?>" enctype="multipart/form-data">
                    <div class="col-md-4">
                        <label class="control-label" for="venuetype">Select Images</label>
                        <input type="file" id="fileLoader" name="images[]" class="form-control" multiple value="" required="">
                        <span class="add-on"></span>
                    </div>
                    <div class="col-md-4">
                        <button  class="btn btn-default btn-block" name="save" id="save">Save</button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" onclick="window.location.replace('<?php echo base_url();?>home/editservice/<?php if($uni_id){ echo $uni_id;}?>')" class="btn btn-primary btn-block" >Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Feature Blog End -->
    <div class="section-service80 bg-light" style="padding-top: 50px;">
        <div class="container">
          <?php
            if($this->session->flashdata('message')!="" && $this->session->flashdata('message')!=null)
            {
            ?>
            <center><font color="green"><?php echo $this->session->flashdata('message');?></font></center>
            <br>
            <br>
            <?php
            } 
            if($this->session->flashdata('message1')!="" && $this->session->flashdata('message1')!=null)
            {
            ?>
            <center><font color="red"><?php echo $this->session->flashdata('message1');?></font></center>
            <br>
            <br>
            <?php
            } 
          ?>
            <div class="row ">
              <?php 
                if($service_images)
                {
                  for ($i=0; $i < count($service_images); $i++) 
                  {   
                  ?>
                <div class="col-md-3">
                    <!-- vendor box start-->
                    <div class="vendor-box">
                        <div class="vendor-image">
                            <!-- vendor pic -->
                            <a href="#"><img src="<?php echo base_url();?>uploads/service_image/<?php echo $service_images[$i]->name;?>" alt="wedding vendor" class="img-responsive"></a>
                        </div>
                        <!-- /.vendor pic -->
                        <div class="vendor-detail">
                            <!-- vendor details -->
                            <div class="caption text-center">
                                <button type="button" class="btn btn-danger"  onclick="DeleteOne('<?php echo $service_images[$i]->unique_id?>')">Delete</button>
                            </div>
                        </div>
                        <!-- vendor details -->
                    </div>
                </div>
                <?php 
                  }
                }
              ?> 
            </div>
        </div>
    </div>
<script type="text/javascript">
$("#search_form").submit(function(e) { 
   if(document.getElementById("fileLoader").value == ""){
      alert_pop('Please upload at least one image'); 
      return false;
    } 
    return true;
}); 
function alert_pop(msg){
   $.alert({
      title: 'Alert Message',
      content: msg,
      confirmButton: 'okay',
      confirmButtonClass: 'btn-warning',
      animation: 'bottom',
      icon: 'fa fa-check',
      opacity: 2,  
      backgroundDismiss: true
  });
}
function DeleteOne(id){
 $.confirm({
    title: 'Confirmation Message',
    content: 'Are you sure, you want to delete the image ?',
    confirmButton: 'Proceed',
    confirmButtonClass: 'btn-info',
    icon: 'fa fa-question-circle',
    animation: 'scale',
    animationClose: 'top',
    opacity: 1, 
    confirm: function () { 
        $.ajax({type: "POST", url: "<?php echo base_url();?>home/delete_serviceimage/<?php echo $uni_id?>/"+id,  
          success: function(result) { 
            if(result == 1) {
              $.alert({
                  title: 'Success!',
                  content: 'Service image has been deleted successfully...',
                  confirmButton: 'Okay',
                  confirmButtonClass: 'btn-warning',
                  icon: 'fa fa-info',
                  animation: 'zoom',
                  opacity: 1,                                    
                  confirm: function () {
                    window.location.href = "<?php echo base_url();?>home/editservice_image/<?php echo $uni_id?>";
                  }
              });
            } 
            else if(result == 2){
              var msg = 'Unable to delete the space image, At least one image should be present of that space.';
              alert_pop(msg);
            }
            else{
              var msg = 'Unable to deleted the space image,Please try again.';
              alert_pop(msg);
            }
          }
        });
      }
  });
}
</script>