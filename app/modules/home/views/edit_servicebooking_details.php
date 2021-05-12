				<?php
                      if ($current_date) {

                        $time_array=array();
                      for ($o=0; $o < count($current_date); $o++) 
                            { 
                                 $current_event_start= explode(" ", $current_date[$o]->start_time);
                                 $current_event_end= explode(" ", $current_date[$o]->end_time);
                                 $current_start_time = $current_event_start[0].":00 ".strtolower($current_event_start[1]);
                                 $current_end_time = $current_event_end[0].":00 ".strtolower($current_event_end[1]);
                                 $current_date2 = date('H:i',strtotime($current_start_time));
                                 $current_date3 = date('H:i',strtotime($current_end_time));

                              for ($z=0; $z < count($timings); $z++) 
                              {   
                                $cur1= explode(" ", $timings[$z]->value);
                                $cur2 = $cur1[0].":00 ".strtolower($cur1[1]);
                                $date11 = date('H:i', strtotime($cur2));

                                if ($date11 >= $current_date2 && $date11 <= $current_date3) {
                                  array_push($time_array, $date11);
                                }


                              }

                            }

                            //print_r($time_array);
                    }

                ?>
<div class="container" style="padding-top: 50px;">
	<div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="side-box" id="inquiry">
                        <h2>Edit Booking Details</h2>
                      <form method="post" action="<?php echo base_url();?>home/update_booked_service/<?php echo $booked_service['service_booking_id']; ?>" id="submit_form">
                            <!-- Text input-->
                            <div class="default-calender">
                                <div class="col-md-6" style="margin-bottom: 20px;">
                                    <label class="control-label" for="weddingdate">Start Date<font class="required">*</font></label>
                                    <div class="">
                                        <div class="input-group">
                                            <input type="text" class="form-control dpicker" name="startdate" placeholder="Start Date" autocomplete="off" id="my-datepicker" placeholder="Wedding Date" value="<?php if($booked_service){ echo $booked_service['startdate']; } ?>">
                                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span> </div>
                                    </div>
                                    <span style="color: red; font-size: 12px; float: left;" id="startspan"></span>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 20px;">
                                <label class="control-label" for="phone">Start Time:<font class="required">*</font></label>
                                <div class="">
                                  <select name="start_time" id="start_time"  class="form-control">
                                    <option disabled="" selected="" value="0">Start Time</option>
                                      <?php
                                      $event_start= explode(" ", $service_detail['from_time']);
                                      $event_end= explode(" ", $service_detail['to_time']);
                                      $start_time = $event_start[0].":00 ".strtolower($event_start[1]);
                                      $end_time = $event_end[0].":00 ".strtolower($event_end[1]);

                                      $date2 = date('H:i',strtotime($start_time));
                                      $date3 = date('H:i',strtotime($end_time));
                                      for ($l=0; $l < count($timings); $l++) 
                                          {   
                                            $cur1= explode(" ", $timings[$l]->value);
                                            $cur2 = $cur1[0].":00 ".strtolower($cur1[1]);
                                            $date1 = date('H:i', strtotime($cur2));
                                            $is_disable = "disabled";
                                            $style = "style='color:#cccccc;'";
                                            
                                            if ($date2 >= $date3) {
                                              if ($date1 >= $date2 ) {
                                                $is_disable = "";
                                                $style = "";
                                              }
                                            if ($date1 <= $date3 ) {
                                                $is_disable = "";
                                                $style = "";
                                              }
                                            }else{
                                              if ($date1 >= $date2 && $date1 <= $date3) {
                                                $is_disable = "";
                                                $style = "";
                                              }
                                            }
                                            
                                          ?>
                                            <option value="<?php echo $timings[$l]->value?>" <?php echo $is_disable." ".$style; ?> 
                                            <?php
                                              if ($current_date) {
                                                if (in_array($date1, $time_array)) {
                                                  echo "disabled ";
                                                  echo " style='color:#cccccc;'";
                                                }
                                              }
                                              if($timings[$l]->value == $booked_service['start_time']){
                                              	echo "selected";
                                              }
                                            ?>>
                                            <?php echo date('h:i a', strtotime($cur2)); ?>
                                              
                                            </option>

                                            <?php
                                          }
                                        ?>
                                  </select>
                                </div>
                                <span style="color: red; font-size: 12px; float: left;"></span>
                            </div>
                            <!-- Multiple Radios -->
                            <!-- Text input-->
                            <div class="default-calender">
                                <div class="col-md-6" style="margin-bottom: 20px;">
                                    <label class="control-label" for="weddingdate">End Date<font class="required">*</font></label>
                                    <div class="">
                                        <div class="input-group">
                                            <input type="text" class="form-control dpicker" name="enddate" placeholder="End Date" autocomplete="off" id="my-datepicker2" placeholder="Wedding Date" value="<?php if($booked_service){ echo $booked_service['enddate']; } ?>">
                                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span> </div>
                                    </div>
                                    <span style="color: red; font-size: 12px; float: left;"  id="endspan"></span>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom: 20px;">
                                <label class="control-label" for="phone">End Time:<font class="required">*</font></label>
                                <div class="">
                                  <select  name="end_time" id="end_time"  class="form-control">
                                    <option disabled="" selected="" value="0">End Time</option>
                                      <?php
                                        for ($l=0; $l < count($timings); $l++) 
                                            {   
                                              $cur1= explode(" ", $timings[$l]->value);
                                              $cur2 = $cur1[0].":00 ".strtolower($cur1[1]);
                                              $date1 = date('H:i', strtotime($cur2));
                                              $is_disable = "disabled";
                                              $style = "style='color:#cccccc;'";
                                              if ($date2 >= $date3) {
                                                if ($date1 >= $date2 ) {
                                                  $is_disable = "";
                                                  $style = "";
                                                }
                                              if ($date1 <= $date3 ) {
                                                  $is_disable = "";
                                                  $style = "";
                                                }
                                              }else{
                                                if ($date1 >= $date2 && $date1 <= $date3) {
                                                  $is_disable = "";
                                                  $style = "";
                                                }
                                              }
                                              
                                            ?>
                                              <option value="<?php echo $timings[$l]->value?>" <?php echo $is_disable." ".$style; ?>
                                              <?php
                                                if ($current_date) {
                                                  if (in_array($date1, $time_array)) {
                                                    echo "disabled ";
                                                    echo " style='color:#cccccc;'";
                                                  }
                                                }
                                                if($timings[$l]->value == $booked_service['end_time']){
                                              	echo "selected";
                                              }
                                              ?>><?php echo date('h:i a', strtotime($cur2)); ?></option>

                                              <?php
                                            }
                                      ?>
                                    </select>
                                </div>
                                <span style="color: red; font-size: 12px; float: left;"></span>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <label class="control-label" for="phone">Amount<font class="required">*</font></label>
                                <div class="">
                                	<input type="text" name="amount" class="form-control" required="" onkeypress="return isNum(event)" placeholder="Enter Amount" value="<?php if($booked_service){ echo $booked_service['amount']; } ?>">
                                </div>
                            <hr>
                            </div>

                            <input type="hidden" name="unique_id" value="<?php echo $unique_id; ?>">
                            <!-- Multiple Radios -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary" id="send_button" style="margin: 0 10px;">Update Details</button>
                                <button class="btn btn-default" style="margin: 0 10px;" onclick="window.history.go(-1); return false;">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>
<?php
    $newdate='';
    if ($booked_date) {
        for ($m=0; $m < count($booked_date); $m++) 
            { 
                $from_date = new DateTime(date('d-m-Y',strtotime($booked_date[$m]->startdate)));
                $to_date = new DateTime(date('d-m-Y',strtotime($booked_date[$m]->enddate)));

                for($i = $from_date; $i <= $to_date; $i->modify('+1 day')){
                     $dates[] = $i->format("j-n-Y");
                }

            }
            for($n=0; $n < count($dates); $n++){
                $newdate .= '"'.$dates[$n].'", ';
            }
        }
        //print_r($dates);
        $qdate = rtrim($newdate,', ');
         $newdate = "[".$qdate."]";
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
            $('body').on('focus', ".dpicker", function () {
            $(this).datepicker();
        });
    });
 

    var unavailableDates = <?php echo $newdate; ?>;

    function unavailable(date) {
        dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
        if ($.inArray(dmy, unavailableDates) == -1) {
            return [true, ""];
        } else {
            return [false, "", "Unavailable"];
        }
    }
$(function () {
    $("#my-datepicker").datepicker({
        minDate: 0,
        beforeShowDay: unavailable,
        changeMonth: true,
        dateFormat: 'mm/dd/yy',
        onClose: function (selectedDate, instance) {
            if (selectedDate != '') {
                $("#my-datepicker2").datepicker("option", "minDate", selectedDate);
                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                date.setMonth(date.getMonth() + 3);
               var minDate2 = new Date(selectedDate);
               minDate2.setDate(minDate2.getDate());
                // minDate2.setDate(minDate2.getDate() + 1); will give next date
                
                $("#my-datepicker2").datepicker("option", "minDate", minDate2);
                $("#my-datepicker2").datepicker("option", "maxDate", date);
            }
        }
    });
    $("#my-datepicker2").datepicker({
        minDate: 0,
        beforeShowDay: unavailable,
        changeMonth: true,
        dateFormat: 'mm/dd/yy',
        onClose: function (selectedDate) {
            //$("#my-datepicker").datepicker("option", "maxDate", null);
            var start = $("#my-datepicker").datepicker("getDate");
            if(start != null){
            var end = $("#my-datepicker2").datepicker("getDate");
            var days = (end - start) / (1000 * 60 * 60 * 24);
            if (days == 0) {
              days = 1;
            }
            //$("#TextBox3").val(days);
            //////////// DECIDE AMOUNT //////////////
            $("#base_price1").text('<?php echo $service_detail['base_price']; ?> x '+days+' days');
            $("#base_price").text(<?php echo $service_detail['base_price']; ?> * days);
            $("#estimated").text(<?php echo $service_detail['base_price']; ?> * days);
            //$("#total_amount").val(<?php echo $service_detail['base_price']; ?> * days);
            var discount = 100-<?php echo $service_detail['discount']; ?>;
            var final = (discount/100) * (<?php echo $service_detail['base_price']; ?> * days);
            $("#total_amount").val(final);
            $("#total_price").text(final);
          }
        }
    });

    
});
</script>
<script type="text/javascript">
function isNum(evt){

  evt =(evt)? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode<48 || charCode >57)){

    return false;
  }
return true;
}
</script>