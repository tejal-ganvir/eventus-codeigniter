<section id="basic-form-layouts">
  <div class="row">
        <div class="col-sm-12">
            <div class="content-header">Add City</div>
        </div>
    </div>
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title" id="bordered-layout-basic-form">Add A City</h4> 
                  <p class="mb-0">This section allows you to add/edit/delete  <b style="color: red;">City</b> .</p>
              </div>
              <div class="row justify-content-md-center">
    <div class="col-md-6">
      <div class="card">
        
        <div class="card-body">
          <div class="px-3">
            <form class="form" id="myform" method="post" action="<?php echo base_url();?>siteadmin/timeslot/addd_city<?php if(isset($mylocation)) { echo "/".$mylocation['location_id'];}?>">

              <div class="form-body jumbotron shadow" style="padding: 10px;">
                <div class="form-group">
                  <label for="eventRegInput1">Select State</label>
                  <select id="state" name="state" class="form-control">
                    <?php
                      if($state){
                        for($j=0 ; $j < count($state); $j++)
                        {
                        ?>
                    <option value="<?php echo $state[$j]->location_id ?>"><?php echo $state[$j]->location_name ?></option>
                  <?php } 
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="eventRegInput1">City Name</label>
                  <input type="text" class="form-control"  name="location_name" value="<?php if(isset($mylocation)) { echo $mylocation['location_name'];}?>" id="location_name">
                </div>

              <div class="form-actions center">
                <button type="submit" class="btn btn-raised btn-primary" name="commit" id="submit">
                  <i class="fa fa-check-square-o"></i> <?php if(isset($mylocation)) { echo "Update City"; }else{ echo "Add City"; } ?>
                </button>
                <button type="button" class="btn btn-raised btn-warning mr-1" onclick="window.location.replace('<?php echo base_url();?>siteadmin/timeslot/add_city')">
                  <i class="ft-x"></i> Cancel
                </button>
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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
                    <h4 class="card-title">List Of Cities</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered complex-headers">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Country Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if($location){
                                  for($i=0 ; $i < count($location); $i++)
                                  {

                              ?>
                                <tr id="row<?php echo $location[$i]->location_id?>">
                                    <td><?php echo $i+1?></td>
                                    <td><?php echo $location[$i]->location_name?></td>
                                    <td>
                                      <a class="info p-0" href="<?php echo base_url();?>siteadmin/timeslot/add_city/<?php echo $location[$i]->location_id?>" data-id="">
                                          <i class="ft-edit-2 font-medium-3 mr-2"></i>
                                        </a>
                                        <a class="danger p-0" data-id="<?php echo $location[$i]->location_id?>">
                                          <i class="ft-trash-2 font-medium-3 mr-2"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php  
                                  }
                                }?>
                                
                                                                    
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Country Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
  $("#submit").on('click',function(){
    if($('#location_name').val() == ''){
      $('#location_name').css('border', 'solid 1px red');
      return false;
    }
  });
  $(".danger").on('click',function(){
        var id = $(this).attr('data-id');
        swal({
                    title: 'Are you sure?',
                    text: "You want to delete this location!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0CC27E',
                    cancelButtonColor: '#FF586B',
                    confirmButtonText: 'Confirm',
                    cancelButtonText: "No, cancel"
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({type: "POST", url: "<?php echo base_url();?>siteadmin/timeslot/delete_location", data: { id:id},
                              success: function(result) {
                                result = parseInt(result);
                                if(result > 0) {
                                  $("#row"+result).hide('2000');
                                }
                              }

                             });
                        swal(
                            'Deleted!',
                            'Location is successfully deleted!!',
                            'success'
                        );
                    }
                }).catch(swal.noop);
      });
</script>