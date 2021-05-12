<?php $this->load->view('backend/leftsidebar'); ?>  
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="page-content-wrapper">
    <div class="page-content">
       <div id="wrapper">
        <div id="page-wrapper">
          <div class="row">
            <div class="col-xs-10 ">
              <h3 class="page-title">LOCATION MASTER</h3>
            </div></div>
            <div class="page-bar">
              <ul class="page-breadcrumb">
                <li>
                  <i class="fa fa-home"></i>
                  <a href="<?php echo base_url();?>siteadmin/dashboard/dashboard">Home</a>
                  <i class="fa fa-angle-right"></i>
                </li>
                <li>
                  <a href="#">CMS</a>
                  <i class="fa fa-angle-right"></i>
                </li>
                <li>
                  <a href="#">Masters</a>
                  <i class="fa fa-angle-right"></i>
                </li>
                <li>
                  <a href="#">Location Master</a>
                </li>
              </ul>
              </div>
            </div>
            <?php 
          if($this->session->flashdata('success'))
        {
          echo '<div class="alert alert-success errormsg" style="margin-bottom:10px;">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata

('success').'
            </div>';
        } 
        elseif($this->session->flashdata('error'))
        {
            echo '<div class="alert alert-danger errormsg" style="margin-bottom:10px;">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata

('error').'
            </div>';
        }
        ?>  
        <div class="row">
      <div class="col-lg-14">
      <div class="tabbable-line boxless tabbable-reversed">
            <ul class="nav nav-tabs">
              <li class="<?php echo $tb_country_tab?>"><a data-toggle="tab" href="#tb_country">COUNTRY</a></li>
              <li class="<?php echo $tb_states_tab?>"><a data-toggle="tab" href="#tb_states">STATES</a></li>
              <li class="<?php echo $tb_cities_tab?>"><a data-toggle="tab" href="#tb_cities">CITIES</a></li>
            </ul>
          </div>    
                    <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-equalizer font-blue-hoki"></i>
                      <span class="caption-subject font-blue-hoki bold uppercase">Location Management</span>
                      <span class="caption-helper">Enter Locations...</span>
                    </div>
                    <div class="tools">
                      <a href="" class="collapse">
                      </a>
                      <!-- <a href="#portlet-config" data-toggle="modal" class="config">
                      </a> -->
                     <!--  <a href="" class="reload">
                      </a> -->
                      <a href="" class="remove">
                      </a>
                    </div>
                  </div>
                  <div class="portlet-body form">
            <div class="tab-content">
              <div id="tb_country" class="tab-pane <?php echo $tb_country_tab?>">
                <form class="form-horizantal" method="post" action="<?php echo base_url();?>siteadmin/timeslot/locations/0/0<?php if($country_detail) { echo "/".$country_detail['unique_id'];}?>">
                  <div class="form-group">
                    <div class="col-lg-3">
                      <input required type="text" name="location_name" placeholder="Enter Country" class="form-control" value="<?php if(strlen($tb_country_tab) > 0 && $country_detail) { echo $country_detail['location_name'];}?>"/>
                    </div>
                    <div class="col-lg-2">
                      <button class="btn btn-sm btn-primary" name="submit" type="submit">
                        <?php if(strlen($tb_country_tab) > 0 && $country_detail) { echo "Update"; } else { echo "Add New"; } ?>
                      </button>
                      <?php
                      if(strlen($tb_country_tab) > 0 && $country_detail) 
                      {
                        ?>
                        &nbsp;<a class="btn btn-sm btn-default" href="<?php echo base_url();?>siteadmin/timeslot/locations/0/">Cancel</a>
                        <?php
                      }
                      ?>
                    </div>
                  </div>
                </form>
                <div class="clearfix"></div><br>
                <table class="table table-bordered">
                  <thead>
                    <th style="width:60px;">SR NO</th>
                    <th>COUNTRY NAME</th>
                    <th style="width:140px;" class="text-center">ACTION</th>
                  </thead>
                  <tbody>
                    <?php
                    if($country_list && count($country_list) > 0)
                    {
                      $count_min = 0;
                      $page_sr_country = intval($page_sr_country);
                      for ($i = 0; $i < count($country_list); $i++) 
                      { 
                        ?>
                        <tr class="gradeU service-cat-tr">
                          <td><?php echo $page_sr_country;?></td>
                          <td><div class="edit-column"><input type="text" value="<?php echo $country_list[$i]->location_name ?>" style="display:none" onblur="UpdateValue(this,'<?php echo $country_list[$i]->unique_id ?>');" />
                          <span class="goto-edit" id="min<?php echo $count_min?>"><?php echo $country_list[$i]->location_name ?></span></div></td>
                          <td class="text">
                           <a class="btn btn-xs btn-primary" href="<?php echo base_url();?>siteadmin/timeslot/locations/0/0/<?php echo $country_list[$i]->unique_id;?>">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                           <a class="btn btn-xs btn-warning delete" href="javascript:;" title="Delete" onclick="DeleteLocation(this,'<?php echo $country_list[$i]->unique_id ?>')">&nbsp;&nbsp;Delete&nbsp;&nbsp;</a>
                          </td>
                        </tr>
                        <?php
                        $page_sr_country = $page_sr_country + 1;
                      }
                    }
                    else
                    {
                      ?>
                      <tr><td colspan="3">No records found...</td></tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
                <div class="dataTables_paginate paging_bootstrap pagination"><ul class="pagination"><?php echo $links_country;?></ul></div>
                <div class="clearfix"></div>
              </div>
              
              <div id="tb_states" class="tab-pane <?php echo $tb_states_tab?>">
                <form class="form-horizantal" method="post" action="<?php echo base_url();?>siteadmin/timeslot/locations/1/0<?php if($state_detail) { echo "/".$state_detail['unique_id'];}?>">
                  <div class="form-group">
                    <div class="col-lg-3">
                      <select class="form-control" name="country_name" required>
                        <?php
                        $result = $this->db->query("SELECT location_id, location_name FROM locations WHERE parent_id = 0 ORDER BY location_name");
                        $country_result = $result->result();
                        for ($i = 0; $i < count($country_result); $i++) 
                        { 
                          ?>
                          <option value="<?php echo $country_result[$i]->location_id?>"
                            <?php if(strlen($tb_states_tab) > 0 && $state_detail) { if($country_result[$i]->location_id == $state_detail['parent_id']) { echo "selected"; } }?>
                            ><?php echo $country_result[$i]->location_name?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <input type="text" required name="location_name" placeholder="State Name" class="form-control" value="<?php if(strlen($tb_states_tab) > 0 && $state_detail) { echo $state_detail['location_name'];}?>" />
                    </div>
                    <div class="col-lg-2">
                      <button class="btn btn-sm btn-primary" name="submit" type="submit">
                        <?php if(strlen($tb_states_tab) > 0 && $state_list) { echo "Update"; } else { echo "Add New"; } ?>
                      </button>
                      <?php
                      if(strlen($tb_states_tab) > 0 && $state_list) 
                      {
                        ?>
                        &nbsp;<a class="btn btn-sm btn-default" href="<?php echo base_url();?>siteadmin/timeslot/locations/1/">Cancel</a>
                        <?php
                      }
                      ?>
                    </div>
                  </div>
                </form>
                <div class="clearfix"></div><br>
                <table class="table table-bordered" style="font-size:11px;">
                  <thead>
                    <th style="width:60px;">SR NO</th>
                    <th>COUNTRY</th>
                    <th>STATE</th>
                    <th style="width:140px;" class="text-center">ACTION</th>
                  </thead>
                  <tbody>
                    <?php
                    if($state_list && count($state_list) > 0)
                    {
                      $page_sr_state = intval($page_sr_state);
                      for ($i=0; $i < count($state_list); $i++) 
                      { 
                        ?>
                        <tr class="gradeU service-cat-tr">
                          <td><?php echo $page_sr_state;?></td>
                          <td><?php echo $state_list[$i]->country_name;?></td>
                          <td><div class="edit-column"><input type="text" value="<?php echo $state_list[$i]->location_name ?>" style="display:none" onblur="UpdateValue(this,'<?php echo $state_list[$i]->unique_id ?>');" />
                          <span class="goto-edit" id="min<?php echo $count_min?>"><?php echo $state_list[$i]->location_name ?></span></div></td>
                          <td class="text">
                           <a class="btn btn-xs btn-primary" href="<?php echo base_url();?>siteadmin/timeslot/locations/1/0/<?php echo $state_list[$i]->unique_id;?>">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                           <a class="btn btn-xs btn-warning delete" href="javascript:;" title="Delete" onclick="DeleteLocation(this,'<?php echo $state_list[$i]->unique_id ?>')">&nbsp;&nbsp;Delete&nbsp;&nbsp;</a>
                          </td>
                        </tr>
                        <?php
                        $page_sr_state = $page_sr_state + 1;
                      }
                    }
                    else
                    {
                      ?>
                      <tr><td colspan="4">No records found...</td></tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
                <div class="dataTables_paginate paging_bootstrap pagination"><ul><?php echo $links_state; ?></ul></div>
                <div class="clearfix"></div>
              </div>
               <div id="tb_cities" class="tab-pane <?php echo $tb_cities_tab?>">
                <form class="form-horizantal" method="post" action="<?php echo base_url();?>siteadmin/timeslot/locations/2/0<?php if($city_detail) { echo "/".$city_detail['unique_id'];}?>">
                  <div class="form-group">
                    <div class="col-lg-3">
                      <select class="form-control" name="state_name" required>
                        <?php
                        $result = $this->db->query("SELECT location_id, location_name FROM locations WHERE location_type = 2 ORDER BY location_name");
                        $state_result = $result->result();
                        for ($i = 0; $i < count($state_result); $i++) 
                        { 
                          ?>
                          <option value="<?php echo $state_result[$i]->location_id?>"
                            <?php if(strlen($tb_cities_tab) > 0 && $city_detail) { if($state_result[$i]->location_id == $city_detail['parent_id']) { echo "selected"; } }?>
                            ><?php echo $state_result[$i]->location_name?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <input type="text" required name="location_name" placeholder="City Name" class="form-control" value="<?php if(strlen($tb_cities_tab) > 0 && $city_detail) { echo $city_detail['location_name'];}?>" />
                    </div>
                    <div class="col-lg-2">
                      <button class="btn btn-sm btn-primary" name="submit" type="submit">
                        <?php if(strlen($tb_cities_tab) > 0 && $city_detail) { echo "Update"; } else { echo "Add New"; } ?>
                      </button>
                      <?php
                      if(strlen($tb_cities_tab) > 0 && $city_detail) 
                      {
                        ?>
                        &nbsp;<a class="btn btn-sm btn-default" href="<?php echo base_url();?>siteadmin/timeslot/locations/1/">Cancel</a>
                        <?php
                      }
                      ?>
                    </div>
                  </div>
                </form>
                <div class="clearfix"></div><br>
                <table class="table table-bordered" style="font-size:11px;">
                  <thead>
                    <th style="width:60px;">SR NO</th>
                    <th>STATE</th>
                    <th>CITY</th>
                    <th style="width:140px;" class="text-center">ACTION</th>
                  </thead>
                  <tbody>
                    <?php
                    if($city_list && count($city_list) > 0)
                    {
                      $page_sr_city = intval($page_sr_city);
                      for ($i=0; $i < count($city_list); $i++) 
                      { 
                        ?>
                        <tr class="gradeU service-cat-tr">
                          <td><?php echo $page_sr_city;?></td>
                          <td><?php echo $city_list[$i]->state_name;?></td>
                          <td><div class="edit-column"><input type="text" value="<?php echo $city_list[$i]->location_name ?>" style="display:none" onblur="UpdateValue(this,'<?php echo $city_list[$i]->unique_id ?>');" />
                          <span class="goto-edit" id="min<?php echo $count_min?>"><?php echo $city_list[$i]->location_name ?></span></div></td>
                          <td class="text">
                           <a class="btn btn-xs btn-primary" href="<?php echo base_url();?>siteadmin/timeslot/locations/2/0/<?php echo $city_list[$i]->unique_id;?>">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                           <a class="btn btn-xs btn-warning delete" href="javascript:;" title="Delete" onclick="DeleteLocation(this,'<?php echo $city_list[$i]->unique_id ?>')">&nbsp;&nbsp;Delete&nbsp;&nbsp;</a>
                          </td>
                        </tr>
                        <?php
                        $page_sr_city = $page_sr_city + 1;
                      }
                    }
                    else
                    {
                      ?>
                      <tr><td colspan="4">No records found...</td></tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
                <div class="dataTables_paginate paging_bootstrap pagination"><ul><?php echo $links_city; ?></ul></div>
                <div class="clearfix"></div>
              </div>

              
                

            </div>
          </div>
        </div>
      </div>
    

    
  </div>

<script>
var old_value = 0;
$('.NotAllowed').keydown(function() { return false; });
$('div.edit-column span.goto-edit').on('click', function() {
  $('div.edit-column input[type="text"]').hide();
  $('div.edit-column span.goto-edit').show();
  $(this).parents('div.edit-column').find('input[type="text"]').show();
  $(this).parents('div.edit-column').find('input[type="text"]').focus();
  old_value = $(this).parents('div.edit-column').find('input[type="text"]').val();
  $(this).hide();
})
function UpdateValue(ctl, id){
  var new_value = $(ctl).val();
  if(old_value != new_value) {
   $.ajax({
      type: "POST", dataType: "text",
      url: "<?php echo base_url();?>siteadmin/timeslot/update_data",
      data: {new_value : new_value, id : id},
      success: function(result)
      {
    $(ctl).parents('div.edit-column').find('span.goto-edit').html(new_value);
        RefreshCart();
      } 
  });
  $(ctl).parents('div.edit-column').find('input[type="text"]').hide();
  $(ctl).parents('div.edit-column').find('span.goto-edit').show();
  }
}
function DeleteLocation(ctl, id){
  if(confirm("Are you sure you want to delete this?")) {
    //var data = { "id": id };
    $.ajax({type: "POST", url: "<?php echo base_url();?>siteadmin/timeslot/delete_location",data: { id: id },
      success: function(result) {
        if (result > 0) {
        $(ctl).parents('tr.service-cat-tr').hide('slow', function(){
          $(this).remove();

            });
        }
      }
    });
  }
}
</script>

   