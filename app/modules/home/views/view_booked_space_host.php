

    <div class="tp-page-head">
        <!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="page-header">
                        <h1 style="font-size: 52px;font-weight: bolder;"><?php echo $booked_space['title']; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <!-- content left -->
                    <div class="row">
                      <?php 
                        if($this->session->flashdata('success'))
                          {
                            echo '<div class="alert alert-success errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('success').'</div>';
                          } 
                        elseif($this->session->flashdata('error'))
                          {
                            echo '<div class="alert alert-danger errormsg" style=""><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> x </button>'.$this->session->flashdata('error').'</div>';
                          }
                      ?>
                        <div class="col-md-12 post-holder">
                            <div class="well-box">
                              
                              <table class="table table-bordered">
                                  <tbody>
                                    <tr>
                                      <td colspan="2">
                                        <div class="col-md-8 col-md-offset-2">
                                          <div class="profile-sidebar side-box" style="border:none; padding: 0; margin: 0;">
                                            <div class="profile-usertitle-name">
                                              <h3><b>Booked By</b></h3>
                                            </div>
                                              <!-- SIDEBAR USERPIC -->
                                              <?php 
                                              $CustPhoto = $booked_space['profile_image']?'uploads/profile_pic/'.$booked_space['profile_image']:"themes/frontend/images/no-image.png";
                                             ?>
                                              <div class="profile-userpic"> <img src="<?php echo base_url().$CustPhoto;?>" class="img-responsive img-circle" alt=""> </div>
                                              <div class="profile-usertitle">
                                                  <div class="profile-usertitle-name">
                                                      <h2> <?php echo $booked_space['fname']." ".$booked_space['lname'] ; ?></h2>
                                                  </div>
                                                  <div class="profile-address"> <i class="fa fa-phone"></i> <a href="tel:<?php echo $booked_space['mobileno']; ?>"><?php echo $booked_space['mobileno']; ?></a> </div>
                                                  <div class="profile-website"> <i class="fa fa-envelope"></i> 
                                                    <span class="text-muted">
                                                      <?php echo $booked_space['email_id']; ?>
                                                    </span>
                                                   </div>
                                                  <div class="profile-website"> <i class="fa fa-map-marker"></i> 
                                                    <span class="text-muted">
                                                      <?php echo $booked_space['address']; ?>
                                                    </span>
                                                   </div>
                                                   <div class="profile-website"> <i class="fa fa-briefcase"></i> 
                                                    <span class="text-muted">
                                                      <?php echo $booked_space['company_name']; ?>
                                                    </span>
                                                   </div>
                                              </div>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <!-- <tr>
                                      <th>
                                        <div class="profile-usertitle-name">
                                            <h3><b>Booked By</b></h3>
                                        </div>
                                        <?php 
                                            $CustPhoto = $booked_space['profile_image']?'uploads/profile_pic/'.$booked_space['profile_image']:"themes/frontend/images/no-image.png";
                                        ?>
                                        <div class="profile-userpic"> <img src="<?php echo base_url().$CustPhoto;?>" class="img-responsive img-circle" alt=""> </div>
                                      </th>
                                      <td>
                                        <div class="profile-usertitle">
                                          <div class="profile-usertitle-name">
                                            <h2> <?php echo $booked_space['fname']." ".$booked_space['lname'] ; ?></h2>
                                          </div>
                                          <div class="profile-address"> <i class="fa fa-phone"></i> <a href="tel:<?php echo $booked_space['mobileno']; ?>"><?php echo $booked_space['mobileno']; ?></a> </div>
                                            <div class="profile-website"> <i class="fa fa-envelope"></i> 
                                              <span class="text-muted">
                                                <?php echo $booked_space['email_id']; ?>
                                              </span>
                                            </div>
                                            <div class="profile-website"> <i class="fa fa-map-marker"></i> 
                                              <span class="text-muted">
                                                <?php echo $booked_space['address']; ?>
                                              </span>
                                            </div>
                                            <div class="profile-website"> <i class="fa fa-briefcase"></i> 
                                              <span class="text-muted">
                                                <?php echo $booked_space['company_name']; ?>
                                              </span>
                                            </div>
                                        </div>
                                      </td>
                                    </tr> -->
                                    <tr>
                                      <th>Event Name</th>
                                      <td><?php echo $booked_space['event_name']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Number Of Guest</th>
                                      <td>
                                        <?php
                                        if ($booked_space['guest_id'] == 1) {
                                            echo "0-100 Guests";
                                          }elseif ($booked_space['guest_id'] == 2) {
                                            echo "100-200 Guests";
                                          }elseif ($booked_space['guest_id'] == 3) {
                                            echo "200-300 Guests";
                                          }elseif ($booked_space['guest_id'] == 4) {
                                            echo "300-400 Guests";
                                          }elseif ($booked_space['guest_id'] == 5) {
                                            echo "400-500 Guests";
                                          }elseif ($booked_space['guest_id'] == 6) {
                                            echo "500&Up Guests";
                                          }
                                         ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Start Date</th>
                                      <td><?php echo $booked_space['startdate']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Start Time</th>
                                      <td><?php echo $booked_space['start_time']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>End Date</th>
                                      <td><?php echo $booked_space['enddate']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>End Time</th>
                                      <td><?php echo $booked_space['end_time']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Amount</th>
                                      <td><?php echo "₹ ".$booked_space['amount']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Status</th>
                                      <td>
                                        <span style="font-weight: bolder;" id="status">
                                          <?php 
                                            if ($booked_space['chk_status'] == 2) {
                                              echo "<span style='color:#25a032'>Completed</span>";
                                            }elseif($booked_space['chk_status'] == 1){
                                              echo "<span style='color:#f7921e'>Confirmed</span>";
                                            }elseif($booked_space['chk_status'] == 0){
                                              echo "<span style='color:#fa0f2d'>New Request</span>";
                                            }else{
                                              echo "<span style='color:#282923'>Canceled</span>";
                                            } ?>
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" class="text-center">
                                        <?php
                                        $text = "Complete Request";
                                        $is_disable = "";
                                        $is_disable2 = "";
                                        if($booked_space['chk_status'] == 3){
                                          $is_disable2 = "disabled";
                                        }
                                        // if ($booked_space['chk_status'] == 1 || $booked_space['chk_status'] == 2 ) {
                                        //     $today = date("m/d/Y H:i");
                                        //     $enddate = date("m/d/Y", strtotime($booked_space['enddate']));
                                        //     $event_end= explode(" ", $booked_space['end_time']);
                                        //     $end_time = $event_end[0].":00 ".strtolower($event_end[1]);
                                        //     $combinedDT = date('m/d/Y H:i', strtotime("$enddate $end_time"));
                                        //     //echo $combinedDT;
                                        //     $text = "Complete Request";
                                        //     $is_disable = "";
                                        //     if ($today <=  $combinedDT) {
                                        //       $is_disable = "disabled";
                                        //     }
                                        //     if($booked_space['chk_status'] == 2){
                                        //       $is_disable = "disabled";
                                        //       $text = "Request Completed";
                                        //     }
                                        if($booked_space['chk_status'] == 1 || $booked_space['chk_status'] == 2 || $booked_space['chk_status'] == 3){
                                          if($booked_space['chk_status'] == 2){
                                              $is_disable = "disabled";
                                              $text = "Complete Request";
                                            }
                                          ?>
                                        <button class="btn btn-success completed" <?php echo $is_disable.' '.$is_disable2; ?> id="comp" style="margin: 5px;"><?php echo $text; ?></button>
                                      <?php }else{ ?>
                                        <button class="btn btn-success confirm" style="margin: 5px;" <?php echo $is_disable2; ?> id="conf">Confirm Request</button>
                                        <button class="btn btn-success completed" id="comp" style="margin: 5px;display: none">Complete Request</button>
                                      <?php } ?>


                                        <button onclick="window.location.href = '<?php echo base_url();?>home/edit_spacebooking_details/<?php echo $unique_id."/".$booked_space['space_booking_id'];?>'" class="btn btn-warning" id="upd" style="margin: 5px;" <?php echo $is_disable2; ?> >Update Details</button>

                                        <?php
                                          $canclass="cancel";
                                          $text2 = "Cancel Request";
                                          if($booked_space['chk_status'] == 3){
                                            $canclass="";
                                            $text2 = "Request Canceled";
                                          }
                                        ?>
                                        <button class="btn btn-danger <?php echo $canclass; ?>" style="margin: 5px;" id="can" <?php echo $is_disable2; ?> ><?php echo $text2; ?></button>
                                        <input type="hidden" id="booking_id" value="<?php echo $booked_space['space_booking_id'];?>">
                                      </td>
                                    </tr>
                                      
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 <script type="text/javascript">
   $('.completed').on('click', function(){
    if ($(this).attr("disabled")) {

      return false;

     }else{
      var id = $('#booking_id').val();
      var table = 'space';
      var status = 2;
      var unique_id = '<?php echo $unique_id ?>'
       $.confirm({
        title: 'Confirmation Message',
        content: 'Are you sure, you want to Complete this request?',
        confirmButton: 'Proceed',
        confirmButtonClass: 'btn-info',
        icon: 'fa fa-question-circle',
        animation: 'scale',
        animationClose: 'top',
        opacity: 1, 
        confirm: function () { 
            $.ajax({type: "POST",data : {id:id, status:status, unique_id:unique_id, table:table}, url: "<?php echo base_url();?>home/update_booked_status",  
              success: function(data) { 
                  $.alert({
                      title: 'Success!',
                      content: 'Request Successfully Completed...',
                      confirmButton: 'Okay',
                      confirmButtonClass: 'btn-warning',
                      icon: 'fa fa-info',
                      animation: 'zoom',
                      opacity: 1,                                    
                      confirm: function () {
                        $('#comp').text('Request Completed');
                        $('#comp').attr('disabled', 'disabled');
                        $('#status').empty().append("<span style='color:#25a032'>Completed</span>");
                      }
                  });
              }
            });
          }
      });
    }

   });

   $('.cancel').on('click', function(){

      var id = $('#booking_id').val();
      var table = 'space';
      var status = 3;
      var unique_id = '<?php echo $unique_id ?>'
       $.confirm({
        title: 'Confirmation Message',
        content: 'Are you sure, you want to Cancel this request?',
        confirmButton: 'Proceed',
        confirmButtonClass: 'btn-info',
        icon: 'fa fa-question-circle',
        animation: 'scale',
        animationClose: 'top',
        opacity: 1, 
        confirm: function () { 
            $.ajax({type: "POST",data : {id:id, status:status, unique_id:unique_id, table:table}, url: "<?php echo base_url();?>home/update_booked_status",  
              success: function(data) { 
                  $.alert({
                      title: 'Success!',
                      content: 'Request Successfully Canceled...',
                      confirmButton: 'Okay',
                      confirmButtonClass: 'btn-warning',
                      icon: 'fa fa-info',
                      animation: 'zoom',
                      opacity: 1,                                    
                      confirm: function () {
                        $('#can').text('Request Canceled');
                        $('#status').empty().append("<span style='color:#282923'>Canceled</span>");
                        $('#can').attr('disabled', 'disabled');
                        $('#conf').attr('disabled', 'disabled');
                        $('#upd').attr('disabled', 'disabled');
                        $('#comp').attr('disabled', 'disabled');
                      }
                  });
              }
            });
          }
      });

   });


   $('.confirm').on('click', function(){

      var id = $('#booking_id').val();
      var table = 'space';
      var status = 1;
      var unique_id = '<?php echo $unique_id ?>'
       $.confirm({
        title: 'Confirmation Message',
        content: 'Are you sure, you want to confirm this request?',
        confirmButton: 'Proceed',
        confirmButtonClass: 'btn-info',
        icon: 'fa fa-question-circle',
        animation: 'scale',
        animationClose: 'top',
        opacity: 1, 
        confirm: function () { 
            $.ajax({type: "POST",data : {id:id, status:status, unique_id:unique_id, table:table}, url: "<?php echo base_url();?>home/update_booked_status",  
              success: function(data) { 
                  $.alert({
                      title: 'Success!',
                      content: 'Request Successfully Confirmed...',
                      confirmButton: 'Okay',
                      confirmButtonClass: 'btn-warning',
                      icon: 'fa fa-info',
                      animation: 'zoom',
                      opacity: 1,                                    
                      confirm: function () {
                        $('#status').empty().append("<span style='color:#f7921e'>Confirmed</span>");
                        $('#comp').show();
                        $('#conf').remove();
                        //$('#conf').addClass("completed").removeClass("confirm");
                      }
                  });
              }
            });
          }
      });

   });
 </script> 

